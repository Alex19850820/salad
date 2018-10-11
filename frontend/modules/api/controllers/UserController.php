<?php

namespace frontend\modules\api\controllers;

//use common\helpers\Folder;
use yii\filters\auth\HttpBearerAuth;
use common\models\LoginForm;
use common\models\Token;
use common\models\User;
use frontend\models\SignupForm;
use frontend\modules\api\models\ApiUser;
use yii\web\Controller;
use yii;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\filters\auth\CompositeAuth;

class UserController extends Controller {

	public $status = 0;
	public $error_msg;
	public $user;
	private $token;
	public $post;
	public $profile;
	
	public function behaviors() {
//		$behaviors                           = parent::behaviors();
//		$behaviors['authenticator']['class'] = HttpBearerAuth::className();
//		$behaviors['authenticator']['only']  = [ 'login' ];
//		return $behaviors;
		$behaviors = parent::behaviors();
		$behaviors['authenticator'] = [
			'class' => CompositeAuth::className(),
			'authMethods' => [
//				HttpBasicAuth::className(),
				HttpBearerAuth::className(),
//				QueryParamAuth::className(),
			],
		];
		return $behaviors;
	}
	
	public function init()
	{
		parent::init();
		\Yii::$app->user->enableSession = false;
	}
	
	public function beforeAction( $action ) {
		if ( \Yii::$app->request->isPost ) {
			$this->post = Yii::$app->request->post();
			\Yii::$app->response->format = Response::FORMAT_JSON;
			$this->layout                = false;
			header('Access-Control-Allow-Origin: *');
			if( $action->id != 'login' && $action->id != 'add' ){
				if ( $this->isToken() ) {
					$this->token = $this->isToken();
					$this->user = User::findOne( $this->token->user_id );
					return true;
				} else {
					throw  new NotFoundHttpException( 'Страница не найдена', 404 );
				}
			}
			return true;
		} else {
			throw  new NotFoundHttpException( 'Страница не найдена', 404 );
		}
	}
	
	public function actionIndex() {
		return $this->render( 'index' );
	}
	
	private function isToken() {
		if (isset(Yii::$app->request->post()["token"])){
			return Token::findOne( [ "token" => Yii::$app->request->post()["token"] ] );
		}
		return false;
	}

	public function actionAdd() {
		$model = new SignupForm();

		if ( Yii::$app->request->isPost ) {

			$data["SignupForm"] = Yii::$app->request->post();
			$model->load( $data );
			
			$user = $model->signup();
            header('Access-Control-Allow-Origin: *');
			//вывод ошибок из модели юзера
			if ( is_array( $user ) ) {
				return $user;
			}
			$this->status = 1;
			return [
				"status"   => $this->status,
				"id"       => $user->id,
				"username" => $user->username,
				"email"    => $user->email
			];

		}
        return $this->render( 'index', compact( "model" ) );
	}

	public function actionLogin() {
		$model = new LoginForm();

		if ( Yii::$app->request->isPost ) {
            header('Access-Control-Allow-Origin: *');
			$data["LoginForm"] = Yii::$app->request->post();
			$model->load( $data );
			\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

			if ( $model->login() ) {
				$user            = User::getUser( $model->username );
				$token           = new Token();
				$token->user_id  = $user->id;
				$token->token    = bin2hex( openssl_random_pseudo_bytes( 64 ) );
				$token->save();
				$this->status = 1;

				return [ 'status' => $this->status, 'token' => $token ];
			} else {
				$this->error_msg = 'Неверно введены данные!';

				return [ 'status' => $this->status, 'error_msg' => $this->error_msg ];
			}
		}
        header('Access-Control-Allow-Origin: *');
        return $this->render( 'login', compact( "model" ) );
	}
	
	public function actionGetUser() {
		$user = $this->user;
		if(isset($this->post['id'])){
			$user = User::findOne(['id' => $this->post['id']]);
		}
		if($this->token && $user) {
			$this->status = 1;
		}
		if($this->status == 1) {
			$result = [
				'id' => $user->id,
				'name' => $user->username,
				'date' => $user->created_at,
				'status' => $this->status,
			];
		} else {
			$this->error_msg = 'Пользователь не существует!';
			$result = [ 'status' => $this->status, 'error_msg' => $this->error_msg ];
		}
        header('Access-Control-Allow-Origin: *');
        return $result;
	}
	
}
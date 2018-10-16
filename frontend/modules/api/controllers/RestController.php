<?php
/**
 * Created by PhpStorm.
 * User: Neo
 * Date: 10.10.2018
 * Time: 13:24
 */

namespace frontend\modules\api\controllers;

use yii\rest\Controller;
use common\models\User;
use Yii;
use common\models\Token;
use common\models\LoginForm;
use yii\web\Response;

class RestController extends ApiComponent {
	
	public $status;
	public $token;
	
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
//				header('Authorization: Bearer '. $token.'');
				return [ 'status' => $this->status, 'token' => $token ];
				
			} else {
				$this->error_msg = 'Неверно введены данные!';
				
				return [ 'status' => $this->status, 'error_msg' => $this->error_msg ];
			}
		}
		header('Access-Control-Allow-Origin: *');
		return $this->render( 'login', compact( "model" ) );
	}
	
	public function actionIndex()
	{
		return $this->render('index');
	}
}
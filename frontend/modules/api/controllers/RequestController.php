<?php
/**
 * Created by PhpStorm.
 * User: mecha
 * Date: 15.06.2018
 * Time: 11:32
 */

namespace frontend\modules\api\controllers;

use common\models\Ingredients;
use frontend\modules\api\models\ApiIngredients;
use frontend\modules\api\models\ApiRecipes;
use frontend\modules\api\models\ApiRecipeCategory;
use Yii;
use yii\widgets\ActiveForm;
use common\models\Token;
use yii\web\Response;
use common\models\User;
use yii\web\NotFoundHttpException;
use frontend\modules\api\models\ApiRequest;


class RequestController extends ApiComponent {
	
	public $status = 0;
	public $error_msg;
	public $user;
//	private $token;
	public $post;
	public $profile;
	
	
//	public function beforeAction( $action ) {
//		if ( \Yii::$app->request->isPost ) {
//			$this->post = Yii::$app->request->post();
//			\Yii::$app->response->format = Response::FORMAT_JSON;
//			$this->layout                = false;
//			header('Access-Control-Allow-Origin: *');
//			if( $action->id != 'login' && $action->id != 'add' ){
//				if ( $this->isToken() ) {
//					$this->token = $this->isToken();
//					$this->user = User::findOne( $this->token->user_id );
//					return true;
//				} else {
//					throw  new NotFoundHttpException( 'Страница не найдена', 404 );
//				}
//			}
//			return true;
//		} else {
//			throw  new NotFoundHttpException( 'Страница не найдена', 404 );
//		}
//	}
//
//	private function isToken() {
//		if (isset(Yii::$app->request->post()["token"])){
//			return Token::findOne( [ "token" => Yii::$app->request->post()["token"] ] );
//		}
//		return false;
//	}
	
	public function actionIndex() {
		
		$modelGetLists = new ApiRequest();
		$modelGetIngredients = new ApiRequest();
		
		return $this->render('index', compact("token",  "modelGetLists", "modelGetIngredients"));
	}
	
	

    public function actionAddRecipes() {
        $model = new ApiRecipes();

        $apiRecipes["ApiRecipes"] = Yii::$app->request->post();

        $model->load($apiRecipes);
	    $model->status = 1;

        if (!$model->save()) {
            return ActiveForm::validate($model);
        }

        return "Успешно добавлен";
    }
	
	public function actionAddIngredients() {
		$model = new ApiIngredients();
		
		$apiIngredients["ApiIngredients"] = Yii::$app->request->post();
		
		$model->load($apiIngredients);
		$model->status = 1;
		
		if (!$model->save()) {
			return ActiveForm::validate($model);
		}
		
		return "Ингредиент успешно  добавлен";
	}
	
	public function actionAddRecipeCategory() {
		$model = new ApiRecipeCategory();
		
		$apiRecipeCategory["ApiRecipeCategory"] = Yii::$app->request->post();
		
		$model->load($apiRecipeCategory);
		$model->status = 1;
		
		if (!$model->save()) {
			return ActiveForm::validate($model);
		}
		
		return "Категория рецептов успешно  добавлена";
	}
	
    

    public function actionDel() {
        $id = Yii::$app->request->post()["id"];
        ApiRecipes::deleteAll($id);

        return "Заявка удалена";
    }

    public function actionEdit() {
        $id = Yii::$app->request->post()["id"];
        $model = ApiRecipes::findOne($id);

        $apiRecipes["ApiRecipes"] = Yii::$app->request->post();

        $model->load($apiRecipes);
        $model->dt_add = time();

        if (!$model->save()) {
            return ActiveForm::validate($model);
        }

        return $model->toArray();
    }

    public function actionGetList() {
        $modelPost = new ApiRecipes();

        $apiRecipes["ApiRecipes"] = Yii::$app->request->post();
        $modelPost->load($apiRecipes);
        $models = ApiRecipes::find()->where(['!=','status', 0])->asArray()->all();

        return $models;
    }
	
	public function actionGetIngredients() {
		$modelPost = new ApiIngredients();
		
		$apiIngredients["ApiIngredients"] = Yii::$app->request->post();
		$modelPost->load( $apiIngredients );
		$models = ApiIngredients::find()->where( [ '!=','status',0 ] )->asArray()->all();
		
		return $models;
	}
}
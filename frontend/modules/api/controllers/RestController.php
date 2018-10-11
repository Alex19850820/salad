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
use common\models\LoginForm;

class RestController extends ApiComponent {
	
	
	public function actionLogin()
	{
		$this->enableCsrfValidation = false;
		$model = new LoginForm();
		$model->username = $_POST['username'];
		$model->password = $_POST['password'];
		$model->login();
		return Yii::$app->user->identity;
	}
	
	public function actionIndex()
	{
		return $this->render('index');
	}
}
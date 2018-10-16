<?php
/**
 * Created by PhpStorm.
 * User: Neo
 * Date: 11.10.2018
 * Time: 12:24
 */

namespace frontend\modules\api\controllers;

use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\ContentNegotiator;
use yii\rest\Controller;
use yii\web\Response;

class ApiComponent extends Controller
{
	public function init()
	{
		parent::init();
		\Yii::$app->user->enableSession = false;
	}
	public function behaviors()
	{
		return [
			'contentNegotiator' => [
				'class' => ContentNegotiator::className(),
				'formats' => [
					'application/json' => Response::FORMAT_JSON,
				],
			],
			'authenticator' => [
				'class' => CompositeAuth::className(),
				'authMethods' => [
					HttpBearerAuth::className(),
				],
			]
		];
//		$behaviors = parent::behaviors();
//		$behaviors['authenticator']['class'] = HttpBearerAuth::className();
//		$behaviors['authenticator']['only'] = [];
//		return $behaviors;
	}
}
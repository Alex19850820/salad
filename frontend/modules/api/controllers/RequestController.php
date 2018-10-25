<?php
/**
 * Created by PhpStorm.
 * User: mecha
 * Date: 15.06.2018
 * Time: 11:32
 */

namespace frontend\modules\api\controllers;

use backend\modules\property\property;
use common\models\Debug;
use common\models\Ingredients;
use common\models\IngrToRecipes;
use common\models\PropertyConnIngredients;
use common\models\Recipes;
use frontend\modules\api\models\ApiIngredients;
use frontend\modules\api\models\ApiProperty;
use frontend\modules\api\models\ApiRecipes;
use frontend\modules\api\models\ApiRecipeCategory;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
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
	public $post;
	public $id;
	public $name;
	public $property;
	
	public function beforeAction( $action ) {
		if (\ Yii::$app->request->isPost ) {
			$this->post = Yii::$app->request->post();
			$this->id = Yii::$app->request->post()['id'];
			header('Authorization: Bearer '.$this->post['token']);
			return $this;
		} else {
			throw  new NotFoundHttpException( 'Страница не найдена', 404 );
		}
	}
	
	public function actionIndex() {
		
		$modelGetLists = new ApiRequest();
		$modelGetIngredients = new ApiRequest();
		
		return $this->render('index', compact("token",  "modelGetLists", "modelGetIngredients"));
	}
	
	/*Добавить рецепт*/
    public function actionAddRecipes() {
        $model = new ApiRecipes();

        $apiRecipes["ApiRecipes"] = $this->post;

        $model->load($apiRecipes);
	    $model->status = 1;

        if (!$model->save()) {
            return ActiveForm::validate($model);
        }
        return "Рецепт ".$model->name." успешно добавлен";
    }
    
    /*Удалить рецепт*/
    public function actionDelRecipe() {
    	if($this->id) {
    		$model = ApiRecipes::findOne(['id' => $this->id]);
    		if(!$model) {
    			return "Не верно введены данные или id";
		    }
    		$model->status = 0;
		    if (!$model->save()) {
			    return ActiveForm::validate($model);
		    }
		    return "Рецепт ".$model->name." удален";
	    }
	    return "Введите id рецепта";
    }
	
    /*Добавить ингредиент*/
	public function actionAddIngredients() {
		$model = new ApiIngredients();
		
		$apiIngredients["ApiIngredients"] = $this->post;
		
		$model->load($apiIngredients);
		$model->status = 1;
		
		if (!$model->save()) {
			return ActiveForm::validate($model);
		}
		
		return "Ингредиент ".$model->name." успешно  добавлен";
	}
	
	/*Удалить ингредиент*/
	public function actionDelIngredient() {
		if($this->id) {
			$model = ApiIngredients::findOne($this->id);
			if(!$model) {
				return "Не верно введены данные или id";
			}
			$model->status = 0;
			if (!$model->save()) {
				return ActiveForm::validate($model);
			}
			return "Ингредиент ".$model->name." удален";
		}
		return "Введите id ингредиента";
	}
	
	/*Удалить св-во*/
	public function actionDelProperty() {
		if($this->id) {
			$model = ApiProperty::findOne($this->id);
			if(!$model) {
				return "Не верно введены данные или id";
			}
			$model->status = 0;
			if (!$model->save()) {
				return ActiveForm::validate($model);
			}
			return "Св-во ".$model->name." удален";
		}
		return "Введите id св-ва";
	}
	
	/*Добавить категории для рецептов*/
	public function actionAddRecipeCategory() {
		$model = new ApiRecipeCategory();
		
		$apiRecipeCategory["ApiRecipeCategory"] = $this->post;
		
		$model->load($apiRecipeCategory);
		$model->status = 1;
		
		if (!$model->save()) {
			return ActiveForm::validate($model);
		}
		return "Категория ".$model->name." для рецептов успешно  добавлена";
	}
	
	/*Удалить св-во*/
	public function actionDelRecipeCategory() {
		if($this->id) {
			$model = ApiRecipeCategory::findOne($this->id);
			if(!$model) {
				return "Не верно введены данные или id";
			}
			$model->status = 0;
			if (!$model->save()) {
				return ActiveForm::validate($model);
			}
			return "Категория ".$model->name." удалена";
		}
		return "Введите id категории";
	}
	
	/*Редактировать рецепт*/
    public function actionEditRecipes() {
        $model = ApiRecipes::findOne($this->id);
		if($model) {
			$apiRecipes["ApiRecipes"] = $this->post;
			$model->load($apiRecipes);
			$model->status = 1;
			
			if (!$model->save()) {
				return ActiveForm::validate($model);
			}
			return $model->toArray();
		}
        return "Не верно введены данные или id";
    }
    
	/*Редактировать св-во*/
	public function actionEditProperty() {
		$model = ApiProperty::findOne($this->id);
		
		$apiProperty["ApiProperty"] = $this->post;
		$model->load($apiProperty);
		$model->status = 1;
		
		if (!$model->save()) {
			return ActiveForm::validate($model);
		}
		
		return $model->toArray();
	}
	
	/*Редактировать ингредиент*/
	public function actionEditIngredient() {
		$model = ApiIngredients::findOne($this->id);
		
		$apiIngredients["ApiIngredients"] = $this->post;
		$model->load($apiIngredients);
		$model->status = 1;
		$model->id = $this->id;
		if (!$model->save()) {
			return ActiveForm::validate($model);
		}
		return $model->toArray();
	}
	
	/*Получить рецепты*/
    public function actionGetRecipes() {
		$modelPost = new ApiRecipes();
        $apiRecipes["ApiRecipes"] = $this->post;
        $modelPost->load($apiRecipes);
        if($this->id) {
	        $models = ApiRecipes::find()->where(['!=','status', 0])->andWhere(['id'=>$this->id])->with('ingrToRecipes')->one();
	        if(is_array($models->getIngredients($this->id))) {
		        $ingr = Ingredients::find()->where(['id' => ($models->getIngredients($this->id))])->all();
		        foreach ($ingr as $value) {
			        $this->name[$value->id]= $value->name;
		        }
//		        $this->name = substr_replace($this->name , ';' , '-1' );
		        $models->ingrToRecipes = $this->name;
	        }
	        return [ "Рецепт $models->name" => $models , 'Ингредиенты' => $this->name];
        } else {
	        $models = ApiRecipes::find()->where(['!=','status', 0])->with('ingrToRecipes')->asArray()->all();
	        foreach ($models as $key => $val) {
	        	if(is_array($val['ingrToRecipes'])) {
			        $models[$key]['ingrToRecipes'] = [];
			        foreach ($val['ingrToRecipes'] as $item) {
				        $models[$key]['ingrToRecipes']['Ингредиенты'][$item['ingredients_id']] = Ingredients::find()->where(['id' => $item['ingredients_id']])->one()->name;
			        }
		        }
	        }
	        return $models;
        }
    }
	
    /*Получить ингредиенты*/
	public function actionGetIngredients() {
		$modelPost = new ApiIngredients();
		
		$apiIngredients["ApiIngredients"] = $this->post;
		$modelPost->load( $apiIngredients );
		
		if($this->id) {
			$models = ApiIngredients::find()->where( [ '!=','status',0 ] )->andWhere($this->id)->with('propertyConnIngredients')->asArray()->one();
			$this->property = ArrayHelper::getColumn(PropertyConnIngredients::find()->where(['ingredients_id' => $this->id])->all(), 'property_id');
			$models['propertyConnIngredients'] = ApiProperty::find()->where(['id' => $this->property])->asArray()->all();
		} else {
			$models = ApiIngredients::find()->with('propertyConnIngredients')->where( [ '!=','status',0 ] )->asArray()->all();
			foreach ($models as $key => $val) {
				if(is_array($val['propertyConnIngredients'])){
					$models[$key]['propertyConnIngredients'] = [];
					foreach ($val['propertyConnIngredients'] as $item) {
						$models[$key]['propertyConnIngredients']['Property'][$item['property_id']] = ApiProperty::find()->where(['id' => $item['property_id']])->one()->name;
					}
				}
				
			}
		}
		return $models;
	}
	
	/*Добавить св-ва ингридиенту*/
	public function actionAddIngredientsProperty() {
		if($this->id) {
			$model = ApiIngredients::findOne(['id' => $this->id]);
			$model->propertyConnIngredients = ArrayHelper::getColumn( PropertyConnIngredients::find()->where([ 'ingredients_id' => $model->id])->all(), 'property_id');
			$model->status = 1;
			
			if (!$model->save()) {
				return ActiveForm::validate($model);
			}
		} else {
			return "Не верно введены данные id, property";
		}
		return "Св-во ингредиента ".$model->name." изменено";
	}
	
	/*Добавить св-во*/
	public function actionAddProperty() {
		$model = new ApiProperty();
		
		$apiPropperty["ApiProperty"] = Yii::$app->request->post();
		$model->load($apiPropperty);
		$model->status = 1;
		$model->save();
		
		if (!$model->save()) {
			return ActiveForm::validate($model);
		}
		
		return "Св-во ".$model->name." успешно добавлен";
	}
	
	/*Получить св-ва*/
	public function actionGetProperty() {
		$modelPost = new ApiProperty();
		
		$apiProperty["ApiProperty"] = Yii::$app->request->post();
		$modelPost->load( $apiProperty );
		if ($this->id) {
			$models = ApiProperty::find()->where( [ '!=','status',0 ] )->andWhere(['id' => $this->id])->asArray()->all();
		} else {
			$models = ApiProperty::find()->where( [ '!=','status',0 ] )->asArray()->all();
		}
		return $models;
	}
	
	/*получение ингридиентов по рецепту*/
	public function actionGetIngRecipe() {
		if($this->id){
			$models = ApiRecipes::find()->where(['!=','status', 0])->andWhere(['id'=>$this->id])->with('ingrToRecipes')->one();
			if(is_array($models->getIngredients($this->id))) {
				$ingr = Ingredients::find()->where(['id' => ($models->getIngredients($this->id))])->all();
				foreach ($ingr as $value) {
					$this->name .= $value->name.',';
				}
				$this->name = substr_replace($this->name , ';' , '-1' );
				$models->ingrToRecipes = $this->name;
			}
			return "Ингредиенты ".$models->name." : ".$models->ingrToRecipes;
		} else {
			return "Не верно введены данные id";
		}
	}
	
	/*получение св-ва по id ингредиента*/
	public function actionGetPropIngr() {
		if ($this->id){
			$models = ApiIngredients::findOne($this->id);
			return ['Св-ва '.$models->name.' :' => ApiProperty::find()->where(['id'=>$models->getProperty($this->id)])->asArray()->all()];
		} else {
			return "Не верно введены данные id";
		}
	}
	
	/*получение св-в по рецепту*/
	public function actionGetPropRecipe() {
		if ($this->id){
			$models = ApiRecipes::findOne($this->id);
			$this->property = ArrayHelper::getColumn( PropertyConnIngredients::find()->where([ 'ingredients_id' => $models->getIngredients($this->id)])->all(), 'property_id');
			return ['Св-ва рецепта' => ApiProperty::find()->where(['id'=>$this->property])->asArray()->all()];
		} else {
			return "Не верно введены данные id";
		}
	}
}
<?php
/**
 * Created by PhpStorm.
 * User: Neo
 * Date: 10.10.2018
 * Time: 11:35
 */

namespace frontend\modules\api\models;

use common\models\Debug;
use common\models\IngrToRecipes;
use common\models\Recipes;
use yii\helpers\ArrayHelper;

class ApiRecipes extends Recipes {
	
	public function behaviors() {
		return [
			'slug' => [
				'class'         => 'common\behaviors\Slug',
				'in_attribute'  => 'name',
				'out_attribute' => 'slug',
				'translit'      => true
			],
		];
	}
	
	public function rules() {
        $rules = parent::rules();
        return $rules;
    }
    
    public function getIngredients($id) {
	    return ArrayHelper::getColumn( IngrToRecipes::find()->where([ 'recipes_id' => $id])->all(), 'ingredients_id');
    }
    
    public function afterSave( $insert,$changedAttributes ) {
	    $post = $_POST;
	    $this->saveRecipe($this->id, $post);
    	parent::afterSave( $insert,$changedAttributes ); // TODO: Change the autogenerated stub
    }
	
	public function beforeSave( $insert ) {
	    $post = $_POST;
	    $this->saveRecipe($this->id, $post);
	    return parent::beforeSave( $insert ); // TODO: Change the autogenerated stub
    }
	public function saveRecipe($id,$post) {
		
		if($post['ingrToRecipes']&&$this->id) {
			IngrToRecipes::deleteAll(['recipes_id'=>$this->id]);
			$post['ingrToRecipes'] = explode(',' , $post['ingrToRecipes']);
			foreach ($post['ingrToRecipes'] as $ingr) {
				$ingredient = new IngrToRecipes();
				$ingredient->recipes_id = $this->id;
				$ingredient->ingredients_id = $ingr;
//				$ingredient->status = 1;
				$ingredient->save();
			}
		}
	}
}
<?php
/**
 * Created by PhpStorm.
 * User: Neo
 * Date: 10.10.2018
 * Time: 11:30
 */

namespace frontend\modules\api\models;

use common\models\Debug;
use common\models\Ingredients;
use common\models\PropertyConnIngredients;
use yii\helpers\ArrayHelper;


class ApiIngredients extends Ingredients {

	public $id;
	public $prop_id;
	
    public function rules() {
        $rules = parent::rules();
        return $rules;
    }
	
	public function beforeSave( $insert ) {
		$post = $_POST;
		
		if($post['property']&&$post['id'] ) {
			$this->id = $post['id'];
			$this->prop_id = $post['property'];
			$this->prop_id = explode(',' , $this->prop_id);
			PropertyConnIngredients::deleteAll(['ingredients_id'=>$this->id]);
			foreach ($this->prop_id as $prop) {
				$property = new PropertyConnIngredients();
				$property->ingredients_id = $this->id;
				$property->property_id = $prop;
				$property->status = 1;
				$property->save();
			}
		}
		
		return parent::beforeSave( $insert ); // TODO: Change the autogenerated stub
	}
	
	public function getProperty($id) {
		return ArrayHelper::getColumn( PropertyConnIngredients::find()->where([ 'ingredients_id' => $id])->all(), 'property_id');
	}

}
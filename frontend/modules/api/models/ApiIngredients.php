<?php
/**
 * Created by PhpStorm.
 * User: Neo
 * Date: 10.10.2018
 * Time: 11:30
 */

namespace frontend\modules\api\models;

use common\models\Ingredients;

class ApiIngredients extends Ingredients {

    public function rules() {
        $rules = parent::rules();

        return $rules;
    }

}
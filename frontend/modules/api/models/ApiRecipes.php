<?php
/**
 * Created by PhpStorm.
 * User: Neo
 * Date: 10.10.2018
 * Time: 11:35
 */

namespace frontend\modules\api\models;

use common\models\Recipes;

class ApiRecipes extends Recipes {

    public function rules() {
        $rules = parent::rules();

        return $rules;
    }

}
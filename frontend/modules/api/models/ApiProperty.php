<?php
/**
 * Created by PhpStorm.
 * User: Neo
 * Date: 22.10.2018
 * Time: 11:30
 */

namespace frontend\modules\api\models;

use common\models\Debug;
use common\models\Property;

class ApiProperty extends Property {

    public function rules() {
        $rules = parent::rules();
        return $rules;
    }
	
}
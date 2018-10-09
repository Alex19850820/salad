<?php

namespace backend\modules\ingredients\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "ingredients".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $status
 * @property string $dt_add
 */
class Ingredients extends \common\models\Ingredients
{
	public function beforeSave( $insert ) {
		if ( parent::beforeSave( $insert ) ) {
			$date = date("Y-m-d H:i:s");
			$this->dt_add = $date;
			return true;
		}
		return false;
	}
}

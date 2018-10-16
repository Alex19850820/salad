<?php

namespace backend\modules\recipes\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "recipes".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $status
 * @property string $slug
 * @property string $dt_add
 */
class Recipes extends \common\models\Recipes
{
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
	
	public function setDescription( $value ) {
		$this->description = json_encode( $value );
	}
	public function getDescription() {
		return json_decode( $this->description );
	}
}

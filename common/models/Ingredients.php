<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ingredients".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $status
 * @property string $dt_add
 */
class Ingredients extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ingredients';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['status'], 'integer'],
            [['dt_add'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('ingredients', 'ID'),
            'name' => Yii::t('ingredients', 'Name'),
            'description' => Yii::t('ingredients', 'Description'),
            'status' => Yii::t('ingredients', 'Status'),
            'dt_add' => Yii::t('ingredients', 'Dt Add'),
        ];
    }
	
	public function beforeSave( $insert ) {
		if ( parent::beforeSave( $insert ) ) {
			$date = date("Y-m-d H:i:s");
			$this->dt_add = $date;
			return true;
		}
		return false;
	}
}

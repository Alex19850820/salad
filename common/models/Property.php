<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "property".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $status
 * @property string $dt_add
 *
 * @property PropertyConnIngredients[] $propertyConnIngredients
 */
class Property extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'property';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'name'], 'required'],
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
            'id' => Yii::t('property', 'ID'),
            'name' => Yii::t('property', 'Name'),
            'description' => Yii::t('property', 'Description'),
            'status' => Yii::t('property', 'Status'),
            'dt_add' => Yii::t('property', 'Dt Add'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPropertyConnIngredients()
    {
        return $this->hasMany(PropertyConnIngredients::className(), ['property_id' => 'id']);
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

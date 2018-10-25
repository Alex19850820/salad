<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "property_conn_ingredients".
 *
 * @property int $id
 * @property int $ingredients_id
 * @property int $property_id
 * @property int $status
 *
 * @property Ingredients $ingredients
 * @property Property $property
 */
class PropertyConnIngredients extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'property_conn_ingredients';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ingredients_id', 'property_id', 'status'], 'integer'],
            [['ingredients_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ingredients::className(), 'targetAttribute' => ['ingredients_id' => 'id']],
            [['property_id'], 'exist', 'skipOnError' => true, 'targetClass' => Property::className(), 'targetAttribute' => ['property_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('property_conn_ingredients', 'ID'),
            'ingredients_id' => Yii::t('property_conn_ingredients', 'Ingredients ID'),
            'property_id' => Yii::t('property_conn_ingredients', 'Property ID'),
            'status' => Yii::t('property_conn_ingredients', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngredients()
    {
        return $this->hasOne(Ingredients::className(), ['id' => 'ingredients_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProperty()
    {
        return $this->hasOne(Property::className(), ['id' => 'property_id']);
    }
}

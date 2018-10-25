<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ingr_to_recipes".
 *
 * @property int $id
 * @property int $ingredients_id
 * @property int $recipes_id
 *
 * @property Ingredients $ingredients
 * @property Recipes $recipes
 */
class IngrToRecipes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ingr_to_recipes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ingredients_id', 'recipes_id'], 'integer'],
            [['ingredients_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ingredients::className(), 'targetAttribute' => ['ingredients_id' => 'id']],
            [['recipes_id'], 'exist', 'skipOnError' => true, 'targetClass' => Recipes::className(), 'targetAttribute' => ['recipes_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('ingr_to_recipes', 'ID'),
            'ingredients_id' => Yii::t('ingr_to_recipes', 'Ingredients ID'),
            'recipes_id' => Yii::t('ingr_to_recipes', 'Recipes ID'),
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
    public function getRecipes()
    {
        return $this->hasOne(Recipes::className(), ['id' => 'recipes_id']);
    }
}

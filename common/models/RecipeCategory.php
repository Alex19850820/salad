<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "recipe_category".
 *
 * @property int $id
 * @property string $name
 * @property int $recipes_id
 * @property string $description
 * @property int $status
 * @property string $dt_add
 */
class RecipeCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'recipe_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['recipes_id', 'status'], 'integer'],
            [['description'], 'string'],
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
            'id' => Yii::t('recipe_category', 'ID'),
            'name' => Yii::t('recipe_category', 'Name'),
            'recipes_id' => Yii::t('recipe_category', 'Recipes ID'),
            'description' => Yii::t('recipe_category', 'Description'),
            'status' => Yii::t('recipe_category', 'Status'),
            'dt_add' => Yii::t('recipe_category', 'Dt Add'),
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

<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "recipes".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $status
 * @property string $slug
 * @property string $dt_add
 *
 * @property IngrToRecipes[] $ingrToRecipes
 *
 */
class Recipes extends \yii\db\ActiveRecord
{
	public $ingrToRecipes;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'recipes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'name', 'ingrToRecipes'], 'required'],
            [['description'], 'string'],
            [['status'], 'integer'],
            [['dt_add'], 'safe'],
            [['name', 'slug'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('recipes', 'ID'),
            'name' => Yii::t('recipes', 'Name'),
            'description' => Yii::t('recipes', 'Description'),
            'status' => Yii::t('recipes', 'Status'),
            'slug' => Yii::t('recipes', 'Slug'),
            'dt_add' => Yii::t('recipes', 'Dt Add'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIngrToRecipes()
    {
        return $this->hasMany(IngrToRecipes::className(), ['recipes_id' => 'id']);
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

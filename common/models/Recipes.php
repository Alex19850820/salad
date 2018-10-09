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
 */
class Recipes extends \yii\db\ActiveRecord
{
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
//            [['description'], 'string'],
            [['status'], 'integer'],
            [['dt_add','description'], 'safe'],
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
}

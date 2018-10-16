<?php

namespace backend\modules\recipe_category\controllers;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\recipe_category\models\RecipeCategory;

/**
 * RecipeCategorySearch represents the model behind the search form of `backend\modules\recipe_category\models\RecipeCategory`.
 */
class RecipeCategorySearch extends RecipeCategory
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'recipes_id', 'status'], 'integer'],
            [['name', 'description', 'dt_add'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = RecipeCategory::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'recipes_id' => $this->recipes_id,
            'status' => $this->status,
            'dt_add' => $this->dt_add,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}

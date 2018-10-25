<?php

namespace backend\modules\connect\controllers;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\connect\models\PropertyConnIngredients;

/**
 * ConnectSearch represents the model behind the search form of `backend\modules\connect\models\PropertyConnIngredients`.
 */
class ConnectSearch extends PropertyConnIngredients
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'ingredients_id', 'property_id'], 'integer'],
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
        $query = PropertyConnIngredients::find();

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
            'ingredients_id' => $this->ingredients_id,
            'property_id' => $this->property_id,
        ]);

        return $dataProvider;
    }
}

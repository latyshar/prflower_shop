<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Category;

/**
 * ProductSearch represents the model behind the search form of `app\models\Product`.
 */
class ProductSearch extends Product
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_p', 'id_category', 'count'], 'integer'],
            [['name_p', 'img', 'country', 'date_p'], 'safe'],
            [['price'], 'number'],
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
        $query = Product::find();

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
            'id_p' => $this->id_p,
            'id_category' => $this->id_category,
            'count' => $this->count,
            'price' => $this->price,
            'date_p' => $this->date_p,
        ]);

        $query->andFilterWhere(['like', 'name_p', $this->name_p])
            ->andFilterWhere(['like', 'img', $this->img])
            ->andFilterWhere(['like', 'country', $this->country]);

        return $dataProvider;
    }
}

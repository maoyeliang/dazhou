<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Venue;

/**
 * VenueSearch represents the model behind the search form of `backend\models\Venue`.
 */
class VenueSearch extends Venue
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'state', 'updated_time', 'created_time'], 'integer'],
            [['name', 'telphone', 'manager', 'imglogo', 'imghead', 'imglist', 'address', 'location', 'shophours', 'paykomw', 'note', 'description'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Venue::find();

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
            'state' => $this->state,
            'updated_time' => $this->updated_time,
            'created_time' => $this->created_time,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'telphone', $this->telphone])
            ->andFilterWhere(['like', 'manager', $this->manager])
            ->andFilterWhere(['like', 'imglogo', $this->imglogo])
            ->andFilterWhere(['like', 'imghead', $this->imghead])
            ->andFilterWhere(['like', 'imglist', $this->imglist])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'location', $this->location])
            ->andFilterWhere(['like', 'shophours', $this->shophours])
            ->andFilterWhere(['like', 'paykomw', $this->paykomw])
            ->andFilterWhere(['like', 'note', $this->note])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}

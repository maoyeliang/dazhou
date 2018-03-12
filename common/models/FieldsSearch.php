<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Fields;

/**
 * FieldsSearch represents the model behind the search form of `common\models\Fields`.
 */
class FieldsSearch extends Fields
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'venue_id', 'type', 'vip_type', 'material', 'careate_time', 'update_time'], 'integer'],
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
        $query = Fields::find();


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
            'venue_id' => $this->venue_id,
            'type' => $this->type,
            'vip_type' => $this->vip_type,
            'material' => $this->material,
            'careate_time' => $this->careate_time,
            'update_time' => $this->update_time,
        ]);

        return $dataProvider;
    }
}

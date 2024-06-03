<?php

namespace app\modules\broadcasts\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\broadcasts\models\ChannelDetail;

/**
 * ChannelDetailSearch represents the model behind the search form of `app\modules\broadcasts\models\ChannelDetail`.
 */
class ChannelDetailSearch extends ChannelDetail
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_channel', 'id_lead'], 'integer'],
            [['timestamp'], 'safe'],
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
        $query = ChannelDetail::find();

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
            'id_channel' => $this->id_channel,
            'id_lead' => $this->id_lead,
            'timestamp' => $this->timestamp,
        ]);

        return $dataProvider;
    }
}

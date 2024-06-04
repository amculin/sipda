<?php

namespace app\modules\prospects\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\prospects\models\LeadHistory;

/**
 * LeadHistorySearch represents the model behind the search form of `app\modules\prospects\models\LeadHistory`.
 */
class LeadHistorySearch extends LeadHistory
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_lead', 'id_tahapan'], 'integer'],
            [['nilai'], 'number'],
            [['file', 'timestamp'], 'safe'],
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
        $query = LeadHistory::find();

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
            'id_lead' => $this->id_lead,
            'id_tahapan' => $this->id_tahapan,
            'nilai' => $this->nilai,
            'timestamp' => $this->timestamp,
        ]);

        $query->andFilterWhere(['like', 'file', $this->file]);

        return $dataProvider;
    }

    public static function getLastStep($leadID)
    {
        $sql = 'SELECT id_tahapan FROM lead_history WHERE id_lead = :leadID ORDER BY id DESC';

        $data = Yii::$app->db->createCommand($sql, [
            ':leadID' => $leadID
        ])->queryScalar();

        return $data;
    }

    public static function getHistoriesByLeadID($leadID)
    {
        $sql = 'SELECT h.id, t.nama, t.warna, t.icon, h.nilai, h.file, h.timestamp
            FROM lead_history h
            LEFT JOIN tahapan t ON (t.id = h.id_tahapan)
            WHERE h.id_lead = :leadID';

        $data = Yii::$app->db->createCommand($sql, [
            ':leadID' => $leadID
        ])->queryAll();

        return $data;
    }
}

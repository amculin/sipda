<?php

namespace app\modules\prospects\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\prospects\models\Aktivitas;

/**
 * AktivitasSearch represents the model behind the search form of `app\modules\prospects\models\Aktivitas`.
 */
class AktivitasSearch extends Aktivitas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_lead', 'id_tahapan', 'id_status', 'is_deleted'], 'integer'],
            [['tanggal', 'lokasi', 'aktivitas', 'progres', 'timestamp'], 'safe'],
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
        $query = Aktivitas::find();

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
            'tanggal' => $this->tanggal,
            'id_status' => $this->id_status,
            'is_deleted' => $this->is_deleted,
            'timestamp' => $this->timestamp,
        ]);

        $query->andFilterWhere(['like', 'lokasi', $this->lokasi])
            ->andFilterWhere(['like', 'aktivitas', $this->aktivitas])
            ->andFilterWhere(['like', 'progres', $this->progres]);

        return $dataProvider;
    }

    public static function getActivitiesByLeadID($leadID)
    {
        $sql = 'SELECT a.id, a.tanggal, a.lokasi, a.aktivitas, a.progres, a.id_status
            FROM aktivitas a
            WHERE a.id_lead = :leadID AND a.is_deleted = :status';

        $data = Yii::$app->db->createCommand($sql, [
            ':leadID' => $leadID,
            ':status' => self::IS_NOT_DELETED
        ])->queryAll();

        return $data;
    }
}

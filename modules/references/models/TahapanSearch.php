<?php

namespace app\modules\references\models;

use Yii;
use yii\base\Model;
use yii\data\SqlDataProvider;

/**
 * TahapanSearch represents the model behind the search form of `app\modules\references\models\Tahapan`.
 */
class TahapanSearch extends Tahapan
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_unit', 'urutan'], 'integer'],
            [['nama', 'warna'], 'safe'],
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

        $bound = [
            ':unitID' => Yii::$app->user->identity->id_unit,
            ':status' => $this::IS_NOT_DELETED
        ];
        $where = ' WHERE t.id_unit = :unitID AND t.is_deleted = :status';

        $this->load($params);

        if ($this->nama) {
            $where .= ' AND t.nama LIKE :name';
            $bound[':name'] = "%{$this->nama}%";
        }

        $count = Yii::$app->db->createCommand('SELECT COUNT(*) FROM tahapan t' . $where, $bound)->queryScalar();
        $sql = "SELECT t.id, t.nama, t.urutan, t.warna FROM tahapan t
        {$where}";

        $config = [
            'sql' => $sql,
            'params' => $bound,
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => Yii::$app->params['pageSize'],
            ],
        ];

        $provider = new SqlDataProvider($config);

        return $provider;
    }
}

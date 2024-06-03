<?php

namespace app\modules\prospects\models;

use Yii;
use yii\base\Model;
use yii\data\SqlDataProvider;
use app\models\UserGrup as Role;
use app\modules\prospects\models\Lead;

/**
 * LeadSearch represents the model behind the search form of `app\modules\prospects\models\Lead`.
 */
class LeadSearch extends Lead
{
    public $nama;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_sales', 'id_tahapan', 'year'], 'integer'],
            [['nama', 'id_sales', 'id_tahapan', 'year'], 'safe'],
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

        $where = ' WHERE l.id_unit = :unitID AND l.is_deleted = :status';

        $this->load($params);

        if ((Yii::$app->user->identity->id_grup == Role::SALES) || ($this->id_sales)) {
            $salesID = (Yii::$app->user->identity->id_grup == Role::SALES) ? Yii::$app->user->identity->id
                : $this->id_sales;
            $where .= ' AND l.id_sales = :salesID';
            $bound[':salesID'] = $salesID;
        }

        if ($this->nama) {
            $where .= ' AND (u.nama LIKE :name OR l.nama_perusahaan LIKE :name)';
            $bound[':name'] = "%{$this->nama}%";
        }

        if ($this->id_tahapan) {
            $where .= ' AND l.id_tahapan = :stepID';
            $bound[':stepID'] = $this->id_tahapan;
        }

        if ($this->year) {
            $where .= ' AND l.year = :year';
            $bound[':year'] = $this->year;
        }

        $count = Yii::$app->db->createCommand('SELECT COUNT(*) FROM `lead` l
            LEFT JOIN `user` u ON (u.id = l.id_sales)' . $where, $bound)->queryScalar();
        $sql = "SELECT l.id, l.kode, l.nama_perusahaan, l.kebutuhan, l.id_tahapan, l.nilai, u.nama,
                t.nama AS `step`, t.warna, t.icon
            FROM `lead` l
            LEFT JOIN `user` u ON (u.id = l.id_sales)
            LEFT JOIN `tahapan` t ON (t.id = l.id_tahapan)
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

    public static function getLastCounter()
    {
        $year = date('Y');
        $sql = "SELECT l.counter
            FROM `lead` l
            WHERE l.year = :year
            ORDER BY l.id DESC
            LIMIT 1";

        $data = Yii::$app->db->createCommand($sql, [
            ':year' => $year
        ])->queryScalar();

        return ($data === false) ? 1 : ($data + 1);
    }

    public static function createUniqueCode($lastCounter)
    {
        return 'PK' . date('Y') . '-' . str_pad($lastCounter, 5, '0', STR_PAD_LEFT);
    }
}

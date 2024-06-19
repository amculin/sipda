<?php

namespace app\modules\references\models;

use Yii;
use yii\base\Model;
use yii\data\SqlDataProvider;
use yii\helpers\ArrayHelper;

/**
 * ProgramSearch represents the model behind the search form of `app\modules\references\models\Program`.
 */
class ProgramSearch extends Program
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tanggal_mulai'], 'integer'],
            [['nama', 'kode'], 'string']
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
        $where = ' WHERE p.id_unit = :unitID AND p.is_deleted = :status';

        $this->load($params);

        if ($this->nama) {
            $where .= ' AND (p.kode LIKE :name OR p.nama LIKE :name)';
            $bound[':name'] = "%{$this->nama}%";
        }

        if ($this->year) {
            $where .= ' AND p.year = :year';
            $bound[':year'] = $this->year;
        }

        $count = Yii::$app->db->createCommand('SELECT COUNT(*) FROM program p' . $where, $bound)->queryScalar();
        $sql = "SELECT p.id, p.kode, p.nama, p.lokasi, p.tanggal_mulai, p.tanggal_selesai, p.is_disabled
        FROM program p
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
        $sql = "SELECT p.counter
            FROM program p
            WHERE p.year = :year
            ORDER BY id DESC
            LIMIT 1";

        $data = Yii::$app->db->createCommand($sql, [
            ':year' => $year
        ])->queryScalar();

        return ($data === false) ? 1 : ($data + 1);
    }

    public static function createUniqueCode($lastCounter)
    {
        return 'EV' . substr(date('Y'), 2, 2)
            . date('m') . str_pad($lastCounter, 4, '0', STR_PAD_LEFT);
    }

    public static function getList()
    {
        $sql = "SELECT p.id, CONCAT_WS(' - ', p.kode, p.nama) AS event_name FROM `program` p
            WHERE id_unit = :unitID AND is_deleted = :status
            ORDER BY nama ASC";

        $data = Yii::$app->db->createCommand($sql, [
            ':unitID' => Yii::$app->user->identity->id_unit,
            ':status' => parent::IS_NOT_DELETED
        ])->queryAll();

        return ArrayHelper::map($data, 'id', 'event_name');
    }
}

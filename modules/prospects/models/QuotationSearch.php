<?php

namespace app\modules\prospects\models;

use Yii;
use app\models\UserGrup as Role;
use yii\base\Model;
use yii\data\SqlDataProvider;

/**
 * QuotationSearch represents the model behind the search form of `app\modules\prospects\models\Quotation`.
 */
class QuotationSearch extends Quotation
{
    public $sales_id;
    public $name;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sales_id', 'is_verified', 'year'], 'integer'],
            [['nama_klien', 'nama_perusahaan', 'year', 'is_verified', 'name', 'sales_id'], 'safe']
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

        $where = ' WHERE l.id_unit = :unitID AND q.is_deleted = :status';

        $this->load($params);

        if ((Yii::$app->user->identity->id_grup == Role::SALES) || ($this->sales_id)) {
            $salesID = (Yii::$app->user->identity->id_grup == Role::SALES) ? Yii::$app->user->identity->id
                : $this->sales_id;
            $where .= ' AND l.id_sales = :salesID';
            $bound[':salesID'] = $salesID;
        }

        if ($this->name) {
            $where .= ' AND (l.kebutuhan LIKE :name OR q.nama_perusahaan LIKE :name)';
            $bound[':name'] = "%{$this->name}%";
        }

        if ($this->is_verified) {
            $where .= ' AND q.is_verified = :isVerified';
            $bound[':isVerified'] = $this->is_verified;
        }

        if ($this->year) {
            $where .= ' AND q.year = :year';
            $bound[':year'] = $this->year;
        }

        $count = Yii::$app->db->createCommand('SELECT COUNT(*) FROM `quotation` q
            LEFT JOIN `lead` l ON (l.id = q.id_lead)' . $where, $bound)->queryScalar();
        $sql = "SELECT q.id, u.nama, q.kode, l.kebutuhan, q.tanggal, q.nama_perusahaan, q.is_verified
            FROM `quotation` q
            LEFT JOIN `lead` l ON (l.id = q.id_lead)
            LEFT JOIN `user` u ON (u.id = l.id_sales)
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
        $sql = "SELECT q.counter
            FROM `quotation` q
            WHERE q.year = :year
            ORDER BY q.id DESC
            LIMIT 1";

        $data = Yii::$app->db->createCommand($sql, [
            ':year' => $year
        ])->queryScalar();

        return ($data === false) ? 1 : ($data + 1);
    }

    public static function createUniqueCode($lastCounter)
    {
        return 'SP' . date('Ym') . str_pad($lastCounter, 4, '0', STR_PAD_LEFT);
    }
}

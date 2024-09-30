<?php

namespace app\modules\sales\models;

use Yii;
use app\models\UserGrup as Role;
use yii\base\Model;
use yii\data\SqlDataProvider;
use app\modules\sales\models\SalesOrder;

/**
 * SalesOrderSearch represents the model behind the search form of `app\modules\sales\models\SalesOrder`.
 */
class SalesOrderSearch extends SalesOrder
{
    public $sales_id;
    public $name;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_verified', 'sales_id', 'year'], 'integer'],
            [['is_verified', 'year', 'sales_id', 'name'], 'safe']
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

        $where = ' WHERE l.id_unit = :unitID AND so.is_deleted = :status';

        $this->load($params);

        if ((Yii::$app->user->identity->id_grup == Role::SALES) || ($this->sales_id)) {
            $salesID = (Yii::$app->user->identity->id_grup == Role::SALES) ? Yii::$app->user->identity->id
                : $this->sales_id;
            $where .= ' AND l.id_sales = :salesID';
            $bound[':salesID'] = $salesID;
        }

        if ($this->name) {
            $where .= ' AND (l.kebutuhan LIKE :name OR so.nama_perusahaan LIKE :name OR u.nama LIKE :name)';
            $bound[':name'] = "%{$this->name}%";
        }

        if ($this->is_verified != '') {
            $where .= ' AND so.is_verified = :isVerified';
            $bound[':isVerified'] = $this->is_verified;
        }

        if ($this->year) {
            $where .= ' AND so.year = :year';
            $bound[':year'] = $this->year;
        }

        $count = Yii::$app->db->createCommand('SELECT COUNT(*) FROM `so` so
            LEFT JOIN `quotation` q ON (q.id = so.id_quotation)
            LEFT JOIN `lead` l ON (l.id = so.id_lead)
            LEFT JOIN `user` u ON (u.id = l.id_sales)' . $where, $bound)->queryScalar();

        $sql = "SELECT so.id, so.kode, so.nama_perusahaan, so.sub_total, so.is_verified, so.timestamp, u.nama AS sales_name, l.kode AS project_code,
                l.kebutuhan AS project_name
            FROM `so` so
            LEFT JOIN `quotation` q ON (q.id = so.id_quotation)
            LEFT JOIN `lead` l ON (l.id = so.id_lead)
            LEFT JOIN `user` u ON (u.id = l.id_sales)
            {$where}
            ORDER BY so.id DESC";

        $config = [
            'sql' => $sql,
            'params' => $bound,
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => Yii::$app->params['pageSize'],
            ],
        ];

        return new SqlDataProvider($config);
    }

    public static function getLastCounter()
    {
        $year = date('Y');
        $sql = "SELECT so.counter
            FROM `so`
            WHERE so.year = :year
            ORDER BY so.id DESC
            LIMIT 1";

        $data = Yii::$app->db->createCommand($sql, [
            ':year' => $year
        ])->queryScalar();

        return ($data === false) ? 1 : ($data + 1);
    }

    public static function createUniqueCode($lastCounter)
    {
        return 'SO' . date('y') . '/' . date('dm') . '/' . str_pad($lastCounter, 7, '0', STR_PAD_LEFT);
    }
}

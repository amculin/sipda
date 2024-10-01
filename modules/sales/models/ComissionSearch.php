<?php

namespace app\modules\sales\models;

use Yii;
use yii\base\Model;
use yii\data\SqlDataProvider;
use yii\helpers\Json;

/**
 * ComissionSearch represents the model behind the search form of `app\modules\sales\models\Comission`.
 */
class ComissionSearch extends Comission
{
    public $name;
    public $saleTarget;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sales_id', 'month', 'year', 'comission', 'is_achieved', 'is_paid'], 'integer'],
            [['name', 'month', 'year'], 'safe'],
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
     * @return SqlDataProvider
     */
    public function search($params)
    {
        $where = [];
        $bound = [];
        $filter = '';

        $this->load($params);

        if ($this->name) {
            $where[] = 'u.nama LIKE :name';
            $bound[':name'] = "%{$this->name}%";
        }

        if ($this->is_achieved != '') {
            $where[] = 'c.is_achieved = :isAchieved';
            $bound[':isAchieved'] = $this->is_achieved;
        }

        if ($this->year) {
            $where[] = 'c.year = :year';
            $bound[':year'] = $this->year;
        }

        if ($this->month) {
            $where[] = 'c.month = :month';
            $bound[':month'] = $this->month;
        }

        if (! empty($where)) {
            $filter = ' WHERE ' . implode(' AND ', $where);
        }

        $count = Yii::$app->db->createCommand('SELECT COUNT(*) FROM comission c
            LEFT JOIN `user` u ON (u.id = c.sales_id)' . $filter, $bound)->queryScalar();

        $sql = "SELECT c.id, c.sales_id, c.month, c.year, c.comission, c.total_sale, u.nama AS `sales_name`,
                u.jabatan AS `position`, u.komisi_jabatan AS `office_comission`, p.data
            FROM `comission` c
            LEFT JOIN `user` u ON (u.id = c.sales_id)
            LEFT JOIN `plan` p ON (p.id_sales = c.sales_id AND p.tahun = c.year)
            {$filter}
            ORDER BY c.id DESC";

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

    public static function findComission(int $salesID)
    {
        return self::findOne([
            'sales_id' => $salesID,
            'month' => date('m'),
            'year' => date('Y')
        ]);
    }

    public function parseSaleTarget($data)
    {
        $month = (int) $data['month'];
        $saleTarget = json_decode(Json::decode($data['data']), true)[$month]['sale_target'];

        $this->setSaleTarget($saleTarget);

        return $this->toRupiah($saleTarget);
    }

    public function getSaleTarget()
    {
        return $this->saleTarget;
    }

    public function setSaleTarget($value)
    {
        $this->saleTarget = $value;
    }

    public function countPercentage($totalSale)
    {
        return round(($totalSale / $this->saleTarget) * 100) . '%';
    }

    public static function targetAchieved($totalSale, $saleTarget)
    {
        return $totalSale >= $saleTarget;
    }
}

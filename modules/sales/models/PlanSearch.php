<?php

namespace app\modules\sales\models;

use Yii;
use app\customs\FCurrency;
use yii\base\Model;
use yii\data\SqlDataProvider;
use yii\helpers\Json;

/**
 * PlanSearch represents the model behind the search form of `app\modules\sales\models\Plan`.
 */
class PlanSearch extends Plan
{
    use FCurrency;

    public $name;
    public $saleTarget;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tahun'], 'integer'],
            [['tahun', 'name'], 'safe'],
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

        if ($this->name) {
            $where .= ' AND u.nama LIKE :name';
            $bound[':name'] = "%{$this->name}%";
        }

        if ($this->tahun) {
            $where .= ' AND p.tahun = :year';
            $bound[':year'] = $this->tahun;
        }

        $count = Yii::$app->db->createCommand('SELECT COUNT(*) FROM plan p RIGHT JOIN user u ON (p.id_sales = u.id)' . $where,
            $bound)->queryScalar();
        $sql = "SELECT p.id, p.id_sales, u.nama, u.jabatan, p.tahun, p.target_penjualan, p.target_komisi
        FROM plan p
        RIGHT JOIN user u ON (p.id_sales = u.id)
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

    public static function getCurrentPlan($salesID)
    {
        $model = self::findOne([
            'id_sales' => $salesID,
            'tahun' => date('Y')
        ]);

        $model->parseSaleTarget();

        return $model;
    }

    public function parseSaleTarget()
    {
        $month = (int) date('m');
        $saleTarget = Json::decode($this->data, true)[$month]['sale_target'];

        $this->setSaleTarget($saleTarget);
    }

    public function getSaleTarget()
    {
        return $this->saleTarget;
    }

    public function setSaleTarget($value)
    {
        $this->saleTarget = $value;
    }
}

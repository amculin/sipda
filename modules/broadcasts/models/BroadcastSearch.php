<?php

namespace app\modules\broadcasts\models;

use Yii;
use app\models\UserGrup as Role;
use yii\base\Model;
use yii\data\SqlDataProvider;
use yii\helpers\ArrayHelper;

/**
 * BroadcastSearch represents the model behind the search form of `app\modules\broadcasts\models\Broadcast`.
 */
class BroadcastSearch extends Broadcast
{
    public $year;
    public $month;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_sales', 'year', 'month'], 'integer'],
            [['id_sales', 'judul', 'year', 'month'], 'safe'],
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
        $where = ' WHERE b.id_unit = :unitID AND b.is_deleted = :status';

        $this->load($params);

        if ($this->year && $this->month) {
            $where .= ' AND b.timestamp LIKE :yearMonth';
            $bound[':yearMonth'] = "%{$this->year}-{$this->month}%";
        }

        if ($this->judul) {
            $where .= ' AND b.judul LIKE :title';
            $bound[':title'] = "%{$this->judul}%";
        }

        if (Yii::$app->user->identity->id_grup == Role::SALES || $this->id_sales) {
            $where .= ' AND b.id_sales = :salesID';
            $bound[':salesID'] = Yii::$app->user->identity->id_grup == Role::SALES ?
                Yii::$app->user->identity->id : $this->id_sales;
        }

        $count = Yii::$app->db->createCommand('SELECT COUNT(*) FROM broadcast b' . $where, $bound)->queryScalar();
        $sql = "SELECT b.id, b.kode, b.judul, b.schedule, b.id_status, b.timestamp, u.nama AS `sales`, c.nama AS `channel`,
                bs.nama AS `status`
            FROM broadcast b
            LEFT JOIN broadcast_status bs ON (bs.id = b.id_status)
            LEFT JOIN user u ON (u.id = b.id_sales)
            LEFT JOIN channel c ON (c.id = b.id_channel)
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

<?php

namespace app\modules\broadcasts\models;

use Yii;
use app\models\UserGrup as Role;
use yii\base\Model;
use yii\data\SqlDataProvider;

/**
 * BroadcastConfigSearch represents the model behind the search form of `app\modules\broadcasts\models\BroadcastConfig`.
 */
class BroadcastConfigSearch extends BroadcastConfig
{
    public $name;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string'],
            [['name'], 'safe'],
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
        $bound = [
            ':unitID' => Yii::$app->user->identity->id_unit,
            ':status' => $this::IS_NOT_DELETED
        ];
        $where = ' WHERE bc.id_unit = :unitID AND bc.is_deleted = :status';

        $this->load($params);

        if ($this->name) {
            $where .= ' AND (u.nama LIKE :name)';
            $bound[':name'] = "%{$this->name}%";
        }

        $count = Yii::$app->db->createCommand('SELECT COUNT(*)
            FROM broadcast_config bc
            LEFT JOIN user u ON (u.id = bc.id_sales)'
            . $where, $bound)->queryScalar();
        $sql = "SELECT bc.id, u.id AS sales_id, u.nama
            FROM broadcast_config bc
            LEFT JOIN user u ON (u.id = bc.id_sales)
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

    public static function getConfigBySalesID($salesID)
    {
        $sql = "SELECT bc.greeting, bc.closing
            FROM broadcast_config bc
            WHERE bc.id_sales = :salesID";

        $data = Yii::$app->db->createCommand($sql, [
            ':salesID' => $salesID
        ])->queryOne();

        return $data;
    }
}

<?php

namespace app\modules\broadcasts\models;

use Yii;
use app\models\UserGrup as Role;
use app\modules\broadcasts\models\BroadcastLog;
use yii\base\Model;
use yii\data\SqlDataProvider;

/**
 * BroadcastLogSearch represents the model behind the search form of `app\modules\broadcasts\models\BroadcastLog`.
 */
class BroadcastLogSearch extends BroadcastLog
{
    public $name;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_broadcast', 'id_status'], 'integer'],
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
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $bound = [
            ':unitID' => Yii::$app->user->identity->id_unit,
            ':status' => $this::IS_NOT_DELETED
        ];
        $where = ' WHERE u.id_unit = :unitID AND u.is_deleted = :status';

        $this->load($params);

        if ($this->name) {
            $where .= ' AND (u.nama LIKE :name)';
            $bound[':name'] = "%{$this->nama}%";
        }

        if (Yii::$app->user->identity->id_grup == Role::SALES) {
            $where .= ' AND u.id = :salesID';
            $bound[':salesID'] = Yii::$app->user->identity->id;
        }

        $count = Yii::$app->db->createCommand('SELECT COUNT(*)
            FROM broadcast_log bl
            LEFT JOIN broadcast b ON (b.id = bl.id_broadcast)
            LEFT JOIN user u ON (u.id = b.id_sales)'
            . $where, $bound)->queryScalar();
        $sql = "SELECT bl.*, b.kode, u.nama AS sales_name
            FROM broadcast_log bl
            LEFT JOIN broadcast b ON (b.id = bl.id_broadcast)
            LEFT JOIN user u ON (u.id = b.id_sales)
            {$where}";

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
}

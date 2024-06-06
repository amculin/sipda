<?php

namespace app\modules\broadcasts\models;

use Yii;
use app\models\UserGrup as Role;
use yii\base\Model;
use yii\data\SqlDataProvider;
use yii\helpers\ArrayHelper;

/**
 * ChannelSearch represents the model behind the search form of `app\modules\broadcasts\models\Channel`.
 */
class ChannelSearch extends Channel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama'], 'safe'],
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
        $where = ' WHERE c.id_unit = :unitID AND c.is_deleted = :status';

        $this->load($params);

        if ($this->nama) {
            $where .= ' AND (c.nama LIKE :name)';
            $bound[':name'] = "%{$this->nama}%";
        }

        if (Yii::$app->user->identity->id_grup == Role::SALES) {
            $where .= ' AND c.id_sales = :salesID';
            $bound[':salesID'] = Yii::$app->user->identity->id;
        }

        $count = Yii::$app->db->createCommand('SELECT COUNT(*) FROM channel c' . $where, $bound)->queryScalar();
        $sql = "SELECT c.id, c.nama, c.keterangan, u.nama AS sales_name,
                (SELECT COUNT(*) FROM `channel_detail` cd WHERE cd.id_channel = c.id) AS `total`
            FROM channel c
            LEFT JOIN user u ON (u.id = c.id_sales)
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
    
    public static function getList()
    {
        $bound = [
            ':unitID' => Yii::$app->user->identity->id_unit,
            ':status' => parent::IS_NOT_DELETED
        ];
        $additionalFilter = '';

        if (Yii::$app->user->identity->id_grup == Role::SALES) {
            $additionalFilter = ' AND id_sales = :salesID';
            $bound[':salesID'] = Yii::$app->user->identity->id;
        }

        $sql = "SELECT id, nama FROM `channel`
            WHERE id_unit = :unitID AND is_deleted = :status{$additionalFilter}
            ORDER BY nama ASC";

        $data = Yii::$app->db->createCommand($sql, $bound)->queryAll();

        return ArrayHelper::map($data, 'id', 'nama');
    }

    public static function getDetailChannelByID($id) {
        $sql = 'SELECT c.nama
            FROM channel c
            WHERE c.id = :channelID';

        $data = Yii::$app->db->createCommand($sql, [
            ':channelID' => $id
        ])->queryOne();

        return $data;
    }
}

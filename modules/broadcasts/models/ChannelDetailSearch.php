<?php

namespace app\modules\broadcasts\models;

use Yii;
use yii\base\Model;
use yii\data\SqlDataProvider;
use app\modules\broadcasts\models\ChannelDetail;

/**
 * ChannelDetailSearch represents the model behind the search form of `app\modules\broadcasts\models\ChannelDetail`.
 */
class ChannelDetailSearch extends ChannelDetail
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_channel', 'id_lead'], 'integer'],
            [['timestamp'], 'safe'],
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
    public function search($channelID)
    {
        $bound = [
            ':status' => $this::IS_NOT_DELETED,
            ':channelID' => $channelID
        ];
        $where = ' WHERE c.id_channel = :channelID AND c.is_deleted = :status';

        $count = Yii::$app->db->createCommand('SELECT COUNT(*) FROM channel_detail c' . $where, $bound)->queryScalar();
        $sql = "SELECT c.id, l.nama_klien, l.nomor_telepon, l.email, l.nama_perusahaan
            FROM `channel_detail` c
            LEFT JOIN `lead` l ON (l.id = c.id_lead)
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

    public static function getContactByChannel($channelID)
    {
        $sql = "SELECT l.nama_klien, l.email, l.nama_perusahaan
            FROM `channel_detail` cd
            RIGHT JOIN `lead` l ON (l.id = cd.id_lead)
            WHERE cd.id_channel = :channelID AND cd.is_deleted = :status";

        $bound = [
            ':channelID' => $channelID,
            ':status' => self::IS_NOT_DELETED
        ];
        return Yii::$app->db->createCommand($sql, $bound)->queryAll();
    }
}

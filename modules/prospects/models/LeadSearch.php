<?php

namespace app\modules\prospects\models;

use Yii;
use yii\base\Model;
use yii\data\SqlDataProvider;
use yii\helpers\ArrayHelper;
use app\models\UserGrup as Role;
use app\modules\prospects\models\Lead;

/**
 * LeadSearch represents the model behind the search form of `app\modules\prospects\models\Lead`.
 */
class LeadSearch extends Lead
{
    public $nama;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_sales', 'id_tahapan', 'year'], 'integer'],
            [['nama', 'id_sales', 'id_tahapan', 'year'], 'safe'],
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

        $where = ' WHERE l.id_unit = :unitID AND l.is_deleted = :status';

        $this->load($params);

        if ((Yii::$app->user->identity->id_grup == Role::SALES) || ($this->id_sales)) {
            $salesID = (Yii::$app->user->identity->id_grup == Role::SALES) ? Yii::$app->user->identity->id
                : $this->id_sales;
            $where .= ' AND l.id_sales = :salesID';
            $bound[':salesID'] = $salesID;
        }

        if ($this->nama) {
            $where .= ' AND (u.nama LIKE :name OR l.nama_perusahaan LIKE :name)';
            $bound[':name'] = "%{$this->nama}%";
        }

        if ($this->id_tahapan) {
            $where .= ' AND l.id_tahapan = :stepID';
            $bound[':stepID'] = $this->id_tahapan;
        }

        if ($this->year) {
            $where .= ' AND l.year = :year';
            $bound[':year'] = $this->year;
        }

        $count = Yii::$app->db->createCommand('SELECT COUNT(*) FROM `lead` l
            LEFT JOIN `user` u ON (u.id = l.id_sales)' . $where, $bound)->queryScalar();
        $sql = "SELECT l.id, l.kode, l.nama_perusahaan, l.kebutuhan, l.id_tahapan, l.nilai, u.nama,
                t.nama AS `step`, t.warna, t.icon
            FROM `lead` l
            LEFT JOIN `user` u ON (u.id = l.id_sales)
            LEFT JOIN `tahapan` t ON (t.id = l.id_tahapan)
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
        $sql = "SELECT l.counter
            FROM `lead` l
            WHERE l.year = :year
            ORDER BY l.id DESC
            LIMIT 1";

        $data = Yii::$app->db->createCommand($sql, [
            ':year' => $year
        ])->queryScalar();

        return ($data === false) ? 1 : ($data + 1);
    }

    public static function createUniqueCode($lastCounter)
    {
        return 'PK' . date('Y') . '-' . str_pad($lastCounter, 5, '0', STR_PAD_LEFT);
    }

    public static function getLeadByID($id)
    {
        return self::findOne($id);
    }

    public static function getEvent($id)
    {
        $sql = 'SELECT l.id, l.id_program, p.nama, p.tanggal_mulai, p.tanggal_selesai
            FROM `lead` l
            RIGHT JOIN `program` p ON (p.id = l.id_program)
            WHERE l.id = :leadID';

        $data = Yii::$app->db->createCommand($sql, [
            ':leadID' => $id
        ])->queryOne();

        return $data;
    }

    public static function getDetailLeadByID($id) {
        $sql = 'SELECT l.id, l.nama_klien, l.nomor_telepon, l.email, l.nama_perusahaan, l.kebutuhan,
                l.id_tahapan, p.nama AS event_name
            FROM `lead` l
            LEFT JOIN `program` p ON (p.id = l.id_program)
            WHERE l.id = :leadID';

        $data = Yii::$app->db->createCommand($sql, [
            ':leadID' => $id
        ])->queryOne();

        return $data;
    }

    public static function getContactsByChannelID($id) {
        $sql = "SELECT l.id, CONCAT_WS(' - ', l.nama_klien, l.nama_perusahaan) AS `contact`
            FROM `lead` l
            WHERE l.id NOT IN (
                SELECT cd.id_lead FROM channel_detail cd
                WHERE cd.id_channel = :channelID AND cd.is_deleted = :status
            ) AND l.is_deleted = :status";
        
        $data = Yii::$app->db->createCommand($sql, [
            ':channelID' => $id,
            ':status' => self::IS_NOT_DELETED
        ])->queryAll();

        return ArrayHelper::map($data, 'id', 'contact');
    }

    public static function getList() {
        $bound = [
            ':unitID' => Yii::$app->user->identity->id_unit,
            ':status' => self::IS_NOT_DELETED
        ];
        $where = 'l.id_unit = :unitID AND l.is_deleted = :status';
        
        if ((Yii::$app->user->identity->id_grup == Role::SALES)) {
            $salesID = Yii::$app->user->identity->id;
            $where .= ' AND l.id_sales = :salesID';
            $bound[':salesID'] = $salesID;
        }
        $sql = "SELECT l.id, CONCAT_WS(' - ', l.nama_klien, l.nama_perusahaan) AS `name`
            FROM `lead` l
            WHERE {$where}";
        
        $data = Yii::$app->db->createCommand($sql, $bound)->queryAll();

        return ArrayHelper::map($data, 'id', 'name');
    }

    public function getLastLeads()
    {
        return $this::find()->select('id, nama_perusahaan, kebutuhan, timestamp')
            ->where(['id_sales' => Yii::$app->user->identity->id])
            ->andWhere(['is_deleted' => $this::IS_NOT_DELETED])
            ->with('aktivitas')
            ->limit(5)
            ->all();
    }

    public function getLastActivities($leadID)
    {
        $sql = 'SELECT a.*
                FROM aktivitas a
                WHERE a.id_lead = :leadID
                ORDER BY a.id DESC
                LIMIT 1';
        return Yii::$app->db->createCommand($sql, [':leadID' => $leadID])->queryOne();
    }
}

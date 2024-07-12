<?php

namespace app\modules\clients\models;

use Yii;
use yii\base\Model;
use yii\data\SqlDataProvider;
use yii\helpers\ArrayHelper;
use app\models\UserGrup as Role;

/**
 * KlienSearch represents the model behind the search form of `app\modules\clients\models\Klien`.
 */
class KlienSearch extends Klien
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_unit', 'id_sales', 'is_disabled', 'is_deleted'], 'integer'],
            [['nama', 'nama_perusahaan', 'is_disabled'], 'safe'],
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
        $where = ' WHERE k.id_unit = :unitID AND k.is_deleted = :status';

        $this->load($params);

        if ($this->nama) {
            $where .= ' AND (k.nama LIKE :name OR k.nama_perusahaan LIKE :name)';
            $bound[':name'] = "%{$this->nama}%";
        }

        if (in_array($this->is_disabled, [0, 1]) && !is_null($this->is_disabled)) {
            $where .= ' AND k.is_disabled = :isDisabled';
            $bound[':isDisabled'] = $this->is_disabled;
        }

        if ((Yii::$app->user->identity->id_grup == Role::SALES) || ($this->id_sales)) {
            $salesID = (Yii::$app->user->identity->id_grup == Role::SALES) ? Yii::$app->user->identity->id
                : $this->id_sales;
            $where .= ' AND k.id_sales = :salesID';
            $bound[':salesID'] = $salesID;
        }

        $count = Yii::$app->db->createCommand('SELECT COUNT(*) FROM klien k' . $where, $bound)->queryScalar();
        $sql = "SELECT k.id, k.nama, k.nama_perusahaan, k.alamat, k.nomor_telepon, k.email, k.is_disabled
            FROM klien k
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

    public static function getStatusList()
    {
        return [
            parent::IS_ACTIVE => 'Aktif',
            parent::IS_INACTIVE => 'Non Aktif'
        ];
    }

    public static function getDetailClientByID($id)
    {
        $sql = 'SELECT c.nama, c.nama_perusahaan, c.nomor_telepon, c.email
            FROM klien c
            WHERE c.id = :id';

        $data = Yii::$app->db->createCommand($sql, [
            ':id' => $id
        ])->queryOne();

        return $data;
    }
}

<?php

namespace app\modules\references\models;

use Yii;
use yii\base\Model;
use yii\data\SqlDataProvider;
use yii\helpers\ArrayHelper;
use app\modules\references\models\Produk;

/**
 * ProdukSearch represents the model behind the search form of `app\modules\references\models\Produk`.
 */
class ProdukSearch extends Produk
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_kategori', 'jumlah_stock', 'prosentase_komisi', 'is_deleted'], 'integer'],
            [['kode', 'nama'], 'safe'],
            [['harga_pokok', 'harga_jual', 'nominal_komisi'], 'number'],
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

        if ($this->nama) {
            $where .= ' AND p.nama LIKE :name';
            $bound[':name'] = "%{$this->nama}%";
        }

        $count = Yii::$app->db->createCommand('SELECT COUNT(*) FROM produk p' . $where, $bound)->queryScalar();
        $sql = "SELECT p.id, p.kode, p.nama, p.harga_pokok, p.harga_jual, p.jumlah_stock, k.nama AS `category` FROM produk p
            LEFT JOIN kategori k ON (k.id = p.id_kategori)
            {$where}
            ORDER BY k.nama ASC, p.nama ASC";

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

    public static function getList() {
        $sql = "SELECT p.id, CONCAT_WS(' - ', k.nama, p.kode, p.nama) AS `name`
            FROM `produk` p
            LEFT join `kategori` k ON (k.id = p.id_kategori)
            WHERE p.id_unit = :unitID AND p.is_deleted = :status
            ORDER BY k.nama ASC, p.nama ASC";
        
        $data = Yii::$app->db->createCommand($sql, [
            ':unitID' => Yii::$app->user->identity->id_unit,
            ':status' => self::IS_NOT_DELETED
        ])->queryAll();

        return ArrayHelper::map($data, 'id', 'name');
    }

    public static function getDetailProductByID($id) {
        $sql = 'SELECT p.kode, p.nama, p.harga_jual, k.nama AS `category`
            FROM `produk` p
            LEFT JOIN `kategori` k ON (k.id = p.id_kategori)
            WHERE p.id = :productID';

        $data = Yii::$app->db->createCommand($sql, [
            ':productID' => $id
        ])->queryOne();

        return $data;
    }
}

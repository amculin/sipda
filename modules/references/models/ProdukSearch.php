<?php

namespace app\modules\references\models;

use Yii;
use yii\base\Model;
use yii\data\SqlDataProvider;
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

        $count = Yii::$app->db->createCommand('SELECT COUNT(*) FROM kategori p' . $where, $bound)->queryScalar();
        $sql = "SELECT p.id, p.kode, p.nama, p.harga_pokok, p.harga_jual, p.jumlah_stock, k.nama AS `category` FROM produk p
                LEFT JOIN kategori k ON (k.id = p.id_kategori)
        {$where}";

        $config = [
            'sql' => $sql,
            'params' => $bound,
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => 15,
            ],
        ];

        $provider = new SqlDataProvider($config);

        return $provider;
    }
}

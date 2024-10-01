<?php

namespace app\modules\sales\models;

use Yii;
use app\customs\FCurrency;
use app\modules\references\models\Produk;

/**
 * This is the model class for table "so_detail".
 *
 * @property int $id
 * @property int $id_so
 * @property int $id_produk
 * @property string $kode_produk
 * @property string $nama_produk
 * @property string $nama_kategori
 * @property float $harga_jual
 * @property float $harga
 * @property int $jumlah
 * @property float|null $diskon
 *
 * @property Produk $produk
 * @property SalesOrder $so
 */
class SalesOrderDetail extends \yii\db\ActiveRecord
{
    use FCurrency;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'so_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_so', 'id_produk', 'kode_produk', 'nama_produk', 'nama_kategori', 'harga_jual', 'harga', 'jumlah'], 'required'],
            [['id_so', 'id_produk', 'jumlah'], 'integer'],
            [['harga_jual', 'harga', 'diskon'], 'number'],
            [['kode_produk'], 'string', 'max' => 32],
            [['nama_produk', 'nama_kategori'], 'string', 'max' => 128],
            [['id_so'], 'exist', 'skipOnError' => true, 'targetClass' => SalesOrder::class, 'targetAttribute' => ['id_so' => 'id']],
            [['id_produk'], 'exist', 'skipOnError' => true, 'targetClass' => Produk::class, 'targetAttribute' => ['id_produk' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_so' => 'Id So',
            'id_produk' => 'Id Produk',
            'kode_produk' => 'Kode Produk',
            'nama_produk' => 'Nama Produk',
            'nama_kategori' => 'Nama Kategori',
            'harga_jual' => 'Harga Jual',
            'harga' => 'Harga',
            'jumlah' => 'Jumlah',
            'diskon' => 'Diskon',
        ];
    }

    /**
     * Gets query for [[Produk]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduk()
    {
        return $this->hasOne(Produk::class, ['id' => 'id_produk']);
    }

    /**
     * Gets query for [[So]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSo()
    {
        return $this->hasOne(SalesOrder::class, ['id' => 'id_so']);
    }

    public function getPrice()
    {
        return (int) $this->harga;
    }
    
    public function setPrice($value)
    {
        $this->price = $value;
    }

    public function getDiscount()
    {
        return (int) $this->diskon;
    }

    public function setDiscount($value)
    {
        $this->discount = $value;
    }

    public static function getOrderedProducts(int $salesID, int $month, int $year)
    {
        $month = str_pad((string) $month, 2, '0', STR_PAD_LEFT);
        $sql = "SELECT sd.kode_produk, sd.nama_produk, sd.nama_kategori, sd.harga_jual, sd.harga, sd.jumlah,
                sd.diskon, so.tanggal, so.kode
            FROM so_detail sd
            LEFT JOIN so ON (so.id = sd.id_so)
            LEFT JOIN `lead` l ON (so.id_lead = l.id)
            WHERE so.tanggal LIKE :date AND l.id_sales = :salesID AND so.is_verified = :isVerified
            ORDER BY so.kode ASC, sd.nama_produk ASC";
        
        $bound = [
            ':date' => $year . '-' . $month . '%',
            ':salesID' => $salesID,
            ':isVerified' => SalesOrder::IS_VERIFIED
        ];

        return Yii::$app->db->createCommand($sql, $bound)->queryAll();
    }
}

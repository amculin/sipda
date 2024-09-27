<?php

namespace app\modules\sales\models;

use Yii;
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
}

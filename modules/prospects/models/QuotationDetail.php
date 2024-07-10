<?php

namespace app\modules\prospects\models;

use Yii;
use app\modules\references\models\Produk;
use app\modules\prospects\models\Quotation;

/**
 * This is the model class for table "quotation_detail".
 *
 * @property int $id
 * @property int $id_quotation
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
 * @property Quotation $quotation
 */
class QuotationDetail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'quotation_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_quotation', 'id_produk', 'kode_produk', 'nama_produk', 'nama_kategori', 'harga_jual', 'harga', 'jumlah'], 'required'],
            [['id_quotation', 'id_produk', 'jumlah'], 'integer'],
            [['harga_jual', 'harga', 'diskon'], 'number'],
            [['kode_produk'], 'string', 'max' => 32],
            [['nama_produk', 'nama_kategori'], 'string', 'max' => 128],
            [['id_quotation'], 'exist', 'skipOnError' => true, 'targetClass' => Quotation::class, 'targetAttribute' => ['id_quotation' => 'id']],
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
            'id_quotation' => 'Id Quotation',
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
     * Gets query for [[Quotation]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuotation()
    {
        return $this->hasOne(Quotation::class, ['id' => 'id_quotation']);
    }
}

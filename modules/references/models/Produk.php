<?php

namespace app\modules\references\models;

use Yii;
use app\modules\prospects\models\QuotationDetail;
use app\modules\sales\models\SalesOrderDetail;

/**
 * This is the model class for table "produk".
 *
 * @property int $id
 * @property int $id_kategori
 * @property string $kode
 * @property string $nama
 * @property float $harga_pokok
 * @property float $harga_jual
 * @property int $jumlah_stock
 * @property int $prosentase_komisi
 * @property float $nominal_komisi
 * @property int $is_deleted
 *
 * @property Kategori $kategori
 * @property QuotationDetail[] $quotationDetails
 * @property SalesOrderDetail[] $soDetails
 */
class Produk extends \yii\db\ActiveRecord
{
    const IS_DELETED = 1;
    const IS_NOT_DELETED = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'produk';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_kategori', 'kode', 'nama'], 'required'],
            [['id_kategori', 'jumlah_stock', 'prosentase_komisi', 'is_deleted'], 'integer'],
            [['harga_pokok', 'harga_jual', 'nominal_komisi'], 'number'],
            [['kode'], 'string', 'max' => 32],
            [['nama'], 'string', 'max' => 128],
            [['id_kategori'], 'exist', 'skipOnError' => true, 'targetClass' => Kategori::class, 'targetAttribute' => ['id_kategori' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_kategori' => 'Kategori',
            'kode' => 'Kode Produk',
            'nama' => 'Nama Produk',
            'harga_pokok' => 'Harga Pokok',
            'harga_jual' => 'Harga Jual',
            'jumlah_stock' => 'Jumlah Stock',
            'prosentase_komisi' => 'Prosentase Komisi',
            'nominal_komisi' => 'Nominal Komisi',
            'is_deleted' => 'Is Deleted',
        ];
    }

    /**
     * Gets query for [[Kategori]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKategori()
    {
        return $this->hasOne(Kategori::class, ['id' => 'id_kategori']);
    }

    /**
     * Gets query for [[QuotationDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuotationDetails()
    {
        return $this->hasMany(QuotationDetail::class, ['id_produk' => 'id']);
    }

    /**
     * Gets query for [[SoDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSalesOrderDetails()
    {
        return $this->hasMany(SalesOrderDetail::class, ['id_produk' => 'id']);
    }

    public function beforeValidate()
    {
        parent::beforeValidate();

        if ($this->isNewRecord) {
            $this->id_unit = Yii::$app->user->identity->id_unit;
        }

        return true;
    }
}

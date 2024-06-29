<?php

namespace app\modules\prospects\models;

use Yii;
use app\models\Unit;
use app\modules\references\models\Tahapan;

/**
 * This is the model class for table "quotation".
 *
 * @property int $id
 * @property int $id_unit
 * @property int $id_lead
 * @property int $id_tahapan
 * @property string $kode
 * @property string $tanggal
 * @property string $nama_klien
 * @property string $nama_perusahaan
 * @property string $nomor_telepon
 * @property string $email
 * @property string|null $isi
 * @property float|null $sub_total
 * @property float|null $pajak
 * @property float|null $diskon
 * @property string|null $penutup
 * @property int $is_verified
 * @property string $timestamp
 * @property int $is_deleted
 * @property string $year
 * @property int $counter
 *
 * @property Lead $lead
 * @property QuotationDetail[] $quotationDetails
 * @property Tahapan $tahapan
 * @property Unit $unit
 */
class Quotation extends \yii\db\ActiveRecord
{
    const IS_NOT_DELETED = 0;
    const IS_DELETED = 1;

    public $produk;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'quotation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_unit', 'id_lead', 'id_tahapan', 'kode', 'tanggal', 'nama_klien', 'nama_perusahaan', 'nomor_telepon', 'email', 'year', 'counter'], 'required'],
            [['id_unit', 'id_lead', 'id_tahapan', 'is_verified', 'is_deleted', 'counter'], 'integer'],
            [['tanggal', 'timestamp', 'year', 'produk'], 'safe'],
            [['isi', 'penutup'], 'string'],
            [['sub_total', 'pajak', 'diskon'], 'number'],
            [['kode'], 'string', 'max' => 12],
            [['nama_klien', 'nama_perusahaan'], 'string', 'max' => 128],
            [['nomor_telepon', 'email'], 'string', 'max' => 64],
            [['id_unit'], 'exist', 'skipOnError' => true, 'targetClass' => Unit::class, 'targetAttribute' => ['id_unit' => 'id']],
            [['id_lead'], 'exist', 'skipOnError' => true, 'targetClass' => Lead::class, 'targetAttribute' => ['id_lead' => 'id']],
            [['id_tahapan'], 'exist', 'skipOnError' => true, 'targetClass' => Tahapan::class, 'targetAttribute' => ['id_tahapan' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_unit' => 'Id Unit',
            'id_lead' => 'Id Lead',
            'id_tahapan' => 'ID Tahapan',
            'kode' => 'Kode',
            'tanggal' => 'Tanggal',
            'nama_klien' => 'Nama Klien',
            'nama_perusahaan' => 'Nama Perusahaan',
            'nomor_telepon' => 'Nomor Telepon',
            'email' => 'Email',
            'isi' => 'Isi',
            'sub_total' => 'Sub Total',
            'pajak' => 'Pajak',
            'diskon' => 'Diskon',
            'penutup' => 'Penutup',
            'is_verified' => 'Is Verified',
            'timestamp' => 'Timestamp',
            'is_deleted' => 'Is Deleted', 
            'year' => 'Year',
            'counter' => 'Counter'
        ];
    }

    /**
     * Gets query for [[Lead]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLead()
    {
        return $this->hasOne(Lead::class, ['id' => 'id_lead']);
    }

    /**
     * Gets query for [[QuotationDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuotationDetails()
    {
        return $this->hasMany(QuotationDetail::class, ['id_quotation' => 'id']);
    }

    /**
     * Gets query for [[Tahapan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTahapan()
    {
        return $this->hasOne(Tahapan::class, ['id' => 'id_tahapan']);
    }

    /**
     * Gets query for [[Unit]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUnit()
    {
        return $this->hasOne(Unit::class, ['id' => 'id_unit']);
    }

    /**
     * @inheritdoc
    */
    public function beforeValidate()
    {
        parent::beforeValidate();

        if ($this->isNewRecord) {
            $this->id_unit = Yii::$app->user->identity->id_unit;

            $this->counter = QuotationSearch::getLastCounter();
            $this->tanggal = date('Y-m-d');
            $this->year = date('Y');
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            foreach ($this->produk as $key => $val) {
                $product = new QuotationDetail();
                $product->id_quotation = $this->id;
                $product->id_produk = $val['product_id'];
                $product->kode_produk = $val['product_code'];
                $product->nama_produk = $val['product_name'];
                $product->nama_kategori = $val['product_category'];
                $product->harga_jual = $val['product_base_price'];
                $product->harga = $val['product_price'];
                $product->jumlah = $val['product_quantity'];
                $product->diskon = $val['product_discount'];

                $product->save();
            }

            $activity = new Aktivitas();
            $activity->id_lead = $this->id_lead;
            $activity->id_tahapan = $this->id_tahapan;
            $activity->tanggal = $this->tanggal;
            $activity->lokasi = '-';
            $activity->aktivitas = 'Quotation - ' . $this->kode;
            $activity->progres = number_format(($this->sub_total - $this->diskon), 0, ',', '.');
            $activity->id_status = AktivitasStatus::OPEN;

            $activity->save();
        } else {
            foreach ($this->produk as $key => $val) {
                if ($val['id'] == '') {
                    $product = new QuotationDetail();
                    $product->id_quotation = $this->id;
                    $product->id_produk = $val['product_id'];
                    $product->kode_produk = $val['product_code'];
                    $product->nama_produk = $val['product_name'];
                    $product->nama_kategori = $val['product_category'];
                    $product->harga_jual = $val['product_base_price'];
                    $product->harga = $val['product_price'];
                    $product->jumlah = $val['product_quantity'];
                    $product->diskon = $val['product_discount'];

                    $product->save();
                }
            }
        }
    }
}

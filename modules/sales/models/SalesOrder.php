<?php

namespace app\modules\sales\models;

use Yii;
use app\customs\FCurrency;
use app\models\Unit;
use app\modules\prospects\models\Lead;
use app\modules\prospects\models\Quotation;

/**
 * This is the model class for table "so".
 *
 * @property int $id
 * @property int $id_quotation
 * @property int $id_unit
 * @property int $id_lead
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
 * @property int $is_deleted
 * @property int $is_verified
 * @property int $counter
 * @property string $timestamp
 * @property string $year
 *
 * @property Lead $lead
 * @property Quotation $quotation
 * @property SalesOrderDetail[] $soDetails
 * @property Unit $unit
 */
class SalesOrder extends \yii\db\ActiveRecord
{
    use FCurrency;

    const IS_NOT_DELETED = 0;
    const IS_DELETED = 1;

    const IS_REJECTED = 0;
    const IS_VERIFIED = 1;

    const APPROVAL_SCENARIO = 'approval-scenario';
    const UPDATE_SCENARIO = 'update-scenario';
    const SOFT_DELETE_SCENARIO = 'soft-delete-scenario';

    public $product;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'so';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'id_quotation', 'id_unit', 'id_lead', 'kode', 'tanggal', 'nama_klien', 'nama_perusahaan',
                    'nomor_telepon', 'email', 'counter', 'year'
                ], 'required'
            ],
            [
                ['is_verified'], 'required', 'on' => self::APPROVAL_SCENARIO
            ],
            [
                ['is_deleted'], 'required', 'on' => self::SOFT_DELETE_SCENARIO
            ],
            [['id_quotation', 'id_unit', 'id_lead', 'is_deleted', 'is_verified', 'counter'], 'integer'],
            [['tanggal', 'timestamp', 'year', 'product'], 'safe'],
            [['isi', 'penutup'], 'string'],
            [['sub_total', 'pajak', 'diskon'], 'number'],
            [['kode', 'nomor_telepon', 'email'], 'string', 'max' => 64],
            [['nama_klien', 'nama_perusahaan'], 'string', 'max' => 128],
            [
                ['id_quotation'], 'exist', 'skipOnError' => true, 'targetClass' => Quotation::class,
                'targetAttribute' => ['id_quotation' => 'id']
            ],
            [
                ['id_unit'], 'exist', 'skipOnError' => true, 'targetClass' => Unit::class,
                'targetAttribute' => ['id_unit' => 'id']
            ],
            [
                ['id_lead'], 'exist', 'skipOnError' => true, 'targetClass' => Lead::class,
                'targetAttribute' => ['id_lead' => 'id']
            ],
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
            'id_unit' => 'Id Unit',
            'id_lead' => 'Id Lead',
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
            'is_deleted' => 'Is Deleted',
            'is_verified' => 'Is Verified',
            'counter' => 'Counter',
            'timestamp' => 'Timestamp',
            'year' => 'Year',
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
     * Gets query for [[Quotation]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuotation()
    {
        return $this->hasOne(Quotation::class, ['id' => 'id_quotation']);
    }

    /**
     * Gets query for [[SoDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSalesOrderDetails()
    {
        return $this->hasMany(SalesOrderDetail::class, ['id_so' => 'id']);
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

    public function getStatus()
    {
        $statuses = [
            $this::IS_REJECTED => 'Rejected',
            $this::IS_VERIFIED => 'Verified'
        ];

        return $statuses[$this->is_verified];
    }
    
    public function setStatus($value)
    {
        $this->status = $value;
    }

    public function getTax()
    {
        return (int) $this->pajak;
    }
    
    public function setTax($value)
    {
        $this->tax = $value;
    }

    /**
     * @inheritdoc
    */
    public function beforeValidate()
    {
        parent::beforeValidate();

        if ($this->isNewRecord) {
            $this->id_unit = Yii::$app->user->identity->id_unit;

            $this->counter = SalesOrderSearch::getLastCounter();
            $this->tanggal = date('Y-m-d');
            $this->year = date('Y');
            $this->sub_total = is_null($this->sub_total) ? 0 : $this->sub_total;
            $this->diskon = is_null($this->diskon) ? 0 : $this->diskon;
        }

        return true;
    }

    public function isApprovalScenario()
    {
        return $this->scenario == $this::APPROVAL_SCENARIO;
    }

    public function isUpdateScenario()
    {
        return $this->scenario == $this::UPDATE_SCENARIO;
    }

    public function isApproved()
    {
        return $this->is_verified == $this::IS_VERIFIED;
    }

    public function countComission()
    {
        $comission = 0;

        foreach ($this->salesOrderDetails as $key => $val) {
            $comission = $comission + (($val->harga - $val->harga_jual) * $val->jumlah - $val->diskon);
        }

        return $comission;
    }

    public function updateProductStock()
    {
        foreach ($this->salesOrderDetails as $key => $val) {
            $val->produk->jumlah_stock = $val->produk->jumlah_stock - $val->jumlah;

            $val->produk->save();
        }
    }

    public function saveOrderDetails()
    {
        if (isset($this->product)) {
            foreach ($this->product as $key => $val) {
                $product = new SalesOrderDetail();
                $product->id_so = $this->id;
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

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            $this->saveOrderDetails();
        } else {
            if ($this->isApprovalScenario()) {
                if ($this->isApproved()) {
                    $this->updateProductStock();
                }
            } elseif ($this->isUpdateScenario()) {
                foreach ($this->product as $key => $val) {
                    if ($val['id'] == '') {
                        $product = new QuotationDetail();
                        $product->id_so = $this->id;
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
}

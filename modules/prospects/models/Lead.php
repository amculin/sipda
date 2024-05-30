<?php

namespace app\modules\prospects\models;

use Yii;
use app\modules\references\models\Program;
use app\modules\references\models\Tahapan;
use app\models\Unit;
use app\models\User;
use app\models\UserGrup as Role;

/**
 * This is the model class for table "lead".
 *
 * @property int $id
 * @property int $id_unit
 * @property int $id_sales
 * @property string $kode
 * @property string $nama_klien
 * @property string $nomor_telepon
 * @property string $email
 * @property string|null $nama_perusahaan
 * @property string $kebutuhan
 * @property int|null $id_program
 * @property int $id_tahapan
 * @property float|null $nilai
 * @property int $is_deleted
 * @property string $timestamp
 * @property string $year
 *
 * @property Aktivitas[] $aktivitas
 * @property ChannelDetail[] $channelDetails
 * @property Channel[] $channels
 * @property LeadHistory[] $leadHistories
 * @property Program $program
 * @property Quotation[] $quotations
 * @property User $sales
 * @property So[] $sos
 * @property Tahapan $tahapan
 * @property Unit $unit
 */
class Lead extends \yii\db\ActiveRecord
{
    const IS_DELETED = 1;
    const IS_NOT_DELETED = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lead';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_unit', 'id_sales', 'kode', 'nama_klien', 'nomor_telepon', 'email', 'kebutuhan', 'id_tahapan', 'year'], 'required'],
            [['id_unit', 'id_sales', 'id_program', 'id_tahapan', 'is_deleted'], 'integer'],
            [['nilai'], 'number'],
            [['timestamp', 'year'], 'safe'],
            [['kode'], 'string', 'max' => 32],
            [['nama_klien', 'nama_perusahaan'], 'string', 'max' => 128],
            [['nomor_telepon', 'email'], 'string', 'max' => 64],
            [['kebutuhan'], 'string', 'max' => 512],
            [['kode'], 'unique'],
            [['id_unit'], 'exist', 'skipOnError' => true, 'targetClass' => Unit::class, 'targetAttribute' => ['id_unit' => 'id']],
            [['id_sales'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_sales' => 'id']],
            [['id_tahapan'], 'exist', 'skipOnError' => true, 'targetClass' => Tahapan::class, 'targetAttribute' => ['id_tahapan' => 'id']],
            [['id_program'], 'exist', 'skipOnError' => true, 'targetClass' => Program::class, 'targetAttribute' => ['id_program' => 'id']],
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
            'id_sales' => 'Nama Sales',
            'kode' => 'Kode Prospek',
            'nama_klien' => 'Nama Kontak',
            'nomor_telepon' => 'Nomor Telepon',
            'email' => 'Email',
            'nama_perusahaan' => 'Nama Perusahaan',
            'kebutuhan' => 'Kebutuhan',
            'id_program' => 'Event Promosi',
            'id_tahapan' => 'Tahapan',
            'nilai' => 'Nilai',
            'is_deleted' => 'Is Deleted',
            'timestamp' => 'Timestamp',
            'year' => 'Year'
        ];
    }

    /**
     * Gets query for [[Aktivitas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAktivitas()
    {
        return $this->hasMany(Aktivitas::class, ['id_lead' => 'id']);
    }

    /**
     * Gets query for [[ChannelDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChannelDetails()
    {
        return $this->hasMany(ChannelDetail::class, ['id_lead' => 'id']);
    }

    /**
     * Gets query for [[Channels]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChannels()
    {
        return $this->hasMany(Channel::class, ['id' => 'id_channel'])->viaTable('channel_detail', ['id_lead' => 'id']);
    }

    /**
     * Gets query for [[LeadHistories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLeadHistories()
    {
        return $this->hasMany(LeadHistory::class, ['id_lead' => 'id']);
    }

    /**
     * Gets query for [[Program]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProgram()
    {
        return $this->hasOne(Program::class, ['id' => 'id_program']);
    }

    /**
     * Gets query for [[Quotations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuotations()
    {
        return $this->hasMany(Quotation::class, ['id_lead' => 'id']);
    }

    /**
     * Gets query for [[Sales]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSales()
    {
        return $this->hasOne(User::class, ['id' => 'id_sales']);
    }

    /**
     * Gets query for [[Sos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSos()
    {
        return $this->hasMany(So::class, ['id_lead' => 'id']);
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

            if (Yii::$app->user->identity->id_grup == Role::SALES) {
                $this->id_sales = Yii::$app->user->identity->id;
            }
            $this->counter = LeadSearch::getLastCounter();
            $this->kode = LeadSearch::createUniqueCode($this->counter);
            $this->id_tahapan = 1;
            $this->year = date('Y');
        }

        return true;
    }
}

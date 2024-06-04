<?php

namespace app\modules\prospects\models;

use Yii;
use app\modules\references\models\Tahapan;

/**
 * This is the model class for table "aktivitas".
 *
 * @property int $id
 * @property int $id_lead
 * @property int $id_tahapan
 * @property string $tanggal
 * @property string $lokasi
 * @property string $aktivitas
 * @property string|null $progres
 * @property int $id_status
 * @property int $is_deleted
 * @property string $timestamp
 *
 * @property Lead $lead
 * @property AktivitasStatus $status
 * @property Tahapan $tahapan
 */
class Aktivitas extends \yii\db\ActiveRecord
{
    const IS_DELETED = 1;
    const IS_NOT_DELETED = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'aktivitas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_lead', 'id_tahapan', 'tanggal', 'lokasi', 'aktivitas', 'id_status'], 'required'],
            [['id_lead', 'id_tahapan', 'id_status', 'is_deleted'], 'integer'],
            [['tanggal', 'timestamp'], 'safe'],
            [['lokasi', 'aktivitas'], 'string', 'max' => 256],
            [['progres'], 'string', 'max' => 512],
            [['id_lead'], 'exist', 'skipOnError' => true, 'targetClass' => Lead::class, 'targetAttribute' => ['id_lead' => 'id']],
            [['id_tahapan'], 'exist', 'skipOnError' => true, 'targetClass' => Tahapan::class, 'targetAttribute' => ['id_tahapan' => 'id']],
            [['id_status'], 'exist', 'skipOnError' => true, 'targetClass' => AktivitasStatus::class, 'targetAttribute' => ['id_status' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_lead' => 'Id Lead',
            'id_tahapan' => 'Id Tahapan',
            'tanggal' => 'Tanggal',
            'lokasi' => 'Lokasi',
            'aktivitas' => 'Aktivitas',
            'progres' => 'Progres',
            'id_status' => 'Id Status',
            'is_deleted' => 'Is Deleted',
            'timestamp' => 'Timestamp',
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
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(AktivitasStatus::class, ['id' => 'id_status']);
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
     * @inheritdoc
    */
    public function beforeValidate()
    {
        parent::beforeValidate();

        if ($this->isNewRecord) {
            $this->tanggal = date('Y-m-d', strtotime($this->tanggal));
        }

        return true;
    }
}

<?php

namespace app\modules\broadcasts\models;

use Yii;
use app\models\Unit;
use app\models\User;

/**
 * This is the model class for table "broadcast".
 *
 * @property int $id
 * @property int $id_unit
 * @property int $id_sales
 * @property string $kode
 * @property int $id_channel
 * @property string $judul
 * @property string|null $greeting
 * @property string $isi
 * @property string|null $closing
 * @property string|null $lampiran
 * @property string|null $schedule
 * @property int $id_status
 * @property int $is_deleted
 * @property string $timestamp
 *
 * @property BroadcastLog[] $broadcastLogs
 * @property Channel $channel
 * @property User $sales
 * @property BroadcastStatus $status
 * @property Unit $unit
 */
class Broadcast extends \yii\db\ActiveRecord
{
    const IS_DELETED = 1;
    const IS_NOT_DELETED = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'broadcast';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_unit', 'id_sales', 'kode', 'id_channel', 'judul', 'isi', 'id_status'], 'required'],
            [['id_unit', 'id_sales', 'id_channel', 'id_status', 'is_deleted'], 'integer'],
            [['isi'], 'string'],
            [['schedule', 'timestamp'], 'safe'],
            [['kode'], 'string', 'max' => 64],
            [['judul', 'lampiran'], 'string', 'max' => 256],
            [['greeting', 'closing'], 'string', 'max' => 512],
            [['kode'], 'unique'],
            [['id_sales'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_sales' => 'id']],
            [['id_status'], 'exist', 'skipOnError' => true, 'targetClass' => BroadcastStatus::class, 'targetAttribute' => ['id_status' => 'id']],
            [['id_channel'], 'exist', 'skipOnError' => true, 'targetClass' => Channel::class, 'targetAttribute' => ['id_channel' => 'id']],
            [['id_unit'], 'exist', 'skipOnError' => true, 'targetClass' => Unit::class, 'targetAttribute' => ['id_unit' => 'id']],
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
            'id_sales' => 'Id Sales',
            'kode' => 'Kode',
            'id_channel' => 'Id Channel',
            'judul' => 'Judul',
            'greeting' => 'Greeting',
            'isi' => 'Isi',
            'closing' => 'Closing',
            'lampiran' => 'Lampiran',
            'schedule' => 'Schedule',
            'id_status' => 'Id Status',
            'is_deleted' => 'Is Deleted',
            'timestamp' => 'Timestamp',
        ];
    }

    /**
     * Gets query for [[BroadcastLogs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBroadcastLogs()
    {
        return $this->hasMany(BroadcastLog::class, ['id_broadcast' => 'id']);
    }

    /**
     * Gets query for [[Channel]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChannel()
    {
        return $this->hasOne(Channel::class, ['id' => 'id_channel']);
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
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(BroadcastStatus::class, ['id' => 'id_status']);
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
}

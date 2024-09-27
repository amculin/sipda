<?php

namespace app\modules\broadcasts\models;

use Yii;

/**
 * This is the model class for table "broadcast_log".
 *
 * @property int $id
 * @property int $id_broadcast
 * @property string $judul
 * @property string $nama_tujuan
 * @property string $email_tujuan
 * @property int $id_status
 * @property string $timestamp
 *
 * @property Broadcast $broadcast
 * @property BroadcastStatus $status
 */
class BroadcastLog extends \yii\db\ActiveRecord
{
    const IS_DELETED = 1;
    const IS_NOT_DELETED = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'broadcast_log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_broadcast', 'judul', 'nama_tujuan', 'email_tujuan', 'id_status'], 'required'],
            [['id_broadcast', 'id_status'], 'integer'],
            [['timestamp'], 'safe'],
            [['judul'], 'string', 'max' => 256],
            [['nama_tujuan'], 'string', 'max' => 128],
            [['email_tujuan'], 'string', 'max' => 64],
            [['id_broadcast'], 'exist', 'skipOnError' => true, 'targetClass' => Broadcast::class, 'targetAttribute' => ['id_broadcast' => 'id']],
            [['id_status'], 'exist', 'skipOnError' => true, 'targetClass' => BroadcastStatus::class, 'targetAttribute' => ['id_status' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_broadcast' => 'Id Broadcast',
            'judul' => 'Judul',
            'nama_tujuan' => 'Nama Tujuan',
            'email_tujuan' => 'Email Tujuan',
            'id_status' => 'Id Status',
            'timestamp' => 'Timestamp',
        ];
    }

    /**
     * Gets query for [[Broadcast]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBroadcast()
    {
        return $this->hasOne(Broadcast::class, ['id' => 'id_broadcast']);
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
}

<?php

namespace app\modules\broadcasts\models;

use Yii;

/**
 * This is the model class for table "broadcast_status".
 *
 * @property int $id
 * @property string $nama
 *
 * @property BroadcastLog[] $broadcastLogs
 * @property Broadcast[] $broadcasts
 */
class BroadcastStatus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'broadcast_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nama'], 'required'],
            [['id'], 'integer'],
            [['nama'], 'string', 'max' => 32],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
        ];
    }

    /**
     * Gets query for [[BroadcastLogs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBroadcastLogs()
    {
        return $this->hasMany(BroadcastLog::class, ['id_status' => 'id']);
    }

    /**
     * Gets query for [[Broadcasts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBroadcasts()
    {
        return $this->hasMany(Broadcast::class, ['id_status' => 'id']);
    }
}

<?php

namespace app\modules\broadcasts\models;

use Yii;

/**
 * This is the model class for table "broadcast_jobs".
 *
 * @property int $id
 * @property int $id_broadcast
 * @property string $destination
 * @property string $subject
 * @property string $content
 * @property int $status 0 = Is Created; 1 = Is Sent; 2 = Is Failed;
 * @property string $send_time
 * @property string $created_time
 *
 * @property Broadcast $broadcast
 */
class BroadcastJobs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'broadcast_jobs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_broadcast', 'destination', 'subject', 'content', 'send_time'], 'required'],
            [['id_broadcast', 'status'], 'integer'],
            [['content'], 'string'],
            [['send_time', 'created_time'], 'safe'],
            [['destination', 'subject'], 'string', 'max' => 255],
            [['id_broadcast'], 'exist', 'skipOnError' => true, 'targetClass' => Broadcast::class, 'targetAttribute' => ['id_broadcast' => 'id']],
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
            'destination' => 'Destination',
            'subject' => 'Subject',
            'content' => 'Content',
            'status' => 'Status',
            'send_time' => 'Send Time',
            'created_time' => 'Created Time',
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
}

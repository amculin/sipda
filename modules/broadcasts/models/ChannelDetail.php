<?php

namespace app\modules\broadcasts\models;

use Yii;
use app\modules\prospects\models\Lead;

/**
 * This is the model class for table "channel_detail".
 *
 * @property int $id
 * @property int $id_channel
 * @property int $id_lead
 * @property int $is_deleted
 * @property string $timestamp
 *
 * @property Channel $channel
 * @property Lead $lead
 */
class ChannelDetail extends \yii\db\ActiveRecord
{
    const IS_DELETED = 1;
    const IS_NOT_DELETED = 0;

    const SCENARIO_CREATE_FROM_LEAD = 'scenario-create-from-lead';
    const SCENARIO_CREATE = 'scenario-create';

    public $lead_collections;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'channel_detail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_channel', 'id_lead'], 'required', 'on' => self::SCENARIO_CREATE],
            [['id_channel', 'lead_collections'], 'required', 'on' => self::SCENARIO_CREATE_FROM_LEAD],
            [['id_channel', 'id_lead', 'is_deleted'], 'integer'],
            [['timestamp'], 'safe'],
            [['id_channel', 'id_lead'], 'unique', 'targetAttribute' => ['id_channel', 'id_lead']],
            [['id_channel'], 'exist', 'skipOnError' => true, 'targetClass' => Channel::class, 'targetAttribute' => ['id_channel' => 'id']],
            [['id_lead'], 'exist', 'skipOnError' => true, 'targetClass' => Lead::class, 'targetAttribute' => ['id_lead' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_channel' => 'Channel',
            'id_lead' => 'Lead',
            'is_deleted' => 'Is Deleted',
            'timestamp' => 'Timestamp',
        ];
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
     * Gets query for [[Lead]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLead()
    {
        return $this->hasOne(Lead::class, ['id' => 'id_lead']);
    }
}

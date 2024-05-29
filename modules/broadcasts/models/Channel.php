<?php

namespace app\modules\broadcasts\models;

use Yii;
use app\models\Unit;
use app\models\User;
use app\models\UserGrup as Role;

/**
 * This is the model class for table "channel".
 *
 * @property int $id
 * @property int $id_unit
 * @property int $id_sales
 * @property string $nama
 * @property string|null $keterangan
 * @property int $is_deleted
 * @property int $timestamp
 *
 * @property ChannelDetail[] $channelDetails
 * @property Lead[] $leads
 * @property User $sales
 * @property Unit $unit
 */
class Channel extends \yii\db\ActiveRecord
{
    const IS_DELETED = 1;
    const IS_NOT_DELETED = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'channel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_unit', 'id_sales', 'nama'], 'required'],
            [['id_unit', 'id_sales', 'is_deleted'], 'integer'],
            [['nama'], 'string', 'max' => 128],
            [['keterangan'], 'string', 'max' => 512],
            [['id_sales'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_sales' => 'id']],
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
            'id_sales' => 'Nama Sales',
            'nama' => 'Nama Channel',
            'keterangan' => 'Keterangan',
            'is_deleted' => 'Is Deleted',
        ];
    }

    /**
     * Gets query for [[ChannelDetails]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChannelDetails()
    {
        return $this->hasMany(ChannelDetail::class, ['id_channel' => 'id']);
    }

    /**
     * Gets query for [[Leads]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLeads()
    {
        return $this->hasMany(Lead::class, ['id' => 'id_lead'])->viaTable('channel_detail', ['id_channel' => 'id']);
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
        }

        return true;
    }
}

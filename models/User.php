<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property int $id_unit
 * @property int $id_grup
 * @property string $username
 * @property string $password
 * @property string|null $auth_key
 * @property string $nama
 * @property string $email
 * @property string|null $jabatan
 * @property int $komisi_jabatan
 * @property int $is_disabled
 * @property string|null $last_login
 * @property string $timestamp
 *
 * @property BroadcastConfig[] $broadcastConfigs
 * @property Broadcast[] $broadcasts
 * @property Channel[] $channels
 * @property UserGrup $grup
 * @property Klien[] $kliens
 * @property Lead[] $leads
 * @property Plan[] $plans
 * @property Unit $unit
 */
class User extends \yii\db\ActiveRecord
{
    const IS_DISABLED = 1;
    const IS_NOT_DISABLED = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_unit', 'id_grup', 'username', 'password', 'nama', 'email'], 'required'],
            [['id_unit', 'id_grup', 'komisi_jabatan', 'is_disabled'], 'integer'],
            [['last_login', 'timestamp'], 'safe'],
            [['username', 'password'], 'string', 'max' => 64],
            [['auth_key', 'nama', 'email', 'jabatan'], 'string', 'max' => 128],
            [['username'], 'unique'],
            [['id_unit'], 'exist', 'skipOnError' => true, 'targetClass' => Unit::class, 'targetAttribute' => ['id_unit' => 'id']],
            [['id_grup'], 'exist', 'skipOnError' => true, 'targetClass' => UserGrup::class, 'targetAttribute' => ['id_grup' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_unit' => 'ID Unit',
            'id_grup' => 'ID Grup',
            'username' => 'Username',
            'password' => 'Password',
            'auth_key' => 'Auth Key',
            'nama' => 'Nama',
            'email' => 'Email',
            'jabatan' => 'Jabatan',
            'komisi_jabatan' => 'Komisi Jabatan',
            'is_disabled' => 'Is Disabled',
            'last_login' => 'Last Login',
            'timestamp' => 'Timestamp',
        ];
    }

    /**
     * Gets query for [[BroadcastConfigs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBroadcastConfigs()
    {
        return $this->hasMany(BroadcastConfig::class, ['id_sales' => 'id']);
    }

    /**
     * Gets query for [[Broadcasts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBroadcasts()
    {
        return $this->hasMany(Broadcast::class, ['id_sales' => 'id']);
    }

    /**
     * Gets query for [[Channels]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChannels()
    {
        return $this->hasMany(Channel::class, ['id_sales' => 'id']);
    }

    /**
     * Gets query for [[Grup]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGrup()
    {
        return $this->hasOne(UserGrup::class, ['id' => 'id_grup']);
    }

    /**
     * Gets query for [[Kliens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKliens()
    {
        return $this->hasMany(Klien::class, ['id_sales' => 'id']);
    }

    /**
     * Gets query for [[Leads]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLeads()
    {
        return $this->hasMany(Lead::class, ['id_sales' => 'id']);
    }

    /**
     * Gets query for [[Plans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPlans()
    {
        return $this->hasMany(Plan::class, ['id_sales' => 'id']);
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

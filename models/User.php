<?php

namespace app\models;

use Yii;
use app\modules\sales\models\Plan;

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
    const SCENARIO_NEW_USER = 'new-user';

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
            [['id_unit', 'id_grup', 'username', 'nama', 'email'], 'required'],
            [['password'], 'required', 'on' => $this::SCENARIO_NEW_USER],
            [['id_unit', 'id_grup', 'komisi_jabatan', 'is_disabled'], 'integer'],
            [['password', 'last_login', 'timestamp'], 'safe'],
            [['username', 'password'], 'string', 'max' => 64],
            [['auth_key', 'nama', 'email', 'jabatan'], 'string', 'max' => 128],
            [['username', 'email'], 'unique'],
            [['email'], 'email'],
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
            'id_unit' => 'Unit',
            'id_grup' => 'Role',
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

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if ($insert) {
            $this->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
        }

        return true;
    }

    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            if ($this->id_grup != 1) {
                for ($i = 1; $i <= 12; $i++) {
                    $plan = new Plan();
                    $plan->id_sales = $this->id;
                    $plan->tahun = date('Y');
                    $plan->bulan = $i;
                    $plan->target_penjualan = 0;
                    $plan->target_komisi = 0;
                    $plan->save();
                }
            }
        }
    }
}

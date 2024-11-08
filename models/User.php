<?php

namespace app\models;

use Yii;
use app\modules\broadcasts\models\BroadcastConfig;
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
 * @property int $is_deleted
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
    const IS_DELETED = 1;
    const IS_NOT_DELETED = 0;

    const SCENARIO_NEW_USER = 'new-user';
    const SCENARIO_SOFT_DELETION = 'soft_deletion';

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
            [['is_deleted'], 'required', 'on' => $this::SCENARIO_SOFT_DELETION],
            [['id_unit', 'id_grup', 'komisi_jabatan', 'is_disabled', 'is_deleted'], 'integer'],
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
            'is_deleted' => 'Is Deleted',
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
            if ($this->id_grup != UserGrup::ADMIN) {
                $plan = new Plan();
                $plan->id_unit = $this->id_unit;
                $plan->id_sales = $this->id;
                $plan->tahun = date('Y');
                $plan->target_penjualan = 0;
                $plan->target_komisi = 0;
                $plan->save();

                $config = new BroadcastConfig();
                $config->id_unit = $this->id_unit;
                $config->id_sales = $this->id;
                $config->greeting = "Kepada Yth. {nama}\ndi {nama_perusahaan}";
                $config->closing = "Kind Regards.";
                $config->save();
            }
        } else {
            if ($this->scenario == $this::SCENARIO_SOFT_DELETION) {
                Yii::$app->db->createCommand('UPDATE plan SET is_deleted = :status WHERE id_sales = :user_id', [
                    ':status' => $this::IS_DELETED,
                    ':user_id' => $this->id
                ])->execute();

                Yii::$app->db->createCommand('UPDATE broadcast_config SET is_deleted = :status WHERE id_sales = :user_id', [
                    ':status' => $this::IS_DELETED,
                    ':user_id' => $this->id
                ])->execute();
            }
        }
    }
}

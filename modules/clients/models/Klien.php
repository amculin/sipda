<?php

namespace app\modules\clients\models;

use Yii;
use app\models\Unit;
use app\models\User;
use app\models\UserGrup as Role;

/**
 * This is the model class for table "klien".
 *
 * @property int $id
 * @property int $id_unit
 * @property int $id_sales
 * @property string $nama
 * @property string|null $nama_perusahaan
 * @property string|null $akronim
 * @property string $alamat
 * @property string $nomor_telepon
 * @property string $email
 * @property string|null $npwp
 * @property string|null $akun_bank
 * @property string|null $siup
 * @property string|null $tdp
 * @property int $is_disabled
 * @property int $is_deleted
 * @property string $timestamp
 *
 * @property KlienKontak[] $klienKontaks
 * @property User $sales
 * @property Unit $unit
 */
class Klien extends \yii\db\ActiveRecord
{
    const IS_NOT_DELETED = 0;
    const IS_DELETED = 1;

    const IS_ACTIVE = 0;
    const IS_INACTIVE = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'klien';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_unit', 'id_sales', 'nama', 'alamat', 'nomor_telepon', 'email'], 'required'],
            [['id_unit', 'id_sales', 'is_disabled', 'is_deleted'], 'integer'],
            [['timestamp'], 'safe'],
            [['nama', 'nama_perusahaan'], 'string', 'max' => 128],
            [['akronim'], 'string', 'max' => 5],
            [['alamat'], 'string', 'max' => 512],
            [['nomor_telepon', 'email', 'npwp', 'akun_bank', 'siup', 'tdp'], 'string', 'max' => 64],
            [['id_unit'], 'exist', 'skipOnError' => true, 'targetClass' => Unit::class, 'targetAttribute' => ['id_unit' => 'id']],
            [['id_sales'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_sales' => 'id']],
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
            'id_sales' => 'Sales',
            'nama' => 'Nama Klien',
            'nama_perusahaan' => 'Nama Perusahaan',
            'akronim' => 'Akronim Perusahaan',
            'alamat' => 'Alamat Perusahaan',
            'nomor_telepon' => 'No. Telefon',
            'email' => 'Email',
            'npwp' => 'NPWP',
            'akun_bank' => 'Akun Bank',
            'siup' => 'SIUP',
            'tdp' => 'TDP',
            'is_disabled' => 'Is Disabled',
            'is_deleted' => 'Is Deleted',
            'timestamp' => 'Timestamp',
        ];
    }

    /**
     * Gets query for [[KlienKontaks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKlienKontaks()
    {
        return $this->hasMany(KlienKontak::class, ['id_klien' => 'id']);
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

<?php

namespace app\modules\clients\models;

use Yii;

/**
 * This is the model class for table "klien_kontak".
 *
 * @property int $id
 * @property int $id_klien
 * @property string $nama
 * @property string $posisi
 * @property string $nomor_telepon
 * @property string|null $email
 * @property int $is_disabled
 * @property int $is_deleted
 * @property string $timestamp
 *
 * @property Klien $klien
 */
class KlienKontak extends \yii\db\ActiveRecord
{
    const IS_NOT_DELETED = 0;
    const IS_DELETED = 1;

    const IS_INACTIVE = 0;
    const IS_ACTIVE = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'klien_kontak';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_klien', 'nama', 'posisi', 'nomor_telepon'], 'required'],
            [['id_klien', 'is_disabled', 'is_deleted'], 'integer'],
            [['timestamp'], 'safe'],
            [['nama', 'posisi'], 'string', 'max' => 128],
            [['nomor_telepon', 'email'], 'string', 'max' => 64],
            [['id_klien'], 'exist', 'skipOnError' => true, 'targetClass' => Klien::class, 'targetAttribute' => ['id_klien' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_klien' => 'Id Klien',
            'nama' => 'Nama',
            'posisi' => 'Posisi',
            'nomor_telepon' => 'Nomor HP',
            'email' => 'Email',
            'is_disabled' => 'Is Disabled',
            'is_deleted' => 'Is Deleted',
            'timestamp' => 'Timestamp',
        ];
    }

    /**
     * Gets query for [[Klien]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKlien()
    {
        return $this->hasOne(Klien::class, ['id' => 'id_klien']);
    }
}

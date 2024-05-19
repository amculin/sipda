<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "unit".
 *
 * @property int $id
 * @property string $kode
 * @property string $nama
 *
 * @property Config[] $configs
 * @property Kategori[] $kategoris
 * @property Klien[] $kliens
 * @property Tahapan[] $tahapans
 * @property User[] $users
 */
class Unit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'unit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'kode', 'nama'], 'required'],
            [['id'], 'integer'],
            [['kode'], 'string', 'max' => 32],
            [['nama'], 'string', 'max' => 100],
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
            'kode' => 'Kode',
            'nama' => 'Nama',
        ];
    }

    /**
     * Gets query for [[Configs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getConfigs()
    {
        return $this->hasMany(Config::class, ['id_unit' => 'id']);
    }

    /**
     * Gets query for [[Kategoris]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKategoris()
    {
        return $this->hasMany(Kategori::class, ['id_unit' => 'id']);
    }

    /**
     * Gets query for [[Kliens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKliens()
    {
        return $this->hasMany(Klien::class, ['id_unit' => 'id']);
    }

    /**
     * Gets query for [[Tahapans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTahapans()
    {
        return $this->hasMany(Tahapan::class, ['id_unit' => 'id']);
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['id_unit' => 'id']);
    }
}

<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_grup".
 *
 * @property int $id
 * @property string $nama
 *
 * @property User[] $users
 */
class UserGrup extends \yii\db\ActiveRecord
{
    const ADMIN = 1;
    const SALES = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_grup';
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
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['id_grup' => 'id']);
    }
}

<?php

namespace app\modules\references\models;

use Yii;
use app\models\Unit;

/**
 * This is the model class for table "kategori".
 *
 * @property int $id
 * @property int $id_unit
 * @property string $nama
 * @property int $is_deleted
 *
 * @property Produk[] $produks
 * @property Unit $unit
 */
class Kategori extends \yii\db\ActiveRecord
{
    const IS_DELETED = 1;
    const IS_NOT_DELETED = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kategori';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_unit', 'nama'], 'required'],
            [['id_unit', 'is_deleted'], 'integer'],
            [['nama'], 'string', 'max' => 128],
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
            'nama' => 'Nama',
            'is_deleted' => 'Is Deleted'
        ];
    }

    /**
     * Gets query for [[Produks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProduks()
    {
        return $this->hasMany(Produk::class, ['id_kategori' => 'id']);
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

    public function beforeValidate()
    {
        parent::beforeValidate();

        if ($this->isNewRecord) {
            $this->id_unit = Yii::$app->user->identity->id_unit;
        }

        return true;
    }
}

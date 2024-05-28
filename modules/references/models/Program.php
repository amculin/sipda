<?php

namespace app\modules\references\models;

use Yii;
use app\models\Unit;

/**
 * This is the model class for table "program".
 *
 * @property int $id
 * @property int $id_unit
 * @property string $kode
 * @property string $nama
 * @property string|null $keterangan
 * @property string|null $lokasi
 * @property string|null $tanggal_mulai
 * @property string|null $tanggal_selesai
 * @property int $counter
 * @property string $year
 * @property int $is_disabled
 * @property int $is_deleted
 * @property string $timestamp
 *
 * @property Lead[] $leads
 * @property Unit $unit
 */
class Program extends \yii\db\ActiveRecord
{
    const IS_DELETED = 1;
    const IS_NOT_DELETED = 0;

    const IS_DISABLED = 1;
    const IS_NOT_DISABLED = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'program';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_unit', 'kode', 'nama', 'counter', 'year', 'tanggal_mulai', 'tanggal_selesai'], 'required'],
            [['id_unit', 'is_disabled', 'is_deleted'], 'integer'],
            [['tanggal_mulai', 'tanggal_selesai', 'timestamp'], 'safe'],
            [['kode'], 'string', 'max' => 32],
            [['nama', 'lokasi'], 'string', 'max' => 128],
            [['keterangan'], 'string', 'max' => 512],
            [['kode'], 'unique'],
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
            'kode' => 'Kode Program / Event',
            'nama' => 'Judul Program / Event',
            'keterangan' => 'Keterangan',
            'lokasi' => 'Lokasi',
            'tanggal_mulai' => 'Tanggal Mulai',
            'tanggal_selesai' => 'Tanggal Selesai',
            'counter' => 'Counter',
            'year' => 'Year',
            'is_disabled' => 'Is Disabled',
            'is_deleted' => 'Is Deleted',
            'timestamp' => 'Timestamp',
        ];
    }

    /**
     * Gets query for [[Leads]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLeads()
    {
        return $this->hasMany(Lead::class, ['id_program' => 'id']);
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
            $this->counter = ProgramSearch::getLastCounter();
            $this->kode = ProgramSearch::createUniqueCode($this->counter);
            $this->year = date('Y');
        }

        return true;
    }
}

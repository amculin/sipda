<?php

namespace app\modules\references\models;

use Yii;
use app\models\Unit;

/**
 * This is the model class for table "tahapan".
 *
 * @property int $id
 * @property int $id_unit
 * @property string $nama
 * @property int $urutan
 * @property string|null $warna
 *
 * @property Aktivitas[] $aktivitas
 * @property LeadHistory[] $leadHistories
 * @property Lead[] $leads
 * @property Quotation[] $quotations
 * @property Unit $unit
 */
class Tahapan extends \yii\db\ActiveRecord
{
    const IS_DELETED = 1;
    const IS_NOT_DELETED = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tahapan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_unit', 'nama'], 'required'],
            [['id_unit', 'urutan'], 'integer'],
            [['nama'], 'string', 'max' => 32],
            [['warna'], 'string', 'max' => 16],
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
            'nama' => 'Nama Tahapan',
            'urutan' => 'Nomor Urut',
            'warna' => 'Warna',
        ];
    }

    /**
     * Gets query for [[Aktivitas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAktivitas()
    {
        return $this->hasMany(Aktivitas::class, ['id_tahapan' => 'id']);
    }

    /**
     * Gets query for [[LeadHistories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLeadHistories()
    {
        return $this->hasMany(LeadHistory::class, ['id_tahapan' => 'id']);
    }

    /**
     * Gets query for [[Leads]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLeads()
    {
        return $this->hasMany(Lead::class, ['id_tahapan' => 'id']);
    }

    /**
     * Gets query for [[Quotations]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuotations()
    {
        return $this->hasMany(Quotation::class, ['id_tahapan' => 'id']);
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

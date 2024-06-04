<?php

namespace app\modules\prospects\models;

use Yii;
use app\modules\references\models\Tahapan;

/**
 * This is the model class for table "lead_history".
 *
 * @property int $id
 * @property int $id_lead
 * @property int $id_tahapan
 * @property float|null $nilai
 * @property string|null $file
 * @property string $timestamp
 *
 * @property Lead $lead
 * @property Tahapan $tahapan
 */
class LeadHistory extends \yii\db\ActiveRecord
{
    public $attachment;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lead_history';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_lead', 'id_tahapan'], 'required'],
            [['id_lead', 'id_tahapan'], 'integer'],
            [['nilai'], 'number'],
            [['timestamp'], 'safe'],
            [['file'], 'string', 'max' => 256],
            [['attachment'], 'file', 'skipOnEmpty' => true, 'extensions' => 'doc, docx, xls, xlsx, rtf, pdf'],
            [['id_lead'], 'exist', 'skipOnError' => true, 'targetClass' => Lead::class, 'targetAttribute' => ['id_lead' => 'id']],
            [['id_tahapan'], 'exist', 'skipOnError' => true, 'targetClass' => Tahapan::class, 'targetAttribute' => ['id_tahapan' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_lead' => 'Id Lead',
            'id_tahapan' => 'Tahapan Prospek',
            'nilai' => 'Nilai',
            'file' => 'File',
            'attachment' => 'Lampiran Dokumen',
            'timestamp' => 'Timestamp',
        ];
    }

    /**
     * Gets query for [[Lead]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLead()
    {
        return $this->hasOne(Lead::class, ['id' => 'id_lead']);
    }

    /**
     * Gets query for [[Tahapan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTahapan()
    {
        return $this->hasOne(Tahapan::class, ['id' => 'id_tahapan']);
    }

    public function upload()
    {
        if ($this->validate()) {
            if ($this->attachment) {
                $this->file = md5($this->attachment->baseName) . '_' . $this->id_lead . '_' . time() . '.' . $this->attachment->extension;
                $this->attachment->saveAs(Yii::getAlias('@app/attachments/' . $this->file), false);
            }
            return true;
        } else {
            return false;
        }
    }
}

<?php

namespace app\modules\broadcasts\models;

use Yii;
use app\models\Unit;
use app\models\User;
use app\models\UserGrup as Role;

/**
 * This is the model class for table "broadcast".
 *
 * @property int $id
 * @property int $id_unit
 * @property int $id_sales
 * @property string $kode
 * @property int $id_channel
 * @property string $judul
 * @property string|null $greeting
 * @property string $isi
 * @property string|null $closing
 * @property string|null $lampiran
 * @property string|null $schedule
 * @property int $id_status
 * @property int $is_deleted
 * @property string $timestamp
 *
 * @property BroadcastLog[] $broadcastLogs
 * @property Channel $channel
 * @property User $sales
 * @property BroadcastStatus $status
 * @property Unit $unit
 */
class Broadcast extends \yii\db\ActiveRecord
{
    const IS_DELETED = 1;
    const IS_NOT_DELETED = 0;

    public $file;
    public $scheduled_date;
    public $scheduled_time;
    public $is_scheduled = false;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'broadcast';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_unit', 'id_sales', 'kode', 'id_channel', 'judul', 'isi', 'isi_html', 'id_status'], 'required'],
            [['id_unit', 'id_sales', 'id_channel', 'id_status', 'is_deleted'], 'integer'],
            [['isi', 'isi_html', 'scheduled_date', 'scheduled_time'], 'string'],
            [['schedule', 'timestamp'], 'safe'],
            [['kode'], 'string', 'max' => 64],
            [['judul', 'lampiran'], 'string', 'max' => 256],
            [['greeting', 'closing'], 'string', 'max' => 512],
            [['kode'], 'unique'],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'jpg, jpeg, png, gif, bmp, pdf, doc, docx, xls, xlsx, ppt, pptx, rtf'],
            [['id_sales'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_sales' => 'id']],
            [['id_status'], 'exist', 'skipOnError' => true, 'targetClass' => BroadcastStatus::class, 'targetAttribute' => ['id_status' => 'id']],
            [['id_channel'], 'exist', 'skipOnError' => true, 'targetClass' => Channel::class, 'targetAttribute' => ['id_channel' => 'id']],
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
            'id_sales' => 'Sales',
            'kode' => 'Kode',
            'id_channel' => 'Channel',
            'judul' => 'Subject',
            'greeting' => 'Greeting',
            'isi' => 'Isi',
            'closing' => 'Closing',
            'lampiran' => 'Lampiran',
            'schedule' => 'Schedule',
            'id_status' => 'Id Status',
            'is_deleted' => 'Is Deleted',
            'timestamp' => 'Timestamp',
            'file' => 'Lampiran',
            'scheduled_date' => 'Scheduled Send'
        ];
    }

    /**
     * Gets query for [[BroadcastLogs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBroadcastLogs()
    {
        return $this->hasMany(BroadcastLog::class, ['id_broadcast' => 'id']);
    }

    /**
     * Gets query for [[Channel]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChannel()
    {
        return $this->hasOne(Channel::class, ['id' => 'id_channel']);
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
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(BroadcastStatus::class, ['id' => 'id_status']);
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

    public function upload()
    {
        if ($this->validate()) {
            if ($this->file) {
                $this->lampiran = md5($this->file->baseName) . '_' . str_pad($this->id_sales, 5, '0', STR_PAD_LEFT)
                    . '_' . time() . '.' . $this->file->extension;
                $this->file->saveAs(Yii::getAlias('@app/attachments/' . $this->lampiran), false);
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function beforeValidate()
    {
        parent::beforeValidate();

        if ($this->isNewRecord) {
            if (Yii::$app->user->identity->id_grup == Role::SALES) {
                $this->id_sales = Yii::$app->user->identity->id;
            }

            $this->id_unit = Yii::$app->user->identity->id_unit;
            $this->counter = BroadcastSearch::getLastCounter();
            $this->kode = BroadcastSearch::createUniqueCode($this->counter);
            $this->id_status = BroadcastStatus::IS_CREATED;

            if ($this->scheduled_date && $this->scheduled_time) {
                $this->is_scheduled = true;
                $this->schedule = date('Y-m-d H:i:s', strtotime($this->scheduled_date . ' ' . $this->scheduled_time));
            }
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes)
    {
        if ($insert && $this->is_scheduled) {
            $contacts = ChannelDetailSearch::getContactByChannel($this->id_channel);

            if ($contacts) {
                foreach($contacts as $key => $val) {
                    $job = new BroadcastJobs();
                    $job->id_broadcast = $this->id;
                    $job->destination = $val['email'];
                    $job->subject = $this->judul;
                    $job->content = str_replace(
                        ['{nama}', '{nama_perusahaan}'],
                        [$val['nama_klien'], $val['nama_perusahaan']],
                        $this->greeting
                    );
                    $job->content .= $this->isi_html;
                    $job->content .= $this->closing;
                    $job->send_time = $this->schedule;

                    $job->save();
                }
            }
        }
    }
}

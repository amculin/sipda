<?php

namespace app\modules\broadcasts\models;

use Yii;
use app\models\Unit;
use app\models\User;

/**
 * This is the model class for table "broadcast_config".
 *
 * @property int $id
 * @property int $id_unit
 * @property int $id_sales
 * @property string|null $greeting
 * @property string|null $closing
 * @property string|null $signature
 * @property int $is_deleted
 *
 * @property User $sales
 * @property Unit $unit
 */
class BroadcastConfig extends \yii\db\ActiveRecord
{
    const IS_DELETED = 1;
    const IS_NOT_DELETED = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'broadcast_config';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_unit', 'id_sales'], 'required'],
            [['id_unit', 'id_sales', 'is_deleted'], 'integer'],
            [['greeting', 'closing'], 'string', 'max' => 512],
            [['signature'], 'string', 'max' => 128],
            [['id_sales'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['id_sales' => 'id']],
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
            'id_sales' => 'Id Sales',
            'greeting' => 'Greeting',
            'closing' => 'Closing',
            'signature' => 'Signature',
            'is_deleted' => 'Is Deleted',
        ];
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
}

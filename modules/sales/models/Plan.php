<?php

namespace app\modules\sales\models;

use Yii;
use app\models\Unit;
use app\models\User;

/**
 * This is the model class for table "plan".
 *
 * @property int $id
 * @property int $id_sales
 * @property string $tahun
 * @property string|null $data
 * @property float $target_penjualan
 * @property float $target_komisi
 * @property int $is_deleted
 *
 * @property User $sales
 * @property Unit $unit
 */
class Plan extends \yii\db\ActiveRecord
{
    const IS_DELETED = 1;
    const IS_NOT_DELETED = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_unit', 'id_sales', 'tahun'], 'required'],
            [['id_unit', 'id_sales', 'is_deleted'], 'integer'],
            [['tahun', 'data'], 'safe'],
            [['target_penjualan', 'target_komisi'], 'number'],
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
            'id_sales' => 'Id Sales',
            'tahun' => 'Tahun',
            'data' => 'Data',
            'target_penjualan' => 'Target Penjualan',
            'target_komisi' => 'Target Komisi',
            'is_deleted' => 'Is Deleted',
        ];
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
     * Gets query for [[Sales]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSales()
    {
        return $this->hasOne(User::class, ['id' => 'id_sales']);
    }
}

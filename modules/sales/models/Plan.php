<?php

namespace app\modules\sales\models;

use Yii;
use app\models\User;

/**
 * This is the model class for table "plan".
 *
 * @property int $id
 * @property int $id_sales
 * @property int $tahun
 * @property int $bulan
 * @property float $target_penjualan
 * @property float $target_komisi
 *
 * @property User $sales
 */
class Plan extends \yii\db\ActiveRecord
{
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
            [['id_sales', 'tahun', 'bulan'], 'required'],
            [['id_sales', 'tahun', 'bulan'], 'integer'],
            [['target_penjualan', 'target_komisi'], 'number'],
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
            'id_sales' => 'Id Sales',
            'tahun' => 'Tahun',
            'bulan' => 'Bulan',
            'target_penjualan' => 'Target Penjualan',
            'target_komisi' => 'Target Komisi',
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
}

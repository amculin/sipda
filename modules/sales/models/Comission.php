<?php

namespace app\modules\sales\models;

use Yii;
use app\customs\FCurrency;
use app\models\User;

/**
 * This is the model class for table "comission".
 *
 * @property int $id
 * @property int $sales_id
 * @property int $month
 * @property string $year
 * @property int $comission
 * @property int $total_sale
 * @property int $is_achieved 0 = Is Not Achieved; 1 = Is Achieved;
 * @property int $is_paid 0 = Not Paid Yet; 1 = Is  Already Paid;
 * @property string $created_date
 * @property string|null $updated_date
 *
 * @property User $sales
 */
class Comission extends \yii\db\ActiveRecord
{
    use FCurrency;

    const IS_NOT_ACHIEVED = 0;
    const IS_ACHIEVED = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comission';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sales_id', 'month', 'year'], 'required'],
            [['sales_id', 'month', 'comission', 'total_sale', 'is_achieved', 'is_paid'], 'integer'],
            [['year', 'created_date', 'updated_date'], 'safe'],
            [
                ['sales_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class,
                'targetAttribute' => ['sales_id' => 'id']
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sales_id' => 'Sales ID',
            'month' => 'Month',
            'year' => 'Year',
            'comission' => 'Comission',
            'total_sale' => 'Total Sale',
            'is_achieved' => 'Is Achieved',
            'is_paid' => 'Is Paid',
            'created_date' => 'Created Date',
            'updated_date' => 'Updated Date',
        ];
    }

    /**
     * Gets query for [[Sales]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSales()
    {
        return $this->hasOne(User::class, ['id' => 'sales_id']);
    }
}

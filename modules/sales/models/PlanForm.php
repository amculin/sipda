<?php

namespace app\modules\sales\models;

use Yii;
use yii\base\Model;

class PlanForm extends Model
{
    /* public $januarySaleTarget, $februarySaleTarget, $marchSaleTarget, $aprilSaleTarget, $mayTargetTarget, $juneSaleTarget,
        $julySaleTarget, $augustSaleTarget, $septemberSaleTarget, $octoberSaleTarget, $novemberSaleTarget, $decemberSaleTarget;

    public $januaryComissionTarget, $februaryComissionTarget, $marchComissionTarget, $aprilComissionTarget, $mayComissionTarget,
        $juneComissionTarget, $julyComissionTarget, $augustComissionTarget, $septemberComissionTarget, $octoberComissionTarget,
        $novemberComissionTarget, $decemberComissionTarget; */
    
    public $data_sale_target;
    public $data_comission_target;

    public function rules()
    {
        return [
            [['data_sale_target', 'data_comission_target'], 'integer']
        ];
    }

    public function attributeLabels()
    {
        return [
            'data_sale_target' => 'Target Penjualan',
            'data_comission_target' => 'Target Dasar Komisi'
        ];
    }
}
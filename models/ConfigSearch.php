<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

class ConfigSearch extends Config
{
    public static function getData()
    {
        $sql = "SELECT id, id_unit, config FROM config WHERE id_unit = :unit_id";

        return Yii::$app->db->createCommand($sql, [':unit_id' => Yii::$app->user->identity->id_unit])->queryOne();
    }
}
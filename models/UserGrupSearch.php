<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

class UserGrupSearch extends UserGrup
{
    public static function getList()
    {
        $sql = "SELECT id, nama FROM user_grup ORDER BY nama ASC";

        $data = Yii::$app->db->createCommand($sql)->queryAll();

        return ArrayHelper::map($data, 'id', 'nama');
    }
}
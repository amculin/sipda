<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

class UnitSearch extends Unit
{
    public static function getList()
    {
        $sql = "SELECT id, CONCAT ('Unit ', `kode`, ' (', `nama`, ')') AS name FROM unit ORDER BY nama ASC";

        $data = Yii::$app->db->createCommand($sql)->queryAll();

        return ArrayHelper::map($data, 'id', 'name');
    }
}
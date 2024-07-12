<?php

namespace app\modules\clients\models;

use Yii;
use yii\base\Model;
use yii\data\SqlDataProvider;

/**
 * KlienKontakSearch represents the model behind the search form of `app\modules\clients\models\KlienKontak`.
 */
class KlienKontakSearch extends KlienKontak
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_klien', 'is_deleted'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($clientID)
    {
        $bound = [
            ':clientID' => $clientID,
            ':status' => $this::IS_NOT_DELETED
        ];
        $where = ' WHERE k.id_klien = :clientID AND k.is_deleted = :status';

        $count = Yii::$app->db->createCommand('SELECT COUNT(*) FROM klien_kontak k' . $where, $bound)->queryScalar();
        $sql = "SELECT k.*
            FROM klien_kontak k
            {$where}";

        $config = [
            'sql' => $sql,
            'params' => $bound,
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => 5//Yii::$app->params['pageSize'],
            ],
        ];

        $provider = new SqlDataProvider($config);

        return $provider;
    }
}

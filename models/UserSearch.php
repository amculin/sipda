<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\SqlDataProvider;
use app\models\User;

/**
 * UserSearch represents the model behind the search form of `app\models\User`.
 */
class UserSearch extends User
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_unit', 'id_grup', 'komisi_jabatan', 'is_disabled'], 'integer'],
            [['username', 'password', 'auth_key', 'nama', 'email', 'jabatan', 'last_login', 'timestamp'], 'safe'],
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
    public function search($params)
    {
        $where = '';
        $bound = [];

        $this->load($params);

        /* if ($this->name) {
            $where .= ' WHERE name LIKE :name';
            $bound[':name'] = "%{$this->name}%";
        } */

        $count = Yii::$app->db->createCommand('SELECT COUNT(*) FROM user' . $where, $bound)->queryScalar();
        $sql = "SELECT u.id, u.id_grup, u.username, u.nama, u.email, u.jabatan, ug.nama AS role  FROM user u
        LEFT JOIN user_grup ug ON (ug.id = u.id_grup)
        {$where}";

        $config = [
            'sql' => $sql,
            'params' => $bound,
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => 15,
            ],
        ];

        $provider = new SqlDataProvider($config);

        return $provider;
    }
}

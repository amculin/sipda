<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\SqlDataProvider;
use yii\helpers\ArrayHelper;
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
            [['username', 'nama', 'email', 'id_grup', 'last_login', 'timestamp'], 'safe'],
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
        $filters = [];
        $bound = [':status' => $this::IS_NOT_DELETED];
        $where = ' WHERE u.is_deleted = :status';

        $this->load($params);

        if ($this->id_grup) {
            $filters[] = 'u.id_grup = :groupID';
            $bound[':groupID'] = $this->id_grup;
        }

        if ($this->nama) {
            $filters[] = '(u.username LIKE :name OR u.nama LIKE :name OR u.email LIKE :name)';
            $bound[':name'] = "%{$this->nama}%";
        }

        if (count($filters) > 0) {
            $where .= ' AND ' . implode(' AND ', $filters);
        }

        $count = Yii::$app->db->createCommand('SELECT COUNT(*) FROM user u' . $where, $bound)->queryScalar();
        $sql = "SELECT u.id, u.id_grup, u.username, u.nama, u.email, u.jabatan, u.is_disabled, ug.nama AS role  FROM user u
        LEFT JOIN user_grup ug ON (ug.id = u.id_grup)
        {$where}";

        $config = [
            'sql' => $sql,
            'params' => $bound,
            'totalCount' => $count,
            'pagination' => [
                'pageSize' => Yii::$app->params['pageSize'],
            ],
        ];

        $provider = new SqlDataProvider($config);

        return $provider;
    }

    public static function getList()
    {
        $sql = "SELECT id, nama
            FROM user
            WHERE id_unit = :unitID AND id_grup = :roleID AND is_deleted = :status
            ORDER BY nama ASC";

        $data = Yii::$app->db->createCommand($sql, [
            ':unitID' => Yii::$app->user->identity->id_unit,
            ':roleID' => UserGrup::SALES,
            ':status' => self::IS_NOT_DELETED
        ])->queryAll();

        return ArrayHelper::map($data, 'id', 'nama');
    }
}

<?php

namespace app\modules\references\models;

use Yii;
use yii\base\Model;
use yii\data\SqlDataProvider;
use app\modules\references\models\Kategori;

/**
 * KategoriSearch represents the model behind the search form of `app\modules\references\models\Kategori`.
 */
class KategoriSearch extends Kategori
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_unit', 'is_deleted'], 'integer'],
            [['nama'], 'safe'],
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
        $bound = [
            ':unitID' => Yii::$app->user->identity->id_unit,
            ':status' => $this::IS_NOT_DELETED
        ];
        $where = ' WHERE k.id_unit = :unitID AND k.is_deleted = :status';

        $this->load($params);

        if ($this->nama) {
            $where .= ' AND k.nama LIKE :name';
            $bound[':name'] = "%{$this->nama}%";
        }

        $count = Yii::$app->db->createCommand('SELECT COUNT(*) FROM kategori k' . $where, $bound)->queryScalar();
        $sql = "SELECT k.id, k.nama FROM kategori k
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
}

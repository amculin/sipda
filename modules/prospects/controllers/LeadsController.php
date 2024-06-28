<?php

namespace app\modules\prospects\controllers;

use Yii;
use app\customs\FController;
use app\models\UserGrup as Role;
use app\models\UserSearch;
use app\modules\prospects\models\LeadSearch;
use app\modules\references\models\TahapanSearch;
use yii\web\Response;

/**
 * LeadsController implements the CRUD actions for Lead model.
 */
class LeadsController extends FController
{
    public $allowedRoles = [Role::ADMIN, Role::SALES];
    public $additionalDataClass = [
        'create' => [
            'eventList' => 'app\modules\references\models\ProgramSearch',
            'salesList' => 'app\models\UserSearch',
        ],
        'edit' => [
            'eventList' => 'app\modules\references\models\ProgramSearch',
            'salesList' => 'app\models\UserSearch'
        ],
    ];
    public $modelClass = 'app\modules\prospects\models\Lead';
    public $searchModelClass = 'app\modules\prospects\models\LeadSearch';
    public $title = 'Leads';

    /**
     * Lists all Lead models.
     *
     * @return string
     */
    public function actionIndex($stepId = null)
    {
        $searchModel = new LeadSearch();

        if (!is_null($stepId)) {
            $searchModel->id_tahapan = $stepId;
        }

        $dataProvider = $searchModel->search($this->request->queryParams);
        $stepList = TahapanSearch::getList();
        $salesList = Yii::$app->user->identity->id_grup == Role::ADMIN ? UserSearch::getList()
            : [];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'stepList' => $stepList,
            'salesList' => $salesList,
            'stepId' => $stepId
        ]);
    }

    public function actionGetDetail($id)
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            $model = ($this->searchModelClass)::getLeadByID($id);

            return [
                'nama_klien' => $model['nama_klien'],
                'nomor_telepon' =>$model['nomor_telepon'],
                'email' => $model['email'],
                'nama_perusahaan' => $model['nama_perusahaan'],
                'id_tahapan' => $model['id_tahapan']
            ];
        }
    }
}

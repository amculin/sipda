<?php

namespace app\modules\prospects\controllers;

use Yii;
use app\customs\FController;
use app\models\UserGrup as Role;
use app\modules\prospects\models\LeadSearch;
use yii\helpers\ArrayHelper;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;

/**
 * LeadHistoriesController implements the CRUD actions for LeadHistory model.
 */
class LeadHistoriesController extends FController
{
    public $allowedRoles = [Role::ADMIN, Role::SALES];
    public $additionalDataClass = [
        'convert' => [
            'stepList' => 'app\modules\references\models\TahapanSearch'
        ],
        'edit' => [
            'stepList' => 'app\modules\references\models\TahapanSearch'
        ],
    ];
    public $modelClass = 'app\modules\prospects\models\LeadHistory';
    public $searchModelClass = 'app\modules\prospects\models\LeadHistorySearch';
    public $title = 'Leads History';

    public function actionConvert($leadId)
    {
        $model = new ($this->modelClass)();
        $model->id_lead = $leadId;

        if (Yii::$app->request->isAjax) {
            if ($model->load(Yii::$app->request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
    
                return ActiveForm::validate($model);
            } else {
                $lastHistory = ($this->searchModelClass)::getLastStep($leadId);
                $data = [
                    'model' => $model,
                    'title' => 'Tambah ' . $this->title
                ];

                if (isset($this->additionalDataClass) && array_key_exists('convert', $this->additionalDataClass)) {
                    foreach ($this->additionalDataClass['convert'] as $key => $val) {
                        $data[$key] = ($val)::getList();
                    }
                }
                
                $currentStep = array_filter($data['stepList'], function($list) use($lastHistory) {
                    return $list['id'] == $lastHistory;
                });

                $isDeal = $currentStep[array_keys($currentStep)[0]]['nama'] == 'DEAL';
                $isFail = $currentStep[array_keys($currentStep)[0]]['nama'] == 'FAIL';

                $filteredStepList = array_filter($data['stepList'], function($list) use($lastHistory, $isDeal, $isFail) {
                    if ($isDeal || $isFail) {
                        return ($list['nama'] != 'DEAL' && $list['nama'] != 'FAIL');
                    } else {
                        return $list['id'] > $lastHistory;
                    }
                });

                $data['isDeal'] = $isDeal;
                $data['isFail'] = $isFail;
                $data['mappedStepList'] = ArrayHelper::map($filteredStepList, 'id', 'nama');

                return $this->renderAjax('_form', $data);
            }
        }

        if ($this->request->isPost) {
            $leadModel = LeadSearch::getLeadByID($leadId);

            if ($model->load($this->request->post())) {
                $model->attachment = UploadedFile::getInstance($model, 'attachment');
                $model->nilai = $leadModel->nilai;

                $leadModel->id_tahapan = $model->id_tahapan;

                if ($model->upload() && $model->save() && $leadModel->save()) {
                    return $this->redirect(['/prospects/leads/index']);
                }
            } else {
                print_r($model->getErrors());
            }
        } else {
            $model->loadDefaultValues();
        }
    }

    public function actionTracking($leadId)
    {
        $histories = ($this->searchModelClass)::getHistoriesByLeadID($leadId);
        $event = LeadSearch::getEvent($leadId);

        return $this->renderAjax('tracking', [
            'histories' => $histories,
            'event' => $event
        ]);
    }

    public function actionDownload($id)
    {
        $model = $this->findModel($id);

        $path = Yii::getAlias('@app') . '/attachments/' . $model->file;

        if (file_exists($path)) {
            return Yii::$app->response->sendFile($path, $model->file);
        } else {
            throw new \yii\web\NotFoundHttpException('File Not Found!');
        }
    }
}

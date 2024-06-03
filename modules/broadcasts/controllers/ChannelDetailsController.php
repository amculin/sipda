<?php

namespace app\modules\broadcasts\controllers;

use Yii;
use app\customs\FController;
use app\models\UserGrup as Role;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * ChannelDetailsController implements the CRUD actions for ChannelDetail model.
 */
class ChannelDetailsController extends FController
{
    public $allowedRoles = [Role::ADMIN, Role::SALES];
    public $additionalDataClass = [
        'create' => [
            'channelList' => 'app\modules\broadcasts\models\ChannelSearch',
        ],
        'edit' => [
            'channelList' => 'app\modules\broadcasts\models\ChannelSearch',
        ],
        'create-from-lead' => [
            'channelList' => 'app\modules\broadcasts\models\ChannelSearch',
        ],
    ];
    public $modelClass = 'app\modules\broadcasts\models\ChannelDetail';
    public $searchModelClass = 'app\modules\broadcasts\models\ChannelSearch';
    public $title = 'Kontak';

    /**
     * Creates a new model.
     * If request comes in AJAX, it will render the form or do the validation.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return string|\yii\web\Response
     */
    public function actionCreateFromLead($leadCollections)
    {
        $model = new ($this->modelClass)();
        $model->scenario = $model::SCENARIO_CREATE_FROM_LEAD;
        $model->lead_collections = $leadCollections;

        if (Yii::$app->request->isAjax) {
            if ($model->load(Yii::$app->request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
    
                return ActiveForm::validate($model);
            } else {
                $data = [
                    'model' => $model,
                    'title' => 'Tambahkan Channel'
                ];

                if (isset($this->additionalDataClass) && array_key_exists('create-from-lead', $this->additionalDataClass)) {
                    foreach ($this->additionalDataClass['create'] as $key => $val) {
                        $data[$key] = ($val)::getList();
                    }
                }

                return $this->renderAjax('_form-create-from-lead', $data);
            }
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $saved = true;
                $leads = explode(',', $model->lead_collections);
                foreach ($leads as $key => $leadID) {
                    $newModel = new ($this->modelClass)();
                    $newModel->scenario = $model::SCENARIO_CREATE;
                    $newModel->id_channel = $model->id_channel;
                    $newModel->id_lead = $leadID;
                    $saved = $newModel->save() && $saved;
                }
                
                if ($saved) {
                    return $this->redirect(['/prospects/leads/index']);
                }
            } else {
                print_r($model->getErrors());
            }
        } else {
            $model->loadDefaultValues();
        }
    }
}

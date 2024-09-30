<?php

namespace app\modules\broadcasts\controllers;

use Yii;
use app\customs\FController;
use app\models\UserGrup as Role;
use app\modules\broadcasts\models\ChannelSearch;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * ChannelDetailsController implements the CRUD actions for ChannelDetail model.
 */
class ChannelDetailsController extends FController
{
    public $allowedRoles = [Role::ADMIN, Role::SALES];
    public $additionalDataClass = [
        'edit' => [
            'contactList' => 'app\modules\prospects\models\LeadSearch',
        ],
        'create-from-lead' => [
            'channelList' => 'app\modules\broadcasts\models\ChannelSearch',
        ],
        'create-from-channel' => [
            'contactList' => 'app\modules\prospects\models\LeadSearch',
        ],
    ];
    public $modelClass = 'app\modules\broadcasts\models\ChannelDetail';
    public $searchModelClass = 'app\modules\broadcasts\models\ChannelDetailSearch';
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
                    foreach ($this->additionalDataClass['create-from-lead'] as $key => $val) {
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

    /**
     * Lists all ChannelDetail models.
     *
     * @return string
     */
    public function actionView($channelId)
    {
        $searchModel = new ($this->searchModelClass)();
        $channelData = ChannelSearch::getDetailChannelByID($channelId);
        $dataProvider = $searchModel->search($channelId);

        return $this->render('view', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'channelData' => $channelData,
            'channelID' => $channelId
        ]);
    }

    /**
     * Creates a new model.
     * If request comes in AJAX, it will render the form or do the validation.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return string|\yii\web\Response
     */
    public function actionCreateFromChannel($channelId)
    {
        $model = new ($this->modelClass)();
        $model->scenario = $model::SCENARIO_CREATE;
        $model->id_channel = $channelId;

        if (Yii::$app->request->isAjax) {
            if ($model->load(Yii::$app->request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
    
                return ActiveForm::validate($model);
            } else {
                $data = [
                    'model' => $model,
                    'title' => 'Tambah Kontak'
                ];

                if (isset($this->additionalDataClass) && array_key_exists('create-from-channel', $this->additionalDataClass)) {
                    foreach ($this->additionalDataClass['create-from-channel'] as $key => $val) {
                        $data[$key] = ($val)::getContactsByChannelID($channelId);
                    }
                }

                return $this->renderAjax('_form-create-from-channel', $data);
            }
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'channelId' => $channelId]);
            } else {
                print_r($model->getErrors());
            }
        } else {
            $model->loadDefaultValues();
        }
    }

    /**
    * @inheritdoc
    */
   public function actionUpdate($id)
   {
       $model = $this->findModel($id);

       if (Yii::$app->request->isAjax) {
           if ($model->load(Yii::$app->request->post())) {
               Yii::$app->response->format = Response::FORMAT_JSON;
   
               return ActiveForm::validate($model);
           } else {
               $data = [
                   'model' => $model,
                   'title' => 'Edit ' . $this->title
               ];

               if (isset($this->additionalDataClass) && array_key_exists('edit', $this->additionalDataClass)) {
                   foreach ($this->additionalDataClass['edit'] as $key => $val) {
                       $data[$key] = ($val)::getContactsByChannelID($model->id_channel);
                   }
               }

               return $this->renderAjax('_form-create-from-channel', $data);
           }
       }

       if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
           return $this->redirect(['view', 'channelId' => $model->id_channel]);
       }
   }
}

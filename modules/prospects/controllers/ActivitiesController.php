<?php

namespace app\modules\prospects\controllers;

use Yii;
use app\customs\FController;
use app\models\UserGrup as Role;
use app\modules\prospects\models\LeadSearch;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * ActivitiesController implements the CRUD actions for Aktivitas model.
 */
class ActivitiesController extends FController
{
    public $allowedRoles = [Role::ADMIN, Role::SALES];
    public $modelClass = 'app\modules\prospects\models\Aktivitas';
    public $title = 'Aktivitas';

    /**
     * Lists all Lead models.
     *
     * @return string
     */
    public function actionView($leadId)
    {
        $lead = LeadSearch::getDetailLeadByID($leadId);

        return $this->render('view', [
            'lead' => $lead
        ]);
    }

    /**
     * @inheritdoc
     */
    public function actionCreate()
    {
        $model = new ($this->modelClass)();

        if (Yii::$app->request->isAjax) {
            if ($model->load(Yii::$app->request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
    
                return ActiveForm::validate($model);
            } else {
                $data = [
                    'model' => $model,
                    'title' => 'Tambah ' . $this->title
                ];

                if (isset($this->additionalDataClass) && array_key_exists('create', $this->additionalDataClass)) {
                    foreach ($this->additionalDataClass['create'] as $key => $val) {
                        $data[$key] = ($val)::getList();
                    }
                }

                return $this->renderAjax('_form', $data);
            }
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                echo 'aaaa';
                return $this->redirect(['view', 'leadId' => $model->id_lead]);
            } else {
                echo 'ddd';
                echo '<pre>';
                print_r($model->attributes);
                print_r($model->getErrors());
            }
        } else {
            $model->loadDefaultValues();
        }
    }
}

<?php

namespace app\modules\clients\controllers;

use Yii;
use app\customs\FController;
use app\models\UserGrup as Role;
use app\models\UserSearch;
use app\modules\clients\models\KlienSearch;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * ContactsController implements the CRUD actions for KlienKontak model.
 */
class ContactsController extends FController
{
    public $allowedRoles = [Role::ADMIN, Role::SALES];
    public $modelClass = 'app\modules\clients\models\KlienKontak';
    public $searchModelClass = 'app\modules\clients\models\KlienKontakSearch';
    public $title = 'Contact Person';

    /**
     * Lists all KlienKontak models by id_klien.
     *
     * @return string
     */
    public function actionView($clientId)
    {
        $searchModel = new ($this->searchModelClass)();
        $clientData = KlienSearch::getDetailClientByID($clientId);
        $dataProvider = $searchModel->search($clientId);

        return $this->render('view', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'clientData' => $clientData,
            'clientID' => $clientId
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

                return $this->renderAjax('_form', $data);
            }
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'clientId' => $model->id_klien]);
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
                    'title' => 'Tambah ' . $this->title
                ];

                return $this->renderAjax('_form', $data);
            }
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'clientId' => $model->id_klien]);
            } else {
                print_r($model->getErrors());
            }
        } else {
            $model->loadDefaultValues();
        }
    }

    /**
     * Activate/Disable an existing KlienKontak model.
     * If activation/disabling is successful, the system will return success message.
     * @param int $id ID
     * @return Response
     * @throws UnprocessableEntityHttpException if the action cannot be executed
     */
    public function actionEnabler($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $model = $this->findModel($id);

        if ($model->is_disabled == $model::IS_ACTIVE) {
            $model->is_disabled = $model::IS_INACTIVE;
        } else {
            $model->is_disabled = $model::IS_ACTIVE;
        }

        if (! $model->save()) {
            throw new UnprocessableEntityHttpException('Gagal');
        }

        return [
            'code' => 200,
            'message' => 'Sukses'
        ];
    }
}

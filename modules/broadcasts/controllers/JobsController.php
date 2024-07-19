<?php

namespace app\modules\broadcasts\controllers;

use Yii;
use app\customs\FController;
use app\models\UserGrup as Role;
use app\modules\broadcasts\models\BroadcastConfig;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;

/**
 * JobsController implements the CRUD actions for Broadcast model.
 */
class JobsController extends FController
{
    public $allowedRoles = [Role::ADMIN, Role::SALES];
    public $additionalDataClass = [
        'create' => [
            'salesList' => 'app\models\UserSearch',
            'channelList' => 'app\modules\broadcasts\models\ChannelSearch'
        ],
        'edit' => ['salesList' => 'app\models\UserSearch'],
        'index' => ['salesList' => 'app\models\UserSearch'],
    ];
    public $modelClass = 'app\modules\broadcasts\models\Broadcast';
    public $searchModelClass = 'app\modules\broadcasts\models\BroadcastSearch';
    public $title = 'Broadcast Email';

    /**
     * Displays a single Broadcast model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Broadcast model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new ($this->modelClass)();

        if (Yii::$app->request->isAjax) {
            if ($model->load(Yii::$app->request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
    
                return ActiveForm::validate($model);
            }
        }

        if ($this->request->isPost && $model->load($this->request->post())) {
            /* echo '<pre>';
            print_r($_POST);
            print_r($model);
            exit(); */
            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->upload() && $model->save()) {
                return $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        $data = [];
        
        if (isset($this->additionalDataClass) && array_key_exists('create', $this->additionalDataClass)) {
            foreach ($this->additionalDataClass['create'] as $key => $val) {
                $data[$key] = ($val)::getList();
            }
        }

        if (Yii::$app->user->identity->id_grup == Role::SALES) {
            $config = BroadcastConfig::find(['id_sales' => Yii::$app->user->identity->id])->one();

            if ($config) {
                $model->greeting = $config->greeting;
                $model->closing = $config->closing;
            }
        }

        $data['model'] = $model;
        $data['title'] = 'Form Broadcast Email';

        return $this->render('form', $data);
    }

    /**
     * Updates an existing Broadcast model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
}

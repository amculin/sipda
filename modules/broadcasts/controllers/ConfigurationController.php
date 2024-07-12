<?php

namespace app\modules\broadcasts\controllers;

use Yii;
use app\customs\FController;
use app\models\UserGrup as Role;
use yii\web\Response;
use yii\web\UploadedFile;
use yii\widgets\ActiveForm;

/**
 * ConfigurationController implements the CRUD actions for BroadcastConfig model.
 */
class ConfigurationController extends FController
{
    public $allowedRoles = [Role::ADMIN];
    public $modelClass = 'app\modules\broadcasts\models\BroadcastConfig';
    public $searchModelClass = 'app\modules\broadcasts\models\BroadcastConfigSearch';
    public $title = 'Konfigurasi Broadcast Email';

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

                return $this->renderAjax('_form', $data);
            }
        }

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->file = UploadedFile::getInstance($model, 'file');

            if ($model->upload() && $model->save()) {
                return $this->redirect(['index']);
            }
        }
    }
}

<?php

namespace app\modules\clients\controllers;

use Yii;
use app\customs\FController;
use app\models\UserGrup as Role;
use app\models\UserSearch;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * CompaniesController implements the CRUD actions for Klien model.
 */
class CompaniesController extends FController
{
    public $allowedRoles = [Role::ADMIN, Role::SALES];
    public $modelClass = 'app\modules\clients\models\Klien';
    public $searchModelClass = 'app\modules\clients\models\KlienSearch';
    public $title = 'Klien';

    /**
     * Creates a new Klien model.
     * If creation is successful, the browser will be redirected to the 'view' page.
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

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        $isAdmin = Yii::$app->user->identity->id_grup == Role::ADMIN;

        $data = [
            'model' => $model,
            'isAdmin' => $isAdmin
        ];


        if ($isAdmin) {
            $data['salesList'] = UserSearch::getList();
        }

        return $this->render('form', $data);
    }

    /**
     * Updates an existing model.
     * If update is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isAjax) {
            if ($model->load(Yii::$app->request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
    
                return ActiveForm::validate($model);
            }
        }

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        $isAdmin = Yii::$app->user->identity->id_grup == Role::ADMIN;

        $data = [
            'model' => $model,
            'isAdmin' => $isAdmin
        ];


        if ($isAdmin) {
            $data['salesList'] = UserSearch::getList();
        }

        return $this->render('form', $data);
    }

    /**
     * Activate/Disable an existing Klien model.
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

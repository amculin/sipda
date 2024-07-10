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
}

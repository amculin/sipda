<?php

namespace app\controllers;

use Yii;
use app\models\ConfigForm;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\widgets\ActiveForm;
use yii\web\Response;

/**
 * UsersController implements the CRUD actions for User model.
 */
class ConfigurationsController extends Controller
{
    public $enableCsrfValidation = true;

    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'matchCallback' => function ($rule, $action) {
                                if (Yii::$app->user->isGuest) {
                                    return false;
                                } else {
                                    return Yii::$app->user->identity->id_grup === 1;
                                }
                            }
                        ],
                    ],
                ],
            ]
        );
    }

    /**
     * Create or update existing configuration
     */
    public function actionIndex()
    {
        $model = new ConfigForm();
        $tempPassword = $model->smtp_password;

        if (Yii::$app->request->isAjax) {
            if ($model->load(Yii::$app->request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                if ($model->smtp_password == '') {
                    $model->smtp_password = $tempPassword;
                }
    
                return ActiveForm::validate($model);
            }
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $model->smtp_password = $model->smtp_password == '' ? $tempPassword : $model->smtp_password;

                if ($model->save()) {
                    return $this->redirect(['index']);
                }
            }
        }

        $model->smtp_password = '';

        return $this->render('index', [
            'model' => $model
        ]);
    }
}

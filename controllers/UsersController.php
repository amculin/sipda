<?php

namespace app\controllers;

use Yii;
use app\customs\FController;
use app\models\UnitSearch;
use app\models\User;
use app\models\UserGrup as Role;
use app\models\UserGrupSearch;
use app\models\UserSearch;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\widgets\ActiveForm;
use yii\web\Response;

/**
 * UsersController implements the CRUD actions for User model.
 */
class UsersController extends FController
{
    public $enableCsrfValidation = true;
    public $allowedRoles = [Role::ADMIN];
    public $additionalDataClass = [
        'index' => ['roleList' => 'app\models\UserGrupSearch']
    ];
    public $modelClass = 'app\models\User';
    public $searchModelClass = 'app\models\UserSearch';
    public $title = 'User';

    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                        'lock' => ['POST']
                    ],
                ],
            ]
        );
    }

    /**
     * @inheritdoc
     */
    public function actionCreate()
    {
        $model = new User();
        $model->scenario = $model::SCENARIO_NEW_USER;

        if (Yii::$app->request->isAjax) {
            if ($model->load(Yii::$app->request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
    
                return ActiveForm::validate($model);
            } else {
                $roleList = UserGrupSearch::getList();
                $unitList = UnitSearch::getList();
                $model->komisi_jabatan = 0;

                return $this->renderAjax('_form', [
                    'model' => $model,
                    'title' => 'Tambah ' . $this->title,
                    'roleList' => $roleList,
                    'unitList' => $unitList
                ]);
            }
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['index']);
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
        $tempPassword = $model->password;

        if (Yii::$app->request->isAjax) {
            if ($model->load(Yii::$app->request->post())) {
                if ($model->password == '') {
                    $model->password = $tempPassword;
                }

                Yii::$app->response->format = Response::FORMAT_JSON;
    
                return ActiveForm::validate($model);
            } else {
                $roleList = UserGrupSearch::getList();
                $unitList = UnitSearch::getList();
                $model->password = '';

                return $this->renderAjax('_form', [
                    'model' => $model,
                    'title' => 'Edit ' . $this->title,
                    'roleList' => $roleList,
                    'unitList' => $unitList
                ]);
            }
        }

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->password = $model->password == '' ? $tempPassword :
                Yii::$app->getSecurity()->generatePasswordHash($model->password);
            
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }
    }

    /**
     * Lock/unlock an existing User model.
     * If lock/unlock is successful, the system will return success message.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws UnprocessableEntityHttpException if the action cannot be executed
     */
    public function actionLock($id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $model = $this->findModel($id);

        if ($model->is_disabled == $model::IS_DISABLED) {
            $model->is_disabled = $model::IS_NOT_DISABLED;
        } else {
            $model->is_disabled = $model::IS_DISABLED;
        }

        if (! $model->save()) {
            throw new yii\web\UnprocessableEntityHttpException('Gagal');
        }

        return [
            'code' => 200,
            'message' => 'Sukses'
        ];
    }

    /**
     * @inheritdoc
     */
    public function actionDelete($id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $model = $this->findModel($id);
        $model->scenario = $model::SCENARIO_SOFT_DELETION;
        $model->is_deleted = $model::IS_DELETED;

        if (! $model->save()) {
            throw new yii\web\UnprocessableEntityHttpException('Gagal');
        }

        return [
            'code' => 200,
            'message' => 'Sukses'
        ];
    }
}

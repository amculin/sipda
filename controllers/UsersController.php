<?php

namespace app\controllers;

use Yii;
use app\models\UnitSearch;
use app\models\User;
use app\models\UserGrupSearch;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\widgets\ActiveForm;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * UsersController implements the CRUD actions for User model.
 */
class UsersController extends Controller
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
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $roleList = UserGrupSearch::getList();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'roleList' => $roleList
        ]);
    }

    /**
     * Creates a new User model.
     * If request comes in AJAX, it will render the form or do the validation.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new User();

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
                    'title' => 'Tambah User',
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
     * Updates an existing User model.
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

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will return success message.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws UnprocessableEntityHttpException if the action cannot be executed
     */
    public function actionDelete($id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        if ($this->findModel($id)->delete() === false)
            throw new yii\web\UnprocessableEntityHttpException('Gagal');

        return [
            'code' => 200,
            'message' => 'Sukses'
        ];
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Lock/unlock an existing User model.
     * If lock/unlock is successful, the browser will return success message.
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
}

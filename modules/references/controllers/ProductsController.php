<?php

namespace app\modules\references\controllers;

use Yii;
use app\modules\references\models\KategoriSearch;
use app\modules\references\models\Produk;
use app\modules\references\models\ProdukSearch;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * ProductsController implements the CRUD actions for Produk model.
 */
class ProductsController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
                ['access' => [
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
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Produk models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProdukSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Produk model.
     * If request comes in AJAX, it will render the form or do the validation.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Produk();

        if (Yii::$app->request->isAjax) {
            if ($model->load(Yii::$app->request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
    
                return ActiveForm::validate($model);
            } else {
                $categoryList = KategoriSearch::getList();

                return $this->renderAjax('_form', [
                    'model' => $model,
                    'categoryList' => $categoryList,
                    'title' => 'Tambah Produk'
                ]);
            }
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            } else {
                print_r($model->getErrors());
            }
        } else {
            $model->loadDefaultValues();
        }
    }

    /**
     * Updates an existing Produk model.
     * If request comes in AJAX, it will render the form or do the validation.
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
            } else {
                $categoryList = KategoriSearch::getList();

                return $this->renderAjax('_form', [
                    'model' => $model,
                    'title' => 'Edit Produk',
                    'categoryList' => $categoryList
                ]);
            }
        }

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }
    }

    /**
     * Deletes an existing Produk model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Produk model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Produk the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Produk::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

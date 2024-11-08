<?php

namespace app\modules\sales\controllers;

use Yii;
use app\customs\FController;
use app\models\UserGrup as Role;
use app\modules\prospects\models\QuotationSearch;
use app\modules\references\models\ProdukSearch;
use yii\web\Response;

/**
 * OrdersController implements the CRUD actions for SalesOrder model.
 */
class OrdersController extends FController
{
    public $allowedRoles = [Role::ADMIN, Role::SALES];
    public $additionalDataClass = [
        'index' => [
            'salesList' => 'app\models\UserSearch',
        ],
        'create' => [
            'productList' => 'app\modules\references\models\ProdukSearch',
            'quotationList' => 'app\modules\prospects\models\QuotationSearch'
        ],
        'edit' => [
            'productList' => 'app\modules\references\models\ProdukSearch'
        ],
    ];
    public $modelClass = 'app\modules\sales\models\SalesOrder';
    public $searchModelClass = 'app\modules\sales\models\SalesOrderSearch';
    public $title = 'Sales Order';
    public $specialRules = ['approver' => [Role::ADMIN]];

    /**
     * @inheritdoc
     */
    public function actionCreate()
    {
        $model = new ($this->modelClass)();

        if ($this->request->isPost && $model->load($this->request->post())) {
            if ($model->save()) {
                return $this->redirect(['index']);
            } else {
                echo '<pre>';
                print_r($model->attributes);
                print_r($model->getErrors());
                exit();
            }
        } else {
            $model->loadDefaultValues();
        }

        $data = [
            'model' => $model,
            'title' => 'Tambah ' . $this->title
        ];

        if (isset($this->additionalDataClass) && array_key_exists('create', $this->additionalDataClass)) {
            foreach ($this->additionalDataClass['create'] as $key => $val) {
                $data[$key] = ($val)::getList();
            }
        }

        $lastCounter = ($this->searchModelClass)::getLastCounter();
        $model->kode = ($this->searchModelClass)::createUniqueCode($lastCounter);

        return $this->render('form', $data);
    }

    /**
    * @inheritdoc
    */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = $model::UPDATE_SCENARIO;

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            return ActiveForm::validate($model);
        }

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        $data = [
            'model' => $model,
            'title' => 'Edit ' . $this->title
        ];

        if (isset($this->additionalDataClass) && array_key_exists('edit', $this->additionalDataClass)) {
            foreach ($this->additionalDataClass['edit'] as $key => $val) {
                $data[$key] = ($val)::getList();
            }
        }

        return $this->render('form', $data);
    }

    /**
     * Approve/Reject an existing Quotation model.
     * If approval/rejection is successful, the system will return success message.
     * @param int $id ID
     * @return Response
     * @throws UnprocessableEntityHttpException if the action cannot be executed
     */
    public function actionApprover($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $model = $this->findModel($id);
        $model->scenario = $model::APPROVAL_SCENARIO;

        if ($model->is_verified == $model::IS_VERIFIED) {
            $model->is_verified = $model::IS_REJECTED;
        } else {
            $model->is_verified = $model::IS_VERIFIED;
            //$model->comission = $model->countComission();
        }

        if (! $model->save()) {
            throw new UnprocessableEntityHttpException('Gagal');
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
        Yii::$app->response->format = Response::FORMAT_JSON;

        $model = $this->findModel($id);
        $model->scenario = $model::SOFT_DELETE_SCENARIO;
        $model->is_deleted = $model::IS_DELETED;

        if (! $model->save()) {
            throw new yii\web\UnprocessableEntityHttpException('Gagal');
        }

        return [
            'code' => 200,
            'message' => 'Sukses'
        ];
    }

    public function actionPrint($id)
    {
        $model = $this->findModel($id);

        return $this->renderPartial('print', ['model' => $model]);
    }
}

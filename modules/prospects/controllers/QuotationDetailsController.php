<?php

namespace app\modules\prospects\controllers;

use Yii;
use app\customs\FController;
use app\models\UserGrup as Role;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * QuotationsController implements the CRUD actions for Quotation model.
 */
class QuotationDetailsController extends FController
{
    public $allowedRoles = [Role::ADMIN, Role::SALES];
    public $modelClass = 'app\modules\prospects\models\QuotationDetail';
    public $additionalDataClass = [
        'edit' => [
            'productList' => 'app\modules\references\models\ProdukSearch'
        ],
    ];

    /**
     * @inheritdoc
     */
    public function actionDelete($id)
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $model = $this->findModel($id);

        if (! $model->delete()) {
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
                    'title' => 'Edit Produk'
                ];

                if (isset($this->additionalDataClass) && array_key_exists('edit', $this->additionalDataClass)) {
                    foreach ($this->additionalDataClass['edit'] as $key => $val) {
                        $data[$key] = ($val)::getList();
                    }
                }

                $model->harga = (int) $model->harga;
                $model->diskon = (int) $model->diskon;

                return $this->renderAjax('_form', $data);
            }
        }

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['/prospects/quotations/update', 'id' => $model->id_quotation]);
        }
    }

    public function actionGetDetails($quotationId)
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            $model = ($this->modelClass)::getQuotationDetails($quotationId);

            $data = [];

            if ($model) {
                foreach ($model as $key => $val) {
                    $data[$key] = $val->attributes;
                }
            }

            return $this->renderAjax('_product-form', ['model' => $model]);
        }
    }
}

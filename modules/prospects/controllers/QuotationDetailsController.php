<?php

namespace app\modules\prospects\controllers;

use Yii;
use app\customs\FController;
use app\models\UserGrup as Role;

/**
 * QuotationsController implements the CRUD actions for Quotation model.
 */
class QuotationDetailsController extends FController
{
    public $allowedRoles = [Role::ADMIN, Role::SALES];
    public $modelClass = 'app\modules\prospects\models\QuotationDetail';

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
}
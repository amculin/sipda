<?php

namespace app\modules\references\controllers;

use Yii;
use app\customs\FController;
use app\models\UserGrup as Role;
use yii\web\Response;

/**
 * ProductsController implements the CRUD actions for Produk model.
 */
class ProductsController extends FController
{
    public $allowedRoles = [Role::ADMIN];
    public $additionalDataClass = [
        'create' => ['categoryList' => 'app\modules\references\models\KategoriSearch'],
        'edit' => ['categoryList' => 'app\modules\references\models\KategoriSearch'],
    ];
    public $modelClass = 'app\modules\references\models\Produk';
    public $searchModelClass = 'app\modules\references\models\ProdukSearch';
    public $title = 'Produk';
    public $specialRules = ['get-detail' => [Role::ADMIN, Role::SALES]];

    public function actionGetDetail($id)
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            $model = ($this->searchModelClass)::getDetailProductByID($id);

            return $model;
        }
    }
}

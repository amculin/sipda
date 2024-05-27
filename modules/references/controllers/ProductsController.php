<?php

namespace app\modules\references\controllers;

use Yii;
use app\customs\FController;
use app\models\UserGrup as Role;

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
}

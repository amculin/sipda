<?php

namespace app\modules\references\controllers;

use Yii;
use app\customs\FController;
use app\models\UserGrup as Role;

/**
 * CategoriesController implements the CRUD actions for Kategori model.
 */
class CategoriesController extends FController
{
    public $allowedRoles = [Role::ADMIN];
    public $modelClass = 'app\modules\references\models\Kategori';
    public $searchModelClass = 'app\modules\references\models\KategoriSearch';
    public $title = 'Kategori';
}

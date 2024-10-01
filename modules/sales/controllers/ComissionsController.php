<?php

namespace app\modules\sales\controllers;

use app\customs\FController;
use app\models\UserGrup as Role;

/**
 * ComissionsController implements the CRUD actions for Comission model.
 */
class ComissionsController extends FController
{
    public $allowedRoles = [Role::ADMIN];
    public $modelClass = 'app\modules\sales\models\Comission';
    public $searchModelClass = 'app\modules\sales\models\ComissionSearch';
    public $title = 'Komisi Penjualan';
}

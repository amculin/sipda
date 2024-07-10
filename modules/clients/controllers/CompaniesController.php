<?php

namespace app\modules\clients\controllers;

use Yii;
use app\customs\FController;
use app\models\UserGrup as Role;
use yii\web\Response;

/**
 * CompaniesController implements the CRUD actions for Klien model.
 */
class CompaniesController extends FController
{
    public $allowedRoles = [Role::ADMIN, Role::SALES];
    public $modelClass = 'app\modules\clients\models\Klien';
    public $searchModelClass = 'app\modules\clients\models\KlienSearch';
    public $title = 'Klien';
}

<?php

namespace app\modules\sales\controllers;

use app\customs\FController;
use app\models\UserGrup as Role;

/**
 * PlansController implements the CRUD actions for Plan model.
 */
class PlansController extends FController
{
    public $allowedRoles = [Role::ADMIN];
    public $modelClass = 'app\modules\sales\models\Plan';
    public $searchModelClass = 'app\modules\sales\models\PlanSearch';
    public $title = 'Planning';
}

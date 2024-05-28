<?php

namespace app\modules\references\controllers;

use app\customs\FController;
use app\models\UserGrup as Role;

/**
 * EventsController implements the CRUD actions for Program model.
 */
class EventsController extends FController
{
    public $allowedRoles = [Role::ADMIN];
    public $modelClass = 'app\modules\references\models\Program';
    public $searchModelClass = 'app\modules\references\models\ProgramSearch';
    public $title = 'Program';
}

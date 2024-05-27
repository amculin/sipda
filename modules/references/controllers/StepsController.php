<?php

namespace app\modules\references\controllers;

use Yii;
use app\customs\FController;
use app\models\UserGrup as Role;

/**
 * StepsController implements the CRUD actions for Tahapan model.
 */
class StepsController extends FController
{
    public $allowedRoles = [Role::ADMIN];
    public $modelClass = 'app\modules\references\models\Tahapan';
    public $searchModelClass = 'app\modules\references\models\TahapanSearch';
    public $title = 'Tahapan';
}

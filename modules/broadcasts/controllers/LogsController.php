<?php

namespace app\modules\broadcasts\controllers;

use app\models\UserGrup as Role;
use app\modules\broadcasts\models\BroadcastLog;
use app\modules\broadcasts\models\BroadcastLogSearch;
use app\customs\FController;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LogsController implements the CRUD actions for BroadcastLog model.
 */
class LogsController extends FController
{
    public $allowedRoles = [Role::ADMIN, Role::SALES];
    public $additionalDataClass = [
        'index' => ['salesList' => 'app\models\UserSearch'],
    ];
    public $modelClass = 'app\modules\broadcasts\models\BroadcastLog';
    public $searchModelClass = 'app\modules\broadcasts\models\BroadcastLogSearch';
    public $title = 'Log Email';
}

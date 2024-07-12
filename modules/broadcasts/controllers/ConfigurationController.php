<?php

namespace app\modules\broadcasts\controllers;

use app\customs\FController;
use app\models\UserGrup as Role;

/**
 * ConfigurationController implements the CRUD actions for BroadcastConfig model.
 */
class ConfigurationController extends FController
{
    public $allowedRoles = [Role::ADMIN];
    public $modelClass = 'app\modules\broadcasts\models\BroadcastConfig';
    public $searchModelClass = 'app\modules\broadcasts\models\BroadcastConfigSearch';
    public $title = 'Konfigurasi Broadcast Email';
}

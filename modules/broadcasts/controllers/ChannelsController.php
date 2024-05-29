<?php

namespace app\modules\broadcasts\controllers;

use Yii;
use app\customs\FController;
use app\models\UserGrup as Role;

/**
 * ChannelsController implements the CRUD actions for Channel model.
 */
class ChannelsController extends FController
{
    public $allowedRoles = [Role::ADMIN, Role::SALES];
    public $additionalDataClass = [
        'create' => ['salesList' => 'app\models\UserSearch'],
        'edit' => ['salesList' => 'app\models\UserSearch'],
    ];
    public $modelClass = 'app\modules\broadcasts\models\Channel';
    public $searchModelClass = 'app\modules\broadcasts\models\ChannelSearch';
    public $title = 'Channel';
}

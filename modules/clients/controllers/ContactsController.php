<?php

namespace app\modules\clients\controllers;

use Yii;
use app\customs\FController;
use app\models\UserGrup as Role;
use app\models\UserSearch;
use app\modules\clients\models\KlienSearch;
use yii\web\Response;
use yii\widgets\ActiveForm;

/**
 * ContactsController implements the CRUD actions for KlienKontak model.
 */
class ContactsController extends FController
{
    public $allowedRoles = [Role::ADMIN, Role::SALES];
    public $modelClass = 'app\modules\clients\models\KlienKontak';
    public $searchModelClass = 'app\modules\clients\models\KlienKontakSearch';
    public $title = 'Contact Person';

    /**
     * Lists all KlienKontak models by id_klien.
     *
     * @return string
     */
    public function actionView($clientId)
    {
        $searchModel = new ($this->searchModelClass)();
        $clientData = KlienSearch::getDetailClientByID($clientId);
        $dataProvider = $searchModel->search($clientId);

        return $this->render('view', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'clientData' => $clientData,
            'clientID' => $clientId
        ]);
    }
}

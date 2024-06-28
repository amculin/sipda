<?php

namespace app\modules\prospects\controllers;

use app\customs\FController;
use app\models\UserGrup as Role;
use app\modules\prospects\models\LeadSearch;
use app\modules\references\models\ProdukSearch;

/**
 * QuotationsController implements the CRUD actions for Quotation model.
 */
class QuotationsController extends FController
{
    public $allowedRoles = [Role::ADMIN, Role::SALES];
    public $additionalDataClass = [
        'index' => [
            'salesList' => 'app\models\UserSearch',
        ],
        'create' => [
            'eventList' => 'app\modules\references\models\ProgramSearch',
            'salesList' => 'app\models\UserSearch',
        ],
        'edit' => [
            'eventList' => 'app\modules\references\models\ProgramSearch',
            'salesList' => 'app\models\UserSearch'
        ],
    ];
    public $modelClass = 'app\modules\prospects\models\Quotation';
    public $searchModelClass = 'app\modules\prospects\models\QuotationSearch';
    public $title = 'Quotation';

    /**
     * @inheritdoc
     */
    public function actionCreate($leadId = null)
    {
        $model = new ($this->modelClass)();

        if ($this->request->isPost && $model->load($this->request->post())) {
            if ($model->save()) {
                return $this->redirect(['index']);
            } else {
                echo '<pre>';
                print_r($model->getErrors());
            }
        } else {
            $model->loadDefaultValues();
        }

        if (! is_null($leadId)) {
            $lead = LeadSearch::getLeadByID($leadId);
            $model->id_lead = $lead->id;
            $model->id_tahapan = $lead->id_tahapan;
            $model->nama_klien = $lead->nama_klien;
            $model->nama_perusahaan = $lead->nama_perusahaan;
            $model->nomor_telepon = $lead->nomor_telepon;
            $model->email = $lead->email;
        }

        $leadList = LeadSearch::getList();
        $lastCounter = ($this->searchModelClass)::getLastCounter();
        $model->kode = ($this->searchModelClass)::createUniqueCode($lastCounter);
        $productList = ProdukSearch::getList();

        return $this->render('form', [
            'model' => $model,
            'leadList' => $leadList,
            'productList' => $productList
        ]);
    }
}

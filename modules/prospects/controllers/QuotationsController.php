<?php

namespace app\modules\prospects\controllers;

use Yii;
use app\customs\FController;
use app\models\UserGrup as Role;
use app\modules\prospects\models\LeadSearch;
use app\modules\references\models\ProdukSearch;
use yii\web\Response;

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
        'edit' => [
            'leadList' => 'app\modules\prospects\models\LeadSearch',
            'productList' => 'app\modules\references\models\ProdukSearch'
        ],
    ];
    public $modelClass = 'app\modules\prospects\models\Quotation';
    public $searchModelClass = 'app\modules\prospects\models\QuotationSearch';
    public $title = 'Quotation';
    public $specialRules = ['approver' => [Role::ADMIN]];

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

    /**
    * @inheritdoc
    */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = $model::SCENARIO_UPDATE;

        if (Yii::$app->request->isAjax) {
            if ($model->load(Yii::$app->request->post())) {
                Yii::$app->response->format = Response::FORMAT_JSON;
    
                return ActiveForm::validate($model);
            }
        }

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        $data = [
            'model' => $model,
            'title' => 'Edit ' . $this->title
        ];

        if (isset($this->additionalDataClass) && array_key_exists('edit', $this->additionalDataClass)) {
            foreach ($this->additionalDataClass['edit'] as $key => $val) {
                $data[$key] = ($val)::getList();
            }
        }

        return $this->render('form', $data);
    }

    /**
     * Approve/Reject an existing Quotation model.
     * If approval/rejection is successful, the system will return success message.
     * @param int $id ID
     * @return Response
     * @throws UnprocessableEntityHttpException if the action cannot be executed
     */
    public function actionApprover($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $model = $this->findModel($id);

        if ($model->is_verified == $model::IS_VERIFIED) {
            $model->is_verified = $model::IS_REJECTED;
        } else {
            $model->is_verified = $model::IS_VERIFIED;
        }

        if (! $model->save()) {
            throw new UnprocessableEntityHttpException('Gagal');
        }

        return [
            'code' => 200,
            'message' => 'Sukses'
        ];
    }

    public function actionGetDetail($id)
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;

            $model = ($this->searchModelClass)::getQuotationByID($id);

            return [
                'nama_klien' => $model['nama_klien'],
                'nomor_telepon' =>$model['nomor_telepon'],
                'email' => $model['email'],
                'nama_perusahaan' => $model['nama_perusahaan'],
                'id_lead' => $model['id_lead']
            ];
        }
    }
}

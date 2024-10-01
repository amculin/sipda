<?php

namespace app\modules\sales\controllers;

use app\customs\FController;
use app\models\UserGrup as Role;
use app\modules\sales\models\PlanSearch;
use app\modules\sales\models\SalesOrderDetail;

/**
 * ComissionsController implements the CRUD actions for Comission model.
 */
class ComissionsController extends FController
{
    public $allowedRoles = [Role::ADMIN];
    public $modelClass = 'app\modules\sales\models\Comission';
    public $searchModelClass = 'app\modules\sales\models\ComissionSearch';
    public $title = 'Komisi Penjualan';

    public function actionDetail($id)
    {
        $model = ($this->searchModelClass)::findOne($id);
        $plan = PlanSearch::getCurrentPlan($model->sales_id);
        $products = SalesOrderDetail::getOrderedProducts($model->sales_id, $model->month, $model->year);

        return $this->render('detail', [
            'model' => $model,
            'plan' => $plan,
            'products' => $products
        ]);
    }
}

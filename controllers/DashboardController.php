<?php

namespace app\controllers;

use Yii;
use app\customs\FController;
use app\models\UserGrup as Role;
use app\modules\prospects\models\LeadSearch;
use app\modules\prospects\models\QuotationSearch;
use app\modules\sales\models\ComissionSearch;
use app\modules\sales\models\PlanSearch;
use app\modules\sales\models\SalesOrderSearch;

class DashboardController extends FController
{
    public $allowedRoles = [Role::ADMIN, Role::SALES];
    public $title = 'Komisi Penjualan';
    public $layout = 'main';

    public function actionIndex()
    {
        $isSales = Role::isSales();
        $data = ['isSales' => $isSales];

        if ($isSales) {
            $currentPlan = PlanSearch::getCurrentPlan(Yii::$app->user->identity->id);
            $currentAchievement = ComissionSearch::findComission(Yii::$app->user->identity->id, date('Y'), (int) date('m'));
            $achievement = ComissionSearch::getTotalAchievement(Yii::$app->user->identity->id);

            $data['currentPlan'] = $currentPlan;
            $data['currentAchievement'] = $currentAchievement;
            $data['achievement'] = $achievement;
            
            $salesOrders = new SalesOrderSearch();
            $lastOrders = $salesOrders->getLastOrders();

            $data['salesOrders'] = $salesOrders;
            $data['lastOrders'] = $lastOrders;

            $leads = new LeadSearch();
            $lastLeads = $leads->getLastLeads();

            $data['leads'] = $leads;
            $data['lastLeads'] = $lastLeads;

            $lastQuotations = QuotationSearch::getLastQuotations();
            $data['lastQuotations'] = $lastQuotations;
        }

        return $this->render('index', $data);
    }
}

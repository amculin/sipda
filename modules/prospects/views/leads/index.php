<?php

use app\modules\prospects\models\Lead;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\prospects\models\LeadSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
?>
<div class="page-wrapper" data-menu-active="Prospek" data-submenu-active="Leads">
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle mb-2">
                        <ol class="breadcrumb" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="<?= Url::to('/dashboard/index', true); ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Prospek</a></li>
                            <li class="breadcrumb-item active"><a href="#">Leads</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title">Leads</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <nav class="pt-3 px-3 pb-0 card-header">
                    <ul class="nav nav-tabs border-0 nav-theme">
                        <?php
                        $backgroundColor = null;
                        
                        foreach ($stepList as $key => $val) {
                            echo Html::beginTag('li', ['class' => 'nav-item']);
                            $content = Html::tag('i', ' ', ['class' => $val['icon'] . ' fs-3 me-2']);
                            $linkClass = 'nav-link';
                            $linkClass .= $stepId == $val['id'] ? ' active' : '';
                            echo Html::a($content. ' ' . $val['nama'], Url::to(['/prospects/leads/index', 'stepId' => $val['id']], true), ['class' => $linkClass]);
                            echo Html::endTag('li');

                            if ($stepId == $val['id']) {
                                $backgroundColor = $val['warna'];
                            }
                        }
                        ?>
                        <li class="nav-item">
                            <?php $linkClass = is_null($stepId) ? ' active' : ''; ?>
                            <a href="<?= Url::to(['/prospects/leads/index', 'stepId' => null], true); ?>" class="nav-link<?= $linkClass; ?>">
                                <i class="bi bi-book fs-3 me-2"></i> ALL DATA
                            </a>
                        </li>
                    </ul>
                </nav>
                <?php
                $viewFile = is_null($stepId) ? '_index-all' : '_index-by-step';

                echo $this->render($viewFile, [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'stepList' => $stepList,
                    'salesList' => $salesList,
                ]);
                ?>
            </div>
        </div>
    </div>
</div>
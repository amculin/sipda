<?php

use app\customs\FActionColumn;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\sales\models\PlanSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
?>

<div class="page-wrapper" data-menu-active="Planning">
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle mb-2">
                        <ol class="breadcrumb" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="<?= Url::to('/dashboard/index', true); ?>">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#">Planning</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title">Planning</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <!-- <a href="<?= Url::to('/references/steps/create', true); ?>" class="btn btn-primary d-none d-sm-inline-block modal-trigger"
                        data-bs-toggle="modal" data-bs-target="#modal-form">
                        <i class="bi bi-plus"></i>
                        Tambah Data
                    </a> -->
                    <div class="ms-auto d-flex gap-2">
                        <?php $form = ActiveForm::begin([
                            'action' => ['index'],
                            'method' => 'get',
                            'options' => ['style' => 'display: contents;']
                        ]);
                        $startYear = date('Y') - 3;
                        $yearList = [];

                        for ($i = date('Y'); $i >= $startYear; $i--) {
                            $yearList[$i] = $i;
                        }

                        echo $form->field($searchModel, 'tahun', ['options' => ['tag' => false]])->dropDownList($yearList, [
                            'prompt' => 'Semua Tahun',
                            'class' => 'form-select',
                            'style' => 'width: 160px;',
                            'tag' => false
                        ])->label(false);
                        ?>
                        <div class="input-group">
                            <?= $form->field($searchModel, 'name', ['options' => ['tag' => false]])->textInput([
                                'placeholder' => 'Cari data..',
                                'tag' => false
                            ])->label(false); ?>
                            <?= Html::submitButton('<i class="bi bi-search"></i>', ['class' => 'btn']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
                <div class="table-responsive card-body p-0">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => null,
                        'layout' => "{items}\n{pager}",
                        'tableOptions' => ['class' => 'table'],
                        'columns' => [
                            [
                                'class' => 'yii\grid\SerialColumn',
                                'header' => 'No',
                                'headerOptions' => ['width' => '5'],
                            ],
                            [
                                'class' => FActionColumn::className(),
                                'urlCreator' => function ($action, Array $model, $key, $index, $column) {
                                    return Url::toRoute([$action, 'id' => $model['id']]);
                                },
                                'headerOptions' => ['width' => '10'],
                                'contentOptions' => [
                                    'class' => 'text-nowrap d-flex gap-2'
                                ],
                                'template' => '{update}',
                                'buttons' => [
                                    'update' => function ($url, $model, $key) {
                                        $icon = Html::tag('i', '', [
                                            'class' => 'bi bi-diagram-3 me-2',
                                            'data-bs-toggle' => 'tooltip',
                                            'data-bs-placement' => 'bottom',
                                            'title' => 'Update Plan'
                                        ]);
                        
                                        return Html::a($icon . ' Planning', $url, ['class' => 'btn btn-outline-info btn-sm rounded-pill px-3']);
                                    }
                                ],
                            ],
                            [
                                'header' => 'NIP Sales',
                                'value' => function ($model) {
                                    return 'SL' . str_pad($model['id_sales'], 4, '0', STR_PAD_LEFT);
                                },
                                'headerOptions' => ['width' => '200'],
                            ],
                            [
                                'header' => 'Nama Sales',
                                'value' => function ($model) {
                                    return $model['nama'];
                                },
                            ],
                            [
                                'header' => 'Jabatan',
                                'value' => function ($model) {
                                    return $model['jabatan'];
                                }
                            ],
                            [
                                'header' => 'Tahun',
                                'value' => function ($model) {
                                    return $model['tahun'];
                                },
                                'headerOptions' => ['width' => '60'],
                            ],
                            [
                                'header' => 'Target Penjualan',
                                'value' => function ($model) {
                                    return number_format($model['target_penjualan'], 0, ",", ".");
                                },
                                'headerOptions' => ['class' => 'text-end'],
                                'contentOptions' => ['class' => 'text-end']
                            ],
                            [
                                'header' => 'Target Dasar Komisi',
                                'value' => function ($model) {
                                    return number_format($model['target_komisi'], 0, ",", ".");
                                },
                                'headerOptions' => ['class' => 'text-end'],
                                'contentOptions' => ['class' => 'text-end']
                            ],
                        ],
                        'pager' => [
                            'class' => 'app\customs\FLinkPager',
                            'options' => ['class' => 'pagination ms-auto m-0'],
                            'linkContainerOptions' => ['class' => 'page-item'],
                            'linkOptions' => ['class' => 'page-link'],
                        ]
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

use app\customs\FActionColumn;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\sales\models\ComissionSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
?>
<div class="page-wrapper" data-menu-active="Komisi Penjualan">
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle mb-2">
                        <ol class="breadcrumb" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="<?= Url::to('/dashboard/index', true); ?>">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#">Komisi Penjualan</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title">Komisi Penjualan</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <div class="ms-auto d-flex gap-2">
                        <?php $form = ActiveForm::begin([
                            'action' => ['index'],
                            'method' => 'get',
                            'options' => ['style' => 'display: contents;']
                        ]); ?>
                        <?php
                        $startYear = date('Y') - 3;
                        $yearList = [];

                        for ($i = date('Y'); $i >= $startYear; $i--) {
                            $yearList[$i] = $i;
                        }

                        echo $form->field($searchModel, 'is_achieved', ['options' => ['tag' => false]])->dropDownList([
                            1 => 'Mencapai Target',
                            0 => 'Tidak Mencapai Target'
                        ], [
                            'prompt' => 'Semua Status',
                            'class' => 'form-select',
                            'style' => 'width: 200px;',
                            'tag' => false
                        ])->label(false);

                        echo $form->field($searchModel, 'year', ['options' => ['tag' => false]])->dropDownList($yearList, [
                            'prompt' => 'Semua Tahun',
                            'class' => 'form-select',
                            'style' => 'width: 160px;',
                            'tag' => false
                        ])->label(false);

                        $monthList = [];

                        for ($i = 1; $i < 13; $i++) {
                            $monthList[str_pad($i, 2, '0', STR_PAD_LEFT)] = date('F', mktime(0, 0, 0, $i, 1, date('Y')));
                        }

                        echo $form->field($searchModel, 'month', ['options' => ['tag' => false]])->dropDownList($monthList, [
                            'prompt' => 'Semua Bulan',
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
                                'urlCreator' => function ($action, array $model, $key, $index, $column) {
                                    return Url::toRoute([$action, 'id' => $model['id']]);
                                },
                                'headerOptions' => ['width' => '10'],
                                'contentOptions' => [
                                    'class' => 'text-nowrap text-center gap-2'
                                ],
                                'template' => '{detail}',
                                'buttons' => [
                                    'detail' => function ($url, $model, $key) {
                                        $icon = Html::tag('i', '', [
                                            'class' => 'bi bi-card-list',
                                            'data-bs-toggle' => 'tooltip',
                                            'data-bs-placement' => 'bottom',
                                            'title' => 'Detail'
                                        ]);
                        
                                        return Html::a($icon, $url, ['class' => 'text-dark']);
                                    }
                                ],
                            ],
                            [
                                'header' => 'Periode',
                                'value' => function ($data) {
                                    return $data['month'] . '/' . $data['year'];
                                },
                            ],
                            [
                                'header' => 'NIP Sales',
                                'value' => function ($data) {
                                    return 'SL' . str_pad($data['sales_id'], 4, '0', STR_PAD_LEFT);
                                },
                            ],
                            [
                                'header' => 'Nama Sales',
                                'value' => function ($data) {
                                    return $data['sales_name'];
                                },
                            ],
                            [
                                'header' => 'Jabatan',
                                'value' => function ($data) {
                                    return $data['position'];
                                },
                            ],
                            [
                                'header' => 'Komisi Jabatan',
                                'value' => function ($data) {
                                    return $data['office_comission'] . '%';
                                },
                                'contentOptions' => [
                                    'class' => 'text-end'
                                ],
                                'headerOptions' => [
                                    'class' => 'text-end'
                                ],
                            ],
                            [
                                'header' => 'Target Penjualan',
                                'value' => function ($data) use ($searchModel) {
                                    return $searchModel->parseSaleTarget($data);
                                },
                                'contentOptions' => [
                                    'class' => 'text-end'
                                ],
                                'headerOptions' => [
                                    'class' => 'text-end'
                                ],
                            ],
                            [
                                'header' => 'Jumlah Penjualan',
                                'value' => function ($data) use ($searchModel) {
                                    return $searchModel->toRupiah($data['total_sale']);
                                },
                                'contentOptions' => [
                                    'class' => 'text-end'
                                ],
                                'headerOptions' => [
                                    'class' => 'text-end'
                                ],
                            ],
                            [
                                'header' => 'Capaian',
                                'value' => function ($data) use ($searchModel) {
                                    return $searchModel->countPercentage($data['total_sale']);
                                },
                                'contentOptions' => [
                                    'class' => 'text-end'
                                ],
                                'headerOptions' => [
                                    'class' => 'text-end'
                                ],
                            ],
                            [
                                'header' => 'Komisi',
                                'value' => function ($data) use ($searchModel) {
                                    return $searchModel->toRupiah($data['comission']);
                                },
                                'contentOptions' => [
                                    'class' => 'text-end fw-bold'
                                ],
                                'headerOptions' => [
                                    'class' => 'text-end'
                                ],
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

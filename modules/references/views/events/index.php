<?php

use app\assets\FormModalAsset;
use app\customs\FActionColumn;
use app\customs\FDeleteAlert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\references\models\ProgramSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
?>
<div class="page-wrapper" data-menu-active="Program">
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle mb-2">
                        <ol class="breadcrumb" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="<?= Url::to('/dashboard/index', true); ?>">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#">Program</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title">Program / Event</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <a href="<?= Url::to('/references/events/create', true); ?>" class="btn btn-primary d-none d-sm-inline-block modal-trigger"
                        data-bs-toggle="modal" data-bs-target="#modal-form">
                        <i class="bi bi-plus"></i>
                        Tambah Data
                    </a>
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

                        echo $form->field($searchModel, 'tanggal_mulai', ['options' => ['tag' => false]])->dropDownList($yearList, [
                            'prompt' => 'Semua Tahun',
                            'class' => 'form-select',
                            'style' => 'width: 160px;',
                            'tag' => false
                        ])->label(false);
                        ?>
                        <div class="input-group">
                            <?= $form->field($searchModel, 'nama', ['options' => ['tag' => false]])->textInput([
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
                                'template' => '{update} {enabler} {delete}',
                                'buttons' => [
                                    'enabler' => function ($url, $model, $key) {
                                        $icon = Html::tag('i', '', [
                                            'class' => $model['is_disabled'] == 1 ? 'bi bi-check-circle' : 'bi bi-slash-circle',
                                            'data-bs-toggle' => 'tooltip',
                                            'data-bs-placement' => 'bottom',
                                            'title' => $model['is_disabled'] == 1 ? 'Enable' : 'Disable'
                                        ]);
                        
                                        return Html::a($icon, $url, ['class' => 'text-dark lock-user']);
                                    }
                                ],
                            ],
                            [
                                'header' => $searchModel->attributeLabels()['kode'],
                                'value' => function ($data) {
                                    return $data['kode'];
                                },
                            ],
                            [
                                'header' => $searchModel->attributeLabels()['nama'],
                                'value' => function ($data) {
                                    return $data['nama'];
                                },
                            ],
                            [
                                'header' => $searchModel->attributeLabels()['lokasi'],
                                'value' => function ($data) {
                                    return $data['lokasi'];
                                },
                            ],
                            [
                                'header' => $searchModel->attributeLabels()['tanggal_mulai'],
                                'value' => function ($data) {
                                    return $data['tanggal_mulai'];
                                },
                            ],
                            [
                                'header' => $searchModel->attributeLabels()['tanggal_selesai'],
                                'value' => function ($data) {
                                    return $data['tanggal_selesai'];
                                },
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


<div class="modal fade modal-blur steps-form" id="modal-form" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        </div>
    </div>
</div>

<?php
FormModalAsset::register($this);
?>
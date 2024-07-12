<?php

use app\assets\FormModalAsset;
use app\modules\broadcasts\models\BroadcastConfig;
use app\customs\FActionColumn;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\broadcasts\models\BroadcastConfigSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
?>
<div class="page-wrapper" data-menu-active="Broadcast" data-submenu-active="Konfigurasi">
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle mb-2">
                        <ol class="breadcrumb" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="<?= Url::to('/dashboard/index', true); ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Broadcast</a></li>
                            <li class="breadcrumb-item active"><a href="#">Konfigurasi</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title">Konfigurasi Broadcast Email</h2>
                    
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
                            ],
                            [
                                'header' => 'NIP Sales',
                                'value' => function ($data) {
                                    return $data['sales_id'];
                                },
                            ],
                            [
                                'header' => 'Nama Sales',
                                'value' => function ($data) {
                                    return $data['nama'];
                                },
                            ]
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

<!-- Modal -->
<div class="modal fade modal-blur" id="modal-form" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        </div>
    </div>
</div>
<?php
FormModalAsset::register($this);
?>
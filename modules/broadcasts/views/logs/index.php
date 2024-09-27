<?php

use app\modules\broadcasts\models\BroadcastLog;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\broadcasts\models\BroadcastLogSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
?>
<div class="page-wrapper" data-menu-active="Broadcast" data-submenu-active="Log Email">
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle mb-2">
                        <ol class="breadcrumb" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="<?= Url::to('/dashboard/index', true); ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Broadcast</a></li>
                            <li class="breadcrumb-item active"><a href="#">Log Email</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title">Log Email</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <div class="ms-auto">
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
                                'header' => 'Nama Sales',
                                'value' => function ($data) {
                                    return $data['sales_name'];
                                },
                            ],
                            [
                                'header' => 'Kode Broadcast',
                                'value' => function ($data) {
                                    return $data['kode'];
                                },
                            ],
                            [
                                'header' => 'Subject',
                                'value' => function ($data) {
                                    return $data['judul'];
                                },
                            ],
                            [
                                'header' => $searchModel->attributeLabels()['nama_tujuan'],
                                'value' => function ($data) {
                                    return $data['nama_tujuan'];
                                },
                            ],
                            [
                                'header' => $searchModel->attributeLabels()['email_tujuan'],
                                'value' => function ($data) {
                                    return $data['email_tujuan'];
                                },
                            ],
                            [
                                'header' => $searchModel->attributeLabels()['timestamp'],
                                'value' => function ($data) {
                                    return $data['timestamp'];
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
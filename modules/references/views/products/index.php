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
/** @var app\modules\references\models\KategoriSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
?>
<div class="page-wrapper" data-menu-active="Referensi" data-submenu-active="Produk">
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle mb-2">
                        <ol class="breadcrumb" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="<?= Url::to('/dashboard/index', true); ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Referensi</a></li>
                            <li class="breadcrumb-item active"><a href="#">Produk</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title">Produk</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <a href="<?= Url::to('/references/products/create', true); ?>" class="btn btn-primary d-none d-sm-inline-block modal-trigger"
                        data-bs-toggle="modal" data-bs-target="#modal-form">
                        <i class="bi bi-plus"></i>
                        Tambah Data
                    </a>
                    <div class="ms-auto">
                        <?php $form = ActiveForm::begin([
                            'action' => ['index'],
                            'method' => 'get',
                            'options' => ['style' => 'display: contents;']
                        ]); ?>
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
                            ],
                            [
                                'header' => 'Kategori',
                                'value' => function ($data) {
                                    return $data['category'];
                                },
                                'headerOptions' => ['width' => '200']
                            ],
                            [
                                'header' => 'Kode Produk',
                                'value' => function ($data) {
                                    return $data['kode'];
                                },
                                'headerOptions' => ['width' => '200']
                            ],
                            'nama',
                            [
                                'header' => 'Harga Pokok',
                                'value' => function ($data) {
                                    return number_format($data['harga_pokok'], 0, ",", ".");
                                },
                                'headerOptions' => ['width' => '140', 'class' => 'text-end'],
                                'contentOptions' => ['class' => 'text-end']
                            ],
                            [
                                'header' => 'Harga Jual',
                                'value' => function ($data) {
                                    return number_format($data['harga_jual'], 0, ",", ".");
                                },
                                'headerOptions' => ['width' => '140', 'class' => 'text-end'],
                                'contentOptions' => ['class' => 'text-end']
                            ],
                            [
                                'header' => 'Jumlah Stock',
                                'value' => function ($data) {
                                    return $data['jumlah_stock'];
                                },
                                'headerOptions' => ['width' => '60', 'class' => 'text-end'],
                                'contentOptions' => ['class' => 'text-end']
                            ],
                        ],
                        'pager' => [
                            'class' => 'app\customs\FLinkPager',
                            'options' => ['class' => 'pagination ms-auto m-0'],
                            'linkContainerOptions' => ['class' => 'page-item'],
                            'linkOptions' => ['class' => 'page-link']
                        ]
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade modal-blur users-form" id="modal-form" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        </div>
    </div>
</div>

<?php
FormModalAsset::register($this);
?>
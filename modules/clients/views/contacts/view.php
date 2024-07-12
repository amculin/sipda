<?php

use app\customs\FActionColumn;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\clients\models\KlienKontakSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
?>
<div class="page-wrapper" data-menu-active="Klien">
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle mb-2">
                        <ol class="breadcrumb" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="<?= Url::to('/dashboard/index', true); ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?= Url::to('/clients/companies/index', true); ?>">Klien</a></li>
                            <li class="breadcrumb-item active"><a href="#">Contact Person</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title">Contact Person</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">

            <div class="card h-100">
                <div class="row g-3">
                    <div class="col-lg">
                        <div class="card-header py-3 border-0 px-2 fw-bold">INFORMASI KLIEN</div>
                        <table class="table m-0 table-borderless table-striped">
                            <tr>
                                <td>Nama Klien</td>
                                <td class="text-end"><?= $clientData['nama']; ?></td>
                            </tr>
                            <tr>
                                <td>Nama Perusahaan</td>
                                <td class="text-end"><?= $clientData['nama_perusahaan']; ?></td>
                            </tr>
                            <tr>
                                <td>Nomor Telefon</td>
                                <td class="text-end"><?= $clientData['nomor_telepon']; ?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td class="text-end"><?= $clientData['email']; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-form">
                        <i class="bi bi-plus"></i>
                        Tambah Data
                    </a>
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
                                            'class' => $model['is_disabled'] == 1 ? 'bi bi-x-circle' : 'bi bi-check-circle',
                                            'data-bs-toggle' => 'tooltip',
                                            'data-bs-placement' => 'bottom',
                                            'title' => $model['is_disabled'] == 1 ? 'Non Aktifkan' : 'Aktifkan'
                                        ]);

                                        $aClass = $model['is_disabled'] == 1 ? 'text-danger' : 'text-success';
                        
                                        return Html::a($icon, $url, ['class' => 'client-enabler ' . $aClass]);
                                    }
                                ],
                            ],
                            [
                                'header' => $searchModel->attributeLabels()['nama'],
                                'value' => function ($data) {
                                    return $data['nama'];
                                },
                            ],
                            [
                                'header' => $searchModel->attributeLabels()['posisi'],
                                'value' => function ($data) {
                                    return $data['posisi'];
                                },
                            ],
                            [
                                'header' => $searchModel->attributeLabels()['nomor_telepon'],
                                'value' => function ($data) {
                                    return $data['nomor_telepon'];
                                },
                            ],
                            [
                                'header' => $searchModel->attributeLabels()['email'],
                                'value' => function ($data) {
                                    return $data['email'];
                                },
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

<!-- Modal -->
<div class="modal fade modal-blur" id="modal-form" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Contact Person</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-2">
                    <label for="" class="form-label">Nama</label>
                    <input type="text" class="form-control">
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Posisi</label>
                    <input type="text" class="form-control">
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Nomor HP</label>
                    <input type="text" class="form-control">
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Email</label>
                    <input type="email" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
            </div>
        </div>
    </div>
</div>
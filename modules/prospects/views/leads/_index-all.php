<?php

use app\assets\FormModalAsset;
use app\customs\FActionColumn;
use app\customs\FDeleteAlert;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var app\modules\prospects\models\LeadSearch $model */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var yii\web\View $this */
/** @var yii\widgets\ActiveForm $form */
?>
<div class="card-header card-header-theme">
    <a href="<?= Url::to('/broadcast/channels/create', true); ?>" class="btn btn-default d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-channel">
        <i class="bi bi-person-add"></i>
        Tambahkan ke Channel
    </a>
    <div class="ms-auto d-flex gap-2">
        <?php $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
            'options' => ['style' => 'display: contents;']
        ]);
        $startYear = date('Y') - 3;
        $yearList = [];
        $stepList = ArrayHelper::map($stepList, 'id', 'nama');

        for ($i = date('Y'); $i >= $startYear; $i--) {
            $yearList[$i] = $i;
        }

        echo $form->field($searchModel, 'id_sales', ['options' => ['tag' => false]])->dropDownList($salesList, [
            'prompt' => 'Semua Sales',
            'class' => 'form-select',
            'style' => 'width: 160px;',
            'tag' => false
        ])->label(false);

        echo $form->field($searchModel, 'year', ['options' => ['tag' => false]])->dropDownList($yearList, [
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
                /* 'buttons' => [
                    'enabler' => function ($url, $model, $key) {
                        $icon = Html::tag('i', '', [
                            'class' => $model['is_disabled'] == 1 ? 'bi bi-check-circle' : 'bi bi-slash-circle',
                            'data-bs-toggle' => 'tooltip',
                            'data-bs-placement' => 'bottom',
                            'title' => $model['is_disabled'] == 1 ? 'Enable' : 'Disable'
                        ]);
        
                        return Html::a($icon, $url, ['class' => 'text-dark lock-event']);
                    }
                ], */
            ],
            [
                'header' => $searchModel->attributeLabels()['id_sales'],
                'value' => function ($data) {
                    return $data['nama'];
                },
            ],
            [
                'header' => $searchModel->attributeLabels()['kode'],
                'value' => function ($data) {
                    return $data['kode'];
                },
            ],
            [
                'header' => 'Nama Prospek',
                'value' => function ($data) {
                    return $data['kebutuhan'];
                },
            ],
            [
                'header' => $searchModel->attributeLabels()['nama_perusahaan'],
                'value' => function ($data) {
                    return $data['nama_perusahaan'];
                },
            ],
            [
                'header' => $searchModel->attributeLabels()['nilai'],
                'value' => function ($data) {
                    return $data['nilai'];
                },
                'headerOptions' => ['class' => 'text-end']
            ],
            [
                'header' => $searchModel->attributeLabels()['id_tahapan'],
                'value' => function ($data) {
                    return $data['id_tahapan'];
                    //$content = Html::tag('i', ['class' => ])
                    //return Html::a()<a href="#" class="btn btn-info btn-sm rounded-pill"><i class="bi bi-snow3 pe-2"></i>COLD</a>
                },
                'headerOptions' => ['class' => 'text-center'],
                'contentOptions' => ['class' => 'text-nowrap gap-2 text-center']
            ],
        ],
        'pager' => [
            'class' => 'app\customs\FLinkPager',
            'options' => ['class' => 'pagination ms-auto m-0'],
            'linkContainerOptions' => ['class' => 'page-item'],
            'linkOptions' => ['class' => 'page-link'],
        ]
    ]);
    ?>
</div>

<!-- Modal -->
<div class="modal fade modal-blur" id="modal-form" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Leads</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-2">
                    <label for="" class="form-label">Nama Kontak</label>
                    <input type="text" class="form-control">
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Nomor Telepon</label>
                    <input type="text" class="form-control" style="width:200px">
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Email</label>
                    <input type="text" class="form-control">
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Nama Perusahaan</label>
                    <input type="text" class="form-control">
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Kebutuhan</label>
                    <textarea class="form-control"></textarea>
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Harga Penawaran</label>
                    <input type="text" class="form-control" style="width:200px" value="Rp.">
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Event Promosi</label>
                    <select class="form-select">
                        <option>Bukan Event Promosi</option>
                        <option>EV23010008 - Promo Awal Tahun</option>
                        <option>EV23030009 - Promo Lebaran</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade modal-blur" id="modal-channel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambahkan Channel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-2">
                    Aksi ini akan menambahkan leads yang dipilih ke dalam channel broadcast. Silahkan pilih channel yang dituju.
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Pilih Channel</label>
                    <select class="form-select">
                        <option>Badan Perencanaan</option>
                        <option>Perusahaan Alat Kesehatan</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade modal-blur" id="modal-konversi" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konversi Prospek</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-2">
                    <label for="" class="form-label">Tahapan Prospek</label>
                    <select class="form-select">
                        <option>COLD</option>
                        <option>WARM</option>
                        <option>HOT</option>
                        <option selected>FAIL</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Lampiran Dokumen</label>
                    <input type="file" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade modal-blur" id="modal-tracking" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tracking Prospek</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="list-group">
                    <div class="list-group-item">
                        <div class="row">
                            <div class="col-auto">
                                <span class="avatar bg-primary rounded-circle"><i class="bi bi-megaphone h1 m-0"></i></span>
                            </div>
                            <div class="col">
                                <div class="fw-bold mb-1 text-truncate">Promosi : Promo Lebaran</div>
                                <div class="text-secondary fs-5 hstack gap-3">
                                    <span><i class="bi bi-calendar-week me-1"></i> 12 Mei 2023</span>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                
                            </div>
                        </div>
                    </div>
                    <div class="list-group-item">
                        <div class="row">
                            <div class="col-auto">
                                <span class="avatar bg-info rounded-circle"><i class="bi bi-snow3 h1 m-0"></i></span>
                            </div>
                            <div class="col">
                                <div class="fw-bold mb-1 text-truncate">Cold Prospek</div>
                                <div class="text-secondary fs-5 hstack gap-3">
                                    <span><i class="bi bi-calendar-week me-1"></i> 14 Juni 2023</span>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="fw-bold mb-1 text-truncate">Harga</div>
                                <div class="text-secondary fs-5 hstack gap-3">
                                    <span><i class="bi bi-cash-stack me-1"></i> 160.000.000</span>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <button type="button" class="btn btn-default">Lampiran</button>
                            </div>
                        </div>
                    </div>
                    <div class="list-group-item">
                        <div class="row">
                            <div class="col-auto">
                                <span class="avatar bg-warning rounded-circle"><i class="bi bi-cloud-sun h1 m-0"></i></span>
                            </div>
                            <div class="col">
                                <div class="fw-bold mb-1 text-truncate">Warm Prospek</div>
                                <div class="text-secondary fs-5 hstack gap-3">
                                    <span><i class="bi bi-calendar-week me-1"></i> 21 Juli 2023</span>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="fw-bold mb-1 text-truncate">Harga</div>
                                <div class="text-secondary fs-5 hstack gap-3">
                                    <span><i class="bi bi-cash-stack me-1"></i> 160.000.000</span>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <button type="button" class="btn btn-default">Lampiran</button>
                            </div>
                        </div>
                    </div>
                    <div class="list-group-item">
                        <div class="row">
                            <div class="col-auto">
                                <span class="avatar bg-danger rounded-circle"><i class="bi bi-sun h1 m-0"></i></span>
                            </div>
                            <div class="col">
                                <div class="fw-bold mb-1 text-truncate">Hot Prospek</div>
                                <div class="text-secondary fs-5 hstack gap-3">
                                    <span><i class="bi bi-calendar-week me-1"></i> 1 Agustus 2023</span>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="fw-bold mb-1 text-truncate">Harga</div>
                                <div class="text-secondary fs-5 hstack gap-3">
                                    <span><i class="bi bi-cash-stack me-1"></i> 155.000.000</span>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <button type="button" class="btn btn-default">Lampiran</button>
                            </div>
                        </div>
                    </div>
                    <div class="list-group-item">
                        <div class="row">
                            <div class="col-auto">
                                <span class="avatar bg-success rounded-circle"><i class="bi bi-check2-circle h1 m-0"></i></span>
                            </div>
                            <div class="col">
                                <div class="fw-bold mb-1 text-truncate">Deal</div>
                                <div class="text-secondary fs-5 hstack gap-3">
                                    <span><i class="bi bi-calendar-week me-1"></i> 18 Agustus 2023</span>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="fw-bold mb-1 text-truncate">Harga</div>
                                <div class="text-secondary fs-5 hstack gap-3">
                                    <span><i class="bi bi-cash-stack me-1"></i> 152.000.000</span>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <button type="button" class="btn btn-default">Lampiran</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
            </div>
        </div>
    </div>
</div>
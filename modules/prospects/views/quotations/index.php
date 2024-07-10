<?php

use app\assets\FormModalAsset;
use app\customs\FActionColumn;
use app\customs\FDeleteAlert;
use app\models\UserGrup as Role;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\prospects\models\QuotationSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */
$approverRole = Role::ADMIN;
?>
<div class="page-wrapper" data-menu-active="Prospek" data-submenu-active="Quotation">
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle mb-2">
                        <ol class="breadcrumb" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="<?= Url::to('/dashboard/index', true); ?>">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#">Prospek</a></li>
                            <li class="breadcrumb-item active"><a href="#">Quotation</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title">Quotation</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <a href="<?= Url::to('/prospects/quotations/create', true); ?>" class="btn btn-primary d-none d-sm-inline-block">
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

                        echo $form->field($searchModel, 'is_verified', ['options' => ['tag' => false]])->dropDownList([
                            1 => 'Disetujui',
                            0 => 'Ditolak'
                        ], [
                            'prompt' => 'Semua Status',
                            'class' => 'form-select',
                            'style' => 'width: 140px;',
                            'tag' => false
                        ])->label(false);

                        if (Yii::$app->user->identity->id_grup == Role::ADMIN) {
                            echo $form->field($searchModel, 'sales_id', ['options' => ['tag' => false]])->dropDownList($salesList, [
                                'prompt' => 'Semua Sales',
                                'class' => 'form-select',
                                'style' => 'width: 160px;',
                                'tag' => false
                            ])->label(false);
                        }

                        echo $form->field($searchModel, 'year', ['options' => ['tag' => false]])->dropDownList($yearList, [
                            'prompt' => 'Semua Tahun',
                            'class' => 'form-select',
                            'style' => 'width: 140px;',
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
                                'template' => '{update} {print} {mailer} {approver} {delete}',
                                'buttons' => [
                                    'update' => function ($url, $model, $key) {
                                        $icon = Html::tag('i', '', [
                                            'class' => 'bi bi-pencil',
                                            'data-bs-toggle' => 'tooltip',
                                            'data-bs-placement' => 'bottom',
                                            'title' => 'Edit'
                                        ]);
                        
                                        return Html::a($icon, $url, ['class' => 'text-dark']);
                                    },
                                    'print' => function ($url, $model, $key) {
                                        $icon = Html::tag('i', '', [
                                            'class' => 'bi bi-printer',
                                            'data-bs-toggle' => 'tooltip',
                                            'data-bs-placement' => 'bottom',
                                            'title' => 'Cetak'
                                        ]);
                        
                                        return Html::a($icon, $url, ['class' => 'text-dark']);
                                    },
                                    'mailer' => function ($url, $model, $key) {
                                        $icon = Html::tag('i', '', [
                                            'class' => 'bi bi-envelope-at',
                                            'data-bs-toggle' => 'tooltip',
                                            'data-bs-placement' => 'bottom',
                                            'title' => 'Kirim Email'
                                        ]);
                        
                                        return Html::a($icon, $url, ['class' => 'text-primary']);
                                    },
                                    'approver' => function ($url, $model, $key) {
                                        $icon = Html::tag('i', '', [
                                            'class' => $model['is_verified'] == 1 ? 'bi bi-check-circle' : 'bi bi-x-circle',
                                            'data-bs-toggle' => 'tooltip',
                                            'data-bs-placement' => 'bottom',
                                            'title' => $model['is_verified'] == 1 ? 'Tolak' : 'Setujui'
                                        ]);

                                        $aClass = $model['is_verified'] == 1 ? 'text-success' : 'text-danger';
                        
                                        return Html::a($icon, $url, ['class' => 'quotation-approver ' . $aClass]);
                                    },
                                ],
                                'visibleButtons' => [
                                    'approver' => function ($model, $key, $index) use ($approverRole) {
                                        return Yii::$app->user->identity->id_grup == $approverRole;
                                    }
                                ]
                            ],
                            [
                                'header' => 'Nama Sales',
                                'value' => function ($data) {
                                    return $data['nama'];
                                },
                            ],
                            [
                                'header' => 'Nomor Surat',
                                'value' => function ($data) {
                                    return $data['kode'];
                                },
                            ],
                            [
                                'header' => 'Judul Penawaran',
                                'value' => function ($data) {
                                    return $data['kebutuhan'];
                                },
                            ],
                            [
                                'header' => 'Tanggal Surat',
                                'value' => function ($data) {
                                    return date('d/m/Y', strtotime($data['tanggal']));
                                },
                            ],
                            [
                                'header' => 'Perusahaan',
                                'value' => function ($data) {
                                    return $data['nama_perusahaan'];
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

$js = "
$('#w1 a.quotation-approver').click(function(event) {
    event.preventDefault();
    
    var url = $(this).attr('href');
    var action = ($(this).find('i').attr('data-bs-original-title') == 'Setujui') ? 'Setujui' : 'Tolak';
    var csrfToken = $('meta[name=\"csrf-token\"]').attr('content');

    Swal.fire({
        title: action + ' Quotation?',
        text: 'Apakah anda yakin?',
        icon: 'warning',
        showCancelButton: true,
        reverseButtons:true,
        confirmButtonText: 'Ya, ' + action + ' Quotation!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url : url,
                type : 'POST',
                data: {_csrf : csrfToken},
                success : function(data){
                    if (data.code == 200) {
                        var title = 'Sukses!';
                        var message = 'Quotation Berhasil Di-' + action.toLowerCase();
                        var icon = 'success';
                    } else {
                        var title = 'Gagal!';
                        var message = 'Quotation Gagal Di' + action.toLowerCase();
                        var icon = 'error';
                    }
                    Swal.fire(
                        title,
                        message,
                        icon
                    ).then((result) => {
                        location.reload();
                    });
                }
            });
        }
    })
});
";

$this->registerJs($js, $this::POS_END, 'event-lock-handler');
?>
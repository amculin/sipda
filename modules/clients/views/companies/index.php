<?php

use app\customs\FActionColumn;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\clients\models\KlienSearch $searchModel */
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
                            <li class="breadcrumb-item active"><a href="#">Klien</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title">Klien</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <a href="<?= Url::to('/clients/companies/create', true); ?>" class="btn btn-primary d-none d-sm-inline-block">
                        <i class="bi bi-plus"></i>
                        Tambah Data
                    </a>
                    <div class="ms-auto d-flex gap-2">
                        <?php
                        $form = ActiveForm::begin([
                            'action' => ['index'],
                            'method' => 'get',
                            'options' => ['style' => 'display: contents;']
                        ]);
                        echo $form->field($searchModel, 'is_disabled', ['options' => ['tag' => false]])->dropDownList($searchModel::getStatusList(), [
                            'prompt' => 'Semua Status',
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
                                    'update' => function ($url, $model, $key) {
                                        $icon = Html::tag('i', '', [
                                            'class' => 'bi bi-pencil',
                                            'data-bs-toggle' => 'tooltip',
                                            'data-bs-placement' => 'bottom',
                                            'title' => 'Edit'
                                        ]);
                        
                                        return Html::a($icon, $url, ['class' => 'text-dark']);
                                    },
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
                                'header' => $searchModel->attributeLabels()['nama_perusahaan'],
                                'value' => function ($data) {
                                    return $data['nama_perusahaan'];
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
                            [
                                'header' => $searchModel->attributeLabels()['alamat'],
                                'value' => function ($data) {
                                    return $data['alamat'];
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
<?php
$js = "
$('#w1 a.client-enabler').click(function(event) {
    event.preventDefault();
    
    var url = $(this).attr('href');
    var action = $(this).find('i').attr('data-bs-original-title');
    var csrfToken = $('meta[name=\"csrf-token\"]').attr('content');

    Swal.fire({
        title: action + ' Klien?',
        text: 'Apakah anda yakin?',
        icon: 'warning',
        showCancelButton: true,
        reverseButtons:true,
        confirmButtonText: 'Ya, ' + action + ' Klien!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url : url,
                type : 'POST',
                data: {_csrf : csrfToken},
                success : function(data){
                    if (data.code == 200) {
                        var title = 'Sukses!';
                        var message = 'Klien Berhasil Di' + action.toLowerCase();
                        var icon = 'success';
                    } else {
                        var title = 'Gagal!';
                        var message = 'Klien Gagal Di' + action.toLowerCase();
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

$this->registerJs($js, $this::POS_END, 'client-enabler-handler');
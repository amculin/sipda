<?php

use app\assets\FormModalAsset;
use app\customs\FActionColumn;
use app\customs\FDeleteAlert;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
?>

<div class="page-wrapper" data-menu-active="Manajemen User" data-submenu-active="">
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle mb-2">
                        <ol class="breadcrumb" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="<?= Url::to('/dashboard/index', true); ?>">Home</a></li>
                            <li class="breadcrumb-item active"><a href="#">Manajemen User</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title">Manajemen User</h2>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <a href="<?= Url::to('/users/create', true); ?>" class="btn btn-primary d-none d-sm-inline-block modal-trigger"
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
                        <?= $form->field($searchModel, 'id_grup', ['options' => ['tag' => false]])->dropDownList($roleList, [
                            'prompt' => 'Semua Role',
                            'class' => 'form-select',
                            'style' => 'width: 160px;',
                            'tag' => false
                        ])->label(false); ?>
                        <div class="input-group">
                            <?= $form->field($searchModel, 'nama', ['options' => ['tag' => false]])->textInput(['placeholder' => 'Cari data..', 'tag' => false])->label(false); ?>
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
                                'template' => '{update} {lock} {delete}',
                                'buttons' => [
                                    'lock' => function ($url, $model, $key) {
                                        $icon = Html::tag('i', '', [
                                            'class' => $model['is_disabled'] == 1 ? 'bi bi-unlock' : 'bi bi-lock',
                                            'data-bs-toggle' => 'tooltip',
                                            'data-bs-placement' => 'bottom',
                                            'title' => $model['is_disabled'] == 1 ? 'Unlock' : 'Lock'
                                        ]);
                        
                                        return Html::a($icon, $url, ['class' => 'text-dark lock-user']);
                                    }
                                ],
                                'visibleButtons' => [
                                    'lock' => function ($model, $key, $index) {
                                        return $model['id_grup'] !== 1;
                                    },
                                    'delete' => function ($model, $key, $index) {
                                        return $model['id_grup'] !== 1;
                                    }
                                ]
                            ],
                            'username',
                            'nama',
                            'email',
                            [
                                'header' => 'Jabatan',
                                'value' => function ($data) {
                                    return is_null($data['jabatan']) ? '' : $data['jabatan'];
                                },
                            ],
                            'role'
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


<div class="modal fade modal-blur users-form" id="modal-form" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        </div>
    </div>
</div>

<?php
FormModalAsset::register($this);

$js = "
$('#w1 a.lock-user').click(function(event) {
    event.preventDefault();
    
    var url = $(this).attr('href');
    var action = ($(this).find('i').attr('data-bs-original-title') == 'Lock') ? 'Kunci' : 'Buka Kunci';
    var csrfToken = $('meta[name=\"csrf-token\"]').attr('content');

    Swal.fire({
        title: action + ' User?',
        text: 'Apakah anda yakin?',
        icon: 'warning',
        showCancelButton: true,
        reverseButtons:true,
        confirmButtonText: 'Ya, ' + action + ' User!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url : url,
                type : 'POST',
                data: {_csrf : csrfToken},
                success : function(data){
                    if (data.code == 200) {
                        var title = 'Sukses!';
                        var message = 'User Berhasil Di' + action.toLowerCase();
                        var icon = 'success';
                    } else {
                        var title = 'Gagal!';
                        var message = 'Data Gagal Di' + action.toLowerCase();
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

$this->registerJs($js, $this::POS_END, 'user-lock-handler');
?>
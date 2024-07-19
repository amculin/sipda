<?php

use app\modules\broadcasts\models\BroadcastStatusSearch as Status;
use app\customs\FActionColumn;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\broadcasts\models\BroadcastSearch $searchModel */
/** @var yii\data\SqlDataProvider $dataProvider */
?>
<div class="page-wrapper" data-menu-active="Broadcast" data-submenu-active="Broadcast">
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle mb-2">
                        <ol class="breadcrumb" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="<?= Url::to('/dashboard/index', true); ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Broadcast</a></li>
                            <li class="breadcrumb-item active"><a href="#">Broadcast Email</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title">Broadcast Email</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <a href="<?= Url::to('/broadcasts/jobs/create', true); ?>" class="btn btn-primary d-none d-sm-inline-block">
                        <i class="bi bi-plus"></i>
                        Tambah Data
                    </a>
                    <div class="ms-auto d-flex gap-2">
                        <?php $form = ActiveForm::begin([
                            'action' => ['index'],
                            'method' => 'get',
                            'options' => ['style' => 'display: contents;']
                        ]);
                        echo $form->field($searchModel, 'id_sales', ['options' => ['tag' => false]])->dropDownList($salesList, [
                            'prompt' => 'Semua Sales',
                            'class' => 'form-select',
                            'style' => 'width: 200px;',
                            'tag' => false
                        ])->label(false);

                        $startYear = date('Y') - 3;
                        $yearList = [];

                        for ($i = date('Y'); $i >= $startYear; $i--) {
                            $yearList[$i] = $i;
                        }

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
                        <div class="input-group" style="width: 200px">
                            <?= $form->field($searchModel, 'judul', ['options' => ['tag' => false]])->textInput([
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
                                'template' => '{update} {delete}',
                                /* 'buttons' => [
                                    'contact' => function ($url, $model, $key) {
                                        $icon = Html::tag('i', '', [
                                            'class' => 'bi bi-people-fill',
                                            'data-bs-toggle' => 'tooltip',
                                            'data-bs-placement' => 'bottom',
                                            'title' => 'Contact'
                                        ]);

                                        $url = Url::to(['/broadcasts/channel-details/view', 'channelId' => $model['id']]);
                        
                                        return Html::a($icon, $url, ['class' => 'text-dark']);
                                    }
                                ], */
                            ],
                            [
                                'header' => 'Broadcast',
                                'value' => function ($data) {
                                    if (Status::isCreated($data['id_status'])) {
                                        $content = 'Send';
                                        $aClass = 'btn-outline-success';
                                    } else {
                                        $content = 'Resend';
                                        $aClass = 'btn-outline-secondary';
                                    }
                                    $url = Url::to(['run', 'id' => $data['id']], true);
                                    $aClass .= ' btn btn-sm rounded-pill px-3';

                                    return Html::a('<i class="bi bi-send me-2"></i> ' . $content, $url, ['class' => $aClass]);
                                },
                                'format' => 'html'
                            ],
                            [
                                'header' => 'Nama Sales',
                                'value' => function ($data) {
                                    return $data['sales'];
                                },
                            ],
                            [
                                'header' => 'Tanggal',
                                'value' => function ($data) {
                                    return date('d/m/Y', strtotime($data['timestamp']));
                                },
                            ],
                            [
                                'header' => 'Kode Broadcast',
                                'value' => function ($data) {
                                    return $data['kode'];
                                },
                            ],
                            [
                                'header' => 'Judul Broadcast',
                                'value' => function ($data) {
                                    return $data['judul'];
                                },
                            ],
                            [
                                'header' => 'Channel',
                                'value' => function ($data) {
                                    return $data['channel'];
                                },
                            ],
                            [
                                'header' => 'Scheduled Send',
                                'value' => function ($data) {
                                    return is_null($data['schedule']) ? '-'
                                        : date('d/m/Y', strtotime($data['schedule']));
                                },
                            ],
                            [
                                'header' => 'Status',
                                'value' => function ($data) {
                                    return $data['status'];
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

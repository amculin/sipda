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
    <a href="<?= Url::to('/broadcast/channels/create', true); ?>" class="btn btn-default d-none d-sm-inline-block modal-trigger"
        data-bs-toggle="modal" data-bs-target="#modal-channel">Tambahkan ke Channel
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
                'template' => '{update} {activity} {tracking} {convert} {delete}',
                'buttons' => [
                    'activity' => function ($url, $model, $key) {
                        $icon = Html::tag('i', '', [
                            'class' => 'bi bi-journal-text',
                            'data-bs-toggle' => 'tooltip',
                            'data-bs-placement' => 'bottom',
                            'title' => 'Aktivitas'
                        ]);
        
                        return Html::a($icon, $url, ['class' => 'text-info']);
                    },
                    'tracking' => function ($url, $model, $key) {
                        $icon = Html::tag('i', '', [
                            'class' => 'bi bi-diagram-2',
                            'data-bs-toggle' => 'tooltip',
                            'data-bs-placement' => 'bottom',
                            'title' => 'Tracking'
                        ]);
        
                        return Html::a($icon, $url, ['class' => 'text-warning modal-trigger']);
                    },
                    'convert' => function ($url, $model, $key) {
                        $icon = Html::tag('i', '', [
                            'class' => 'bi bi-arrow-right-circle-fill',
                            'data-bs-toggle' => 'tooltip',
                            'data-bs-placement' => 'bottom',
                            'title' => 'Konversi'
                        ]);
        
                        return Html::a($icon, $url, ['class' => 'text-success modal-trigger']);
                    },
                ],
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
                    return number_format($data['nilai'], 0, ',', '.');
                },
                'headerOptions' => ['class' => 'text-end'],
                'contentOptions' => ['class' => 'text-end']
            ],
            [
                'header' => $searchModel->attributeLabels()['id_tahapan'],
                'value' => function ($data) {
                    $content = Html::tag('i', '', ['class' => $data['icon'] . ' pe-2']);

                    return Html::a($content . $data['step'], '#', ['class' => 'btn btn-info btn-sm rounded-pill']);
                },
                'headerOptions' => ['class' => 'text-center'],
                'contentOptions' => ['class' => 'text-nowrap gap-2 text-center'],
                'format' => 'html'
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

<div class="modal fade modal-blur leads-form" id="modal-form" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        </div>
    </div>
</div>

<?php
FormModalAsset::register($this);
?>
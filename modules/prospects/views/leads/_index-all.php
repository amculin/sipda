<?php

use app\assets\FormModalAsset;
use app\customs\FActionColumn;
use app\customs\FDeleteAlert;
use app\models\UserGrup as Role;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var app\modules\prospects\models\LeadSearch $model */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var yii\web\View $this */
/** @var yii\widgets\ActiveForm $form */

if (! is_null($stepId)) {
    $css = "
    .nav-theme .nav-link.active{
        background: {$backgroundColor};
        color:#2D5DFF;
        border-color:transparent;
        font-weight: bold;
    }    
    .card-header-theme{
        background: {$backgroundColor};
    }";
    $this->registerCss($css);
}
?>
<div class="card-header card-header-theme">
    <?php if ($stepId == $stepList[0]['id']) { ?>
    <a href="<?= Url::to('/prospects/leads/create', true); ?>" class="btn btn-primary d-none d-sm-inline-block me-2 modal-trigger"
        data-bs-toggle="modal" data-bs-target="#modal-form">
        <i class="bi bi-plus"></i>
        Tambah Data
    </a>
    <?php } ?>
    <a href="<?= Url::to('/broadcasts/channel-details/create-from-lead', true); ?>"
        class="btn btn-default d-none d-sm-inline-block add-to-channel-modal-trigger" data-bs-toggle="modal" data-bs-target="#modal-form"
        id="add-to-channel">
        <i class="bi bi-person-add"></i> Tambahkan ke Channel
    </a>
    <div class="ms-auto d-flex gap-2">
        <?php $form = ActiveForm::begin([
            'action' => ['index', 'stepId' => $stepId],
            'method' => 'get',
            'options' => ['style' => 'display: contents;']
        ]);
        $startYear = date('Y') - 3;
        $yearList = [];
        $stepList = ArrayHelper::map($stepList, 'id', 'nama');

        for ($i = date('Y'); $i >= $startYear; $i--) {
            $yearList[$i] = $i;
        }

        if (Yii::$app->user->identity->id_grup == Role::ADMIN) {
            echo $form->field($searchModel, 'id_sales', ['options' => ['tag' => false]])->dropDownList($salesList, [
                'prompt' => 'Semua Sales',
                'class' => 'form-select',
                'style' => 'width: 160px;',
                'tag' => false
            ])->label(false);
        }

        echo $form->field($searchModel, 'year', ['options' => ['tag' => false]])->dropDownList($yearList, [
            'prompt' => 'Semua Tahun',
            'class' => 'form-select',
            'style' => 'width: 160px;',
            'tag' => false
        ])->label(false);

        if (is_null($stepId)) {
            echo $form->field($searchModel, 'id_tahapan', ['options' => ['tag' => false]])->dropDownList($stepList, [
                'prompt' => 'Semua Tahapan',
                'class' => 'form-select',
                'style' => 'width: 160px;',
                'tag' => false
            ])->label(false);
        }
        ?>
        <div class="input-group" style="width: 160px;">
            <?= $form->field($searchModel, 'nama', ['options' => ['tag' => false]])->textInput([
                'placeholder' => 'Cari data..',
                'tag' => false,
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
                'class' => 'yii\grid\CheckboxColumn',
                'checkboxOptions' => function ($model, $key, $index, $column) {
                    return [
                        'class' => 'add-to-channel-checkbox',
                        'value' => $model['id']
                    ];
                }
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
                        $url = Url::to(['/prospects/lead-histories/tracking', 'leadId' => $model['id']], true);
                        $icon = Html::tag('i', '', [
                            'class' => 'bi bi-diagram-2',
                            'data-bs-toggle' => 'tooltip',
                            'data-bs-placement' => 'bottom',
                            'title' => 'Tracking'
                        ]);
        
                        return Html::a($icon, $url, [
                            'class' => 'text-warning modal-trigger',
                            'data-bs-toggle' => 'modal',
                            'data-bs-target' => '#modal-form',
                            'data-bs-size' => 'lg'
                        ]);
                    },
                    'convert' => function ($url, $model, $key) {
                        $iconClass = ($model['step'] == 'FAIL' || $model['step'] == 'DEAL') ? 'bi bi-x-circle'
                            : 'bi bi-arrow-right-circle-fill';

                        if ($model['step'] == 'FAIL') {
                            $title = 'Batal Fail';
                        } else if ($model['step'] == 'DEAL') {
                            $title = 'Batal Deal';
                        } else {
                            $title = 'Konversi';
                        }

                        $url = Url::to(['/prospects/lead-histories/convert', 'leadId' => $model['id']], true);

                        $icon = Html::tag('i', '', [
                            'class' => $iconClass,
                            'data-bs-toggle' => 'tooltip',
                            'data-bs-placement' => 'bottom',
                            'title' => $title
                        ]);
        
                        return Html::a($icon, $url, [
                            'class' => 'text-success modal-trigger',
                            'data-bs-toggle' => 'modal',
                            'data-bs-target' => '#modal-form'
                        ]);
                    },
                ],
            ],
            [
                'header' => $searchModel->attributeLabels()['id_sales'],
                'value' => function ($data) {
                    return $data['nama'];
                },
                'visible' => (Yii::$app->user->identity->id_grup == Role::ADMIN)
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
                    $css = "
                        a.step-status {
                            --tblr-btn-color-text: black;
                        }
                    ";
                    $this->registerCss($css);
                    return Html::a($content . $data['step'], '#', [
                        'class' => 'btn btn-sm rounded-pill step-status',
                        'style' => "background-color: {$data['warna']}"
                    ]);
                },
                'headerOptions' => ['class' => 'text-center'],
                'contentOptions' => ['class' => 'text-nowrap gap-2 text-center'],
                'format' => 'html',
                'visible' => (is_null($stepId) == true)
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

$js = "
$('a.add-to-channel-modal-trigger').click(function(event) {
    event.preventDefault();
    var url = $(this).attr('href');
    var valueList = [];
    
    $('input[type=checkbox]').each(function(){
        if ($(this).is(':checked') && $(this).hasClass('add-to-channel-checkbox')) {
            valueList.push($(this).val());  
        }
    })

    if (valueList.length < 1) {
        Swal.fire({
            title: 'Info',
            text: 'Silakan centang terlebih dahulu data yang akan dipilih',
            icon: 'warning',
            showCancelButton: false,
            reverseButtons:false,
        }).then((result) => {
            Swal.close();
            $('#modal-form').modal('hide')
        })

        return false;
    }

    var values = valueList.join(',');

    $.ajax({
        url : url + '?leadCollections=' + values,
        type : 'POST',
        success : function(data) {
            $('div#modal-form div div.modal-content').html(data);
        }
    });
});
";

$this->registerJs($js, $this::POS_END, 'checkbox-handler');
?>
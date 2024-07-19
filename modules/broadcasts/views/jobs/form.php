<?php

use app\assets\QuillFormAsset;
use app\models\UserGrup as Role;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\broadcasts\models\Broadcast $model */
/** @var yii\widgets\ActiveForm $form */
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
                            <li class="breadcrumb-item"><a href="#">Broadcast Email</a></li>
                            <li class="breadcrumb-item active"><a href="#">Form Broadcast</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title"><?= $title; ?></h2>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <?php $form = ActiveForm::begin([
                'id' => 'broadcasts-jobs-form',
                'enableAjaxValidation' => true
            ]); ?>
                <div class="row g-3">
                    <div class="col-lg-12">
                        <div class="card h-100">
                            <div class="card-body">
                                <?php
                                if (Yii::$app->user->identity->id_grup == Role::ADMIN) {
                                    echo $form->field($model, 'id_sales', [
                                        'options' => ['class' => 'mb-2 col-6']
                                    ])->dropDownList($salesList, ['prompt' => 'Pilih Sales'])->label(null, ['class' => 'form-label']);
                                }

                                echo $form->field($model, 'id_channel', [
                                    'options' => ['class' => 'mb-2 col-6']
                                ])->dropDownList($channelList, ['prompt' => 'Pilih Channel Tujuan'])->label(null, ['class' => 'form-label']);

                                echo $form->field($model, 'judul', ['options' => ['class' => 'mb-2 col-6']])->textInput([
                                    'maxlength' => true,
                                ])->label(null, ['class' => 'form-label']);

                                echo $form->field($model, 'greeting', ['options' => ['class' => 'mb-2 col-12']])->textArea([
                                    'cols' => 30, 'rows' => 3
                                ])->label(null, ['class' => 'form-label']);

                                echo $form->field($model, 'isi', ['options' => ['class' => 'mb-2 col-12']])->textArea([
                                    'cols' => 30, 'rows' => 8
                                ])->label(null, ['class' => 'form-label']);

                                echo $form->field($model, 'closing', ['options' => ['class' => 'mb-2 col-12']])->textArea([
                                    'cols' => 30, 'rows' => 3
                                ])->label(null, ['class' => 'form-label']);
                                
                                echo $form->field($model, 'file', [
                                    'options' => ['class' => 'mb-2 col-12 standar']
                                ])->fileInput(['class' => 'form-control', 'style' => 'width: 400px;'])->label(null, ['class' => 'form-label']);

                                echo $form->field($model, 'scheduled_date', ['options' => ['class' => 'mb-2 col-12']])->textInput([
                                    'maxlength' => true,
                                    'type' => 'date',
                                    'class' => 'form-control mb-2',
                                    'style' => 'width: 200px'
                                ])->label(null, ['class' => 'form-label']);

                                echo $form->field($model, 'scheduled_time', ['options' => ['class' => 'mb-2 col-12']])->textInput([
                                    'maxlength' => true,
                                    'type' => 'time',
                                    'class' => 'form-control',
                                    'style' => 'width: 200px'
                                ])->label(false);
                                ?>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="mt-3 d-flex gap-2">
                    <a href="<?= Url::to(['index'], true); ?>" class="btn px-4"><i class="bi bi-arrow-left me-2"></i>Kembali</a>
                    <a href="#" class="btn px-4"><i class="bi bi-view-list me-2"></i>Preview</a>
                    <button class="btn btn-primary px-4" type="submit">Simpan</button>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<?php
QuillFormAsset::register($this);
$js = "
    var toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'],
        ['blockquote', 'code-block'],
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
        [{ 'color': [] }, { 'background': [] }],
        [{ 'align': [] }],
        ['image'],
        ['clean']         
    ];

    var isi = new Quill('#broadcast-isi', {
        theme: 'snow',
        modules: {
            toolbar: toolbarOptions
        }
    });
";

if (Yii::$app->user->identity->id_grup == Role::ADMIN) {
    $getConfigUrl = Url::to(['/broadcasts/configuration/get-config', 'salesId' => '']);
    $js .= "
        $('#broadcast-id_sales').change(function(){
            var salesID = $(this).val();

            var url = '{$getConfigUrl}' + salesID;

            if (salesID) {
                $.ajax({
                    url : url,
                    type : 'GET',
                    success : function(data) {
                        $('#broadcast-greeting').val(data.greeting);
                        $('#broadcast-closing').val(data.closing);
                    }
                });
            }
        });
    ";
}

$this->registerJs($js, $this::POS_END, 'broadcast-jobs-form-handler');
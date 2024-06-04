<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\prospects\models\Aktivitas $model */
/** @var yii\widgets\ActiveForm $form */
?>
<div class="modal-header">
    <h5 class="modal-title"><?= $title; ?></h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<?php $form = ActiveForm::begin([
    'id' => 'activities-form',
    'enableAjaxValidation' => true
]); ?>
<div class="modal-body">
    <?php
    echo $form->field($model, 'id_lead')->hiddenInput()->label(false);
    echo $form->field($model, 'id_tahapan')->hiddenInput()->label(false);
    echo $form->field($model, 'tanggal', [
        'options' => ['class' => 'mb-2'],
    ])->textInput([
        'style' => 'width: 200px;',
        'placeholder' => 'Pilih Tanggal',
        'type' => 'date'
    ])->label(null, ['class' => 'form-label']);

    echo $form->field($model, 'aktivitas', [
        'options' => ['class' => 'mb-2']
    ])->textArea(['cold' => 30, 'rows' => 5])->label(null, ['class' => 'form-label']);

    echo $form->field($model, 'lokasi', [
        'options' => ['class' => 'mb-2']
    ])->textInput(['maxlength' => true])->label(null, ['class' => 'form-label']);

    echo $form->field($model, 'progres', [
        'options' => ['class' => 'mb-2']
        ])->textArea(['cold' => 30, 'rows' => 5])->label(null, ['class' => 'form-label']);

    echo $form->field($model, 'id_status', [
        'options' => ['class' => 'mb-2']
    ])->dropDownList([1 => 'Open', 2 => 'Closed'], ['class' => 'form-select', 'style' => 'width: 100px;'])
    ->label(null, ['class' => 'form-label']);
    ?>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
<?php ActiveForm::end(); ?>
<?php
$js = "
    var leadID = $('#lead-id').text();
    $('#aktivitas-id_lead').val(leadID);
    var stepID = $('#lead-id_tahapan').text();
    $('#aktivitas-id_tahapan').val(stepID);
";

$this->registerJs($js, $this::POS_END, 'activiti-form-handler');
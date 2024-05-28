<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\references\models\Program $model */
/** @var yii\widgets\ActiveForm $form */
?>
<div class="modal-header">
    <h5 class="modal-title"><?= $title; ?></h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<?php $form = ActiveForm::begin([
    'id' => 'steps-form',
    'enableAjaxValidation' => true
]); ?>
<div class="modal-body">
    <?php
    echo $form->field($model, 'nama', [
        'options' => ['class' => 'mb-2']
    ])->textInput(['maxlength' => true])->label(null, ['class' => 'form-label']);

    echo $form->field($model, 'keterangan', [
        'options' => ['class' => 'mb-2']
    ])->textArea()->label(null, ['class' => 'form-label']);

    echo $form->field($model, 'lokasi', [
        'options' => ['class' => 'mb-2']
    ])->textInput(['maxlength' => true])->label(null, ['class' => 'form-label']);

    echo $form->field($model, 'tanggal_mulai', [
        'options' => ['class' => 'mb-2 col-4']
    ])->textInput(['type' => 'date'])->label(null, ['class' => 'form-label']);

    echo $form->field($model, 'tanggal_selesai', [
        'options' => ['class' => 'mb-2 col-4']
    ])->textInput(['type' => 'date'])->label(null, ['class' => 'form-label']);
    ?>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
<?php ActiveForm::end(); ?>

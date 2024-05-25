<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\references\models\Tahapan $model */
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
    $isReadonly = ($model->nama == 'FAIL' || $model->nama == 'DEAL') ? true : false;

    echo $form->field($model, 'nama', [
        'options' => ['class' => 'mb-2']
    ])->textInput([
        'maxlength' => true,
        'readonly' => $isReadonly
    ])->label(null, ['class' => 'form-label']);

    echo $form->field($model, 'urutan', [
        'options' => ['class' => 'mb-2']
    ])->textInput([
        'maxlength' => true,
        'style' => 'width: 200px;'
    ])->label(null, ['class' => 'form-label']);

    echo $form->field($model, 'warna', [
        'options' => ['class' => 'mb-2']
    ])->textInput([
        'maxlength' => true,
        'style' => 'width: 70px; height: 36px;',
        'type' => 'color'
    ])->label(null, ['class' => 'form-label']);
    ?>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
<?php ActiveForm::end(); ?>
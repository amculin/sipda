<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var yii\widgets\ActiveForm $form */
?>
<div class="modal-header">
    <h5 class="modal-title"><?= $title; ?></h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<?php $form = ActiveForm::begin([
    'id' => 'user-form',
    'enableAjaxValidation' => true
]); ?>
<div class="modal-body">
    <?= $form->field($model, 'id_grup', [
            'options' => ['class' => 'mb-2']
        ])->dropDownList($roleList, ['prompt' => 'Pilih Role'])->label('Role', ['class' => 'form-label']); ?>
    <?= $form->field($model, 'id_unit', [
            'options' => ['class' => 'mb-2']
        ])->dropDownList($unitList, ['prompt' => 'Pilih Unit'])->label(null, ['class' => 'form-label']); ?>
    <?= $form->field($model, 'username', [
            'options' => ['class' => 'mb-2']
        ])->textInput(['maxlength' => true])->label(null, ['class' => 'form-label']); ?>
    <?= $form->field($model, 'password',[
            'options' => ['class' => 'mb-2']
        ])->passwordInput(['maxlength' => true])->label(null, ['class' => 'form-label']); ?>
    <?= $form->field($model, 'nama', [
            'options' => ['class' => 'mb-2']
        ])->textInput(['maxlength' => true])->label(null, ['class' => 'form-label']); ?>
    <?= $form->field($model, 'email', [
            'options' => ['class' => 'mb-2']
        ])->textInput(['maxlength' => true])->label(null, ['class' => 'form-label']); ?>
    <?= $form->field($model, 'jabatan', [
            'options' => ['class' => 'mb-2 sales']
        ])->textInput(['maxlength' => true])->label(null, ['class' => 'form-label']); ?>
    <?= $form->field($model, 'komisi_jabatan', [
            'options' => ['class' => 'mb-2 sales']
        ])->textInput(['maxlength' => true, 'style' => 'width: 100px;'])
        ->label('Komisi Jabatan (%)', ['class' => 'form-label']); ?>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
<?php ActiveForm::end(); ?>

<?php
$js = "
$('#user-id_grup').change(function() {
    var value = $(this).val();

    if (value == 2) {
        $('.sales').show();
    } else {
        $('.sales').hide();
    }
});
";

if ($model->id_grup == 2) {
    $js .= "$('.sales').show();";
} else {
    $js .= "$('.sales').hide();";
}

$this->registerJs($js, $this::POS_END, 'sales-form-handler');
?>
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\references\models\Kategori $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="modal-header">
    <h5 class="modal-title"><?= $title; ?></h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<?php $form = ActiveForm::begin([
    'id' => 'categories-form',
    'enableAjaxValidation' => true
]); ?>
<div class="modal-body">
    <div class="mb-2">
        <?= $form->field($model, 'nama')->textInput(['maxlength' => true])->label(null, ['class' => 'form-label']) ?>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
<?php ActiveForm::end(); ?>
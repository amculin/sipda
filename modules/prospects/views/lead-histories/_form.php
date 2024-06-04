<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\prospects\models\LeadHistory $model */
/** @var yii\widgets\ActiveForm $form */

$title = 'Konversi Prospek';
$totalSteps = count($mappedStepList);

if ($isDeal) {
    $title = 'Batal Deal';
    $status = 'Deal';
    $model->id_tahapan = array_keys($mappedStepList)[($totalSteps - 1)];
} else if ($isFail) {
    $title = 'Batal Fail';
    $status = 'Fail';
    $model->id_tahapan = array_keys($mappedStepList)[($totalSteps - 1)];
}
?>

<div class="modal-header">
    <h5 class="modal-title"><?= $title; ?></h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<?php $form = ActiveForm::begin([
    'id' => 'lead-histories-form',
    'enableAjaxValidation' => true
]); ?>
<div class="modal-body">
    <?php
    if (! $isDeal && !$isFail) {
    echo $form->field($model, 'id_tahapan', [
        'options' => ['class' => 'mb-2']
    ])->dropDownList($mappedStepList, ['prompt' => 'Pilih Tahapan'])->label(null, ['class' => 'form-label']);

    echo $form->field($model, 'attachment', [
        'options' => ['class' => 'mb-2']
    ])->fileInput(['class' => 'form-control'])->label(null, ['class' => 'form-label']);
    } else {
        $content = "Apakah anda yakin mau membatalkan status {$status} pada Leads ini?";
        echo Html::tag('div', $content, ['class' => 'mb-2']);
        echo $form->field($model, 'id_tahapan')->hiddenInput()->label(false);
    }
    ?>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
<?php ActiveForm::end(); ?>

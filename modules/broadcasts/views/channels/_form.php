<?php

use app\models\UserGrup as Role;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\broadcasts\models\Channel $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="modal-header">
    <h5 class="modal-title"><?= $title; ?></h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<?php $form = ActiveForm::begin([
    'id' => 'broadcasts-channels-form',
    'enableAjaxValidation' => true
]); ?>
<div class="modal-body">
    <?php
    if (Yii::$app->user->identity->id_grup == Role::ADMIN) {
        echo $form->field($model, 'id_sales', [
            'options' => ['class' => 'mb-2']
        ])->dropDownList($salesList, ['prompt' => 'Pilih Sales'])->label(null, ['class' => 'form-label']);
    }

    echo $form->field($model, 'nama', [
        'options' => ['class' => 'mb-2']
    ])->textInput([
        'maxlength' => true,
    ])->label(null, ['class' => 'form-label']);

    echo $form->field($model, 'keterangan', [
        'options' => ['class' => 'mb-2']
    ])->textArea([
        'maxlength' => true,
    ])->label(null, ['class' => 'form-label']);
    ?>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
<?php ActiveForm::end(); ?>

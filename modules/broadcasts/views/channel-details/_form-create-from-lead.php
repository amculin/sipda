<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\broadcasts\models\ChannelDetail $model */
/** @var yii\widgets\ActiveForm $form */
?>
<div class="modal-header">
    <h5 class="modal-title"><?= $title; ?></h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<?php $form = ActiveForm::begin([
    'id' => 'broadcasts-channel-details-form',
    'enableAjaxValidation' => true
]); ?>
<div class="modal-body">
    <div class="mb-2">
        Aksi ini akan menambahkan leads yang dipilih ke dalam channel broadcast. Silahkan pilih channel yang dituju.
    </div>
    <?php
    echo $form->field($model, 'id_channel', [
        'options' => ['class' => 'mb-2']
    ])->dropDownList($channelList, ['prompt' => 'Pilih Channel'])->label(null, ['class' => 'form-label']);
    echo $form->field($model, 'lead_collections')->hiddenInput()->label(false);
    ?>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
<?php ActiveForm::end(); ?>

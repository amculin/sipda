<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\prospects\models\QuotationDetail $model */
/** @var yii\widgets\ActiveForm $form */
?>
<div class="modal-header">
    <h5 class="modal-title"><?= $title; ?></h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<?php $form = ActiveForm::begin([
    'id' => 'quotation-detail-form',
    'enableAjaxValidation' => true
]); ?>
<div class="modal-body">
    <?php
    echo $form->field($model, 'id_produk', [
        'options' => ['class' => 'mb-2']
    ])->dropDownList($productList, [
        'prompt' => 'Pilih Produk',
        'class' => 'form-select'
    ])->label('Produk', ['class' => 'form-label']);

    echo $form->field($model, 'jumlah', [
        'options' => ['class' => 'mb-2']
    ])->textInput(['style' => 'width:100px'])->label('Kuantitas', ['class' => 'form-label']);

    echo $form->field($model, 'harga', [
        'options' => ['class' => 'mb-2']
    ])->textInput(['maxlength' => true, 'style' => 'width:200px'])->label(null, ['class' => 'form-label']);

    echo $form->field($model, 'diskon', [
        'options' => ['class' => 'mb-2']
    ])->textInput(['maxlength' => true, 'style' => 'width:200px'])->label(null, ['class' => 'form-label']);
    ?>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
<?php ActiveForm::end(); ?>

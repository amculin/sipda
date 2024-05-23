<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\references\models\Produk $model */
/** @var yii\widgets\ActiveForm $form */
?>
<div class="modal-header">
    <h5 class="modal-title"><?= $title; ?></h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<?php $form = ActiveForm::begin([
    'id' => 'products-form',
    'enableAjaxValidation' => true
]); ?>
<div class="modal-body">
    <?php
    echo $form->field($model, 'id_kategori', [
        'options' => ['class' => 'mb-2']
    ])->dropDownList($categoryList, ['prompt' => 'Pilih Kategori'])->label(null, ['class' => 'form-label']);

    echo $form->field($model, 'kode', [
        'options' => ['class' => 'mb-2']
    ])->textInput([
        'maxlength' => true,
        'class' => 'form-control',
        'style' => 'width:200px;'
    ])->label(null, ['class' => 'form-label']);

    echo $form->field($model, 'nama', [
        'options' => ['class' => 'mb-2']
    ])->textInput(['maxlength' => true])->label(null, ['class' => 'form-label']);

    echo $form->field($model, 'harga_pokok', [
        'options' => ['class' => 'mb-2']
    ])->textInput([
        'maxlength' => true,
        'class' => 'form-control',
        'style' => 'width:200px;'
    ])->label(null, ['class' => 'form-label']);

    echo $form->field($model, 'harga_jual', [
        'options' => ['class' => 'mb-2']
    ])->textInput([
        'maxlength' => true,
        'class' => 'form-control',
        'style' => 'width:200px;'
    ])->label(null, ['class' => 'form-label']);

    echo $form->field($model, 'jumlah_stock', [
        'options' => ['class' => 'mb-2']
    ])->textInput([
        'maxlength' => true,
        'class' => 'form-control text-end',
        'style' => 'width:100px;'
    ])->label(null, ['class' => 'form-label']);

    echo $form->field($model, 'prosentase_komisi', [
        'options' => ['class' => 'mb-2']
    ])->textInput([
        'maxlength' => true,
        'class' => 'form-control text-end',
        'style' => 'width:100px;'
    ])->label('Prosentase Komisi (%)', ['class' => 'form-label']);

    echo $form->field($model, 'nominal_komisi', [
        'options' => ['class' => 'mb-2']
    ])->textInput([
        'maxlength' => true,
        'class' => 'form-control text-end',
        'style' => 'width:200px;'
    ])->label('Nominal Komisi (Rp.)', ['class' => 'form-label']);
    ?>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
<?php ActiveForm::end(); ?>
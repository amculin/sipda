<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ConfigForm $model */
/** @var yii\widgets\ActiveForm $form */
?>
<div class="page-wrapper" data-menu-active="Konfigurasi">
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle mb-2">
                        <ol class="breadcrumb" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="<?= Url::to(['dashboard/index']); ?>">Home</a></li>
                            <li class="breadcrumb-item active"><a href="">Konfigurasi</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title">Konfigurasi</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <?php $form = ActiveForm::begin([
                'id' => 'config-form',
                'enableAjaxValidation' => true
            ]); ?>
                <div class="row g-3">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header bg-light text-dark">
                                <div class="fw-bold">SMTP Setting</div>
                            </div>
                            <div class="card-body">
                                <?= $form->field($model, 'smtp_host', [
                                    'options' => ['class' => 'mb-2']
                                ])->textInput()->label(null, ['class' => 'form-label']); ?>
                                <?= $form->field($model, 'smtp_port', [
                                    'options' => ['class' => 'mb-2']
                                ])->textInput()->label(null, ['class' => 'form-label']); ?>
                                <?= $form->field($model, 'smtp_user', [
                                    'options' => ['class' => 'mb-2']
                                ])->textInput()->label(null, ['class' => 'form-label']); ?>
                                <?= $form->field($model, 'smtp_password', [
                                    'options' => ['class' => 'mb-2']
                                ])->passwordInput()->label(null, ['class' => 'form-label']); ?>
                                <?= $form->field($model, 'email', [
                                    'options' => ['class' => 'mb-2']
                                ])->textInput()->label(null, ['class' => 'form-label']); ?>
                                <?= $form->field($model, 'name', [
                                    'options' => ['class' => 'mb-2']
                                ])->textInput()->label(null, ['class' => 'form-label']); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header bg-light text-dark">
                                <div class="fw-bold">Komisi Sales</div>
                            </div>
                            <div class="card-body">
                                <?= $form->field($model, 'comission_only_for_achieved', [
                                    'options' => ['class' => 'mb-2']
                                ])->dropDownList([1 => 'Ya', 0 => 'Tidak'], [
                                    'class' => 'form-select',
                                    'style' => 'width: 100px;',
                                ])->label(null, ['class' => 'form-label']); ?>
                                <?= $form->field($model, 'comission_value', [
                                    'options' => ['class' => 'mb-2']
                                ])->textInput([
                                    'class' => 'form-control text-end col-2',
                                    'style' => 'width: 80px;'
                                ])->label(null, ['class' => 'form-label']); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3 d-flex gap-2">
                    <button class="btn btn-primary px-4" type="submit">Simpan</button>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
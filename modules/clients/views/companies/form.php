<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\clients\models\Klien $model */
/** @var yii\widgets\ActiveForm $form */
?>
<div class="page-wrapper" data-menu-active="Klien">
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle mb-2">
                        <ol class="breadcrumb" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="<?= Url::to('/dashboard/index', true); ?>">Home</a></li>
                            <li class="breadcrumb-item active"><a href="<?= Url::to('/clients/companies/index') ?>">Klien</a></li>
                            <li class="breadcrumb-item active"><a href="#">Form Klien</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title">Form Data Klien</h2> 
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <?php $form = ActiveForm::begin([
                'id' => 'companies-form',
                'enableAjaxValidation' => true
            ]); ?>
                <div class="row g-3">
                    <div class="col-lg-6">
                        <div class="card h-100">
                            <div class="card-header bg-light text-dark">
                                <div class="fw-bold">INFORMASI KLIEN</div>
                            </div>
                            <div class="card-body">
                                <?php
                                if ($isAdmin) {
                                    echo $form->field($model, 'id_sales', [
                                        'options' => ['class' => 'mb-2']
                                    ])->dropDownList($salesList, [
                                        'prompt' => 'Pilih Sales',
                                        'style' => 'width: 300px;'
                                    ])->label(null, ['class' => 'form-label']);
                                }

                                echo $form->field($model, 'nama', [
                                    'options' => ['class' => 'mb-2']
                                ])->textInput(['maxlength' => true])->label(null, ['class' => 'form-label']);

                                echo $form->field($model, 'nama_perusahaan', [
                                    'options' => ['class' => 'mb-2']
                                ])->textInput(['maxlength' => true])->label(null, ['class' => 'form-label']);
                                
                                echo $form->field($model, 'akronim', [
                                    'options' => ['class' => 'mb-2']
                                ])->textInput(['maxlength' => true, 'style' => 'width: 100px;'])->label(null, ['class' => 'form-label']);

                                echo $form->field($model, 'alamat', [
                                    'options' => ['class' => 'mb-2']
                                ])->textArea(['cols' => 30, 'rows' => 4])->label(null, ['class' => 'form-label']);
                                
                                echo $form->field($model, 'nomor_telepon', [
                                    'options' => ['class' => 'mb-2']
                                ])->textInput(['maxlength' => true, 'style' => 'width: 200px;'])->label('Nomor Telefon', ['class' => 'form-label']);

                                echo $form->field($model, 'email', [
                                    'options' => ['class' => 'mb-2']
                                ])->textInput(['maxlength' => true, 'style' => 'width: 300px;'])->label(null, ['class' => 'form-label']);
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card h-100">
                            <div class="card-header bg-light text-dark">
                                <div class="fw-bold">LEGALITAS PERUSAHAAN</div>
                            </div>
                            <div class="card-body">
                                <?php
                                echo $form->field($model, 'npwp', [
                                    'options' => ['class' => 'mb-2']
                                ])->textInput(['maxlength' => true])->label(null, ['class' => 'form-label']);
                                
                                echo $form->field($model, 'akun_bank', [
                                    'options' => ['class' => 'mb-2']
                                ])->textInput(['maxlength' => true])->label(null, ['class' => 'form-label']);
                                
                                echo $form->field($model, 'siup', [
                                    'options' => ['class' => 'mb-2']
                                ])->textInput(['maxlength' => true])->label(null, ['class' => 'form-label']);
                                
                                echo $form->field($model, 'tdp', [
                                    'options' => ['class' => 'mb-2']
                                ])->textInput(['maxlength' => true])->label(null, ['class' => 'form-label']);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-3 d-flex gap-2 justify-content-between">
                    <a href="<?= Url::to('/companies/clients/index', true); ?>" class="btn btn px-4">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </a>
                    <button class="btn btn-primary px-4" type="submit">Simpan</button>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
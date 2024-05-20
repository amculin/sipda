<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="d-flex gap-3 mb-4 align-items-center">
    <div class="logo">
        <img src="image/logo_jmc_black.png" alt="" height="30" />
    </div>
    <div class="logo-text">
        <h1 class="mb-0 text-primary"><?=Yii::$app->params['appName'];?></h1>
        <div><?=Yii::$app->params['clientName'];?></div>
    </div>
</div>
<h2 class="fw-bold fs-1 text-primary mt-lg-5">LOGIN</h2>
<p>
    Selamat Datang, silahkan masukkan username dan password anda!
</p>
<?php $form = ActiveForm::begin([
    'id' => 'login-form'
]); ?>
    <div class="mb-2">
        <?= $form->field($model, 'username')->textInput([
            'placeholder' => 'Username',
            'class' => 'form-control py-3 border-0 bg-light text-dark'
        ])->label(false) ?>
    </div>
    <div class="mb-2">
        <?= $form->field($model, 'password')->passwordInput([
            'placeholder' => 'Password',
            'class' => 'form-control py-3 border-0 bg-light text-dark'
        ])->label(false) ?>
    </div>
    <div class="mb-2">
        <?= $form->field($model, 'unit')->dropDownList($unitList, [
            'prompt' => 'Pilih Unit',
            'class' => 'form-control py-3 border-0 bg-light text-dark',
            'style' => 'color: #aaa!important'
        ])->label(false); ?>
    </div>
    <div class="mb-2 text-end">
        <a href="#" class="text-primary fw-bold" data-bs-toggle="modal" data-bs-target="#modal-forgot-password">Lupa Password?</a>
    </div>
    <div class="d-grid mt-4">
        <button class="btn btn-primary text-uppercase shadow py-3" type="submit">Masuk</button>
    </div>
<?php ActiveForm::end(); ?>

<?php
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\clients\models\KlienKontak $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="modal-header">
    <h5 class="modal-title"><?= $title; ?></h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<?php $form = ActiveForm::begin([
    'id' => 'client-contacts-form',
    'enableAjaxValidation' => true
]); ?>
<div class="modal-body">
    <?php
    echo $form->field($model, 'nama', [
        'options' => ['class' => 'mb-2']
    ])->textInput(['maxlength' => true])->label(null, ['class' => 'form-label']);
    
    echo $form->field($model, 'posisi', [
        'options' => ['class' => 'mb-2']
    ])->textInput(['maxlength' => true])->label(null, ['class' => 'form-label']);
    
    echo $form->field($model, 'nomor_telepon', [
        'options' => ['class' => 'mb-2']
    ])->textInput(['maxlength' => true])->label(null, ['class' => 'form-label']);
    
    echo $form->field($model, 'email', [
        'options' => ['class' => 'mb-2']
    ])->textInput(['maxlength' => true])->label(null, ['class' => 'form-label']);
    echo $form->field($model, 'id_klien')->hiddenInput()->label(false);
    ?>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>
<?php ActiveForm::end(); ?>
<?php
$js = "
var clientID = $('div.card-header a.modal-trigger').attr('data-client-id');
$('#klienkontak-id_klien').val(clientID);
";
$this->registerJs($js, $this::POS_END, 'client-contact-handler');
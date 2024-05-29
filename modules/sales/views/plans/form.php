
<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\sales\models\Plan $model */
/** @var yii\widgets\ActiveForm $form */

$months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
?>
<div class="page-wrapper" data-menu-active="Planning">
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle mb-2">
                        <ol class="breadcrumb" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active"><a href="index.php">Planning</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title">Form Planning</h2>
                    
                </div>
                <div class="col-auto ms-auto">
                    
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">

            <div class="card h-100">
                <div class="row g-3">
                    <div class="col-lg">
                        <div class="card-header py-3 border-0 px-2 fw-bold">INFORMASI SALES</div>
                        <table class="table m-0 table-borderless table-striped">
                            <tr>
                                <td>NIP Sales</td>
                                <td class="text-end"><?= 'SL' . str_pad($model->id_sales, 4, '0', STR_PAD_LEFT); ?></td>
                            </tr>
                            <tr>
                                <td>Nama Sales</td>
                                <td class="text-end"><?= $model->sales->nama; ?></td>
                            </tr>
                            <tr>
                                <td>Jabatan</td>
                                <td class="text-end fw-bold"><?= $model->sales->jabatan; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <?php $form = ActiveForm::begin(); ?>
                <div class="card col-lg-12 mt-3">
                    <div class="table-responsive card-body p-0">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="5">No</th>
                                    <th>Bulan</th>
                                    <th class="col-2">Target Penjualan</th>
                                    <th class="col-2">Target Dasar Komisi</th>
                                    <th class="col-1"></th>
                                    <th width="5">No</th>
                                    <th>Bulan</th>
                                    <th class="col-2">Target Penjualan</th>
                                    <th class="col-2">Target Dasar Komisi</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $i = 1;
                                $tabIndex = $i;
                                $tabIndex2 = $i + 12;
                                for ($i = $i; $i < 7; $i++) {
                                ?>
                                    <tr>
                                        <td style="vertical-align: middle;background: #eee;" class="text-center"><?= $i; ?></td>
                                        <td style="vertical-align: middle;"><?= $months[($i - 1)]; ?></td>
                                        <td>
                                            <?= $form->field($dataModel[$i], "[{$i}]data_sale_target")->textInput([
                                                'class' => 'form-control text-end sale',
                                                'placeholder' => 0,
                                                'tabindex' => $tabIndex++
                                            ])->label(false); ?>
                                        </td>
                                        <td>
                                        <?= $form->field($dataModel[$i], "[{$i}]data_comission_target")->textInput([
                                                'class' => 'form-control text-end comission',
                                                'placeholder' => 0,
                                                'tabindex' => $tabIndex++
                                            ])->label(false); ?>
                                        </td>
                                        <td></td>
                                        <td style="vertical-align: middle;background: #eee;" class="text-center"><?= $i+6 ?></td>
                                        <td style="vertical-align: middle;"><?= $months[$i+5] ?></td>
                                        <td>
                                            <?php
                                            $k = $i + 6;
                                            echo $form->field($dataModel[$k], "[{$k}]data_sale_target")->textInput([
                                                'class' => 'form-control text-end sale',
                                                'placeholder' => 0,
                                                'tabindex' => $tabIndex2++
                                            ])->label(false);
                                            ?>
                                        </td>
                                        <td>
                                            <?= $form->field($dataModel[$k], "[{$k}]data_comission_target")->textInput([
                                                'class' => 'form-control text-end comission',
                                                'placeholder' => 0,
                                                'tabindex' => $tabIndex2++
                                            ])->label(false); ?>
                                        </td>
                                    </tr>
                                <?php } ?>

                                <tr>
                                    <th colspan="8">Target Penjualan Tahunan</th>
                                    <th class="text-end">
                                        <div id="target-penjualan"><?= number_format($model->target_penjualan, 2, ',', '.'); ?></div>
                                        <?= $form->field($model, 'target_penjualan')->hiddenInput()->label(false); ?>
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="8">Target Dasar Komisi Tahunan</th>
                                    <th class="text-end">
                                        <div id="target-komisi"><?= number_format($model->target_komisi, 2, ',', '.'); ?></div>
                                        <?= $form->field($model, 'target_komisi')->hiddenInput()->label(false); ?>
                                    </th>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-3 d-flex gap-2">
                    <a href="javascript:history.back(-1);" class="btn btn px-4"><i class="bi bi-arrow-left me-2"></i>Kembali</a>
                    <button class="btn btn-primary px-4" type="submit" tabindex="25">Simpan</button>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<?php
$js = "
    $('input[type=\"text\"]').blur(function() {
        var saleTarget = 0;
        var comissionTarget = 0;

        $('input.sale').each(function(){
            let value = parseFloat($(this).val());
            saleTarget += value;
        });

        $('input.comission').each(function(){
            let value = parseFloat($(this).val());
            comissionTarget += value;
        });

        var numberFormat = new Intl.NumberFormat('id-ID');

        $('#plan-target_penjualan').val(saleTarget);
        $('#target-penjualan').text(numberFormat.format(saleTarget) + ',00');

        $('#plan-target_komisi').val(comissionTarget);
        $('#target-komisi').text(numberFormat.format(comissionTarget) + ',00');
    });
";

$this->registerJs($js, $this::POS_END, 'target-calculation-handler');
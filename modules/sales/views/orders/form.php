<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\sales\models\SalesOrder $model */
/** @var yii\widgets\ActiveForm $form */

$css = "
.input-so{
    border: none;
    border-bottom: 2px solid #aaa;
}
    
body{
    background: #fff;
}
.table-summary .form-control{
    font-size: 14px;
}";
$this->registerCss($css);
?>

<div class="page-wrapper" data-menu-active="Sales Order">
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle mb-2">
                        <ol class="breadcrumb" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="<?= Url::to('/dashboard/index', true); ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?= Url::to('/sales/orders/index', true); ?>">Sales Order</a></li>
                            <li class="breadcrumb-item active"><a href="#">Form</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title">Form Sales Order</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <?php $form = ActiveForm::begin(); ?>
                <div class="row justify-content-end">
                    <div class="col-lg-8">
                        <div class="mb-2">
                            <?php if ($model->isNewRecord) { ?>
                                <label for="" class="form-label">Import dari Quotation</label>
                                <a href="#" class="btn btn-default" data-bs-toggle="modal" data-bs-target="#modal-import">Import</a>
                                <div class="modal fade modal-blur" id="modal-import" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Import Quotation</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <?php
                                                echo $form->field($model, 'id_quotation', [
                                                    'options' => ['class' => 'mb-2']
                                                ])->dropDownList($quotationList, ['prompt' => 'Pilih Quotation'])->label('Pilih Quotation', ['class' => 'form-label']);
                                                ?>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary" id="quotation-selector" data-bs-dismiss="modal">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } else {
                                echo $form->field($model, 'id_quotation')->hiddenInput()->label(false);
                            } ?>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <table class="table table-borderless table-sm">
                            <tr>
                                <td>Nomor SO</td>
                                <td class="text-end">
                                    <?= $model->kode; ?>
                                    <?= $form->field($model, 'kode')->hiddenInput()->label(false); ?>
                                    <?= $form->field($model, 'id_lead')->hiddenInput()->label(false); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Tanggal SO</td>
                                <td class="text-end"><?= $model->isNewRecord ? date('d/m/Y') : date('d/m/Y', strtotime($model->tanggal)); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row mt-2 g-3">
                    <h3 class="m-0">Order Dari</h3>
                    <hr class="my-2" />
                    <table class="table table-borderless">
                        <tr>
                            <td style="width: 140px;">Nama Klien</td>
                            <td>
                                <?= $form->field($model, 'nama_klien')->textInput([
                                    'style' => 'width:300px',
                                    'maxlength' => true,
                                    'class' => 'input-so',
                                    //'readonly' => true
                                ])->label(false); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Perusahaan</td>
                            <td>
                                <?= $form->field($model, 'nama_perusahaan')->textInput([
                                    'style' => 'width:400px',
                                    'maxlength' => true,
                                    'class' => 'input-so',
                                    //'readonly' => true
                                ])->label(false); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Nomor Telfon</td>
                            <td>
                                <?= $form->field($model, 'nomor_telepon')->textInput([
                                    'style' => 'width:160px',
                                    'maxlength' => true,
                                    'class' => 'input-so',
                                    //'readonly' => true
                                ])->label(false); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>
                                <?= $form->field($model, 'email')->textInput([
                                    'style' => 'width:240px',
                                    'maxlength' => true,
                                    'class' => 'input-so',
                                    //'readonly' => true
                                ])->label(false); ?>
                            </td>
                        </tr>
                        <tr>
                            <td>Catatan</td>
                            <td>
                                <?= $form->field($model, 'isi')->textArea([
                                    'cols' => 80,
                                    'rows' => 3,
                                    'class' => 'input-so',
                                    //'readonly' => true
                                ])->label(false); ?>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="mt-3">
                    <button class="btn btn-secondary" id="add-product-button" type="button" data-bs-toggle="modal" data-bs-target="#modal-produk">Tambah Produk</button>
                </div>
                <div class="mt-3 table-responsive">
                    <table class="table table-bordered" id="table-produk">
                        <thead class="table-dark">
                            <tr>
                                <th class="bg-dark" width="5"></th>
                                <th class="bg-dark">Produk</th>
                                <th class="bg-dark">Kuantitas</th>
                                <th class="bg-dark text-end">Harga</th>
                                <th class="bg-dark text-end">Diskon</th>
                                <th class="bg-dark text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?= !$model->isNewRecord ? $this->render('..\..\..\prospects\views\quotation-details\_product-form', ['model' => $model->salesOrderDetails]) : ''; ?>
                        </tbody>
                    </table>
                </div>
                <div class="row mt-4 justify-content-lg-end">
                    <div class="col-lg-4">
                        <table class="table table-sm table-borderless table-summary">
                            <tr>
                                <td><strong>Subtotal</strong></td>
                                <td class="text-end">
                                    <span id="summary-subtotal">0</span>
                                    <?= $form->field($model, 'sub_total')->hiddenInput()->label(false); ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Pajak</strong></td>
                                <td class="text-end">
                                    <span id="summary-subtotal">0</span>
                                    <?= $form->field($model, 'pajak')->hiddenInput()->label(false); ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Diskon</strong></td>
                                <td class="text-end">
                                    <span id="summary-diskon">0</span>
                                    <?= $form->field($model, 'diskon')->hiddenInput()->label(false); ?>
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Jumlah Total</strong></td>
                                <td class="text-end">Rp <span id="summary-total">0</span></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="mt-3 d-flex gap-2">
                    <a href="<?= Url::to('/sales/orders', true); ?>" class="btn btn px-4">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </a>
                    <button class="btn btn-primary px-4" type="submit">Simpan</button>
                </div>
            <?php ActiveForm::end(); ?>
            
        </div>
    </div>
</div>

<!-- Modal -->

<div class="modal fade modal-blur users-form" id="modal-form" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        </div>
    </div>
</div>

<div class="modal fade modal-blur" id="modal-produk" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form action="" id="form-produk" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-2">
                    <label for="" class="form-label">Produk</label>
                    <?= Html::dropDownList('product-list', '', $productList, [
                        'prompt' => 'Pilih Produk',
                        'class' => 'form-select',
                        'id' => 'product-list'
                    ]); ?>
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Kuantitas</label>
                    <input id="product-quantity" name="kuantitas" type="text" class="form-control" style="width:100px" />
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Harga</label>
                    <input id="product-price" name="harga" type="text" class="form-control" style="width:200px" />
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Diskon</label>
                    <input id="product-discount" type="text" class="form-control"  style="width:200px" />
                    <input type="hidden" id="is-edit-form" value="0" />
                    <input type="hidden" id="row-source" value="0" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="insert-product-button" data-bs-dismiss="modal">Tambah</button>
            </div>
        </form>
    </div>
</div>
<?php
$getQuotationUrl = Url::to(['/prospects/quotations/get-detail', 'id' => ''], true);
$getQuotationDetailUrl = Url::to(['/prospects/quotation-details/get-details', 'quotationId' => ''], true);
$getProductUrl = Url::to(['/references/products/get-detail', 'id' => ''], true);

$js = "
$('#quotation-selector').click(function(){
    var quotationID = $('#salesorder-id_quotation').val();
    var url = '{$getQuotationUrl}' + quotationID;
    $.ajax({
        url : url,
        type : 'GET',
        success : function(data) {
            $('#salesorder-isi').val('');

            Object.keys(data).forEach(key => {
                if ($('#salesorder-' + key).length) {
                    $('#salesorder-' + key).val(data[key]);
                }
            });

            $.ajax({
                url : '{$getQuotationDetailUrl}' + quotationID,
                type : 'GET',
                success : function(data) {
                    $('#table-produk tbody').html(data);

                    calculateAll();
                }
            });
        }
    });
});

var numberFormat = new Intl.NumberFormat('id-ID');

$('#add-product-button').click(function() {
    $('#is-edit-form').val(0);
    $('#row-source').val(0);
});

$('#insert-product-button').click(function() {
    var productID = $('#product-list').val();
    var url = '{$getProductUrl}' + productID;
    var isEditForm = $('#is-edit-form').val() == 1 ? true : false;
    var rowSource = parseInt($('#row-source').val());

    $.ajax({
        url : url,
        type : 'GET',
        success : function(data) {
            console.log(data);
            var quantity = ($('#product-quantity').val()) ? $('#product-quantity').val() : 0;
            quantity = parseFloat(quantity);
            $('#product-quantity').val('');

            var price = ($('#product-price').val()) ? $('#product-price').val() : 0;
            price = parseFloat(price);
            $('#product-price').val('');

            var discount = ($('#product-discount').val()) ? $('#product-discount').val() : 0;
            discount = parseFloat(discount);
            $('#product-discount').val('');
            $('#product-list').val('');
            
            var total = (quantity * price) - discount;
            var salePrice = parseFloat(data.harga_jual);

            var totalRows = $('#table-produk tbody tr').length;
            var row = totalRows;// ? totalRows : rowSource;

            if (!isEditForm) {
                var td = '<td class=\"text-nowrap\">';
                td += '    <div class=\"hstack gap-3\">';
                td += '         <a href=\"#\" class=\"btn-edit\" data-bs-toggle=\"modal\" data-bs-target=\"#modal-produk\">';
                td += '             <i class=\"bi bi-pencil text-dark\"></i>';
                td += '         </a>';
                td += '         <a href=\"#\" class=\"btn-delete\"><i class=\"bi bi-trash text-danger\"></i></a>';
                td += '    </div>';
                td += '</td>';
                td += '<td>';
                td += '    <div class=\"fw-bold\">' + data.kode + ' - ' + data.nama + '</div>';
                td += '    <div class=\"text-secondary\">' + data.category + '</div>';
                td += '    <div class=\"text-secondary\" style=\"font-size:10px; color: #844 !important;\">';
                td += '        (Harga Jual : ' + numberFormat.format(salePrice) + ')';
                td += '    </div>';
                td += '    <input type=\"hidden\" class=\"sales-order-product-detail-id\" name=\"SalesOrder[product][' + row + '][id]\" value=\"\" />';
                td += '    <input type=\"hidden\" class=\"sales-order-product-code\" name=\"SalesOrder[product][' + row + '][product_code]\" ';
                td += '     value=\"' + data.kode + '\" />';
                td += '    <input type=\"hidden\" class=\"sales-order-product-id\" name=\"SalesOrder[product][' + row + '][product_id]\" ';
                td += '     value=\"' + productID + '\" />';
                td += '    <input type=\"hidden\" class=\"sales-order-product-name\" name=\"SalesOrder[product][' + row + '][product_name]\" ';
                td += '     value=\"' + data.nama + '\" />';
                td += '    <input type=\"hidden\" class=\"sales-order-product-category\" name=\"SalesOrder[product][' + row + '][product_category]\" ';
                td += '     value=\"' + data.category + '\" />';
                td += '    <input type=\"hidden\" class=\"sales-order-product-price\" name=\"SalesOrder[product][' + row + '][product_price]\" ';
                td += '     value=\"' + price + '\" />';
                td += '    <input type=\"hidden\" class=\"sales-order-product-base-price\" name=\"SalesOrder[product][' + row + '][product_base_price]\" ';
                td += '     value=\"' + salePrice + '\" />';
                td += '    <input type=\"hidden\" class=\"sales-order-product-quantity\" name=\"SalesOrder[product][' + row + '][product_quantity]\" ';
                td += '     value=\"' + quantity + '\" />';
                td += '    <input type=\"hidden\" class=\"sales-order-product-discount\" name=\"SalesOrder[product][' + row + '][product_discount]\" ';
                td += '     value=\"' + discount + '\" />';
                td += '</td>';
                td += '<td class=\"text-end\">' + quantity +'</td>';
                td += '<td class=\"text-end\">' + numberFormat.format(price) + '</td>';
                td += '<td class=\"text-end\">' + numberFormat.format(discount) + '</td>';
                td += '<td class=\"text-end\">' + numberFormat.format(total) + '</td>';

                if ($('#table-produk tbody tr').length) {
                    $('#table-produk tbody').append('<tr>' + td + '</tr>');
                } else {
                    $('#table-produk tbody').html('<tr>' + td + '</tr>');
                }
            } else {
                var tr = $('#table-produk tbody').find('tr:eq('+ rowSource +')');
                tr.find('td:eq(1) div:eq(0)').text(data.kode + ' - ' + data.nama);
                tr.find('td:eq(1) div:eq(1)').text(data.category);
                tr.find('td:eq(1) div:eq(2)').text('(Harga Jual : ' + numberFormat.format(salePrice) + ')');
                tr.find('td:eq(1) input.sales-order-product-code').val(data.kode);
                tr.find('td:eq(1) input.sales-order-product-id').val(productID);
                tr.find('td:eq(1) input.sales-order-product-name').val(data.nama);
                tr.find('td:eq(1) input.sales-order-product-category').val(data.category);
                tr.find('td:eq(1) input.sales-order-product-price').val(price);
                tr.find('td:eq(1) input.sales-order-product-base-price').val(salePrice);
                tr.find('td:eq(1) input.sales-order-product-quantity').val(quantity);
                tr.find('td:eq(1) input.sales-order-product-discount').val(discount);
                tr.find('td:eq(2)').text(quantity);
                tr.find('td:eq(3)').text(numberFormat.format(price));
                tr.find('td:eq(4)').text(numberFormat.format(discount));
                tr.find('td:eq(5)').text(numberFormat.format(total));
            }

            calculateAll();
        }
    });
});

$(document).on('click', 'a[class^=\"btn-edit\"]', function(e) {
    e.preventDefault();
    var url = $(this).attr('href');
    if (url == '#') {
        var tr = $(this).parent().parent().parent();
        var row = tr.index();
        var productID = tr.find('input.sales-order-product-id').val();
        var quantity = tr.find('input.sales-order-product-quantity').val();
        var price = tr.find('input.sales-order-product-price').val();
        var discount = tr.find('input.sales-order-product-discount').val();

        $('#product-list').val(productID);
        $('#product-quantity').val(quantity);
        $('#product-price').val(price);
        $('#product-discount').val(discount);
        $('#is-edit-form').val(1);
        $('#row-source').val(row);
    }
});

$(document).on('click', 'a[class^=\"btn-delete\"]', function(e) {
    e.preventDefault();
    var url = $(this).attr('href');
    var parents = $(this).parent().parent().parent();

    Swal.fire({
        title: 'Hapus Data',
        text: 'Apakah anda yakin ingin menghapus data?',
        icon: 'warning',
        showCancelButton: true,
        reverseButtons:true,
        confirmButtonText: 'Ya, Hapus Data!'
    }).then((result) => {
        if (result.isConfirmed) {
            if (url == '#') {
                parents.remove();
                calculateAll();
            } else {
                $.ajax({
                    url : url,
                    type : 'POST',
                    success : function(data){
                        if (data.code == 200) {
                            var title = 'Sukses!';
                            var message = 'Data Berhasil Dihapus.';
                            var icon = 'success';
                        } else {
                            var title = 'Gagal!';
                            var message = 'Data Gagal Dihapus.';
                            var icon = 'error';
                        }
                        Swal.fire(
                            title,
                            message,
                            icon
                        ).then((result) => {
                            parents.remove();
                            calculateAll();
                        });
                    }
                });
            }
        }
    });
});

function calculateAll() {
    var totalRows = $('#table-produk tbody tr').length;
    var subTotal = 0;
    var totalDiscount = 0;
    var total = 0;

    for (let i = 1; i <= totalRows; i++) {
        var selector = '#table-produk tbody tr:nth-child('+ i +') td:nth-child(2) ';
        var priceSelector = selector + 'input.sales-order-product-price';

        var quantitySelector = selector + 'input.sales-order-product-quantity';

        var price = parseFloat($(priceSelector).val());
        var quantity = parseFloat($(quantitySelector).val());
        subTotal = subTotal + (price * quantity);

        var discountSelector = selector + 'input.sales-order-product-discount';

        var discount = parseFloat($(discountSelector).val());
        totalDiscount = totalDiscount + discount;

        total = subTotal - totalDiscount;
    }

    $('#summary-subtotal').text(numberFormat.format(subTotal));
    $('#salesorder-sub_total').val(subTotal);

    $('#salesorder-diskon').val(totalDiscount);
    $('#summary-diskon').text(numberFormat.format(totalDiscount));
    $('#summary-total').text(numberFormat.format(total));
}
";

if (!$model->isNewRecord) {
    $js .= 'calculateAll()';
}

$this->registerJs($js, $this::POS_END, 'sales-order-custom-handler');
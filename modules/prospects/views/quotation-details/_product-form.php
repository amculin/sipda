<?php
use yii\helpers\Url;

$i = 0;
foreach ($model as $key => $val) { ?>
<tr>
    <td class="text-nowrap">
        <div class="hstack gap-3">
            <a href="#"
                class="btn-edit modal-trigger" data-bs-toggle="modal" data-bs-target="#modal-produk">
                <i class="bi bi-pencil text-dark"></i>
            </a>
            <a href="#" class="btn-delete"><i class="bi bi-trash text-danger"></i></a>
        </div>
    </td>
    <td>
        <div class="fw-bold"><?= $val->kode_produk .'-'. $val->nama_produk; ?></div>
        <div class="text-secondary"><?= $val->nama_kategori; ?></div>
        <div class="text-secondary" style="font-size:10px; color: #844 !important;">
            (Harga Jual : <?= number_format($val->harga_jual, 0, ",", "."); ?>)
        </div>
        <input type="hidden" class="sales-order-product-detail-id" name="SalesOrder[product][<?= $i; ?>][id]" value="<?= $val->id; ?>" />
        <input type="hidden" class="sales-order-product-code" name="SalesOrder[product][<?= $i; ?>][product_code]" value="<?= $val->kode_produk; ?>" />
        <input type="hidden" class="sales-order-product-id" name="SalesOrder[product][<?= $i; ?>][product_id]" value="<?= $val->id_produk; ?>" />
        <input type="hidden" class="sales-order-product-name" name="SalesOrder[product][<?= $i; ?>][product_name]" value="<?= $val->nama_produk; ?>" />
        <input type="hidden" class="sales-order-product-category" name="SalesOrder[product][<?= $i; ?>][product_category]" value="<?= $val->nama_kategori; ?>" />
        <input type="hidden" class="sales-order-product-price" name="SalesOrder[product][<?= $i; ?>][product_price]" value="<?= (int) $val->harga; ?>" />
        <input type="hidden" class="sales-order-product-base-price" name="SalesOrder[product][<?= $i; ?>][product_base_price]" value="<?= (int) $val->harga_jual; ?>" />
        <input type="hidden" class="sales-order-product-quantity" name="SalesOrder[product][<?= $i; ?>][product_quantity]" value="<?= $val->jumlah; ?>" />
        <input type="hidden" class="sales-order-product-discount" name="SalesOrder[product][<?= $i; ?>][product_discount]" value="<?= (int) $val->diskon; ?>" />
    </td>
    <td class="text-end"><?= $val->jumlah; ?></td>
    <td class="text-end"><?= number_format($val->harga, 0, ",", "."); ?></td>
    <td class="text-end"><?= number_format($val->diskon, 0, ",", "."); ?></td>
    <td class="text-end"><?= number_format(($val->harga * $val->jumlah - $val->diskon), 0, ",", ".") ?></td>
</tr>
<?php
    $i++;
}

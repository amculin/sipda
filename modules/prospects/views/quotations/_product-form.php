<?php
use app\assets\FormModalAsset;
use yii\helpers\Url;

$i = 0;
foreach ($model->quotationDetails as $key => $val) { ?>
<tr>
    <td class="text-nowrap">
        <div class="hstack gap-3">
            <a href="<?= Url::to(['/prospects/quotation-details/update', 'id' => $val->id], true); ?>"
                class="btn-edit modal-trigger" data-bs-toggle="modal" data-bs-target="#modal-form">
                <i class="bi bi-pencil text-dark"></i>
            </a>
            <a href="<?= Url::to(['/prospects/quotation-details/delete', 'id' => $val->id], true); ?>"
                class="btn-delete"><i class="bi bi-trash text-danger"></i>
            </a>
        </div>
    </td>
    <td>
        <div class="fw-bold"><?= $val->kode_produk .'-'. $val->nama_produk; ?></div>
        <div class="text-secondary"><?= $val->nama_kategori; ?></div>
        <div class="text-secondary" style="font-size:10px; color: #844 !important;">
            (Harga Jual : <?= number_format($val->harga_jual, 0, ",", "."); ?>)
        </div>
        <input type="hidden" class="quotation-product-" name="Quotation[produk][<?= $i; ?>][id]" value="<?= $val->id; ?>" />
        <input type="hidden" class="quotation-product-" name="Quotation[produk][<?= $i; ?>][product_code]" value="<?= $val->kode_produk; ?>" />
        <input type="hidden" class="quotation-product-id" name="Quotation[produk][<?= $i; ?>][product_id]" value="<?= $val->id_produk; ?>" />
        <input type="hidden" class="quotation-product-name" name="Quotation[produk][<?= $i; ?>][product_name]" value="<?= $val->nama_produk; ?>" />
        <input type="hidden" class="quotation-product-category" name="Quotation[produk][<?= $i; ?>][product_category]" value="<?= $val->nama_kategori; ?>" />
        <input type="hidden" class="quotation-product-price" name="Quotation[produk][<?= $i; ?>][product_price]" value="<?= (int) $val->harga; ?>" />
        <input type="hidden" class="quotation-product-base-price" name="Quotation[produk][<?= $i; ?>][product_base_price]" value="<?= (int) $val->harga_jual; ?>" />
        <input type="hidden" class="quotation-product-quantity" name="Quotation[produk][<?= $i; ?>][product_quantity]" value="<?= $val->jumlah; ?>" />
        <input type="hidden" class="quotation-product-discount" name="Quotation[produk][<?= $i; ?>][product_discount]" value="<?= (int) $val->diskon; ?>" />
    </td>
    <td class="text-end"><?= $val->jumlah; ?></td>
    <td class="text-end"><?= number_format($val->harga, 0, ",", "."); ?></td>
    <td class="text-end"><?= number_format($val->diskon, 0, ",", "."); ?></td>
    <td class="text-end"><?= number_format(($val->harga * $val->jumlah - $val->diskon), 0, ",", ".") ?></td>
</tr>
<?php
    $i++;
}
?>
<?php
FormModalAsset::register($this);
?>
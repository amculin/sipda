<?php
use yii\helpers\Url;
?>
<div class="page-wrapper" data-menu-active="Komisi Penjualan">
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle mb-2">
                        <ol class="breadcrumb" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="<?= Url::to('/dashboard/index', true); ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?= Url::to('/sales/comissions/index', true); ?>">Komisi Penjualan</a></li>
                            <li class="breadcrumb-item active"><a href="#">Detail</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title">Detail Komisi Penjualan</h2>
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
                                <td class="text-end"><?= 'SL' . str_pad($model->sales_id, 4, '0', STR_PAD_LEFT); ?></td>
                            </tr>
                            <tr>
                                <td>Nama Sales</td>
                                <td class="text-end"><?= $model->sales->nama; ?></td>
                            </tr>
                            <tr>
                                <td>Jabatan</td>
                                <td class="text-end"><?= $model->sales->jabatan; ?></td>
                            </tr>
                            <tr>
                                <td>Prosentase Komisi</td>
                                <td class="text-end"><?= round(($model->comission / $plan->saleTarget) * 100) ?>%</td>
                            </tr>
                            <tr>
                                <td>Komisi Jabatan</td>
                                <td class="text-end"><?= $model->sales->komisi_jabatan; ?>%</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-auto d-none d-lg-block p-0" style="border-right: 1px dashed #ddd;"></div>
                    <div class="col-lg">
                        <div class="card-header py-3 border-0 px-2 fw-bold">INFORMASI PENJUALAN</div>
                        <table class="table m-0 table-borderless table-striped">
                            <tr>
                                <td>Periode</td>
                                <td class="text-end"><?= $model->getPeriode(); ?></td>
                            </tr>
                            <tr>
                                <td>Target Penjualan</td>
                                <td class="text-end"><?= $plan->toRupiah($plan->saleTarget); ?></td>
                            </tr>
                            <tr>
                                <td>Jumlah Penjualan</td>
                                <td class="text-end"><?= $model->toRupiah($model->total_sale); ?></td>
                            </tr>
                            <tr>
                                <td>Capaian</td>
                                <td class="text-end"><?= round(($model->total_sale / $plan->saleTarget) * 100) . '%'; ?></td>
                            </tr>
                            <tr>
                                <td>Jumlah Komisi</td>
                                <td class="text-end fw-bold"><?= $model->toRupiah($model->comission); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card mt-2">
                <div class="card-header"></div>
                <div class="table-responsive card-body p-0">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="5">No</th>
                                <th>Tanggal</th>
                                <th>Kode SO</th>
                                <th>Kode Produk</th>
                                <th>Nama Produk</th>
                                <th class="text-end">Harga Jual</th>
                                <th class="text-end">Harga Penjualan</th>
                                <th class="text-end">Quantity</th>
                                <th class="text-end">Harga Total</th>
                                <th class="text-end">Selisih Harga</th>
                                <th class="text-end">Komisi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($products as $key => $val) {
                                $fixedPrice = $val['harga_jual'] * $val['jumlah'];
                                $priceDiff = $val['harga'] - $val['harga_jual'];
                                $comission = $priceDiff * $val['jumlah'] - $val['diskon'];
                            ?>
                            <tr>
                                <td><?= ($key + 1); ?></td>
                                <td><?= date('d/m/Y', strtotime($val['tanggal'])); ?></td>
                                <td><?= $val['kode']; ?></td>
                                <td><?= $val['kode_produk']; ?></td>
                                <td><?= $val['nama_produk']; ?></td>
                                <td class="text-end"><?= $model->toRupiah($val['harga_jual']); ?></td>
                                <td class="text-end"><?= $model->toRupiah($val['harga']); ?></td>
                                <td class="text-end"><?= $val['jumlah']; ?></td>
                                <td class="text-end"><?= $model->toRupiah($fixedPrice); ?></td>
                                <td class="text-end"><?= $model->toRupiah($priceDiff); ?></td>
                                <td class="text-end fw-bold"><?= $model->toRupiah($comission); ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-center"></div>
            </div>
        </div>
    </div>
</div>

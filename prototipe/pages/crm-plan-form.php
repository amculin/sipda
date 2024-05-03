<?php
$bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
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
                                <td class="text-end">SL001</td>
                            </tr>
                            <tr>
                                <td>Nama Sales</td>
                                <td class="text-end">Ibrahim Jaya</td>
                            </tr>
                            <tr>
                                <td>Jabatan</td>
                                <td class="text-end fw-bold">Senior Sales</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <form action="" method="get">
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

                                <?php for ($i=0; $i<6; $i++): ?>
                                    <tr>
                                        <td style="vertical-align: middle;background: #eee;" class="text-center"><?= $i+1 ?></td>
                                        <td style="vertical-align: middle;"><?= $bulan[$i] ?></td>
                                        <td>
                                            <input type="text" class="form-control text-end" value="0">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control text-end" value="0">
                                        </td>
                                        <td></td>
                                        <td style="vertical-align: middle;background: #eee;" class="text-center"><?= $i+7 ?></td>
                                        <td style="vertical-align: middle;"><?= $bulan[$i+6] ?></td>
                                        <td>
                                            <input type="text" class="form-control text-end" value="0">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control text-end" value="0">
                                        </td>
                                    </tr>
                                <?php endfor; ?>

                                <tr>
                                    <th colspan="8">Target Penjualan Tahunan</th>
                                    <th class="text-end">0</th>
                                </tr>
                                <tr>
                                    <th colspan="8">Target Dasar Komisi Tahunan</th>
                                    <th class="text-end">0</th>
                                </tr>
                                
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-3 d-flex gap-2">
                    <a href="javascript:history.back(-1);" class="btn btn px-4"><i class="bi bi-arrow-left me-2"></i>Kembali</a>
                    <button class="btn btn-primary px-4" type="submit">Simpan</button>
                </div>
            </form>
            
        </div>
    </div>
</div>
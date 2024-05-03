<div class="page-wrapper" data-menu-active="Sales Order">
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle mb-2">
                        <ol class="breadcrumb" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active"><a href="index.php">Sales Order</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title">Sales Order</h2>
                    
                </div>
                <div class="col-auto ms-auto">
                    
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <a href="?page=crm-sales-order-form" class="btn btn-primary d-none d-sm-inline-block">
                        <i class="bi bi-plus"></i>
                        Tambah Data
                    </a>
                    <div class="ms-auto d-flex gap-2">
                        <select name="" id="" class="form-select" style="width:140px">
                            <option value="">Semua Status</option>
                            <option value="">Disetujui</option>
                            <option value="">Tidak Disetujui</option>
                        </select>
                        <select name="" id="" class="form-select" style="width:200px">
                            <option value="">Semua Sales</option>
                            <option value="">S0001 - Ibrahim Jaya</option>
                            <option value="">S0002 - Budi Purnanto</option>
                        </select>
                        <select name="" id="" class="form-select" style="width:140px">
                            <option value="">Semua Tahun</option>
                            <option value="">2023</option>
                            <option value="">2022</option>
                        </select>
                        <?php /*
                        <select name="" id="" class="form-select" style="width:160px">
                            <option value="">Semua Bulan</option>
                            <option value="">Januari</option>
                            <option value="">Februari</option>
                            <option value="">Maret</option>
                            <option value="">April</option>
                            <option value="">Mei</option>
                            <option value="">Juni</option>
                            <option value="">Juli</option>
                            <option value="">Agustus</option>
                            <option value="">September</option>
                            <option value="">Oktober</option>
                            <option value="">November</option>
                            <option value="">Desember</option>
                        </select>
                        */ ?>
                        <div class="input-group" style="width:200px">
                            <input type="text" class="form-control" placeholder="Cari data..">
                            <button class="btn"><i class="bi bi-search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive card-body p-0">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="5" rowspan="2">No</th>
                                <th width="10" class="text-center" rowspan="2">Action</th>
                                <th>Nama Sales</th>
                                <th>Nomor SO</th>
                                <th>Tanggal SO</th>
                                <th>Kode Proyek</th>
                                <th>Nama Proyek</th>
                                <th>Nama Perusahaan</th>
                                <th class="text-end">Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td class="text-nowrap d-flex gap-2">
                                    <a href="?page=crm-sales-order-form" class="text-dark"><i class="bi bi-pencil" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"></i></a>
                                    <a href="#" class="text-dark"><i class="bi bi-check-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Disetujui"></i></a>
                                    <a href="static/cetak/sales-order.html" target="_blank" class="text-info"><i class="bi bi-printer"></i></a>
                                    <a href="#" class="text-danger" onclick="deleteData();"><i class="bi bi-trash" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus"></i></a>
                                </td>
                                <td>Ibrahim Jaya</td>
                                <td>SO49/2307/0001045</td>
                                <td>20/09/2023</td>
                                <td>PK202300018</td>
                                <td>Pembangunan Aplikasi Aset</td>
                                <td>PT. Adi Jaya</td>
                                <td>160.000.000</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td class="text-nowrap d-flex gap-2">
                                    <a href="?page=crm-sales-order-form" class="text-dark"><i class="bi bi-pencil" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"></i></a>
                                    <a href="#" class="text-success"><i class="bi bi-check-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tidak Disetujui"></i></a>
                                    <a href="static/cetak/sales-order.html" target="_blank" class="text-info"><i class="bi bi-printer"></i></a>
                                    <a href="#" class="text-danger" onclick="deleteData();"><i class="bi bi-trash" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus"></i></a>
                                </td>
                                <td>Ibrahim Jaya</td>
                                <td>SO49/2307/0001044</td>
                                <td>09/09/2023</td>
                                <td>PK202300014</td>
                                <td>Pembangunan Aplikasi Geoportal</td>
                                <td>Dinas Tata Ruang</td>
                                <td>180.000.000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-center">
                    <ul class="pagination ms-auto m-0">
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item active"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">4</a></li>
                        <li class="page-item"><a class="page-link" href="#">5</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">
                                next <!-- Download SVG icon from http://tabler-icons.io/i/chevron-right -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M9 6l6 6l-6 6"></path></svg>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            
        </div>
    </div>
</div>

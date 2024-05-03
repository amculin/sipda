<div class="page-wrapper" data-menu-active="Broadcast" data-submenu-active="Broadcast">
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle mb-2">
                        <ol class="breadcrumb" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="index.php">Broadcast</a></li>
                            <li class="breadcrumb-item active"><a href="index.php">Broadcast Email</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title">Broadcast Email</h2>
                    
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
                    <a href="?page=promosi-broadcast-form" class="btn btn-primary d-none d-sm-inline-block">
                        <i class="bi bi-plus"></i>
                        Tambah Data
                    </a>
                    <div class="ms-auto d-flex gap-2">
                        <select name="" id="" class="form-select" style="width:200px">
                            <option value="">Semua Sales</option>
                            <option value="">S0001 - Ibrahim Jaya</option>
                            <option value="">S0002 - Budi Purnanto</option>
                        </select>
                        <select name="" id="" class="form-select" style="width:160px">
                            <option value="">Semua Tahun</option>
                            <option value="">2023</option>
                            <option value="">2022</option>
                        </select>
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
                                <th width="5">No</th>
                                <th width="10" class="text-center">Action</th>
                                <th>Broadcast</th>
                                <th>Nama Sales</th>
                                <th>Tanggal</th>
                                <th>Kode Broadcast</th>
                                <th>Judul Broadcast</th>
                                <th>Channel</th>
                                <th>Scheduled Send</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td class="text-nowrap d-flex gap-2">
                                    <a href="?page=promosi-broadcast-form" class="text-dark"><i class="bi bi-pencil" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"></i></a>
                                    <a href="#" class="text-dark"><i class="bi bi-view-list" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Preview Email"></i></a>
                                    <a href="#" class="text-danger" onclick="deleteData();"><i class="bi bi-trash" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus"></i></a>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-outline-success btn-sm rounded-pill px-3"><i class="bi bi-send me-2"></i> Send</a>
                                </td>
                                <td>Ibrahim Jaya</td>
                                <td>10/11/2023</td>
                                <td>BE23090001</td>
                                <td>Penawaran Aplikasi Aset</td>
                                <td>Badan Perencanaan</td>
                                <td>-</td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-outline-default btn-sm rounded-pill px-3">On Progress</a>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td class="text-nowrap d-flex gap-2">
                                    <a href="?page=promosi-broadcast-form" class="text-dark"><i class="bi bi-pencil" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"></i></a>
                                    <a href="#" class="text-dark"><i class="bi bi-view-list" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Preview Email"></i></a>
                                    <a href="#" class="text-danger" onclick="deleteData();"><i class="bi bi-trash" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus"></i></a>
                                </td>
                                <td>
                                    <a href="#" class="btn btn-outline-secondary btn-sm rounded-pill px-3"><i class="bi bi-send me-2"></i> Resend</a>
                                </td>
                                <td>Ibrahim Jaya</td>
                                <td>08/11/2023</td>
                                <td>BE23090002</td>
                                <td>Penawaran Aplikasi Geoportal</td>
                                <td>Dinas Tata Ruang</td>
                                <td>-</td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-outline-success btn-sm rounded-pill px-3"><i class="bi bi-check2-circle me-2"></i> Sent</a>
                                </td>
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

<!-- Modal -->
<div class="modal fade modal-blur" id="modal-form" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-2">
                    <label for="" class="form-label">Nama Channel</label>
                    <input type="text" class="form-control">
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Keterangan</label>
                    <textarea class="form-control"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
            </div>
        </div>
    </div>
</div>

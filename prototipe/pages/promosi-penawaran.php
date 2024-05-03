<div class="page-wrapper" data-menu-active="Prospek" data-submenu-active="Quotation">
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle mb-2">
                        <ol class="breadcrumb" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="index.php">Prospek</a></li>
                            <li class="breadcrumb-item active"><a href="index.php">Quotation</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title">Quotation</h2>
                    
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
                    <a href="?page=promosi-penawaran-form" class="btn btn-primary d-none d-sm-inline-block">
                        <i class="bi bi-plus"></i>
                        Tambah Data
                    </a>
                    <div class="ms-auto d-flex gap-2">
                        <select name="" id="" class="form-select" style="width:140px">
                            <option value="">Semua Status</option>
                            <option value="">Disetujui</option>
                            <option value="">Tidak Disetujui</option>
                        </select>
                        <select name="" id="" class="form-select" style="width:160px">
                            <option value="">Semua Sales</option>
                            <option value="">S0001 - Ibrahim Jaya</option>
                            <option value="">S0002 - Sunaryanto</option>
                        </select>
                        <select name="" id="" class="form-select" style="width:160px">
                            <option value="">Semua Tahun</option>
                            <option value="">2023</option>
                            <option value="">2022</option>
                        </select>
                        <div class="input-group">
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
                                <th>Nama Sales</th>
                                <th>Nomor Surat</th>
                                <th>Judul Penawaran</th>
                                <th>Tanggal Surat</th>
                                <th>Perusahaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td class="text-nowrap gap-2">
                                    <a href="?page=promosi-penawaran-form" class="text-dark"><i class="bi bi-pencil" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"></i></a>
                                    <a href="#" class="text-dark"><i class="bi bi-printer" data-bs-placement="bottom" title="Cetak"></i></a>
                                    <a href="#" class="text-primary"><i class="bi bi-envelope-at" data-bs-placement="bottom" title="Send Email"></i></a>
                                    <a href="#" class="text-dark"><i class="bi bi-check-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Disetujui"></i></a>
                                    <a href="#" class="text-danger" onclick="deleteData();"><i class="bi bi-trash" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus"></i></a>
                                </td>
                                <td>Ibrahim Jaya</td>
                                <td>SP2023090018</td>
                                <td>Penawaran Aplikasi Aset</td>
                                <td>20/09/2023</td>
                                <td>PT. Maju Makmur</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td class="text-nowrap text-center gap-2">
                                    <a href="?page=promosi-penawaran-form" class="text-dark"><i class="bi bi-pencil" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"></i></a>
                                    <a href="#" class="text-dark"><i class="bi bi-printer" data-bs-placement="bottom" title="Cetak"></i></a>
                                    <a href="#" class="text-primary"><i class="bi bi-envelope-at" data-bs-placement="bottom" title="Send Email"></i></a>
                                    <a href="#" class="text-success"><i class="bi bi-check-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tidak Disetujui"></i></a>
                                    <a href="#" class="text-danger" onclick="deleteData();"><i class="bi bi-trash" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus"></i></a>
                                </td>
                                <td>Ibrahim Jaya</td>
                                <td>SP2023090017</td>
                                <td>Penawaran Aplikasi Gudang</td>
                                <td>17/09/2023</td>
                                <td>PT. Mandiri Sejahtera</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td class="text-nowrap text-center gap-2">
                                    <a href="?page=promosi-penawaran-form" class="text-dark"><i class="bi bi-pencil" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"></i></a>
                                    <a href="#" class="text-dark"><i class="bi bi-printer" data-bs-placement="bottom" title="Cetak"></i></a>
                                    <a href="#" class="text-primary"><i class="bi bi-envelope-at" data-bs-placement="bottom" title="Send Email"></i></a>
                                    <a href="#" class="text-success"><i class="bi bi-check-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tidak Disetujui"></i></a>
                                    <a href="#" class="text-danger" onclick="deleteData();"><i class="bi bi-trash" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus"></i></a>
                                </td>
                                <td>Ibrahim Jaya</td>
                                <td>SP2023090015</td>
                                <td>Penawaran Aplikasi Geoportal</td>
                                <td>17/09/2023</td>
                                <td>Dinas Tata Ruang Sleman</td>
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

<div class="page-wrapper" data-menu-active="Broadcast" data-submenu-active="Log Email">
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle mb-2">
                        <ol class="breadcrumb" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="index.php">Broadcast</a></li>
                            <li class="breadcrumb-item active"><a href="index.php">Log Email</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title">Log Email</h2>
                    
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
                            <option value="">Semua Status</option>
                            <option value="">Terkirim</option>
                            <option value="">Dibaca</option>
                            <option value="">Gagal</option>
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
                                <th>Nama Sales</th>
                                <th>Kode Broadcast</th>
                                <th>Subject</th>
                                <th>Nama Tujuan</th>
                                <th>Email Tujuan</th>
                                <th>Timestamp</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Ibrahim Jaya</td>
                                <td>BE23090001</td>
                                <td>Penawaran Produk e-Planning</td>
                                <td>Wili Sujono</td>
                                <td>wili@gmail.com</td>
                                <td>20/09/2023 10:00:00</td>
                                <td class="text-nowrap d-flex gap-2">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal-status" class="btn btn-info btn-sm rounded-pill"><i class="bi bi-check2-all pe-2"></i>Dibaca</a>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Ibrahim Jaya</td>
                                <td>BE23090001</td>
                                <td>Penawaran Produk e-Planning</td>
                                <td>Retno Suprihatin</td>
                                <td>retno@gmail.com</td>
                                <td>20/09/2023 09:40:00</td>
                                <td class="text-nowrap d-flex gap-2">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modal-status" class="btn btn-success btn-sm rounded-pill"><i class="bi bi-check2 pe-2"></i>Terkirim</a>
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
<div class="modal fade modal-blur" id="modal-status" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <table class="table">
                    <tr>
                        <td style="width: 30px;">1</td>
                        <td>Created</td>
                        <td class="text-end">20/09/2023 10:00:00</td>
                    </tr>
                    <tr>
                        <td style="width: 30px;">2</td>
                        <td>Terkirim</td>
                        <td class="text-end">20/09/2023 12:00:00</td>
                    </tr>
                    <tr>
                        <td style="width: 30px;">3</td>
                        <td>Dibaca</td>
                        <td class="text-end">20/09/2023 15:00:00</td>
                    </tr>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

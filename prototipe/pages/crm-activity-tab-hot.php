<style type="text/css">
    .nav-theme .nav-link.active{
        background: #fbebeb;
        color:#d63939;
        border-color:transparent;
        font-weight: bold;
    }    
    .card-header-theme{
        background: #fbebeb;
    }
</style>
<div class="card-header card-header-theme">
    <a href="#" class="btn btn-default d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-channel">
        <i class="bi bi-person-add"></i>
        Tambahkan ke Channel
    </a>
    <div class="ms-auto d-flex gap-2">
        <select name="" id="" class="form-select" style="width:160px">
            <option value="">Semua Sales</option>
            <option value="">S0001 - Ibrahim Jaya</option>
            <option value="">S0002 - Sunaryanto</option>
        </select>
        <select name="" id="" class="form-select" style="width:160px">
            <option value="">Semua Tahun</option>
            <option value="">2023</option>
            <option value="">2022</option>
            <option value="">2021</option>
        </select>
        <div class="input-group" style="width:160px">
            <input type="text" class="form-control" placeholder="Cari data..">
            <button class="btn"><i class="bi bi-search"></i></button>
        </div>
    </div>
</div>
<div class="table-responsive card-body p-0">
    <table class="table">
        <thead>
            <tr style="background:#ddf">
                <th width="5">No</th>
                <th width="5"><input type="checkbox"></th>
                <th width="10" class="text-center">Action</th>
                <th>Nama Sales</th>
                <th>Kode Prospek</th>
                <th>Nama Prospek</th>
                <th>Nama Perusahaan</th>
                <th class="text-end">Nilai</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td><input type="checkbox"></td>
                <td class="text-nowrap d-flex gap-2">
                    <a href="#" class="text-dark" data-bs-toggle="modal" data-bs-target="#modal-form"><i class="bi bi-pencil" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"></i></a>
                    <a href="?page=crm-activity-detail" class="text-info"><i class="bi bi-journal-text" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Aktivitas"></i></a>
                    <a href="#" class="text-success" data-bs-toggle="modal" data-bs-target="#modal-konversi"><i class="bi bi-arrow-right-circle-fill" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Konversi"></i></a>
                    <a href="#" class="text-warning" data-bs-toggle="modal" data-bs-target="#modal-tracking"><i class="bi bi-diagram-2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tracking"></i></a>
                    <a href="#" class="text-danger" onclick="deleteData();"><i class="bi bi-trash" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus"></i></a>
                </td>
                <td>Ibrahim Jaya</td>
                <td>PK2023-00018</td>
                <td>Pembangunan Aplikasi Aset</td>
                <td>PT. Adi Jaya</td>
                <td class="text-end">160.000.000</td>
            </tr>
            <tr>
                <td>2</td>
                <td><input type="checkbox"></td>
                <td class="text-nowrap d-flex gap-2">
                    <a href="#" class="text-dark" data-bs-toggle="modal" data-bs-target="#modal-form"><i class="bi bi-pencil" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"></i></a>
                    <a href="?page=crm-activity-detail" class="text-info"><i class="bi bi-journal-text" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Aktivitas"></i></a>
                    <a href="#" class="text-success" data-bs-toggle="modal" data-bs-target="#modal-konversi"><i class="bi bi-arrow-right-circle-fill" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Konversi"></i></a>
                    <a href="#" class="text-warning" data-bs-toggle="modal" data-bs-target="#modal-tracking"><i class="bi bi-diagram-2" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tracking"></i></a>
                    <a href="#" class="text-danger" onclick="deleteData();"><i class="bi bi-trash" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus"></i></a>
                </td>
                <td>Ibrahim Jaya</td>
                <td>PK2023-00016</td>
                <td>Pembangunan Aplikasi Geoportal</td>
                <td>Dinas Tata Ruang DIY</td>
                <td class="text-end">180.000.000</td>
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

<!-- Modal -->
<div class="modal fade modal-blur" id="modal-form" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Form Leads</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-2">
                    <label for="" class="form-label">Nama Kontak</label>
                    <input type="text" class="form-control">
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Nomor Telepon</label>
                    <input type="text" class="form-control" style="width:200px">
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Email</label>
                    <input type="text" class="form-control">
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Nama Perusahaan</label>
                    <input type="text" class="form-control">
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Kebutuhan</label>
                    <textarea class="form-control"></textarea>
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Event Promosi</label>
                    <select class="form-select">
                        <option>Bukan Event Promosi</option>
                        <option>EV23010008 - Promo Awal Tahun</option>
                        <option>EV23030009 - Promo Lebaran</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade modal-blur" id="modal-channel" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambahkan Channel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-2">
                    Aksi ini akan menambahkan leads yang dipilih ke dalam channel broadcast. Silahkan pilih channel yang dituju.
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Pilih Channel</label>
                    <select class="form-select">
                        <option>Badan Perencanaan</option>
                        <option>Perusahaan Alat Kesehatan</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade modal-blur" id="modal-konversi" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konversi Prospek</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-2">
                    <label for="" class="form-label">Tahapan Prospek</label>
                    <select class="form-select">
                        <option>COLD</option>
                        <option>WARM</option>
                        <option selected>DEAL</option>
                        <option>FAIL</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Lampiran Dokumen</label>
                    <input type="file" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade modal-blur" id="modal-tracking" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tracking Prospek</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="list-group">
                    <div class="list-group-item">
                        <div class="row">
                            <div class="col-auto">
                                <span class="avatar bg-primary rounded-circle"><i class="bi bi-megaphone h1 m-0"></i></span>
                            </div>
                            <div class="col">
                                <div class="fw-bold mb-1 text-truncate">Promosi : Promo Lebaran</div>
                                <div class="text-secondary fs-5 hstack gap-3">
                                    <span><i class="bi bi-calendar-week me-1"></i> 12 Mei 2023</span>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                
                            </div>
                        </div>
                    </div>
                    <div class="list-group-item">
                        <div class="row">
                            <div class="col-auto">
                                <span class="avatar bg-info rounded-circle"><i class="bi bi-snow3 h1 m-0"></i></span>
                            </div>
                            <div class="col">
                                <div class="fw-bold mb-1 text-truncate">Cold Prospek</div>
                                <div class="text-secondary fs-5 hstack gap-3">
                                    <span><i class="bi bi-calendar-week me-1"></i> 14 Juni 2023</span>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="fw-bold mb-1 text-truncate">Harga</div>
                                <div class="text-secondary fs-5 hstack gap-3">
                                    <span><i class="bi bi-cash-stack me-1"></i> 160.000.000</span>
                                </div>
                            </div>
                            <div class="col-lg-2">
                            </div>
                        </div>
                    </div>
                    <div class="list-group-item">
                        <div class="row">
                            <div class="col-auto">
                                <span class="avatar bg-warning rounded-circle"><i class="bi bi-cloud-sun h1 m-0"></i></span>
                            </div>
                            <div class="col">
                                <div class="fw-bold mb-1 text-truncate">Warm Prospek</div>
                                <div class="text-secondary fs-5 hstack gap-3">
                                    <span><i class="bi bi-calendar-week me-1"></i> 21 Juli 2023</span>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="fw-bold mb-1 text-truncate">Harga</div>
                                <div class="text-secondary fs-5 hstack gap-3">
                                    <span><i class="bi bi-cash-stack me-1"></i> 160.000.000</span>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <button type="button" class="btn btn-default">Lampiran</button>
                            </div>
                        </div>
                    </div>
                    <div class="list-group-item">
                        <div class="row">
                            <div class="col-auto">
                                <span class="avatar bg-danger rounded-circle"><i class="bi bi-sun h1 m-0"></i></span>
                            </div>
                            <div class="col">
                                <div class="fw-bold mb-1 text-truncate">Hot Prospek</div>
                                <div class="text-secondary fs-5 hstack gap-3">
                                    <span><i class="bi bi-calendar-week me-1"></i> 1 Agustus 2023</span>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="fw-bold mb-1 text-truncate">Harga</div>
                                <div class="text-secondary fs-5 hstack gap-3">
                                    <span><i class="bi bi-cash-stack me-1"></i> 155.000.000</span>
                                </div>
                            </div>
                            <div class="col-lg-2">
                                <button type="button" class="btn btn-default">Lampiran</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
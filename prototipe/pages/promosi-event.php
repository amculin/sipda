<div class="page-wrapper" data-menu-active="Program">
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle mb-2">
                        <ol class="breadcrumb" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active"><a href="index.php">Program</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title">Program / Event</h2>
                    
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
                    <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-form">
                        <i class="bi bi-plus"></i>
                        Tambah Data
                    </a>
                    <div class="ms-auto d-flex gap-2">
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
                                <th>Kode Program / Event</th>
                                <th>Judul Program / Event</th>
                                <th>Lokasi</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td class="text-nowrap d-flex gap-2">
                                    <a href="#" class="text-dark" data-bs-toggle="modal" data-bs-target="#modal-form"><i class="bi bi-pencil" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"></i></a>
                                    <a href="#" class="text-success"><i class="bi bi-check-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Disable"></i></a>
                                    <a href="#" class="text-danger" onclick="deleteData();"><i class="bi bi-trash" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus"></i></a>
                                </td>
                                <td>EV23030009</td>
                                <td>Promo Lebaran</td>
                                <td>DIY</td>
                                <td>1 April 2023</td>
                                <td>31 Mei 2023</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td class="text-nowrap d-flex gap-2">
                                    <a href="#" class="text-dark" data-bs-toggle="modal" data-bs-target="#modal-form"><i class="bi bi-pencil" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"></i></a>
                                    <a href="#" class="text-dark"><i class="bi bi-slash-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Enable"></i></a>
                                    <a href="#" class="text-danger" onclick="deleteData();"><i class="bi bi-trash" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus"></i></a>
                                </td>
                                <td>EV23010008</td>
                                <td>Promo Awal Tahun</td>
                                <td>DIY</td>
                                <td>1 Februari 2023</td>
                                <td>28 Februari 2023</td>
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
                    <label for="" class="form-label">Judul Program / Event</label>
                    <input type="text" class="form-control">
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Keterangan</label>
                    <textarea class="form-control"></textarea>
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Lokasi</label>
                    <input type="text" class="form-control">
                </div>
                <div class="mb-2 col-4">
                    <label for="" class="form-label">Tanggal Mulai</label>
                    <input type="date" class="form-control">
                </div>
                <div class="mb-2 col-4">
                    <label for="" class="form-label">Tanggal Selesai</label>
                    <input type="date" class="form-control">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    function lockData(){
        Swal.fire({
            title: 'Kunci User?',
            text: 'Apakah anda yakin?',
            icon: 'warning',
            showCancelButton: true,
            reverseButtons:true,
            confirmButtonText: 'Ya, Kunci User!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Sukses!',
                    'User Berhasil dikunci.',
                    'success'
                )
            }
        })
    }
    function deleteData(){
        Swal.fire({
            title: 'Hapus Data?',
            text: 'Apakah anda yakin?',
            icon: 'warning',
            showCancelButton: true,
            reverseButtons:true,
            confirmButtonText: 'Ya, Hapus Data!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Sukses!',
                    'Data Berhasil dihapus.',
                    'success'
                )
            }
        })
    }

    function change_role() {
        var role = $('#role option:selected').val();
        if (role == 3)
            $('.sales').show();
        else
            $('.sales').hide();
    }
</script>
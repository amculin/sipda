<div class="page-wrapper" data-menu-active="Komisi Penjualan">
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle mb-2">
                        <ol class="breadcrumb" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active"><a href="index.php">Komisi Penjualan</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title">Komisi Penjualan</h2>
                    
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
                            <option value="">Semua Status</option>
                            <option value="">Mencapai Target</option>
                            <option value="">Tidak Mencapai Target</option>
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
                            <option value="" selected>September</option>
                            <option value="">Oktober</option>
                            <option value="">November</option>
                            <option value="">Desember</option>
                        </select>
                        <select name="" id="" class="form-select" style="width:160px">
                            <option value="">2023</option>
                            <option value="">2022</option>
                            <option value="">2021</option>
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
                                <th>Periode</th>
                                <th>NIP Sales</th>
                                <th>Nama Sales</th>
                                <th>Jabatan</th>
                                <th class="text-end">Komisi Jabatan</th>
                                <th class="text-end">Target Penjualan</th>
                                <th class="text-end">Jumlah Penjualan</th>
                                <th class="text-end">Capaian</th>
                                <th class="text-end">Komisi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td class="text-nowrap text-center gap-2">
                                    <a href="?page=crm-komisi-detail" class="text-dark"><i class="bi bi-card-list" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Detail"></i></a>
                                    <a href="#" class="text-dark"><i class="bi bi-check-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Dibayarkan"></i></a>
                                </td>
                                <td>09/2023</td>
                                <td>SL0001</td>
                                <td>Ibrahim Jaya</td>
                                <td>Senior Sales</td>
                                <td class="text-end">5 %</td>
                                <td class="text-end">200.000.000</td>
                                <td class="text-end">340.000.000</td>
                                <td class="text-end">170 %</td>
                                <td class="text-end fw-bold">6.000.000</td>
                            </tr>
                            <tr style="background: #fdd">
                                <td>2</td>
                                <td class="text-nowrap text-center gap-2">
                                    <a href="?page=crm-komisi-detail" class="text-dark"><i class="bi bi-card-list" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Detail"></i></a>
                                </td>
                                <td>09/2023</td>
                                <td>SL0002</td>
                                <td>Aji Kurniawan</td>
                                <td>Junior Sales</td>
                                <td class="text-end">0 %</td>
                                <td class="text-end">100.000.000</td>
                                <td class="text-end">40.000.000</td>
                                <td class="text-end">40 %</td>
                                <td class="text-end fw-bold">0</td>
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
                    <label for="" class="form-label">Role</label>
                    <select name="" id="role" class="form-select" onchange="change_role()">
                        <option value="1">Admin</option>
                        <option value="2">Sales Manager</option>
                        <option value="3">Sales</option>
                        <option value="4">Eksekutif</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Username</label>
                    <input type="text" class="form-control">
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Password</label>
                    <input type="password" class="form-control">
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Nama</label>
                    <input type="text" class="form-control">
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Email</label>
                    <input type="email" class="form-control">
                </div>
                <div class="mb-2 sales" style="display: none;">
                    <label for="" class="form-label">Jabatan</label>
                    <input type="text" class="form-control" style="width: 400px">
                </div>
                <div class="mb-2 sales" style="display: none;">
                    <label for="" class="form-label">Prosentase Komisi (%)</label>
                    <input type="text" class="form-control" style="width: 200px" value="0">
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
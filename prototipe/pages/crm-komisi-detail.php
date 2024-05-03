<div class="page-wrapper" data-menu-active="Komisi Penjualan">
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle mb-2">
                        <ol class="breadcrumb" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="index.php">Komisi Penjualan</a></li>
                            <li class="breadcrumb-item active"><a href="index.php">Detail</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title">Detail Komisi Penjualan</h2>
                    
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
                                <td class="text-end">SL0001</td>
                            </tr>
                            <tr>
                                <td>Nama Sales</td>
                                <td class="text-end">Ibrahim Jaya</td>
                            </tr>
                            <tr>
                                <td>Jabatan</td>
                                <td class="text-end">Senior Sales</td>
                            </tr>
                            <tr>
                                <td>Prosentase Komisi</td>
                                <td class="text-end">5 %</td>
                            </tr>
                            <tr>
                                <td>Komisi Jabatan</td>
                                <td class="text-end">5 %</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-auto d-none d-lg-block p-0" style="border-right: 1px dashed #ddd;"></div>
                    <div class="col-lg">
                        <div class="card-header py-3 border-0 px-2 fw-bold">INFORMASI PENJUALAN</div>
                        <table class="table m-0 table-borderless table-striped">
                            <tr>
                                <td>Periode</td>
                                <td class="text-end">September 2023</td>
                            </tr>
                            <tr>
                                <td>Target Penjualan</td>
                                <td class="text-end">200.000.000</td>
                            </tr>
                            <tr>
                                <td>Jumlah Penjualan</td>
                                <td class="text-end">340.000.000</td>
                            </tr>
                            <tr>
                                <td>Capaian</td>
                                <td class="text-end">170 %</td>
                            </tr>
                            <tr>
                                <td>Jumlah Komisi</td>
                                <td class="text-end fw-bold">6.000.000</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card mt-2">
                <div class="card-header">
                    
                </div>
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
                            <tr>
                                <td>1</td>
                                <td>20/09/2023</td>
                                <td>SO49/2307/0001045</td>
                                <td>WP0001</td>
                                <td>e-Planning</td>
                                <td class="text-end">180.000.000</td>
                                <td class="text-end">200.000.000</td>
                                <td class="text-end">1</td>
                                <td class="text-end">200.000.000</td>
                                <td class="text-end">20.000.000</td>
                                <td class="text-end fw-bold">2.000.000</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>16/09/2023</td>
                                <td>SO49/2307/0001045</td>
                                <td>WP0001</td>
                                <td>e-Planning</td>
                                <td class="text-end">200.000.000</td>
                                <td class="text-end">240.000.000</td>
                                <td class="text-end">1</td>
                                <td class="text-end">240.000.000</td>
                                <td class="text-end">40.000.000</td>
                                <td class="text-end fw-bold">4.000.000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-center">
                    
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
<div class="page-wrapper" data-menu-active="Referensi" data-submenu-active="Tahapan">
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle mb-2">
                        <ol class="breadcrumb" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="#">Referensi</a></li>
                            <li class="breadcrumb-item active"><a href="#">Tahapan</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title">Tahapan</h2>
                    
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
                    <div class="ms-auto">
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
                                <th>Tahapan</th>
                                <th width="100">Urutan</th>
                                <th width="100">Warna</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td class="text-nowrap d-flex gap-2">
                                    <a href="#" class="text-dark" data-bs-toggle="modal" data-bs-target="#modal-form"><i class="bi bi-pencil" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"></i></a>
                                    <a href="#" class="text-danger" onclick="deleteData();"><i class="bi bi-trash" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus"></i></a>
                                </td>
                                <td>COLD</td>
                                <td>1</td>
                                <td>
                                    <div style="width: 60px;background: #e9f0f9; padding: 10px;"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td class="text-nowrap d-flex gap-2">
                                    <a href="#" class="text-dark" data-bs-toggle="modal" data-bs-target="#modal-form"><i class="bi bi-pencil" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"></i></a>
                                    <a href="#" class="text-danger" onclick="deleteData();"><i class="bi bi-trash" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus"></i></a>
                                </td>
                                <td>WARM</td>
                                <td>2</td>
                                <td>
                                    <div style="width: 60px;background: #fef0e6; padding: 10px;"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td class="text-nowrap d-flex gap-2">
                                    <a href="#" class="text-dark" data-bs-toggle="modal" data-bs-target="#modal-form"><i class="bi bi-pencil" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"></i></a>
                                    <a href="#" class="text-danger" onclick="deleteData();"><i class="bi bi-trash" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus"></i></a>
                                </td>
                                <td>HOT</td>
                                <td>3</td>
                                <td>
                                    <div style="width: 60px;background: #fbebeb; padding: 10px;"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td class="text-nowrap d-flex gap-2">
                                    <a href="#" class="text-dark" data-bs-toggle="modal" data-bs-target="#modal-form"><i class="bi bi-pencil" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"></i></a>
                                </td>
                                <td>DEAL</td>
                                <td>4</td>
                                <td>
                                    <div style="width: 60px;background: #eaf7ec; padding: 10px;"></div>
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td class="text-nowrap d-flex gap-2">
                                    <a href="#" class="text-dark" data-bs-toggle="modal" data-bs-target="#modal-form"><i class="bi bi-pencil" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"></i></a>
                                </td>
                                <td>FAIL</td>
                                <td>5</td>
                                <td>
                                    <div style="width: 60px;background: #f1f5f9; padding: 10px;"></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
                <h5 class="modal-title">Form Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-2">
                    <label for="" class="form-label">Nama Tahapan</label>
                    <input type="text" class="form-control">
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Nomor Urut</label>
                    <input type="text" class="form-control" style="width:200px">
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Warna</label>
                    <input type="text" class="form-control" style="width:200px">
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
</script>
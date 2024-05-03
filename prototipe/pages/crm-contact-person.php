<div class="page-wrapper" data-menu-active="Klien">
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle mb-2">
                        <ol class="breadcrumb" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="index.php">Klien</a></li>
                            <li class="breadcrumb-item active"><a href="index.php">Contact Person</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title">Contact Person</h2>
                    
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
                        <div class="card-header py-3 border-0 px-2 fw-bold">INFORMASI KLIEN</div>
                        <table class="table m-0 table-borderless table-striped">
                            <tr>
                                <td>Nama Klien</td>
                                <td class="text-end">Ibrahim Jaya</td>
                            </tr>
                            <tr>
                                <td>Nama Perusahaan</td>
                                <td class="text-end">RS. Duren Lima</td>
                            </tr>
                            <tr>
                                <td>Nomor Telefon</td>
                                <td class="text-end">021-680990</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td class="text-end">duren_lima@gmail.com</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-form">
                        <i class="bi bi-plus"></i>
                        Tambah Data
                    </a>
                </div>
                <div class="table-responsive card-body p-0">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="5">No</th>
                                <th width="10" class="text-center">Action</th>
                                <th>Nama</th>
                                <th>Posisi</th>
                                <th>Nomor HP</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td class="text-nowrap d-flex gap-2">
                                    <a href="#" class="text-dark" data-bs-toggle="modal" data-bs-target="#modal-form"><i class="bi bi-pencil" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"></i></a>
                                    <a href="#" class="text-success" onclick="disableData();"><i class="bi bi-check-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Aktif"></i></a>
                                    <a href="#" class="text-danger" onclick="deleteData();"><i class="bi bi-trash" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus"></i></a>
                                </td>
                                <td>Aji Kurniawan</td>
                                <td>Marketing</td>
                                <td>0809809893809</td>
                                <td>aji@gmail.com</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td class="text-nowrap d-flex gap-2">
                                    <a href="#" class="text-dark" data-bs-toggle="modal" data-bs-target="#modal-form"><i class="bi bi-pencil" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"></i></a>
                                    <a href="#" class="text-success" onclick="disableData();"><i class="bi bi-check-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Aktif"></i></a>
                                    <a href="#" class="text-danger" onclick="deleteData();"><i class="bi bi-trash" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus"></i></a>
                                </td>
                                <td>Novia Sari</td>
                                <td>Finance</td>
                                <td>085465363570</td>
                                <td>novia@gmail.com</td>
                            </tr>
                            <tr style="background: #eee">
                                <td>3</td>
                                <td class="text-nowrap d-flex gap-2">
                                    <a href="#" class="text-dark" data-bs-toggle="modal" data-bs-target="#modal-form"><i class="bi bi-pencil" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"></i></a>
                                    <a href="#" class="text-danger" onclick="enableData();"><i class="bi bi-slash-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Non Aktif"></i></a>
                                    <a href="#" class="text-danger" onclick="deleteData();"><i class="bi bi-trash" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus"></i></a>
                                </td>
                                <td>Heru Budianto</td>
                                <td>Operasional</td>
                                <td>085465564675</td>
                                <td>heru@gmail.com</td>
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
                <h5 class="modal-title">Form Contact Person</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-2">
                    <label for="" class="form-label">Nama</label>
                    <input type="text" class="form-control">
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Posisi</label>
                    <input type="text" class="form-control">
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Nomor HP</label>
                    <input type="text" class="form-control">
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Email</label>
                    <input type="email" class="form-control">
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
    
    <?php if(isset($_GET['status']) && $_GET['status'] == 'success'):?>
        Swal.fire(
            'Sukses!',
            'Data Berhasil disimpan.',
            'success'
        ).then(()=>{
            location.href='?page=<?=$_GET["page"];?>';
        });
    <?php endif;?>

    function disableData(){
        Swal.fire({
            title: 'Non aktifkan klien?',
            text:'Apakah anda yakin?',
            icon: 'warning',
            showCancelButton: true,
            reverseButtons:true,
            confirmButtonText: 'Ya, disable klien!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Sukses!',
                    'Klien Berhasil dinonaktifkan.',
                    'success'
                )
            }
        })
    }

    function enableData(){
        Swal.fire({
            title: 'Aktifkan klien?',
            text:'Apakah anda yakin?',
            icon: 'warning',
            showCancelButton: true,
            reverseButtons:true,
            confirmButtonText: 'Ya, enable klien!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Sukses!',
                    'Klien Berhasil diaktifkan.',
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
</script>
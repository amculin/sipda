<div class="page-wrapper" data-menu-active="Busdev" data-submenu-active="Kontrak">
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle mb-2">
                        <ol class="breadcrumb" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="index.php">Busdev</a></li>
                            <li class="breadcrumb-item"><a href="index.php">Kontrak</a></li>
                            <li class="breadcrumb-item active"><a href="index.php">Amandemen</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title">Amandemen</h2>
                    
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
                                <td>Kode Klien</td>
                                <td class="text-end">PK-RDL-00001</td>
                            </tr>
                            <tr>
                                <td>Nama Klien</td>
                                <td class="text-end">Ibrahim Jaya</td>
                            </tr>
                            <tr>
                                <td>Nama Perusahaan</td>
                                <td class="text-end">RS. Duren Lima</td>
                            </tr>
                            <tr>
                                <td>Contact Person</td>
                                <td class="text-end">Aji Kurniawan</td>
                            </tr>
                            <tr>
                                <td>Posisi</td>
                                <td class="text-end">Marketing</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-lg-auto d-none d-lg-block p-0" style="border-right: 1px dashed #ddd;"></div>
                    <div class="col-lg">
                        <div class="card-header py-3 border-0 px-2 fw-bold">INFORMASI PROYEK</div>
                        <table class="table m-0 table-borderless table-striped">
                            <tr>
                                <td>Kode Proyek</td>
                                <td class="text-end">PK-RDL-2023-00001</td>
                            </tr>
                            <tr>
                                <td>Nama Proyek</td>
                                <td class="text-end">Pembangunan Halte</td>
                            </tr>
                            <tr>
                                <td>Kategori Pekerjaan</td>
                                <td class="text-end">Kontruksi Gedung</td>
                            </tr>
                            <tr>
                                <td>Lokasi Pekerjaan</td>
                                <td class="text-end">Jakarta</td>
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
                    <div class="ms-auto d-flex gap-2">
                        
                    </div>
                </div>
                <div class="table-responsive card-body p-0">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="5">No</th>
                                <th width="10" class="text-center">Action</th>
                                <th>Tanggal</th>
                                <th>Judul Amandemen</th>
                                <th>Nomor SPK</th>
                                <th>Download Dokumen</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td class="text-nowrap d-flex gap-2">
                                    <a href="#" class="text-dark" data-bs-toggle="modal" data-bs-target="#modal-form"><i class="bi bi-pencil" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"></i></a>
                                    <a href="#" class="text-danger" onclick="deleteData();"><i class="bi bi-trash" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus"></i></a>
                                </td>
                                <td>1 Juli 2023</td>
                                <td>Amandemen 1</td>
                                <td>MRT/GC/PKU/001</td>
                                <td>
                                    <a href="#" class="btn btn-outline-info btn-sm rounded-pill px-3"><i class="bi bi-download me-2"></i> Adendum</a>
                                    <a href="#" class="btn btn-outline-info btn-sm rounded-pill px-3"><i class="bi bi-download me-2"></i> PO</a>
                                    <a href="#" class="btn btn-outline-info btn-sm rounded-pill px-3"><i class="bi bi-download me-2"></i> SPK</a>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td class="text-nowrap d-flex gap-2">
                                    <a href="#" class="text-dark" data-bs-toggle="modal" data-bs-target="#modal-form"><i class="bi bi-pencil" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"></i></a>
                                    <a href="#" class="text-danger" onclick="deleteData();"><i class="bi bi-trash" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus"></i></a>
                                </td>
                                <td>1 September 2023</td>
                                <td>Amandemen 2</td>
                                <td>MRT/GC/PKU/002</td>
                                <td>
                                    <a href="#" class="btn btn-outline-info btn-sm rounded-pill px-3"><i class="bi bi-download me-2"></i> Adendum</a>
                                    <a href="#" class="btn btn-outline-info btn-sm rounded-pill px-3"><i class="bi bi-download me-2"></i> PO</a>
                                </td>
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
                <h5 class="modal-title">Form Amandemen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-2">
                    <label for="" class="form-label">Judul Amandemen</label>
                    <input type="text" class="form-control">
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Tanggal</label>
                    <input type="text" class="form-control">
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Nomor SPK</label>
                    <input type="text" class="form-control">
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Upload Adendum</label>
                    <input type="file" class="form-control">
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Upload SPK</label>
                    <input type="file" class="form-control">
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Upload PO</label>
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
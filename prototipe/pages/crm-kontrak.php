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
                            <li class="breadcrumb-item active"><a href="index.php">Kontrak</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title">Kontrak</h2>
                    
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
                    <a href="?page=crm-kontrak-form" class="btn btn-primary d-none d-sm-inline-block">
                        <i class="bi bi-plus"></i>
                        Tambah Data
                    </a>
                    <div class="ms-auto d-flex gap-2">
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
                                <th>BOQ</th>
                                <th>Kode Proyek</th>
                                <th>Nama Proyek</th>
                                <th>Nama SPK</th>
                                <th>Tanggal SPK</th>
                                <th>Nilai Kontrak</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td class="text-nowrap d-flex gap-2">
                                    <a href="?page=crm-kontrak-form" class="text-dark"><i class="bi bi-pencil" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"></i></a>
                                    <a href="?page=crm-kontrak-amandemen" class="text-dark"><i class="bi bi-journal" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Amandemen"></i></a>
                                    <a href="#" class="text-danger" onclick="deleteData();"><i class="bi bi-trash" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus"></i></a>
                                </td>
                                <td>
                                    <a href="?page=crm-boq" class="btn btn-outline-info btn-sm rounded-pill px-3"><i class="bi bi-diagram-3 me-2"></i> BOQ</a>
                                </td>
                                <td>PK-RDL-00001</td>
                                <td>Pembangunan Halte</td>
                                <td>MRT/GC/PKU/001</td>
                                <td>1 September 2023</td>
                                <td>85.000.000</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td class="text-nowrap d-flex gap-2">
                                    <a href="?page=crm-kontrak-form" class="text-dark"><i class="bi bi-pencil" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"></i></a>
                                    <a href="?page=crm-kontrak-amandemen" class="text-dark"><i class="bi bi-journal" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Amandemen"></i></a>
                                    <a href="#" class="text-danger" onclick="deleteData();"><i class="bi bi-trash" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus"></i></a>
                                </td>
                                <td>
                                    <a href="?page=crm-boq" class="btn btn-outline-info btn-sm rounded-pill px-3"><i class="bi bi-diagram-3 me-2"></i> BOQ</a>
                                </td>
                                <td>PK-NLR-00002</td>
                                <td>Pembangunan Wisma</td>
                                <td>MRT/GC/PKU/002</td>
                                <td>2 September 2023</td>
                                <td>345.000.000</td>
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
<div class="page-wrapper" data-menu-active="Klien">
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle mb-2">
                        <ol class="breadcrumb" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active"><a href="index.php">Klien</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title">Klien</h2>
                    
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
                    <a href="?page=crm-contact-form" class="btn btn-primary d-none d-sm-inline-block">
                        <i class="bi bi-plus"></i>
                        Tambah Data
                    </a>
                    <div class="ms-auto d-flex gap-2">
                        <select name="" id="" class="form-select" style="width:160px">
                            <option value="">Semua Status</option>
                            <option value="">Aktif</option>
                            <option value="">Non Aktif</option>
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
                                <th>Nama Klien</th>
                                <th>Nama Perusahaan</th>
                                <th>No. Telefon</th>
                                <th>Email</th>
                                <th>Alamat Perusahaan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td class="text-nowrap d-flex gap-2">
                                    <a href="?page=crm-contact-form" class="text-dark"><i class="bi bi-pencil" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"></i></a>
                                    <a href="?page=crm-contact-person" class="text-dark"><i class="bi bi-people" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Contact Person"></i></a>
                                    <a href="#" class="text-success" onclick="disableData();"><i class="bi bi-check-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Aktif"></i></a>
                                    <a href="#" class="text-danger" onclick="deleteData();"><i class="bi bi-trash" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus"></i></a>
                                </td>
                                <td>Ibrahim Jaya</td>
                                <td>RS. Duren Lima</td>
                                <td>021-680990</td>
                                <td>duren_lima@gmail.com</td>
                                <td>Jl. Duren Sawit Baru No.2, Kec. Duren Sawit, Kota Jakarta Timur, DKI Jakarta</td>
                            </tr>
                            <tr style="background: #eee">
                                <td>2</td>
                                <td class="text-nowrap d-flex gap-2">
                                    <a href="?page=crm-contact-form" class="text-dark"><i class="bi bi-pencil" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"></i></a>
                                    <a href="?page=crm-contact-person" class="text-dark"><i class="bi bi-people" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Contact Person"></i></a>
                                    <a href="#" class="text-danger" onclick="enableData();"><i class="bi bi-slash-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Non Aktif"></i></a>
                                    <a href="#" class="text-danger" onclick="deleteData();"><i class="bi bi-trash" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus"></i></a>
                                </td>
                                <td>Anton Sutopo</td>
                                <td>PT. Nusa Karya Rajawali</td>
                                <td>021-770880</td>
                                <td>nkri@gmail.com</td>
                                <td>Jl. Bidan, Pisangan, Kec. Ciputat Timur, Kota Tangerang Selatan, Banten</td>
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
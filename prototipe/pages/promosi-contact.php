<div class="page-wrapper" data-menu-active="Broadcast" data-submenu-active="Channel">
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle mb-2">
                        <ol class="breadcrumb" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="index.php">Broadcast</a></li>
                            <li class="breadcrumb-item"><a href="index.php">Channel</a></li>
                            <li class="breadcrumb-item active"><a href="index.php">Contact</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title">Contact</h2>
                    
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
                    <a href="javascript:history.back(-1);" class="btn btn px-4 me-2"><i class="bi bi-arrow-left me-2"></i>Kembali</a>
                    <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#modal-form">
                        <i class="bi bi-plus"></i>
                        Tambah Data
                    </a>
                    <div class="ms-auto d-flex gap-2">
                        <div class="input-group">
                            <label class="form-control" style="width: 100px">Channel</label>
                            <label class="form-control" style="width: 160px">Badan Perencanaan</label>
                        </div>
                    </div>
                </div>
                <div class="table-responsive card-body p-0">
                    <table class="table">
                        <thead>
                            <tr>
                                <th width="5">No</th>
                                <th width="10" class="text-center">Action</th>
                                <th>Nama Perusahaan</th>
                                <th>Nama Contact</th>
                                <th>Jabatan</th>
                                <th>Nomor HP</th>
                                <th>Email</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td class="text-nowrap d-flex gap-2">
                                    <a href="#" class="text-dark" data-bs-toggle="modal" data-bs-target="#modal-form"><i class="bi bi-pencil" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"></i></a>
                                    <a href="#" class="text-danger" onclick="deleteData();"><i class="bi bi-trash" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus"></i></a>
                                </td>
                                <td>Bappeda DIY</td>
                                <td>Agustinus</td>
                                <td>Kasubid Perencanaan</td>
                                <td>0809898883870</td>
                                <td>agus@bappeda.com</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td class="text-nowrap d-flex gap-2">
                                    <a href="#" class="text-dark" data-bs-toggle="modal" data-bs-target="#modal-form"><i class="bi bi-pencil" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit"></i></a>
                                    <a href="#" class="text-danger" onclick="deleteData();"><i class="bi bi-trash" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus"></i></a>
                                </td>
                                <td>Bappeda Sleman</td>
                                <td>Heriyanto</td>
                                <td>Kasubid Perencanaan</td>
                                <td>0803909489900</td>
                                <td>heriyanto@bappeda.com</td>
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
                    <label for="" class="form-label">Nama Contact</label>
                    <select class="form-control">
                        <option>Pilih Contact</option>
                        <option>Agustinus - Kasubid - Bappeda DIY</option>
                        <option>Heriyanto - Kasubid - Bappeda Sleman</option>
                        <option>Aji Kurniawan - Kadiv.IT - LP3P Bekasi</option>
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

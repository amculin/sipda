<div class="page-wrapper" data-menu-active="Proyek" data-submenu-active="Daftar Proyek">
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle mb-2">
                        <ol class="breadcrumb" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="index.php">Proyek</a></li>
                            <li class="breadcrumb-item active"><a href="index.php">Daftar Proyek</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title">Daftar Proyek</h2>
                    
                </div>
                <div class="col-auto ms-auto">
                    
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <form action="" method="get">
                <input type="hidden" name="page" value="crm-kontrak">
                <input type="hidden" name="status" value="success">
                <div class="row g-3">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header bg-light text-dark">
                                <div class="fw-bold">INFORMASI KONTRAK</div>
                            </div>
                            <div class="card-body">
                                <div class="mb-2">
                                    <label for="" class="form-label">Proyek ID</label>
                                    <select name="" id="" class="form-select select2">
                                        <option>PK-RDL-2023-00001 - Pembangunan Halte</option>
                                        <option>PK-RDL-2023-00002 - Pembangunan Gedung Wisma</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label for="" class="form-label">Masa Proyek</label>
                                    <div class="row g-2">
                                        <div class="col">
                                            <div class="input-icon">
                                                <input type="text" class="form-control" id="litepicker-kontrak-mulai" placeholder="Pilih Tanggal">
                                                <span class="input-icon-addon">
                                                    <i class="bi bi-calendar3"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-icon">
                                                <input type="text" class="form-control" id="litepicker-kontrak-berakhir" placeholder="Pilih Tanggal">
                                                <span class="input-icon-addon">
                                                    <i class="bi bi-calendar3"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label for="" class="form-label">Masa Retensi</label>
                                    <div class="input-group input-group-flat">
                                        <input type="text" class="form-control">
                                        <div class="input-group-text">Hari</div>
                                    </div>
                                </div>
                                <div class="mb-2">
                                    <label for="" class="form-label">Skala Waktu</label>
                                    <select name="" id="" class="form-select select2">
                                        <option>Harian</option>
                                        <option>Mingguan</option>
                                        <option>Bulanan</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label for="" class="form-label">Hari Kerja Sabtu</label>
                                    <select name="" id="" class="form-select select2">
                                        <option>Jam Kerja Normal</option>
                                        <option>Setengah Hari</option>
                                        <option>Libur</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3 d-flex gap-2 justify-content-between">
                            <a href="javascript:history.back(-1);" class="btn btn px-4"><i class="bi bi-arrow-left me-2"></i>Kembali</a>
                            <button class="btn btn-primary px-4" type="submit">Simpan</button>
                        </div>
                    </div>
                </div>

            </form>
            
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script type="text/javascript">
    $(function(){
        $('.select2').select2({
            theme: 'bootstrap-5'
        });
    })
</script>

<script src="https://cdn.jsdelivr.net/npm/litepicker/dist/bundle.js"></script>
<script type="text/javascript">
    const litepickerMulai = new Litepicker({ 
        element: document.querySelector('#litepicker-kontrak-mulai')
    });
    const litepickerBerakhir = new Litepicker({ 
        element: document.querySelector('#litepicker-kontrak-berakhir')
    });
</script>
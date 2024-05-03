<div class="page-wrapper" data-menu-active="Konfigurasi">
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle mb-2">
                        <ol class="breadcrumb" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active"><a href="index.php">Konfigurasi</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title">Konfigurasi</h2>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <form action="" method="get">
                <div class="row g-3">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header bg-light text-dark">
                                <div class="fw-bold">SMTP Setting</div>
                            </div>
                            <div class="card-body">
                                <div class="mb-2">
                                    <label for="" class="form-label">Host SMTP</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label for="" class="form-label">Port SMTP</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label for="" class="form-label">User SMTP</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label for="" class="form-label">Password SMTP</label>
                                    <input type="password" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label for="" class="form-label">Email</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="mb-2">
                                    <label for="" class="form-label">Nama</label>
                                    <input type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header bg-light text-dark">
                                <div class="fw-bold">Komisi Sales</div>
                            </div>
                            <div class="card-body">
                                <div class="mb-2">
                                    <label for="" class="form-label">Komisi hanya Untuk yang mencapai target</label>
                                    <select class="form-select" style="width:100px">
                                        <option>Ya</option>
                                        <option>Tidak</option>
                                    </select>
                                </div>
                                <div class="mb-2">
                                    <label for="" class="form-label">Prosentase Komisi dari Profit Penjualan (%)
                                    </label>
                                    <input type="text" class="form-control text-end col-2" style="width:80px" value="5">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3 d-flex gap-2">
                    <button class="btn btn-primary px-4" type="submit">Simpan</button>
                </div>

            </form>
            
        </div>
    </div>
</div>
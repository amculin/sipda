<style type="text/css">
    .input-so{
        border: none;
        border-bottom: 2px solid #aaa;
    }
</style>

<div class="page-wrapper" data-menu-active="Prospek" data-submenu-active="Quotation">
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle mb-2">
                        <ol class="breadcrumb" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="index.php">Prospek</a></li>
                            <li class="breadcrumb-item"><a href="index.php">Quotation</a></li>
                            <li class="breadcrumb-item active"><a href="index.php">Form Quotation</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title">Form Quotation</h2>
                    
                </div>
                <div class="col-auto ms-auto">
                    
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <form action="" method="get">
                <input type="hidden" name="page" value="crm-contact">
                <input type="hidden" name="status" value="success">
                <div class="row justify-content-end">
                    <div class="col-lg-8">
                        <div class="mb-2">
                            <label for="" class="form-label">Pilih Lead</label>
                            <select name="" id="" class="form-select" style="width:350px">
                                <option>Pilih Leads</option>
                                <option>Agustinus - Kasubid - Bappeda DIY</option>
                                <option>Heriyanto - Kasubid - Bappeda Sleman</option>
                                <option>Aji Kurniawan - Kadiv.IT - LP3P Bekasi</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 text-end">
                        <table class="table table-borderless table-sm">
                            <tr>
                                <td>Nomor Quotation</td>
                                <td class="text-end">SP2023090018</td>
                            </tr>
                            <tr>
                                <td>Tanggal Quotation</td>
                                <td class="text-end">20/10/2023</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row mt-2 g-3">
                    <h3 class="m-0">Quotation Untuk</h3>
                    <hr class="my-2" />
                    <table class="table table-borderless">
                        <tr>
                            <td style="width: 140px;">Nama Klien</td>
                            <td>
                                <input type="text" class="input-so" style="width:300px">
                            </td>
                        </tr>
                        <tr>
                            <td>Nama Perusahaan</td>
                            <td>
                                <input type="text" class="input-so" style="width:400px">
                            </td>
                        </tr>
                        <tr>
                            <td>Nomor Telfon</td>
                            <td>
                                <input type="text" class="input-so" style="width:160px">
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>
                                <input type="text" class="input-so" style="width:240px">
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="row mt-2 g-3">
                    <hr class="my-2" />
                    <table class="table table-borderless">
                        <tr>
                            <td>Isi Quotation</td>
                            <td>
                                <textarea class="input-so" cols="80" rows="5"></textarea>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="mt-3">
                    <button class="btn btn-secondary" type="button" data-bs-toggle="modal" data-bs-target="#modal-produk">Tambah Produk</button>
                </div>
                <div class="mt-3 table-responsive">
                    <table class="table table-bordered" id="table-produk">
                        <thead class="table-dark">
                            <tr>
                                <th class="bg-dark" width="5"></th>
                                <th class="bg-dark">Produk</th>
                                <th class="bg-dark">Kuantitas</th>
                                <th class="bg-dark text-end">Harga</th>
                                <th class="bg-dark text-end">Diskon</th>
                                <th class="bg-dark text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-nowrap">
                                    <div class="hstack gap-3">
                                        <a href="#" class="btn-edit"><i class="bi bi-pencil text-dark"></i></a>
                                        <a href="#" class="btn-delete"><i class="bi bi-trash text-danger"></i></a>
                                    </div>
                                </td>
                                <td>
                                    <div class="fw-bold">WP-0003 - Aplikasi Aset</div>
                                    <div class="text-secondary">Aplikasi Web</div>
                                    <div class="text-secondary" style="font-size:10px; color: #844 !important;">
                                        (Harga Jual : 160.000.000)
                                    </div>
                                </td>
                                <td class="text-end">1</td>
                                <td class="text-end">170.000.000</td>
                                <td class="text-end">5.000.000</td>
                                <td class="text-end">165.000.000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row mt-4 justify-content-lg-end">
                    <div class="col-lg-4">
                        <table class="table table-sm table-borderless table-summary">
                            <tr>
                                <td><strong>Subtotal</strong></td>
                                <td class="text-end"><span id="summary-subtotal">165.000.000</span></td>
                            </tr>
                            <tr>
                                <td><strong>Pajak</strong></td>
                                <td class="text-end"><span id="summary-subtotal">16.500.000</span></td>
                            </tr>
                            <tr>
                                <td><strong>Diskon</strong></td>
                                <td class="text-end">
                                    <input type="text" class="form-control form-control-sm text-end" value="0,00">
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Jumlah Total</strong></td>
                                <td class="text-end">Rp. <span id="summary-subtotal">181.500.000</span></td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="row mt-2 g-3">
                    <hr class="my-2" />
                    <table class="table table-borderless">
                        <tr>
                            <td>Penutup</td>
                            <td>
                                <textarea class="input-so" cols="80" rows="5"></textarea>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="mt-3 d-flex gap-2">
                    <a href="javascript:history.back(-1);" class="btn btn px-4"><i class="bi bi-arrow-left me-2"></i>Kembali</a>
                    <button class="btn btn-primary px-4" type="submit">Simpan</button>
                </div>
            </form>
            
        </div>
    </div>
</div>

<!-- Modal -->

<div class="modal fade modal-blur" id="modal-produk" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <form action="" id="form-produk" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-2">
                    <label for="" class="form-label">Pilih Produk</label>
                    <select class="form-select">
                        <option>WP0001 - Aplikasi Aset</option>
                        <option>WP0002 - Aplikasi Kepegawaian</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Kuantitas</label>
                    <input name="kuantitas" type="text" class="form-control" style="width:100px">
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Harga</label>
                    <input name="harga" type="text" class="form-control" style="width:200px">
                </div>
                <div class="mb-2">
                    <label for="" class="form-label">Diskon</label>
                    <input type="text" class="form-control"  style="width:200px">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
<style type="text/css">
    body{
        background: #fff;
    }
    /*.form-control{
        background: none!important;
        border:none;
        border-radius: 0;
        border-bottom: 1px dashed #ddd;
        padding-left: 0;
        padding-right: 0;
        outline: none!important;
        box-shadow: none!important;
    }*/
    .table-summary .form-control{
        font-size: 14px;
    }
</style>

<!-- Modal -->
<div class="modal fade modal-blur" id="modal-import" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Import Quotation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-2">
                    <label for="" class="form-label">Pilih Quotation</label>
                    <select name="" id="" class="form-select">
                        <option value="">SP2023090015 - Aplikasi Geoportal - Dinas Tata Ruang Sleman</option>
                        <option value="">SP2023090018 - Aplikasi Aset - PT. Citra Gemilang</option>
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


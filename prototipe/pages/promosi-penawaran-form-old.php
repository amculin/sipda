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
                <div class="row g-3">
                    <div class="col-lg-12">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="mb-2 col-6">
                                    <label for="" class="form-label">Nama Leads</label>
                                    <select name="" id="" class="form-select" style="width:350px">
                                        <option>Pilih Leads</option>
                                        <option>Agustinus - Kasubid - Bappeda DIY</option>
                                        <option>Heriyanto - Kasubid - Bappeda Sleman</option>
                                        <option>Aji Kurniawan - Kadiv.IT - LP3P Bekasi</option>
                                    </select>
                                </div>
                                <div class="mb-2 col-6">
                                    <label for="" class="form-label">Tanggal Surat</label>
                                    <input type="date" class="form-control" style="width:200px">
                                </div>
                                <div class="mb-2 col-12">
                                    <label for="" class="form-label">Isi</label>
                                    <textarea class="form-control" rows="4"></textarea>
                                </div>
                            </div>
                            <div class="card-header bg-light text-dark">
                                <div class="fw-bold">Paket Produk</div>
                            </div>
                            <div class="card-body">
                                <div class="mb-2">
                                    <div class="row">
                                        <div class="col-3">Item</div>
                                        <div class="col-2">HPP</div>
                                        <div class="col-2">Harga Penawaran</div>
                                        <div class="col-1">Jumlah</div>
                                        <div class="col-1">Diskon (%)</div>
                                        <div class="col-2">Total</div>
                                    </div>
                                    <div id="contact-person-tambahan-wrap">
                                        <div class="row">
                                            <div class="col-3">
                                                <select name="" id="" class="form-select">
                                                    <option value="">WP0001 - ePlanning</option>
                                                    <option value="">WP0002 - Geoportal</option>
                                                </select>
                                            </div>
                                            <div class="col-2">
                                                <input type="text" class="form-control text-end" value="150.000.000" disabled> 
                                            </div>
                                            <div class="col-2">
                                                <input type="text" class="form-control text-end" value="160.000.000"> 
                                            </div>
                                            <div class="col-1">
                                                <input type="text" class="form-control text-end" value="1"> 
                                            </div>
                                            <div class="col-1">
                                                <input type="text" class="form-control text-end" value="0"> 
                                            </div>
                                            <div class="col-2">
                                                <input type="text" class="form-control text-end" value="160.000.000" disabled> 
                                            </div>
                                            <div class="col-1">
                                                <button type="button" class="btn btn-icon rounded-circle btn-contact-person-tambahan-clone">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                       <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                       <path d="M12 5l0 14"></path>
                                                       <path d="M5 12l14 0"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="mb-2 col-2">
                                    <label for="" class="form-label">Total Harga</label>
                                    <input type="text" class="form-control text-end" value="160.000.000" disabled>
                                </div>
                                <div class="mb-2 col-1">
                                    <label for="" class="form-label">Diskon (%)</label>
                                    <input type="text" class="form-control text-end" value="0">
                                </div>
                                <div class="mb-2 col-2">
                                    <label for="" class="form-label">Cashback (Rp.)</label>
                                    <input type="text" class="form-control text-end" value="0">
                                </div>
                                <div class="mb-2 col-2">
                                    <label for="" class="form-label">Total Harga Akhir</label>
                                    <input type="text" class="form-control text-end" value="160.000.000" disabled>
                                </div>
                                <div class="mb-2 col-12">
                                    <label for="" class="form-label">Penutup</label>
                                    <textarea class="form-control" rows="4"></textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="mt-3 d-flex gap-2">
                    <a href="javascript:history.back(-1);" class="btn btn px-4"><i class="bi bi-arrow-left me-2"></i>Kembali</a>
                    <button class="btn btn-primary px-4" type="submit">Simpan</button>
                </div>
            </form>
            
        </div>
    </div>
</div>

<script type="text/javascript">
    $('.btn-contact-person-tambahan-clone').on('click',function(){
        let template = `
            <div class="row mt-3">
                <div class="col-3">
                    <select name="" id="" class="form-select">
                        <option value="">WP0001 - ePlanning</option>
                        <option value="">WP0002 - Geoportal</option>
                    </select>
                </div>
                <div class="col-2">
                    <input type="text" class="form-control text-end" value="150.000.000" disabled> 
                </div>
                <div class="col-2">
                    <input type="text" class="form-control text-end" value="160.000.000"> 
                </div>
                <div class="col-1">
                    <input type="text" class="form-control text-end" value="1"> 
                </div>
                <div class="col-1">
                    <input type="text" class="form-control text-end" value="0"> 
                </div>
                <div class="col-2">
                    <input type="text" class="form-control text-end" value="160.000.000" disabled> 
                </div>
                <div class="col-1">
                    <button type="button" class="btn btn-danger btn-icon rounded-circle btn-contact-person-tambahan-remove">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                           <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                           <path d="M18 6l-12 12"></path>
                           <path d="M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        `;

        $('#contact-person-tambahan-wrap').append(template);
    });
    $(document).on('click','.btn-contact-person-tambahan-remove',function(){
        $(this).parent().parent().remove();
    });
</script>
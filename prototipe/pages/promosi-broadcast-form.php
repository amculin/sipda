<div class="page-wrapper" data-menu-active="Broadcast" data-submenu-active="Broadcast">
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle mb-2">
                        <ol class="breadcrumb" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="index.php">Broadcast</a></li>
                            <li class="breadcrumb-item"><a href="index.php">Broadcast Email</a></li>
                            <li class="breadcrumb-item active"><a href="index.php">Form Broadcast</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title">Form Broadcast Email</h2>
                    
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
                                    <label for="" class="form-label">Channel</label>
                                    <select name="" id="" class="form-select">
                                        <option>Pilih Channel Tujuan</option>
                                        <option>Badan Perencanaan</option>
                                        <option>Perusahaan Alat Kesehatan</option>
                                    </select>
                                </div>
                                <div class="mb-2 col-6">
                                    <label for="" class="form-label">Subject</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="mb-2 col-12 standar">
                                    <label for="" class="form-label">Greeting</label>
                                    <textarea name="" cols="30" rows="3" class="form-control">
Kepada Yth. {nama}
di {nama_perusahaan}
                                    </textarea>
                                </div>
                                <div class="mb-2 col-12 standar">
                                    <label for="" class="form-label">Isi Email</label>
                                    <textarea name="" id="isi" cols="30" rows="8" class="form-control"></textarea>
                                </div>
                                <div class="mb-2 col-12 standar">
                                    <label for="" class="form-label">Closing</label>
                                    <textarea name="" cols="30" rows="3" class="form-control">
Kind Regards.
                                    </textarea>
                                </div>
                                <div class="mb-2 col-12 standar">
                                    <label for="" class="form-label">Lampiran</label>
                                    <input type="file" class="form-control" style="width:400px">
                                </div>
                                <div class="mb-2 col-12">
                                    <label for="" class="form-label">Scheduled Send</label>
                                    <input type="date" class="form-control mb-2" style="width:200px">
                                    <input type="time" class="form-control" style="width:200px">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="mt-3 d-flex gap-2">
                    <a href="javascript:history.back(-1);" class="btn px-4"><i class="bi bi-arrow-left me-2"></i>Kembali</a>
                    <a href="#" class="btn px-4"><i class="bi bi-view-list me-2"></i>Preview</a>
                    <button class="btn btn-primary px-4" type="submit">Simpan</button>
                </div>
            </form>
            
        </div>
    </div>
</div>

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="https://cdn.jsdelivr.net/npm/litepicker/dist/bundle.js"></script>

<script type="text/javascript">
    
    var toolbarOptions = [
        ['bold', 'italic', 'underline', 'strike'],
        ['blockquote', 'code-block'],
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
        [{ 'color': [] }, { 'background': [] }],
        [{ 'align': [] }],
        ['image'],
        ['clean']         
    ];

    var isi = new Quill('#isi', {
        theme: 'snow',
        modules: {
            toolbar: toolbarOptions
        }
    });

    const picker = new Litepicker({ 
        element: document.querySelector('.litepicker') 
    });
</script>
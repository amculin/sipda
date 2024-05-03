<div class="page-wrapper" data-menu-active="Busdev" data-submenu-active="Prospek">
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle mb-2">
                        <ol class="breadcrumb" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item"><a href="index.php">Busdev</a></li>
                            <li class="breadcrumb-item"><a href="index.php">Prospek</a></li>
                            <li class="breadcrumb-item active"><a href="index.php">Aktivitas</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title">Form Aktivitas</h2>
                    
                </div>
                <div class="col-auto ms-auto">
                    
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card mt-3">
                <div class="card-header fw-bold bg-light text-dark">Aktivitas</div>
                <div class="card-body">
                    <div class="mb-2">
                        <label for="" class="form-label">Tanggal</label>
                        <div class="input-icon">
                            <input type="text" class="form-control litepicker" placeholder="Pilih Tanggal">
                            <span class="input-icon-addon">
                                <i class="bi bi-calendar3"></i>
                            </span>
                        </div>
                    </div>
                    <div class="mb-2">
                        <label for="" class="form-label">Aktivitas</label>
                        <textarea name="" id="aktivitas" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="mb-2">
                        <label for="" class="form-label">Lokasi</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label for="" class="form-label">Progres</label>
                        <textarea name="" id="progress" cols="30" rows="5" class="form-control"></textarea>
                    </div>
                    <div class="mb-2">
                        <label for="" class="form-label">File</label>
                        <input type="file" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label for="" class="form-label">Status</label>
                        <select name="" id="" class="form-select">
                            <option value="">Proses</option>
                            <option value="">Selesai</option>
                        </select>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="?page=crm-activity-detail" type="button" class="btn btn-default">&laquo; Kembali</a>
                    <button type="button" class="btn btn-primary">Submit</button>
                </div>
            </div>
            
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

    var aktivitas = new Quill('#aktivitas', {
        theme: 'snow',
        modules: {
            toolbar: toolbarOptions
        }
    });
    var progress = new Quill('#progress', {
        theme: 'snow',
        modules: {
            toolbar: toolbarOptions
        }
    });

    const picker = new Litepicker({ 
        element: document.querySelector('.litepicker') 
    });
</script>
<?php 
    $role = $_SESSION['role'];
?>
<aside class="navbar navbar-vertical navbar-expand-lg navbar-dark sidebar">
    <div class="container-fluid px-0 justify-content-start">
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <h1 class="navbar-brand text-white ms-3 ms-lg-0 gap-3">
            <div class="logo">
                <img src="static/logo_jmc.png" alt="" height="15">
            </div>
            <a href="#" class="fw-bold hstack gap-3 text-decoration-none">
                <div style="font-size: .9rem;"><?=$appName;?></div>
            </a>
        </h1>
        <div class="text-center p-2 mb-1 bg-primary text-white">
            Unit : JK01 (Jakarta)
        </div>
        <div class="offcanvas offcanvas-start px-lg-3 bg-dark" id="sidebar-menu">
            <div class="offcanvas-header">
                <div class="d-flex gap-3 align-items-center">
                    <div class="image">
                        <img src="static/logo-persada.webp" alt="" height="15">
                    </div>
                    <div class="logo-text flex-grow-1">
                        <h3 class="m-0"></h3>   
                        <div class="fs-4">Aplikasi Pemasaran</div>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>  
            <div class="offcanvas-body p-3 p-lg-0 flex-column flex-grow-1 overflow-auto">
                <ul class="navbar-nav align-items-start mt-lg-3">
                    <li class="nav-item">
                        <a class="nav-link" href="?page=home">
                            <i class="bi bi-house fs-3 me-3"></i> Beranda
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="?page=crm-plan" class="nav-link"><i class="bi bi-calendar2 fs-3 me-3"></i> Planning</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-database fs-3 me-3"></i> Prospek
                        </a>
                        <div class="dropdown-menu">
                            <a href="?page=crm-activity" class="dropdown-item">Leads</a>
                            <a href="?page=promosi-penawaran" class="dropdown-item">Quotation</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="?page=promosi-event" class="nav-link"><i class="bi bi-lightbulb fs-3 me-3"></i> Program</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-megaphone fs-3 me-3"></i> Broadcast
                        </a>
                        <div class="dropdown-menu">
                            <a href="?page=promosi-channel" class="dropdown-item">Channel</a>
                            <a href="?page=promosi-broadcast" class="dropdown-item">Broadcast</a>
                            <a href="?page=promosi-log" class="dropdown-item">Log Email</a>
                            <a href="?page=promosi-konfigurasi" class="dropdown-item">Konfigurasi</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="?page=crm-contact" class="nav-link"><i class="bi bi-people fs-3 me-3"></i> Klien</a>
                    </li>
                    <li class="nav-item">
                        <a href="?page=crm-sales-order" class="nav-link"><i class="bi bi-receipt fs-3 me-3"></i> Sales Order</a>
                    </li>
                    <li class="nav-item">
                        <a href="?page=crm-komisi" class="nav-link"><i class="bi bi-cash-stack fs-3 me-3"></i> Komisi Penjualan</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                            <i class="bi bi-book fs-3 me-3"></i> Referensi
                        </a>
                        <div class="dropdown-menu">
                            <a href="?page=referensi-kategori" class="dropdown-item">Kategori</a>
                            <a href="?page=referensi-produk" class="dropdown-item">Produk</a>
                            <a href="?page=referensi-tahapan" class="dropdown-item">Tahapan</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="?page=manajemen-user" class="nav-link"><i class="bi bi-people fs-3 me-3"></i> Manajemen User</a>
                    </li>
                    <li class="nav-item">
                        <a href="?page=konfigurasi" class="nav-link"><i class="bi bi-gear fs-3 me-3"></i> Konfigurasi</a>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</aside>
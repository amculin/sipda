<?php
    $role = $_SESSION['role'];

    if(isset($role) && $role == 'admin'){
        $user = 'Ad';
        $userName = 'Admin';
        $userRole = 'Administrator';
    }
    
?>

<header class="navbar navbar-expand-md d-none d-lg-flex d-print-none sticky-top" id="navbar">
    <div class="container-xl justify-content">
        <button class="sidebar-toggler" type="button">
            <span class="sidebar-icon"></span>
        </button>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-nav flex-row order-md-last ms-md-auto">
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0 me-3" data-bs-toggle="dropdown">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M10 5a2 2 0 1 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6"></path><path d="M9 17v1a3 3 0 0 0 6 0v-1"></path></svg>
                    <span class="badge bg-red"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <div class="dropdown-item">Belum ada notifikasi </div>
                </div>
            </div>
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0 dropdown-toggle" data-bs-toggle="dropdown">
                    <span class="bg-primary text-white avatar rounded-circle">
                      <?=$user;?>
                    </span>
                    <div class="d-none d-xl-block ps-2">
                        <div class="fw-bold"><?=$userName;?></div>
                        <div class="mt-1 small text-primary"><?=$userRole;?></div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="?page=profile" class="dropdown-item"><i class="bi bi-person me-2"></i> My Profile</a>
                    <a href="#" class="dropdown-item"><i class="bi bi-key me-2"></i> Change Password</a>
                    <div class="dropdown-divider"></div>
                    <a href="logout.php" class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i> Logout</a>
                </div>
            </div>
        </div>
    </div>
</header>
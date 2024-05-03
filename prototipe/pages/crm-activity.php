<div class="page-wrapper" data-menu-active="Prospek" data-submenu-active="Leads">
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle mb-2">
                        <ol class="breadcrumb" aria-label="breadcrumbs">
                            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                            <li class="breadcrumb-item active"><a href="index.php">Leads</a></li>
                        </ol>
                    </div>
                    <h2 class="page-title">Leads</h2>
                    
                </div>
                <div class="col-auto ms-auto">
                    
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <nav class="pt-3 px-3 pb-0 card-header">
                    <ul class="nav nav-tabs border-0 nav-theme">
                        <li class="nav-item"><a href="?page=crm-activity" class="nav-link <?=(!isset($_GET['tab']) ? 'active':'');?>"><i class="bi bi-snow3 fs-3 me-2"></i> COLD</a></li>
                        <li class="nav-item"><a href="?page=crm-activity&tab=crm-activity-tab-warm" class="nav-link <?=(isset($_GET['tab']) && $_GET['tab'] == 'crm-activity-tab-warm' ? 'active':'');?>"><i class="bi bi-cloud-sun fs-3 me-2"></i> WARM</a></li>
                        <li class="nav-item"><a href="?page=crm-activity&tab=crm-activity-tab-hot" class="nav-link <?=(isset($_GET['tab']) && $_GET['tab'] == 'crm-activity-tab-hot' ? 'active':'');?>"><i class="bi bi-sun fs-3 me-2"></i> HOT</a></li>
                        <li class="nav-item"><a href="?page=crm-activity&tab=crm-activity-tab-deal" class="nav-link <?=(isset($_GET['tab']) && $_GET['tab'] == 'crm-activity-tab-deal' ? 'active':'');?>"><i class="bi bi-check2-circle fs-3 me-2"></i> DEAL</a></li>
                        <li class="nav-item"><a href="?page=crm-activity&tab=crm-activity-tab-failed" class="nav-link <?=(isset($_GET['tab']) && $_GET['tab'] == 'crm-activity-tab-failed' ? 'active':'');?>"><i class="bi bi-slash-circle fs-3 me-2"></i> FAIL</a></li>
                        <li class="nav-item"><a href="?page=crm-activity&tab=crm-activity-tab-all" class="nav-link <?=(isset($_GET['tab']) && $_GET['tab'] == 'crm-activity-tab-all' ? 'active':'');?>"><i class="bi bi-book fs-3 me-2"></i> ALL DATA</a></li>
                    </ul>
                </nav>
                <?php if(!isset($_GET['tab'])) $_GET['tab'] = 0;?>
                <?php
                    if ($_GET['tab']) {
                        require_once 'pages/'.$_GET['tab'] . '.php';
                    } else {
                        require_once 'pages/crm-activity-tab-cold.php';
                    }
                ?>
            </div>
            
        </div>
    </div>
</div>

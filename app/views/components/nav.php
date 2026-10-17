<?php
$current_page = isset($_GET['act']) ? $_GET['act'] : 'dashboard';
?>

<nav class="sidebar" id="sidebar">
    <div>
        <div class="brand">
            <i class='bx bxs-cube-alt'></i> Pencatatan
        </div>

        <div class="menu">
            <a href="index.php?act=dashboard"
                class="menu-link <?php echo ($current_page === 'dashboard') ? 'active' : ''; ?>">
                <i class='bx bxs-dashboard'></i> <span>Dashboard</span>
            </a>

            <a href="index.php?act=kategori"
                class="menu-link <?php echo ($current_page === 'kategori') ? 'active' : ''; ?>">
                <i class='bx bx-note'></i> <span>Kategori</span>
            </a>

            <a href="index.php?act=catatan"
                class="menu-link <?php echo ($current_page === 'catatan' || $current_page === 'catatan') ? 'active' : ''; ?>">
                <i class='bx bx-notepad'></i> <span>Catatan</span>
            </a>
        </div>
    </div>

    <a href="index.php?act=logout" class="btn-logout">
        <i class='bx bx-log-out'></i> <span>Logout</span>
    </a>
</nav>

<div class="sidebar-overlay" id="sidebarOverlay"></div>
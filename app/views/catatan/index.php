<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Catatan | Dashboard Admin</title>
    <!-- Use Eksternal  -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700&display=swap"
        rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://unpkg.com/lucide@latest"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="public/css/style1.css">
    <link rel="stylesheet" href="public/css/style7.css">
    <link rel="stylesheet" href="public/css/style3.css?v=<?php echo time(); ?>">

</head>

<body>

    <?php require_once 'app/views/components/nav.php'; ?>

    <main class="main-content">

        <header class="header-top" style="margin-bottom: 2rem;">
            <div class="welcome-text">
                <h2 style="font-family:'Poppins'; color: var(--text-main);">Manajemen Catatan</h2>
            </div>
            <div class="user-profile">
                <div style="text-align: right;">
                    <span style="display:block; font-weight:600; font-size:0.9rem;">Admin Role</span>
                    <span style="font-size: 0.8rem; color: var(--text-muted);">Online</span>
                </div>
                <div class="avatar">
                    <?php echo isset($_SESSION['username']) ? strtoupper(substr($_SESSION['username'], 0, 1)) : 'A'; ?>
                </div>
            </div>
        </header>

        <div class="container" style="max-width: 100%; padding: 0 1rem;">

            <div class="page-header"
                style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1.5rem; margin-bottom: 2rem;">
                <div>
                    <h2 class="title">Daftar Catatan</h2>
                    <p class="subtitle">Kelola dan pantau semua dokumentasi Anda</p>
                </div>

                <div class="header-controls" style="display: flex; align-items: center; gap: 1rem; flex-wrap: wrap;">

                    <form action="index.php" method="GET" style="margin: 0; display: flex; gap: 0.5rem;">
                        <input type="hidden" name="act" value="catatan">

                        <div class="search-wrapper" style="position: relative; min-width: 260px;">
                            <i data-lucide="search"
                                style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--text-muted, #94a3b8); width: 18px; height: 18px; pointer-events: none;"></i>

                            <input type="text" name="search" class="search-input" placeholder="Cari judul atau isi..."
                                value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>"
                                style="width: 100%; padding: 10px 15px 10px 38px; background-color: rgba(30, 41, 59, 0.5); border: 1px solid var(--border, rgba(255, 255, 255, 0.08)); border-radius: 10px; color: var(--text-main, #f8fafc); font-family: 'Inter', sans-serif; font-size: 0.9rem;">
                        </div>

                        <button type="submit"
                            style="background-color: var(--primary, #10b981); color: white; border: none; padding: 10px 20px; border-radius: 10px; font-family: 'Inter', sans-serif; font-weight: 600; font-size: 0.9rem; cursor: pointer; transition: 0.3s; box-shadow: 0 4px 14px rgba(16, 185, 129, 0.2);">
                            Cari
                        </button>
                    </form>

                    <a href="index.php?act=catatan-tambah" class="btn btn-primary">
                        <i data-lucide="plus"></i> Tambah Catatan
                    </a>
                </div>
            </div>

            <?php if (isset($_SESSION['success_msg'])) : ?>
            <div class="alert alert-success">
                <i data-lucide="check-circle"></i>
                <?php 
                    echo $_SESSION['success_msg']; 
                    unset($_SESSION['success_msg']);
                ?>
            </div>
            <?php endif; ?>

            <?php if (isset($data_catatan) && count($data_catatan) > 0) : ?>
            <div class="grid-container">
                <?php foreach ($data_catatan as $row) : 
                        $id = $row['id_catatan'] ?? $row['id_catatan'] ?? '';
                    ?>
                <div class="note-card">
                    <div>
                        <h3 class="note-title"><?php echo htmlspecialchars($row['judul']); ?></h3>
                        <div class="note-body">
                            <?php echo htmlspecialchars($row['isi']); ?>
                        </div>
                    </div>

                    <div class="note-footer">
                        <div class="badge-group">
                            <span class="badge">
                                <i data-lucide="folder"></i>
                                <?php echo !empty($row['nama_kategori']) ? htmlspecialchars($row['nama_kategori']) : 'Uncategorized'; ?>
                            </span>
                            <span class="badge">
                                <i data-lucide="user"></i>
                                <?= htmlspecialchars($row['nama_admin'] ?? 'Unknown'); ?>
                            </span>
                        </div>

                        <div class="action-group">
                            <a href="index.php?act=catatan-edit&id_catatan=<?php echo $id; ?>" class="btn-icon btn-edit"
                                title="Edit">
                                <i data-lucide="edit-3"></i>
                            </a>
                            <a href="index.php?act=catatan-hapus&id_catatan=<?php echo $id; ?>"
                                class="btn-icon btn-delete delete-btn" title="Hapus">
                                <i data-lucide="trash-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            <?php else : ?>
            <div class="card" style="text-align: center; padding: 4rem 2rem; border: 1px dashed var(--border);">
                <i data-lucide="file-text"
                    style="width: 48px; height: 48px; margin-bottom: 1rem; color: var(--text-muted);"></i>
                <p style="color: var(--text-muted); font-size: 1.1rem;">Belum ada catatan tersedia.</p>
            </div>
            <?php endif; ?>

        </div>
    </main>

    <script>
    // Inisialisasi Lucide Icons
    lucide.createIcons();
    </script>

    <?php require_once 'public/js/components/alertDel.php'; ?>
</body>

</html>

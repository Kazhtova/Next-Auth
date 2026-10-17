<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Catatan | Dashboard Admin</title>
     <!-- Import Css And Js -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700&display=swap"
        rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://unpkg.com/lucide@latest"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="public/css/style1.css">
    <link rel="stylesheet" href="public/css/style9.css">
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

        <div class="container form-container">

            <div class="page-header"
                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                <div>
                    <h2 class="title">Edit Catatan</h2>
                    <p class="subtitle">Perbarui informasi dan isi catatan Anda.</p>
                </div>
                <a href="index.php?act=catatan" class="btn btn-secondary">
                    <i data-lucide="arrow-left"></i> Kembali
                </a>
            </div>

            <?php if (isset($_SESSION['error_msg'])): ?>
            <div class="alert alert-danger"
                style="background: rgba(239, 68, 68, 0.1); border: 1px solid var(--danger); color: var(--danger); padding: 1rem; border-radius: 12px; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px;">
                <i data-lucide="alert-circle"></i>
                <?= $_SESSION['error_msg']; ?>
            </div>
            <?php unset($_SESSION['error_msg']); endif; ?>

            <div class="card" style="padding: 2rem;">
                <form action="index.php?act=catatan-edit-proses" method="POST">

                    <input type="hidden" name="id_catatan" value="<?= htmlspecialchars($catatan['id_catatan']) ?>">

                    <div class="form-group">
                        <label class="form-label" for="judul">Judul Catatan</label>
                        <input type="text" id="judul" name="judul" class="form-control"
                            value="<?= htmlspecialchars($catatan['judul']) ?>" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="id_kategori">Pilih Kategori</label>
                        <select id="id_kategori" name="id_kategori" class="form-control" required>
                            <option value="" disabled>-- Pilih Kategori --</option>
                            <?php if(isset($data_kategori) && count($data_kategori) > 0): ?>
                            <?php foreach($data_kategori as $kat): ?>
                            <option value="<?= htmlspecialchars($kat['id_kategori']) ?>"
                                <?= ($catatan['id_kategori'] == $kat['id_kategori']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($kat['nama_kategori']) ?>
                            </option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="isi">Isi Catatan</label>
                        <textarea id="isi" name="isi" class="form-control" rows="8"
                            required><?= htmlspecialchars($catatan['isi']) ?></textarea>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">
                            <i data-lucide="save"></i> Perbarui Catatan
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </main>

    <script>
    // Initialize Icons
    lucide.createIcons();
    </script>
</body>

</html>

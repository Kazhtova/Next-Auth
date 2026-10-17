<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kategori | Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="public/css/style5.css?v=<?= time(); ?>">
</head>

<body>

    <div class="edit-layout">
        <div class="form-container">
            <a href="index.php?act=kategori" class="back-link">
                <i data-lucide="arrow-left"></i> Kembali ke Daftar
            </a>

            <header class="form-header">
                <div class="header-icon">
                    <i data-lucide="edit-2"></i>
                </div>
                <div>
                    <h2 class="form-title">Update Category</h2>
                    <p class="form-subtitle">Sesuaikan informasi kategori untuk memperbarui sistem.</p>
                </div>
            </header>

            <?php if (isset($_SESSION['error_msg'])) : ?>
            <div class="status-alert error">
                <i data-lucide="alert-circle"></i>
                <span><?= $_SESSION['error_msg']; ?></span>
            </div>
            <?php unset($_SESSION['error_msg']); ?>
            <?php endif; ?>

            <div class="glass-card">
                <form action="index.php?act=kategori-edit-proses" method="POST">
                    <div class="input-group muted">
                        <label>Category ID</label>
                        <div class="field-wrapper">
                            <i data-lucide="hash"></i>
                            <input type="hidden"
                                value="<?= isset($data_kategori['id_kategori']) ? $data_kategori['id_kategori'] : '' ?>"
                                name="id_kategori">
                            <input type="text"
                                value="<?= isset($data_kategori['id_kategori']) ? $data_kategori['id_kategori'] : '' ?>"
                                name="id_kategori" readonly>
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="nama_kategori">New Category Name</label>
                        <div class="field-wrapper">
                            <i data-lucide="tag"></i>
                            <input type="text" name="nama_kategori" id="nama_kategori"
                                value="<?= isset($data_kategori['nama_kategori']) ? $data_kategori['nama_kategori'] : '' ?>"
                                placeholder="Masukkan nama baru..." required autofocus>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-submit">
                            <i data-lucide="refresh-cw"></i>
                            Perbarui Data
                        </button>
                    </div>
                </form>
            </div>

            <!-- <p class="footer-note">Terakhir diubah oleh: <strong><?= $kategori['username'] ?? 'System'; ?></strong></p> -->
        </div>
    </div>

    <script>
    lucide.createIcons();
    </script>
</body>

</html>
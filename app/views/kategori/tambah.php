<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori | Modern Dashboard</title>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@600;700&display=swap"
        rel="stylesheet">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="public/css/style1.css">
    <link rel="stylesheet" href="public/css/style4.css?v=<?= time(); ?>">
</head>

<body>

    <?php require_once 'app/views/components/nav.php'; ?>

    <main class="main-content">

        <header class="header-top" style="margin-bottom: 2rem;">
            <div class="welcome-text">
                <h2 style="font-family:'Poppins'; color: var(--text-main);">Manajemen Kategori</h2>
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

        <div class="container-sm" style="max-width: 600px; margin: 0 auto; padding: 0 1rem;">

            <header class="page-header" style="margin-bottom: 2rem; text-align: center;">
                <h2 class="title" style="font-family:'Poppins';">Create Category</h2>
                <p class="subtitle" style="color: var(--text-muted);">Organize your data with custom categories.</p>
            </header>

            <?php if (isset($_SESSION['error_msg'])) : ?>
            <div class="alert"
                style="background: rgba(239, 68, 68, 0.1); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.3); padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 10px;">
                <i data-lucide="info" style="width:20px"></i>
                <span><?= $_SESSION['error_msg']; ?></span>
            </div>
            <?php unset($_SESSION['error_msg']); ?>
            <?php endif; ?>

            <div class="card"
                style="background: var(--bg-card, rgba(30, 41, 59, 0.5)); border: 1px solid var(--border-glass, rgba(255, 255, 255, 0.1)); border-radius: 16px; padding: 2rem;">
                <form action="index.php?act=kategori-tambah-proses" method="POST">

                    <div class="form-group" style="margin-bottom: 1.5rem;">
                        <label for="nama_kategori"
                            style="display: block; margin-bottom: 0.5rem; color: var(--text-muted); font-size: 0.9rem;">Category
                            Name</label>
                        <div class="input-wrapper" style="position: relative;">
                            <i data-lucide="layers" class="input-icon"
                                style="position: absolute; left: 16px; top: 50%; transform: translateY(-50%); color: var(--text-muted); width: 18px;"></i>
                            <input type="text" name="nama_kategori" id="nama_kategori"
                                placeholder="e.g. Electronics or Furniture" required autofocus
                                style="width: 100%; padding: 14px 16px 14px 44px; background: rgba(0,0,0,0.2); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 10px; color: #fff; outline: none; transition: border 0.3s;">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary"
                        style="width: 100%; padding: 14px; background: #10b981; color: white; border: none; border-radius: 10px; font-weight: 600; cursor: pointer; display: flex; justify-content: center; align-items: center; gap: 8px; transition: 0.3s;">
                        <i data-lucide="save" style="width:18px"></i>
                        Save Category
                    </button>
                </form>
            </div>

            <div style="text-align: center; margin-top: 1.5rem;">
                <a href="index.php?act=kategori" class="btn btn-secondary"
                    style="color: var(--text-muted); text-decoration: none; display: inline-flex; align-items: center; gap: 5px; font-size: 0.9rem; transition: 0.3s;">
                    <i data-lucide="chevron-left" style="width:18px;"></i> Kembali
                </a>
            </div>
        </div>
    </main>

    <script>
    // Initialize Lucide Icons
    lucide.createIcons();
    </script>
</body>

</html>
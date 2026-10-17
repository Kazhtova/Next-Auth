<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin | Notes App</title>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@600;700&display=swap"
        rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="public/css/style1.css">
</head>

<body>

    <?php require_once 'app/views/components/nav.php'; ?>

    <main class="main-content">

        <header class="header-top">
            <div class="welcome-text">
                <h2><span
                        style="color: var(--primary);"><?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Admin'; ?></span>!
                </h2>
                <p style="color: var(--text-muted);">Selamat datang di dashboard admin.</p>
            </div>

            <div class="user-profile">
                <div style="text-align: right;">
                    <span style="display:block; font-weight:600; font-size:0.9rem;">Admin Role</span>
                    <span style="font-size: 0.8rem; color: var(--text-muted);">Online</span>
                </div>
                <div class="avatar">
                    <?php echo isset($_SESSION['username']) ? strtoupper(substr($_SESSION['username'], 0, 1)) : ''; ?>
                </div>
            </div>
        </header>

        <div class="grid-container">
            <div class="stat-card">
                <div class="icon-box"><i class='bx bx-note'></i></div>
                <div class="stat-info">
                    <h3><?= htmlspecialchars($data_kategori['total']) ?></h3>
                    <p>Total Kategori</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="icon-box"><i class='bx bx-notepad'></i></div>
                <div class="stat-info">
                    <h3><?= htmlspecialchars($data_catatan['total']) ?></h3>
                    <p>Total Catatan</p>
                </div>
            </div>

            <div class="stat-card">
                <div class="icon-box"><i class='bx bx-user'></i></div>
                <div class="stat-info">
                    <h3>Admin</h3>
                    <p>Status Akun</p>
                </div>
            </div>
        </div>

        <div
            style="margin-top: 2rem; background: var(--card-bg); border-radius: 16px; padding: 2rem; border: 1px solid var(--border-glass); min-height: 300px;">
            <h4 style="margin-bottom: 1rem; font-family:'Poppins';">Aktivitas Terkini</h4>
            <p style="color: var(--text-muted);">Belum ada aktivitas baru hari ini.</p>
        </div>

    </main>

</body>

</html>
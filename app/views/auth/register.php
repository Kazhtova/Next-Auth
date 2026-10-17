<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Admin | Notes App</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="public/css/style2.css">
</head>
<body>

    <div class="split-screen">
        
        <div class="left-panel">
            <div class="glow-circle"></div>
            <div class="left-content">
                <h1>Bergabunglah<br>Menjadi <span class="highlight">Admin.</span></h1>
                <p>Kelola catatan, pengguna, dan data dengan sistem dashboard modern yang cepat dan aman.</p>
            </div>
        </div>

        <div class="right-panel">
            <div class="form-container">
                
                <div class="form-header">
                    <h2>Buat Akun Baru</h2>
                    <p>Silakan isi data untuk mendaftar sebagai admin.</p>
                </div>

                <?php if(isset($error)) echo "<div class='alert'>$error</div>"; ?>

                <form action="index.php?act=register-process" method="POST">
                    <div>
                        <label for="username">Username</label>
                        <input type="text" name="username" id="username" required>
                    </div>
                    <div>
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" required>
                    </div>
                    
                    <button type="submit" class="btn">Daftar Sekarang</button>
                </form>

                <div class="auth-link">
                    Sudah punya akun? <a href="index.php">Login di sini</a>
                </div>
            </div>
        </div>
        
    </div>

</body>
</html>
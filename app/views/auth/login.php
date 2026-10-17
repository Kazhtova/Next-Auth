<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
    <link rel="stylesheet" href="public/css/style.css">
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">Login Admin</div>

            <?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
            
            <?php if(isset($success)) echo "<div class='alert alert-success'>$success</div>"; ?>

            <form action="index.php?act=login-process" method="POST">
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn">Login</button>
            </form>
            <hr>
            <div class="text-center">
                <a href="index.php?act=register">Belum punya akun? Daftar</a>
            </div>
        </div>
    </div>
</body>
</html>
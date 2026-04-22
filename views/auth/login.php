<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Waifu Gacha</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container" style="display: flex; flex-direction: column; justify-content: center; min-height: 100vh;">
        <div class="result-box">
            <h1><i class="fa-solid fa-gamepad"></i> LOGIN</h1>

            <?php if (!empty($error)): ?>
                <div class="error-text">
                    <i class="fa-solid fa-triangle-exclamation"></i> <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="index.php?url=auth/login">
                <input type="text" name="username" placeholder="USERNAME" required>
                <input type="password" name="password" placeholder="PASSWORD" required>
                <button type="submit" class="btn">GAS LOGIN!</button>
            </form>
            <p style="margin-top: 1rem;">
                Belum punya akun? <a href="index.php?url=auth/register" style="color: var(--accent2); font-weight: bold;">DAFTAR SINI</a>
            </p>
        </div>
    </div>
</body>
</html>

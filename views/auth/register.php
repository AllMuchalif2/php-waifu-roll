<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Waifu Gacha</title>
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container" style="display: flex; flex-direction: column; justify-content: center; min-height: 100vh;">
        <div class="result-box">
            <h1><i class="fa-solid fa-user-plus"></i> DAFTAR</h1>

            <?php if (!empty($error)): ?>
                <div class="error-text">
                    <i class="fa-solid fa-triangle-exclamation"></i> <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="index.php?url=auth/register">
                <input type="text" name="username" placeholder="USERNAME BARU" required>
                <input type="password" name="password" placeholder="PASSWORD" required>
                <button type="submit" class="btn">DAFTAR SEKARANG!</button>
            </form>
            <p style="margin-top: 1rem;">
                Sudah punya akun? <a href="index.php?url=auth/login" style="color: var(--accent2); font-weight: bold;">LOGIN AJA</a>
            </p>
            <hr style="border: 2px dashed black; margin: 1.5rem 0; opacity: 0.2;">
            <a href="index.php" class="btn btn-secondary"><i class="fa-solid fa-house"></i> KEMBALI KE BERANDA</a>
        </div>
    </div>
</body>
</html>

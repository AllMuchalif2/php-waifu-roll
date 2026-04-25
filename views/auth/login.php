<?php 
$title = "Login - Waifu Gacha";
include BASE_PATH . '/views/partials/header.php'; 
?>

<body>
    <div class="auth-wrapper">
        <div class="result-box auth-card">
            <h2 class="auth-title">MASUK KE MYBINI</h2>
            
            <?php include BASE_PATH . '/views/partials/messages.php'; ?>

            <form action="index.php?url=auth/login" method="POST">
                <div class="mb-15">
                    <label class="form-label d-block font-black mb-05 text-uppercase">Username</label>
                    <input type="text" name="username" required placeholder="Masukkan username...">
                </div>
                <div class="mb-2">
                    <label class="form-label d-block font-black mb-05 text-uppercase">Password</label>
                    <input type="password" name="password" required placeholder="********">
                </div>
                <button type="submit" class="btn">MASUK SEKARANG!</button>
            </form>
            
            <p class="text-center mt-1 font-bold">
                Belum punya akun? <a href="index.php?url=auth/register" class="tier-accent2-text font-bold">DAFTAR SINI</a>
            </p>
            <hr class="auth-hr">
            <a href="/index.php" class="btn btn-secondary"><i class="fa-solid fa-house"></i> KEMBALI KE BERANDA</a>
        </div>
    </div>
</body>
</html>

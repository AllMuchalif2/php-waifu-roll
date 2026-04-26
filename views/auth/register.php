<?php 
$title = "Daftar - Waifu Gacha";
include BASE_PATH . '/views/partials/header.php'; 
?>

<body>
    <div class="container" style="display: flex; align-items: center; justify-content: center; min-height: 100vh; flex-direction: column;">
        <div class="card w-full">
            <div class="text-center mb-2">
                <img src="/assets/img/logo.png" style="height: 60px; margin-bottom: 1rem;">
                <h2 style="font-size: 1.5rem;">DAFTAR MYBINI</h2>
                <p class="text-sm text-muted">Mulai petualangan gachamu sekarang!</p>
            </div>
            
            <?php include BASE_PATH . '/views/partials/messages.php'; ?>

            <form action="index.php?url=auth/register" method="POST">
                <div style="margin-bottom: 1rem;">
                    <label class="text-xs font-black mb-05 d-block">USERNAME</label>
                    <input type="text" name="username" required placeholder="...">
                </div>
                <div style="margin-bottom: 1.5rem;">
                    <label class="text-xs font-black mb-05 d-block">PASSWORD</label>
                    <input type="password" name="password" required placeholder="********">
                </div>
                <button type="submit" class="btn">GAS DAFTAR!</button>
            </form>
            
            <p class="text-center mt-1 text-sm font-bold">
                Sudah punya akun? <a href="index.php?url=auth/login" class="color-primary">LOGIN</a>
            </p>
        </div>
        <a href="/index.php" class="btn btn-secondary w-auto px-3"><i class="fa-solid fa-house"></i> BERANDA</a>
    </div>
</body>
</html>

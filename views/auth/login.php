<?php 
$title = "Login - Waifu Gacha";
include BASE_PATH . '/views/partials/header.php'; 
?>

<body>
    <div class="w-full max-w-md mx-auto p-6" style="display: flex; align-items: center; justify-content: center; min-height: 100vh; flex-direction: column;">
        <div class="bg-white border-2 border-gray-900 rounded-2xl p-6 mb-6 shadow-sm relative w-full">
            <div class="text-center mb-8">
                <img src="/assets/img/logo.png" style="height: 60px; margin-bottom: 1rem;">
                <h2 style="font-size: 1.5rem;">MASUK MYBINI</h2>
                <p class="text-sm text-gray-500">Ayo lanjut gacha waifumu!</p>
            </div>
            
            <?php include BASE_PATH . '/views/partials/messages.php'; ?>

            <form action="index.php?url=auth/login" method="POST">
                <div style="margin-bottom: 1rem;">
                    <label class="text-xs font-black mb-05 d-block">USERNAME</label>
                    <input type="text" name="username" required placeholder="...">
                </div>
                <div style="margin-bottom: 1.5rem;">
                    <label class="text-xs font-black mb-05 d-block">PASSWORD</label>
                    <input type="password" name="password" required placeholder="********">
                </div>
                <button type="submit" class="inline-flex items-center justify-center gap-2 w-full py-3 px-6 bg-blue-600 text-white border-2 border-gray-900 rounded-xl font-bold uppercase transition-all shadow-[6px_6px_0px_#ffea00] active:translate-x-[3px] active:translate-y-[3px] active:shadow-[3px_3px_0px_#ffea00] mb-4 text-sm">MASUK SEKARANG</button>
            </form>
            
            <p class="text-center mt-4 text-sm font-bold">
                Belum punya akun? <a href="index.php?url=auth/register" class="text-blue-600">DAFTAR</a>
            </p>
        </div>
        <a href="/index.php" class="inline-flex items-center justify-center gap-2 w-full py-3 px-6 bg-blue-600 text-white border-2 border-gray-900 rounded-xl font-bold uppercase transition-all shadow-[6px_6px_0px_#ffea00] active:translate-x-[3px] active:translate-y-[3px] active:shadow-[3px_3px_0px_#ffea00] mb-4 text-sm bg-yellow-400 text-gray-900 shadow-[6px_6px_0px_#3d5afe] active:shadow-[3px_3px_0px_#3d5afe] w-auto px-3"><i class="fa-solid fa-house"></i> BERANDA</a>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Waifu Gacha</title>
    <link rel="icon" href="/assets/img/logo.png" type="image/png">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="w-full max-w-md mx-auto p-6" style="display: flex; flex-direction: column; justify-content: center; min-height: 100vh;">
        <div class="result-box">
            <h1 style="color: var(--accent2);"><i class="fa-solid fa-shield-halved"></i> ADMIN AREA</h1>

            <?php if (!empty($error)): ?>
                <div class="error-text">
                    <i class="fa-solid fa-triangle-exclamation"></i> <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="index.php?url=auth/adminLogin">
                <input type="text" name="username" placeholder="ADMIN USERNAME" required>
                <input type="password" name="password" placeholder="ADMIN PASSWORD" required>
                <button type="submit" class="inline-flex items-center justify-center gap-2 w-full py-3 px-6 bg-blue-600 text-white border-2 border-gray-900 rounded-xl font-bold uppercase transition-all shadow-[6px_6px_0px_#ffea00] active:translate-x-[3px] active:translate-y-[3px] active:shadow-[3px_3px_0px_#ffea00] mb-4 text-sm bg-yellow-400 text-gray-900 shadow-[6px_6px_0px_#3d5afe] active:shadow-[3px_3px_0px_#3d5afe]">MASUK PANEL</button>
            </form>
        </div>
    </div>
</body>
</html>

<?php 
$title = "Dashboard - Waifu Gacha";
include BASE_PATH . '/views/partials/header.php'; 
?>

<body class="pb-80">
    <?php include BASE_PATH . '/views/partials/navbar.php'; ?>
    
    <div class="container">
        <!-- Messages -->
        <?php include BASE_PATH . '/views/partials/messages.php'; ?>

        <!-- Daily Reward -->
        <?php 
            $userModel = new \App\Models\User();
            if ($userModel->canClaimDaily($_SESSION['user_id'])): 
        ?>
            <div class="result-box bg-white color-black mt-1 text-center border-dashed">
                <h3 class="color-black mb-05 no-shadow"><i class="fa-solid fa-gift"></i> HADIAH HARIAN TERSEDIA!</h3>
                <a href="index.php?url=gacha/daily" class="btn bg-accent2">KLAIM SEKARANG!</a>
            </div>
        <?php endif; ?>

        <!-- Profile Header -->
        <div class="result-box profile-header">
            <div class="font-black text-xl text-uppercase">
                <i class="fa-solid fa-user"></i> <?php echo htmlspecialchars($user['username']); ?>
            </div>
            <div class="font-bold">
                <span class="color-accent2"><i class="fa-solid fa-coins"></i> <?php echo $user['coins']; ?></span>
                <span class="mx-05">|</span>
                <span class="color-accent1"><i class="fa-solid fa-dice"></i> <?php echo $user['dice_count']; ?></span>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="quick-actions">
            <a href="index.php?url=gacha/roll" class="btn"><i class="fa-solid fa-dice"></i> GACHA!</a>
            <a href="index.php?url=scoreboard/index" class="btn btn-secondary"><i class="fa-solid fa-trophy"></i> RANK</a>
        </div>

        <h2 class="text-left text-lg"><i class="fa-solid fa-box-open"></i> KOLEKSI</h2>
        
        <!-- Collection Grid -->
        <div class="collection-grid">
            <?php foreach ($waifus as $w): ?>
                <div class="result-box waifu-card-mini">
                    <div class="tier-badge tier-<?php echo strtolower($w['tier']); ?> tier-badge-floating">
                        x<?php echo $w['total']; ?>
                    </div>
                    <img src="<?php echo htmlspecialchars($w['image_url']); ?>" loading="lazy" class="waifu-img m-0 w-full border-3">
                    <div class="text-sm mt-05 font-black line-height-12">
                        <?php echo htmlspecialchars($w['name']); ?>
                    </div>
                    <div class="text-xs font-black tier-<?php echo strtolower($w['tier']); ?>-text">
                        [<?php echo htmlspecialchars($w['tier']); ?>]
                    </div>
                </div>
            <?php endforeach; ?>
            
            <?php if (empty($waifus)): ?>
                <p class="grid-span-all text-center opacity-06 p-2">Belum punya waifu... Ayo gacha!</p>
            <?php endif; ?>
        </div>

        <a href="index.php?url=auth/logout" class="btn mt-3 bg-555"><i class="fa-solid fa-right-from-bracket"></i> LOGOUT</a>
    </div>

    <?php include BASE_PATH . '/views/partials/footer.php'; ?>

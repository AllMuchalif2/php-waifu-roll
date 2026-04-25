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

        <h2 class="text-left text-lg mb-05"><i class="fa-solid fa-box-open"></i> KOLEKSI</h2>

        <!-- Filter & Sort Collection -->
        <div class="result-box text-left p-1 mb-1">
            <form action="index.php" method="GET" style="display: flex; flex-wrap: wrap; gap: 0.5rem; align-items: flex-end;">
                <input type="hidden" name="url" value="gacha/index">
                
                <div style="flex: 1; min-width: 150px;">
                    <label class="text-xs font-black">CARI NAMA</label>
                    <input type="text" name="search" value="<?php echo htmlspecialchars($filters['search']); ?>" placeholder="..." style="margin-bottom: 0; padding: 0.5rem; font-size: 0.8rem;">
                </div>

                <div style="width: 80px;">
                    <label class="text-xs font-black">TIER</label>
                    <select name="tier" class="btn" style="margin-bottom: 0; padding: 0.5rem; font-size: 0.8rem; background: var(--white); color: var(--black); text-transform: none; text-align: left;">
                        <option value="">ALL</option>
                        <option value="C" <?php echo $filters['tier'] == 'C' ? 'selected' : ''; ?>>C</option>
                        <option value="B" <?php echo $filters['tier'] == 'B' ? 'selected' : ''; ?>>B</option>
                        <option value="A" <?php echo $filters['tier'] == 'A' ? 'selected' : ''; ?>>A</option>
                        <option value="SR" <?php echo $filters['tier'] == 'SR' ? 'selected' : ''; ?>>SR</option>
                        <option value="SSR" <?php echo $filters['tier'] == 'SSR' ? 'selected' : ''; ?>>SSR</option>
                        <option value="LIMITED" <?php echo $filters['tier'] == 'LIMITED' ? 'selected' : ''; ?>>LM</option>
                    </select>
                </div>

                <div style="width: 80px;">
                    <label class="text-xs font-black">URUT</label>
                    <select name="sort" class="btn" style="margin-bottom: 0; padding: 0.5rem; font-size: 0.8rem; background: var(--white); color: var(--black); text-transform: none; text-align: left;">
                        <option value="total" <?php echo $filters['sort'] == 'total' ? 'selected' : ''; ?>>QTY</option>
                        <option value="name" <?php echo $filters['sort'] == 'name' ? 'selected' : ''; ?>>A-Z</option>
                        <option value="tier" <?php echo $filters['sort'] == 'tier' ? 'selected' : ''; ?>>TIER</option>
                    </select>
                </div>

                <button type="submit" class="btn w-auto mb-0" style="padding: 0.5rem 0.8rem;"><i class="fa-solid fa-magnifying-glass"></i></button>
                <a href="index.php?url=gacha/index" class="btn btn-secondary w-auto mb-0" style="padding: 0.5rem 0.8rem;"><i class="fa-solid fa-rotate-left"></i></a>
            </form>
        </div>
        
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

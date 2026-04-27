<?php
$title = "MYBINI - Koleksi Waifu Impianmu!";
include BASE_PATH . '/views/partials/header.php';
?>

<body>
    <?php include BASE_PATH . '/views/partials/navbar.php'; ?>

    <div class="container">
        <!-- Hero Section -->
        <header class="text-center mt-2 mb-4">
            <h1 style="font-size: clamp(2.5rem, 10vw, 4rem); margin-bottom: 0.5rem;">MYBINI</h1>
            <p class="text-muted" style="margin-bottom: 2rem;">Koleksi Waifu Impian & Jadi yang Terkuat!</p>
            <div class="flex-center gap-1">
                <a href="index.php?url=auth/login" class="btn w-auto px-3 mb-0">MASUK</a>
                <a href="index.php?url=auth/register" class="btn btn-secondary w-auto px-3 mb-0">DAFTAR</a>
            </div>
        </header>

        <!-- Top Waifus Section -->
        <section class="mb-4">
            <h2 class="text-sm font-black color-primary mb-1"><i class="fa-solid fa-fire"></i> TOP WAIFUS</h2>
            <div class="top-waifus-grid">
                <?php foreach ($topWaifus as $w): ?>
                    <div class="waifu-card-mini">
                        <div class="tier-badge tier-<?php echo strtolower($w['tier']); ?>">
                            <?php echo $w['tier']; ?>
                        </div>
                        <img src="<?php echo htmlspecialchars($w['image_url']); ?>" class="waifu-img">
                        <div class="text-sm font-black"><?php echo htmlspecialchars($w['name']); ?></div>
                        <?php if ($w['tier'] === 'LIMITED' && !empty($w['owner_name'])): ?>
                            <div class="text-xs font-bold color-danger mt-1">
                                <i class="fa-solid fa-crown"></i> <?php echo htmlspecialchars($w['owner_name']); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <a href="https://php-waifu-roll.care/index.php?url=home/pool" class="btn btn-secondary mt-1 mb-0">LIHAT
                SEMUA WAIFU</a>
        </section>

        <!-- Scoreboard Preview -->
        <section class="mb-4">
            <h2 class="text-sm font-black color-primary mb-1"><i class="fa-solid fa-trophy"></i> TOP PLAYERS</h2>
            <div class="card p-1">
                <div class="flex flex-col gap-1" style="display: flex; flex-direction: column;">
                    <?php foreach ($rankings as $i => $r): ?>
                        <div class="card p-1"
                            style="<?php echo ($i < 3) ? 'background: rgba(61, 90, 254, 0.05); border-color: var(--primary-blue);' : ''; ?> display: flex; align-items: center; justify-content: space-between; gap: 0.5rem; margin-bottom: 0;">

                            <div style="display: flex; align-items: center; gap: 1rem; flex: 1;">
                                <!-- Rank -->
                                <div class="font-black text-center"
                                    style="width: 30px; font-size: 1.2rem; <?php echo ($i == 0) ? 'color: #fcc419;' : (($i == 1) ? 'color: #adb5bd;' : (($i == 2) ? 'color: #e67e22;' : '')); ?>">
                                    <?php if ($i < 3): ?><i class="fa-solid fa-crown"
                                            style="font-size: 0.8rem; display: block; margin-bottom: -5px;"></i><?php endif; ?>
                                    <?php echo $i + 1; ?>
                                </div>

                                <!-- Player Info -->
                                <div>
                                    <div class="text-sm font-bold" style="line-height: 1.2;">
                                        <?php echo htmlspecialchars($r['username']); ?></div>
                                    <div class="text-xs text-muted mt-05">
                                        <i class="fa-solid fa-heart color-primary"></i> <?php echo $r['waifu_count']; ?>
                                        Waifu
                                    </div>
                                </div>
                            </div>

                            <!-- Coins -->
                            <div class="text-right">
                                <div class="text-xs font-black opacity-06">COINS</div>
                                <div class="text-sm font-bold color-danger"><i class="fa-solid fa-coins"></i>
                                    <?php echo number_format($r['coins'], 0, ',', '.'); ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <a href="index.php?url=scoreboard/index" class="btn btn-secondary mt-1 mb-0">LIHAT SEMUA RANKING</a>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="card text-center mb-4" style="background: var(--primary-blue); color: white;">
            <h2 class="mb-05">SIAP GACHA?</h2>
            <p class="text-sm opacity-06 mb-1">Ribuan Waifu Menantimu!</p>
            <a href="index.php?url=auth/register" class="btn btn-secondary mb-0">GAS DAFTAR GRATIS!</a>
        </section>

        <!-- Suggestion Card -->
        <section class="card text-center" style="border-style: dashed; background: rgba(255, 234, 0, 0.1);">
            <h3 class="text-sm font-black mb-05"><i class="fa-solid fa-lightbulb color-primary"></i> SARAN WAIFU BARU?
            </h3>
            <p class="text-xs text-muted mb-1">Punya waifu favorit yang belum ada? Kasih tahu kami!</p>
            <a href="https://forms.gle/uV83B7zRbk98sKDr6" target="_blank" class="btn btn-secondary mb-0 w-auto px-3">ISI
                FORM SARAN</a>
        </section>
    </div>

    <?php include BASE_PATH . '/views/partials/footer.php'; ?>
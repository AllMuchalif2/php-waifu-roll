<?php
$title = "MYBINI - Koleksi Waifu Impianmu!";
include BASE_PATH . '/views/partials/header.php';
?>

<body>
    <?php include BASE_PATH . '/views/partials/navbar.php'; ?>

    <!-- Hero Section -->
    <header class="hero-section">
        <div class="container">
            <h1 class="hero-title">MYBINI!</h1>
            <p class="hero-subtitle">Kumpulkan waifu favoritmu dan jadilah nomor satu!</p>
            <div class="flex-center gap-1">
                <a href="index.php?url=auth/login" class="btn w-auto px-3">LOGIN</a>
                <a href="index.php?url=auth/register" class="btn btn-secondary w-auto px-3">DAFTAR</a>
            </div>
        </div>
    </header>

    <div class="container">
        <!-- Top Waifus Section -->
        <section class="mb-4">
            <h2 class="text-2xl"><i class="fa-solid fa-fire"></i> TOP WAIFUS</h2>
            <div class="top-waifus-grid">
                <?php foreach ($topWaifus as $w): ?>
                    <div class="result-box waifu-card-mini border-black">
                        <div class="tier-badge tier-<?php echo strtolower($w['tier']); ?> tier-badge-floating rotate-10">
                            <?php echo $w['tier']; ?>
                        </div>
                        <img src="<?php echo htmlspecialchars($w['image_url']); ?>" class="waifu-img m-0 w-full border-3">
                        <div class="text-base mt-05 font-black"><?php echo htmlspecialchars($w['name']); ?></div>
                        <?php if ($w['tier'] === 'LIMITED' && !empty($w['owner_name'])): ?>
                            <div class="text-xs font-black color-accent2 mt-02">
                                <i class="fa-solid fa-crown"></i> PUNYA: <?php echo htmlspecialchars($w['owner_name']); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Scoreboard Preview -->
        <section class="mb-4">
            <h2><i class="fa-solid fa-trophy"></i> TOP PLAYERS</h2>
            <div class="result-box">
                <table class="ranking-table">
                    <thead>
                        <tr class="border-b-4">
                            <th>#</th>
                            <th>PLAYER</th>
                            <th>WAIFU</th>
                            <th>COINS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rankings as $i => $r): ?>
                            <tr class="ranking-row">
                                <td class="font-black"><?php echo $i + 1; ?></td>
                                <td class="font-black text-uppercase"><?php echo htmlspecialchars($r['username']); ?></td>
                                <td><i class="fa-solid fa-heart color-accent1"></i> <?php echo $r['waifu_count']; ?></td>
                                <td><i class="fa-solid fa-coins color-accent2"></i> <?php echo $r['coins']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <a href="index.php?url=scoreboard/index" class="btn btn-secondary mt-15">LIHAT SEMUA PERINGKAT</a>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="cta-section">
            <h2 class="cta-title">SIAP GACHA SEKARANG?</h2>
            <p class="cta-subtitle">Waifu menunggu untuk kamu koleksi!</p>
            <a href="index.php?url=auth/register" class="btn bg-white color-black border-black">GAS DAFTAR GRATIS!</a>
        </section>
    </div>

    <?php include BASE_PATH . '/views/partials/footer.php'; ?>
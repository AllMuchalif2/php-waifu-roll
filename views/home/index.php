<?php
$title = "MYBINI - Koleksi Waifu Impianmu!";
include BASE_PATH . '/views/partials/header.php';
?>

<body>
    <?php include BASE_PATH . '/views/partials/navbar.php'; ?>

    <div class="w-full max-w-md mx-auto p-6">
        <!-- Hero Section -->
        <header class="text-center mt-8 mb-16">
            <h1 style="font-size: clamp(2.5rem, 10vw, 4rem); margin-bottom: 0.5rem;">MYBINI</h1>
            <p class="text-gray-500" style="margin-bottom: 2rem;">Koleksi Waifu Impian & Jadi yang Terkuat!</p>
            <div class="flex justify-center items-center gap-4">
                <a href="index.php?url=auth/login" class="inline-flex items-center justify-center gap-2 w-full py-3 px-6 bg-blue-600 text-white border-2 border-gray-900 rounded-xl font-bold uppercase transition-all shadow-[6px_6px_0px_#ffea00] active:translate-x-[3px] active:translate-y-[3px] active:shadow-[3px_3px_0px_#ffea00] mb-4 text-sm w-auto px-3 mb-0">MASUK</a>
                <a href="index.php?url=auth/register" class="inline-flex items-center justify-center gap-2 w-full py-3 px-6 bg-blue-600 text-white border-2 border-gray-900 rounded-xl font-bold uppercase transition-all shadow-[6px_6px_0px_#ffea00] active:translate-x-[3px] active:translate-y-[3px] active:shadow-[3px_3px_0px_#ffea00] mb-4 text-sm bg-yellow-400 text-gray-900 shadow-[6px_6px_0px_#3d5afe] active:shadow-[3px_3px_0px_#3d5afe] w-auto px-3 mb-0">DAFTAR</a>
            </div>
        </header>

        <!-- Top Waifus Section -->
        <section class="mb-16">
            <h2 class="text-sm font-black text-blue-600 mb-4"><i class="fa-solid fa-fire"></i> TOP WAIFUS</h2>
            <div class="grid grid-cols-3 gap-2">
                <?php foreach ($topWaifus as $w): ?>
                    <div class="p-2 border-2 border-gray-900 rounded-xl bg-white text-center transition-transform hover:-translate-y-1 relative">
                        <div class="absolute top-2 right-2 px-2 py-1 rounded-md text-[10px] font-black text-white border border-gray-900 z-10 tier-<?php echo strtolower($w['tier']); ?>">
                            <?php echo $w['tier']; ?>
                        </div>
                        <img src="<?php echo htmlspecialchars($w['image_url']); ?>" class="w-full rounded-lg border border-gray-900 aspect-square object-cover mb-2">
                        <div class="text-sm font-black"><?php echo htmlspecialchars($w['name']); ?></div>
                        <?php if ($w['tier'] === 'LIMITED' && !empty($w['owner_name'])): ?>
                            <div class="text-xs font-bold text-red-500 mt-4">
                                <i class="fa-solid fa-crown"></i> <?php echo htmlspecialchars($w['owner_name']); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <a href="https://php-waifu-roll.care/index.php?url=home/pool" class="inline-flex items-center justify-center gap-2 w-full py-3 px-6 bg-blue-600 text-white border-2 border-gray-900 rounded-xl font-bold uppercase transition-all shadow-[6px_6px_0px_#ffea00] active:translate-x-[3px] active:translate-y-[3px] active:shadow-[3px_3px_0px_#ffea00] mb-4 text-sm bg-yellow-400 text-gray-900 shadow-[6px_6px_0px_#3d5afe] active:shadow-[3px_3px_0px_#3d5afe] mt-4 mb-0">LIHAT
                SEMUA WAIFU</a>
        </section>

        <!-- Scoreboard Preview -->
        <section class="mb-16">
            <h2 class="text-sm font-black text-blue-600 mb-4"><i class="fa-solid fa-trophy"></i> TOP PLAYERS</h2>
            <div class="bg-white border-2 border-gray-900 rounded-2xl p-6 mb-6 shadow-sm relative p-4">
                <div class="flex flex-col gap-4" style="display: flex; flex-direction: column;">
                    <?php foreach ($rankings as $i => $r): ?>
                        <div class="bg-white border-2 border-gray-900 rounded-2xl p-6 mb-6 shadow-sm relative p-4"
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
                                    <div class="text-xs text-gray-500 mt-05">
                                        <i class="fa-solid fa-heart text-blue-600"></i> <?php echo $r['waifu_count']; ?>
                                        Waifu
                                    </div>
                                </div>
                            </div>

                            <!-- Coins -->
                            <div class="text-right">
                                <div class="text-xs font-black opacity-60">COINS</div>
                                <div class="text-sm font-bold text-red-500"><i class="fa-solid fa-coins"></i>
                                    <?php echo number_format($r['coins'], 0, ',', '.'); ?></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <a href="index.php?url=scoreboard/index" class="inline-flex items-center justify-center gap-2 w-full py-3 px-6 bg-blue-600 text-white border-2 border-gray-900 rounded-xl font-bold uppercase transition-all shadow-[6px_6px_0px_#ffea00] active:translate-x-[3px] active:translate-y-[3px] active:shadow-[3px_3px_0px_#ffea00] mb-4 text-sm bg-yellow-400 text-gray-900 shadow-[6px_6px_0px_#3d5afe] active:shadow-[3px_3px_0px_#3d5afe] mt-4 mb-0">LIHAT SEMUA RANKING</a>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="bg-white border-2 border-gray-900 rounded-2xl p-6 mb-6 shadow-sm relative text-center mb-16" style="background: var(--primary-blue); color: white;">
            <h2 class="mb-05">SIAP GACHA?</h2>
            <p class="text-sm opacity-60 mb-4">Ribuan Waifu Menantimu!</p>
            <a href="index.php?url=auth/register" class="inline-flex items-center justify-center gap-2 w-full py-3 px-6 bg-blue-600 text-white border-2 border-gray-900 rounded-xl font-bold uppercase transition-all shadow-[6px_6px_0px_#ffea00] active:translate-x-[3px] active:translate-y-[3px] active:shadow-[3px_3px_0px_#ffea00] mb-4 text-sm bg-yellow-400 text-gray-900 shadow-[6px_6px_0px_#3d5afe] active:shadow-[3px_3px_0px_#3d5afe] mb-0">GAS DAFTAR GRATIS!</a>
        </section>

        <!-- Suggestion Card -->
        <section class="bg-white border-2 border-gray-900 rounded-2xl p-6 mb-6 shadow-sm relative text-center" style="border-style: dashed; background: rgba(255, 234, 0, 0.1);">
            <h3 class="text-sm font-black mb-05"><i class="fa-solid fa-lightbulb text-blue-600"></i> SARAN WAIFU BARU?
            </h3>
            <p class="text-xs text-gray-500 mb-4">Punya waifu favorit yang belum ada? Kasih tahu kami!</p>
            <a href="https://forms.gle/uV83B7zRbk98sKDr6" target="_blank" class="inline-flex items-center justify-center gap-2 w-full py-3 px-6 bg-blue-600 text-white border-2 border-gray-900 rounded-xl font-bold uppercase transition-all shadow-[6px_6px_0px_#ffea00] active:translate-x-[3px] active:translate-y-[3px] active:shadow-[3px_3px_0px_#ffea00] mb-4 text-sm bg-yellow-400 text-gray-900 shadow-[6px_6px_0px_#3d5afe] active:shadow-[3px_3px_0px_#3d5afe] mb-0 w-auto px-3">ISI
                FORM SARAN</a>
        </section>
    </div>

    <?php include BASE_PATH . '/views/partials/footer.php'; ?>
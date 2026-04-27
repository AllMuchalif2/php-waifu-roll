<?php
$title = "Scoreboard - Waifu Gacha";
include BASE_PATH . '/views/partials/header.php';
?>

<body class="pb-80">
    <?php include BASE_PATH . '/views/partials/navbar.php'; ?>

    <div class="w-full max-w-md mx-auto p-6">
        <h2 class="text-center mt-4 mb-8">RANKING TOP</h2>

        <div class="flex flex-col gap-4" style="display: flex; flex-direction: column;">
            <?php foreach ($rankings as $i => $r): ?>
                <div class="bg-white border-2 border-gray-900 rounded-2xl p-6 mb-6 shadow-sm relative p-4" style="<?php echo ($i < 3) ? 'background: rgba(61, 90, 254, 0.05); border-color: var(--primary-blue);' : ''; ?> display: flex; align-items: center; justify-content: space-between; gap: 0.5rem; margin-bottom: 0;">
                    
                    <div style="display: flex; align-items: center; gap: 1rem; flex: 1;">
                        <!-- Rank -->
                        <div class="font-black text-center" style="width: 30px; font-size: 1.2rem; <?php echo ($i == 0) ? 'color: #fcc419;' : (($i == 1) ? 'color: #adb5bd;' : (($i == 2) ? 'color: #e67e22;' : '')); ?>">
                            <?php if ($i < 3): ?><i class="fa-solid fa-crown" style="font-size: 0.8rem; display: block; margin-bottom: -5px;"></i><?php endif; ?>
                            <?php echo $i + 1; ?>
                        </div>
                        
                        <!-- Player Info -->
                        <div>
                            <div class="text-sm font-bold" style="line-height: 1.2;"><?php echo htmlspecialchars($r['username']); ?></div>
                            <div class="text-xs text-gray-500 mt-05">
                                <i class="fa-solid fa-heart text-blue-600"></i> <?php echo $r['waifu_count']; ?> Waifu
                            </div>
                        </div>
                    </div>
                    
                    <!-- Coins -->
                    <div class="text-right">
                        <div class="text-xs font-black opacity-60">COINS</div>
                        <div class="text-sm font-bold text-red-500"><i class="fa-solid fa-coins"></i> <?php echo number_format($r['coins'], 0, ',', '.'); ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="index.php?url=gacha/index" class="inline-flex items-center justify-center gap-2 w-full py-3 px-6 bg-blue-600 text-white border-2 border-gray-900 rounded-xl font-bold uppercase transition-all shadow-[6px_6px_0px_#ffea00] active:translate-x-[3px] active:translate-y-[3px] active:shadow-[3px_3px_0px_#ffea00] mb-4 text-sm mt-8"><i class="fa-solid fa-house"></i> DASHBOARD</a>
        <?php else: ?>
            <a href="/index.php" class="inline-flex items-center justify-center gap-2 w-full py-3 px-6 bg-blue-600 text-white border-2 border-gray-900 rounded-xl font-bold uppercase transition-all shadow-[6px_6px_0px_#ffea00] active:translate-x-[3px] active:translate-y-[3px] active:shadow-[3px_3px_0px_#ffea00] mb-4 text-sm bg-yellow-400 text-gray-900 shadow-[6px_6px_0px_#3d5afe] active:shadow-[3px_3px_0px_#3d5afe] mt-8"><i class="fa-solid fa-house"></i> BERANDA</a>
        <?php endif; ?>
    </div>

    <?php include BASE_PATH . '/views/partials/footer.php'; ?>
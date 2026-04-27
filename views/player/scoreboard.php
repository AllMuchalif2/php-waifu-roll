<?php
$title = "Scoreboard - Waifu Gacha";
include BASE_PATH . '/views/partials/header.php';
?>

<body class="pb-80">
    <?php include BASE_PATH . '/views/partials/navbar.php'; ?>

    <div class="container">
        <h2 class="text-center mt-1 mb-2">RANKING TOP</h2>

        <div class="flex flex-col gap-1" style="display: flex; flex-direction: column;">
            <?php foreach ($rankings as $i => $r): ?>
                <div class="card p-1" style="<?php echo ($i < 3) ? 'background: rgba(61, 90, 254, 0.05); border-color: var(--primary-blue);' : ''; ?> display: flex; align-items: center; justify-content: space-between; gap: 0.5rem; margin-bottom: 0;">
                    
                    <div style="display: flex; align-items: center; gap: 1rem; flex: 1;">
                        <!-- Rank -->
                        <div class="font-black text-center" style="width: 30px; font-size: 1.2rem; <?php echo ($i == 0) ? 'color: #fcc419;' : (($i == 1) ? 'color: #adb5bd;' : (($i == 2) ? 'color: #e67e22;' : '')); ?>">
                            <?php if ($i < 3): ?><i class="fa-solid fa-crown" style="font-size: 0.8rem; display: block; margin-bottom: -5px;"></i><?php endif; ?>
                            <?php echo $i + 1; ?>
                        </div>
                        
                        <!-- Player Info -->
                        <div>
                            <div class="text-sm font-bold" style="line-height: 1.2;"><?php echo htmlspecialchars($r['username']); ?></div>
                            <div class="text-xs text-muted mt-05">
                                <i class="fa-solid fa-heart color-primary"></i> <?php echo $r['waifu_count']; ?> Waifu
                            </div>
                        </div>
                    </div>
                    
                    <!-- Coins -->
                    <div class="text-right">
                        <div class="text-xs font-black opacity-06">COINS</div>
                        <div class="text-sm font-bold color-danger"><i class="fa-solid fa-coins"></i> <?php echo number_format($r['coins'], 0, ',', '.'); ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="index.php?url=gacha/index" class="btn mt-2"><i class="fa-solid fa-house"></i> DASHBOARD</a>
        <?php else: ?>
            <a href="/index.php" class="btn btn-secondary mt-2"><i class="fa-solid fa-house"></i> BERANDA</a>
        <?php endif; ?>
    </div>

    <?php include BASE_PATH . '/views/partials/footer.php'; ?>
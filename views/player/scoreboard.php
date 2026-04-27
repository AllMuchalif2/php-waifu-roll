<?php
$title = "Scoreboard - Waifu Gacha";
include BASE_PATH . '/views/partials/header.php';
?>

<body class="pb-80">
    <?php include BASE_PATH . '/views/partials/navbar.php'; ?>

    <div class="container">
        <h2 class="text-center mt-1 mb-2">RANKING TOP</h2>

        <div class="card p-0" style="overflow: hidden;">
            <table class="ranking-table w-full">
                <thead>
                    <tr>
                        <th style="width: 50px;">#</th>
                        <th>NAME</th>
                        <th class="text-center">WAIFU</th>
                        <th class="text-right">COINS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rankings as $i => $r): ?>
                        <tr style="<?php echo ($i < 3) ? 'background: rgba(61, 90, 254, 0.05);' : ''; ?>">
                            <td class="font-black text-center"
                                style="<?php echo ($i == 0) ? 'color: #fcc419;' : (($i == 1) ? 'color: #adb5bd;' : (($i == 2) ? 'color: #e67e22;' : '')); ?>">
                                <?php if ($i < 3): ?><i class="fa-solid fa-crown"></i> <?php endif; ?>
                                <?php echo $i + 1; ?>
                            </td>
                            <td class="text-sm font-bold"><?php echo htmlspecialchars($r['username']); ?></td>
                            <td class="text-center text-sm"><i class="fa-solid fa-heart color-primary"></i>
                                <?php echo $r['waifu_count']; ?></td>
                            <td class="text-right text-sm font-bold color-danger"><?php echo $r['coins']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="index.php?url=gacha/index" class="btn mt-2"><i class="fa-solid fa-house"></i> DASHBOARD</a>
        <?php else: ?>
            <a href="/index.php" class="btn btn-secondary mt-2"><i class="fa-solid fa-house"></i> BERANDA</a>
        <?php endif; ?>
    </div>

    <?php include BASE_PATH . '/views/partials/footer.php'; ?>
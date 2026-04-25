<?php 
$title = "Scoreboard - Waifu Gacha";
include BASE_PATH . '/views/partials/header.php'; 
?>

<body>
    <?php include BASE_PATH . '/views/partials/navbar.php'; ?>

    <div class="container">
        <h1>TOP PLAYERS</h1>
        
        <div class="result-box">
            <table class="ranking-table">
                <thead>
                    <tr class="border-b-3">
                        <th>#</th>
                        <th>NAME</th>
                        <th>WAIFU</th>
                        <th>COINS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rankings as $i => $r): ?>
                    <tr class="ranking-row <?php echo ($i < 3) ? 'top-ranking-row' : ''; ?>">
                        <td class="font-black"><?php echo $i + 1; ?></td>
                        <td class="font-black text-uppercase"><?php echo htmlspecialchars($r['username']); ?></td>
                        <td><i class="fa-solid fa-heart color-accent1"></i> <?php echo $r['waifu_count']; ?></td>
                        <td><i class="fa-solid fa-coins color-accent2"></i> <?php echo $r['coins']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="index.php?url=gacha/index" class="btn"><i class="fa-solid fa-gauge-high"></i> BALIK KE DASHBOARD</a>
        <?php else: ?>
            <a href="/index.php" class="btn btn-secondary"><i class="fa-solid fa-house"></i> KEMBALI KE BERANDA</a>
        <?php endif; ?>
    </div>

    <?php include BASE_PATH . '/views/partials/footer.php'; ?>

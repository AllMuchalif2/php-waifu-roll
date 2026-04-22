<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Waifu Gacha</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body style="padding-bottom: 80px;"> <!-- Padding for bottom nav if needed -->
    <div class="container">
        <!-- Profile Header -->
        <div class="result-box" style="display: flex; justify-content: space-between; align-items: center; padding: 1rem; margin-top: 1rem;">
            <div style="font-weight: 900; font-size: 1.2rem; text-transform: uppercase;">
                <i class="fa-solid fa-user"></i> <?php echo htmlspecialchars($user['username']); ?>
            </div>
            <div style="font-weight: 700;">
                <span style="color: var(--accent2);"><i class="fa-solid fa-coins"></i> <?php echo $user['coins']; ?></span>
                <span style="margin: 0 0.5rem;">|</span>
                <span style="color: var(--accent1);"><i class="fa-solid fa-dice"></i> <?php echo $user['dice_count']; ?></span>
            </div>
        </div>

        <!-- Quick Actions -->
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 2rem;">
            <a href="index.php?url=gacha/roll" class="btn"><i class="fa-solid fa-dice"></i> GACHA!</a>
            <a href="index.php?url=scoreboard/index" class="btn btn-secondary"><i class="fa-solid fa-trophy"></i> RANK</a>
        </div>

        <h2 style="text-align: left; font-size: 1.5rem;"><i class="fa-solid fa-box-open"></i> KOLEKSI</h2>
        
        <!-- Collection Grid -->
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(140px, 1fr)); gap: 1rem;">
            <?php foreach ($waifus as $w): ?>
                <div class="result-box" style="padding: 0.5rem; min-height: auto; margin-bottom: 0;">
                    <div class="tier-badge tier-<?php echo strtolower($w['tier']); ?>" style="position: absolute; top: 5px; right: 5px; padding: 2px 6px; font-size: 0.7rem; z-index: 2;">
                        x<?php echo $w['total']; ?>
                    </div>
                    <img src="<?php echo htmlspecialchars($w['image_url']); ?>" loading="lazy" class="waifu-img" style="margin-top: 0; width: 100%; border-width: 3px;">
                    <div style="font-size: 0.9rem; margin-top: 0.5rem; font-weight: 900; line-height: 1.2;">
                        <?php echo htmlspecialchars($w['name']); ?>
                    </div>
                    <div style="font-size: 0.8rem; font-weight: 900;" class="tier-<?php echo strtolower($w['tier']); ?>-text">
                        [<?php echo htmlspecialchars($w['tier']); ?>]
                    </div>
                </div>
            <?php endforeach; ?>
            
            <?php if (empty($waifus)): ?>
                <p style="grid-column: 1/-1; text-align: center; opacity: 0.6; padding: 2rem;">Belum punya waifu... Ayo gacha!</p>
            <?php endif; ?>
        </div>

        <a href="index.php?url=auth/logout" class="btn" style="margin-top: 3rem; background: #555;"><i class="fa-solid fa-right-from-bracket"></i> LOGOUT</a>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scoreboard - Waifu Gacha</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <h1>TOP PLAYERS</h1>
        
        <div class="result-box">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="border-bottom: 3px solid black;">
                        <th style="padding: 0.8rem;">#</th>
                        <th style="padding: 0.8rem;">NAME</th>
                        <th style="padding: 0.8rem;">WAIFU</th>
                        <th style="padding: 0.8rem;">COINS</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rankings as $i => $r): ?>
                    <tr style="border-bottom: 2px solid rgba(0,0,0,0.1); <?php echo ($i < 3) ? 'background: rgba(255,255,255,0.1);' : ''; ?>">
                        <td style="padding: 0.8rem; font-weight: 900;"><?php echo $i + 1; ?></td>
                        <td style="padding: 0.8rem; font-weight: 900; text-transform: uppercase;"><?php echo htmlspecialchars($r['username']); ?></td>
                        <td style="padding: 0.8rem;"><i class="fa-solid fa-heart" style="color: var(--accent1);"></i> <?php echo $r['waifu_count']; ?></td>
                        <td style="padding: 0.8rem;"><i class="fa-solid fa-coins" style="color: var(--accent2);"></i> <?php echo $r['coins']; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <a href="index.php?url=gacha/index" class="btn">BALIK KE DASHBOARD</a>
    </div>
</body>
</html>

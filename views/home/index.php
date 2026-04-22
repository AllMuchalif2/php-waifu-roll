<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waifu Gacha - Koleksi Waifu Impianmu!</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Navbar / Hero Section -->
    <header style="padding: 4rem 1rem; text-align: center; background: var(--secondary); border-bottom: 8px solid var(--black); margin-bottom: 3rem;">
        <div class="container">
            <h1 style="font-size: 3.5rem; margin-bottom: 1rem;">WAIFU GACHA!</h1>
            <p style="font-size: 1.2rem; font-weight: 700; text-transform: uppercase; margin-bottom: 2rem;">Kumpulkan waifu favoritmu dan jadilah nomor satu!</p>
            <div style="display: flex; gap: 1rem; justify-content: center;">
                <a href="index.php?url=auth/login" class="btn" style="width: auto; padding: 1rem 3rem;">LOGIN</a>
                <a href="index.php?url=auth/register" class="btn btn-secondary" style="width: auto; padding: 1rem 3rem;">DAFTAR</a>
            </div>
        </div>
    </header>

    <div class="container">
        <!-- Top Waifus Section -->
        <section style="margin-bottom: 4rem;">
            <h2 style="font-size: 2rem;"><i class="fa-solid fa-fire"></i> TOP WAIFUS</h2>
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 1.5rem;">
                <?php foreach ($topWaifus as $w): ?>
                    <div class="result-box" style="padding: 0.5rem; min-height: auto; border-color: var(--black);">
                        <div class="tier-badge tier-<?php echo strtolower($w['tier']); ?>" style="position: absolute; top: -10px; right: -10px; transform: rotate(10deg); font-size: 0.8rem; z-index: 2;">
                            <?php echo $w['tier']; ?>
                        </div>
                        <img src="<?php echo htmlspecialchars($w['image_url']); ?>" class="waifu-img" style="margin-top: 0; width: 100%; border-width: 3px;">
                        <div style="font-size: 1rem; margin-top: 0.5rem; font-weight: 900;"><?php echo htmlspecialchars($w['name']); ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Scoreboard Preview -->
        <section style="margin-bottom: 4rem;">
            <h2><i class="fa-solid fa-trophy"></i> TOP PLAYERS</h2>
            <div class="result-box">
                <table style="width: 100%; border-collapse: collapse; text-align: left;">
                    <thead>
                        <tr style="border-bottom: 4px solid black;">
                            <th style="padding: 1rem;">#</th>
                            <th style="padding: 1rem;">PLAYER</th>
                            <th style="padding: 1rem;">WAIFU</th>
                            <th style="padding: 1rem;">COINS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rankings as $i => $r): ?>
                        <tr style="border-bottom: 2px solid rgba(0,0,0,0.1);">
                            <td style="padding: 1rem; font-weight: 900;"><?php echo $i + 1; ?></td>
                            <td style="padding: 1rem; font-weight: 900; text-transform: uppercase;"><?php echo htmlspecialchars($r['username']); ?></td>
                            <td style="padding: 1rem;"><i class="fa-solid fa-heart" style="color: var(--accent1);"></i> <?php echo $r['waifu_count']; ?></td>
                            <td style="padding: 1rem;"><i class="fa-solid fa-coins" style="color: var(--accent2);"></i> <?php echo $r['coins']; ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <a href="index.php?url=scoreboard/index" class="btn btn-secondary" style="margin-top: 1.5rem;">LIHAT SEMUA PERINGKAT</a>
            </div>
        </section>

        <!-- CTA Section -->
        <section style="text-align: center; padding: 4rem 1rem; background: var(--accent1); border: 8px solid var(--black); box-shadow: 10px 10px 0px var(--black); margin-bottom: 4rem;">
            <h2 style="text-shadow: none; color: black; margin-bottom: 1rem;">SIAP GACHA SEKARANG?</h2>
            <p style="color: black; font-weight: 700; margin-bottom: 2rem;">Ribuan waifu menunggu untuk kamu koleksi!</p>
            <a href="index.php?url=auth/register" class="btn" style="background: var(--white); color: var(--black); border-color: var(--black);">GAS DAFTAR GRATIS!</a>
        </section>
    </div>

    <footer style="text-align: center; padding: 2rem; border-top: 4px solid var(--black); opacity: 0.8;">
        <p>&copy; 2026 WAIFU GACHA - ALL RIGHTS RESERVED</p>
    </footer>
</body>
</html>

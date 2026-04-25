<h1><i class="fa-solid fa-gauge-high"></i> DASHBOARD ADMIN</h1>

<div class="result-box text-left" style="border-left: 10px solid var(--accent2);">
    <h2>SELAMAT DATANG, <?php echo htmlspecialchars($admin['username']); ?>!</h2>
    <p>TERAKHIR LOGIN: <span class="color-accent2 font-black"><?php echo htmlspecialchars($admin['last_login'] ?? 'BARU SAJA'); ?></span></p>
</div>

<!-- Stats Overview -->
<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-top: 1rem;">
    <div class="result-box text-center bg-white color-black">
        <h1 style="font-size: 3rem; margin-bottom: 0;" class="color-black no-shadow"><?php echo $stats['total_waifus']; ?></h1>
        <p class="font-black opacity-06">TOTAL WAIFU</p>
    </div>
    <div class="result-box text-center bg-white color-black">
        <h1 style="font-size: 3rem; margin-bottom: 0;" class="color-black no-shadow"><?php echo $stats['total_players']; ?></h1>
        <p class="font-black opacity-06">TOTAL PLAYER</p>
    </div>
</div>

<div class="result-box mt-1 text-left">
    <h3><i class="fa-solid fa-chart-pie"></i> TIER BREAKDOWN</h3>
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(130px, 1fr)); gap: 1rem; margin-top: 1rem;">
        <?php foreach ($stats['tiers'] as $tier => $count): ?>
            <div class="bg-white color-black p-1 border-3 border-black" style="box-shadow: 4px 4px 0px var(--black);">
                <div class="tier-badge tier-<?php echo strtolower($tier); ?> d-block mb-05 text-center"><?php echo $tier; ?></div>
                <div class="text-2xl font-black no-shadow"><?php echo $count; ?></div>
                <div class="text-xs opacity-06 font-black">WAIFUS</div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="quick-actions mt-2">
    <div class="result-box flex-between" style="flex-direction: column;">
        <div>
            <h3><i class="fa-solid fa-heart"></i> KELOLA WAIFU</h3>
            <p class="text-sm opacity-08 mb-1">Tambah, edit, hapus, atau fetch waifu dari Jikan API.</p>
        </div>
        <a href="index.php?url=admin/waifus" class="btn mb-0">GAS KELOLA</a>
    </div>
    <div class="result-box flex-between" style="flex-direction: column;">
        <div>
            <h3><i class="fa-solid fa-trophy"></i> SCOREBOARD</h3>
            <p class="text-sm opacity-08 mb-1">Lihat peringkat pemain saat ini.</p>
        </div>
        <a href="index.php?url=scoreboard/index" class="btn btn-secondary mb-0">LIHAT RANK</a>
    </div>
</div>

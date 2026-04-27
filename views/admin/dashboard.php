<h2 class="mb-2"><i class="fa-solid fa-gauge-high"></i> DASHBOARD ADMIN</h2>

<div class="card p-2" style="border-left: 8px solid var(--primary-blue);">
    <h3 class="mb-05">SELAMAT DATANG, <?php echo htmlspecialchars($admin['username']); ?>!</h3>
    <p class="text-sm text-muted">Terakhir login: <span
            class="font-bold color-primary"><?php echo htmlspecialchars($admin['last_login'] ?? 'Baru saja'); ?></span>
    </p>
</div>

<!-- Stats Overview -->
<div
    style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
    <div class="card text-center p-2">
        <div style="font-size: 3rem; font-weight: 800; line-height: 1;" class="color-primary">
            <?php echo $stats['total_waifus']; ?></div>
        <p class="text-xs font-black opacity-06 text-uppercase">Total Waifu</p>
    </div>
    <div class="card text-center p-2">
        <div style="font-size: 3rem; font-weight: 800; line-height: 1;" class="color-danger">
            <?php echo $stats['total_players']; ?></div>
        <p class="text-xs font-black opacity-06 text-uppercase">Total Player</p>
    </div>
</div>

<div class="card p-2 mb-2">
    <h3 class="text-sm font-black mb-1"><i class="fa-solid fa-chart-pie"></i> TIER BREAKDOWN</h3>
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(100px, 1fr)); gap: 1rem;">
        <?php
        $allTiers = ['C', 'B', 'A', 'R', 'S', 'SR', 'SSR', 'UR', 'LIMITED'];
        foreach ($allTiers as $tier):
            $count = $stats['tiers'][$tier];
            ?>
            <div class="text-center p-1"
                style="background: var(--bg-light); border-radius: 12px; border: 1px solid var(--text-dark);">
                <div class="tier-badge tier-<?php echo strtolower($tier); ?>"
                    style="position: static; display: inline-block; margin-bottom: 5px;"><?php echo $tier; ?></div>
                <div class="font-black" style="font-size: 1.5rem;"><?php echo $count; ?></div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="flex gap-1" style="flex-wrap: wrap;">
    <div class="card p-1" style="flex: 1; min-width: 250px;">
        <h3 class="text-sm mb-05"><i class="fa-solid fa-heart color-primary"></i> KELOLA WAIFU</h3>
        <p class="text-xs text-muted mb-1">Tambah, edit, hapus, atau fetch waifu dari Jikan API.</p>
        <a href="index.php?url=admin/waifus" class="btn mb-0" style="padding: 0.6rem;">KELOLA SEKARANG</a>
    </div>
    <div class="card p-1" style="flex: 1; min-width: 250px;">
        <h3 class="text-sm mb-05"><i class="fa-solid fa-trophy color-danger"></i> SCOREBOARD</h3>
        <p class="text-xs text-muted mb-1">Lihat peringkat pemain saat ini secara real-time.</p>
        <a href="index.php?url=scoreboard/index" class="btn btn-secondary mb-0" style="padding: 0.6rem;">LIHAT RANK</a>
    </div>
</div>
<h2 class="mb-8"><i class="fa-solid fa-gauge-high"></i> DASHBOARD ADMIN</h2>

<div class="bg-white border-2 border-gray-900 rounded-2xl p-6 mb-6 shadow-sm relative p-8" style="border-left: 8px solid var(--primary-blue);">
    <h3 class="mb-05">SELAMAT DATANG, <?php echo htmlspecialchars($admin['username']); ?>!</h3>
    <p class="text-sm text-gray-500">Terakhir login: <span
            class="font-bold text-blue-600"><?php echo htmlspecialchars($admin['last_login'] ?? 'Baru saja'); ?></span>
    </p>
</div>

<!-- Stats Overview -->
<div
    style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1rem; margin-bottom: 2rem;">
    <div class="bg-white border-2 border-gray-900 rounded-2xl p-6 mb-6 shadow-sm relative text-center p-8">
        <div style="font-size: 3rem; font-weight: 800; line-height: 1;" class="text-blue-600">
            <?php echo $stats['total_waifus']; ?></div>
        <p class="text-xs font-black opacity-60 text-uppercase">Total Waifu</p>
    </div>
    <div class="bg-white border-2 border-gray-900 rounded-2xl p-6 mb-6 shadow-sm relative text-center p-8">
        <div style="font-size: 3rem; font-weight: 800; line-height: 1;" class="text-red-500">
            <?php echo $stats['total_players']; ?></div>
        <p class="text-xs font-black opacity-60 text-uppercase">Total Player</p>
    </div>
</div>

<div class="bg-white border-2 border-gray-900 rounded-2xl p-6 mb-6 shadow-sm relative p-8 mb-8">
    <h3 class="text-sm font-black mb-4"><i class="fa-solid fa-chart-pie"></i> TIER BREAKDOWN</h3>
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(100px, 1fr)); gap: 1rem;">
        <?php
        $allTiers = ['C', 'B', 'A', 'R', 'S', 'SR', 'SSR', 'UR', 'LIMITED'];
        foreach ($allTiers as $tier):
            $count = $stats['tiers'][$tier];
            ?>
            <div class="text-center p-4"
                style="background: var(--bg-light); border-radius: 12px; border: 1px solid var(--text-dark);">
                <div class="absolute top-2 right-2 px-2 py-1 rounded-md text-[10px] font-black text-white border border-gray-900 z-10 tier-<?php echo strtolower($tier); ?>"
                    style="position: static; display: inline-block; margin-bottom: 5px;"><?php echo $tier; ?></div>
                <div class="font-black" style="font-size: 1.5rem;"><?php echo $count; ?></div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="flex gap-4" style="flex-wrap: wrap;">
    <div class="bg-white border-2 border-gray-900 rounded-2xl p-6 mb-6 shadow-sm relative p-4" style="flex: 1; min-width: 250px;">
        <h3 class="text-sm mb-05"><i class="fa-solid fa-heart text-blue-600"></i> KELOLA WAIFU</h3>
        <p class="text-xs text-gray-500 mb-4">Tambah, edit, hapus, atau fetch waifu dari Jikan API.</p>
        <a href="index.php?url=admin/waifus" class="inline-flex items-center justify-center gap-2 w-full py-3 px-6 bg-blue-600 text-white border-2 border-gray-900 rounded-xl font-bold uppercase transition-all shadow-[6px_6px_0px_#ffea00] active:translate-x-[3px] active:translate-y-[3px] active:shadow-[3px_3px_0px_#ffea00] mb-4 text-sm mb-0" style="padding: 0.6rem;">KELOLA SEKARANG</a>
    </div>
    <div class="bg-white border-2 border-gray-900 rounded-2xl p-6 mb-6 shadow-sm relative p-4" style="flex: 1; min-width: 250px;">
        <h3 class="text-sm mb-05"><i class="fa-solid fa-trophy text-red-500"></i> SCOREBOARD</h3>
        <p class="text-xs text-gray-500 mb-4">Lihat peringkat pemain saat ini secara real-time.</p>
        <a href="index.php?url=scoreboard/index" class="inline-flex items-center justify-center gap-2 w-full py-3 px-6 bg-blue-600 text-white border-2 border-gray-900 rounded-xl font-bold uppercase transition-all shadow-[6px_6px_0px_#ffea00] active:translate-x-[3px] active:translate-y-[3px] active:shadow-[3px_3px_0px_#ffea00] mb-4 text-sm bg-yellow-400 text-gray-900 shadow-[6px_6px_0px_#3d5afe] active:shadow-[3px_3px_0px_#3d5afe] mb-0" style="padding: 0.6rem;">LIHAT RANK</a>
    </div>
</div>
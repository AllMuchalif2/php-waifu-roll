<h1><i class="fa-solid fa-gauge-high"></i> DASHBOARD ADMIN</h1>

<div class="result-box" style="text-align: left; border-left: 10px solid var(--accent2);">
    <h2>SELAMAT DATANG, <?php echo htmlspecialchars($admin['username']); ?>!</h2>
    <p>TERAKHIR LOGIN: <span style="color: var(--accent2); font-weight: 900;"><?php echo htmlspecialchars($admin['last_login'] ?? 'BARU SAJA'); ?></span></p>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem; margin-top: 2rem;">
    <div class="result-box" style="display: flex; flex-direction: column; justify-content: space-between;">
        <div>
            <h3><i class="fa-solid fa-heart"></i> KELOLA WAIFU</h3>
            <p style="font-size: 0.9rem; opacity: 0.8; margin-bottom: 1rem;">Tambah, edit, hapus, atau fetch waifu dari Jikan API.</p>
        </div>
        <a href="index.php?url=admin/waifus" class="btn">GAS KELOLA</a>
    </div>
    <div class="result-box" style="display: flex; flex-direction: column; justify-content: space-between;">
        <div>
            <h3><i class="fa-solid fa-trophy"></i> SCOREBOARD</h3>
            <p style="font-size: 0.9rem; opacity: 0.8; margin-bottom: 1rem;">Lihat peringkat pemain saat ini.</p>
        </div>
        <a href="index.php?url=scoreboard/index" class="btn btn-secondary">LIHAT RANK</a>
    </div>
</div>

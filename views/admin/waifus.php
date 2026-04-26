<h2 class="mb-2">KELOLA WAIFU</h2>

<!-- Messages -->
<?php include BASE_PATH . '/views/partials/messages.php'; ?>

<!-- Fetch & Add Section -->
<div class="card p-2 mb-2">
    <h3 class="text-sm font-black mb-1"><i class="fa-solid fa-search color-primary"></i> CARI WAIFU (JIKAN API)</h3>
    <div style="display: flex; gap: 0.5rem; margin-bottom: 1rem;">
        <input type="text" id="search_query" placeholder="Ketik nama waifu..." class="mb-0">
        <button onclick="searchWaifu()" class="btn w-auto mb-0" style="padding: 0 1.5rem;">CARI</button>
    </div>
    <div id="search_results" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(100px, 1fr)); gap: 1rem; margin-top: 1rem;">
        <!-- Search results will appear here -->
    </div>
</div>

<div class="card p-2 mb-2">
    <h3 class="text-sm font-black mb-1"><i class="fa-solid fa-plus-circle color-primary"></i> FETCH BY ID / TAMBAH</h3>
    <div style="display: flex; gap: 0.5rem; margin-bottom: 1.5rem;">
        <input type="number" id="jikan_id_input" placeholder="MAL ID" class="mb-0">
        <button onclick="fetchWaifu()" class="btn w-auto mb-0" style="padding: 0 1.5rem;">FETCH</button>
    </div>
    
    <form action="index.php?url=admin/addWaifu" method="POST" id="add_waifu_form" style="display: none;">
        <input type="hidden" name="jikan_id" id="form_jikan_id">
        <div class="flex gap-1 mb-1" style="align-items: flex-start;">
            <div style="flex: 1;">
                <label class="text-xs font-black">NAMA WAIFU</label>
                <input type="text" name="name" id="form_name" required>
                <label class="text-xs font-black">TIER</label>
                <select name="tier">
                    <option value="C">C</option>
                    <option value="B">B</option>
                    <option value="A">A</option>
                    <option value="R">R</option>
                    <option value="S">S</option>
                    <option value="SR">SR</option>
                    <option value="SSR">SSR</option>
                    <option value="UR">UR</option>
                    <option value="LIMITED">LIMITED (1 UNIQUE)</option>
                </select>
            </div>
            <div style="width: 100px;">
                <img id="preview_img" src="" class="waifu-img" style="display: none;">
                <input type="hidden" name="image_url" id="form_image_url">
            </div>
        </div>
        <button type="submit" class="btn w-full mb-0">SIMPAN WAIFU BARU</button>
    </form>
</div>

<!-- Edit Form (Hidden by default) -->
<div id="edit_section" class="card p-2 mb-2" style="display: none; border-color: var(--primary-blue);">
    <h3 class="text-sm font-black mb-1 color-primary"><i class="fa-solid fa-edit"></i> EDIT WAIFU</h3>
    <form action="index.php?url=admin/updateWaifu" method="POST">
        <input type="hidden" name="id" id="edit_id">
        <label class="text-xs font-black">NAMA WAIFU</label>
        <input type="text" name="name" id="edit_name" required>
        <label class="text-xs font-black">TIER</label>
        <select name="tier" id="edit_tier">
            <option value="C">C</option>
            <option value="B">B</option>
            <option value="A">A</option>
            <option value="R">R</option>
            <option value="S">S</option>
            <option value="SR">SR</option>
            <option value="SSR">SSR</option>
            <option value="UR">UR</option>
            <option value="LIMITED">LIMITED (1 UNIQUE)</option>
        </select>
        <div class="flex gap-05">
            <button type="submit" class="btn" style="flex: 2;">UPDATE DATA</button>
            <button type="button" onclick="cancelEdit()" class="btn btn-secondary w-auto" style="flex: 1;">BATAL</button>
        </div>
    </form>
</div>

<!-- List Section -->
<div class="card p-2 mb-2">
    <h3 class="text-sm font-black mb-1"><i class="fa-solid fa-filter color-primary"></i> FILTER & SORT</h3>
    <form action="index.php" method="GET" style="display: flex; flex-direction: column; gap: 0.8rem;">
        <input type="hidden" name="url" value="admin/waifus">
        
        <div>
            <label class="text-xs font-black">CARI NAMA</label>
            <input type="text" name="search" value="<?php echo htmlspecialchars($filters['search']); ?>" placeholder="..." class="mb-0">
        </div>

        <div class="flex gap-05">
            <div style="flex: 1;">
                <label class="text-xs font-black">TIER</label>
                <select name="tier" class="mb-0">
                    <option value="">SEMUA</option>
                    <option value="C" <?php echo $filters['tier'] == 'C' ? 'selected' : ''; ?>>C</option>
                    <option value="B" <?php echo $filters['tier'] == 'B' ? 'selected' : ''; ?>>B</option>
                    <option value="A" <?php echo $filters['tier'] == 'A' ? 'selected' : ''; ?>>A</option>
                    <option value="R" <?php echo $filters['tier'] == 'R' ? 'selected' : ''; ?>>R</option>
                    <option value="S" <?php echo $filters['tier'] == 'S' ? 'selected' : ''; ?>>S</option>
                    <option value="SR" <?php echo $filters['tier'] == 'SR' ? 'selected' : ''; ?>>SR</option>
                    <option value="SSR" <?php echo $filters['tier'] == 'SSR' ? 'selected' : ''; ?>>SSR</option>
                    <option value="UR" <?php echo $filters['tier'] == 'UR' ? 'selected' : ''; ?>>UR</option>
                    <option value="LIMITED" <?php echo $filters['tier'] == 'LIMITED' ? 'selected' : ''; ?>>LIMITED</option>
                </select>
            </div>

            <div style="flex: 1;">
                <label class="text-xs font-black">URUTKAN</label>
                <select name="sort" class="mb-0">
                    <option value="id" <?php echo $filters['sort'] == 'id' ? 'selected' : ''; ?>>TERBARU</option>
                    <option value="name" <?php echo $filters['sort'] == 'name' ? 'selected' : ''; ?>>NAMA</option>
                    <option value="tier" <?php echo $filters['sort'] == 'tier' ? 'selected' : ''; ?>>TIER</option>
                </select>
            </div>
        </div>

        <div class="flex gap-05">
            <button type="submit" class="btn mb-0" style="flex: 2;">GAS FILTER</button>
            <a href="index.php?url=admin/waifus" class="btn btn-secondary mb-0" style="flex: 1; padding: 0.6rem;"><i class="fa-solid fa-rotate-left"></i></a>
        </div>
    </form>
</div>

<div class="card p-1">
    <h3 class="text-sm font-black mb-1 px-1 pt-1"><i class="fa-solid fa-list color-primary"></i> POOL WAIFU</h3>
    <div style="overflow-x: auto;">
        <table class="ranking-table">
            <thead>
                <tr>
                    <th>FOTO</th>
                    <th>NAMA & MAL ID</th>
                    <th>TIER</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($waifus as $w): ?>
                <tr>
                    <td style="padding: 0.5rem;">
                        <img src="<?php echo $w['image_url']; ?>" style="width: 50px; height: 50px; border-radius: 8px; border: 1px solid var(--text-dark); object-fit: cover;">
                    </td>
                    <td>
                        <div class="text-sm font-black"><?php echo htmlspecialchars($w['name']); ?></div>
                        <div class="text-xs text-muted">ID: <?php echo $w['jikan_id']; ?></div>
                    </td>
                    <td>
                        <span class="tier-badge tier-<?php echo strtolower($w['tier']); ?>" style="position: static;">
                            <?php echo $w['tier']; ?>
                        </span>
                    </td>
                    <td>
                        <div class="flex gap-05">
                            <button onclick="editWaifu(<?php echo htmlspecialchars(json_encode($w)); ?>)" class="btn btn-secondary mb-0" style="padding: 0.4rem; font-size: 0.8rem; flex: 1;"><i class="fa-solid fa-pen"></i></button>
                            <a href="index.php?url=admin/deleteWaifu&id=<?php echo $w['id']; ?>" onclick="return confirm('Hapus waifu ini?')" class="btn btn-danger mb-0" style="padding: 0.4rem; font-size: 0.8rem; flex: 1;"><i class="fa-solid fa-trash"></i></a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="flex-center mt-2 mb-1 gap-05">
        <?php if ($pagination['total_pages'] > 1): ?>
            <?php 
                $queryParams = $_GET; 
                unset($queryParams['url']);
            ?>

            <?php if ($pagination['current_page'] > 1): ?>
                <?php $queryParams['page'] = $pagination['current_page'] - 1; ?>
                <a href="index.php?url=admin/waifus&<?php echo http_build_query($queryParams); ?>" class="btn btn-secondary w-auto mb-0" style="padding: 0.4rem 0.8rem;">PREV</a>
            <?php endif; ?>

            <div class="text-xs font-black">
                PAGE <?php echo $pagination['current_page']; ?> / <?php echo $pagination['total_pages']; ?>
            </div>

            <?php if ($pagination['current_page'] < $pagination['total_pages']): ?>
                <?php $queryParams['page'] = $pagination['current_page'] + 1; ?>
                <a href="index.php?url=admin/waifus&<?php echo http_build_query($queryParams); ?>" class="btn btn-secondary w-auto mb-0" style="padding: 0.4rem 0.8rem;">NEXT</a>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>

<script>
// Trigger search on Enter
document.getElementById('search_query').addEventListener('keydown', function(e) {
    if (e.key === 'Enter') searchWaifu();
});

// Trigger fetch on Enter
document.getElementById('jikan_id_input').addEventListener('keydown', function(e) {
    if (e.key === 'Enter') fetchWaifu();
});

function searchWaifu() {
    const query = document.getElementById('search_query').value;
    const resultsDiv = document.getElementById('search_results');
    if (!query) return;
    
    resultsDiv.innerHTML = '<p class="text-xs">Mencari...</p>';
    
    fetch(`index.php?url=admin/searchWaifu&query=${encodeURIComponent(query)}`)
        .then(res => res.json())
        .then(data => {
            resultsDiv.innerHTML = '';
            if (data && data.length > 0) {
                data.forEach(item => {
                    const div = document.createElement('div');
                    div.className = 'waifu-card-mini';
                    div.style.padding = '0.4rem';
                    div.style.cursor = 'pointer';
                    div.innerHTML = `
                        <img src="${item.images.jpg.image_url}" class="waifu-img" style="margin-bottom: 4px;">
                        <div class="text-xs font-black" style="font-size: 0.6rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">${item.name}</div>
                    `;
                    div.onclick = () => {
                        document.getElementById('jikan_id_input').value = item.mal_id;
                        fetchWaifu();
                        window.scrollTo({ top: document.getElementById('jikan_id_input').offsetTop - 20, behavior: 'smooth' });
                    };
                    resultsDiv.appendChild(div);
                });
            } else {
                resultsDiv.innerHTML = '<p class="text-xs">Tidak ada hasil.</p>';
            }
        })
        .catch(err => resultsDiv.innerHTML = '<p class="text-xs">Error searching!</p>');
}

function fetchWaifu() {
    const id = document.getElementById('jikan_id_input').value;
    if (!id) return;
    
    fetch(`index.php?url=admin/fetchWaifu&jikan_id=${id}`)
        .then(res => res.json())
        .then(data => {
            if (data) {
                document.getElementById('form_jikan_id').value = data.jikan_id;
                document.getElementById('form_name').value = data.name;
                document.getElementById('form_image_url').value = data.image_url;
                document.getElementById('preview_img').src = data.image_url;
                document.getElementById('preview_img').style.display = 'block';
                document.getElementById('add_waifu_form').style.display = 'block';
            } else {
                alert('Waifu tidak ditemukan!');
            }
        })
        .catch(err => alert('Error fetching data!'));
}

function editWaifu(waifu) {
    document.getElementById('edit_section').style.display = 'block';
    document.getElementById('edit_id').value = waifu.id;
    document.getElementById('edit_name').value = waifu.name;
    document.getElementById('edit_tier').value = waifu.tier;
    window.scrollTo({ top: document.getElementById('edit_section').offsetTop - 20, behavior: 'smooth' });
}

function cancelEdit() {
    document.getElementById('edit_section').style.display = 'none';
}
</script>

<h1>KELOLA WAIFU</h1>

<!-- Fetch & Add Section -->
<div class="result-box" style="text-align: left;">
    <h2><i class="fa-solid fa-search"></i> CARI WAIFU (BY NAME)</h2>
    <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
        <input type="text" id="search_query" placeholder="Ketik nama waifu (e.g. Mikasa, Rem...)" style="margin-bottom: 0; flex: 1;">
        <button onclick="searchWaifu()" class="btn" style="margin-bottom: 0; width: auto;">CARI</button>
    </div>
    <div id="search_results" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(120px, 1fr)); gap: 1rem; margin-top: 1rem;">
        <!-- Search results will appear here -->
    </div>
</div>

<div class="result-box" style="text-align: left;">
    <h2><i class="fa-solid fa-plus-circle"></i> TAMBAH MANUAL / FETCH BY ID</h2>
    <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
        <input type="number" id="jikan_id_input" placeholder="JIKAN ID (MAL ID)" style="margin-bottom: 0; flex: 1;">
        <button onclick="fetchWaifu()" class="btn" style="margin-bottom: 0; width: auto;">FETCH</button>
    </div>
    
    <form action="index.php?url=admin/addWaifu" method="POST" id="add_waifu_form" style="display: none;">
        <input type="hidden" name="jikan_id" id="form_jikan_id">
        <div style="display: flex; gap: 1rem;">
            <div style="flex: 1;">
                <label>NAMA WAIFU</label>
                <input type="text" name="name" id="form_name" required>
                <label>TIER</label>
                <select name="tier" class="btn" style="background: var(--white); color: var(--black); text-align: left; text-transform: none;">
                    <option value="C">C</option>
                    <option value="B">B</option>
                    <option value="A">A</option>
                    <option value="SR">SR</option>
                    <option value="SSR">SSR</option>
                    <option value="LIMITED">LIMITED (1 UNIQUE)</option>
                </select>
            </div>
            <div style="width: 150px;">
                <img id="preview_img" src="" class="waifu-img" style="margin-top: 0; display: none; border-width: 3px;">
                <input type="hidden" name="image_url" id="form_image_url">
            </div>
        </div>
        <button type="submit" class="btn">SIMPAN WAIFU BARU</button>
    </form>
</div>

<!-- Edit Form (Hidden by default) -->
<div id="edit_section" class="result-box" style="display: none; text-align: left; border-color: var(--accent2);">
    <h2 style="color: var(--accent2);"><i class="fa-solid fa-edit"></i> EDIT WAIFU</h2>
    <form action="index.php?url=admin/updateWaifu" method="POST">
        <input type="hidden" name="id" id="edit_id">
        <label>NAMA WAIFU</label>
        <input type="text" name="name" id="edit_name" required>
        <label>TIER</label>
        <select name="tier" id="edit_tier" class="btn" style="background: var(--white); color: var(--black); text-align: left; text-transform: none;">
            <option value="C">C</option>
            <option value="B">B</option>
            <option value="A">A</option>
            <option value="SR">SR</option>
            <option value="SSR">SSR</option>
            <option value="LIMITED">LIMITED (1 UNIQUE)</option>
        </select>
        <div style="display: flex; gap: 1rem;">
            <button type="submit" class="btn" style="flex: 1;">UPDATE DATA</button>
            <button type="button" onclick="cancelEdit()" class="btn btn-secondary" style="width: auto;">BATAL</button>
        </div>
    </form>
</div>

<!-- List Section -->
<div class="result-box" style="text-align: left;">
    <h2><i class="fa-solid fa-filter"></i> FILTER & SORT</h2>
    <form action="index.php" method="GET" style="display: flex; flex-wrap: wrap; gap: 1rem; align-items: flex-end;">
        <input type="hidden" name="url" value="admin/waifus">
        
        <div style="flex: 1; min-width: 200px;">
            <label>CARI NAMA</label>
            <input type="text" name="search" value="<?php echo htmlspecialchars($filters['search']); ?>" placeholder="Cari di database..." style="margin-bottom: 0;">
        </div>

        <div style="width: 120px;">
            <label>TIER</label>
            <select name="tier" class="btn" style="margin-bottom: 0; background: var(--white); color: var(--black); text-align: left; text-transform: none; padding: 0.8rem;">
                <option value="">SEMUA</option>
                <option value="C" <?php echo $filters['tier'] == 'C' ? 'selected' : ''; ?>>C</option>
                <option value="B" <?php echo $filters['tier'] == 'B' ? 'selected' : ''; ?>>B</option>
                <option value="A" <?php echo $filters['tier'] == 'A' ? 'selected' : ''; ?>>A</option>
                <option value="SR" <?php echo $filters['tier'] == 'SR' ? 'selected' : ''; ?>>SR</option>
                <option value="SSR" <?php echo $filters['tier'] == 'SSR' ? 'selected' : ''; ?>>SSR</option>
                <option value="LIMITED" <?php echo $filters['tier'] == 'LIMITED' ? 'selected' : ''; ?>>LIMITED</option>
            </select>
        </div>

        <div style="width: 150px;">
            <label>URUTKAN</label>
            <select name="sort" class="btn" style="margin-bottom: 0; background: var(--white); color: var(--black); text-align: left; text-transform: none; padding: 0.8rem;">
                <option value="id" <?php echo $filters['sort'] == 'id' ? 'selected' : ''; ?>>TERBARU</option>
                <option value="name" <?php echo $filters['sort'] == 'name' ? 'selected' : ''; ?>>NAMA</option>
                <option value="tier" <?php echo $filters['sort'] == 'tier' ? 'selected' : ''; ?>>TIER</option>
            </select>
        </div>

        <div style="width: 120px;">
            <label>ORDER</label>
            <select name="order" class="btn" style="margin-bottom: 0; background: var(--white); color: var(--black); text-align: left; text-transform: none; padding: 0.8rem;">
                <option value="DESC" <?php echo $filters['order'] == 'DESC' ? 'selected' : ''; ?>>DESC</option>
                <option value="ASC" <?php echo $filters['order'] == 'ASC' ? 'selected' : ''; ?>>ASC</option>
            </select>
        </div>

        <button type="submit" class="btn" style="margin-bottom: 0; width: auto; padding: 0.8rem 1.5rem;">GAS FILTER</button>
        <a href="index.php?url=admin/waifus" class="btn btn-secondary" style="margin-bottom: 0; width: auto; padding: 0.8rem 1.5rem;">RESET</a>
    </form>
</div>

<div class="result-box">
    <h2><i class="fa-solid fa-list"></i> POOL WAIFU SAAT INI</h2>
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="border-bottom: 4px solid var(--black);">
                    <th style="padding: 1rem;">FOTO</th>
                    <th style="padding: 1rem;">NAMA</th>
                    <th style="padding: 1rem;">TIER</th>
                    <th style="padding: 1rem;">AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($waifus as $w): ?>
                <tr style="border-bottom: 2px solid var(--black);">
                    <td style="padding: 0.5rem;">
                        <div style="position: relative; display: inline-block;">
                            <div style="position: absolute; top: 5px; left: 5px; width: 100%; height: 100%; background: var(--black); z-index: 0;"></div>
                            <img src="<?php echo $w['image_url']; ?>" style="position: relative; width: 60px; border: 3px solid var(--black); z-index: 1; display: block;">
                        </div>
                    </td>
                    <td style="padding: 0.5rem; font-weight: 900; text-transform: uppercase;">
                        <?php echo htmlspecialchars($w['name']); ?>
                        <div style="font-size: 0.7rem; opacity: 0.6;">MAL ID: <?php echo $w['jikan_id']; ?></div>
                    </td>
                    <td style="padding: 0.5rem;">
                        <span class="tier-badge tier-<?php echo strtolower($w['tier']); ?>">
                            <?php echo $w['tier']; ?>
                        </span>
                    </td>
                    <td style="padding: 0.5rem;">
                        <div style="display: flex; gap: 0.5rem;">
                            <button onclick="editWaifu(<?php echo htmlspecialchars(json_encode($w)); ?>)" class="btn" style="padding: 0.5rem; font-size: 0.8rem; margin-bottom: 0; background: var(--secondary);"><i class="fa-solid fa-pen"></i></button>
                            <a href="index.php?url=admin/deleteWaifu&id=<?php echo $w['id']; ?>" onclick="return confirm('Hapus waifu ini?')" class="btn" style="padding: 0.5rem; font-size: 0.8rem; margin-bottom: 0; background: var(--accent2);"><i class="fa-solid fa-trash"></i></a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="flex-center mt-2 gap-1" style="flex-wrap: wrap;">
        <?php if ($pagination['total_pages'] > 1): ?>
            <?php 
                $queryParams = $_GET; 
                unset($queryParams['url']);
            ?>

            <?php if ($pagination['current_page'] > 1): ?>
                <?php $queryParams['page'] = $pagination['current_page'] - 1; ?>
                <a href="index.php?url=admin/waifus&<?php echo http_build_query($queryParams); ?>" class="btn btn-secondary w-auto" style="padding: 0.5rem 1rem; margin-bottom: 0;">PREV</a>
            <?php endif; ?>

            <div class="result-box mb-0" style="padding: 0.5rem 1rem; min-height: auto; border-width: 2px;">
                <span class="font-bold">PAGE <?php echo $pagination['current_page']; ?> / <?php echo $pagination['total_pages']; ?></span>
                <div style="font-size: 0.7rem; opacity: 0.6;">TOTAL: <?php echo $pagination['total_items']; ?></div>
            </div>

            <?php if ($pagination['current_page'] < $pagination['total_pages']): ?>
                <?php $queryParams['page'] = $pagination['current_page'] + 1; ?>
                <a href="index.php?url=admin/waifus&<?php echo http_build_query($queryParams); ?>" class="btn btn-secondary w-auto" style="padding: 0.5rem 1rem; margin-bottom: 0;">NEXT</a>
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
    
    resultsDiv.innerHTML = '<p>Mencari...</p>';
    
    fetch(`index.php?url=admin/searchWaifu&query=${encodeURIComponent(query)}`)
        .then(res => res.json())
        .then(data => {
            resultsDiv.innerHTML = '';
            if (data && data.length > 0) {
                data.forEach(item => {
                    const div = document.createElement('div');
                    div.className = 'card';
                    div.style.background = 'var(--white)';
                    div.style.color = 'var(--black)';
                    div.style.padding = '0.5rem';
                    div.style.cursor = 'pointer';
                    div.innerHTML = `
                        <img src="${item.images.jpg.image_url}" style="width: 100%; border: 2px solid black;">
                        <div style="font-size: 0.8rem; font-weight: 900; margin-top: 0.3rem;">${item.name}</div>
                        <div style="font-size: 0.7rem; opacity: 0.6;">ID: ${item.mal_id}</div>
                    `;
                    div.onclick = () => {
                        document.getElementById('jikan_id_input').value = item.mal_id;
                        fetchWaifu();
                        window.scrollTo({ top: document.getElementById('jikan_id_input').offsetTop - 20, behavior: 'smooth' });
                    };
                    resultsDiv.appendChild(div);
                });
            } else {
                resultsDiv.innerHTML = '<p>Tidak ada hasil.</p>';
            }
        })
        .catch(err => resultsDiv.innerHTML = '<p>Error searching!</p>');
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

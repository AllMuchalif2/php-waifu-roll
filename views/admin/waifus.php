<h2 class="mb-8">KELOLA WAIFU</h2>

<!-- Messages -->
<?php include BASE_PATH . '/views/partials/messages.php'; ?>

<!-- Fetch & Add Section -->
<div class="bg-white border-2 border-gray-900 rounded-2xl p-6 mb-6 shadow-sm relative p-8 mb-8">
    <h3 class="text-sm font-black mb-4"><i class="fa-solid fa-search text-blue-600"></i> CARI WAIFU (JIKAN API)</h3>
    <div style="display: flex; gap: 0.5rem; margin-bottom: 1rem;">
        <input type="text" id="search_query" placeholder="Ketik nama waifu..." class="mb-0">
        <button onclick="searchWaifu()" class="inline-flex items-center justify-center gap-2 w-full py-3 px-6 bg-blue-600 text-white border-2 border-gray-900 rounded-xl font-bold uppercase transition-all shadow-[6px_6px_0px_#ffea00] active:translate-x-[3px] active:translate-y-[3px] active:shadow-[3px_3px_0px_#ffea00] mb-4 text-sm w-auto mb-0" style="padding: 0 1.5rem;">CARI</button>
    </div>
    <div id="search_results"
        style="display: grid; grid-template-columns: repeat(auto-fill, minmax(100px, 1fr)); gap: 1rem; margin-top: 1rem;">
        <!-- Search results will appear here -->
    </div>
</div>

<div class="bg-white border-2 border-gray-900 rounded-2xl p-6 mb-6 shadow-sm relative p-8 mb-8">
    <h3 class="text-sm font-black mb-4"><i class="fa-solid fa-plus-circle text-blue-600"></i> FETCH BY ID / TAMBAH</h3>
    <div style="display: flex; gap: 0.5rem; margin-bottom: 1.5rem;">
        <input type="number" id="jikan_id_input" placeholder="MAL ID" class="mb-0">
        <button onclick="fetchWaifu()" class="inline-flex items-center justify-center gap-2 w-full py-3 px-6 bg-blue-600 text-white border-2 border-gray-900 rounded-xl font-bold uppercase transition-all shadow-[6px_6px_0px_#ffea00] active:translate-x-[3px] active:translate-y-[3px] active:shadow-[3px_3px_0px_#ffea00] mb-4 text-sm w-auto mb-0" style="padding: 0 1.5rem;">FETCH</button>
    </div>

    <form action="index.php?url=admin/addWaifu" method="POST" id="add_waifu_form" style="display: none;">
        <input type="hidden" name="jikan_id" id="form_jikan_id">
        <div class="flex gap-4 mb-4" style="align-items: flex-start;">
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
                <img id="preview_img" src="" class="w-full rounded-lg border border-gray-900 aspect-square object-cover mb-2" style="display: none;">
                <input type="hidden" name="image_url" id="form_image_url">
            </div>
        </div>
        <button type="submit" class="inline-flex items-center justify-center gap-2 w-full py-3 px-6 bg-blue-600 text-white border-2 border-gray-900 rounded-xl font-bold uppercase transition-all shadow-[6px_6px_0px_#ffea00] active:translate-x-[3px] active:translate-y-[3px] active:shadow-[3px_3px_0px_#ffea00] mb-4 text-sm w-full mb-0">SIMPAN WAIFU BARU</button>
    </form>
</div>

<!-- Edit Form (Hidden by default) -->
<div id="edit_section" class="bg-white border-2 border-gray-900 rounded-2xl p-6 mb-6 shadow-sm relative p-8 mb-8" style="display: none; border-color: var(--primary-blue);">
    <h3 class="text-sm font-black mb-4 text-blue-600"><i class="fa-solid fa-edit"></i> EDIT WAIFU</h3>
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
        <div class="flex gap-2">
            <button type="submit" class="inline-flex items-center justify-center gap-2 w-full py-3 px-6 bg-blue-600 text-white border-2 border-gray-900 rounded-xl font-bold uppercase transition-all shadow-[6px_6px_0px_#ffea00] active:translate-x-[3px] active:translate-y-[3px] active:shadow-[3px_3px_0px_#ffea00] mb-4 text-sm" style="flex: 2;">UPDATE DATA</button>
            <button type="button" onclick="cancelEdit()" class="inline-flex items-center justify-center gap-2 w-full py-3 px-6 bg-blue-600 text-white border-2 border-gray-900 rounded-xl font-bold uppercase transition-all shadow-[6px_6px_0px_#ffea00] active:translate-x-[3px] active:translate-y-[3px] active:shadow-[3px_3px_0px_#ffea00] mb-4 text-sm bg-yellow-400 text-gray-900 shadow-[6px_6px_0px_#3d5afe] active:shadow-[3px_3px_0px_#3d5afe] w-auto"
                style="flex: 1;">BATAL</button>
        </div>
    </form>
</div>

<!-- List Section -->
<div class="bg-white border-2 border-gray-900 rounded-2xl p-6 mb-6 shadow-sm relative p-8 mb-8">
    <h3 class="text-sm font-black mb-4"><i class="fa-solid fa-filter text-blue-600"></i> FILTER & SORT</h3>
    <form action="index.php" method="GET" style="display: flex; flex-direction: column; gap: 0.8rem;">
        <input type="hidden" name="url" value="admin/waifus">

        <div>
            <label class="text-xs font-black">CARI NAMA</label>
            <input type="text" name="search" value="<?php echo htmlspecialchars($filters['search']); ?>"
                placeholder="..." class="mb-0">
        </div>

        <div class="flex gap-2">
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
                    <option value="LIMITED" <?php echo $filters['tier'] == 'LIMITED' ? 'selected' : ''; ?>>LIMITED
                    </option>
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

        <div class="flex gap-2">
            <button type="submit" class="inline-flex items-center justify-center gap-2 w-full py-3 px-6 bg-blue-600 text-white border-2 border-gray-900 rounded-xl font-bold uppercase transition-all shadow-[6px_6px_0px_#ffea00] active:translate-x-[3px] active:translate-y-[3px] active:shadow-[3px_3px_0px_#ffea00] mb-4 text-sm mb-0" style="flex: 2;">GAS FILTER</button>
            <a href="index.php?url=admin/waifus" class="inline-flex items-center justify-center gap-2 w-full py-3 px-6 bg-blue-600 text-white border-2 border-gray-900 rounded-xl font-bold uppercase transition-all shadow-[6px_6px_0px_#ffea00] active:translate-x-[3px] active:translate-y-[3px] active:shadow-[3px_3px_0px_#ffea00] mb-4 text-sm bg-yellow-400 text-gray-900 shadow-[6px_6px_0px_#3d5afe] active:shadow-[3px_3px_0px_#3d5afe] mb-0" style="flex: 1; padding: 0.6rem;"><i
                    class="fa-solid fa-rotate-left"></i></a>
        </div>
    </form>
</div>

<div class="bg-white border-2 border-gray-900 rounded-2xl p-6 mb-6 shadow-sm relative p-4">
    <h3 class="text-sm font-black mb-4 px-1 pt-1"><i class="fa-solid fa-list text-blue-600"></i> POOL WAIFU</h3>
    <div style="overflow-x: auto;">
        <table class="ranking-table w-full">
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
                            <img src="<?php echo $w['image_url']; ?>"
                                style="width: 50px; height: 50px; border-radius: 8px; border: 1px solid var(--text-dark); object-fit: cover;">
                        </td>
                        <td>
                            <div class="text-sm font-black"><?php echo htmlspecialchars($w['name']); ?></div>
                            <div class="text-xs text-gray-500">ID: <?php echo $w['jikan_id']; ?></div>
                        </td>
                        <td>
                            <span class="absolute top-2 right-2 px-2 py-1 rounded-md text-[10px] font-black text-white border border-gray-900 z-10 tier-<?php echo strtolower($w['tier']); ?>" style="position: static;">
                                <?php echo $w['tier']; ?>
                            </span>
                        </td>
                        <td>
                            <div class="flex gap-2">
                                <button onclick="editWaifu(<?php echo htmlspecialchars(json_encode($w)); ?>)"
                                    class="inline-flex items-center justify-center gap-2 w-full py-3 px-6 bg-blue-600 text-white border-2 border-gray-900 rounded-xl font-bold uppercase transition-all shadow-[6px_6px_0px_#ffea00] active:translate-x-[3px] active:translate-y-[3px] active:shadow-[3px_3px_0px_#ffea00] mb-4 text-sm bg-yellow-400 text-gray-900 shadow-[6px_6px_0px_#3d5afe] active:shadow-[3px_3px_0px_#3d5afe] mb-0" style="padding: 0.4rem; font-size: 0.8rem; flex: 1;"><i
                                        class="fa-solid fa-pen"></i></button>
                                <a href="index.php?url=admin/deleteWaifu&id=<?php echo $w['id']; ?>"
                                    onclick="return confirm('Hapus waifu ini?')" class="inline-flex items-center justify-center gap-2 w-full py-3 px-6 bg-blue-600 text-white border-2 border-gray-900 rounded-xl font-bold uppercase transition-all shadow-[6px_6px_0px_#ffea00] active:translate-x-[3px] active:translate-y-[3px] active:shadow-[3px_3px_0px_#ffea00] mb-4 text-sm bg-red-500 shadow-[6px_6px_0px_#1a1a1a] mb-0"
                                    style="padding: 0.4rem; font-size: 0.8rem; flex: 1;"><i
                                        class="fa-solid fa-trash"></i></a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="flex justify-center items-center mt-8 mb-4 gap-2">
        <?php if ($pagination['total_pages'] > 1): ?>
            <?php
            $queryParams = $_GET;
            unset($queryParams['url']);
            ?>

            <?php if ($pagination['current_page'] > 1): ?>
                <?php $queryParams['page'] = $pagination['current_page'] - 1; ?>
                <a href="index.php?url=admin/waifus&<?php echo http_build_query($queryParams); ?>"
                    class="inline-flex items-center justify-center gap-2 w-full py-3 px-6 bg-blue-600 text-white border-2 border-gray-900 rounded-xl font-bold uppercase transition-all shadow-[6px_6px_0px_#ffea00] active:translate-x-[3px] active:translate-y-[3px] active:shadow-[3px_3px_0px_#ffea00] mb-4 text-sm bg-yellow-400 text-gray-900 shadow-[6px_6px_0px_#3d5afe] active:shadow-[3px_3px_0px_#3d5afe] w-auto mb-0" style="padding: 0.4rem 0.8rem;">PREV</a>
            <?php endif; ?>

            <div class="text-xs font-black">
                PAGE <?php echo $pagination['current_page']; ?> / <?php echo $pagination['total_pages']; ?>
            </div>

            <?php if ($pagination['current_page'] < $pagination['total_pages']): ?>
                <?php $queryParams['page'] = $pagination['current_page'] + 1; ?>
                <a href="index.php?url=admin/waifus&<?php echo http_build_query($queryParams); ?>"
                    class="inline-flex items-center justify-center gap-2 w-full py-3 px-6 bg-blue-600 text-white border-2 border-gray-900 rounded-xl font-bold uppercase transition-all shadow-[6px_6px_0px_#ffea00] active:translate-x-[3px] active:translate-y-[3px] active:shadow-[3px_3px_0px_#ffea00] mb-4 text-sm bg-yellow-400 text-gray-900 shadow-[6px_6px_0px_#3d5afe] active:shadow-[3px_3px_0px_#3d5afe] w-auto mb-0" style="padding: 0.4rem 0.8rem;">NEXT</a>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>

<script>
    // Trigger search on Enter
    document.getElementById('search_query').addEventListener('keydown', function (e) {
        if (e.key === 'Enter') searchWaifu();
    });

    // Trigger fetch on Enter
    document.getElementById('jikan_id_input').addEventListener('keydown', function (e) {
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
                        div.className = 'p-2 border-2 border-gray-900 rounded-xl bg-white text-center transition-transform hover:-translate-y-1 relative';
                        div.style.padding = '0.4rem';
                        div.style.cursor = 'pointer';
                        div.innerHTML = `
                        <img src="${item.images.jpg.image_url}" class="w-full rounded-lg border border-gray-900 aspect-square object-cover mb-2" style="margin-bottom: 4px;">
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
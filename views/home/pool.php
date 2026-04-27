<?php 
$title = "Waifu Pool - Waifu Gacha";
include BASE_PATH . '/views/partials/header.php'; 
?>

<body class="pb-80">
    <?php include BASE_PATH . '/views/partials/navbar.php'; ?>

    <div class="w-full max-w-md mx-auto p-6">
        <h2 class="text-center mt-4 mb-8"><i class="fa-solid fa-list text-blue-600"></i> WAIFU POOL</h2>
        
        <div class="bg-white border-2 border-gray-900 rounded-2xl p-6 mb-6 shadow-sm relative p-8 mb-8">
            <h3 class="text-sm font-black mb-4"><i class="fa-solid fa-filter text-blue-600"></i> FILTER & SORT</h3>
            <form action="index.php" method="GET" style="display: flex; flex-direction: column; gap: 0.8rem;">
                <input type="hidden" name="url" value="home/pool">
                
                <div>
                    <label class="text-xs font-black">CARI NAMA</label>
                    <input type="text" name="search" value="<?php echo htmlspecialchars($filters['search']); ?>" placeholder="..." class="mb-0">
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

                <div class="flex gap-2">
                    <button type="submit" class="inline-flex items-center justify-center gap-2 w-full py-3 px-6 bg-blue-600 text-white border-2 border-gray-900 rounded-xl font-bold uppercase transition-all shadow-[6px_6px_0px_#ffea00] active:translate-x-[3px] active:translate-y-[3px] active:shadow-[3px_3px_0px_#ffea00] mb-4 text-sm mb-0" style="flex: 2;">GAS FILTER</button>
                    <a href="index.php?url=home/pool" class="inline-flex items-center justify-center gap-2 w-full py-3 px-6 bg-blue-600 text-white border-2 border-gray-900 rounded-xl font-bold uppercase transition-all shadow-[6px_6px_0px_#ffea00] active:translate-x-[3px] active:translate-y-[3px] active:shadow-[3px_3px_0px_#ffea00] mb-4 text-sm bg-yellow-400 text-gray-900 shadow-[6px_6px_0px_#3d5afe] active:shadow-[3px_3px_0px_#3d5afe] mb-0 flex justify-center items-center" style="flex: 1; padding: 0.6rem;"><i class="fa-solid fa-rotate-left"></i></a>
                </div>
            </form>
        </div>

        <div class="grid grid-cols-3 gap-2">
            <?php if (count($waifus) > 0): ?>
                <?php foreach ($waifus as $w): ?>
                    <div class="p-2 border-2 border-gray-900 rounded-xl bg-white text-center transition-transform hover:-translate-y-1 relative">
                        <div class="absolute top-2 right-2 px-2 py-1 rounded-md text-[10px] font-black text-white border border-gray-900 z-10 tier-<?php echo strtolower($w['tier']); ?>">
                            <?php echo $w['tier']; ?>
                        </div>
                        <img src="<?php echo htmlspecialchars($w['image_url']); ?>" class="w-full rounded-lg border border-gray-900 aspect-square object-cover mb-2">
                        <div class="text-sm font-black" style="font-size: 0.75rem; line-height: 1.2; height: 1.8rem; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;"><?php echo htmlspecialchars($w['name']); ?></div>
                        <div class="text-xs text-gray-500 mt-05">ID: <?php echo $w['jikan_id']; ?></div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div style="grid-column: 1 / -1; text-align: center; padding: 2rem;" class="bg-white border-2 border-gray-900 rounded-2xl p-6 mb-6 shadow-sm relative">
                    <p class="font-bold opacity-60">Tidak ada waifu yang ditemukan.</p>
                </div>
            <?php endif; ?>
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
                    <a href="index.php?url=home/pool&<?php echo http_build_query($queryParams); ?>" class="inline-flex items-center justify-center gap-2 w-full py-3 px-6 bg-blue-600 text-white border-2 border-gray-900 rounded-xl font-bold uppercase transition-all shadow-[6px_6px_0px_#ffea00] active:translate-x-[3px] active:translate-y-[3px] active:shadow-[3px_3px_0px_#ffea00] mb-4 text-sm bg-yellow-400 text-gray-900 shadow-[6px_6px_0px_#3d5afe] active:shadow-[3px_3px_0px_#3d5afe] w-auto mb-0" style="padding: 0.4rem 0.8rem;">PREV</a>
                <?php endif; ?>

                <div class="text-xs font-black">
                    PAGE <?php echo $pagination['current_page']; ?> / <?php echo $pagination['total_pages']; ?>
                </div>

                <?php if ($pagination['current_page'] < $pagination['total_pages']): ?>
                    <?php $queryParams['page'] = $pagination['current_page'] + 1; ?>
                    <a href="index.php?url=home/pool&<?php echo http_build_query($queryParams); ?>" class="inline-flex items-center justify-center gap-2 w-full py-3 px-6 bg-blue-600 text-white border-2 border-gray-900 rounded-xl font-bold uppercase transition-all shadow-[6px_6px_0px_#ffea00] active:translate-x-[3px] active:translate-y-[3px] active:shadow-[3px_3px_0px_#ffea00] mb-4 text-sm bg-yellow-400 text-gray-900 shadow-[6px_6px_0px_#3d5afe] active:shadow-[3px_3px_0px_#3d5afe] w-auto mb-0" style="padding: 0.4rem 0.8rem;">NEXT</a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

    <?php include BASE_PATH . '/views/partials/footer.php'; ?>

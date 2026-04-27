<?php 
$title = "Riwayat Gacha - Waifu Gacha";
include BASE_PATH . '/views/partials/header.php'; 
?>

<body class="pb-80">
    <?php include BASE_PATH . '/views/partials/navbar.php'; ?>

    <div class="w-full max-w-md mx-auto p-6">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 0.5rem;" class="mb-8 mt-4">
            <h2 class="mb-0 text-md"><i class="fa-solid fa-clock-rotate-left text-blue-600"></i> RIWAYAT GACHA</h2>
            <a href="index.php?url=gacha/index" class="inline-flex items-center justify-center gap-2 w-full py-3 px-6 bg-blue-600 text-white border-2 border-gray-900 rounded-xl font-bold uppercase transition-all shadow-[6px_6px_0px_#ffea00] active:translate-x-[3px] active:translate-y-[3px] active:shadow-[3px_3px_0px_#ffea00] mb-4 text-sm bg-yellow-400 text-gray-900 shadow-[6px_6px_0px_#3d5afe] active:shadow-[3px_3px_0px_#3d5afe] w-auto mb-0" style="padding: 0.4rem 0.8rem; font-size: 0.8rem;"><i class="fa-solid fa-arrow-left"></i> KEMBALI</a>
        </div>

        <div class="flex gap-4" style="flex-direction: column;">
            <?php if (count($history) > 0): ?>
                <?php foreach ($history as $h): ?>
                    <div class="bg-white border-2 border-gray-900 rounded-2xl p-6 mb-6 shadow-sm relative p-4" style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0;">
                        <img src="<?php echo htmlspecialchars($h['image_url']); ?>" style="width: 48px; height: 48px; border-radius: 8px; border: 1px solid var(--text-dark); object-fit: cover; flex-shrink: 0;">
                        <div style="flex: 1; min-width: 0;">
                            <div class="text-sm font-black" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; line-height: 1.2;"><?php echo htmlspecialchars($h['name']); ?></div>
                            <div class="text-xs text-gray-500 mt-05" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                <i class="fa-regular fa-clock"></i> <?php echo date('d M y H:i', strtotime($h['created_at'])); ?>
                            </div>
                        </div>
                        <div class="text-right" style="flex-shrink: 0;">
                            <span class="absolute top-2 right-2 px-2 py-1 rounded-md text-[10px] font-black text-white border border-gray-900 z-10 tier-<?php echo strtolower($h['tier']); ?>" style="position: static; display: inline-block; padding: 0.2rem 0.5rem; font-size: 0.7rem;">
                                <?php echo $h['tier']; ?>
                            </span>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="bg-white border-2 border-gray-900 rounded-2xl p-6 mb-6 shadow-sm relative p-8 text-center">
                    <p class="font-bold opacity-60">Belum ada riwayat gacha.</p>
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
                    <a href="index.php?url=gacha/history&<?php echo http_build_query($queryParams); ?>" class="inline-flex items-center justify-center gap-2 w-full py-3 px-6 bg-blue-600 text-white border-2 border-gray-900 rounded-xl font-bold uppercase transition-all shadow-[6px_6px_0px_#ffea00] active:translate-x-[3px] active:translate-y-[3px] active:shadow-[3px_3px_0px_#ffea00] mb-4 text-sm bg-yellow-400 text-gray-900 shadow-[6px_6px_0px_#3d5afe] active:shadow-[3px_3px_0px_#3d5afe] w-auto mb-0" style="padding: 0.4rem 0.8rem;">PREV</a>
                <?php endif; ?>

                <div class="text-xs font-black">
                    PAGE <?php echo $pagination['current_page']; ?> / <?php echo $pagination['total_pages']; ?>
                </div>

                <?php if ($pagination['current_page'] < $pagination['total_pages']): ?>
                    <?php $queryParams['page'] = $pagination['current_page'] + 1; ?>
                    <a href="index.php?url=gacha/history&<?php echo http_build_query($queryParams); ?>" class="inline-flex items-center justify-center gap-2 w-full py-3 px-6 bg-blue-600 text-white border-2 border-gray-900 rounded-xl font-bold uppercase transition-all shadow-[6px_6px_0px_#ffea00] active:translate-x-[3px] active:translate-y-[3px] active:shadow-[3px_3px_0px_#ffea00] mb-4 text-sm bg-yellow-400 text-gray-900 shadow-[6px_6px_0px_#3d5afe] active:shadow-[3px_3px_0px_#3d5afe] w-auto mb-0" style="padding: 0.4rem 0.8rem;">NEXT</a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

    <?php include BASE_PATH . '/views/partials/footer.php'; ?>

<?php 
$title = "Riwayat Gacha - Waifu Gacha";
include BASE_PATH . '/views/partials/header.php'; 
?>

<body class="pb-80">
    <?php include BASE_PATH . '/views/partials/navbar.php'; ?>

    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 0.5rem;" class="mb-2 mt-1">
            <h2 class="mb-0 text-md"><i class="fa-solid fa-clock-rotate-left color-primary"></i> RIWAYAT GACHA</h2>
            <a href="index.php?url=gacha/index" class="btn btn-secondary w-auto mb-0" style="padding: 0.4rem 0.8rem; font-size: 0.8rem;"><i class="fa-solid fa-arrow-left"></i> KEMBALI</a>
        </div>

        <div class="flex gap-1" style="flex-direction: column;">
            <?php if (count($history) > 0): ?>
                <?php foreach ($history as $h): ?>
                    <div class="card p-1" style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0;">
                        <img src="<?php echo htmlspecialchars($h['image_url']); ?>" style="width: 48px; height: 48px; border-radius: 8px; border: 1px solid var(--text-dark); object-fit: cover; flex-shrink: 0;">
                        <div style="flex: 1; min-width: 0;">
                            <div class="text-sm font-black" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; line-height: 1.2;"><?php echo htmlspecialchars($h['name']); ?></div>
                            <div class="text-xs text-muted mt-05" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                <i class="fa-regular fa-clock"></i> <?php echo date('d M y H:i', strtotime($h['created_at'])); ?>
                            </div>
                        </div>
                        <div class="text-right" style="flex-shrink: 0;">
                            <span class="tier-badge tier-<?php echo strtolower($h['tier']); ?>" style="position: static; display: inline-block; padding: 0.2rem 0.5rem; font-size: 0.7rem;">
                                <?php echo $h['tier']; ?>
                            </span>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="card p-2 text-center">
                    <p class="font-bold opacity-06">Belum ada riwayat gacha.</p>
                </div>
            <?php endif; ?>
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
                    <a href="index.php?url=gacha/history&<?php echo http_build_query($queryParams); ?>" class="btn btn-secondary w-auto mb-0" style="padding: 0.4rem 0.8rem;">PREV</a>
                <?php endif; ?>

                <div class="text-xs font-black">
                    PAGE <?php echo $pagination['current_page']; ?> / <?php echo $pagination['total_pages']; ?>
                </div>

                <?php if ($pagination['current_page'] < $pagination['total_pages']): ?>
                    <?php $queryParams['page'] = $pagination['current_page'] + 1; ?>
                    <a href="index.php?url=gacha/history&<?php echo http_build_query($queryParams); ?>" class="btn btn-secondary w-auto mb-0" style="padding: 0.4rem 0.8rem;">NEXT</a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

    <?php include BASE_PATH . '/views/partials/footer.php'; ?>

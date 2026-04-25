<?php 
$title = "Dashboard - Waifu Gacha";
include BASE_PATH . '/views/partials/header.php'; 
?>

<body class="pb-80">
    <?php include BASE_PATH . '/views/partials/navbar.php'; ?>
    
    <div class="container">
        <!-- Messages -->
        <?php include BASE_PATH . '/views/partials/messages.php'; ?>

        <!-- Daily Reward -->
        <?php 
            $userModel = new \App\Models\User();
            if ($userModel->canClaimDaily($_SESSION['user_id'])): 
        ?>
            <div class="result-box bg-white color-black mt-1 text-center border-dashed">
                <h3 class="color-black mb-05 no-shadow"><i class="fa-solid fa-gift"></i> HADIAH HARIAN TERSEDIA!</h3>
                <a href="index.php?url=gacha/daily" class="btn bg-accent2">KLAIM SEKARANG!</a>
            </div>
        <?php endif; ?>

        <!-- Profile Header -->
        <div class="result-box profile-header">
            <div class="font-black text-xl text-uppercase">
                <i class="fa-solid fa-user"></i> <?php echo htmlspecialchars($user['username']); ?>
            </div>
            <div class="font-bold">
                <span class="color-accent2"><i class="fa-solid fa-coins"></i> <?php echo $user['coins']; ?></span>
                <span class="mx-05">|</span>
                <span class="color-accent1"><i class="fa-solid fa-dice"></i> <?php echo $user['dice_count']; ?></span>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="quick-actions">
            <a href="index.php?url=gacha/roll" class="btn"><i class="fa-solid fa-dice"></i> GACHA!</a>
            <a href="index.php?url=scoreboard/index" class="btn btn-secondary"><i class="fa-solid fa-trophy"></i> RANK</a>
        </div>

        <!-- Dice Shop -->
        <div class="result-box bg-white color-black mt-1 text-center border-dashed p-1">
            <h3 class="color-black mb-05 no-shadow"><i class="fa-solid fa-cart-shopping"></i> TOKO DADU</h3>
            <div class="flex-center gap-05 flex-wrap">
                <form action="index.php?url=gacha/buyDice" method="POST">
                    <input type="hidden" name="amount" value="1">
                    <button type="submit" class="btn bg-accent1 w-auto px-1 mb-0 text-xs" onclick="return confirm('Beli 1 Dadu (100 koin)?')">
                        1 DADU (100 <i class="fa-solid fa-coins"></i>)
                    </button>
                </form>
                <form action="index.php?url=gacha/buyDice" method="POST">
                    <input type="hidden" name="amount" value="5">
                    <button type="submit" class="btn bg-accent1 w-auto px-1 mb-0 text-xs" onclick="return confirm('Beli 5 Dadu (500 koin)?')">
                        5 DADU (500 <i class="fa-solid fa-coins"></i>)
                    </button>
                </form>
                <form action="index.php?url=gacha/buyDice" method="POST">
                    <input type="hidden" name="amount" value="10">
                    <button type="submit" class="btn bg-accent1 w-auto px-1 mb-0 text-xs" onclick="return confirm('Beli 10 Dadu (1000 koin)?')">
                        10 DADU (1000 <i class="fa-solid fa-coins"></i>)
                    </button>
                </form>
            </div>
        </div>

        <h2 class="text-left text-lg mb-05 mt-2"><i class="fa-solid fa-box-open"></i> KOLEKSI</h2>

        <!-- Filter & Sort Collection -->
        <div class="result-box text-left p-1 mb-1">
            <form action="index.php" method="GET" style="display: flex; flex-wrap: wrap; gap: 0.5rem; align-items: flex-end;">
                <input type="hidden" name="url" value="gacha/index">
                
                <div style="flex: 1; min-width: 150px;">
                    <label class="text-xs font-black">CARI NAMA</label>
                    <input type="text" name="search" value="<?php echo htmlspecialchars($filters['search']); ?>" placeholder="..." style="margin-bottom: 0; padding: 0.5rem; font-size: 0.8rem;">
                </div>

                <div style="width: 80px;">
                    <label class="text-xs font-black">TIER</label>
                    <select name="tier" class="btn" style="margin-bottom: 0; padding: 0.5rem; font-size: 0.8rem; background: var(--white); color: var(--black); text-transform: none; text-align: left;">
                        <option value="">ALL</option>
                        <option value="C" <?php echo $filters['tier'] == 'C' ? 'selected' : ''; ?>>C</option>
                        <option value="B" <?php echo $filters['tier'] == 'B' ? 'selected' : ''; ?>>B</option>
                        <option value="A" <?php echo $filters['tier'] == 'A' ? 'selected' : ''; ?>>A</option>
                        <option value="SR" <?php echo $filters['tier'] == 'SR' ? 'selected' : ''; ?>>SR</option>
                        <option value="SSR" <?php echo $filters['tier'] == 'SSR' ? 'selected' : ''; ?>>SSR</option>
                        <option value="LIMITED" <?php echo $filters['tier'] == 'LIMITED' ? 'selected' : ''; ?>>LM</option>
                    </select>
                </div>

                <div style="width: 80px;">
                    <label class="text-xs font-black">URUT</label>
                    <select name="sort" class="btn" style="margin-bottom: 0; padding: 0.5rem; font-size: 0.8rem; background: var(--white); color: var(--black); text-transform: none; text-align: left;">
                        <option value="total" <?php echo $filters['sort'] == 'total' ? 'selected' : ''; ?>>QTY</option>
                        <option value="name" <?php echo $filters['sort'] == 'name' ? 'selected' : ''; ?>>A-Z</option>
                        <option value="tier" <?php echo $filters['sort'] == 'tier' ? 'selected' : ''; ?>>TIER</option>
                    </select>
                </div>

                <button type="submit" class="btn w-auto mb-0" style="padding: 0.5rem 0.8rem;"><i class="fa-solid fa-magnifying-glass"></i></button>
                <a href="index.php?url=gacha/index" class="btn btn-secondary w-auto mb-0" style="padding: 0.5rem 0.8rem;"><i class="fa-solid fa-rotate-left"></i></a>
            </form>
        </div>
        
        <!-- Collection Grid -->
        <div class="collection-grid">
            <?php foreach ($waifus as $w): ?>
                <div class="result-box waifu-card-mini">
                    <div class="tier-badge tier-<?php echo strtolower($w['tier']); ?> tier-badge-floating">
                        x<?php echo $w['total']; ?>
                    </div>
                    <img src="<?php echo htmlspecialchars($w['image_url']); ?>" loading="lazy" class="waifu-img m-0 w-full border-3">
                    <div class="text-sm mt-05 font-black line-height-12">
                        <?php echo htmlspecialchars($w['name']); ?>
                    </div>
                    <div class="text-xs font-black tier-<?php echo strtolower($w['tier']); ?>-text">
                        [<?php echo htmlspecialchars($w['tier']); ?>]
                        <?php if ($w['tier'] === 'LIMITED'): ?>
                            <span class="bg-black color-white px-02 text-8px">UNIK / 1 OF 1</span>
                        <?php endif; ?>
                    </div>
                    <button type="button" 
                            onclick="openSellModal('<?php echo addslashes($w['name']); ?>', '<?php echo $w['tier']; ?>', '<?php echo $w['image_url']; ?>', <?php echo $w['total']; ?>)" 
                            class="btn mb-0 p-05 text-xs bg-accent2 mt-05">JUAL</button>
                </div>
            <?php endforeach; ?>
            
            <?php if (empty($waifus)): ?>
                <p class="grid-span-all text-center opacity-06 p-2">Belum punya waifu... Ayo gacha!</p>
            <?php endif; ?>
        </div>

        <a href="index.php?url=auth/logout" class="btn mt-3 bg-555"><i class="fa-solid fa-right-from-bracket"></i> LOGOUT</a>
    </div>

    <!-- Sell Modal -->
    <div id="sellModal" class="modal">
        <div class="modal-content">
            <span class="modal-close" onclick="closeSellModal()">&times;</span>
            <h2 class="color-black no-shadow"><i class="fa-solid fa-coins"></i> JUAL WAIFU</h2>
            <div class="result-box bg-secondary p-1 mt-1 text-center" style="min-height: auto;">
                <img id="modalWaifuImg" src="" class="waifu-img m-0 border-3" style="width: 80px;">
                <div id="modalWaifuName" class="font-black mt-05"></div>
                <div id="modalWaifuTier" class="text-xs font-black"></div>
            </div>

            <form action="index.php?url=gacha/sellWaifu" method="POST" class="mt-1">
                <input type="hidden" name="waifu_name" id="modalInputName">
                <label class="font-black text-xs">JUMLAH (MAX: <span id="modalMaxQty"></span>)</label>
                <div style="display: flex; gap: 0.5rem; align-items: center; margin-bottom: 1rem;">
                    <input type="number" name="quantity" id="modalInputQty" value="1" min="1" class="mb-0" oninput="updateSellPrice()">
                </div>
                
                <div class="result-box bg-white color-black p-05 border-black no-shadow text-center" style="min-height: auto;">
                    <div class="text-xs opacity-06">TOTAL HARGA</div>
                    <div class="text-xl font-black color-accent2"><i class="fa-solid fa-coins"></i> <span id="modalTotalPrice">0</span></div>
                </div>

                <button type="submit" class="btn bg-accent2 mt-1 mb-0">KONFIRMASI JUAL</button>
            </form>
        </div>
    </div>

    <script>
    const sellPrices = { 'C': 100, 'B': 200, 'A': 500, 'SR': 1000, 'SSR': 3000, 'LIMITED': 10000 };
    let currentPricePerUnit = 0;

    function openSellModal(name, tier, img, maxQty) {
        document.getElementById('modalWaifuName').innerText = name;
        document.getElementById('modalInputName').value = name;
        document.getElementById('modalWaifuTier').innerText = '[' + tier + ']';
        document.getElementById('modalWaifuImg').src = img;
        document.getElementById('modalMaxQty').innerText = maxQty;
        document.getElementById('modalInputQty').max = maxQty;
        document.getElementById('modalInputQty').value = 1;
        
        currentPricePerUnit = sellPrices[tier] || 100;
        updateSellPrice();
        
        document.getElementById('sellModal').classList.add('show');
    }

    function closeSellModal() {
        document.getElementById('sellModal').classList.remove('show');
    }

    function updateSellPrice() {
        const qty = parseInt(document.getElementById('modalInputQty').value) || 0;
        const max = parseInt(document.getElementById('modalInputQty').max);
        
        if (qty > max) {
            document.getElementById('modalInputQty').value = max;
        } else if (qty < 1 && document.getElementById('modalInputQty').value !== '') {
            document.getElementById('modalInputQty').value = 1;
        }
        
        const finalQty = parseInt(document.getElementById('modalInputQty').value) || 0;
        document.getElementById('modalTotalPrice').innerText = finalQty * currentPricePerUnit;
    }

    window.onclick = function(event) {
        const modal = document.getElementById('sellModal');
        if (event.target == modal) {
            closeSellModal();
        }
    }
    </script>

    <?php include BASE_PATH . '/views/partials/footer.php'; ?>

<?php
$title = "Dashboard - Waifu Gacha";
include BASE_PATH . '/views/partials/header.php';
?>

<body class="pb-80">
    <?php include BASE_PATH . '/views/partials/navbar.php'; ?>

    <div class="w-full max-w-md mx-auto p-6">
        <!-- Messages -->
        <?php include BASE_PATH . '/views/partials/messages.php'; ?>

        <!-- Daily Reward -->
        <?php
        $userModel = new \App\Models\User();
        if ($userModel->canClaimDaily($_SESSION['user_id'])):
            ?>
            <div class="bg-white border-2 border-gray-900 rounded-2xl p-6 mb-6 shadow-sm relative text-center p-4" style="border-style: dashed; background: var(--secondary-yellow);">
                <h3 class="mb-05" style="font-size: 1rem;"><i class="fa-solid fa-gift"></i> HADIAH HARIAN TERSEDIA!</h3>
                <a href="index.php?url=gacha/daily" class="inline-flex items-center justify-center gap-2 w-full py-3 px-6 bg-blue-600 text-white border-2 border-gray-900 rounded-xl font-bold uppercase transition-all shadow-[6px_6px_0px_#ffea00] active:translate-x-[3px] active:translate-y-[3px] active:shadow-[3px_3px_0px_#ffea00] mb-4 text-sm mb-0" style="padding: 0.6rem; font-size: 0.8rem;">KLAIM SEKARANG!</a>
            </div>
        <?php endif; ?>

        <!-- Profile Header -->
        <div class="bg-white border-2 border-gray-900 rounded-2xl p-6 mb-6 shadow-sm relative p-4 flex justify-between items-center">
            <div class="font-black text-sm">
                <i class="fa-solid fa-user text-blue-600"></i> <?php echo htmlspecialchars($user['username']); ?>
            </div>
            <div class="flex gap-4">
                <span class="font-bold text-sm text-red-500"><i class="fa-solid fa-coins"></i> <?php echo $user['coins']; ?></span>
                <span class="font-bold text-sm text-blue-600"><i class="fa-solid fa-dice"></i> <?php echo $user['dice_count']; ?></span>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="flex gap-4 mb-8">
            <a href="index.php?url=gacha/roll" class="inline-flex items-center justify-center gap-2 w-full py-3 px-6 bg-blue-600 text-white border-2 border-gray-900 rounded-xl font-bold uppercase transition-all shadow-[6px_6px_0px_#ffea00] active:translate-x-[3px] active:translate-y-[3px] active:shadow-[3px_3px_0px_#ffea00] mb-4 text-sm mb-0" style="padding: 0.6rem;"><i class="fa-solid fa-dice"></i> GACHA</a>
            <a href="index.php?url=scoreboard/index" class="inline-flex items-center justify-center gap-2 w-full py-3 px-6 bg-blue-600 text-white border-2 border-gray-900 rounded-xl font-bold uppercase transition-all shadow-[6px_6px_0px_#ffea00] active:translate-x-[3px] active:translate-y-[3px] active:shadow-[3px_3px_0px_#ffea00] mb-4 text-sm bg-yellow-400 text-gray-900 shadow-[6px_6px_0px_#3d5afe] active:shadow-[3px_3px_0px_#3d5afe] mb-0" style="padding: 0.6rem;"><i class="fa-solid fa-trophy"></i> RANK</a>
            <a href="index.php?url=gacha/history" class="inline-flex items-center justify-center gap-2 w-full py-3 px-6 bg-blue-600 text-white border-2 border-gray-900 rounded-xl font-bold uppercase transition-all shadow-[6px_6px_0px_#ffea00] active:translate-x-[3px] active:translate-y-[3px] active:shadow-[3px_3px_0px_#ffea00] mb-4 text-sm btn-alt mb-0" style="padding: 0.6rem;"><i class="fa-solid fa-clock-rotate-left"></i> HISTORY</a>
        </div>

        <!-- Dice Shop -->
        <div class="bg-white border-2 border-gray-900 rounded-2xl p-6 mb-6 shadow-sm relative p-4 text-center">
            <h3 class="text-sm font-black mb-4"><i class="fa-solid fa-cart-shopping"></i> TOKO DADU</h3>
            <div class="flex gap-2">
                <form action="index.php?url=gacha/buyDice" method="POST" style="flex: 1;">
                    <input type="hidden" name="amount" value="1">
                    <button type="submit" class="inline-flex items-center justify-center gap-2 w-full py-3 px-6 bg-blue-600 text-white border-2 border-gray-900 rounded-xl font-bold uppercase transition-all shadow-[6px_6px_0px_#ffea00] active:translate-x-[3px] active:translate-y-[3px] active:shadow-[3px_3px_0px_#ffea00] mb-4 text-sm bg-yellow-400 text-gray-900 shadow-[6px_6px_0px_#3d5afe] active:shadow-[3px_3px_0px_#3d5afe] w-full px-02 mb-0 text-xs" style="padding: 0.5rem;"
                        onclick="return confirm('Beli 1 Dadu (100 koin)?')">
                        1 <i class="fa-solid fa-dice"></i> (100)
                    </button>
                </form>
                <form action="index.php?url=gacha/buyDice" method="POST" style="flex: 1;">
                    <input type="hidden" name="amount" value="5">
                    <button type="submit" class="inline-flex items-center justify-center gap-2 w-full py-3 px-6 bg-blue-600 text-white border-2 border-gray-900 rounded-xl font-bold uppercase transition-all shadow-[6px_6px_0px_#ffea00] active:translate-x-[3px] active:translate-y-[3px] active:shadow-[3px_3px_0px_#ffea00] mb-4 text-sm bg-yellow-400 text-gray-900 shadow-[6px_6px_0px_#3d5afe] active:shadow-[3px_3px_0px_#3d5afe] w-full px-02 mb-0 text-xs" style="padding: 0.5rem;"
                        onclick="return confirm('Beli 5 Dadu (500 koin)?')">
                        5 <i class="fa-solid fa-dice"></i> (500)
                    </button>
                </form>
                <form action="index.php?url=gacha/buyDice" method="POST" style="flex: 1;">
                    <input type="hidden" name="amount" value="10">
                    <button type="submit" class="inline-flex items-center justify-center gap-2 w-full py-3 px-6 bg-blue-600 text-white border-2 border-gray-900 rounded-xl font-bold uppercase transition-all shadow-[6px_6px_0px_#ffea00] active:translate-x-[3px] active:translate-y-[3px] active:shadow-[3px_3px_0px_#ffea00] mb-4 text-sm bg-yellow-400 text-gray-900 shadow-[6px_6px_0px_#3d5afe] active:shadow-[3px_3px_0px_#3d5afe] w-full px-02 mb-0 text-xs" style="padding: 0.5rem;"
                        onclick="return confirm('Beli 10 Dadu (1000 koin)?')">
                        10 <i class="fa-solid fa-dice"></i> (1k)
                    </button>
                </form>
            </div>
        </div>

        <h2 class="text-sm font-black mt-16 mb-4"><i class="fa-solid fa-box-open"></i> KOLEKSI</h2>

        <!-- Filter & Sort Collection -->
        <div class="bg-white border-2 border-gray-900 rounded-2xl p-6 mb-6 shadow-sm relative p-4 mb-4">
            <form action="index.php" method="GET" style="display: flex; flex-direction: column; gap: 0.8rem;">
                <input type="hidden" name="url" value="gacha/index">

                <div>
                    <label class="text-xs font-black">CARI NAMA</label>
                    <input type="text" name="search" value="<?php echo htmlspecialchars($filters['search']); ?>"
                        placeholder="..." class="mb-0" style="padding: 0.5rem; font-size: 0.8rem;">
                </div>

                <div class="flex gap-2">
                    <div style="flex: 1;">
                        <label class="text-xs font-black">TIER</label>
                        <select name="tier" class="mb-0" style="padding: 0.5rem; font-size: 0.8rem;">
                            <option value="">ALL</option>
                            <option value="C" <?php echo $filters['tier'] == 'C' ? 'selected' : ''; ?>>C</option>
                            <option value="B" <?php echo $filters['tier'] == 'B' ? 'selected' : ''; ?>>B</option>
                            <option value="A" <?php echo $filters['tier'] == 'A' ? 'selected' : ''; ?>>A</option>
                            <option value="R" <?php echo $filters['tier'] == 'R' ? 'selected' : ''; ?>>R</option>
                            <option value="S" <?php echo $filters['tier'] == 'S' ? 'selected' : ''; ?>>S</option>
                            <option value="SR" <?php echo $filters['tier'] == 'SR' ? 'selected' : ''; ?>>SR</option>
                            <option value="SSR" <?php echo $filters['tier'] == 'SSR' ? 'selected' : ''; ?>>SSR</option>
                            <option value="UR" <?php echo $filters['tier'] == 'UR' ? 'selected' : ''; ?>>UR</option>
                            <option value="LIMITED" <?php echo $filters['tier'] == 'LIMITED' ? 'selected' : ''; ?>>LM</option>
                        </select>
                    </div>

                    <div style="flex: 1;">
                        <label class="text-xs font-black">URUT</label>
                        <select name="sort" class="mb-0" style="padding: 0.5rem; font-size: 0.8rem;">
                            <option value="total" <?php echo $filters['sort'] == 'total' ? 'selected' : ''; ?>>QTY</option>
                            <option value="name" <?php echo $filters['sort'] == 'name' ? 'selected' : ''; ?>>A-Z</option>
                            <option value="tier" <?php echo $filters['sort'] == 'tier' ? 'selected' : ''; ?>>TIER</option>
                        </select>
                    </div>
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="inline-flex items-center justify-center gap-2 w-full py-3 px-6 bg-blue-600 text-white border-2 border-gray-900 rounded-xl font-bold uppercase transition-all shadow-[6px_6px_0px_#ffea00] active:translate-x-[3px] active:translate-y-[3px] active:shadow-[3px_3px_0px_#ffea00] mb-4 text-sm mb-0" style="flex: 2; padding: 0.6rem;"><i class="fa-solid fa-magnifying-glass"></i> CARI</button>
                    <a href="index.php?url=gacha/index" class="inline-flex items-center justify-center gap-2 w-full py-3 px-6 bg-blue-600 text-white border-2 border-gray-900 rounded-xl font-bold uppercase transition-all shadow-[6px_6px_0px_#ffea00] active:translate-x-[3px] active:translate-y-[3px] active:shadow-[3px_3px_0px_#ffea00] mb-4 text-sm bg-yellow-400 text-gray-900 shadow-[6px_6px_0px_#3d5afe] active:shadow-[3px_3px_0px_#3d5afe] mb-0" style="flex: 1; padding: 0.6rem;"><i class="fa-solid fa-rotate-left"></i></a>
                </div>
            </form>
        </div>

        <!-- Collection Grid -->
        <div class="grid grid-cols-3 gap-2">
            <?php foreach ($waifus as $w): ?>
                <div class="p-2 border-2 border-gray-900 rounded-xl bg-white text-center transition-transform hover:-translate-y-1 relative">
                    <div class="absolute top-2 right-2 px-2 py-1 rounded-md text-[10px] font-black text-white border border-gray-900 z-10 tier-<?php echo strtolower($w['tier']); ?> absolute top-2 right-2 px-2 py-1 rounded-md text-[10px] font-black text-white border border-gray-900 z-10-floating">
                        x<?php echo $w['total']; ?>
                    </div>
                    <img src="<?php echo htmlspecialchars($w['image_url']); ?>" loading="lazy" class="w-full rounded-lg border border-gray-900 aspect-square object-cover mb-2">
                    <div class="text-xs font-black line-height-12" style="margin-bottom: 2px;">
                        <?php echo htmlspecialchars($w['name']); ?>
                    </div>
                    <div class="text-xs font-bold" style="opacity: 0.6;">
                        [<?php echo htmlspecialchars($w['tier']); ?>]
                    </div>
                    <?php if ($w['tier'] === 'LIMITED'): ?>
                        <div class="text-xs font-black text-red-500" style="margin-top: 2px;">UNIK 1/1</div>
                    <?php endif; ?>
                    <button type="button"
                        onclick="openSellModal('<?php echo addslashes($w['name']); ?>', '<?php echo $w['tier']; ?>', '<?php echo $w['image_url']; ?>', <?php echo $w['total']; ?>)"
                        class="inline-flex items-center justify-center gap-2 w-full py-3 px-6 bg-blue-600 text-white border-2 border-gray-900 rounded-xl font-bold uppercase transition-all shadow-[6px_6px_0px_#ffea00] active:translate-x-[3px] active:translate-y-[3px] active:shadow-[3px_3px_0px_#ffea00] mb-4 text-sm bg-yellow-400 text-gray-900 shadow-[6px_6px_0px_#3d5afe] active:shadow-[3px_3px_0px_#3d5afe] mb-0 mt-4" style="padding: 0.4rem; font-size: 0.7rem; border-radius: 8px;">JUAL</button>
                </div>
            <?php endforeach; ?>

            <?php if (empty($waifus)): ?>
                <p class="grid-span-all text-center opacity-60 p-4">Belum punya waifu...</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Sell Modal -->
    <div id="sellModal" class="modal">
        <div class="modal-content">
            <span class="modal-close" onclick="closeSellModal()">&times;</span>
            <h2 class="text-sm font-black mb-4"><i class="fa-solid fa-coins"></i> JUAL WAIFU</h2>
            
            <div class="text-center mb-4">
                <img id="modalWaifuImg" src="" class="w-full rounded-lg border border-gray-900 aspect-square object-cover mb-2" style="width: 100px; height: 100px; margin: 0 auto;">
                <div id="modalWaifuName" class="font-black mt-4"></div>
                <div id="modalWaifuTier" class="text-xs font-bold opacity-60"></div>
            </div>

            <form action="index.php?url=gacha/sellWaifu" method="POST">
                <input type="hidden" name="waifu_name" id="modalInputName">
                <label class="font-black text-xs">JUMLAH (MAX: <span id="modalMaxQty"></span>)</label>
                <input type="number" name="quantity" id="modalInputQty" value="1" min="1" oninput="updateSellPrice()">

                <div class="bg-white border-2 border-gray-900 rounded-2xl p-6 mb-6 shadow-sm relative p-4 text-center mb-4">
                    <div class="text-xs opacity-60">TOTAL HARGA</div>
                    <div class="text-lg font-black text-red-500"><i class="fa-solid fa-coins"></i> <span id="modalTotalPrice">0</span></div>
                </div>

                <button type="submit" class="inline-flex items-center justify-center gap-2 w-full py-3 px-6 bg-blue-600 text-white border-2 border-gray-900 rounded-xl font-bold uppercase transition-all shadow-[6px_6px_0px_#ffea00] active:translate-x-[3px] active:translate-y-[3px] active:shadow-[3px_3px_0px_#ffea00] mb-4 text-sm mb-0 w-full">KONFIRMASI JUAL</button>
            </form>
        </div>
    </div>

    <script>
        const sellPrices = { 
            'C': 100, 'B': 200, 'A': 400, 'R': 600, 'S': 800, 'SR': 1200, 'SSR': 3000, 'UR': 6000, 'LIMITED': 15000 
        };
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
            const qtyInput = document.getElementById('modalInputQty');
            let qty = parseInt(qtyInput.value) || 0;
            const max = parseInt(qtyInput.max);

            if (qty > max) { qty = max; qtyInput.value = max; }
            else if (qty < 1 && qtyInput.value !== '') { qty = 1; qtyInput.value = 1; }

            document.getElementById('modalTotalPrice').innerText = qty * currentPricePerUnit;
        }

        window.onclick = function (event) {
            const modal = document.getElementById('sellModal');
            if (event.target == modal) closeSellModal();
        }
    </script>

    <?php include BASE_PATH . '/views/partials/footer.php'; ?>
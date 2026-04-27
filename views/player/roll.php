<?php
$title = "Gacha Roll - Waifu Gacha";
include BASE_PATH . '/views/partials/header.php';
?>

<body class="pb-80">
    <?php include BASE_PATH . '/views/partials/navbar.php'; ?>

    <div class="w-full max-w-md mx-auto p-6">
        <div class="bg-white border-2 border-gray-900 rounded-2xl p-6 mb-6 shadow-sm relative text-center">
            <h1 style="font-size: 1.5rem; margin-bottom: 1.5rem;">
                <i class="fa-solid fa-dice text-blue-600"></i> DADU: <span id="dice-count"
                    class="text-red-500"><?php echo $user['dice_count']; ?></span>
            </h1>
            <button id="roll-btn" class="inline-flex items-center justify-center gap-2 w-full py-3 px-6 bg-blue-600 text-white border-2 border-gray-900 rounded-xl font-bold uppercase transition-all shadow-[6px_6px_0px_#ffea00] active:translate-x-[3px] active:translate-y-[3px] active:shadow-[3px_3px_0px_#ffea00] mb-4 text-sm">GAS GACHA!</button>
            <div id="gacha-result" style="margin-top: 1.5rem;"></div>
        </div>

        <!-- Info Tier -->
        <div class="bg-white border-2 border-gray-900 rounded-2xl p-6 mb-6 shadow-sm relative p-4 mt-16" style="border-style: dashed;">
            <h3 class="text-sm font-black mb-4"><i class="fa-solid fa-circle-info text-blue-600"></i> ATURAN GACHA</h3>
            <div class="text-xs font-bold opacity-08">
                <p class="mb-05">• Tier C s/d UR bisa dimiliki banyak orang.</p>
                <p class="mb-05 text-red-500">• Tier LIMITED bersifat EKSKLUSIF & UNIK.</p>
                <p class="text-gray-500">Hanya 1 PLAYER yang bisa memiliki 1 ID karakter LIMITED. Jika sudah ada yang
                    punya, waifu tersebut tidak akan bisa didapat lagi!</p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const rollBtn = document.getElementById("roll-btn");
            const resultDiv = document.getElementById("gacha-result");
            const diceCountSpan = document.getElementById("dice-count");

            if (rollBtn) {
                rollBtn.addEventListener("click", () => executeRoll());
            }

            async function executeRoll() {
                if (rollBtn.disabled) return;

                rollBtn.disabled = true;
                const originalText = rollBtn.innerHTML;
                resultDiv.innerHTML = '<h3 class="text-sm"><i class="fa-solid fa-spinner fa-spin"></i> LAGI GACHA...</h3>';

                try {
                    const res = await fetch("index.php?url=gacha/executeRoll", {
                        method: "POST"
                    });
                    const data = await res.json();

                    if (res.ok) {
                        // Special Effects Trigger
                        const flash = document.createElement("div");
                        if (data.waifu.tier === 'SSR') flash.className = "screen-flash flash-ssr";
                        if (data.waifu.tier === 'UR') flash.className = "screen-flash flash-ur";
                        if (data.waifu.tier === 'LIMITED') flash.className = "screen-flash flash-limited";
                        document.body.appendChild(flash);
                        setTimeout(() => flash.remove(), 1000);

                        const cardClass = data.waifu.tier === 'SSR' ? 'ssr-glow' : (data.waifu.tier === 'UR' ? 'ur-glow' : (data.waifu.tier === 'LIMITED' ? 'limited-ultra' : ''));

                        // Particle Burst Effect
                        if (['SSR', 'UR', 'LIMITED'].includes(data.waifu.tier)) {
                            const count = data.waifu.tier === 'LIMITED' ? 50 : (data.waifu.tier === 'UR' ? 35 : 20);
                            const icon = data.waifu.tier === 'LIMITED' ? 'fa-crown' : (data.waifu.tier === 'UR' ? 'fa-bolt' : 'fa-star');
                            const color = data.waifu.tier === 'UR' ? '#ff6b6b' : '#fcc419';

                            for (let i = 0; i < count; i++) {
                                const p = document.createElement("i");
                                p.className = `fa-solid ${icon}`;
                                p.style.position = "fixed";
                                p.style.color = color;
                                p.style.left = "50vw";
                                p.style.top = "50vh";
                                p.style.zIndex = "10000";
                                p.style.pointerEvents = "none";
                                document.body.appendChild(p);

                                const angle = Math.random() * Math.PI * 2;
                                const dist = Math.random() * 300 + 100;
                                const tx = Math.cos(angle) * dist;
                                const ty = Math.sin(angle) * dist;

                                p.animate([
                                    { transform: 'translate(-50%, -50%) scale(0) rotate(0deg)', opacity: 1 },
                                    { transform: `translate(calc(-50% + ${tx}px), calc(-50% + ${ty}px)) scale(${Math.random() * 2 + 1}) rotate(${Math.random() * 720}deg)`, opacity: 0 }
                                ], {
                                    duration: 1000 + Math.random() * 1000,
                                    easing: 'cubic-bezier(0, .9, .57, 1)'
                                }).onfinish = () => p.remove();
                            }
                        }

                        resultDiv.innerHTML = `
                            <h2 class="text-sm font-black text-blue-600 mb-4">${data.message}</h2>
                            <div class="p-2 border-2 border-gray-900 rounded-xl bg-white text-center transition-transform hover:-translate-y-1 relative ${cardClass}" style="margin: 0 auto; max-width: 200px;">
                                <div class="absolute top-2 right-2 px-2 py-1 rounded-md text-[10px] font-black text-white border border-gray-900 z-10 tier-${data.waifu.tier.toLowerCase()}">${data.waifu.tier}</div>
                                <img src="${data.waifu.image_url}" class="w-full rounded-lg border border-gray-900 aspect-square object-cover mb-2">
                                <h3 class="text-sm font-black">${data.waifu.name}</h3>
                            </div>
                        `;
                        // Update dice count
                        diceCountSpan.innerText = parseInt(diceCountSpan.innerText) - 1;
                    } else {
                        resultDiv.innerHTML = `<div class="bg-white border-2 border-gray-900 rounded-2xl p-6 mb-6 shadow-sm relative p-4 text-red-500 text-sm font-black">${data.error}</div>`;
                    }
                } catch (e) {
                    resultDiv.innerHTML = `<div class="bg-white border-2 border-gray-900 rounded-2xl p-6 mb-6 shadow-sm relative p-4 text-red-500 text-sm font-black">ERROR JARINGAN!</div>`;
                }

                // Cooldown logic
                let cooldown = 2;
                const timer = setInterval(() => {
                    cooldown--;
                    if (cooldown <= 0) {
                        clearInterval(timer);
                        rollBtn.disabled = false;
                        rollBtn.innerHTML = originalText;
                    } else {
                        rollBtn.innerHTML = `<i class="fa-solid fa-clock"></i> (${cooldown}s)`;
                    }
                }, 1000);
                rollBtn.innerHTML = `<i class="fa-solid fa-clock"></i> (${cooldown}s)`;
            }
        });
    </script>

    <?php include BASE_PATH . '/views/partials/footer.php'; ?>
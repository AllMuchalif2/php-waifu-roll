<?php
$title = "Gacha Roll - Waifu Gacha";
include BASE_PATH . '/views/partials/header.php';
?>

<body class="pb-80">
    <?php include BASE_PATH . '/views/partials/navbar.php'; ?>

    <div class="container">
        <div class="card text-center">
            <h1 style="font-size: 1.5rem; margin-bottom: 1.5rem;">
                <i class="fa-solid fa-dice color-primary"></i> DADU: <span id="dice-count"
                    class="color-danger"><?php echo $user['dice_count']; ?></span>
            </h1>
            <button id="roll-btn" class="btn">GAS GACHA!</button>
            <div id="gacha-result" style="margin-top: 1.5rem;"></div>
        </div>

        <!-- Info Tier -->
        <div class="card p-1 mt-4" style="border-style: dashed;">
            <h3 class="text-sm font-black mb-1"><i class="fa-solid fa-circle-info color-primary"></i> ATURAN GACHA</h3>
            <div class="text-xs font-bold opacity-08">
                <p class="mb-05">• Tier C s/d UR bisa dimiliki banyak orang.</p>
                <p class="mb-05 color-danger">• Tier LIMITED bersifat EKSKLUSIF & UNIK.</p>
                <p class="text-muted">Hanya 1 PLAYER yang bisa memiliki 1 ID karakter LIMITED. Jika sudah ada yang
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
                            <h2 class="text-sm font-black color-primary mb-1">${data.message}</h2>
                            <div class="waifu-card-mini ${cardClass}" style="margin: 0 auto; max-width: 200px;">
                                <div class="tier-badge tier-${data.waifu.tier.toLowerCase()}">${data.waifu.tier}</div>
                                <img src="${data.waifu.image_url}" class="waifu-img">
                                <h3 class="text-sm font-black">${data.waifu.name}</h3>
                            </div>
                        `;
                        // Update dice count
                        diceCountSpan.innerText = parseInt(diceCountSpan.innerText) - 1;
                    } else {
                        resultDiv.innerHTML = `<div class="card p-1 color-danger text-sm font-black">${data.error}</div>`;
                    }
                } catch (e) {
                    resultDiv.innerHTML = `<div class="card p-1 color-danger text-sm font-black">ERROR JARINGAN!</div>`;
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
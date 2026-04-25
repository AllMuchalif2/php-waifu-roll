<?php 
$title = "Gacha Roll - Waifu Gacha";
include BASE_PATH . '/views/partials/header.php'; 
?>

<body>
    <?php include BASE_PATH . '/views/partials/navbar.php'; ?>

    <div class="container">
        <a href="index.php?url=gacha/index" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> BALIK</a>

        <div class="result-box">
            <h1><i class="fa-solid fa-dice"></i> DADU: <span id="dice-count"><?php echo $user['dice_count']; ?></span>
            </h1>
            <button id="roll-btn" class="btn">GAS GACHA!</button>
            <div id="gacha-result" style="margin-top: 1rem;"></div>
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
                resultDiv.innerHTML = '<h3><i class="fa-solid fa-spinner fa-spin"></i> LAGI GACHA...</h3>';

                try {
                    const res = await fetch("index.php?url=gacha/executeRoll", {
                        method: "POST"
                    });
                    const data = await res.json();

                    if (res.ok) {
                        // Special Effects Trigger
                        const flash = document.createElement("div");
                        if (data.waifu.tier === 'SSR') flash.className = "screen-flash flash-ssr";
                        if (data.waifu.tier === 'LIMITED') flash.className = "screen-flash flash-limited";
                        document.body.appendChild(flash);
                        setTimeout(() => flash.remove(), 1000);

                        const cardClass = data.waifu.tier === 'SSR' ? 'ssr-glow' : (data.waifu.tier === 'LIMITED' ? 'limited-ultra' : '');

                        // Particle Burst Effect
                        if (data.waifu.tier === 'SSR' || data.waifu.tier === 'LIMITED') {
                            const count = data.waifu.tier === 'LIMITED' ? 50 : 20;
                            const icon = data.waifu.tier === 'LIMITED' ? 'fa-crown' : 'fa-star';
                            const color = '#f1c40f';
                            
                            for (let i = 0; i < count; i++) {
                                const p = document.createElement("i");
                                p.className = `fa-solid ${icon}`;
                                p.style.position = "fixed";
                                p.style.color = color;
                                p.style.left = "50vw";
                                p.style.top = "50vh";
                                p.style.zIndex = "10000";
                                p.style.pointerEvents = "none";
                                p.style.textShadow = "0 0 10px rgba(0,0,0,0.5)";
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
                        <h2 style="color: var(--accent2);" class="gacha-reveal ${data.waifu.tier === 'LIMITED' ? 'limited-text-anim' : ''}">${data.message}</h2>
                        <div class="card gacha-reveal ${cardClass}" style="background: var(--white); color: var(--black); padding: 1rem; margin-top: 1rem;">
                            <img src="${data.waifu.image_url}" class="waifu-img" style="border-width: 5px;">
                            <h3 style="text-shadow: none; color: black; margin-top: 1rem;">${data.waifu.name}</h3>
                            <span style="font-weight: 900; background: var(--accent1); color: white; padding: 4px 10px; border: 2px solid black;">TIER ${data.waifu.tier}</span>
                        </div>
                    `;
                        // Update dice count
                        diceCountSpan.innerText = parseInt(diceCountSpan.innerText) - 1;
                    } else {
                        resultDiv.innerHTML = `<div class="error-text">${data.error}</div>`;
                    }
                } catch (e) {
                    resultDiv.innerHTML = `<div class="error-text">ERROR JARINGAN!</div>`;
                }

                // Cooldown logic (3 seconds)
                let cooldown = 3;
                const timer = setInterval(() => {
                    cooldown--;
                    if (cooldown <= 0) {
                        clearInterval(timer);
                        rollBtn.disabled = false;
                        rollBtn.innerHTML = originalText;
                    } else {
                        rollBtn.innerHTML = `<i class="fa-solid fa-clock"></i> TUNGGU (${cooldown}s)`;
                    }
                }, 1000);
                rollBtn.innerHTML = `<i class="fa-solid fa-clock"></i> TUNGGU (${cooldown}s)`;
            }

        });
    </script>
    
    <?php include BASE_PATH . '/views/partials/footer.php'; ?>
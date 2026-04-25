<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gacha Roll - Waifu Gacha</title>
    <link rel="icon" href="/assets/img/logo.png" type="image/png">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <nav class="navbar">
        <a href="index.php" class="navbar-brand">
            <img src="/assets/img/logo.png" alt="MYBINI Logo" class="navbar-logo">
            <span>MYBINI</span>
        </a>
    </nav>
    <div class="container">
        <a href="index.php?url=gacha/index" class="btn btn-secondary"><i class="fa-solid fa-arrow-left"></i> BALIK</a>

        <div class="result-box">
            <h1><i class="fa-solid fa-dice"></i> DADU: <span id="dice-count"><?php echo $user['dice_count']; ?></span>
            </h1>
            <button id="roll-btn" class="btn">GAS GACHA!</button>
            <div id="gacha-result" style="margin-top: 1rem;"></div>
        </div>

        <h2><i class="fa-solid fa-star"></i> 100 SLOT SSR</h2>
        <p style="text-align: center; margin-bottom: 1rem; opacity: 0.8;">Pilih slot untuk rate SSR!</p>
        <div id="slots-container" class="slots-grid"></div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const rollBtn = document.getElementById("roll-btn");
            const resultDiv = document.getElementById("gacha-result");
            const slotsContainer = document.getElementById("slots-container");
            const diceCountSpan = document.getElementById("dice-count");

            if (rollBtn) {
                rollBtn.addEventListener("click", () => executeRoll(null));
            }

            async function executeRoll(slotNumber) {
                if (rollBtn) rollBtn.disabled = true;
                resultDiv.innerHTML = '<h3><i class="fa-solid fa-spinner fa-spin"></i> LAGI GACHA...</h3>';

                const formData = new FormData();
                if (slotNumber !== null) formData.append("slot_number", slotNumber);

                try {
                    const res = await fetch("index.php?url=gacha/executeRoll", {
                        method: "POST",
                        body: formData
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
                            const color = data.waifu.tier === 'LIMITED' ? '#f1c40f' : '#f1c40f';
                            
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
                        if (slotsContainer) loadSlots();
                    } else {
                        resultDiv.innerHTML = `<div class="error-text">${data.error}</div>`;
                    }
                } catch (e) {
                    resultDiv.innerHTML = `<div class="error-text">ERROR JARINGAN!</div>`;
                }

                setTimeout(() => {
                    if (rollBtn) rollBtn.disabled = false;
                }, 2000);
            }

            async function loadSlots() {
                if (!slotsContainer) return;
                try {
                    const res = await fetch("index.php?url=gacha/getSlots");
                    const data = await res.json();
                    slotsContainer.innerHTML = "";
                    data.slots.forEach(slot => {
                        const div = document.createElement("div");
                        div.className = `slot-item ${slot.owner_id ? "claimed" : ""}`;
                        div.innerText = slot.slot_number;
                        if (!slot.owner_id) {
                            div.style.cursor = "pointer";
                            div.onclick = () => executeRoll(slot.slot_number);
                        }
                        slotsContainer.appendChild(div);
                    });
                } catch (e) { }
            }

            loadSlots();
        });
    </script>
</body>

</html>
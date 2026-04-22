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
                    const res = await fetch("index.php?url=gacha/roll", {
                        method: "POST",
                        body: formData
                    });
                    const data = await res.json();

                    if (res.ok) {
                        resultDiv.innerHTML = `
                        <h2 style="color: var(--accent2);">${data.message}</h2>
                        <div class="card" style="background: var(--white); color: var(--black); padding: 1rem; margin-top: 1rem;">
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
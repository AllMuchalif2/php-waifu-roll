document.addEventListener("DOMContentLoaded", () => {
    const rollBtn = document.getElementById("roll-btn");
    const resultDiv = document.getElementById("gacha-result");
    const slotsContainer = document.getElementById("slots-container");
    const scoreboardBody = document.getElementById("scoreboard-body");

    if (rollBtn && !window.location.href.includes('url=gacha/roll')) { // Only use if not on the main roll page which has its own script
        rollBtn.addEventListener("click", async () => {
            await executeRoll(null);
        });
    }

    async function executeRoll(slotNumber) {
        if (rollBtn) rollBtn.disabled = true;

        if (resultDiv) {
            resultDiv.innerHTML =
                '<p class="text-sm"><i class="fa-solid fa-spinner fa-spin"></i> Menggacha...</p>';
        }

        const formData = new FormData();
        if (slotNumber !== null) {
            formData.append("slot_number", slotNumber);
        }

        try {
            const res = await fetch("api/gacha_roll.php", {
                method: "POST",
                body: slotNumber !== null ? formData : null,
            });
            const data = await res.json();

            if (res.ok) {
                if (resultDiv) {
                    resultDiv.innerHTML = `
                        <div class="card p-1 text-center">
                            <h3 class="text-sm color-primary mb-1">${data.message}</h3>
                            <div class="waifu-card-mini" style="margin: 0 auto; max-width: 150px;">
                                <div class="tier-badge tier-${data.waifu.tier.toLowerCase()}">${data.waifu.tier}</div>
                                <img src="${data.waifu.image_url}" loading="lazy" class="waifu-img" alt="Waifu">
                                <div class="text-xs font-black">${data.waifu.name}</div>
                            </div>
                        </div>
                    `;
                }
                if (slotsContainer) loadSlots();
            } else {
                if (resultDiv) {
                    resultDiv.innerHTML = `<div class="card p-1 color-danger text-sm font-black"><i class="fa-solid fa-triangle-exclamation"></i> ${data.error}</div>`;
                }
            }
        } catch (e) {
            if (resultDiv) {
                resultDiv.innerHTML = `<div class="card p-1 color-danger text-sm font-black"><i class="fa-solid fa-triangle-exclamation"></i> Terjadi kesalahan jaringan.</div>`;
            }
        }

        setTimeout(() => {
            if (rollBtn) rollBtn.disabled = false;
        }, 3000);
    }

    async function loadSlots() {
        if (!slotsContainer) return;

        try {
            const res = await fetch("api/get_slots.php");
            const data = await res.json();
            slotsContainer.innerHTML = "";

            data.slots.forEach((slot) => {
                const div = document.createElement("div");
                div.className = `waifu-card-mini ${slot.owner_id ? "opacity-06" : ""}`;
                div.style.padding = "0.5rem";
                div.innerHTML = `<div class="text-xs font-black">${slot.slot_number}</div>`;

                if (!slot.owner_id) {
                    div.style.cursor = "pointer";
                    div.addEventListener("click", () => {
                        if (!rollBtn || !rollBtn.disabled) {
                            executeRoll(slot.slot_number);
                        }
                    });
                }
                slotsContainer.appendChild(div);
            });
        } catch (e) {
            slotsContainer.innerHTML =
                '<p class="text-xs color-danger">Gagal memuat slot terbatas.</p>';
        }
    }

    async function loadScoreboard() {
        if (!scoreboardBody) return;

        try {
            const res = await fetch("api/get_scoreboard.php");
            const data = await res.json();
            scoreboardBody.innerHTML = "";

            data.top_19.forEach((user, index) => {
                scoreboardBody.innerHTML += `
                    <tr>
                        <td class="font-black text-center">${index + 1}</td>
                        <td class="text-sm font-bold">${user.username}</td>
                        <td class="text-sm color-danger font-bold"><i class="fa-solid fa-coins"></i> ${user.coins}</td>
                    </tr>
                `;
            });

            scoreboardBody.innerHTML += `
                <tr style="background: rgba(61, 90, 254, 0.1);">
                    <td class="font-black text-center">${data.current_user.rank}</td>
                    <td class="text-sm font-bold">${data.current_user.username} (Anda)</td>
                    <td class="text-sm color-danger font-bold"><i class="fa-solid fa-coins"></i> ${data.current_user.coins}</td>
                </tr>
            `;
        } catch (e) {
            scoreboardBody.innerHTML =
                '<tr><td colspan="3" class="text-xs text-center p-1">Gagal memuat papan peringkat.</td></tr>';
        }
    }

    if (slotsContainer) loadSlots();
    if (scoreboardBody) loadScoreboard();
});

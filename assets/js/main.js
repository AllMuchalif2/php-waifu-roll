document.addEventListener("DOMContentLoaded", () => {
  const rollBtn = document.getElementById("roll-btn");
  const resultDiv = document.getElementById("gacha-result");
  const slotsContainer = document.getElementById("slots-container");
  const scoreboardBody = document.getElementById("scoreboard-body");

  if (rollBtn) {
    rollBtn.addEventListener("click", async () => {
      await executeRoll(null);
    });
  }

  async function executeRoll(slotNumber) {
    if (rollBtn) rollBtn.disabled = true;

    if (resultDiv) {
      resultDiv.innerHTML =
        '<p><i class="fa-solid fa-spinner fa-spin"></i> Menggacha...</p>';
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
                        <h3>${data.message}</h3>
                        <p><strong>${data.waifu.name}</strong> [Tier: ${data.waifu.tier}]</p>
                        <img src="${data.waifu.image_url}" loading="lazy" class="waifu-img" alt="Waifu">
                    `;
        }
        if (slotsContainer) loadSlots();
      } else {
        if (resultDiv) {
          resultDiv.innerHTML = `<p class="error-text"><i class="fa-solid fa-triangle-exclamation"></i> ${data.error}</p>`;
        }
      }
    } catch (e) {
      if (resultDiv) {
        resultDiv.innerHTML = `<p class="error-text"><i class="fa-solid fa-triangle-exclamation"></i> Terjadi kesalahan jaringan.</p>`;
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
        div.className = `slot-item ${slot.owner_id ? "claimed" : ""}`;
        div.innerHTML = `${slot.slot_number}`;

        if (!slot.owner_id) {
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
        '<p class="error-text">Gagal memuat slot terbatas.</p>';
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
                        <td>${index + 1}</td>
                        <td>${user.username}</td>
                        <td><i class="fa-solid fa-coins"></i> ${user.coins}</td>
                    </tr>
                `;
      });

      scoreboardBody.innerHTML += `
                <tr class="separator">
                    <td colspan="3"></td>
                </tr>
                <tr class="current-user">
                    <td>${data.current_user.rank}</td>
                    <td>${data.current_user.username} (Anda)</td>
                    <td><i class="fa-solid fa-coins"></i> ${data.current_user.coins}</td>
                </tr>
            `;
    } catch (e) {
      scoreboardBody.innerHTML =
        '<tr><td colspan="3" class="error-text">Gagal memuat papan peringkat.</td></tr>';
    }
  }

  loadSlots();
  loadScoreboard();
});

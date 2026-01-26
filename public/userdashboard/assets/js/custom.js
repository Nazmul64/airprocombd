// ========================
// Element References
// ========================
const sidebar = document.getElementById("sidebar");
const hamburgerBtn = document.getElementById("hamburgerBtn");
const overlay = document.getElementById("overlay");
const header = document.querySelector("header");
const headerColorInput = document.getElementById("headerColor");
const headerAlphaInput = document.getElementById("headerAlpha");
const darkModeToggle = document.getElementById("darkModeToggle");
const copyReferralBtn = document.getElementById("copyReferralBtn");
const referralInput = document.getElementById("referral-url");
const themeCustomizerBtn = document.getElementById("themeCustomizerBtn");
const themeCustomizer = document.getElementById("themeCustomizer");
const colorPalette = document.querySelectorAll(".color-palette span");
const closeSidebarBtn = document.getElementById("closeSidebarBtn");

// ========================
// Utility Functions
// ========================
const hexToRgb = (hex) => {
    const clean = hex.replace("#", "");
    return {
        r: parseInt(clean.slice(0, 2), 16),
        g: parseInt(clean.slice(2, 4), 16),
        b: parseInt(clean.slice(4, 6), 16),
    };
};

const rgbToHex = (rgbString) => {
    const rgbMatch = rgbString.match(/\d+/g);
    if (!rgbMatch) return null;
    return (
        "#" +
        rgbMatch
            .slice(0, 3)
            .map((v) => parseInt(v).toString(16).padStart(2, "0"))
            .join("")
    );
};

// ========================
// Sidebar Functions
// ========================
const openSidebar = () => {
    sidebar.classList.add("mobile-visible");
    overlay.classList.add("active");
    overlay.setAttribute("aria-hidden", "false");
};

const closeSidebar = () => {
    sidebar.classList.remove("mobile-visible");
    overlay.classList.remove("active");
    overlay.setAttribute("aria-hidden", "true");
};

const toggleSidebar = () => {
    sidebar.classList.contains("mobile-visible")
        ? closeSidebar()
        : openSidebar();
};

// ========================
// Header Color Update
// ========================
const updateHeaderBgColor = () => {
    try {
        const hex = headerColorInput?.value || "#072029";
        const alpha = parseFloat(headerAlphaInput?.value ?? 1);
        const { r, g, b } = hexToRgb(hex);

        header.style.backgroundColor = `rgba(${r}, ${g}, ${b}, ${alpha})`;

        // Adjust text color based on luminance
        const luminance = (0.299 * r + 0.587 * g + 0.114 * b) / 255;
        header.style.color =
            luminance > 0.6
                ? "#222"
                : getComputedStyle(document.body).color || "#c7c9cd";
    } catch {
        // Ignore invalid colors
    }
};

// ========================
// Dark Mode
// ========================
const setLightMode = (enabled) => {
    document.body.classList.toggle("light-mode", enabled);
    darkModeToggle?.setAttribute("aria-pressed", enabled);
};

const toggleDarkMode = () => {
    setLightMode(!document.body.classList.contains("light-mode"));
};

// ========================
// Referral Copy
// ========================
const copyReferral = () => {
    const text = referralInput?.value || "";
    if (!text) {
        alert("No referral URL available.");
        return;
    }

    navigator.clipboard
        ?.writeText(text)
        .then(() => alert("Referral URL copied!"))
        .catch(() => {
            referralInput.select();
            try {
                document.execCommand("copy");
                alert("Referral URL copied!");
            } catch {
                alert("Copy not supported — please copy manually.");
            }
            window.getSelection().removeAllRanges();
        });
};

// ========================
// Theme Customizer
// ========================
const toggleThemeCustomizer = () => {
    themeCustomizer.classList.toggle("active");
    themeCustomizerBtn?.setAttribute(
        "aria-expanded",
        themeCustomizer.classList.contains("active")
    );
};

// ========================
// Color Palette Handler
// ========================
const onColorPaletteClick = (span) => {
    colorPalette.forEach((s) => s.classList.remove("selected"));
    span.classList.add("selected");

    const hex = rgbToHex(getComputedStyle(span).backgroundColor);
    if (hex && headerColorInput) {
        headerColorInput.value = hex;
    }

    updateHeaderBgColor();
};

// ========================
// Event Listeners
// ========================
hamburgerBtn?.addEventListener("click", toggleSidebar);
hamburgerBtn?.addEventListener("keydown", (e) => {
    if (["Enter", " "].includes(e.key)) {
        e.preventDefault();
        toggleSidebar();
    }
});

overlay?.addEventListener("click", closeSidebar);
overlay?.addEventListener("keydown", (e) => {
    if (e.key === "Escape") closeSidebar();
});

closeSidebarBtn?.addEventListener("click", closeSidebar);

headerColorInput?.addEventListener("input", updateHeaderBgColor);
headerAlphaInput?.addEventListener("input", updateHeaderBgColor);
updateHeaderBgColor();

darkModeToggle?.addEventListener("click", toggleDarkMode);
darkModeToggle?.addEventListener("keydown", (e) => {
    if (["Enter", " "].includes(e.key)) {
        e.preventDefault();
        toggleDarkMode();
    }
});

copyReferralBtn?.addEventListener("click", copyReferral);
themeCustomizerBtn?.addEventListener("click", toggleThemeCustomizer);

colorPalette.forEach((span) => {
    span.addEventListener("click", () => onColorPaletteClick(span));
});

window.addEventListener("resize", () => {
    if (window.innerWidth > 768) {
        overlay.classList.remove("active");
        sidebar.classList.remove("mobile-visible");
    }
});

document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && sidebar.classList.contains("mobile-visible")) {
        closeSidebar();
    }
});

// profile image auto javascript
// Profile Image Preview
document
    .getElementById("profileImageInput")
    .addEventListener("change", function (event) {
        let reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById("profilePreview").src = e.target.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    });

// copy javascript link url copy
document
    .getElementById("copyReferralBtn")
    .addEventListener("click", function () {
        let input = document.getElementById("referral-url");

        // Check if there's a valid referral URL
        if (
            input.value === "Referral code not available" ||
            input.value.trim() === ""
        ) {
            alert("No referral code available to copy!");
            return;
        }

        input.select();
        input.setSelectionRange(0, 99999);

        try {
            // Modern way
            navigator.clipboard
                .writeText(input.value)
                .then(function () {
                    alert("Referral link copied successfully!");
                })
                .catch(function () {
                    // Fallback for older browsers
                    document.execCommand("copy");
                    alert("Referral link copied!");
                });
        } catch (err) {
            // Final fallback
            document.execCommand("copy");
            alert("Referral link copied!");
        }
    });

// lottery resutel javascript
const randomCheckbox = document.getElementById("randomCheckbox");
const manualSelect = document.getElementById("manual-select");

randomCheckbox.addEventListener("change", function () {
    manualSelect.style.display = this.checked ? "none" : "block";
});

// Show prize input when a user is selected
document.querySelectorAll(".user-list").forEach((list) => {
    list.addEventListener("change", function (e) {
        if (e.target.type === "radio") {
            const prizeInput =
                this.closest(".winner-section").querySelector(".prize-input");
            prizeInput.style.display = "block";
        }
    });
});

// 🔎 Search filter
document.getElementById("searchBox").addEventListener("keyup", function () {
    const query = this.value.toLowerCase();
    document.querySelectorAll(".user-item").forEach((item) => {
        const name = item.dataset.name;
        item.style.display = name.includes(query) ? "block" : "none";
    });
});

// end

// lottery show javascript
document.getElementById("lotterySearch").addEventListener("keyup", function () {
    let filter = this.value.toLowerCase();
    document.querySelectorAll("#lotteryTable tbody tr").forEach((row) => {
        row.style.display = row.cells[0].textContent
            .toLowerCase()
            .includes(filter)
            ? ""
            : "none";
    });
});

// end

// DOM Elements
const loading = document.getElementById("tour-loading");
const loadingTitle = document.getElementById("loading-title");
const loadingPercent = document.getElementById("loading-percent");
const progressBar = document.querySelector(".loading-progress-bar");
const homeLogo = document.getElementById("home-logo");

let progressInterval;
let hideTimeout;
let pendingLoadingText = null;
let viewer;

// Loading Handlers
function startLoading(text) {
    if (!loading) return;

    if (hideTimeout) {
        clearTimeout(hideTimeout);
        hideTimeout = null;
    }

    loading.classList.remove("hidden");
    if (loadingTitle) loadingTitle.textContent = text;
    if (progressBar) progressBar.style.width = "0%";
    if (loadingPercent) loadingPercent.textContent = "0%";
    
    clearInterval(progressInterval);

    let progress = 0;
    progressInterval = setInterval(() => {
        if (progress < 90) {
            progress += Math.floor(Math.random() * 6) + 2;
            if (progress > 90) progress = 90;
            
            if (progressBar) progressBar.style.width = progress + "%";
            if (loadingPercent) loadingPercent.textContent = progress + "%";
        }
    }, 100);
}

function finishLoading() {
    clearInterval(progressInterval);
    if (progressBar) progressBar.style.width = "100%";
    if (loadingPercent) loadingPercent.textContent = "100%";

    if (hideTimeout) clearTimeout(hideTimeout);
    hideTimeout = setTimeout(() => {
        if (loading) loading.classList.add("hidden");
        hideTimeout = null;
    }, 400);
}

// Custom Hotspot UI Component
function createCustomHotspot(hotSpotDiv, args) {
    hotSpotDiv.classList.add("custom-hotspot");
    hotSpotDiv.style.margin = "0";
    hotSpotDiv.style.padding = "0";
    hotSpotDiv.style.background = "transparent";
    hotSpotDiv.style.border = "none";

    hotSpotDiv.innerHTML = `
        <div class="custom-hotspot-icon">
            <div class="custom-hotspot-arrow"></div>
        </div>
        <div class="custom-hotspot-label">${args || ""}</div>
    `;
}

// Scene Transition Handler
function goToScene(sceneId, loadingText) {
    if (!viewer || viewer.getScene() === sceneId) return;

    pendingLoadingText = loadingText || null;
    viewer.loadScene(sceneId);
}

// Virtual Tour Configuration
const tourConfig = {
    "default": {
        "firstScene": "gerbang",
        "sceneFadeDuration": 800,
        "autoLoad": true,
        "showLoadingHint": false, // MEMATIKAN LOADING BAWAAN PANNELLUM (MENCEGAH LOADING GANDA)
        "showZoomCtrl": false,
        "showFullscreenCtrl": false,
        "showControls": false,
        "compass": false,
        "hotSpotDebug": false
    },
    "scenes": {
        "gerbang": {
            "title": "Depan Gerbang Sekolah",
            "type": "equirectangular",
            "panorama": "/virtual-tour/panoramas/lantai1/depangerbangmawa.jpg",
            "hotSpots": [
                {
                    "pitch": 4.79,
                    "yaw": 0.80,
                    "type": "scene",
                    "text": "Menuju Koridor Tengah",
                    "sceneId": "koridor",
                    "createTooltipFunc": createCustomHotspot,
                    "createTooltipArgs": "Menuju Koridor Tengah",
                    "clickHandlerFunc": () => goToScene("koridor", "Menuju Koridor Tengah")
                }
            ]
        },
        "koridor": {
            "title": "Koridor Tengah",
            "type": "equirectangular",
            "panorama": "/virtual-tour/panoramas/lantai1/koridor.jpg",
            "hotSpots": [
                {
                    "pitch": -5,
                    "yaw": 337,
                    "type": "scene",
                    "text": "Kembali ke Depan Gerbang",
                    "sceneId": "gerbang",
                    "createTooltipFunc": createCustomHotspot,
                    "createTooltipArgs": "Kembali ke Depan Gerbang",
                    "clickHandlerFunc": () => goToScene("gerbang", "Kembali ke Depan Gerbang")
                },
                {
                    "pitch": 2,
                    "yaw": 188,
                    "type": "scene",
                    "text": "Menuju Halaman",
                    "sceneId": "halaman",
                    "createTooltipFunc": createCustomHotspot,
                    "createTooltipArgs": "Menuju Halaman",
                    "clickHandlerFunc": () => goToScene("halaman", "Menuju Halaman")
                },
                {
                    "pitch": 0,
                    "yaw": 85,
                    "type": "scene",
                    "text": "Menuju Kantin Sekolah",
                    "sceneId": "kantin",
                    "createTooltipFunc": createCustomHotspot,
                    "createTooltipArgs": "Menuju Kantin Sekolah",
                    "clickHandlerFunc": () => goToScene("kantin", "Menuju Kantin Sekolah")
                }
            ]
        },
        "kantin": {
            "title": "Kantin Sekolah",
            "type": "equirectangular",
            "panorama": "/virtual-tour/panoramas/lantai1/kantinkiri.jpg",
            "hotSpots": [
                {
                    "pitch": 3,
                    "yaw": 0,
                    "type": "scene",
                    "text": "Kembali ke Koridor",
                    "sceneId": "koridor",
                    "createTooltipFunc": createCustomHotspot,
                    "createTooltipArgs": "Kembali ke Koridor",
                    "clickHandlerFunc": () => goToScene("koridor", "Kembali ke Koridor")
                }
            ]
        },
        "halaman": {
            "title": "Halaman Sekolah",
            "type": "equirectangular",
            "panorama": "/virtual-tour/panoramas/lantai1/lapangan.jpg",
            "hotSpots": [
                {
                    "pitch": 3,
                    "yaw": 173,
                    "type": "scene",
                    "text": "Kembali ke Koridor",
                    "sceneId": "koridor",
                    "createTooltipFunc": createCustomHotspot,
                    "createTooltipArgs": "Kembali ke Koridor",
                    "clickHandlerFunc": () => goToScene("koridor", "Kembali ke Koridor")
                },
                {
                    "pitch": 175,
                    "yaw": 180,
                    "type": "scene",
                    "text": "Menuju Halaman Tengah",
                    "sceneId": "halaman-tengah",
                    "createTooltipFunc": createCustomHotspot,
                    "createTooltipArgs": "Menuju Halaman Tengah",
                    "clickHandlerFunc": () => goToScene("halaman-tengah", "Menuju Halaman Tengah")
                },
                {
                    "pitch": 180,
                    "yaw": 90,
                    "type": "scene",
                    "text": "Menuju Halaman Kiri",
                    "sceneId": "halaman-kiri",
                    "createTooltipFunc": createCustomHotspot,
                    "createTooltipArgs": "Menuju Halaman Kiri",
                    "clickHandlerFunc": () => goToScene("halaman-kiri", "Menuju Halaman Kiri")
                },
                {
                    "pitch": 175,
                    "yaw": -95,
                    "type": "scene",
                    "text": "Menuju Halaman Kanan",
                    "sceneId": "halaman-kanan",
                    "createTooltipFunc": createCustomHotspot,
                    "createTooltipArgs": "Menuju Halaman Kanan",
                    "clickHandlerFunc": () => goToScene("halaman-kanan", "Menuju Halaman Kanan")
                }
            ]
        },
        "halaman-tengah": {
            "title": "Halaman Tengah Sekolah",
            "type": "equirectangular",
            "panorama": "/virtual-tour/panoramas/lantai1/halamantengah.jpg",
            "hotSpots": [
                {
                    "pitch": 3,
                    "yaw": 0,
                    "type": "scene",
                    "text": "Kembali ke Halaman",
                    "sceneId": "halaman",
                    "createTooltipFunc": createCustomHotspot,
                    "createTooltipArgs": "Kembali ke Halaman",
                    "clickHandlerFunc": () => goToScene("halaman", "Kembali ke Halaman")
                }
            ]
        },
        "halaman-kiri": {
            "title": "Halaman Kiri Sekolah",
            "type": "equirectangular",
            "panorama": "/virtual-tour/panoramas/lantai1/halamankiri.jpg",
            "hotSpots": [
                {
                    "pitch": 3,
                    "yaw": 0,
                    "type": "scene",
                    "text": "Kembali ke Halaman",
                    "sceneId": "halaman",
                    "createTooltipFunc": createCustomHotspot,
                    "createTooltipArgs": "Kembali ke Halaman",
                    "clickHandlerFunc": () => goToScene("halaman", "Kembali ke Halaman")
                }
            ]
        },
        "halaman-kanan": {
            "title": "Halaman Kanan Sekolah",
            "type": "equirectangular",
            "panorama": "/virtual-tour/panoramas/lantai1/halamankanan.jpg",
            "hotSpots": [
                {
                    "pitch": 3,
                    "yaw": -60,
                    "type": "scene",
                    "text": "Kembali ke Halaman",
                    "sceneId": "halaman",
                    "createTooltipFunc": createCustomHotspot,
                    "createTooltipArgs": "Kembali ke Halaman",
                    "clickHandlerFunc": () => goToScene("halaman", "Kembali ke Halaman")
                },
                {
                    "pitch": 3,
                    "yaw": 0,
                    "type": "scene",
                    "text": "Menuju Halaman Tengah",
                    "sceneId": "halaman-tengah",
                    "createTooltipFunc": createCustomHotspot,
                    "createTooltipArgs": "Menuju Halaman Tengah",
                    "clickHandlerFunc": () => goToScene("halaman-tengah", "Menuju Halaman Tengah")
                }
            ]
        }
    }
};

// =========================================
//   NAVBAR: NAVIGASI SCENE
// =========================================
const floorScenes = {
    lantai1: [
        { id: "gerbang", label: "Depan Gerbang Sekolah" },
        { id: "koridor", label: "Koridor Tengah" },
        { id: "kantin", label: "Kantin Sekolah" },
        { id: "halaman", label: "Halaman Sekolah" },
        { id: "halaman-tengah", label: "Halaman Tengah Sekolah" },
        { id: "halaman-kiri", label: "Halaman Kiri Sekolah" },
        { id: "halaman-kanan", label: "Halaman Kanan Sekolah" }
    ]
};

const navMenuEl = document.getElementById("navbar-menu");
const navToggleEl = document.getElementById("nav-toggle");
const navItems = document.querySelectorAll(".nav-item.has-dropdown");

function setNavMenu(isOpen) {
    if (!navMenuEl || !navToggleEl) return;

    navMenuEl.classList.toggle("active", isOpen);
    navToggleEl.classList.toggle("active", isOpen);
    navToggleEl.setAttribute("aria-expanded", isOpen ? "true" : "false");
    navToggleEl.setAttribute("aria-label", isOpen ? "Tutup menu" : "Buka menu");
}

function closeAllDropdowns(exceptItem) {
    navItems.forEach((item) => {
        if (item === exceptItem) return;

        item.classList.remove("open");
        const toggle = item.querySelector(".nav-dropdown-toggle");
        if (toggle) toggle.setAttribute("aria-expanded", "false");
    });
}

function buildDropdown(dropdown, scenes) {
    scenes.forEach((scene) => {
        const item = document.createElement("li");
        const link = document.createElement("a");

        link.href = "#";
        link.className = "nav-dropdown-item";
        link.dataset.scene = scene.id;
        link.textContent = scene.label;

        link.addEventListener("click", (e) => {
            e.preventDefault();

            const alreadyActive = viewer && viewer.getScene() === scene.id;
            closeAllDropdowns();
            setNavMenu(false);

            if (!alreadyActive) goToScene(scene.id, scene.label);
        });

        item.appendChild(link);
        dropdown.appendChild(item);
    });
}

function updateActiveNav(sceneId) {
    document.querySelectorAll(".nav-dropdown-item").forEach((item) => {
        item.classList.toggle("active", item.dataset.scene === sceneId);
    });

    navItems.forEach((item) => {
        const toggle = item.querySelector(".nav-dropdown-toggle");
        if (!toggle) return;

        const hasActiveScene = !!item.querySelector(".nav-dropdown-item.active");
        toggle.classList.toggle("active", hasActiveScene);
    });
}

navItems.forEach((item) => {
    const dropdown = item.querySelector(".nav-dropdown");
    const toggle = item.querySelector(".nav-dropdown-toggle");
    const floor = dropdown ? dropdown.getAttribute("data-dropdown") : null;
    const scenes = floorScenes[floor];

    if (!toggle) return;

    if (!scenes || !scenes.length) {
        toggle.classList.add("is-disabled");
        toggle.setAttribute("aria-disabled", "true");

        const soon = document.createElement("span");
        soon.className = "nav-soon";
        soon.textContent = "Segera";
        toggle.appendChild(soon);

        if (dropdown) {
            const empty = document.createElement("li");
            empty.className = "nav-dropdown-empty";
            empty.textContent = "Scene lantai ini belum tersedia.";
            dropdown.appendChild(empty);
        }
        return;
    }

    buildDropdown(dropdown, scenes);

    toggle.addEventListener("click", (e) => {
        e.stopPropagation();

        const willOpen = !item.classList.contains("open");
        closeAllDropdowns(item);
        item.classList.toggle("open", willOpen);
        toggle.setAttribute("aria-expanded", willOpen ? "true" : "false");
    });
});

if (navToggleEl) {
    navToggleEl.addEventListener("click", (e) => {
        e.stopPropagation();
        setNavMenu(!navMenuEl.classList.contains("active"));
    });
}

document.addEventListener("click", (e) => {
    if (!e.target.closest(".nav-item.has-dropdown")) closeAllDropdowns();
});

document.addEventListener("keydown", (e) => {
    if (e.key !== "Escape") return;

    closeAllDropdowns();
    setNavMenu(false);
});

// Start Loading saat pertama kali buka
startLoading("Memuat Virtual Tour");

// Initialize Pannellum Viewer
viewer = pannellum.viewer("panorama", tourConfig);

// Event Handlers
viewer.on("scenechange", (sceneId) => {
    const scene = tourConfig.scenes[sceneId];
    startLoading(pendingLoadingText || (scene && scene.title) || "Memuat Virtual Tour");
    pendingLoadingText = null;
});

viewer.on("load", () => {
    console.log("Scene dimuat:", viewer.getScene());
    updateActiveNav(viewer.getScene());
    finishLoading();
});

viewer.on("error", (error) => {
    console.error("Pannellum Error:", error);
    finishLoading();
});

if (viewer.isLoaded()) {
    finishLoading();
}

if (homeLogo) {
    homeLogo.addEventListener("click", () => {
        if (viewer.getScene() !== "gerbang") {
            goToScene("gerbang", "Kembali ke Depan Gerbang Sekolah");
        }
    });
}
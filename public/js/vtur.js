// DOM Elements
const loading = document.getElementById("tour-loading");
const loadingTitle = document.getElementById("loading-title");
const loadingPercent = document.getElementById("loading-percent");
const progressBar = document.getElementById("loading-progress-bar");
const homeLogo = document.getElementById("home-logo");

let progressInterval;
let hideTimeout;
let pendingLoadingText = null;
let viewer;
let loadingProgress = 0;
let loadingRun = 0;

// Loading Handlers
function setLoadingProgress(progress) {
    const requestedProgress = Number(progress);
    const clampedProgress = Number.isFinite(requestedProgress)
        ? Math.max(0, Math.min(100, requestedProgress))
        : 0;

    if (progressBar) progressBar.style.width = clampedProgress + "%";

    // Read back the applied width so the text and bar always share one state.
    loadingProgress = progressBar
        ? parseFloat(progressBar.style.width) || 0
        : clampedProgress;
    if (loadingPercent) loadingPercent.textContent = loadingProgress + "%";
}
function startLoading(text) {
    if (!loading) return;

    if (hideTimeout) {
        clearTimeout(hideTimeout);
        hideTimeout = null;
    }

    loading.classList.remove("hidden");
    if (loadingTitle) loadingTitle.textContent = text;
    clearInterval(progressInterval);
    const currentRun = ++loadingRun;
    setLoadingProgress(0);

    const simulatedProgress = [25, 50, 75, 95];
    let progressIndex = 0;
    progressInterval = setInterval(() => {
        if (currentRun !== loadingRun) return;

        if (progressIndex < simulatedProgress.length) {
            setLoadingProgress(simulatedProgress[progressIndex]);
            progressIndex += 1;
        }
    }, 250);
}

function finishLoading() {
    clearInterval(progressInterval);
    setLoadingProgress(100);

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
                },
                {
                    "pitch": 3,
                    "yaw": 85,
                    "type": "scene",
                    "text": "Menuju Depan Bengkel TP",
                    "sceneId": "depanbengkeltp",
                    "createTooltipFunc": createCustomHotspot,
                    "createTooltipArgs": "Menuju Depan Bengkel TP",
                    "clickHandlerFunc": () => goToScene("depanbengkeltp", "Menuju Depan Bengkel TP")
                },
                {
                    "pitch": 3,
                    "yaw": 180,
                    "type": "scene",
                    "text": "Menuju Depan Ruang SPMB",
                    "sceneId": "depanruangspmb",
                    "createTooltipFunc": createCustomHotspot,
                    "createTooltipArgs": "Menuju Depan Ruang SPMB",
                    "clickHandlerFunc": () => goToScene("depanruangspmb", "Menuju Depan Ruang SPMB")
                },
                {
                    "pitch": 3,
                    "yaw": 270,
                    "type": "scene",
                    "text": "Menuju Lorong Kanan",
                    "sceneId": "lorongkanan",
                    "createTooltipFunc": createCustomHotspot,
                    "createTooltipArgs": "Menuju Lorong Kanan",
                    "clickHandlerFunc": () => goToScene("lorongkanan", "Menuju Lorong Kanan")
                }
            ]
        },
        "depanbengkeltp": {
            "title": "Depan Bengkel TP",
            "type": "equirectangular",
            "panorama": "/virtual-tour/panoramas/lantai1/depanbengkeltp.jpg",
            "hotSpots": [
                {
                    "pitch": 0,
                    "yaw": 175,
                    "type": "scene",
                    "text": "Kembali ke Halaman Tengah",
                    "sceneId": "halaman-tengah",
                    "createTooltipFunc": createCustomHotspot,
                    "createTooltipArgs": "Kembali ke Halaman Tengah",
                    "clickHandlerFunc": () => goToScene("halaman-tengah", "Kembali ke Halaman Tengah")
                }
            ]
        },
        "depanruangspmb": {
            "title": "Depan Ruang SPMB",
            "type": "equirectangular",
            "panorama": "/virtual-tour/panoramas/lantai1/depanruangspmb.jpg",
            "hotSpots": [
                {
                    "pitch": 0,
                    "yaw": 0,
                    "type": "scene",
                    "text": "Kembali ke Halaman Tengah",
                    "sceneId": "halaman-tengah",
                    "createTooltipFunc": createCustomHotspot,
                    "createTooltipArgs": "Kembali ke Halaman Tengah",
                    "clickHandlerFunc": () => goToScene("halaman-tengah", "Kembali ke Halaman Tengah")
                },
                {
                    "pitch": -3,
                    "yaw": -85,
                    "type": "scene",
                    "text": "Menuju Pertigaan Lorong Kanan",
                    "sceneId": "pertigaanlorongkanan",
                    "createTooltipFunc": createCustomHotspot,
                    "createTooltipArgs": "Menuju Pertigaan Lorong Kanan",
                    "clickHandlerFunc": () => goToScene("pertigaanlorongkanan", "Menuju Pertigaan Lorong Kanan")
                },
                {
                    "pitch": 0,
                    "yaw": 90,
                    "type": "scene",
                    "text": "Menuju Musholla",
                    "sceneId": "musholla",
                    "createTooltipFunc": createCustomHotspot,
                    "createTooltipArgs": "Menuju Musholla",
                    "clickHandlerFunc": () => goToScene("musholla", "Menuju Musholla")
                }
            ]
        },
        "pertigaanlorongkanan": {
            "title": "Pertigaan Lorong Kanan",
            "type": "equirectangular",
            "panorama": "/virtual-tour/panoramas/lantai1/pertigaanlorongkanan.jpg",
            "hotSpots": [
                {
                    "pitch": 0,
                    "yaw": 0,
                    "type": "scene",
                    "text": "kembali ke Depan Ruang SPMB",
                    "sceneId": "depanruangspmb",
                    "createTooltipFunc": createCustomHotspot,
                    "createTooltipArgs": "Kembali ke Depan Ruang SPMB",
                    "clickHandlerFunc": () => goToScene("depanruangspmb", "Kembali ke Depan Ruang SPMB")
                },
                {
                    "pitch": 0,
                    "yaw": -85,
                    "type": "scene",
                    "text": "Menuju Depan Kelas X TKJ",
                    "sceneId": "depankelasxtkj",
                    "createTooltipFunc": createCustomHotspot,
                    "createTooltipArgs": "Menuju Depan Kelas X TKJ",
                    "clickHandlerFunc": () => goToScene("depankelasxtkj", "Menuju Depan Kelas X TKJ")
                }
            ]
        },
        "depankelasxtkj": {
            "title": "Depan Kelas X TKJ",
            "type": "equirectangular",
            "panorama": "/virtual-tour/panoramas/lantai1/depankelasxtkj.jpg",
            "hotSpots": [
                {
                    "pitch": 0,
                    "yaw": -65,
                    "type": "scene",
                    "text": "Menuju Pertigaan Lorong Kanan",
                    "sceneId": "pertigaanlorongkanan",
                    "createTooltipFunc": createCustomHotspot,
                    "createTooltipArgs": "Menuju Pertigaan Lorong Kanan",
                    "clickHandlerFunc": () => goToScene("pertigaanlorongkanan", "Menuju Pertigaan Lorong Kanan")
                },
                {
                    "pitch": -15,
                    "yaw": 115,
                    "type": "scene",
                    "text": "Menuju Lorong Kanan",
                    "sceneId": "lorongkanan",
                    "createTooltipFunc": createCustomHotspot,
                    "createTooltipArgs": "Menuju Lorong Kanan",
                    "clickHandlerFunc": () => goToScene("lorongkanan", "Menuju Lorong Kanan")
                },
                {
                    "pitch": 5,
                    "yaw": 210,
                    "type": "scene",
                    "text": "Menuju Tangga Lab Lantai 2",
                    "sceneId": "tanggalablantai2",
                    "createTooltipFunc": createCustomHotspot,
                    "createTooltipArgs": "Menuju Tangga Lab Lantai 2",
                    "clickHandlerFunc": () => goToScene("tanggalablantai2", "Menuju Tangga Lab Lantai 2")
                }
            ]
        },
        "tanggalablantai2": {
            "title": "Tangga Lab Lantai 2",
            "type": "equirectangular",
            "panorama": "/virtual-tour/panoramas/lantai1/tanggalablantai2.jpg",
            "hotSpots": [
               
                {
                    "pitch": 10,
                    "yaw": 100,
                    "type": "scene",
                    "text": "Depan Tangga Lorong Lab Lantai 2",
                    "sceneId": "tanggaloronglablantai2",
                    "createTooltipFunc": createCustomHotspot,
                    "createTooltipArgs": "Menuju Tangga Lorong Lab Lantai 2",
                    "clickHandlerFunc": () => goToScene("tanggaloronglablantai2", "Menuju Tangga Lorong Lab Lantai 2")
                },
                {
                    "pitch": -30,
                    "yaw": 0,
                    "type": "scene",
                    "text": "Menuju Depan Kelas X TKJ",
                    "sceneId": "depankelasxtkj",
                    "createTooltipFunc": createCustomHotspot,
                    "createTooltipArgs": "Menuju Depan Kelas X TKJ",
                    "clickHandlerFunc": () => goToScene("depankelasxtkj", "Menuju Depan Kelas X TKJ")
                }
            ]
        },
        "tanggaloronglablantai2": {
            "title": "Tangga Lorong Lab Lantai 2",
            "floor": 2,
            "type": "equirectangular",
            "panorama": "/virtual-tour/panoramas/lantai2/depantanggaloronglablantai2.jpg",
            "hotSpots": [
                {
                    "pitch": -30,
                    "yaw": -90,
                    "type": "scene",
                    "text": "Kembali ke Depan Tangga Lab Lantai 2",
                    "sceneId": "tanggalablantai2",
                    "createTooltipFunc": createCustomHotspot,
                    "createTooltipArgs": "Kembali ke Depan Tangga Lab Lantai 2",
                    "clickHandlerFunc": () => goToScene("tanggalablantai2", "Kembali ke Depan Tangga Lab Lantai 2")
                },
                {
                    "pitch": 15,
                    "yaw": 0,
                    "type": "scene",
                    "text": "Menuju Lorong Lab Lantai 2",
                    "sceneId": "loronglablantai2",
                    "createTooltipFunc": createCustomHotspot,
                    "createTooltipArgs": "Menuju Lorong Lab Lantai 2",
                    "clickHandlerFunc": () => goToScene("loronglablantai2", "Menuju Lorong Lab Lantai 2")
                },
               
            ]
        },
        "lorongkanan": {
            "title": "Lorong Kanan",
            "type": "equirectangular",
            "panorama": "/virtual-tour/panoramas/lantai1/lorongkanan.jpg",
            "hotSpots": [
                {
                    "pitch": -10,
                    "yaw": 90,
                    "type": "scene",
                    "text": "Menuju ke Depan Kelas X TKJ",
                    "sceneId": "depankelasxtkj",
                    "createTooltipFunc": createCustomHotspot,
                    "createTooltipArgs": "Menuju ke Depan Kelas X TKJ",
                    "clickHandlerFunc": () => goToScene("depankelasxtkj", "Kembali ke Depan Kelas X TKJ")
                },
                {
                    "pitch": 0,
                    "yaw": 90,
                    "type": "scene",
                    "text": "Menuju Pertigaan Lorong Kanan",
                    "sceneId": "pertigaanlorongkanan",
                    "createTooltipFunc": createCustomHotspot,
                    "createTooltipArgs": "Menuju Pertigaan Lorong Kanan",
                    "clickHandlerFunc": () => goToScene("pertigaanlorongkanan", "Menuju Pertigaan Lorong Kanan")
                },
                {
                    "pitch": -5,
                    "yaw": 0,
                    "type": "scene",
                    "text": "Menuju Halaman Tengah",
                    "sceneId": "halaman-tengah",
                    "createTooltipFunc": createCustomHotspot,
                    "createTooltipArgs": "Menuju Halaman Tengah",
                    "clickHandlerFunc": () => goToScene("halaman-tengah", "Menuju Halaman Tengah")
                }
            ]
        },
        "musholla": {
            "title": "Musholla Sekolah",
            "type": "equirectangular",
            "panorama": "/virtual-tour/panoramas/lantai1/depanmusholla.jpg",
            "hotSpots": [
                {
                    "pitch": -5,
                    "yaw": 0,
                    "type": "scene",
                    "text": "kembali ke Depan Ruang SPMB",
                    "sceneId": "depanruangspmb",
                    "createTooltipFunc": createCustomHotspot,
                    "createTooltipArgs": "Kembali ke Depan Ruang SPMB",
                    "clickHandlerFunc": () => goToScene("depanruangspmb", "Kembali ke Depan Ruang SPMB")
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
                    "pitch": -3,
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
        },
        "loronglablantai2": {
            "title": "Lorong Lab Lantai 2",
            "floor": 2,
            "type": "equirectangular",
            "panorama": "/virtual-tour/panoramas/lantai2/loronglablantai2.jpg",
            "hotSpots": [
                {
                    "pitch": -30,
                    "yaw": 110,
                    "type": "scene",
                    "text": "Kembali ke Lorong Lab Lantai 2",
                    "sceneId": "tanggaloronglablantai2",
                    "createTooltipFunc": createCustomHotspot,
                    "createTooltipArgs": "Kembali ke Lorong Lab Lantai 2",
                    "clickHandlerFunc": () => goToScene("loronglablantai2", "Kembali ke Lorong Lab Lantai 2")
                },
                {
                    "pitch": -5,
                    "yaw": -162,
                    "type": "scene",
                    "text": "Menuju Depan Lab Simdig",
                    "sceneId": "depanlabsimdig",
                    "createTooltipFunc": createCustomHotspot,
                    "createTooltipArgs": "Menuju Depan Lab Simdig",
                    "clickHandlerFunc": () => goToScene("depanlabsimdig", "Menuju Depan Lab Simdig")
                }
            ]
        },
        "depanlabsimdig": {
            "title": "Depan Lab Simdig",
            "floor": 2,
            "type": "equirectangular",
            "panorama": "/virtual-tour/panoramas/lantai2/depanlabsimdig.jpg",
            "hotSpots": [
                {
                    "pitch": 0,
                    "yaw": 91,
                    "type": "scene",
                    "text": "Kembali ke Lorong Lab Lantai 2",
                    "sceneId": "tanggaloronglablantai2",
                    "createTooltipFunc": createCustomHotspot,
                    "createTooltipArgs": "Kembali ke Lorong Lab Lantai 2",
                    "clickHandlerFunc": () => goToScene("loronglablantai2", "Kembali ke Lorong Lab Lantai 2")
                },
                {
                    "pitch": -5,
                    "yaw": -100,
                    "type": "scene",
                    "text": "Menuju Depan Lab TKJ",
                    "sceneId": "depanlabtkj",
                    "createTooltipFunc": createCustomHotspot,
                    "createTooltipArgs": "Menuju Depan Lab TKJ",
                    "clickHandlerFunc": () => goToScene("depanlabtkj", "Menuju Depan Lab TKJ")
                }
            ]
        },
        "depanlabtkj": {
            "title": "Depan Lab TKJ",
            "floor": 2,
            "type": "equirectangular",
            "panorama": "/virtual-tour/panoramas/lantai2/depanlabtkj.jpg",
            "hotSpots": [
                {
                    "pitch": -5,
                    "yaw": -100,
                    "type": "scene",
                    "text": "Masuk Ke Lab TKJ",
                    "sceneId": "labtkj",
                    "createTooltipFunc": createCustomHotspot,
                    "createTooltipArgs": "Masuk Ke Lab TKJ",
                    "clickHandlerFunc": () => goToScene("labtkj", "Masuk Ke Lab TKJ")
                },
                {
                    "pitch": 0,
                    "yaw": 0,
                    "type": "scene",
                    "text": "Kembali ke Depan Lab Simdig",
                    "sceneId": "depanlabsimdig",
                    "createTooltipFunc": createCustomHotspot,
                    "createTooltipArgs": "Kembali ke Depan Lab Simdig",
                    "clickHandlerFunc": () => goToScene("depanlabsimdig", "Kembali ke Depan Lab Simdig")
                }
            ]
        },
        "labtkj": {
            "title": "Lab TKJ",
            "floor": 2,
            "type": "equirectangular",
            "panorama": "/virtual-tour/panoramas/lantai2/labtkj.jpg",
            "hotSpots": [
                {
                    "pitch": 0,
                    "yaw": 125,
                    "type": "scene",
                    "text": "Keluar dari Lab TKJ",
                    "sceneId": "depanlabtkj",
                    "createTooltipFunc": createCustomHotspot,
                    "createTooltipArgs": "Keluar dari Lab TKJ",
                    "clickHandlerFunc": () => goToScene("depanlabtkj", "Keluar dari Lab TKJ")
                }
                
            ]
        },
    },
};

// =========================================
//   NAVBAR: NAVIGASI SCENE
// =========================================
const floorScenes = Object.entries(tourConfig.scenes).reduce((floors, [id, scene]) => {
    const floor = scene.floor || 1;
    const key = `lantai${floor}`;

    if (!floors[key]) floors[key] = [];
    floors[key].push({ id, label: scene.title });
    return floors;
}, {});

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
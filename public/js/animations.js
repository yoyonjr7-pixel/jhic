/* =========================================================
   ANIMASI SCROLL REVEAL
   Elemen muncul (fade + naik) saat pertama kali masuk ke area
   yang terlihat ketika pengguna men-scroll ke bawah.

   File ini dimuat di <head> supaya bisa menyembunyikan elemen
   sebelum halaman dirender, sehingga tidak ada kedipan.
========================================================= */
(function () {
    "use strict";

    var REVEAL_TARGETS = [
        "[data-reveal]",
        ".welcome-title",
        ".search-container",
        ".principal-card",
        ".speech-card",
        ".info-header",
        ".accreditation-row",
        ".stat-item",
        ".industry-badge-wrapper",
        ".industry-card",
        ".tefa-content",
        ".achievement-header",
        ".achievement-card",
        ".extracurricular-title",
        ".extracurricular-card",
        ".news-header",
        ".news-card",
        ".news-sidebar",
        ".footer-school",
        ".footer-menu",
        ".footer-news",
        ".footer-bottom"
    ];

    var STAGGER_STEP = 90; // jeda antar elemen bersaudara (ms)
    var STAGGER_MAX = 4;   // batas jumlah langkah jeda

    var doc = document;
    var root = doc.documentElement;
    var selector = REVEAL_TARGETS.join(",");

    // Browser lama tanpa IntersectionObserver: tampilkan tanpa animasi.
    if (!("IntersectionObserver" in window)) {
        return;
    }

    // Sembunyikan target sedini mungkin supaya animasi tidak berkedip.
    function injectStyles() {
        var hidden = REVEAL_TARGETS.map(function (target) {
            return "html.anim-ready " + target;
        }).join(",");

        var staticShown = REVEAL_TARGETS.map(function (target) {
            return "html.anim-ready " + target + ".is-static";
        }).join(",");

        var visible = REVEAL_TARGETS.map(function (target) {
            return "html.anim-ready " + target + ".is-visible";
        }).join(",");

        var css =
            hidden + "{opacity:0;}" +
            staticShown + "{opacity:1;}" +
            visible +
            "{animation:jhicRevealUp .7s cubic-bezier(.22,1,.36,1) both;}";

        var style = doc.createElement("style");
        style.id = "anim-reveal-style";
        style.appendChild(doc.createTextNode(css));
        (doc.head || doc.getElementsByTagName("head")[0]).appendChild(style);
    }

    function init() {
        var elements = Array.prototype.slice.call(doc.querySelectorAll(selector));

        if (!elements.length) {
            return;
        }

        var viewportHeight =
            window.innerHeight || doc.documentElement.clientHeight;
        var siblingIndex = new Map();

        // Beri jeda bertingkat untuk elemen yang bersaudara (satu grup).
        elements.forEach(function (el) {
            var index = 0;
            var parent = el.parentElement;

            if (parent) {
                index = siblingIndex.get(parent) || 0;
                siblingIndex.set(parent, index + 1);
            }

            el.style.animationDelay =
                Math.min(index, STAGGER_MAX) * STAGGER_STEP + "ms";
        });

        var observer = new IntersectionObserver(
            function (entries) {
                entries.forEach(function (entry) {
                    if (!entry.isIntersecting) {
                        return;
                    }

                    entry.target.classList.add("is-visible");
                    observer.unobserve(entry.target);
                });
            },
            {
                threshold: 0,
                rootMargin: "0px 0px -8% 0px"
            }
        );

        elements.forEach(function (el) {
            // Elemen yang sudah terlihat saat halaman dibuka langsung
            // ditampilkan; efek naiknya ditangani animasi <main>.
            if (el.getBoundingClientRect().top < viewportHeight) {
                el.classList.add("is-static");
                return;
            }

            observer.observe(el);
        });
    }

    function start() {
        try {
            injectStyles();
            root.classList.add("anim-ready");
        } catch (error) {
            // Bila gagal, biarkan konten tampil tanpa animasi.
            return;
        }

        function run() {
            try {
                init();
            } catch (error) {
                root.classList.remove("anim-ready");
            }
        }

        if (doc.readyState === "loading") {
            doc.addEventListener("DOMContentLoaded", run);
        } else {
            run();
        }
    }

    start();
})();

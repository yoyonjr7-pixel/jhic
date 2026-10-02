// =========================================================
// JURUSAN & KARIR - PINDAH JURUSAN TANPA REFRESH
// Tab jurusan diambil lewat fetch, lalu hanya bagian yang
// berubah (hero, kartu lowongan, mentor) yang diganti.
// =========================================================

(function () {
    'use strict';

    // Ganti dengan nomor WhatsApp admin: kode negara, hanya angka, tanpa tanda + atau spasi.
    var ADMIN_WHATSAPP = '6283193970194';
    var page = document.querySelector('.page');
    var tabLinks = document.querySelectorAll('.tabs a');

    if (!page || !tabLinks.length || typeof window.fetch !== 'function') {
        return;
    }

    var swapping = false;

    function openWhatsApp(jobButton) {
        var jobTitle = jobButton.getAttribute('data-whatsapp-job');
        var activeTab = document.querySelector('.tab-btn.active');

        if (!jobTitle) {
            return;
        }

        var jurusan = activeTab ? activeTab.textContent.trim() : document.title;
        var message = 'Halo Admin, saya ingin melamar lowongan "' + jobTitle
            + '" dari jurusan ' + jurusan + '.';
        var whatsappUrl = 'https://wa.me/' + ADMIN_WHATSAPP + '?text='
            + encodeURIComponent(message);

        window.open(whatsappUrl, '_blank', 'noopener,noreferrer');
    }

    // Ambil bagian yang berubah dari dokumen hasil fetch.
    function replacePart(selector, freshDoc) {
        var current = page.querySelector(selector);
        var incoming = freshDoc.querySelector(selector);

        if (current && incoming) {
            current.innerHTML = incoming.innerHTML;
        }
    }

    function syncActiveTab(freshDoc) {
        var activeTab = freshDoc.querySelector('.tab-btn.active');
        var key = activeTab ? activeTab.getAttribute('data-tab') : null;

        document.querySelectorAll('.tab-btn').forEach(function (btn) {
            btn.classList.toggle('active', key !== null && btn.getAttribute('data-tab') === key);
        });
    }

    function applyContent(html) {
        var freshDoc = new DOMParser().parseFromString(html, 'text/html');

        replacePart('.hero-art', freshDoc);
        replacePart('#cardsWrap', freshDoc);
        replacePart('.mentor-grid', freshDoc);
        syncActiveTab(freshDoc);

        if (freshDoc.title) {
            document.title = freshDoc.title;
        }
    }

    function isCurrentPage(url) {
        return new URL(url, window.location.href).pathname === window.location.pathname;
    }

    function load(url, pushHistory) {
        if (swapping || isCurrentPage(url)) {
            return;
        }

        swapping = true;
        page.classList.add('is-loading');

        fetch(url, {
            credentials: 'same-origin',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
            .then(function (res) {
                if (!res.ok) {
                    throw new Error('HTTP ' + res.status);
                }

                return res.text();
            })
            .then(function (html) {
                applyContent(html);

                if (pushHistory) {
                    window.history.pushState({ karir: url }, '', url);
                }
            })
            .catch(function () {
                // Jika fetch gagal, kembali ke perilaku normal (pindah halaman).
                window.location.href = url;
            })
            .then(function () {
                swapping = false;
                page.classList.remove('is-loading');
            });
    }

    tabLinks.forEach(function (link) {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            load(link.href, true);
        });
    });

    page.addEventListener('click', function (event) {
        var jobButton = event.target.closest('.lowongan[data-whatsapp-job]');

        if (jobButton) {
            openWhatsApp(jobButton);
        }
    });

    // Tombol back/forward peramban tetap mengganti jurusan tanpa refresh.
    window.addEventListener('popstate', function () {
        load(window.location.href, false);
    });
})();

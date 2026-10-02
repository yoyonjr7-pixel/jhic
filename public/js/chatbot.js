// =========================================================
// MABOT - Panel Chatbot
// Buka/tutup panel + animasi (lihat css/mainfitur.css)
// Balasan diambil dari workflow n8n melalui webhook.
// =========================================================

(function () {
    'use strict';

    // Endpoint n8n diambil dari atribut data-webhook pada <script src="/js/chatbot.js">.
    // Nilainya berasal dari config('services.mabot.webhook') / MABOT_WEBHOOK_URL.
    var WEBHOOK_URL = (function () {
        var tag = document.querySelector('script[src="/js/chatbot.js"]');
        var url = tag && tag.getAttribute('data-webhook');

        return url ? url.trim() : '';
    })();

    var SESSION_KEY = 'mabot_session_id';

    var FALLBACK_REPLY = 'Maaf, saya belum bisa menjawab itu. Silakan hubungi admin sekolah untuk informasi lebih lanjut.';
    var ERROR_REPLY = 'Maaf, layanan chat sedang tidak dapat dihubungi. Silakan coba lagi.';

    // Session ID agar n8n mengenali percakapan yang sama.
    function getSessionId() {
        var id = null;

        try {
            id = window.localStorage.getItem(SESSION_KEY);
        } catch (e) {
            id = null;
        }

        if (!id) {
            id = 'web-' + Date.now().toString(36) + '-' + Math.random().toString(36).slice(2, 10);

            try {
                window.localStorage.setItem(SESSION_KEY, id);
            } catch (e) {
                // localStorage tidak tersedia: pakai id sementara.
            }
        }

        return id;
    }

    // Ambil teks balasan dari berbagai bentuk respons n8n.
    function extractReply(data) {
        if (data === null || data === undefined) {
            return '';
        }

        if (Array.isArray(data)) {
            return data.length ? extractReply(data[0]) : '';
        }

        if (typeof data === 'string') {
            return data.trim();
        }

        // Respons error n8n (mis. workflow belum aktif) jangan ditampilkan ke pengguna.
        if (data.error || (data.code !== undefined && Number(data.code) >= 400)) {
            return '';
        }

        var keys = ['output', 'text', 'reply', 'answer', 'response', 'chatOutput', 'message'];

        for (var i = 0; i < keys.length; i++) {
            var value = data[keys[i]];

            if (typeof value === 'string' && value.trim() !== '') {
                return value.trim();
            }
        }

        return '';
    }

    // Kirim pesan ke webhook n8n (format Chat Trigger).
    function askBot(text) {
        if (!WEBHOOK_URL) {
            return Promise.reject(new Error('Webhook MABOT belum dikonfigurasi.'));
        }

        return fetch(WEBHOOK_URL, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'ngrok-skip-browser-warning': 'true'
            },
            body: JSON.stringify({
                action: 'sendMessage',
                sessionId: getSessionId(),
                chatInput: text
            })
        }).then(function (res) {
            if (!res.ok) {
                throw new Error('HTTP ' + res.status);
            }

            return res.json();
        }).then(function (data) {
            return extractReply(data);
        });
    }

    function init() {
        var toggle = document.getElementById('chatbotToggle');
        var panel = document.getElementById('chatbotPanel');
        var closeBtn = document.getElementById('chatbotClose');
        var scroll = document.getElementById('chatbotScroll');
        var body = document.getElementById('chatbotBody');
        var form = document.getElementById('chatbotForm');
        var input = document.getElementById('chatbotInput');
        var sendBtn = form ? form.querySelector('.chatbot-send') : null;

        if (!toggle || !panel || !body) {
            return;
        }

        var isOpen = false;

        function scrollToBottom() {
            if (scroll) {
                scroll.scrollTop = scroll.scrollHeight;
            }
        }

        function openPanel() {
            if (isOpen) {
                return;
            }

            isOpen = true;

            panel.classList.add('is-open');
            panel.setAttribute('aria-hidden', 'false');
            toggle.classList.add('is-active');
            toggle.setAttribute('aria-expanded', 'true');

            syncPanelViewport();
            scrollToBottom();

            if (input) {
                input.focus({ preventScroll: true });
            }
        }

        function closePanel(returnFocus) {
            if (!isOpen) {
                return;
            }

            isOpen = false;

            panel.classList.remove('is-open');
            panel.setAttribute('aria-hidden', 'true');
            toggle.classList.remove('is-active');
            toggle.setAttribute('aria-expanded', 'false');

            syncPanelViewport();

            if (returnFocus) {
                toggle.focus({ preventScroll: true });
            }
        }

        // Pesan masuk ke area chat
        function addMessage(text, fromUser) {
            var row = document.createElement('div');
            row.className = 'chatbot-msg' + (fromUser ? ' chatbot-msg--user' : '');

            if (!fromUser) {
                var avatar = document.createElement('span');
                avatar.className = 'chatbot-avatar';

                var avatarImg = document.createElement('img');
                avatarImg.src = '/mainfiturimages/chatbot.png';
                avatarImg.alt = '';

                avatar.appendChild(avatarImg);
                row.appendChild(avatar);
            }

            var bubble = document.createElement('p');
            bubble.className = 'chatbot-bubble';
            bubble.textContent = text;

            row.appendChild(bubble);
            body.appendChild(row);

            scrollToBottom();
        }

        // Balasan bot
        function botReply(text) {
            window.setTimeout(function () {
                addMessage(text, false);
            }, 300);
        }

        // Indikator "sedang menulis"
        function showTyping() {
            var row = document.createElement('div');
            row.className = 'chatbot-msg chatbot-msg--typing';

            var avatar = document.createElement('span');
            avatar.className = 'chatbot-avatar';

            var avatarImg = document.createElement('img');
            avatarImg.src = '/mainfiturimages/chatbot.png';
            avatarImg.alt = '';

            avatar.appendChild(avatarImg);

            var bubble = document.createElement('p');
            bubble.className = 'chatbot-bubble';
            bubble.textContent = 'MABOT sedang menulis...';

            row.appendChild(avatar);
            row.appendChild(bubble);
            body.appendChild(row);

            scrollToBottom();

            return row;
        }

        function setBusy(busy) {
            if (input) {
                input.disabled = busy;
            }

            if (sendBtn) {
                sendBtn.disabled = busy;
            }
        }

        // Jarak panel dari bawah layar: tinggi tombol + jarak.
        var PANEL_GAP = 102;

        // Di ponsel, sesuaikan posisi/tinggi panel saat keyboard virtual muncul
        // supaya kolom input tetap terlihat.
        function syncPanelViewport() {
            var vv = window.visualViewport;
            var isSmall = window.matchMedia('(max-width: 768px)').matches;

            if (!vv || !isOpen || !isSmall) {
                panel.style.height = '';
                panel.style.bottom = '';

                return;
            }

            var occluded = Math.max(0, window.innerHeight - (vv.height + vv.offsetTop));
            var bottom = PANEL_GAP + occluded;

            panel.style.bottom = bottom + 'px';
            panel.style.height = Math.max(220, vv.height - 14 - bottom) + 'px';
        }

        if (window.visualViewport) {
            window.visualViewport.addEventListener('resize', syncPanelViewport);
            window.visualViewport.addEventListener('scroll', syncPanelViewport);
        }

        window.addEventListener('orientationchange', function () {
            window.setTimeout(syncPanelViewport, 200);
        });

        // Kirim pertanyaan ke n8n lalu tampilkan balasannya
        function kirimPesan(text, echoLabel) {
            addMessage(echoLabel || text, true);

            var typing = showTyping();

            setBusy(true);

            askBot(text).then(function (reply) {
                if (typing.parentNode) {
                    typing.remove();
                }

                setBusy(false);

                if (input) {
                    input.focus({ preventScroll: true });
                }

                botReply(reply || FALLBACK_REPLY);
            }).catch(function () {
                if (typing.parentNode) {
                    typing.remove();
                }

                setBusy(false);

                if (input) {
                    input.focus({ preventScroll: true });
                }

                botReply(ERROR_REPLY);
            });
        }

        // Tombol buka/tutup
        toggle.addEventListener('click', function () {
            if (isOpen) {
                closePanel(false);
            } else {
                openPanel();
            }
        });

        // Tombol tutup (X)
        if (closeBtn) {
            closeBtn.addEventListener('click', function () {
                closePanel(true);
            });
        }

        // Tombol Escape
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && isOpen) {
                closePanel(true);
            }
        });

        // Klik di luar panel
        document.addEventListener('click', function (e) {
            if (!isOpen) {
                return;
            }

            if (!panel.contains(e.target) && !toggle.contains(e.target)) {
                closePanel(false);
            }
        });

        // Saat keyboard virtual muncul, pastikan area chat tetap di bawah
        if (input) {
            input.addEventListener('focus', function () {
                window.setTimeout(function () {
                    syncPanelViewport();
                    scrollToBottom();
                }, 250);
            });
        }

        // Kirim pesan
        if (form && input) {
            form.addEventListener('submit', function (e) {
                e.preventDefault();

                var text = input.value.trim();

                if (!text) {
                    return;
                }

                input.value = '';

                kirimPesan(text, text);
            });
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();

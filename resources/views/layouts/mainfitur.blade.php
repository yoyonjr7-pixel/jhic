<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
    <link rel="stylesheet" href="/css/mainfitur.css">
<body>
     {{-- Tombol kanan --}}
    <div class="right-buttons">

        {{-- JuruMatch --}}
        <a href="{{ route('jurumatch') }}" class="floating-button">

            <img
                src="/mainfiturimages/jurumatch.png"
                alt="JuruMatch"
            >

        </a>


        {{-- Chatbot --}}
        <button
            type="button"
            class="floating-button floating-button--chatbot"
            id="chatbotToggle"
            aria-label="Buka MABOT"
            aria-expanded="false"
            aria-controls="chatbotPanel"
        >

            <img
                src="/mainfiturimages/chatbot.png"
                alt="MABOT"
            >

        </button>

    </div>

    {{-- =========================================================
         PANEL CHATBOT (MABOT)
    ========================================================= --}}
    <div
        class="chatbot-panel"
        id="chatbotPanel"
        role="dialog"
        aria-label="MABOT"
        aria-hidden="true"
    >

        <div class="chatbot-header">

            <span class="chatbot-header-avatar">
                <img src="/mainfiturimages/chatbot.png" alt="">
            </span>

            <span class="chatbot-header-text">
                <span class="chatbot-header-title">MABOT</span>
                <span class="chatbot-header-status">Online</span>
            </span>

            <button
                type="button"
                class="chatbot-close"
                id="chatbotClose"
                aria-label="Tutup chat"
            >
                &times;
            </button>

        </div>

        <div class="chatbot-scroll" id="chatbotScroll">

            <div class="chatbot-body" id="chatbotBody">

                <div class="chatbot-msg">
                    <span class="chatbot-avatar">
                        <img src="/mainfiturimages/chatbot.png" alt="">
                    </span>
                    <p class="chatbot-bubble">MABOT Telah tersambung dengan anda!</p>
                </div>

                <div class="chatbot-msg">
                    <span class="chatbot-avatar">
                        <img src="/mainfiturimages/chatbot.png" alt="">
                    </span>
                    <p class="chatbot-bubble">Haiii, selamat datang di SMK Darma Siswa Sidoarjo</p>
                </div>

               
            </div>

        </div>

        <form class="chatbot-input" id="chatbotForm">

            <input
                type="text"
                class="chatbot-input-field"
                id="chatbotInput"
                placeholder="Ketik pesan anda disini......"
                autocomplete="off"
                aria-label="Ketik pesan"
            >

            <button type="submit" class="chatbot-send" aria-label="Kirim pesan">
                <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                    <path d="M3.4 20.4l17.45-7.48a1 1 0 0 0 0-1.84L3.4 3.6a1 1 0 0 0-1.39 1.1l1.9 6.11a1 1 0 0 0 .78.68L15 12l-10.31.51a1 1 0 0 0-.78.68l-1.9 6.11a1 1 0 0 0 1.39 1.1z"/>
                </svg>
            </button>

        </form>

    </div>

    <script
        src="/js/chatbot.js"
        data-webhook="{{ config('services.mabot.webhook') }}"
    ></script>

</body>
</html>

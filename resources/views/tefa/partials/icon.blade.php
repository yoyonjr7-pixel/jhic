@switch($type ?? 'mesin')

    @case('motor')
        <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2.4"
            stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <circle cx="10" cy="32" r="7"></circle>
            <circle cx="38" cy="32" r="7"></circle>
            <path d="M10 32h9l7-12h-5"></path>
            <path d="M26 20h8l4 12"></path>
            <path d="M20 20h9"></path>
            <path d="M31 15h5"></path>
        </svg>
        @break

    @case('mobil')
        <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2.4"
            stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M7 32h2l3-8h14l5 5h6a2 2 0 0 1 2 2v1h-3"></path>
            <circle cx="16" cy="32" r="4"></circle>
            <circle cx="35" cy="32" r="4"></circle>
        </svg>
        @break

    @case('mesin')
        <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2.4"
            stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M14 22h4l3-5h7v5h3l4 4v7h-4v3H18v-3h-4z"></path>
            <path d="M14 26H8v9h6"></path>
            <path d="M35 26h5l3 3v6h-4"></path>
            <path d="M22 17v-5h8"></path>
            <circle cx="24" cy="31" r="4"></circle>
        </svg>
        @break

    @case('rem')
        <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2.4"
            stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <circle cx="24" cy="24" r="16"></circle>
            <circle cx="24" cy="24" r="7"></circle>
            <circle cx="24" cy="24" r="2.5"></circle>
            <path d="M24 8v7"></path>
            <path d="M24 33v7"></path>
            <path d="M8 24h7"></path>
            <path d="M33 24h7"></path>
        </svg>
        @break

    @case('jaringan')
        <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2.4"
            stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <circle cx="24" cy="12" r="4"></circle>
            <circle cx="12" cy="34" r="4"></circle>
            <circle cx="36" cy="34" r="4"></circle>
            <path d="M22 15.5 14 30.5"></path>
            <path d="M26 15.5 34 30.5"></path>
            <path d="M16 34h16"></path>
        </svg>
        @break

    @case('komputer')
        <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2.4"
            stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <rect x="7" y="10" width="34" height="23" rx="2"></rect>
            <path d="M24 33v6"></path>
            <path d="M18 39h12"></path>
            <path d="M14 17h12"></path>
            <path d="M14 23h8"></path>
        </svg>
        @break

    @case('wifi')
        <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2.4"
            stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <rect x="8" y="27" width="32" height="12" rx="3"></rect>
            <circle cx="16" cy="33" r="1.6" fill="currentColor" stroke="none"></circle>
            <circle cx="22" cy="33" r="1.6" fill="currentColor" stroke="none"></circle>
            <path d="M24 23v4"></path>
            <path d="M18 19a8 8 0 0 1 12 0"></path>
            <path d="M14 14a14 14 0 0 1 20 0"></path>
        </svg>
        @break

    @case('las')
        <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2.4"
            stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M12 20a12 12 0 0 1 24 0v8a4 4 0 0 1-4 4H16a4 4 0 0 1-4-4z"></path>
            <rect x="17" y="20" width="14" height="7" rx="1.5"></rect>
            <path d="M24 32v7"></path>
            <path d="M18 39h12"></path>
        </svg>
        @break

    @case('bubut')
        <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2.4"
            stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <circle cx="24" cy="24" r="8"></circle>
            <circle cx="24" cy="24" r="3"></circle>
            <path d="M24 6v5"></path>
            <path d="M24 37v5"></path>
            <path d="M6 24h5"></path>
            <path d="M37 24h5"></path>
            <path d="M11 11l4 4"></path>
            <path d="M33 33l4 4"></path>
            <path d="M37 11l-4 4"></path>
            <path d="M15 33l-4 4"></path>
        </svg>
        @break

    @case('rangka')
        <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2.4"
            stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M8 38h32"></path>
            <path d="M12 38 24 16l12 22"></path>
            <path d="M18 27h12"></path>
        </svg>
        @break

    @default
        <svg viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2.4"
            stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <circle cx="24" cy="24" r="16"></circle>
            <path d="M24 16v16"></path>
            <path d="M16 24h16"></path>
        </svg>

@endswitch

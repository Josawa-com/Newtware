{{--
    Hero backdrop: a printed circuit board with data pulses running through it.

    Design intent
    -------------
    The hero should read as "a working board", not as decoration. That means:
      · orthogonal traces with 45° bends and vias, like real PCB routing
      · narrow pulses travelling along the traces (electricity / data)
      · everything at very low opacity, so the copy never competes with it
      · no clipping: the SVG canvas is oversized and the paths run past the edge

    Light mode stays light (a pale board with teal traces). Dark mode is a deep
    navy board with brighter traces — the light never turns into shadow.

    Accessibility: purely decorative, hidden from assistive tech.
--}}
<div class="hero-board" aria-hidden="true">
    <svg
        class="hero-board__svg"
        viewBox="0 0 1200 600"
        preserveAspectRatio="xMidYMid slice"
        focusable="false"
    >
        <defs>
            {{-- One gradient per mode so traces keep their colour in both themes. --}}
            <linearGradient id="trace-light" x1="0" y1="0" x2="1" y2="1">
                <stop offset="0%" stop-color="#167d94" stop-opacity="0.55" />
                <stop offset="55%" stop-color="#266594" stop-opacity="0.35" />
                <stop offset="100%" stop-color="#335095" stop-opacity="0.5" />
            </linearGradient>
            <linearGradient id="trace-dark" x1="0" y1="0" x2="1" y2="1">
                <stop offset="0%" stop-color="#3fc4dc" stop-opacity="0.7" />
                <stop offset="55%" stop-color="#4a86c0" stop-opacity="0.45" />
                <stop offset="100%" stop-color="#6f9ae0" stop-opacity="0.6" />
            </linearGradient>

            <clipPath id="board-clip">
                <rect x="0" y="0" width="1200" height="600" />
            </clipPath>
        </defs>

        <g clip-path="url(#board-clip)">
            {{-- Static routing. Two groups so each mode can pick its own gradient. --}}
            <g class="hero-board__traces hero-board__traces--light" fill="none" stroke="url(#trace-light)" stroke-width="1.4" stroke-linecap="square" stroke-linejoin="miter">
                @include('partials.hero-board-paths')
            </g>
            <g class="hero-board__traces hero-board__traces--dark" fill="none" stroke="url(#trace-dark)" stroke-width="1.4" stroke-linecap="square" stroke-linejoin="miter">
                @include('partials.hero-board-paths')
            </g>

            {{-- Vias (solder pads) at the bends, drawn as small rings. --}}
            <g class="hero-board__vias" fill="none" stroke-width="1.2">
                @foreach ([
                    [210, 90], [210, 150], [470, 150], [470, 52],
                    [620, 300], [760, 300], [760, 420],
                    [150, 300], [150, 420], [980, 120],
                    [980, 240], [1100, 240], [1100, 420], [340, 520],
                    [120, 60], [120, 180], [100, 240], [100, 320],
                    [140, 480], [140, 400], [180, 360], [320, 260],
                    [360, 300], [360, 380], [160, 500], [160, 440],
                ] as [$cx, $cy])
                    <circle cx="{{ $cx }}" cy="{{ $cy }}" r="3.6" class="hero-board__via" />
                @endforeach
            </g>

            {{-- Data pulses: a short dash that travels the length of a trace. --}}
            <g class="hero-board__pulses" fill="none" stroke-width="2" stroke-linecap="round">
                <path d="M0 90 H170 L210 130 V300" pathLength="100" class="hero-board__pulse" style="animation-delay: 0s" />
                <path d="M0 300 H110 L150 260 V150" pathLength="100" class="hero-board__pulse" style="animation-delay: -2.4s" />
                <path d="M470 52 H390 L350 92 V210 L300 260 V420" pathLength="100" class="hero-board__pulse" style="animation-delay: -4.1s" />
                <path d="M760 420 V300 H920 L980 240" pathLength="100" class="hero-board__pulse" style="animation-delay: -1.3s" />
                <path d="M1100 420 V300 L1040 240 V120" pathLength="100" class="hero-board__pulse" style="animation-delay: -5.2s" />
                <path d="M340 520 V430 L300 390 H120" pathLength="100" class="hero-board__pulse" style="animation-delay: -3.2s" />
                <path d="M1200 210 H1080 L1040 170 V60" pathLength="100" class="hero-board__pulse" style="animation-delay: -6.4s" />
                <path d="M60 0 V60 H120 V180" pathLength="100" class="hero-board__pulse" style="animation-delay: -0.7s" />
                <path d="M0 200 H60 L100 240 V320" pathLength="100" class="hero-board__pulse" style="animation-delay: -2.9s" />
                <path d="M0 520 H100 L140 480 V400 L180 360" pathLength="100" class="hero-board__pulse" style="animation-delay: -5.6s" />
                <path d="M240 200 V260 H320 L360 300 V380" pathLength="100" class="hero-board__pulse" style="animation-delay: -3.8s" />
                <path d="M0 660 H160 L200 620 V560" pathLength="100" class="hero-board__pulse" style="animation-delay: -1.9s" />
            </g>
        </g>
    </svg>

    {{-- Soft haze so traces fade out under the headline instead of running into it. --}}
    <div class="hero-board__haze"></div>
</div>

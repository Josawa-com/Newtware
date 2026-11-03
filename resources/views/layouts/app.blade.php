<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', 'Beranda') &middot; {{ config('app.name', 'Netware') }}</title>
        <meta name="description" content="@yield('description', __('site.footer.about'))">
        <script>
            document.documentElement.classList.add('js');

            if (typeof document.startViewTransition === 'function') {
                document.documentElement.classList.add('vt-supported');
            }

            // Apply the stored theme before paint to avoid a flash of the wrong mode.
            try {
                const storedTheme = localStorage.getItem('netware:theme');

                if (storedTheme === 'dark') {
                    document.documentElement.classList.add('dark');
                }
            } catch (error) {
                // localStorage can be unavailable; the light theme is the default.
            }

            // Coming back from a language switch: start with the colour band
            // already covering the viewport, so the new page never paints white
            // for a frame before the sweep animation begins.
            try {
                if (sessionStorage.getItem('netware:locale-switching') === '1') {
                    document.documentElement.dataset.localePhase = 'in';
                }
            } catch (error) {
                // Same as above; without storage the page simply renders normally.
            }
        </script>

        @fonts
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <link rel="icon" href="{{ asset('favicon.ico') }}?v=2" sizes="any">
        <link rel="icon" type="image/png" href="{{ asset('favicon-32x32.png') }}?v=2" sizes="32x32">
        <link rel="icon" type="image/png" href="{{ asset('favicon-16x16.png') }}?v=2" sizes="16x16">
        <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}?v=2">

        {{--
            Critical styles for the language sweep. They live inline so the band
            is already on screen before the bundled CSS arrives, which removes the
            white flash between the request and the new page's first paint.
        --}}
        <style>
            /*
             * Paint the document teal for the first frame too. Without this the
             * browser shows the default white canvas before <body> is laid out,
             * which is the small white blink after the switch.
             */
            html[data-locale-phase] {
                background-color: #167d94;
            }

            .locale-sweep {
                position: fixed;
                inset: 0;
                z-index: 70;
                display: none;
                pointer-events: none;
                background: linear-gradient(to bottom, #167d94, #266594 55%, #335095);
            }

            html[data-locale-phase='in'] .locale-sweep,
            html[data-locale-phase='out'] .locale-sweep {
                display: block;
            }

            html[data-locale-phase='in'] .locale-sweep {
                transform-origin: bottom;
                animation: locale-sweep-away 360ms cubic-bezier(0.55, 0, 0.35, 1) forwards;
            }

            @keyframes locale-sweep-away {
                from {
                    transform: scaleY(1);
                }

                to {
                    transform: scaleY(0);
                }
            }
        </style>
    </head>
    <body class="flex min-h-screen flex-col bg-white font-sans text-slate-700 antialiased dark:bg-slate-950 dark:text-slate-300">
        <header
            class="sticky top-0 z-50 border-b border-slate-200/70 bg-white/85 backdrop-blur transition-shadow duration-300 dark:border-slate-800 dark:bg-slate-950/85"
            data-header
        >
            <div class="relative mx-auto flex h-16 max-w-7xl items-center justify-between gap-4 px-4 sm:gap-8 sm:px-6 lg:px-8">
                <a href="{{ route('beranda') }}" class="flex shrink-0 items-center gap-2.5">
                    <img src="{{ asset('netware-mark.png') }}" alt="" class="h-8 w-auto" aria-hidden="true">
                    <img src="{{ asset('NetwareTeks.png') }}" alt="{{ config('app.name', 'Netware') }}" class="h-[18px] w-auto dark:brightness-0 dark:invert">
                </a>

                <nav
                    class="relative hidden h-full items-center md:flex lg:absolute lg:left-1/2 lg:-translate-x-1/2"
                    aria-label="{{ __('site.nav.home') }}"
                    data-nav
                >
                    @foreach ([
                        'beranda' => __('site.nav.home'),
                        'barang' => __('site.nav.products'),
                        'layanan' => __('site.nav.services'),
                        'testimoni' => __('site.nav.testimonials'),
                    ] as $routeName => $label)
                        <a
                            href="{{ route($routeName) }}"
                            @class([
                                'relative flex h-full items-center px-4 text-sm transition-colors duration-200',
                                'font-semibold text-netware-navy dark:text-white' => request()->routeIs($routeName),
                                'text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white' => ! request()->routeIs($routeName),
                            ])
                            data-nav-item
                            @if (request()->routeIs($routeName)) aria-current="page" @endif
                        >
                            {{ $label }}
                        </a>
                    @endforeach

                    <span
                        class="pointer-events-none absolute bottom-0 left-0 h-[3px] w-0 rounded-full bg-linear-to-r from-netware-teal to-netware-blue opacity-0 transition-[left,width,opacity] duration-400 ease-[cubic-bezier(0.22,1,0.36,1)] motion-reduce:transition-none"
                        data-nav-indicator
                        aria-hidden="true"
                    ></span>
                </nav>

                <div class="flex h-full items-center gap-5">
                    @include('partials.preferences')
                </div>            </div>
        </header>

        <main class="w-full flex-1">
            @yield('content')
        </main>

        {{-- Colour band that sweeps down while the language is switching. --}}
        <span class="locale-sweep" aria-hidden="true"></span>

        <footer class="relative overflow-hidden bg-netware-navy text-white dark:bg-slate-900">
            <div class="absolute inset-x-0 top-0 h-px bg-linear-to-r from-netware-teal via-netware-blue to-netware-navy"></div>

            <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 sm:py-14 lg:px-8">
                <div class="grid gap-8 sm:grid-cols-2 sm:gap-10 lg:grid-cols-12 lg:gap-8">
                    <div class="lg:col-span-5">
                        <a href="{{ route('beranda') }}" class="inline-flex items-center gap-3">
                            <span class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-white">
                                <img src="{{ asset('netware-mark.png') }}" alt="" class="h-7 w-auto" aria-hidden="true">
                            </span>
                            <img src="{{ asset('NetwareTeks.png') }}" alt="{{ config('app.name', 'Netware') }}" class="h-4 w-auto brightness-0 invert">
                        </a>
                        <p class="mt-5 max-w-sm text-sm leading-relaxed text-white/65">
                            {{ __('site.footer.about') }}
                        </p>
                    </div>

                    <div class="lg:col-span-3">
                        <h2 class="text-xs font-semibold tracking-[0.18em] text-white/45 uppercase">{{ __('site.labels.pages') }}</h2>
                        <ul class="mt-4 space-y-2.5">
                            @foreach ([
                                'beranda' => __('site.nav.home'),
                                'barang' => __('site.nav.products'),
                                'layanan' => __('site.nav.services'),
                                'testimoni' => __('site.nav.testimonials'),
                            ] as $routeName => $label)
                                <li>
                                    <a
                                        href="{{ route($routeName) }}"
                                        @class([
                                            'text-sm transition-colors duration-200',
                                            'font-medium text-white' => request()->routeIs($routeName),
                                            'text-white/65 hover:text-white' => ! request()->routeIs($routeName),
                                        ])
                                    >
                                        {{ $label }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="lg:col-span-4">
                        <h2 class="text-xs font-semibold tracking-[0.18em] text-white/45 uppercase">{{ __('site.labels.contact') }}</h2>
                        <ul class="mt-4 space-y-2.5 text-sm">
                            <li>
                                <a
                                    href="https://wa.me/{{ config('netware.whatsapp') }}?text={{ rawurlencode(__('site.whatsapp_message')) }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="inline-flex items-center gap-2 text-white/65 transition-colors duration-200 hover:text-white"
                                >
                                    WhatsApp
                                </a>
                            </li>
                            <li>
                                <a
                                    href="https://instagram.com/{{ config('netware.instagram') }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="inline-flex items-center gap-2 text-white/65 transition-colors duration-200 hover:text-white"
                                >
                                    Instagram
                                </a>
                            </li>
                            <li class="pt-1 text-white/65">
                                {{ config('netware.hours.open') }}–{{ config('netware.hours.close') }} {{ config('netware.hours.timezone') }}
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="mt-12 flex flex-col items-center gap-2 border-t border-white/10 pt-6 pb-20 md:pb-0">
                    <p class="text-center text-sm text-white/55">
                        &copy; {{ date('Y') }} {{ config('app.name', 'Netware') }}. {{ __('site.labels.all_rights') }}
                    </p>
                </div>            </div>
        </footer>

        {{-- Floating WhatsApp button: bottom-right on desktop, above the dock on mobile. --}}
        <a
            href="https://wa.me/{{ config('netware.whatsapp') }}?text={{ rawurlencode(__('site.whatsapp_message')) }}"
            target="_blank"
            rel="noopener noreferrer"
            aria-label="{{ __('site.actions.consult_whatsapp') }}"
            class="group fixed right-4 bottom-[calc(6.5rem+env(safe-area-inset-bottom))] z-50 flex h-14 w-14 items-center justify-center overflow-hidden rounded-full bg-linear-to-br from-netware-teal via-netware-blue to-netware-navy text-white shadow-[0_14px_34px_-12px_rgba(22,125,148,0.85)] ring-1 ring-white/25 transition-all duration-300 hover:-translate-y-0.5 hover:shadow-[0_20px_44px_-12px_rgba(22,125,148,0.95)] md:right-6 md:bottom-6"
            data-wa-float
        >
            {{-- Sheen that sweeps across the button. --}}
            <span class="pointer-events-none absolute inset-0 overflow-hidden rounded-full" aria-hidden="true">
                <span class="wa-sheen absolute top-0 h-full w-1/3 bg-linear-to-r from-transparent via-white/70 to-transparent"></span>
            </span>

            <svg class="relative h-7 w-7 transition-transform duration-300 group-hover:scale-110" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                <path d="M17.47 14.38c-.3-.15-1.76-.87-2.03-.97-.27-.1-.47-.15-.67.15-.2.3-.77.97-.95 1.17-.17.2-.35.22-.65.07-.3-.15-1.26-.46-2.4-1.48-.89-.79-1.49-1.77-1.66-2.07-.17-.3-.02-.46.13-.61.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.08-.15-.67-1.61-.92-2.2-.24-.58-.48-.5-.67-.51h-.57c-.2 0-.52.07-.79.37-.27.3-1.04 1.02-1.04 2.48s1.07 2.88 1.22 3.08c.15.2 2.1 3.2 5.08 4.49.71.3 1.26.49 1.69.63.71.23 1.36.19 1.87.12.57-.09 1.76-.72 2.01-1.42.25-.7.25-1.29.17-1.42-.07-.13-.27-.2-.57-.35z" />
                <path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.75.46 3.45 1.32 4.95L2 22l5.25-1.38a9.86 9.86 0 004.79 1.22h.01c5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.82 9.82 0 0012.04 2zm0 18.13h-.01a8.2 8.2 0 01-4.18-1.15l-.3-.18-3.11.82.83-3.04-.2-.31a8.18 8.18 0 01-1.26-4.36c0-4.54 3.7-8.23 8.24-8.23a8.18 8.18 0 015.82 2.41 8.17 8.17 0 012.41 5.83c0 4.54-3.7 8.21-8.24 8.21z" />
            </svg>
        </a>

        {{-- Floating liquid-glass dock, mobile only. --}}
        <nav
            class="pointer-events-none fixed inset-x-0 bottom-0 z-50 px-4 pb-[max(0.75rem,env(safe-area-inset-bottom))] md:hidden"
            aria-label="{{ __('site.nav.home') }}"
            data-dock
        >
            <div class="pointer-events-auto relative mx-auto flex w-full items-stretch justify-between gap-1 rounded-full border-2 border-slate-300 bg-white/75 p-1.5 shadow-[0_16px_38px_-20px_rgba(15,23,42,0.38),inset_0_1px_0_rgba(255,255,255,0.7)] backdrop-blur-[3px] backdrop-saturate-150 supports-[backdrop-filter]:bg-white/55 dark:border-slate-500 dark:bg-slate-900/80 dark:shadow-[0_16px_38px_-20px_rgba(0,0,0,0.8),inset_0_1px_0_rgba(255,255,255,0.12)] dark:supports-[backdrop-filter]:bg-slate-900/60">
                <span
                    class="pointer-events-none absolute top-1.5 bottom-1.5 left-0 rounded-full bg-white opacity-0 shadow-[0_8px_20px_-8px_rgba(22,125,148,0.5),inset_0_0_0_1px_rgba(22,125,148,0.16)] transition-[left,width,opacity] duration-400 ease-[cubic-bezier(0.22,1,0.36,1)] motion-reduce:transition-none dark:bg-slate-700 dark:shadow-[0_8px_20px_-8px_rgba(0,0,0,0.7),inset_0_0_0_1px_rgba(255,255,255,0.12)]"
                    data-dock-indicator
                    aria-hidden="true"
                ></span>

                @foreach ([
                    'beranda' => ['label' => __('site.nav.home'), 'icon' => 'home'],
                    'barang' => ['label' => __('site.nav.products'), 'icon' => 'box'],
                    'layanan' => ['label' => __('site.nav.services'), 'icon' => 'tools'],
                    'testimoni' => ['label' => __('site.nav.testimonials'), 'icon' => 'star'],
                ] as $routeName => $item)
                    <a
                        href="{{ route($routeName) }}"
                        @class([
                            'relative z-10 flex flex-1 flex-col items-center gap-1 rounded-full px-1 py-2 transition-colors duration-200',
                            'text-netware-navy dark:text-white' => request()->routeIs($routeName),
                            'text-slate-600 dark:text-slate-400' => ! request()->routeIs($routeName),
                        ])
                        data-dock-item
                        @if (request()->routeIs($routeName)) aria-current="page" @endif
                    >
                        <span
                            @class([
                                'flex h-7 w-7 items-center justify-center rounded-full transition-all duration-300',
                                'bg-netware-teal text-white shadow-[0_6px_14px_-6px_rgba(22,125,148,0.8)]' => request()->routeIs($routeName),
                                'bg-transparent' => ! request()->routeIs($routeName),
                            ])
                        >
                            @switch($item['icon'])
                                @case('home')
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.9 10.4 12 3l9.1 7.4v8.2a2.4 2.4 0 0 1-2.4 2.4H5.3a2.4 2.4 0 0 1-2.4-2.4z" />
                                    </svg>
                                    @break
                                @case('box')
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 8.2-9-5.2-9 5.2v7.6l9 5.2 9-5.2zM3.3 8.4 12 13.5l8.7-5.1M12 13.5V21" />
                                    </svg>
                                    @break
                                @case('tools')
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.7 6.3a4.2 4.2 0 0 0 5.3 5.3l-8.6 8.6a2.4 2.4 0 0 1-3.4-3.4l8.6-8.6a4.2 4.2 0 0 0-1.9-1.9z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.6 3.6 8.9 5.9M3.6 6.6 5.9 8.9" />
                                    </svg>
                                    @break
                                @default
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.7" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m12 3.6 2.6 5.4 5.9.8-4.3 4.1 1.1 5.9-5.3-2.9-5.3 2.9 1.1-5.9L3.5 9.8l5.9-.8z" />
                                    </svg>
                            @endswitch
                        </span>

                        <span class="text-[10px] leading-none font-medium tracking-wide">{{ $item['label'] }}</span>
                    </a>
                @endforeach
            </div>
        </nav>
    </body>
</html>

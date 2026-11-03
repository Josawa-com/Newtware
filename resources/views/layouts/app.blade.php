<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', 'Beranda') &middot; {{ config('app.name', 'Netware') }}</title>
        <meta name="description" content="@yield('description', 'Netware - Teaching Factory Teknik Komputer dan Jaringan.')">

        @fonts
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <link rel="icon" href="{{ asset('favicon.ico') }}?v=2" sizes="any">
        <link rel="icon" type="image/png" href="{{ asset('favicon-32x32.png') }}?v=2" sizes="32x32">
        <link rel="icon" type="image/png" href="{{ asset('favicon-16x16.png') }}?v=2" sizes="16x16">
        <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}?v=2">
    </head>
    <body class="flex min-h-screen flex-col bg-white font-sans text-slate-800 antialiased">
        <header class="sticky top-0 z-50 border-b border-slate-200 bg-white">
            <div class="mx-auto flex h-16 max-w-7xl items-center justify-between gap-8 px-6 lg:px-8">
                <a href="{{ route('beranda') }}" class="flex shrink-0 items-center gap-2.5">
                    <img src="{{ asset('netware-mark.png') }}" alt="" class="h-8 w-auto" aria-hidden="true">
                    <img src="{{ asset('NetwareTeks.png') }}" alt="{{ config('app.name', 'Netware') }}" class="h-[18px] w-auto">
                </a>

                <div class="flex h-full items-center gap-6">
                    <nav class="relative hidden h-full items-center md:flex" aria-label="Navigasi utama" data-nav>
                        @foreach ([
                            'beranda' => 'Beranda',
                            'barang' => 'Barang',
                            'layanan' => 'Layanan',
                            'testimoni' => 'Testimoni',
                        ] as $routeName => $label)
                            <a
                                href="{{ route($routeName) }}"
                                @class([
                                    'relative flex h-full items-center px-4 text-sm transition-colors duration-200',
                                    'font-semibold text-netware-navy' => request()->routeIs($routeName),
                                    'text-slate-500 hover:text-slate-900' => ! request()->routeIs($routeName),
                                ])
                                data-nav-item
                                @if (request()->routeIs($routeName)) aria-current="page" @endif
                            >
                                {{ $label }}
                            </a>
                        @endforeach

                        <span
                            class="pointer-events-none absolute bottom-0 left-0 h-[3px] w-0 rounded-full bg-netware-teal opacity-0 transition-[left,width,opacity] duration-400 ease-[cubic-bezier(0.22,1,0.36,1)] motion-reduce:transition-none"
                            data-nav-indicator
                            aria-hidden="true"
                        ></span>
                    </nav>

                    <button
                        type="button"
                        class="inline-flex items-center gap-2 text-xs font-medium tracking-wide text-slate-600 uppercase transition-colors hover:text-slate-900 md:hidden"
                        data-nav-toggle
                        aria-controls="mobile-navigation"
                        aria-expanded="false"
                    >
                        <span>Menu</span>
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5M3.75 17.25h16.5" />
                        </svg>
                    </button>

                    <a
                        href="https://wa.me/{{ config('netware.whatsapp') }}?text={{ rawurlencode('Halo Netware, saya ingin berkonsultasi mengenai perangkat saya.') }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="hidden shrink-0 items-center gap-2 bg-netware-navy px-4 py-2 text-sm font-medium text-white transition-colors duration-200 hover:bg-netware-blue md:inline-flex"
                    >
                        Konsultasi
                    </a>
                </div>
            </div>

            <nav id="mobile-navigation" class="hidden border-t border-slate-200 md:hidden" aria-label="Navigasi seluler">
                <div class="mx-auto flex max-w-7xl flex-col px-6">
                    @foreach ([
                        'beranda' => 'Beranda',
                        'barang' => 'Barang',
                        'layanan' => 'Layanan',
                        'testimoni' => 'Testimoni',
                    ] as $routeName => $label)
                        <a
                            href="{{ route($routeName) }}"
                            @class([
                                'border-b border-slate-100 border-l-2 py-3 pl-4 text-sm last:border-b-0',
                                'border-l-netware-teal font-semibold text-netware-navy' => request()->routeIs($routeName),
                                'border-l-transparent text-slate-600' => ! request()->routeIs($routeName),
                            ])
                            @if (request()->routeIs($routeName)) aria-current="page" @endif
                        >
                            {{ $label }}
                        </a>
                    @endforeach

                    <a
                        href="https://wa.me/{{ config('netware.whatsapp') }}?text={{ rawurlencode('Halo Netware, saya ingin berkonsultasi mengenai perangkat saya.') }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="mt-3 mb-4 inline-flex items-center justify-center gap-2 bg-netware-navy px-4 py-3 text-sm font-medium text-white transition-colors duration-200 hover:bg-netware-blue"
                    >
                        Konsultasi via WhatsApp
                    </a>
                </div>
            </nav>
        </header>

        <main class="mx-auto w-full max-w-7xl flex-1 px-6 py-16 lg:px-8">
            @yield('content')
        </main>

        <footer class="border-t border-slate-200 bg-white">
            <div class="mx-auto max-w-7xl px-6 py-12 lg:px-8">
                <div class="grid gap-10 sm:grid-cols-3 sm:gap-8">
                    <div>
                        <img src="{{ asset('netware-mark.png') }}" alt="" class="h-8 w-auto" aria-hidden="true">
                        <p class="mt-4 text-sm leading-relaxed text-slate-500">
                            Unit Produksi Teknik Komputer dan Jaringan SMK Negeri 1 Bantul.
                        </p>
                    </div>

                    <div>
                        <h2 class="text-xs font-semibold tracking-[0.18em] text-slate-400 uppercase">Halaman</h2>
                        <ul class="mt-4 space-y-2">
                            @foreach ([
                                'beranda' => 'Beranda',
                                'barang' => 'Barang',
                                'layanan' => 'Layanan',
                                'testimoni' => 'Testimoni',
                            ] as $routeName => $label)
                                <li>
                                    <a
                                        href="{{ route($routeName) }}"
                                        @class([
                                            'text-sm transition-colors duration-200',
                                            'font-medium text-netware-navy' => request()->routeIs($routeName),
                                            'text-slate-500 hover:text-slate-900' => ! request()->routeIs($routeName),
                                        ])
                                    >
                                        {{ $label }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div>
                        <h2 class="text-xs font-semibold tracking-[0.18em] text-slate-400 uppercase">Kontak</h2>
                        <ul class="mt-4 space-y-2">
                            <li>
                                <a
                                    href="https://wa.me/{{ config('netware.whatsapp') }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="text-sm text-slate-500 transition-colors duration-200 hover:text-slate-900"
                                >
                                    WhatsApp
                                </a>
                            </li>
                            <li>
                                <a
                                    href="https://instagram.com/{{ config('netware.instagram') }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="text-sm text-slate-500 transition-colors duration-200 hover:text-slate-900"
                                >
                                    Instagram
                                </a>
                            </li>
                            <li class="pt-2 text-sm text-slate-500">
                                {{ config('netware.hours.open') }}–{{ config('netware.hours.close') }} {{ config('netware.hours.timezone') }}
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="mt-10 border-t border-slate-200 pt-6">
                    <p class="text-center text-sm text-slate-500">
                        &copy; {{ date('Y') }} {{ config('app.name', 'Netware') }}. Hak cipta dilindungi.
                    </p>
                </div>
            </div>
        </footer>
    </body>
</html>

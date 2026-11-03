@extends('layouts.app')

@section('title', __('site.nav.home'))

@section('description', __('site.footer.about'))

@section('content')
    {{-- Hero --}}
    <section class="relative overflow-hidden border-b border-slate-200/70 bg-netware-mist dark:border-slate-800 dark:bg-slate-900">
        <div class="orb-drift pointer-events-none absolute -top-32 -right-24 h-96 w-96 rounded-full bg-netware-teal/15 blur-3xl"></div>
        <div class="orb-drift-slow pointer-events-none absolute -bottom-40 left-1/3 h-80 w-80 rounded-full bg-netware-blue/10 blur-3xl"></div>

        <div class="relative mx-auto grid max-w-7xl gap-8 px-5 py-10 sm:px-6 sm:py-14 lg:grid-cols-12 lg:gap-14 lg:px-8 lg:py-16">
            <div class="lg:col-span-7" data-reveal>
                <span class="inline-flex items-center gap-2 rounded-full border border-netware-teal/25 bg-white/70 px-3 py-1.5 text-[11px] font-medium text-netware-teal sm:text-xs dark:border-netware-teal/40 dark:bg-slate-800/80 dark:text-netware-teal">
                    <span class="h-1.5 w-1.5 rounded-full bg-netware-teal"></span>
                    {{ __('site.home.badge') }}
                </span>

                <h1 class="mt-5 text-[2rem] leading-[1.12] font-semibold tracking-tight text-netware-navy sm:mt-6 sm:text-4xl sm:leading-[1.08] lg:text-[3.4rem] dark:text-white">
                    {{ __('site.home.title_1') }}<br>
                    <span class="bg-linear-to-r from-netware-teal via-netware-blue to-netware-navy bg-clip-text text-transparent dark:from-netware-teal dark:via-cyan-300 dark:to-netware-teal">
                        {{ __('site.home.title_2') }}
                    </span>
                </h1>

                <p class="mt-5 max-w-xl text-base leading-relaxed text-slate-600 sm:mt-6 sm:text-lg dark:text-slate-400">
                    {{ __('site.home.lead') }}
                </p>

                <div class="mt-7 flex flex-wrap items-center gap-3 sm:mt-9">
                    <a
                        href="https://wa.me/{{ config('netware.whatsapp') }}?text={{ rawurlencode(__('site.whatsapp_message')) }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex items-center gap-2 rounded-full bg-netware-navy px-5 py-3 text-sm font-medium text-white shadow-sm transition-all duration-200 hover:-translate-y-0.5 hover:shadow-lg sm:px-6"
                    >
                        {{ __('site.actions.consult') }}
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </a>

                    <a
                        href="{{ route('layanan') }}"
                        class="inline-flex items-center gap-2 rounded-full border border-slate-300 bg-white px-5 py-3 text-sm font-medium text-netware-navy transition-colors duration-200 hover:border-netware-teal hover:text-netware-teal sm:px-6 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:hover:border-netware-teal"
                    >
                        {{ __('site.actions.view_services') }}
                    </a>
                </div>

                <dl class="mt-10 grid max-w-lg grid-cols-3 gap-4 border-t border-slate-200 pt-6 sm:mt-12 sm:gap-6 dark:border-slate-700">
                    <div>
                        <dt class="text-[11px] tracking-wide text-slate-500 uppercase sm:text-xs">{{ __('site.labels.experience') }}</dt>
                        <dd class="mt-1 text-xl font-semibold text-netware-navy sm:text-2xl dark:text-white">5+</dd>
                        <dd class="text-[11px] text-slate-500 sm:text-xs">{{ __('site.labels.years') }}</dd>
                    </div>
                    <div>
                        <dt class="text-[11px] tracking-wide text-slate-500 uppercase sm:text-xs">{{ __('site.labels.services') }}</dt>
                        <dd class="mt-1 text-xl font-semibold text-netware-navy sm:text-2xl dark:text-white">{{ count(config('netware.services')) }}</dd>
                        <dd class="text-[11px] text-slate-500 sm:text-xs">{{ __('site.labels.service_types') }}</dd>
                    </div>
                    <div>
                        <dt class="text-[11px] tracking-wide text-slate-500 uppercase sm:text-xs">{{ __('site.labels.open_hours') }}</dt>
                        <dd class="mt-1 text-xl font-semibold text-netware-navy sm:text-2xl dark:text-white">{{ config('netware.hours.open') }}</dd>
                        <dd class="text-[11px] text-slate-500 sm:text-xs">{{ config('netware.hours.timezone') }}</dd>
                    </div>
                </dl>
            </div>

            <div class="lg:col-span-5" data-reveal>
                <div class="relative rounded-2xl border border-slate-200 bg-white p-5 shadow-[0_30px_60px_-40px_rgba(51,80,149,0.45)] sm:p-6 dark:border-slate-800 dark:bg-slate-900 dark:shadow-none">
                    <div class="flex items-center justify-between gap-4">
                        <p class="text-xs font-semibold tracking-[0.18em] text-netware-teal uppercase">{{ __('site.labels.flow') }}</p>
                        <span class="rounded-full bg-netware-mist px-2.5 py-1 text-xs text-netware-teal dark:bg-slate-800">{{ __('site.labels.steps') }}</span>
                    </div>

                    <ol class="mt-5 space-y-5">
                        @foreach ([
                            [__('site.home.flow_1_title'), __('site.home.flow_1_body')],
                            [__('site.home.flow_2_title'), __('site.home.flow_2_body')],
                            [__('site.home.flow_3_title'), __('site.home.flow_3_body')],
                        ] as [$title, $description])
                            <li class="flex gap-4">
                                <span class="mt-0.5 flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-netware-navy/8 text-xs font-semibold text-netware-navy dark:bg-white/10 dark:text-white">
                                    {{ $loop->iteration }}
                                </span>
                                <div>
                                    <h2 class="text-sm font-semibold text-netware-navy dark:text-white">{{ $title }}</h2>
                                    <p class="mt-1 text-sm leading-relaxed text-slate-500 dark:text-slate-400">{{ $description }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ol>

                    <p class="mt-6 rounded-lg bg-netware-sand px-4 py-3 text-xs leading-relaxed text-amber-900 dark:bg-amber-500/10 dark:text-amber-200/90">
                        {{ __('site.home.flow_note') }}
                    </p>
                </div>

                {{-- Decorative network diagram: chip, data lines, and a Wi-Fi node. --}}
                <div class="mt-3 overflow-hidden rounded-xl border border-slate-200 bg-white px-4 py-3 dark:border-slate-800 dark:bg-slate-900" aria-hidden="true">
                    <div class="flex items-center justify-between gap-4">
                        <p class="text-xs font-semibold tracking-[0.18em] text-netware-teal uppercase">{{ __('site.home.network_title') }}</p>
                        <span class="flex items-center gap-1.5 text-[10px] font-medium tracking-wide text-slate-400 uppercase">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                            {{ __('site.home.network_status') }}
                        </span>
                    </div>

                    <svg viewBox="20 8 228 120" class="mt-2 h-[6.5rem] w-full" preserveAspectRatio="xMidYMid meet" role="presentation">
                        <defs>
                            <linearGradient id="node-fill" x1="0" y1="0" x2="1" y2="1">
                                <stop offset="0%" stop-color="#167d94" />
                                <stop offset="100%" stop-color="#335095" />
                            </linearGradient>
                        </defs>

                        {{-- Data lines --}}
                        <path d="M78 66 H120" class="data-flow" stroke="#167d94" stroke-width="2" fill="none" stroke-linecap="round" />
                        <path d="M78 84 H110 Q118 84 118 92 V108 H196" class="data-flow data-flow-slow" stroke="#266594" stroke-width="2" fill="none" stroke-linecap="round" />
                        <path d="M196 40 H150 Q142 40 142 48 V56" class="data-flow" stroke="#335095" stroke-width="2" fill="none" stroke-linecap="round" />

                        {{-- Chip --}}
                        <g>
                            <rect x="34" y="46" width="44" height="40" rx="6" fill="none" stroke="#335095" stroke-width="2" />
                            <rect x="44" y="58" width="24" height="16" rx="3" fill="url(#node-fill)" class="node-pulse" />
                            @foreach ([52, 60, 68] as $pin)
                                <line x1="26" y1="{{ $pin }}" x2="34" y2="{{ $pin }}" stroke="#94a3b8" stroke-width="1.5" stroke-linecap="round" />
                                <line x1="78" y1="{{ $pin }}" x2="86" y2="{{ $pin }}" stroke="#94a3b8" stroke-width="1.5" stroke-linecap="round" />
                            @endforeach
                        </g>

                        {{-- Wi-Fi node with expanding waves --}}
                        <g>
                            <circle cx="212" cy="40" r="26" fill="none" stroke="#cbd5e1" stroke-width="1.5" class="orbit-ring" stroke-dasharray="3 5" />
                            <circle cx="212" cy="40" r="5" fill="#167d94" class="node-pulse node-pulse-fast" />
                            <circle cx="212" cy="40" r="16" fill="none" stroke="#167d94" stroke-width="1.5" class="wifi-wave" />
                            <circle cx="212" cy="40" r="16" fill="none" stroke="#167d94" stroke-width="1.5" class="wifi-wave wifi-wave-2" />
                            <path d="M232 30a22 22 0 0 1 0 20" fill="none" stroke="#266594" stroke-width="2" stroke-linecap="round" />
                            <path d="M241 25a30 30 0 0 1 0 30" fill="none" stroke="#266594" stroke-width="2" stroke-linecap="round" opacity="0.6" />
                        </g>

                        {{-- Server rack --}}
                        <g>
                            <rect x="196" y="96" width="46" height="26" rx="4" fill="none" stroke="#335095" stroke-width="2" />
                            <line x1="204" y1="104" x2="234" y2="104" stroke="#266594" stroke-width="2" stroke-linecap="round" />
                            <line x1="204" y1="112" x2="228" y2="112" stroke="#167d94" stroke-width="2" stroke-linecap="round" />
                            <circle cx="234" cy="112" r="2.5" fill="#167d94" class="node-pulse node-pulse-fast" />
                        </g>
                    </svg>

                    <div class="mt-2 grid grid-cols-3 gap-2 border-t border-slate-100 pt-2 dark:border-slate-800">
                        @foreach ([
                            ['LAN', '100 Mbps'],
                            ['Uptime', '99,9%'],
                            ['Antrean', '0'] ,
                        ] as [$label, $value])
                            <div>
                                <p class="text-[10px] tracking-wide text-slate-400 uppercase">{{ $label }}</p>
                                <p class="mt-0.5 text-sm font-semibold text-netware-navy dark:text-white">{{ $value }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Profil --}}
    <section class="mx-auto max-w-7xl px-5 py-10 sm:px-6 sm:py-14 lg:px-8 lg:py-16">
        <div class="grid gap-10 lg:grid-cols-12 lg:gap-14">
            <div class="lg:col-span-4" data-reveal>
                <div class="flex items-center gap-3">
                    <span class="h-px w-8 bg-netware-teal"></span>
                    <p class="text-xs font-semibold tracking-[0.2em] text-netware-teal uppercase">{{ __('site.labels.profile') }}</p>
                </div>

                <h2 class="mt-4 text-2xl leading-tight font-semibold tracking-tight text-netware-navy sm:mt-5 sm:text-3xl dark:text-white">
                    {{ __('site.home.profile_title') }}
                </h2>

                <p class="mt-5 text-base leading-relaxed text-slate-600 dark:text-slate-400">
                    {{ __('site.home.profile_lead') }}
                </p>

                <dl class="mt-8 space-y-4 border-t border-slate-200 pt-6 dark:border-slate-800">
                    <div class="flex items-baseline justify-between gap-4">
                        <dt class="text-sm text-slate-500">{{ __('site.labels.managed_by') }}</dt>
                        <dd class="text-right text-sm font-medium text-netware-navy dark:text-white">{{ app()->getLocale() === 'en' ? 'TKJ students' : 'Siswa TKJ' }}</dd>
                    </div>
                    <div class="flex items-baseline justify-between gap-4">
                        <dt class="text-sm text-slate-500">{{ __('site.labels.serves') }}</dt>
                        <dd class="text-right text-sm font-medium text-netware-navy dark:text-white">{{ app()->getLocale() === 'en' ? 'Students, teachers, staff, guests' : 'Siswa, guru, karyawan, tamu' }}</dd>
                    </div>
                </dl>
            </div>

            <div class="lg:col-span-8" data-reveal>
                <div class="max-w-2xl space-y-5 text-base leading-[1.85] text-slate-600 dark:text-slate-400">
                    <p>{{ __('site.home.profile_p1') }}</p>
                    <p>{{ __('site.home.profile_p2') }}</p>
                </div>

                <figure class="mt-8 rounded-xl border-l-4 border-netware-teal bg-netware-mist/70 px-6 py-5 dark:bg-slate-900">
                    <blockquote class="text-base leading-relaxed font-medium text-netware-navy dark:text-slate-200">
                        {{ __('site.home.profile_quote') }}
                    </blockquote>
                </figure>
            </div>
        </div>
    </section>

    {{-- Marquee: fills the gap between sections with continuous motion. --}}
    <section class="marquee overflow-hidden border-y border-slate-200 bg-netware-navy py-4 dark:border-slate-800 dark:bg-slate-900" aria-hidden="true">
        <div class="marquee-track flex w-max items-center gap-8 whitespace-nowrap">
            @foreach ([1, 2] as $copy)
                <div @class(['flex items-center gap-8', 'pr-8' => $copy === 2])>
                    @foreach ([
                        'Instalasi OS',
                        'Service Laptop',
                        'Service HP',
                        'Service iPhone',
                        'Pemasangan Keyboard',
                        'Service PC',
                    ] as $word)
                        <span class="flex items-center gap-8 text-sm font-medium tracking-wide text-white/80">
                            {{ $word }}
                            <span class="h-1 w-1 rounded-full bg-netware-teal"></span>
                        </span>
                    @endforeach
                </div>
            @endforeach
        </div>
    </section>

    {{-- Layanan --}}
    <section class="border-y border-slate-200 bg-slate-50/70 dark:border-slate-800 dark:bg-slate-900/40">
        <div class="mx-auto max-w-7xl px-5 py-10 sm:px-6 sm:py-14 lg:px-8 lg:py-16">
            <div class="flex flex-wrap items-end justify-between gap-6" data-reveal>
                <div>
                    <div class="flex items-center gap-3">
                        <span class="h-px w-8 bg-netware-teal"></span>
                        <p class="text-xs font-semibold tracking-[0.2em] text-netware-teal uppercase">{{ __('site.labels.services') }}</p>
                    </div>
                    <h2 class="mt-5 text-3xl leading-tight font-semibold tracking-tight text-netware-navy dark:text-white">
                        {{ __('site.home.services_title') }}
                    </h2>
                </div>

                <a
                    href="{{ route('layanan') }}"
                    class="inline-flex items-center gap-2 text-sm font-medium text-netware-navy transition-colors duration-200 hover:text-netware-teal dark:text-white"
                >
                    {{ __('site.actions.all_services') }}
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>

            <ul class="mt-10 grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach (config('netware.services') as $service)
                    <li
                        class="group rounded-xl border border-slate-200 bg-white p-5 transition-all duration-300 hover:-translate-y-1 hover:border-netware-teal/40 hover:shadow-[0_24px_45px_-32px_rgba(51,80,149,0.5)] sm:p-6 dark:border-slate-800 dark:bg-slate-900 dark:hover:border-netware-teal/60"
                        data-reveal
                    >
                        <div class="flex items-center justify-between gap-4">
                            <span class="text-xs font-semibold tracking-[0.18em] text-slate-300 transition-colors duration-300 group-hover:text-netware-teal dark:text-slate-600">
                                {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                            </span>
                            <span class="flex h-8 w-8 items-center justify-center rounded-full bg-netware-mist text-netware-teal transition-colors duration-300 group-hover:bg-netware-teal group-hover:text-white dark:bg-slate-800">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                                </svg>
                            </span>
                        </div>

                        <h3 class="mt-6 text-base font-semibold text-netware-navy dark:text-white">{{ $service['name'] }}</h3>
                        <p class="mt-2 text-sm leading-relaxed text-slate-600 dark:text-slate-400">{{ $service['description'] }}</p>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endsection

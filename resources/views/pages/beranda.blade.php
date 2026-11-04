@extends('layouts.app')

@section('title', __('site.nav.home'))

@section('description', __('site.footer.about'))

@php
    $services = config('netware.services');
    $flow = [
        [__('site.home.flow_1_title'), __('site.home.flow_1_body')],
        [__('site.home.flow_2_title'), __('site.home.flow_2_body')],
        [__('site.home.flow_3_title'), __('site.home.flow_3_body')],
    ];
@endphp

@section('content')
    {{-- Hero: soft colour fields, deliberately unlike the grid that carries the rest of the page. --}}
    <section class="relative overflow-hidden border-b-2 border-slate-300 bg-slate-50 dark:border-slate-700 dark:bg-slate-950">
        {{-- Slow drifting colour pools; no lines, so the top of the page stands apart. --}}
        @include('partials.hero-backdrop')

        <div class="relative mx-auto grid max-w-7xl gap-10 px-5 py-10 sm:px-6 sm:py-12 lg:grid-cols-12 lg:gap-12 lg:px-8 lg:py-14">
            <div class="lg:col-span-7" data-reveal>
                <nav class="flex items-center gap-2 text-xs text-slate-400" aria-label="Breadcrumb">
                    <span class="text-slate-600 dark:text-slate-300">{{ __('site.nav.home') }}</span>
                    <span aria-hidden="true">/</span>
                    <span>{{ __('site.home.badge') }}</span>
                </nav>

                <div class="mt-6 flex items-center gap-3">
                    <span class="h-px w-8 bg-netware-teal"></span>
                    <p class="text-xs font-semibold tracking-[0.2em] text-netware-teal uppercase">{{ config('app.name') }}</p>
                </div>

                <h1 class="mt-4 text-[2rem] leading-[1.1] font-semibold tracking-tight text-netware-navy sm:text-4xl lg:text-[2.9rem] dark:text-white">
                    {{ __('site.home.title_1') }}<br>
                    <span class="text-netware-teal">{{ __('site.home.title_2') }}</span>
                </h1>

                <p class="mt-5 max-w-xl text-sm leading-relaxed text-slate-600 sm:text-base dark:text-slate-400">
                    {{ __('site.home.lead') }}
                </p>

                <div class="mt-7 flex flex-wrap items-center gap-3">
                    <a
                        href="https://wa.me/{{ config('netware.whatsapp') }}?text={{ rawurlencode(__('site.whatsapp_message')) }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex items-center gap-2 rounded-full bg-netware-navy px-5 py-2.5 text-sm font-medium text-white transition-colors duration-200 hover:bg-netware-blue"
                    >
                        {{ __('site.actions.consult') }}
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </a>

                    <a
                        href="{{ route('layanan') }}"
                        class="inline-flex items-center gap-2 border border-slate-300 px-5 py-2.5 text-sm font-medium text-netware-navy transition-colors duration-200 hover:border-netware-teal hover:text-netware-teal dark:border-slate-700 dark:text-white"
                    >
                        {{ __('site.actions.view_services') }}
                    </a>
                </div>

                <dl class="mt-9 grid max-w-lg grid-cols-3 divide-x-2 divide-slate-300 border-y-2 border-slate-300 py-4 dark:divide-slate-700 dark:border-slate-700">
                    <div class="pr-4">
                        <dt class="text-[10px] tracking-[0.16em] text-slate-400 uppercase">{{ __('site.labels.experience') }}</dt>
                        <dd class="mt-1 text-2xl font-semibold tabular-nums text-netware-navy dark:text-white">5+</dd>
                        <dd class="text-[10px] text-slate-400">{{ __('site.labels.years') }}</dd>
                    </div>
                    <div class="px-4">
                        <dt class="text-[10px] tracking-[0.16em] text-slate-400 uppercase">{{ __('site.labels.services') }}</dt>
                        <dd class="mt-1 text-2xl font-semibold tabular-nums text-netware-navy dark:text-white">{{ count($services) }}</dd>
                        <dd class="text-[10px] text-slate-400">{{ __('site.labels.service_types') }}</dd>
                    </div>
                    <div class="pl-4">
                        <dt class="text-[10px] tracking-[0.16em] text-slate-400 uppercase">{{ __('site.labels.open_hours') }}</dt>
                        <dd class="mt-1 text-2xl font-semibold tabular-nums text-netware-teal">{{ config('netware.hours.open') }}</dd>
                        <dd class="text-[10px] text-slate-400">{{ config('netware.hours.timezone') }}</dd>
                    </div>
                </dl>
            </div>

            {{-- Right column: flow steps on a squared panel, then the network diagram. --}}
            <div class="lg:col-span-5" data-reveal>
                <div class="border border-slate-300 bg-white dark:border-slate-700 dark:bg-slate-900">
                    <div class="flex items-center justify-between gap-4 border-b border-slate-300 px-4 py-3 dark:border-slate-700">
                        <p class="text-xs font-semibold tracking-[0.16em] text-slate-500 uppercase dark:text-slate-400">{{ __('site.labels.flow') }}</p>
                        <span class="text-[10px] font-semibold tracking-[0.14em] text-netware-teal uppercase">{{ __('site.labels.steps') }}</span>
                    </div>

                    <ol class="divide-y divide-slate-300 dark:divide-slate-700">
                        @foreach ($flow as [$title, $description])
                            <li class="flex gap-4 px-4 py-4">
                                <span class="mt-0.5 flex h-6 w-6 shrink-0 items-center justify-center border border-netware-teal/30 bg-netware-teal/8 text-[11px] font-semibold tabular-nums text-netware-teal">
                                    {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                </span>
                                <div>
                                    <h2 class="text-sm font-semibold text-netware-navy dark:text-white">{{ $title }}</h2>
                                    <p class="mt-1 text-xs leading-relaxed text-slate-500 dark:text-slate-400">{{ $description }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ol>

                    <p class="border-t border-slate-300 bg-netware-sand px-4 py-3 text-[11px] leading-relaxed text-amber-900 dark:border-slate-700 dark:bg-amber-500/10 dark:text-amber-200/90">
                        {{ __('site.home.flow_note') }}
                    </p>
                </div>

                <div class="mt-3 border border-slate-300 bg-white px-4 py-3 dark:border-slate-700 dark:bg-slate-900" aria-hidden="true">
                    <div class="flex items-center justify-between gap-4">
                        <p class="text-xs font-semibold tracking-[0.16em] text-slate-500 uppercase dark:text-slate-400">{{ __('site.home.network_title') }}</p>
                        <span class="flex items-center gap-1.5 text-[10px] font-semibold tracking-[0.14em] text-emerald-600 uppercase dark:text-emerald-400">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                            {{ __('site.home.network_status') }}
                        </span>
                    </div>

                    <svg viewBox="24 6 226 118" class="mt-2 h-[6.5rem] w-full" preserveAspectRatio="xMidYMid meet" role="presentation">
                        <defs>
                            <linearGradient id="node-fill" x1="0" y1="0" x2="1" y2="1">
                                <stop offset="0%" stop-color="#167d94" />
                                <stop offset="100%" stop-color="#335095" />
                            </linearGradient>
                        </defs>

                        <path d="M86 44 H150" class="data-flow" stroke="#167d94" stroke-width="2" fill="none" stroke-linecap="round" />
                        <path d="M86 82 V100 Q86 108 94 108 H196" class="data-flow data-flow-slow" stroke="#266594" stroke-width="2" fill="none" stroke-linecap="round" />

                        <g>
                            <rect x="36" y="34" width="50" height="58" rx="2" fill="none" stroke="#335095" stroke-width="2" />
                            <rect x="48" y="54" width="26" height="18" rx="1" fill="url(#node-fill)" class="node-pulse" />
                            @foreach ([44, 58, 72, 82] as $pin)
                                <line x1="28" y1="{{ $pin }}" x2="36" y2="{{ $pin }}" stroke="#94a3b8" stroke-width="1.5" stroke-linecap="round" />
                            @endforeach
                        </g>

                        <g>
                            <rect x="150" y="32" width="44" height="24" rx="2" fill="none" stroke="#335095" stroke-width="2" />
                            <circle cx="162" cy="44" r="3" fill="#167d94" class="node-pulse node-pulse-fast" />
                            <line x1="176" y1="44" x2="186" y2="44" stroke="#cbd5e1" stroke-width="2" stroke-linecap="round" />
                            <line x1="172" y1="32" x2="172" y2="24" stroke="#335095" stroke-width="2" stroke-linecap="round" />
                            <circle cx="172" cy="18" r="3.5" fill="#167d94" class="node-pulse node-pulse-fast" />
                            <circle cx="172" cy="18" r="9" fill="none" stroke="#167d94" stroke-width="1.5" class="wifi-wave" />
                            <circle cx="172" cy="18" r="9" fill="none" stroke="#167d94" stroke-width="1.5" class="wifi-wave wifi-wave-2" />
                            <path d="M186 12a12 12 0 0 1 0 12" fill="none" stroke="#266594" stroke-width="2" stroke-linecap="round" />
                            <path d="M193 8a19 19 0 0 1 0 20" fill="none" stroke="#266594" stroke-width="2" stroke-linecap="round" opacity="0.55" />
                        </g>

                        <g>
                            <rect x="196" y="96" width="52" height="24" rx="2" fill="none" stroke="#335095" stroke-width="2" />
                            <line x1="204" y1="104" x2="238" y2="104" stroke="#266594" stroke-width="2" stroke-linecap="round" />
                            <line x1="204" y1="112" x2="232" y2="112" stroke="#167d94" stroke-width="2" stroke-linecap="round" />
                            <circle cx="240" cy="112" r="2.5" fill="#167d94" class="node-pulse node-pulse-fast" />
                        </g>
                    </svg>

                    <div class="mt-2 grid grid-cols-3 divide-x-2 divide-slate-300 border-t-2 border-slate-300 pt-2 dark:divide-slate-700 dark:border-slate-700">
                        @foreach ([['LAN', '100 Mbps'], ['Uptime', '99,9%'], [__('site.home.queue_label'), '0']] as [$label, $value])
                            <div class="{{ $loop->first ? 'pr-3' : ($loop->last ? 'pl-3' : 'px-3') }}">
                                <p class="text-[10px] tracking-[0.14em] text-slate-400 uppercase">{{ $label }}</p>
                                <p class="mt-0.5 text-sm font-semibold tabular-nums text-netware-navy dark:text-white">{{ $value }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Everything below the hero sits on the drifting engineering grid. --}}
    <div class="grid-motion bg-white dark:bg-slate-950">
        {{-- Marquee --}}
        <section class="marquee overflow-hidden border-b border-slate-300 bg-netware-navy py-3 dark:border-slate-700 dark:bg-slate-900" aria-hidden="true">
            <div class="marquee-track flex w-max items-center gap-8 whitespace-nowrap">
                @foreach ([1, 2] as $copy)
                    <div @class(['flex items-center gap-8', 'pr-8' => $copy === 2])>
                        @foreach (__('site.home.marquee') as $word)
                            <span class="flex items-center gap-8 text-xs font-medium tracking-[0.12em] text-white/80 uppercase">
                                {{ $word }}
                                <span class="h-1 w-1 bg-netware-teal"></span>
                            </span>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </section>

        {{-- Profil --}}
        <section class="mx-auto max-w-7xl px-5 py-10 sm:px-6 sm:py-12 lg:px-8 lg:py-14">
            <div class="grid gap-10 lg:grid-cols-12 lg:gap-12">
                <div class="lg:col-span-4" data-reveal>
                    <div class="flex items-center gap-3">
                        <span class="h-px w-8 bg-netware-teal"></span>
                        <p class="text-xs font-semibold tracking-[0.2em] text-netware-teal uppercase">{{ __('site.labels.profile') }}</p>
                    </div>

                    <h2 class="mt-4 text-2xl leading-tight font-semibold tracking-tight text-netware-navy sm:text-3xl dark:text-white">
                        {{ __('site.home.profile_title') }}
                    </h2>

                    <p class="mt-4 text-sm leading-relaxed text-slate-600 dark:text-slate-400">
                        {{ __('site.home.profile_lead') }}
                    </p>

                    <dl class="mt-6 divide-y-2 divide-slate-300 border-y-2 border-slate-300 dark:divide-slate-700 dark:border-slate-700">
                        <div class="flex items-baseline justify-between gap-4 py-3">
                            <dt class="text-xs tracking-wide text-slate-400 uppercase">{{ __('site.labels.managed_by') }}</dt>
                            <dd class="text-right text-sm font-medium text-netware-navy dark:text-white">{{ app()->getLocale() === 'en' ? 'TKJ students' : 'Siswa TKJ' }}</dd>
                        </div>
                        <div class="flex items-baseline justify-between gap-4 py-3">
                            <dt class="text-xs tracking-wide text-slate-400 uppercase">{{ __('site.labels.serves') }}</dt>
                            <dd class="text-right text-sm font-medium text-netware-navy dark:text-white">{{ app()->getLocale() === 'en' ? 'Students, teachers, staff, guests' : 'Siswa, guru, karyawan, tamu' }}</dd>
                        </div>
                    </dl>
                </div>

                <div class="lg:col-span-8" data-reveal>
                    <div class="max-w-2xl space-y-5 text-sm leading-[1.85] text-slate-600 sm:text-base dark:text-slate-400">
                        <p>{{ __('site.home.profile_p1') }}</p>
                        <p>{{ __('site.home.profile_p2') }}</p>
                    </div>

                    <figure class="mt-8 border-l-2 border-netware-teal bg-slate-50 px-5 py-4 dark:bg-slate-900">
                        <blockquote class="text-sm leading-relaxed font-medium text-netware-navy sm:text-base dark:text-slate-200">
                            {{ __('site.home.profile_quote') }}
                        </blockquote>
                    </figure>
                </div>
            </div>
        </section>

        {{-- Layanan: sama seperti grid katalog, sudut tegas dan garis pemisah tipis. --}}
        <section class="border-y-2 border-slate-300 dark:border-slate-700">
            <div class="mx-auto max-w-7xl px-5 py-10 sm:px-6 sm:py-12 lg:px-8 lg:py-14">
                <div class="flex flex-wrap items-end justify-between gap-4 border-b-2 border-slate-300 pb-4 dark:border-slate-700" data-reveal>
                    <div>
                        <div class="flex items-center gap-3">
                            <span class="h-px w-8 bg-netware-teal"></span>
                            <p class="text-xs font-semibold tracking-[0.2em] text-netware-teal uppercase">{{ __('site.labels.services') }}</p>
                        </div>
                        <h2 class="mt-4 text-2xl leading-tight font-semibold tracking-tight text-netware-navy sm:text-3xl dark:text-white">
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

                <ul class="mt-px grid gap-[2px] border border-slate-300 bg-slate-300 sm:grid-cols-2 lg:grid-cols-3 dark:border-slate-700 dark:bg-slate-800">
                    @foreach ($services as $service)
                        <li data-reveal>
                            <a href="{{ route('layanan.detail', ['slug' => app(App\Http\Controllers\ServiceDetailController::class)::slugFor($service)]) }}" class="group flex h-full flex-col bg-white p-5 transition-colors duration-300 hover:bg-slate-50 dark:bg-slate-950 dark:hover:bg-slate-900">
                                <div class="flex items-center justify-between gap-4">
                                    <span class="text-[10px] font-semibold tracking-[0.16em] tabular-nums text-slate-400 uppercase">
                                        {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                    </span>
                                    <svg class="h-4 w-4 text-slate-300 transition-colors duration-300 group-hover:text-netware-teal dark:text-slate-600" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                                    </svg>
                                </div>

                                <h3 class="mt-4 text-sm font-semibold text-netware-navy dark:text-white">{{ $service['name'][app()->getLocale()] ?? $service['name']['id'] }}</h3>
                                <p class="mt-1.5 flex-1 text-xs leading-relaxed text-slate-500 dark:text-slate-400">{{ $service['description'][app()->getLocale()] ?? $service['description']['id'] }}</p>
                                <span class="mt-3 inline-flex items-center gap-1.5 text-[11px] font-semibold tracking-wide text-netware-teal uppercase">
                                    {{ __('services_page.detail_other_link') }}
                                    <svg class="h-3 w-3 transition-transform duration-300 group-hover:translate-x-0.5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                    </svg>
                                </span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
    </div>

@endsection

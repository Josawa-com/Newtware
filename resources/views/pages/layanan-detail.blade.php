@extends('layouts.app')

@section('title', $name)

@section('description', $detail['subtitle'])

@section('content')
    {{-- Hero: same aurora family as the other pages, tinted for the detail page. --}}
    <section class="relative overflow-hidden border-b-2 border-slate-300 bg-slate-50 dark:border-slate-700 dark:bg-slate-950">
        @include('partials.hero-backdrop')

        <div class="relative mx-auto max-w-7xl px-5 py-10 sm:px-6 sm:py-12 lg:px-8 lg:py-14">
            <div class="max-w-3xl" data-reveal>
                <nav class="flex flex-wrap items-center gap-2 text-xs text-slate-400" aria-label="{{ __('site.labels.breadcrumb') }}">
                    <a href="{{ route('beranda') }}" class="transition-colors hover:text-netware-teal">{{ __('site.nav.home') }}</a>
                    <span aria-hidden="true">/</span>
                    <a href="{{ route('layanan') }}" class="transition-colors hover:text-netware-teal">{{ __('site.nav.services') }}</a>
                    <span aria-hidden="true">/</span>
                    <span class="text-slate-600 dark:text-slate-300">{{ $name }}</span>
                </nav>

                <div class="mt-6 flex items-center gap-3">
                    <span class="h-px w-8 bg-netware-teal"></span>
                    <p class="text-xs font-semibold tracking-[0.2em] text-netware-teal uppercase">{{ __('site.nav.services') }}</p>
                </div>

                <h1 class="mt-4 text-[1.7rem] leading-[1.15] font-semibold tracking-tight text-netware-navy sm:text-4xl dark:text-white">
                    {{ $name }}
                </h1>

                <p class="mt-4 text-base leading-relaxed font-medium text-netware-teal sm:text-lg">
                    {{ $detail['subtitle'] }}
                </p>
            </div>
        </div>
    </section>

    <div class="grid-motion bg-white dark:bg-slate-950">
        <div class="mx-auto max-w-7xl px-5 py-10 sm:px-6 sm:py-12 lg:px-8 lg:py-14">
            <div class="grid gap-10 lg:grid-cols-12 lg:gap-12">
                {{-- Article --}}
                <article class="lg:col-span-8">
                    <div class="max-w-2xl space-y-5 text-sm leading-[1.9] text-slate-600 sm:text-base dark:text-slate-400" data-reveal>
                        @foreach ($detail['intro'] as $paragraph)
                            <p>{{ $paragraph }}</p>
                        @endforeach
                    </div>

                    {{-- Scope --}}
                    <section class="mt-12" data-reveal>
                        <div class="flex items-center gap-3">
                            <span class="h-px w-8 bg-netware-teal"></span>
                            <h2 class="text-xs font-semibold tracking-[0.2em] text-netware-teal uppercase">{{ __('services_page.detail_scope') }}</h2>
                        </div>

                        <ul class="mt-6 grid gap-[2px] border border-slate-300 bg-slate-300 sm:grid-cols-2 dark:border-slate-700 dark:bg-slate-800">
                            @foreach ($detail['scope'] as [$scopeTitle, $scopeBody])
                                <li class="bg-white p-5 dark:bg-slate-950">
                                    <h3 class="flex items-start gap-2.5 text-sm font-semibold text-netware-navy dark:text-white">
                                        <svg class="mt-0.5 h-3.5 w-3.5 shrink-0 text-netware-teal" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                        </svg>
                                        {{ $scopeTitle }}
                                    </h3>
                                    <p class="mt-2 text-xs leading-relaxed text-slate-500 dark:text-slate-400">{{ $scopeBody }}</p>
                                </li>
                            @endforeach
                        </ul>
                    </section>

                    {{-- Workflow --}}
                    <section class="mt-12" data-reveal>
                        <div class="flex items-center gap-3">
                            <span class="h-px w-8 bg-netware-teal"></span>
                            <h2 class="text-xs font-semibold tracking-[0.2em] text-netware-teal uppercase">{{ $detail['process_title'] }}</h2>
                        </div>

                        <ol class="mt-6 divide-y divide-slate-300 border-y-2 border-slate-300 dark:divide-slate-700 dark:border-slate-700">
                            @foreach ($detail['process'] as $step)
                                <li class="flex gap-5 py-5">
                                    <span class="mt-0.5 flex h-7 w-7 shrink-0 items-center justify-center border border-netware-teal/30 bg-netware-teal/8 text-[11px] font-semibold tabular-nums text-netware-teal">
                                        {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                                    </span>
                                    <p class="text-sm leading-relaxed text-slate-600 dark:text-slate-400">{{ $step }}</p>
                                </li>
                            @endforeach
                        </ol>
                    </section>

                    {{-- Commitment --}}
                    <section class="mt-12" data-reveal>
                        <div class="flex items-center gap-3">
                            <span class="h-px w-8 bg-netware-teal"></span>
                            <h2 class="text-xs font-semibold tracking-[0.2em] text-netware-teal uppercase">{{ $detail['commitment_title'] }}</h2>
                        </div>

                        <div class="mt-6 space-y-4 text-sm leading-[1.9] text-slate-600 dark:text-slate-400">
                            @foreach ($detail['commitment'] as $paragraph)
                                <p>{{ $paragraph }}</p>
                            @endforeach
                        </div>

                        <p class="mt-8 border-l-2 border-netware-teal bg-slate-50 px-5 py-4 text-sm font-semibold text-netware-navy dark:bg-slate-900 dark:text-slate-200">
                            {{ $detail['tagline'] }}
                        </p>
                    </section>
                </article>

                {{-- Sidebar --}}
                <aside class="lg:col-span-4">
                    <div class="lg:sticky lg:top-24" data-reveal>
                        {{-- Consultation panel --}}
                        <div class="border border-netware-navy/20 bg-netware-navy p-6 text-white dark:border-slate-800 dark:bg-slate-900">
                            <p class="text-[10px] font-semibold tracking-[0.18em] text-white/50 uppercase">{{ __('site.labels.flow') }}</p>
                            <h2 class="mt-3 text-lg leading-snug font-semibold">{{ __('site.services_page.aside_title') }}</h2>
                            <p class="mt-3 text-xs leading-relaxed text-white/70">
                                {{ __('site.services_page.aside_body') }}
                            </p>
                            <a
                                href="https://wa.me/{{ config('netware.whatsapp') }}?text={{ rawurlencode(__('site.whatsapp_message')) }}"
                                target="_blank"
                                rel="noopener noreferrer"
                                class="mt-5 inline-flex items-center gap-2 bg-white px-5 py-2.5 text-sm font-medium text-netware-navy transition-colors duration-200 hover:bg-white/90"
                            >
                                {{ __('site.actions.consult_whatsapp') }}
                            </a>
                        </div>

                        {{-- Operational facts --}}
                        <div class="mt-3 border border-slate-300 bg-white dark:border-slate-700 dark:bg-slate-900">
                            <div class="border-b border-slate-300 px-4 py-3 dark:border-slate-700">
                                <p class="text-[10px] font-semibold tracking-[0.18em] text-slate-500 uppercase dark:text-slate-400">{{ __('site.labels.hours') }}</p>
                            </div>
                            <dl class="divide-y divide-slate-300 dark:divide-slate-700">
                                <div class="flex items-baseline justify-between gap-4 px-4 py-3">
                                    <dt class="text-xs tracking-wide text-slate-400 uppercase">{{ __('site.labels.open') }}</dt>
                                    <dd class="text-sm font-semibold tabular-nums text-netware-navy dark:text-white">{{ config('netware.hours.open') }} {{ config('netware.hours.timezone') }}</dd>
                                </div>
                                <div class="flex items-baseline justify-between gap-4 px-4 py-3">
                                    <dt class="text-xs tracking-wide text-slate-400 uppercase">{{ __('site.labels.close') }}</dt>
                                    <dd class="text-sm font-semibold tabular-nums text-netware-navy dark:text-white">{{ config('netware.hours.close') }} {{ config('netware.hours.timezone') }}</dd>
                                </div>
                            </dl>
                            <p class="border-t border-slate-300 bg-slate-50 px-4 py-3 text-[11px] leading-relaxed text-slate-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-400">
                                {{ config('netware.hours.note')[app()->getLocale()] ?? config('netware.hours.note.id') }}
                            </p>
                        </div>
                    </div>
                </aside>
            </div>

            {{-- Other services --}}
            <section class="mt-16 border-t-2 border-slate-300 pt-8 dark:border-slate-700" data-reveal>
                <div class="flex items-center gap-3">
                    <span class="h-px w-8 bg-netware-teal"></span>
                    <h2 class="text-xs font-semibold tracking-[0.2em] text-netware-teal uppercase">{{ __('services_page.detail_others') }}</h2>
                </div>

                <ul class="mt-6 grid gap-[2px] border border-slate-300 bg-slate-300 sm:grid-cols-2 lg:grid-cols-5 dark:border-slate-700 dark:bg-slate-800">
                    @foreach ($others as $other)
                        <li>
                            <a
                                href="{{ route('layanan.detail', ['slug' => $other['slug']]) }}"
                                class="group flex h-full flex-col bg-white p-4 transition-colors duration-300 hover:bg-slate-50 dark:bg-slate-950 dark:hover:bg-slate-900"
                            >
                                <span class="text-[10px] font-semibold tracking-[0.16em] text-slate-400 uppercase">{{ $name === $other['name'] ? '' : __('services_page.detail_other_link') }}</span>
                                <span class="mt-2 text-sm font-semibold text-netware-navy transition-colors duration-300 group-hover:text-netware-teal dark:text-white">
                                    {{ $other['name'] }}
                                </span>
                                <span class="mt-1.5 text-xs leading-relaxed text-slate-500 dark:text-slate-400">{{ $other['description'] }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>

                <div class="mt-6">
                    <a
                        href="{{ route('layanan') }}"
                        class="inline-flex items-center gap-2 border border-slate-300 px-5 py-2.5 text-sm font-medium text-netware-navy transition-colors duration-200 hover:border-netware-teal hover:text-netware-teal dark:border-slate-700 dark:text-white"
                    >
                        {{ __('site.actions.all_services') }}
                    </a>
                </div>
            </section>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('title', __('site.nav.products'))

@section('description', __('products.barang.lead'))

@php
    $items = collect(config('products.items'));
    $categories = config('products.categories');
    $activeCategory = request()->query('kategori');
    $visibleItems = $activeCategory ? $items->where('category', $activeCategory) : $items;
    $withPrice = $items->whereNotNull('price')->count();

    $priceLabel = function (array $item) {
        if (! empty($item['price_note'])) {
            return $item['price_note'];
        }

        return $item['price'] === null
            ? __('products.barang.price_ask')
            : 'Rp '.number_format($item['price'], 0, ',', '.');
    };
@endphp

@section('content')
    {{-- Hero: soft colour fields, deliberately unlike the grid that carries the rest of the page. --}}
    <section class="relative overflow-hidden border-b-2 border-slate-300 bg-slate-50 dark:border-slate-700 dark:bg-slate-950">
        {{-- Slow drifting colour pools; no lines, so the top of the page stands apart. --}}
        @include('partials.hero-backdrop')

        <div class="relative mx-auto max-w-7xl px-5 py-10 sm:px-6 sm:py-12 lg:px-8 lg:py-14">
            <nav class="flex items-center gap-2 text-xs text-slate-400" aria-label="Breadcrumb">
                <a href="{{ route('beranda') }}" class="transition-colors hover:text-netware-teal">{{ __('site.nav.home') }}</a>
                <span aria-hidden="true">/</span>
                <span class="text-slate-600 dark:text-slate-300">{{ __('site.nav.products') }}</span>
            </nav>

            <div class="mt-6 grid gap-10 lg:grid-cols-12 lg:items-end lg:gap-12">
                <div class="lg:col-span-7" data-reveal>
                    <div class="flex items-center gap-3">
                        <span class="h-px w-8 bg-netware-teal"></span>
                        <p class="text-xs font-semibold tracking-[0.2em] text-netware-teal uppercase">{{ __('products.barang.eyebrow') }}</p>
                    </div>

                    <h1 class="mt-4 text-[2rem] leading-[1.1] font-semibold tracking-tight text-netware-navy sm:text-4xl lg:text-[2.9rem] dark:text-white">
                        {{ __('products.barang.title_1') }}<br>{{ __('products.barang.title_2') }}
                    </h1>

                    <p class="mt-5 max-w-xl text-sm leading-relaxed text-slate-600 sm:text-base dark:text-slate-400">
                        {{ __('products.barang.lead') }}
                    </p>
                </div>

                <div class="lg:col-span-5" data-reveal>
                    <dl class="grid grid-cols-3 divide-x-2 divide-slate-300 border-y-2 border-slate-300 py-4 dark:divide-slate-700 dark:border-slate-700">
                        <div class="pr-4">
                            <dt class="text-[10px] tracking-[0.16em] text-slate-400 uppercase">{{ __('products.barang.filter_all') }}</dt>
                            <dd class="mt-1 text-2xl font-semibold tabular-nums text-netware-navy dark:text-white">{{ $items->count() }}</dd>
                        </div>
                        <div class="px-4">
                            <dt class="text-[10px] tracking-[0.16em] text-slate-400 uppercase">{{ __('products.barang.filter_label') }}</dt>
                            <dd class="mt-1 text-2xl font-semibold tabular-nums text-netware-navy dark:text-white">{{ count($categories) }}</dd>
                        </div>
                        <div class="pl-4">
                            <dt class="text-[10px] tracking-[0.16em] text-slate-400 uppercase">{{ __('products.barang.available') }}</dt>
                            <dd class="mt-1 text-2xl font-semibold tabular-nums text-netware-teal">{{ $withPrice }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </section>

    {{-- Filter bar: squared chips, sticky so it stays reachable in a long list. --}}
    <div class="sticky top-16 z-40 border-b-2 border-slate-300 bg-white/95 backdrop-blur dark:border-slate-700 dark:bg-slate-950/95">
        <div class="pointer-events-none absolute inset-x-0 bottom-0 h-px overflow-hidden">
            <span class="scan-line block h-px w-1/3 bg-linear-to-r from-transparent via-netware-teal to-transparent"></span>
        </div>

        <div class="mx-auto max-w-7xl px-5 sm:px-6 lg:px-8">
            <div class="flex items-center gap-3 overflow-x-auto py-3 [scrollbar-width:none] [&::-webkit-scrollbar]:hidden">
                <a
                    href="{{ route('barang') }}"
                    @class([
                        'shrink-0 border-b-2 px-1 pb-1 text-sm font-medium transition-colors duration-200',
                        'border-netware-teal text-netware-navy dark:text-white' => ! $activeCategory,
                        'border-transparent text-slate-500 hover:text-netware-teal dark:text-slate-400' => $activeCategory,
                    ])
                    @if (! $activeCategory) aria-current="page" @endif
                >
                    {{ __('products.barang.filter_all') }}
                    <span class="ml-1 text-xs tabular-nums text-slate-400">{{ $items->count() }}</span>
                </a>

                @foreach ($categories as $slug => $label)
                    @php $count = $items->where('category', $slug)->count(); @endphp

                    @continue($count === 0)

                    <a
                        href="{{ route('barang', ['kategori' => $slug]) }}"
                        @class([
                            'shrink-0 border-b-2 px-1 pb-1 text-sm font-medium transition-colors duration-200',
                            'border-netware-teal text-netware-navy dark:text-white' => $activeCategory === $slug,
                            'border-transparent text-slate-500 hover:text-netware-teal dark:text-slate-400' => $activeCategory !== $slug,
                        ])
                        @if ($activeCategory === $slug) aria-current="page" @endif
                    >
                        {{ $label[app()->getLocale()] ?? $label['id'] }}
                        <span class="ml-1 text-xs tabular-nums text-slate-400">{{ $count }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Katalog: same drifting grid as the rest of the site below the hero. --}}
    <div class="grid-motion bg-white dark:bg-slate-950">
        <section class="mx-auto max-w-7xl px-5 py-10 sm:px-6 sm:py-12 lg:px-8 lg:py-14">
            <div class="flex flex-wrap items-baseline justify-between gap-3 border-b-2 border-slate-300 pb-4 dark:border-slate-700">
                <h2 class="text-sm font-semibold tracking-[0.16em] text-slate-500 uppercase dark:text-slate-400">
                    {{ $activeCategory ? ($categories[$activeCategory][app()->getLocale()] ?? $categories[$activeCategory]['id']) : __('products.barang.filter_all') }}
                </h2>
                <p class="text-sm text-slate-500 dark:text-slate-400">
                    {{ __('products.barang.count', ['count' => $visibleItems->count()]) }}
                </p>
            </div>

            @if ($visibleItems->isEmpty())
                <p class="mt-10 border border-dashed border-slate-300 px-6 py-12 text-center text-sm text-slate-500 dark:border-slate-700 dark:text-slate-400">
                    {{ __('products.barang.empty') }}
                </p>
            @else
                <ul class="mt-6 grid grid-cols-2 gap-[2px] border border-slate-300 bg-slate-300 sm:grid-cols-3 lg:grid-cols-4 dark:border-slate-700 dark:bg-slate-800">
                    @foreach ($visibleItems as $item)
                        <li class="group relative flex flex-col bg-white transition-colors duration-300 hover:bg-slate-50/80 dark:bg-slate-950 dark:hover:bg-slate-900" data-reveal>
                            <div class="relative overflow-hidden bg-slate-100 dark:bg-slate-900">
                                <img
                                    src="{{ asset('Barang/'.$item['image']) }}"
                                    alt="{{ $item['name'] }}"
                                    loading="lazy"
                                    class="aspect-4/3 w-full object-cover transition-transform duration-700 ease-out group-hover:scale-[1.06]"
                                >

                                <span class="absolute top-0 left-0 bg-netware-navy/90 px-2 py-1 text-[10px] font-semibold tracking-[0.14em] text-white uppercase backdrop-blur-sm">
                                    {{ $categories[$item['category']][app()->getLocale()] ?? $categories[$item['category']]['id'] }}
                                </span>

                                {{-- Priced items already show the price and a check mark below, so no badge is needed here. --}}
                            </div>

                            <div class="flex flex-1 flex-col border-t-2 border-slate-300 p-4 dark:border-slate-700">
                                <p class="text-[10px] tabular-nums tracking-[0.14em] text-slate-400 uppercase">
                                    {{ str_pad($item['id'], 2, '0', STR_PAD_LEFT) }}
                                </p>

                                <h3 class="mt-1.5 text-sm leading-snug font-semibold text-netware-navy dark:text-white">
                                    {{ $item['name'] }}
                                </h3>
                                <p class="mt-1 text-xs leading-relaxed text-slate-500 dark:text-slate-400">{{ $item['note'] }}</p>

                                <div class="mt-auto flex items-center justify-between gap-2 pt-4">
                                    <p @class([
                                        'text-sm font-semibold tabular-nums',
                                        'text-netware-navy dark:text-white' => $item['price'] !== null,
                                        'text-xs font-medium text-slate-400' => $item['price'] === null,
                                    ])>
                                        {{ $priceLabel($item) }}
                                    </p>

                                    @if ($item['price'] !== null)
                                        {{-- Priced items need no chat button; a check marks them as available. --}}
                                        <span
                                            class="inline-flex h-7 w-7 items-center justify-center border border-emerald-500/40 bg-emerald-500/10 text-emerald-600 dark:text-emerald-400"
                                            title="{{ __('products.barang.available') }}"
                                            aria-label="{{ __('products.barang.available') }}"
                                        >
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                                            </svg>
                                        </span>
                                    @else
                                        <a
                                            href="https://wa.me/{{ config('netware.whatsapp') }}?text={{ rawurlencode(__('products.barang.consult_message', ['name' => $item['name']])) }}"
                                            target="_blank"
                                            rel="noopener noreferrer"
                                            class="inline-flex h-7 w-7 items-center justify-center border border-slate-300 text-slate-500 transition-colors duration-200 hover:border-netware-teal hover:bg-netware-teal hover:text-white dark:border-slate-700 dark:text-slate-400"
                                            aria-label="{{ __('products.barang.consult').': '.$item['name'] }}"
                                        >
                                            <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                                <path d="M12.04 2C6.58 2 2.13 6.45 2.13 11.91c0 1.75.46 3.45 1.32 4.95L2 22l5.25-1.38a9.86 9.86 0 004.79 1.22h.01c5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.82 9.82 0 0012.04 2zm0 18.13h-.01a8.2 8.2 0 01-4.18-1.15l-.3-.18-3.11.82.83-3.04-.2-.31a8.18 8.18 0 01-1.26-4.36c0-4.54 3.7-8.23 8.24-8.23a8.18 8.18 0 015.82 2.41 8.17 8.17 0 012.41 5.83c0 4.54-3.7 8.21-8.24 8.21z" />
                                            </svg>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif

            <p class="mt-8 border-l-2 border-netware-teal pl-4 text-xs leading-relaxed text-slate-500 dark:text-slate-400">
                {{ __('products.barang.note') }}
            </p>
        </section>
    </div>
@endsection

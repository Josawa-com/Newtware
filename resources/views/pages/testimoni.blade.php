@extends('layouts.app')

@section('title', __('testimoni.title'))

@section('description', __('testimoni.hero.lead'))

@php
    // Service names, keyed by slug, so each card caption follows the active locale.
    $serviceNames = collect(config('netware.services'))
        ->mapWithKeys(fn (array $service): array => [
            \Illuminate\Support\Str::slug($service['name']['id']) => $service['name'][app()->getLocale()] ?? $service['name']['id'],
        ]);

    $cards = config('testimonials.cards');
    $distribution = collect(range(5, 1))->mapWithKeys(
        fn (int $stars): array => [$stars => $ratings->where('stars', $stars)->count()],
    );
@endphp

@section('content')
    {{-- Hero --}}
    <section class="relative overflow-hidden border-b-2 border-slate-300 bg-slate-50 dark:border-slate-700 dark:bg-slate-950">
        @include('partials.hero-backdrop')

        <div class="relative mx-auto max-w-7xl px-5 py-10 sm:px-6 sm:py-12 lg:px-8 lg:py-14">
            <div class="max-w-3xl" data-reveal>
                <nav class="flex items-center gap-2 text-xs text-slate-400" aria-label="{{ __('site.labels.breadcrumb') }}">
                    <a href="{{ route('beranda') }}" class="transition-colors hover:text-netware-teal">{{ __('site.nav.home') }}</a>
                    <span aria-hidden="true">/</span>
                    <span class="text-slate-600 dark:text-slate-300">{{ __('testimoni.title') }}</span>
                </nav>

                <div class="mt-6 flex items-center gap-3">
                    <span class="h-px w-8 bg-netware-teal"></span>
                    <p class="text-xs font-semibold tracking-[0.2em] text-netware-teal uppercase">{{ __('testimoni.badge') }}</p>
                </div>

                <h1 class="mt-4 text-[2rem] leading-[1.1] font-semibold tracking-tight text-netware-navy sm:text-4xl lg:text-[2.7rem] dark:text-white">
                    {{ __('testimoni.hero.title_1') }}<br>
                    <span class="text-netware-teal">{{ __('testimoni.hero.title_2') }}</span>
                </h1>

                <p class="mt-5 max-w-xl text-sm leading-relaxed text-slate-600 sm:text-base dark:text-slate-400">
                    {{ __('testimoni.hero.lead') }}
                </p>
            </div>
        </div>
    </section>

    <div class="grid-motion bg-white dark:bg-slate-950">
        {{-- Rating: submit form on the left, live summary on the right. --}}
        <section class="mx-auto max-w-7xl px-5 py-10 sm:px-6 sm:py-12 lg:px-8 lg:py-14">
            <div class="flex flex-wrap items-baseline justify-between gap-3 border-b-2 border-slate-300 pb-4 dark:border-slate-700" data-reveal>
                <h2 class="text-sm font-semibold tracking-[0.16em] text-slate-500 uppercase dark:text-slate-400">
                    {{ __('testimoni.form.heading') }}
                </h2>
                <p class="text-sm tabular-nums text-slate-500 dark:text-slate-400">
                    {{ $total }} {{ __('testimoni.labels.reviews') }}
                </p>
            </div>

            <div class="mt-6 grid gap-[2px] border border-slate-300 bg-slate-300 lg:grid-cols-12 dark:border-slate-700 dark:bg-slate-800">
                {{-- Form --}}
                <div class="bg-white p-5 sm:p-6 lg:col-span-7 dark:bg-slate-950">
                    @if ($hasRated)
                        <div class="flex items-start gap-3 border border-emerald-500/40 bg-emerald-500/10 px-4 py-3">
                            <svg class="mt-0.5 h-4 w-4 shrink-0 text-emerald-600 dark:text-emerald-400" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                            </svg>
                            <div>
                                <p class="text-sm font-semibold text-emerald-700 dark:text-emerald-400">{{ __('testimoni.rated.heading') }}</p>
                                <p class="mt-1 text-xs leading-relaxed text-emerald-700/80 dark:text-emerald-400/80">{{ __('testimoni.rated.lead') }}</p>
                            </div>
                        </div>
                    @else
                        <form
                            action="{{ route('testimoni.store') }}"
                            method="POST"
                            class="space-y-5"
                            data-rating-form
                        >
                            @csrf

                            <p class="text-xs leading-relaxed text-slate-500 dark:text-slate-400">{{ __('testimoni.form.lead') }}</p>

                            {{-- Stars: the nth star sets the value to n. --}}
                            <fieldset data-star-field>
                                <legend class="text-xs font-semibold tracking-[0.14em] text-slate-500 uppercase dark:text-slate-400">
                                    {{ __('testimoni.form.your_rating') }}
                                </legend>

                                <div class="mt-2 flex items-center gap-1.5" data-star-group role="radiogroup" aria-label="{{ __('testimoni.form.your_rating') }}">
                                    @for ($star = 1; $star <= 5; $star++)
                                        <label class="group cursor-pointer" title="{{ __('testimoni.form.star_label_'.$star) }}">
                                            <input
                                                type="radio"
                                                name="stars"
                                                value="{{ $star }}"
                                                class="peer sr-only"
                                                data-star-input
                                                @checked(old('stars') == $star)
                                                required
                                            >
                                            <span class="block text-slate-300 transition-colors duration-150 group-hover:text-netware-amber peer-checked:text-netware-amber peer-focus-visible:outline peer-focus-visible:outline-2 peer-focus-visible:outline-offset-2 peer-focus-visible:outline-netware-teal dark:text-slate-700">
                                                <svg class="h-8 w-8" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                                    <path d="m12 3.6 2.6 5.4 5.9.8-4.3 4.1 1.1 5.9-5.3-2.9-5.3 2.9 1.1-5.9L3.5 9.8l5.9-.8z" />
                                                </svg>
                                            </span>
                                            <span class="sr-only">{{ __('testimoni.form.star_label_'.$star) }}</span>
                                        </label>
                                    @endfor
                                </div>

                                @error('stars')
                                    <p class="mt-2 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>
                                @enderror
                            </fieldset>

                            <div>
                                <label for="rating-name" class="text-xs font-semibold tracking-[0.14em] text-slate-500 uppercase dark:text-slate-400">
                                    {{ __('testimoni.form.name') }}
                                </label>
                                <input
                                    id="rating-name"
                                    name="author"
                                    type="text"
                                    maxlength="60"
                                    value="{{ old('author') }}"
                                    placeholder="{{ __('testimoni.form.name_placeholder') }}"
                                    class="mt-1.5 w-full border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition-colors duration-200 focus:border-netware-teal dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200"
                                >
                                @error('author')
                                    <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="rating-body" class="text-xs font-semibold tracking-[0.14em] text-slate-500 uppercase dark:text-slate-400">
                                    {{ __('testimoni.form.review') }}
                                </label>
                                <textarea
                                    id="rating-body"
                                    name="body"
                                    rows="4"
                                    maxlength="1000"
                                    required
                                    placeholder="{{ __('testimoni.form.review_placeholder') }}"
                                    class="mt-1.5 w-full resize-y border border-slate-300 bg-white px-3 py-2.5 text-sm leading-relaxed text-slate-700 outline-none transition-colors duration-200 focus:border-netware-teal dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200"
                                >{{ old('body') }}</textarea>
                                @error('body')
                                    <p class="mt-1.5 text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>
                                @enderror
                            </div>

                            @error('rating')
                                <p class="text-xs font-medium text-rose-600 dark:text-rose-400">{{ $message }}</p>
                            @enderror

                            <button
                                type="submit"
                                class="inline-flex items-center gap-2 bg-netware-navy px-5 py-2.5 text-sm font-medium text-white transition-colors duration-200 hover:bg-netware-blue disabled:opacity-60"
                                data-submit
                            >
                                {{ __('testimoni.form.submit') }}
                            </button>
                        </form>
                    @endif

                    @if (session('rating_status'))
                        <p class="mt-4 border-l-2 border-emerald-500 pl-3 text-sm font-medium text-emerald-700 dark:text-emerald-400">
                            {{ session('rating_status') }}
                        </p>
                    @endif
                </div>

                {{-- Summary + latest reviews --}}
                <div class="bg-white p-5 sm:p-6 lg:col-span-5 dark:bg-slate-950">
                    <div class="flex items-end gap-4">
                        <p class="text-4xl leading-none font-semibold tabular-nums text-netware-navy dark:text-white">{{ number_format($average, 1, ',', '.') }}</p>
                        <div class="pb-1">
                            <div class="flex items-center gap-0.5" aria-hidden="true">
                                @for ($star = 1; $star <= 5; $star++)
                                    <svg @class(['h-3.5 w-3.5', 'text-netware-amber' => $star <= round($average), 'text-slate-300 dark:text-slate-700' => $star > round($average)]) viewBox="0 0 24 24" fill="currentColor">
                                        <path d="m12 3.6 2.6 5.4 5.9.8-4.3 4.1 1.1 5.9-5.3-2.9-5.3 2.9 1.1-5.9L3.5 9.8l5.9-.8z" />
                                    </svg>
                                @endfor
                            </div>
                            <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">{{ $total }} {{ __('testimoni.labels.reviews') }}</p>
                        </div>
                    </div>

                    {{-- Distribution bars --}}
                    <dl class="mt-5 space-y-1.5">
                        @foreach ($distribution as $stars => $count)
                            <div class="flex items-center gap-3">
                                <dt class="w-8 shrink-0 text-[11px] tabular-nums text-slate-400">{{ $stars }}★</dt>
                                <dd class="flex-1">
                                    <div class="h-1.5 w-full bg-slate-200 dark:bg-slate-800">
                                        <div @class(['h-full bg-netware-teal']) style="width: {{ $total > 0 ? ($count / $total) * 100 : 0 }}%"></div>
                                    </div>
                                </dd>
                                <dd class="w-6 shrink-0 text-right text-[11px] tabular-nums text-slate-400">{{ $count }}</dd>
                            </div>
                        @endforeach
                    </dl>

                    {{-- Latest reviews --}}
                    <div class="mt-6 border-t border-slate-300 pt-4 dark:border-slate-700">
                        <p class="text-[10px] font-semibold tracking-[0.18em] text-slate-500 uppercase dark:text-slate-400">
                            {{ __('testimoni.labels.your_review') }}
                        </p>

                        @if ($ratings->isEmpty())
                            <p class="mt-3 text-sm text-slate-500 dark:text-slate-400">{{ __('testimoni.labels.empty') }}</p>
                            <p class="mt-1 text-xs text-slate-400">{{ __('testimoni.labels.empty_hint') }}</p>
                        @else
                            <ul class="mt-3 max-h-72 space-y-3 overflow-y-auto pr-1 [scrollbar-width:thin]">
                                @foreach ($ratings as $rating)
                                    <li class="border-l-2 border-slate-300 pl-3 dark:border-slate-700">
                                        <div class="flex items-center justify-between gap-3">
                                            <p class="text-sm font-semibold text-netware-navy dark:text-white">
                                                {{ $rating->author ?: __('testimoni.labels.reviews') }}
                                            </p>
                                            <p class="shrink-0 text-[11px] tabular-nums text-netware-amber">
                                                {{ str_repeat('★', $rating->stars) }}<span class="text-slate-300 dark:text-slate-700">{{ str_repeat('★', 5 - $rating->stars) }}</span>
                                            </p>
                                        </div>
                                        <p class="mt-1 text-xs leading-relaxed text-slate-500 dark:text-slate-400">{{ $rating->body }}</p>
                                        <p class="mt-1 text-[10px] tracking-wide text-slate-400 uppercase">{{ $rating->created_at?->translatedFormat('d M Y') }}</p>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>

    {{-- Scroll-driven folder reveal, outside the clipped rating background so sticky can pin. --}}
    <section
        class="testi-stage border-t-2 border-slate-300 dark:border-slate-700"
        data-testi-stage
        data-card-count="{{ count($cards) }}"
        aria-label="{{ __('testimoni.gallery.heading') }}"
    >
            <div class="testi-stage__pin">
                <div class="testi-stage__head">
                    <div class="flex items-center gap-3">
                        <span class="h-px w-8 bg-netware-teal"></span>
                        <h2 class="text-xs font-semibold tracking-[0.2em] text-netware-teal uppercase">{{ __('testimoni.gallery.heading') }}</h2>
                    </div>
                    <p class="mt-2 max-w-md text-xs leading-relaxed text-slate-500 dark:text-slate-400">{{ __('testimoni.gallery.lead') }}</p>
                </div>

                <div class="testi-fan" data-testi-fan>
                    @php
                        $mid = intdiv(count($cards), 2);
                        $maxZ = count($cards);
                    @endphp
                    @foreach ($cards as $index => $card)
                        <figure
                            class="testi-card"
                            data-testi-card
                            data-index="{{ $index }}"
                            style="--z: {{ $maxZ - (int) abs($index - $mid) }};"
                        >
                            <figcaption class="testi-card__caption">
                                <span class="block text-center text-sm leading-snug font-semibold text-netware-navy sm:text-base dark:text-white">
                                    {{ $serviceNames[$card['service']] ?? '' }}
                                </span>
                            </figcaption>
                            <img
                                src="{{ asset('Testimoni/'.$card['image']) }}"
                                alt="{{ $serviceNames[$card['service']] ?? '' }}"
                                loading="lazy"
                                class="testi-card__image w-full object-cover"
                            >
                        </figure>
                    @endforeach

                    <img
                        src="{{ asset('Folder.png') }}"
                        alt=""
                        class="testi-folder"
                        data-folder-cover
                        aria-hidden="true"
                    >

                </div>
            </div>
    </section>
@endsection

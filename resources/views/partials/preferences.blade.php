@php
    $locale = app()->getLocale();
@endphp

<div class="flex items-center gap-2">
    {{-- Language switch: a chip on a circuit board. --}}
    <form action="{{ route('locale.switch') }}" method="POST" class="relative" data-locale-form>
        @csrf
        <input type="hidden" name="locale" value="{{ $locale === 'id' ? 'en' : 'id' }}">

        <button
            type="submit"
            data-locale-submit
            class="group relative flex items-center gap-1.5 rounded-md border border-slate-300/80 bg-slate-50 p-1 font-mono text-[10px] font-semibold tracking-wider uppercase shadow-[inset_0_1px_0_rgba(255,255,255,0.9)] transition-colors duration-200 hover:border-netware-teal/60 dark:border-slate-600 dark:bg-slate-800 dark:shadow-none"
            aria-label="{{ __('site.actions.switch_language') }}"
            title="{{ __('site.actions.switch_language') }}"
        >
            {{-- Chip pins --}}
            <span class="pointer-events-none absolute inset-y-1.5 -left-[3px] flex flex-col justify-between" aria-hidden="true">
                @for ($pin = 0; $pin < 3; $pin++)
                    <span class="h-px w-1 bg-slate-400 dark:bg-slate-500"></span>
                @endfor
            </span>
            <span class="pointer-events-none absolute inset-y-1.5 -right-[3px] flex flex-col justify-between" aria-hidden="true">
                @for ($pin = 0; $pin < 3; $pin++)
                    <span class="h-px w-1 bg-slate-400 dark:bg-slate-500"></span>
                @endfor
            </span>

            <span
                @class([
                    'rounded px-1.5 py-1 transition-colors duration-200',
                    'bg-netware-teal text-white shadow-[0_0_8px_rgba(22,125,148,0.6)]' => $locale === 'id',
                    'text-slate-500 dark:text-slate-400' => $locale !== 'id',
                ])
            >
                IDN
            </span>
            <span
                @class([
                    'rounded px-1.5 py-1 transition-colors duration-200',
                    'bg-netware-blue text-white shadow-[0_0_8px_rgba(38,101,148,0.6)]' => $locale === 'en',
                    'text-slate-500 dark:text-slate-400' => $locale !== 'en',
                ])
            >
                ENG
            </span>
        </button>
    </form>

    {{-- Theme switch: a yin-yang dial that turns when toggled. --}}
    <button
        type="button"
        class="group relative flex h-9 w-9 items-center justify-center rounded-full border border-slate-300/80 bg-slate-50 transition-colors duration-200 hover:border-netware-teal/60 dark:border-slate-600 dark:bg-slate-800"
        data-theme-toggle
        aria-label="{{ __('site.actions.switch_theme') }}"
        title="{{ __('site.actions.switch_theme') }}"
        aria-pressed="false"
    >
        <svg
            class="h-5 w-5 rotate-0 transition-transform duration-500 ease-[cubic-bezier(0.22,1,0.36,1)] dark:rotate-180"
            viewBox="0 0 24 24"
            aria-hidden="true"
        >
            <circle cx="12" cy="12" r="10" class="fill-slate-800 dark:fill-slate-100" />
            <path d="M12 2a5 5 0 0 0 0 10 5 5 0 0 1 0 10 10 10 0 0 1 0-20z" class="fill-slate-100 dark:fill-slate-800" />
            <circle cx="12" cy="7" r="1.6" class="fill-slate-100 dark:fill-slate-800" />
            <circle cx="12" cy="17" r="1.6" class="fill-slate-800 dark:fill-slate-100" />
        </svg>
    </button>
</div>

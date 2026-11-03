@extends('layouts.app')

@section('title', 'Layanan')

@section('description', 'Jasa instalasi dan perbaikan perangkat dari Netware: OS Windows, keyboard, laptop, HP Android, iPhone, dan PC.')

@section('content')
    <section class="pt-6">
        <div class="flex items-center gap-4">
            <span class="h-px w-10 bg-netware-teal"></span>
            <p class="text-xs font-semibold tracking-[0.2em] text-netware-teal uppercase">Layanan</p>
        </div>

        <div class="mt-7 grid gap-10 lg:grid-cols-12 lg:gap-16">
            <h1 class="text-4xl leading-[1.1] font-semibold tracking-tight text-netware-navy sm:text-5xl lg:col-span-7">
                Jasa instalasi dan<br>
                <span class="text-netware-blue">perbaikan perangkat</span>
            </h1>

            <p class="text-lg leading-relaxed text-slate-600 lg:col-span-5 lg:pt-2">
                Mulai dari pemasangan sistem operasi hingga perbaikan perangkat, dikerjakan oleh siswa Teknik Komputer
                dan Jaringan.
            </p>
        </div>

        <ol class="mt-14 grid gap-px border-y border-slate-200 bg-slate-200 sm:grid-cols-2 lg:grid-cols-3">
            @foreach (config('netware.services') as $service)
                <li class="group bg-white p-6 transition-colors duration-200 hover:bg-slate-50">
                    <div class="flex items-start justify-between gap-4">
                        <span class="text-xs font-semibold tracking-[0.18em] text-netware-teal">
                            {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                        </span>
                        <svg class="h-4 w-4 text-slate-300 transition-colors duration-200 group-hover:text-netware-teal" fill="none" viewBox="0 0 24 24" stroke-width="1.6" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 19.5l15-15m0 0H8.25m11.25 0v11.25" />
                        </svg>
                    </div>

                    <h2 class="mt-6 text-base font-semibold text-netware-navy">{{ $service['name'] }}</h2>
                    <p class="mt-2 text-sm leading-relaxed text-slate-600">{{ $service['description'] }}</p>
                </li>
            @endforeach
        </ol>

        <div class="mt-16 grid gap-12 lg:grid-cols-12 lg:gap-16">
            <div class="lg:col-span-7">
                <h2 class="text-xs font-semibold tracking-[0.2em] text-netware-teal uppercase">Alur layanan</h2>

                <ol class="mt-6 space-y-0">
                    @foreach ([
                        ['Hubungi WhatsApp', 'Sampaikan masalah atau kebutuhan perangkat melalui WhatsApp untuk konsultasi awal.'],
                        ['Datang ke lokasi', 'Perangkat dibawa langsung ke Netware di lingkungan SMK Negeri 1 Bantul.'],
                        ['Pemeriksaan perangkat', 'Kondisi perangkat diperiksa langsung sebelum pekerjaan disepakati.'],
                    ] as [$title, $description])
                        <li class="flex gap-5 border-t border-slate-200 py-5 last:border-b">
                            <span class="mt-0.5 text-xs font-semibold tracking-[0.18em] text-slate-400">
                                {{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}
                            </span>
                            <div>
                                <h3 class="text-base font-semibold text-netware-navy">{{ $title }}</h3>
                                <p class="mt-1 text-sm leading-relaxed text-slate-600">{{ $description }}</p>
                            </div>
                        </li>
                    @endforeach
                </ol>

                <p class="mt-6 border-l-2 border-slate-300 pl-4 text-sm leading-relaxed text-slate-500">
                    WhatsApp digunakan untuk konsultasi. Pemesanan jasa dikonfirmasi setelah perangkat diperiksa di
                    lokasi.
                </p>
            </div>

            <aside class="lg:col-span-5">
                <div class="border border-slate-200 p-6">
                    <h2 class="text-xs font-semibold tracking-[0.2em] text-netware-teal uppercase">Jam operasional</h2>

                    <dl class="mt-5 space-y-3">
                        <div class="flex items-baseline justify-between gap-4 border-b border-slate-100 pb-3">
                            <dt class="text-sm text-slate-500">Buka</dt>
                            <dd class="text-sm font-medium text-netware-navy">{{ config('netware.hours.open') }} {{ config('netware.hours.timezone') }}</dd>
                        </div>
                        <div class="flex items-baseline justify-between gap-4">
                            <dt class="text-sm text-slate-500">Tutup</dt>
                            <dd class="text-sm font-medium text-netware-navy">{{ config('netware.hours.close') }} {{ config('netware.hours.timezone') }}</dd>
                        </div>
                    </dl>

                    <p class="mt-5 text-sm leading-relaxed text-slate-500">
                        {{ config('netware.hours.note') }}
                    </p>
                </div>
            </aside>
        </div>

        <div class="mt-16 bg-netware-navy px-6 py-10 sm:px-10">
            <div class="flex flex-col gap-8 lg:flex-row lg:items-center lg:justify-between">
                <div class="max-w-xl">
                    <h2 class="text-2xl leading-snug font-semibold text-white">
                        Ada perangkat yang perlu diperiksa?
                    </h2>
                    <p class="mt-3 text-sm leading-relaxed text-white/70">
                        Konsultasikan dulu melalui WhatsApp. Tim kami akan membantu menentukan langkah penanganannya.
                    </p>
                </div>

                <div class="flex flex-wrap items-center gap-3">
                    <a
                        href="https://wa.me/{{ config('netware.whatsapp') }}?text={{ rawurlencode('Halo Netware, saya ingin berkonsultasi mengenai perangkat saya.') }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex items-center gap-2 bg-white px-5 py-3 text-sm font-medium text-netware-navy transition-colors duration-200 hover:bg-white/85"
                    >
                        Konsultasi via WhatsApp
                    </a>

                    <a
                        href="https://instagram.com/{{ config('netware.instagram') }}"
                        target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex items-center gap-2 border border-white/25 px-5 py-3 text-sm font-medium text-white transition-colors duration-200 hover:border-white/50"
                    >
                        Instagram
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

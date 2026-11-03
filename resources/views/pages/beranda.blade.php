@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <section class="pt-6">
        <div class="flex items-center gap-4">
            <span class="h-px w-10 bg-netware-teal"></span>
            <p class="text-xs font-semibold tracking-[0.2em] text-netware-teal uppercase">Profile</p>
        </div>

        <div class="mt-7 grid gap-10 lg:grid-cols-12 lg:gap-16">
            <h1 class="text-4xl leading-[1.1] font-semibold tracking-tight text-netware-navy sm:text-5xl lg:col-span-7">
                Unit Produksi TKJ<br>
                <span class="text-netware-blue">SMK Negeri 1 Bantul</span>
            </h1>

            <p class="text-lg leading-relaxed text-slate-600 lg:col-span-5 lg:pt-2">
                Layanan teknologi warga sekolah yang dikerjakan oleh siswa Teknik Komputer dan Jaringan: instalasi
                sistem operasi hingga perbaikan laptop, HP, dan PC.
            </p>
        </div>

        <div class="mt-16 grid gap-12 border-t border-slate-200 pt-12 lg:grid-cols-12 lg:gap-16">
            <div class="space-y-6 text-base leading-[1.8] text-slate-600 lg:col-span-7">
                <p>
                    Netware merupakan Unit Produksi (UP) di bawah naungan SMK Negeri 1 Bantul Yogyakarta. Dengan
                    pengalaman lebih dari 5 tahun melayani pelanggan di sektor sekolah, baik layanan kepada siswa, guru,
                    karyawan maupun tamu yang berkunjung. Berawal dari lingkup jurusan Teknik Komputer dan Jaringan kini
                    Netware telah hadir dan semakin meluas menjangkau area sekolah SMK Negeri 1 Bantul.
                </p>
                <p>
                    Pelayanan terbaik dari sisi kualitas, memuaskan pelanggan dengan harga yang terjangkau merupakan
                    tujuan utama kami. Diwakili oleh sumber daya siswa TKJ yang ahli di bidangnya, kami mendedikasikan
                    diri untuk memberikan kualitas terbaik dari sisi pelayanan maupun perbaikan perangkat gawai
                    pelanggan.
                </p>
            </div>

            <aside class="lg:col-span-5">
                <div class="border-l-2 border-netware-teal pl-6">
                    <p class="text-lg leading-relaxed font-medium text-slate-800">
                        Pengalaman kami dalam teknologi informasi mendorong kami terus aktif dalam berinovasi memberikan
                        layanan penyedia paket internet dan service perangkat HP dan laptop pelanggan.
                    </p>
                </div>

                <dl class="mt-10 divide-y divide-slate-200 border-y border-slate-200">
                    <div class="flex items-baseline justify-between gap-6 py-4">
                        <dt class="text-sm text-slate-500">Pengalaman</dt>
                        <dd class="text-sm font-medium text-netware-navy">Lebih dari 5 tahun</dd>
                    </div>
                    <div class="flex items-baseline justify-between gap-6 py-4">
                        <dt class="text-sm text-slate-500">Dikelola oleh</dt>
                        <dd class="text-right text-sm font-medium text-netware-navy">Siswa TKJ</dd>
                    </div>
                    <div class="flex items-baseline justify-between gap-6 py-4">
                        <dt class="text-sm text-slate-500">Melayani</dt>
                        <dd class="text-right text-sm font-medium text-netware-navy">Siswa, guru, karyawan, tamu</dd>
                    </div>
                </dl>
            </aside>
        </div>

        <div class="mt-16 border-t border-slate-200 pt-8">
            <div class="flex flex-wrap items-end justify-between gap-4">
                <h2 class="text-xs font-semibold tracking-[0.2em] text-netware-teal uppercase">Layanan</h2>
                <a href="{{ route('layanan') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-netware-navy transition-colors duration-200 hover:text-netware-teal">
                    Lihat semua layanan
                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                    </svg>
                </a>
            </div>

            <ul class="mt-6 grid gap-px border border-slate-200 bg-slate-200 sm:grid-cols-2 lg:grid-cols-3">
                @foreach (array_slice(config('netware.services'), 0, 6) as $service)
                    <li class="bg-white p-5">
                        <h3 class="text-sm font-semibold text-netware-navy">{{ $service['name'] }}</h3>
                        <p class="mt-1.5 text-sm leading-relaxed text-slate-600">{{ $service['description'] }}</p>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
@endsection

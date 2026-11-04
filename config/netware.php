<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Contact
    |--------------------------------------------------------------------------
    |
    | Nomor WhatsApp Netware, dipakai untuk tautan wa.me (tanpa "+" dan spasi).
    | Nomornya sengaja tidak ditampilkan di halaman; pengunjung menekan tombol
    | WhatsApp yang tersedia untuk langsung membuka percakapan.
    |
    */

    'whatsapp' => env('NETWARE_WHATSAPP', '6285191249364'),

    'instagram' => env('NETWARE_INSTAGRAM', 'netware'),

    /*
    |--------------------------------------------------------------------------
    | Operational hours
    |--------------------------------------------------------------------------
    */

    'hours' => [
        'open' => '07.30',
        'close' => '15.00',
        'timezone' => 'WIB',
        'note' => [
            'id' => 'Pukul 14.30–15.00 biasanya digunakan untuk rekap, namun pelanggan masih dapat dilayani.',
            'en' => 'Between 14.30 and 15.00 we usually wrap up admin work, but customers can still be served.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Services
    |--------------------------------------------------------------------------
    |
    | Setiap layanan menyimpan nama dan deskripsi dalam dua bahasa. Ambil
    | dengan [$field][app()->getLocale()] agar halaman mengikuti bahasa aktif.
    |
    */

    'services' => [
        [
            'name' => ['id' => 'Instalasi OS Windows', 'en' => 'Windows installation'],
            'description' => [
                'id' => 'Pemasangan sistem operasi Windows pada perangkat pelanggan.',
                'en' => 'Installing the Windows operating system on a customer device.',
            ],
        ],
        [
            'name' => ['id' => 'Pemasangan keyboard', 'en' => 'Keyboard replacement'],
            'description' => [
                'id' => 'Penggantian atau pemasangan keyboard laptop.',
                'en' => 'Replacing or fitting a laptop keyboard.',
            ],
        ],
        [
            'name' => ['id' => 'Service laptop', 'en' => 'Laptop repair'],
            'description' => [
                'id' => 'Perbaikan perangkat laptop, mulai dari diagnosa hingga penanganan kerusakan.',
                'en' => 'Laptop repairs, from diagnosis through to fixing the fault.',
            ],
        ],
        [
            'name' => ['id' => 'Service HP Android', 'en' => 'Android phone repair'],
            'description' => [
                'id' => 'Perbaikan perangkat Android.',
                'en' => 'Repairs for Android devices.',
            ],
        ],
        [
            'name' => ['id' => 'Service iPhone', 'en' => 'iPhone repair'],
            'description' => [
                'id' => 'Perbaikan perangkat iPhone.',
                'en' => 'Repairs for iPhone devices.',
            ],
        ],
        [
            'name' => ['id' => 'Service PC', 'en' => 'PC repair'],
            'description' => [
                'id' => 'Penanganan disesuaikan dengan kebutuhan melalui konsultasi terlebih dahulu.',
                'en' => 'Handled to suit your needs, starting with a short consultation.',
            ],
        ],
    ],

];

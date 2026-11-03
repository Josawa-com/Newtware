<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Contact
    |--------------------------------------------------------------------------
    |
    | TODO: Ganti nomor WhatsApp dan akun Instagram di bawah dengan data
    | Netware yang sebenarnya. Nomor WhatsApp ditulis tanpa "+" dan spasi.
    |
    */

    'whatsapp' => env('NETWARE_WHATSAPP', '6280000000000'),

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
        'note' => 'Pukul 14.30–15.00 biasanya digunakan untuk rekap, namun pelanggan masih dapat dilayani.',
    ],

    /*
    |--------------------------------------------------------------------------
    | Services
    |--------------------------------------------------------------------------
    */

    'services' => [
        [
            'name' => 'Instalasi OS Windows',
            'description' => 'Pemasangan sistem operasi Windows pada perangkat pelanggan.',
        ],
        [
            'name' => 'Pemasangan keyboard',
            'description' => 'Penggantian atau pemasangan keyboard laptop.',
        ],
        [
            'name' => 'Service laptop',
            'description' => 'Perbaikan perangkat laptop, mulai dari diagnosa hingga penanganan kerusakan.',
        ],
        [
            'name' => 'Service HP Android',
            'description' => 'Perbaikan perangkat Android.',
        ],
        [
            'name' => 'Service iPhone',
            'description' => 'Perbaikan perangkat iPhone.',
        ],
        [
            'name' => 'Service PC',
            'description' => 'Penanganan disesuaikan dengan kebutuhan melalui konsultasi terlebih dahulu.',
        ],
    ],

];

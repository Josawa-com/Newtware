<?php

/*
|--------------------------------------------------------------------------
| Kartu testimoni
|--------------------------------------------------------------------------
|
| Foto-foto hasil pengerjaan untuk animasi di halaman Testimoni. Urutan di sini
| adalah urutan tampil dari kiri ke kanan pada kipas kartu, dan juga urutan
| kartu yang ditarik saat halaman di-scroll.
|
| `service` menunjuk slug layanan di config/netware.php, sehingga keterangan
| yang muncul di bawah kartu otomatis mengikuti bahasa aktif.
|
*/

return [

    'cards' => [
        ['image' => 'ServiceLaptop1.jpeg', 'service' => 'service-laptop'],
        ['image' => 'ServiceHP.jpeg', 'service' => 'service-hp-android'],
        ['image' => 'ServiceLaptop2.jpeg', 'service' => 'service-laptop'],
        ['image' => 'ServiceIphone.jpeg', 'service' => 'service-iphone'],
        ['image' => 'ServiceLaptop3.jpeg', 'service' => 'service-laptop'],
    ],

];

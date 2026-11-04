<?php

/*
|--------------------------------------------------------------------------
| Detail layanan
|--------------------------------------------------------------------------
|
| Teks panjang untuk halaman detail setiap layanan. Kuncinya adalah slug
| dari nama layanan Indonesia di config/netware.php, contoh:
| "Instalasi OS Windows" -> instalasi-os-windows.
|
| Struktur tiap layanan:
|   subtitle   - tagline di bawah judul
|   intro      - array paragraf pembuka
|   scope      - array dua kolom [judul, isi] untuk "Cakupan Layanan"
|   process    - array paragraf tahapan pengerjaan
|   process_title - judul bagian tahapan
|   commitment_title - judul bagian komitmen
|   commitment - array paragraf komitmen
|   tagline    - kalimat penutup berbrand
|
*/

return [

    'instalasi-os-windows' => [
        'subtitle' => 'Menghadirkan Kembali Performa dan Kenyamanan Komputer Anda',
        'intro' => [
            'Sistem operasi merupakan bagian fundamental yang menghubungkan perangkat keras dengan seluruh aktivitas komputasi. Ketika sistem mulai mengalami penurunan performa, sering mengalami gangguan, gagal melakukan proses booting, atau tidak lagi berjalan sebagaimana mestinya, instalasi ulang sistem operasi dapat menjadi salah satu langkah pemulihan yang diperlukan.',
            'Netware menyediakan layanan instalasi sistem operasi Windows untuk membantu mengembalikan lingkungan kerja komputer agar dapat digunakan secara optimal. Pengerjaan dilakukan melalui tahapan pemeriksaan, persiapan media instalasi, pemasangan sistem operasi, hingga konfigurasi awal sesuai dengan kebutuhan perangkat.',
            'Kami memahami bahwa setiap perangkat memiliki spesifikasi dan kebutuhan penggunaan yang berbeda. Oleh karena itu, proses instalasi tidak hanya berfokus pada pemasangan Windows, tetapi juga memperhatikan kompatibilitas perangkat keras, ketersediaan driver, serta kestabilan sistem setelah instalasi selesai.',
        ],
        'scope' => [
            ['Instalasi Windows', 'Pemasangan sistem operasi Windows sesuai dengan spesifikasi dan kompatibilitas perangkat.'],
            ['Instalasi Ulang', 'Pembaruan lingkungan sistem melalui instalasi ulang ketika sistem mengalami kerusakan, gangguan, atau penurunan kinerja.'],
            ['Konfigurasi Driver', 'Pemasangan dan penyesuaian driver agar perangkat keras seperti audio, grafis, jaringan, dan perangkat pendukung lainnya dapat berfungsi dengan baik.'],
            ['Konfigurasi Sistem', 'Pengaturan awal Windows, termasuk preferensi dasar, pengaturan perangkat, dan konfigurasi sistem sesuai kebutuhan pengguna.'],
            ['Instalasi Aplikasi Dasar', 'Pemasangan aplikasi pendukung sesuai kebutuhan dan ketersediaan lisensi.'],
            ['Pemeriksaan Pasca-Instalasi', 'Pemeriksaan fungsi sistem untuk memastikan proses instalasi berjalan dengan baik.'],
        ],
        'process_title' => 'Tahapan Pengerjaan',
        'process' => [
            'Setiap perangkat terlebih dahulu melalui pemeriksaan awal untuk mengetahui kondisi sistem dan kebutuhan instalasi. Setelah itu, dilakukan persiapan media instalasi serta pemeriksaan kompatibilitas perangkat.',
            'Proses pemasangan dilanjutkan dengan konfigurasi sistem operasi, pemasangan driver, dan pengaturan aplikasi pendukung. Setelah seluruh tahapan selesai, perangkat akan diperiksa kembali untuk memastikan fungsi dasar sistem dapat berjalan sebagaimana mestinya.',
        ],
        'commitment_title' => 'Komitmen Netware',
        'commitment' => [
            'Netware mengutamakan ketelitian dalam setiap proses pengerjaan. Kami memperhatikan kondisi perangkat, kebutuhan pengguna, serta keamanan data sebelum melakukan instalasi. Pengguna juga disarankan melakukan pencadangan data penting terlebih dahulu, terutama apabila proses instalasi memerlukan pemformatan penyimpanan.',
        ],
        'tagline' => 'Netware — Restoring Systems, Renewing Performance.',
    ],

    'pemasangan-keyboard' => [
        'subtitle' => 'Mengembalikan Kenyamanan dalam Setiap Ketikan',
        'intro' => [
            'Keyboard merupakan salah satu komponen utama yang berperan penting dalam interaksi antara pengguna dan perangkat laptop. Hampir seluruh aktivitas, mulai dari mengetik dokumen, mengerjakan tugas, mengoperasikan aplikasi, hingga menjalankan berbagai pekerjaan digital, bergantung pada fungsi keyboard yang optimal.',
            'Kerusakan pada keyboard dapat mengganggu produktivitas dan kenyamanan penggunaan. Beberapa permasalahan yang umum terjadi meliputi tombol yang tidak merespons, karakter yang muncul secara berulang, tombol yang terasa macet, kerusakan akibat cairan, hingga bagian keyboard yang mengalami kerusakan fisik.',
            'Netware menyediakan layanan pemeriksaan, pemasangan, dan penggantian keyboard laptop untuk membantu mengatasi berbagai permasalahan tersebut. Setiap penanganan diawali dengan identifikasi kondisi komponen guna mengetahui sumber gangguan serta menentukan tindakan yang paling sesuai.',
            'Kami memahami bahwa keyboard laptop memiliki beragam bentuk, mekanisme, dan konfigurasi yang berbeda pada setiap model perangkat. Oleh sebab itu, pemilihan komponen pengganti perlu memperhatikan kesesuaian model laptop, tata letak tombol, konektor, serta spesifikasi komponen yang digunakan.',
        ],
        'scope' => [
            ['Pemeriksaan Keyboard', 'Identifikasi tombol yang tidak berfungsi, kerusakan fisik, dan gangguan respons pada keyboard.'],
            ['Penggantian Keyboard', 'Pelepasan komponen lama dan pemasangan keyboard pengganti yang sesuai dengan model perangkat.'],
            ['Penanganan Tombol Bermasalah', 'Pemeriksaan tombol yang macet, tidak responsif, atau menghasilkan input secara berulang.'],
            ['Pemeriksaan Konektor', 'Pengecekan kabel fleksibel dan koneksi keyboard terhadap motherboard.'],
            ['Pengujian Fungsi', 'Pemeriksaan seluruh tombol setelah proses pemasangan untuk memastikan input dapat diterima dengan baik.'],
            ['Pemeriksaan Kerusakan Akibat Cairan', 'Identifikasi kemungkinan gangguan pada keyboard maupun area konektornya.'],
        ],
        'process_title' => 'Tahapan Pengerjaan',
        'process' => [
            'Proses dimulai dengan pemeriksaan kondisi keyboard dan identifikasi jenis kerusakan. Apabila ditemukan indikasi kerusakan pada komponen, teknisi akan melakukan evaluasi untuk menentukan apakah diperlukan perbaikan atau penggantian.',
            'Setelah kesesuaian komponen dipastikan, proses pemasangan dilakukan dengan memperhatikan konstruksi perangkat dan konektor yang digunakan. Tahap akhir meliputi pengujian fungsi tombol, pemeriksaan respons input, serta pengecekan kondisi fisik setelah pemasangan.',
        ],
        'commitment_title' => 'Komitmen Netware',
        'commitment' => [
            'Kami mengutamakan ketepatan pemilihan komponen dan ketelitian dalam proses pemasangan. Setiap laptop memiliki karakteristik konstruksi tersendiri, sehingga penanganan dilakukan dengan mempertimbangkan model dan kondisi perangkat.',
            'Tujuan kami adalah membantu mengembalikan kenyamanan penggunaan laptop melalui penanganan yang terukur, transparan, dan sesuai kebutuhan.',
        ],
        'tagline' => 'Netware — Precision in Every Detail.',
    ],

    'service-laptop' => [
        'subtitle' => 'Solusi Penanganan Perangkat untuk Kembali Mendukung Produktivitas',
        'intro' => [
            'Laptop telah menjadi perangkat penting dalam berbagai aktivitas, baik untuk kebutuhan pendidikan, pekerjaan, komunikasi, maupun pengembangan kreativitas. Ketika laptop mengalami gangguan, aktivitas tersebut dapat terhambat dan membutuhkan penanganan yang tepat agar perangkat dapat kembali digunakan.',
            'Netware menghadirkan layanan pemeriksaan dan perbaikan laptop dengan pendekatan yang mengutamakan identifikasi masalah sebelum menentukan tindakan perbaikan. Kami memahami bahwa kerusakan pada laptop tidak selalu berasal dari satu komponen. Gangguan dapat berkaitan dengan perangkat keras, sistem operasi, penyimpanan, sistem pendingin, maupun konfigurasi perangkat lunak.',
            'Melalui pemeriksaan secara bertahap, kami berupaya membantu mengidentifikasi sumber permasalahan dan memberikan rekomendasi penanganan berdasarkan kondisi aktual perangkat. Setiap tindakan dilakukan dengan mempertimbangkan spesifikasi, usia penggunaan, serta kebutuhan pemilik perangkat.',
        ],
        'scope' => [
            ['Pemeriksaan Perangkat', 'Identifikasi gangguan pada komponen perangkat keras dan perangkat lunak.'],
            ['Perbaikan Sistem Operasi', 'Penanganan sistem yang mengalami error, gagal booting, crash, atau gangguan operasional lainnya.'],
            ['Pembersihan Internal', 'Pembersihan debu pada bagian dalam perangkat untuk membantu menjaga sirkulasi udara dan sistem pendinginan.'],
            ['Pemeriksaan Sistem Pendingin', 'Pemeriksaan kipas, ventilasi, dan kondisi termal perangkat ketika mengalami panas berlebih.'],
            ['Penggantian Komponen', 'Pemeriksaan dan penggantian komponen tertentu seperti RAM, SSD, keyboard, dan komponen lain sesuai kompatibilitas.'],
            ['Penanganan Gangguan Performa', 'Pemeriksaan penyebab laptop berjalan lambat, sering mengalami lag, atau tidak responsif.'],
            ['Pemeriksaan Kelistrikan', 'Identifikasi gangguan pada konektor daya, adaptor, dan komponen terkait apabila perangkat mengalami masalah pengisian daya.'],
            ['Pemeriksaan Konektivitas', 'Penanganan gangguan Wi-Fi, Bluetooth, dan perangkat jaringan lainnya.'],
        ],
        'process_title' => 'Proses Pemeriksaan dan Perbaikan',
        'process' => [
            'Setiap perangkat yang diterima akan melalui proses identifikasi awal untuk mengetahui keluhan dan kondisi fisiknya. Selanjutnya, dilakukan pemeriksaan untuk mempersempit kemungkinan sumber kerusakan.',
            'Setelah penyebab gangguan diketahui, pengguna akan mendapatkan penjelasan mengenai kondisi perangkat dan rekomendasi tindakan yang dapat dilakukan. Apabila diperlukan penggantian komponen, kesesuaian komponen dan ketersediaannya akan diperhatikan sebelum pengerjaan dilanjutkan.',
            'Setelah proses perbaikan selesai, perangkat akan menjalani pengujian untuk memeriksa fungsi yang berkaitan dengan permasalahan sebelumnya.',
        ],
        'commitment_title' => 'Mengapa Memilih Netware?',
        'commitment' => [
            'Netware mengedepankan proses pelayanan yang terstruktur, mulai dari penerimaan perangkat hingga pemeriksaan akhir. Kami percaya bahwa penanganan perangkat elektronik membutuhkan ketelitian, pemahaman teknis, dan komunikasi yang baik antara teknisi dengan pengguna.',
            'Kami tidak hanya berfokus pada gejala yang terlihat, tetapi juga berupaya memahami penyebab gangguan agar tindakan yang diberikan lebih tepat sasaran.',
        ],
        'tagline' => 'Netware — Reliable Solutions for Your Technology.',
    ],

    'service-hp-android' => [
        'subtitle' => 'Menjaga Perangkat Komunikasi Tetap Berfungsi dengan Optimal',
        'intro' => [
            'Smartphone telah berkembang menjadi bagian penting dalam kehidupan sehari-hari. Perangkat ini tidak hanya digunakan untuk berkomunikasi, tetapi juga menjadi sarana produktivitas, pembelajaran, dokumentasi, hiburan, hingga pengelolaan berbagai kebutuhan digital.',
            'Ketika smartphone mengalami gangguan, aktivitas pengguna dapat terganggu secara signifikan. Permasalahan seperti layar yang tidak merespons, baterai yang cepat habis, perangkat sering mengalami restart, gangguan pengisian daya, hingga sistem operasi yang mengalami error membutuhkan pemeriksaan dan penanganan yang sesuai.',
            'Netware menyediakan layanan pemeriksaan dan perbaikan perangkat Android dengan memperhatikan karakteristik perangkat, kondisi komponen, serta jenis gangguan yang dialami. Setiap perangkat memiliki konfigurasi perangkat keras dan perangkat lunak yang berbeda, sehingga proses penanganan perlu disesuaikan dengan model dan kondisi masing-masing smartphone.',
            'Kami mengutamakan pemeriksaan awal untuk membantu menentukan sumber permasalahan sebelum tindakan perbaikan dilakukan. Dengan demikian, penanganan dapat diarahkan berdasarkan kebutuhan aktual perangkat, bukan sekadar perkiraan terhadap gejala yang muncul.',
        ],
        'scope' => [
            ['Pemeriksaan Layar', 'Identifikasi gangguan pada layar, touchscreen, tampilan, dan respons sentuhan.'],
            ['Penggantian Komponen Layar', 'Penanganan kerusakan layar melalui penggantian komponen yang sesuai dengan model perangkat.'],
            ['Pemeriksaan Baterai', 'Identifikasi kondisi baterai yang cepat habis, mengalami penurunan kapasitas, atau menunjukkan gejala kerusakan.'],
            ['Penanganan Charging', 'Pemeriksaan konektor pengisian daya, kabel fleksibel, dan kemungkinan gangguan pada jalur pengisian.'],
            ['Perbaikan Sistem Android', 'Penanganan gangguan sistem operasi, aplikasi yang sering berhenti, bootloop, dan masalah perangkat lunak lainnya.'],
            ['Pemeriksaan Kamera', 'Identifikasi gangguan pada kamera depan maupun belakang.'],
            ['Pemeriksaan Audio', 'Penanganan masalah speaker, mikrofon, dan komponen audio.'],
            ['Pemeriksaan Konektivitas', 'Identifikasi gangguan pada Wi-Fi, Bluetooth, jaringan seluler, dan koneksi lainnya.'],
        ],
        'process_title' => 'Tahapan Pelayanan',
        'process' => [
            'Proses pelayanan diawali dengan pencatatan keluhan dan pemeriksaan kondisi fisik perangkat. Selanjutnya, dilakukan identifikasi untuk mengetahui kemungkinan sumber gangguan, baik yang berasal dari perangkat keras maupun perangkat lunak.',
            'Berdasarkan hasil pemeriksaan, pengguna akan memperoleh penjelasan mengenai kondisi perangkat dan rekomendasi tindakan yang dapat dilakukan. Apabila diperlukan penggantian komponen, kesesuaian komponen terhadap model smartphone akan menjadi salah satu pertimbangan utama.',
            'Setelah pengerjaan selesai, dilakukan pengujian terhadap fungsi yang berkaitan dengan kerusakan untuk memastikan hasil penanganan sesuai dengan tujuan perbaikan.',
        ],
        'commitment_title' => 'Komitmen terhadap Perangkat dan Data Pengguna',
        'commitment' => [
            'Kami memahami bahwa smartphone menyimpan berbagai informasi pribadi dan dokumen penting. Oleh karena itu, penanganan perangkat memperhatikan privasi pengguna dan membatasi akses data hanya pada kebutuhan pemeriksaan atau perbaikan yang telah disetujui.',
            'Pengguna disarankan melakukan pencadangan data penting sebelum perangkat diserahkan, khususnya apabila penanganan membutuhkan tindakan terhadap sistem operasi atau penyimpanan internal.',
        ],
        'tagline' => 'Netware — Keeping Your Devices Connected.',
    ],

    'service-iphone' => [
        'subtitle' => 'Penanganan Perangkat Apple dengan Ketelitian dan Perhatian pada Detail',
        'intro' => [
            'iPhone merupakan perangkat yang dirancang dengan integrasi antara perangkat keras, sistem operasi, dan berbagai teknologi pendukung. Setiap komponen memiliki peran tersendiri dalam menghadirkan pengalaman penggunaan yang konsisten, mulai dari sistem layar, kamera, baterai, hingga konektivitas.',
            'Seiring waktu dan intensitas penggunaan, iPhone dapat mengalami berbagai permasalahan teknis. Kondisi seperti penurunan kapasitas baterai, layar yang mengalami kerusakan, gangguan pengisian daya, masalah audio, hingga gangguan pada sistem operasi membutuhkan pemeriksaan yang cermat.',
            'Netware menyediakan layanan pemeriksaan dan penanganan permasalahan iPhone dengan memperhatikan karakteristik perangkat dan kompatibilitas komponen. Kami memahami bahwa setiap generasi iPhone memiliki desain internal, konfigurasi perangkat keras, serta prosedur penanganan yang berbeda.',
            'Oleh karena itu, proses pelayanan diawali dengan identifikasi kondisi perangkat untuk mengetahui sumber gangguan dan menentukan tindakan yang sesuai. Kami mengutamakan transparansi dalam penyampaian hasil pemeriksaan agar pengguna dapat memahami kondisi perangkat sebelum menyetujui proses pengerjaan.',
        ],
        'scope' => [
            ['Pemeriksaan Layar', 'Identifikasi kerusakan pada panel layar, tampilan, dan fungsi sentuh.'],
            ['Penggantian Layar', 'Penanganan kerusakan layar melalui penggantian komponen yang sesuai dengan model iPhone.'],
            ['Pemeriksaan Baterai', 'Identifikasi penurunan kapasitas baterai, konsumsi daya tidak normal, dan permasalahan terkait pengisian daya.'],
            ['Penanganan Charging', 'Pemeriksaan konektor Lightning atau USB-C sesuai model perangkat serta kemungkinan gangguan pada sistem pengisian.'],
            ['Pemeriksaan Kamera', 'Identifikasi gangguan pada kamera depan, kamera belakang, dan fungsi pendukungnya.'],
            ['Pemeriksaan Audio', 'Penanganan permasalahan speaker, mikrofon, dan komponen audio lainnya.'],
            ['Pemeriksaan Sistem iOS', 'Identifikasi gangguan perangkat lunak, error sistem, dan kendala pembaruan iOS.'],
            ['Pemeriksaan Konektivitas', 'Identifikasi gangguan pada Wi-Fi, Bluetooth, jaringan seluler, dan fungsi komunikasi perangkat.'],
        ],
        'process_title' => 'Proses Penanganan',
        'process' => [
            'Setiap iPhone yang diterima akan melalui pemeriksaan awal berdasarkan keluhan pengguna dan kondisi fisik perangkat. Pemeriksaan dilakukan untuk mengetahui apakah permasalahan berkaitan dengan komponen perangkat keras, sistem operasi, atau faktor lainnya.',
            'Setelah identifikasi selesai, pengguna akan memperoleh informasi mengenai kemungkinan penyebab gangguan dan rekomendasi penanganan. Jika diperlukan penggantian komponen, kesesuaian komponen terhadap generasi dan model iPhone akan menjadi perhatian dalam proses pengerjaan.',
            'Tahap akhir dilakukan melalui pengujian fungsi yang berkaitan dengan permasalahan sebelumnya untuk memastikan hasil penanganan dapat dievaluasi dengan baik.',
        ],
        'commitment_title' => 'Privasi dan Ketelitian',
        'commitment' => [
            'Kami memahami bahwa iPhone sering digunakan untuk menyimpan dokumen, foto, percakapan, dan informasi pribadi. Oleh sebab itu, privasi pengguna menjadi bagian penting dalam proses pelayanan.',
            'Pemeriksaan dan perbaikan dilakukan dengan memperhatikan batas akses terhadap informasi pribadi. Pengguna juga disarankan melakukan pencadangan data sebelum perangkat diserahkan.',
        ],
        'tagline' => 'Netware — Precision Meets Technology.',
    ],

    'service-pc' => [
        'subtitle' => 'Membangun Kembali Stabilitas dan Kinerja Sistem Komputer',
        'intro' => [
            'Personal Computer (PC) merupakan perangkat komputasi yang memiliki peran penting dalam berbagai kebutuhan, mulai dari pekerjaan administratif, kegiatan pendidikan, pengolahan data, desain grafis, hingga kebutuhan komputasi dengan beban kerja tinggi.',
            'Sebagai sistem yang terdiri dari berbagai komponen perangkat keras dan perangkat lunak, PC membutuhkan konfigurasi yang tepat serta pemeliharaan secara berkala agar seluruh bagian dapat bekerja secara optimal.',
            'Permasalahan pada PC dapat muncul dalam berbagai bentuk, seperti perangkat gagal menyala, tidak menampilkan gambar, mengalami penurunan performa, suhu komponen yang terlalu tinggi, gangguan penyimpanan, hingga ketidakstabilan sistem operasi.',
            'Netware menyediakan layanan pemeriksaan, pemeliharaan, dan perbaikan PC dengan pendekatan yang berfokus pada identifikasi sumber masalah. Kami memperhatikan hubungan kerja antar-komponen, mulai dari motherboard, prosesor, RAM, media penyimpanan, power supply, kartu grafis, hingga sistem pendingin.',
            'Melalui pemeriksaan yang terstruktur, kami berupaya membantu pengguna memahami kondisi perangkat dan menentukan langkah penanganan yang sesuai dengan kebutuhan serta spesifikasi sistem.',
        ],
        'scope' => [
            ['Perakitan PC', 'Pemasangan dan konfigurasi komponen komputer berdasarkan kebutuhan penggunaan serta kompatibilitas perangkat.'],
            ['Pemeriksaan Hardware', 'Identifikasi gangguan pada motherboard, prosesor, RAM, GPU, power supply, dan komponen lainnya.'],
            ['Penggantian Komponen', 'Penanganan penggantian komponen yang mengalami kerusakan atau membutuhkan peningkatan spesifikasi.'],
            ['Upgrade Perangkat', 'Peningkatan kapasitas RAM, penggantian HDD ke SSD, dan penyesuaian komponen untuk mendukung performa sistem.'],
            ['Instalasi Sistem Operasi', 'Pemasangan dan konfigurasi Windows maupun sistem operasi lain sesuai kebutuhan dan kompatibilitas perangkat.'],
            ['Perawatan Internal', 'Pembersihan debu pada komponen dan bagian dalam casing untuk membantu menjaga kondisi perangkat.'],
            ['Pemeriksaan Sistem Pendingin', 'Pemeriksaan kipas, heatsink, dan sirkulasi udara untuk mengidentifikasi permasalahan temperatur.'],
            ['Troubleshooting', 'Identifikasi penyebab perangkat mengalami gagal booting, restart berulang, blue screen, atau tidak menampilkan gambar.'],
            ['Konfigurasi Perangkat', 'Pengaturan BIOS/UEFI, perangkat penyimpanan, serta konfigurasi dasar sesuai kebutuhan sistem.'],
        ],
        'process_title' => 'Tahapan Pengerjaan',
        'process' => [
            'Proses pelayanan dimulai dengan menerima informasi mengenai keluhan dan kebutuhan pengguna. Selanjutnya, dilakukan pemeriksaan terhadap kondisi fisik serta fungsi masing-masing komponen untuk mengetahui kemungkinan sumber permasalahan.',
            'Setelah pemeriksaan selesai, hasil identifikasi disampaikan kepada pengguna beserta rekomendasi penanganan. Apabila diperlukan penggantian atau peningkatan komponen, kesesuaian spesifikasi dan kompatibilitas sistem akan diperhatikan sebelum tindakan dilakukan.',
            'Setelah proses perbaikan atau konfigurasi selesai, perangkat akan melalui pengujian untuk memeriksa kestabilan sistem, fungsi komponen, serta kemampuan perangkat dalam menjalankan aktivitas sesuai kebutuhan.',
        ],
        'commitment_title' => 'Pendekatan Pelayanan Netware',
        'commitment' => [
            'Kami memahami bahwa setiap PC memiliki konfigurasi dan tujuan penggunaan yang berbeda. Sistem yang digunakan untuk kebutuhan administrasi tentu memiliki karakteristik berbeda dengan komputer untuk desain, pengolahan multimedia, atau kebutuhan komputasi lainnya.',
            'Karena itu, Netware tidak hanya berfokus pada penggantian komponen yang bermasalah, tetapi juga memperhatikan kesesuaian konfigurasi secara keseluruhan. Kami berupaya memberikan rekomendasi yang relevan agar pengguna dapat mengambil keputusan berdasarkan kondisi dan kebutuhan perangkat.',
        ],
        'tagline' => 'Netware — Engineering Better Computing Experiences.',
    ],

];

<?php
$menu = ['index.php' => 'Beranda', 'register.php' => 'Daftar Kursus', 'history.php' => 'History', 'test-matrix.php' => 'Test Matrix', 'ai-usage-log.php' => 'AI Usage Log'];

$logs = [
    ['Pembuatan dan Perbaikan Kode',
     'Membantu memahami, membuat, dan memperbaiki kode PHP pada sistem pendaftaran kursus.',
     'Membuat struktur halaman PHP|Memperbaiki register.php dan process.php|Menghubungkan data kursus dari data.php|Membuat fungsi pada helpers.php|Mencari penyebab error dan ketidaksesuaian tampilan',
     'Bagaimana cara memperbaiki kode PHP pada form pendaftaran kursus agar data yang dikirim dapat diproses dengan benar?',
     'AI memberikan penjelasan struktur kode dan contoh perbaikan yang kemudian disesuaikan dengan kebutuhan proyek.'],
    ['Perbaikan Tampilan',
     'Membantu memperbaiki tampilan halaman website agar sesuai dengan desain yang diinginkan.',
     'Mengatur struktur HTML|Menambahkan elemen media|Menghubungkan video dari folder asset/video|Merapikan tampilan halaman',
     'Bagaimana cara menambahkan video dari folder asset/video ke halaman website PHP?',
     'AI memberikan contoh kode HTML <video> dan cara menentukan path file video.'],
    ['Debugging',
     'Membantu menemukan penyebab kesalahan ketika website tidak menampilkan hasil yang diharapkan.',
     'Memeriksa error PHP|Memeriksa data form dengan method POST|Memeriksa hubungan register.php dan process.php|Memeriksa data kursus dan halaman history',
     'Kenapa setelah form pendaftaran dikirim, hasilnya tidak tampil seperti yang diharapkan?',
     'AI membantu menganalisis alur pengiriman data dan memberikan kemungkinan penyebab serta solusi yang dapat diuji.'],
];

function h($s) { return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }
?>
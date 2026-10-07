<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/helpers.php';

// Cadangan jika e() tidak ada di helpers.php
if (!function_exists('e')) {
    function e($v) { return htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8'); }
}

// Cadangan jika rupiah() tidak ada di helpers.php
if (!function_exists('rupiah')) {
    function rupiah($angka)
    {
        if (function_exists('formatRupiah')) {
            return formatRupiah($angka);
        }
        return 'Rp ' . number_format((int) $angka, 0, ',', '.');
    }
}

$dummy = [
    ['name' => 'Alya',  'course' => 'Web Dasar',     'total' => 160000],
    ['name' => 'Bima',  'course' => 'PHP Dasar',     'total' => 212500],
    ['name' => 'Citra', 'course' => 'Laravel Dasar', 'total' => 350000],
];
$dummyCount = count($dummy);
$baru       = isset($_SESSION['history']) && is_array($_SESSION['history']) ? $_SESSION['history'] : [];
$history    = array_merge($dummy, array_values($baru));
$success    = isset($_GET['success']);
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>History Pendaftaran - KursusKu</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<header class="site-header">
  <div class="nav-wrap">
    <a class="brand" href="index.php">KursusKu UIN</a>
  </div>
  <nav aria-label="Navigasi utama">
    <a href="index.php">Beranda</a>
    <a href="register.php">Daftar kursus</a>
    <a href="history.php" class="active">History</a>
  </nav>
</header>

<main>
    <div class="page-intro">
        <span class="eyebrow">Riwayat</span>
        <h1>History Pendaftaran</h1>
        <p>Daftar pendaftaran kursus, termasuk pendaftaran yang baru Anda buat.</p>
    </div>

    <?php if ($success): ?>
        <div class="alert alert--success">
            &#10003; Pendaftaran berhasil diproses dan sudah tercatat di history.
        </div>
    <?php endif; ?>

    <div class="card">
        <p class="muted">Total: <b><?= count($history) ?></b> pendaftaran</p>
        <div class="table-wrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Kursus</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($history as $index => $item): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td>
                                <?= e($item['name'] ?? '-') ?>
                                <?php if ($index >= $dummyCount): ?>
                                    <span class="badge badge--accent">Baru</span>
                                <?php endif; ?>
                            </td>
                            <td><?= e($item['course'] ?? '-') ?></td>
                            <td><b><?= rupiah($item['total'] ?? 0) ?></b></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="actions">
            <a href="register.php" class="btn btn--primary">Daftar Kursus</a>
            <a href="index.php" class="btn-action">Beranda</a>
        </div>
    </div>
</main>

</body>
</html>
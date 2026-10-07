<?php
ob_start();                       // cegah error "headers already sent"
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/data.php';
require_once __DIR__ . '/helpers.php';

if (!function_exists('e')) {
    function e($v) { return htmlspecialchars((string) $v, ENT_QUOTES, 'UTF-8'); }
}
if (!function_exists('formatRupiah')) {
    function formatRupiah($angka) { return 'Rp ' . number_format((int) $angka, 0, ',', '.'); }
}

$errors = [];
$result = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    /* ===== Konfigurasi ===== */
    $diskonTipe = ['mahasiswa' => 20, 'guru' => 10, 'umum' => 0];   // persen
    $labelTipe  = ['mahasiswa' => 'Mahasiswa', 'guru' => 'Guru', 'umum' => 'Umum'];
    $labelMode  = ['offline' => 'Tatap muka', 'online' => 'Online', 'hybrid' => 'Hybrid'];

    /* ===== Ambil input ===== */
    $name      = trim($_POST['name'] ?? '');
    $email     = trim($_POST['email'] ?? '');
    $code      = trim($_POST['course_code'] ?? '');
    $type      = trim($_POST['participant_type'] ?? '');
    $mode      = trim($_POST['learning_mode'] ?? '');
    $packages  = (int) ($_POST['package_count'] ?? 0);
    $notes     = trim($_POST['notes'] ?? '');
    $interests = isset($_POST['interests']) && is_array($_POST['interests']) ? $_POST['interests'] : [];

    /* ===== Validasi ===== */
    if (strlen($name) < 3)                          { $errors[] = 'Nama lengkap minimal 3 karakter.'; }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { $errors[] = 'Format email tidak valid.'; }

    $course = null;
    foreach ($courses as $c) {
        if ($c['code'] === $code) { $course = $c; break; }
    }
    if (!$course)                        { $errors[] = 'Kursus belum dipilih atau tidak ditemukan.'; }
    if (!isset($diskonTipe[$type]))      { $errors[] = 'Tipe peserta belum dipilih.'; }
    if (!isset($labelMode[$mode]))       { $errors[] = 'Metode belajar belum dipilih.'; }
    if ($packages < 1 || $packages > 3)  { $errors[] = 'Jumlah paket harus antara 1 sampai 3.'; }
    if (strlen($notes) > 300)            { $errors[] = 'Catatan maksimal 300 karakter.'; }

    /* Minat: hanya yang ada di daftar resmi (kalau $interestOptions tersedia) */
    $minatLabel = [];
    foreach ($interests as $v) {
        if (isset($interestOptions) && is_array($interestOptions)) {
            if (isset($interestOptions[$v])) { $minatLabel[] = $interestOptions[$v]; }
        } else {
            $minatLabel[] = (string) $v;
        }
    }

    /* ===== Hitung & simpan ===== */
    if (!$errors) {
        $subtotal = (int) $course['fee'] * $packages;
        $persen   = $diskonTipe[$type];
        $diskon   = (int) round($subtotal * $persen / 100);
        $total    = $subtotal - $diskon;

        $result = [
            'name'      => $name,
            'email'     => $email,
            'course'    => $course['name'],
            'code'      => $course['code'],
            'type'      => $labelTipe[$type],
            'mode'      => $labelMode[$mode],
            'packages'  => $packages,
            'interests' => $minatLabel,
            'fee'       => (int) $course['fee'],
            'subtotal'  => $subtotal,
            'persen'    => $persen,
            'diskon'    => $diskon,
            'total'     => $total,
            'notes'     => $notes,
            'waktu'     => date('d-m-Y H:i'),
        ];

        // 1) simpan ke history (kunci name, course, total dibaca history.php)
        $_SESSION['history'][] = $result;

        // 2) simpan hasil terakhir lalu buka ulang halaman ini lewat GET
        //    (supaya kalau di-refresh data tidak tersimpan dobel). TIDAK pindah ke history.
        $_SESSION['last_result'] = $result;
        header('Location: process.php');
        exit;
    }

} else {
    /* Dibuka lewat GET: tampilkan hasil terakhir, kalau tidak ada kembali ke form */
    if (isset($_SESSION['last_result']) && is_array($_SESSION['last_result'])) {
        $result = $_SESSION['last_result'];
    } else {
        header('Location: register.php');
        exit;
    }
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?= $result ? 'Hasil Pendaftaran' : 'Pendaftaran Gagal' ?> - KursusKu</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    .result-wrap{max-width:720px;margin:32px auto;padding:0 20px}
    .result-card{background:#fff;border:1px solid #e6e3f3;border-radius:20px;box-shadow:0 12px 32px rgba(42,26,107,.10);overflow:hidden}
    .result-head{padding:24px 28px;color:#fff;background:linear-gradient(135deg,#2e1d78,#4a2f63)}
    .result-head h1{margin:0 0 4px;font-size:1.5rem}
    .result-head p{margin:0;opacity:.85}
    .result-body{padding:24px 28px}
    .result-body table{width:100%;border-collapse:collapse}
    .result-body td{padding:10px 0;border-bottom:1px dashed #e6e3f3;vertical-align:top}
    .result-body td:first-child{color:#6b6890;width:40%}
    .result-body td:last-child{font-weight:600;text-align:right}
    .result-body tr.total td{border:0;padding-top:16px;font-size:1.2rem;font-weight:800;color:#2a1a6b}
    .result-actions{display:flex;gap:12px;flex-wrap:wrap;padding:0 28px 28px}
    .result-actions a{padding:12px 22px;border-radius:999px;font-weight:700;text-decoration:none;background:#2a1a6b;color:#fff}
    .result-actions a.alt{background:#efeafe;color:#2a1a6b}
    .error-box{background:#fef2f2;border:1.5px solid #fca5a5;color:#991b1b;border-radius:16px;padding:18px 24px}
    .error-box ul{margin:8px 0 0 18px;padding:0}
  </style>
</head>
<body>

<header class="site-header">
  <div class="nav-wrap">
    <a class="brand" href="index.php">KursusKu UIN</a>
  </div>
  <nav aria-label="Navigasi utama">
    <a href="index.php">Beranda</a>
    <a href="register.php" class="active">Daftar kursus</a>
    <a href="history.php">History</a>
  </nav>
</header>

<main>
  <div class="result-wrap">

  <?php if ($errors): ?>
    <div class="error-box">
      <strong>⚠️ Pendaftaran belum bisa diproses:</strong>
      <ul>
        <?php foreach ($errors as $err): ?>
          <li><?= e($err) ?></li>
        <?php endforeach; ?>
      </ul>
    </div>
    <p style="margin-top:20px"><a class="btn btn--primary" href="javascript:history.back()">&larr; Kembali ke form</a></p>

  <?php else: ?>
    <div class="result-card">
      <div class="result-head">
        <h1>✅ Pendaftaran Berhasil</h1>
        <p>Terima kasih, <?= e($result['name']) ?>. Pendaftaran Anda sudah tercatat di history.</p>
      </div>

      <div class="result-body">
        <table>
          <tr><td>Waktu</td><td><?= e($result['waktu']) ?></td></tr>
          <tr><td>Nama</td><td><?= e($result['name']) ?></td></tr>
          <tr><td>Email</td><td><?= e($result['email']) ?></td></tr>
          <tr><td>Kursus</td><td><?= e($result['code']) ?> - <?= e($result['course']) ?></td></tr>
          <tr><td>Tipe peserta</td><td><?= e($result['type']) ?></td></tr>
          <tr><td>Metode belajar</td><td><?= e($result['mode']) ?></td></tr>
          <tr><td>Minat belajar</td><td><?= $result['interests'] ? e(implode(', ', $result['interests'])) : '-' ?></td></tr>
          <tr><td>Catatan</td><td><?= $result['notes'] !== '' ? nl2br(e($result['notes'])) : '-' ?></td></tr>
          <tr><td>Harga per paket</td><td><?= formatRupiah($result['fee']) ?></td></tr>
          <tr><td>Jumlah paket</td><td><?= (int) $result['packages'] ?> paket</td></tr>
          <tr><td>Subtotal</td><td><?= formatRupiah($result['subtotal']) ?></td></tr>
          <tr><td>Diskon (<?= (int) $result['persen'] ?>%)</td><td>- <?= formatRupiah($result['diskon']) ?></td></tr>
          <tr class="total"><td>Total bayar</td><td><?= formatRupiah($result['total']) ?></td></tr>
        </table>
      </div>

      <div class="result-actions">
        <a href="register.php">Daftar Lagi</a>
        <a class="alt" href="history.php">Lihat History</a>
      </div>
    </div>
  <?php endif; ?>

  </div>
</main>

</body>
</html>
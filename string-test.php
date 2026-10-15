<?php

declare(strict_types=1);

$rawName   = ' Laravel Fundamental ';
$cleanName = trim($rawName);
$upperName = strtoupper($cleanName);
$lowerName = strtolower($cleanName);
$length    = strlen($cleanName);
$short     = substr($cleanName, 0, 7);

// Data untuk tabel hasil
$results = [
    ['function' => 'trim()',        'result' => $cleanName, 'note' => 'Menghapus spasi di awal dan akhir'],
    ['function' => 'strtoupper()',  'result' => $upperName, 'note' => 'Mengubah semua huruf menjadi kapital'],
    ['function' => 'strtolower()',  'result' => $lowerName, 'note' => 'Mengubah semua huruf menjadi kecil'],
    ['function' => 'strlen()',      'result' => (string) $length, 'note' => 'Menghitung jumlah karakter'],
    ['function' => 'substr()',      'result' => $short,     'note' => 'Mengambil 7 karakter pertama'],
];
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>String Test - KursusKu</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="utility-page">
<main class="utility-card wide-card">
    <span class="eyebrow">PENGUJIAN FUNGSI STRING</span>
    <h1>String Function Test</h1>
    <p>
        Teks awal: <code>"<?= htmlspecialchars($rawName) ?>"</code>
        (panjang <?= strlen($rawName) ?> karakter, termasuk spasi)
    </p>

    <div class="table-wrap">
        <table class="test-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Fungsi</th>
                    <th>Hasil</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $i => $row): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><code><?= htmlspecialchars($row['function']) ?></code></td>
                        <td><?= htmlspecialchars($row['result']) ?></td>
                        <td><?= htmlspecialchars($row['note']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <a class="button" href="index.php">Kembali</a>
</main>
</body>
</html>
<?php

declare(strict_types=1);

// Nilai bit untuk tiap izin
$READ   = 1; // 001
$WRITE  = 2; // 010
$DELETE = 4; // 100

// Operator OR (|) menggabungkan izin: 001 | 010 = 011 (3)
$permission = $READ | $WRITE;

// Operator AND (&) memeriksa apakah bit tertentu aktif
$canRead   = ($permission & $READ) === $READ;
$canWrite  = ($permission & $WRITE) === $WRITE;
$canDelete = ($permission & $DELETE) === $DELETE;

// Data untuk tabel hasil
$results = [
    ['name' => 'READ',   'value' => $READ,   'allowed' => $canRead],
    ['name' => 'WRITE',  'value' => $WRITE,  'allowed' => $canWrite],
    ['name' => 'DELETE', 'value' => $DELETE, 'allowed' => $canDelete],
];
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bitwise Test - KursusKu</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="utility-page">
<main class="utility-card wide-card">
    <span class="eyebrow">PENGUJIAN OPERATOR</span>
    <h1>Bitwise Permission Test</h1>
    <p>
        Izin gabungan: <code>$permission = $READ | $WRITE</code>
        = <strong><?= $permission ?></strong>
        (biner <code><?= str_pad(decbin($permission), 3, '0', STR_PAD_LEFT) ?></code>)
    </p>

    <div class="table-wrap">
        <table class="test-table">
            <thead>
                <tr>
                    <th>Izin</th>
                    <th>Nilai</th>
                    <th>Biner</th>
                    <th>Hasil</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['name']) ?></td>
                        <td><?= $row['value'] ?></td>
                        <td><?= str_pad(decbin($row['value']), 3, '0', STR_PAD_LEFT) ?></td>
                        <td><?= $row['allowed'] ? 'true' : 'false' ?></td>
                        <td>
                            <span class="<?= $row['allowed'] ? 'badge-available' : 'badge-full' ?>">
                                <?= $row['allowed'] ? 'Diizinkan' : 'Ditolak' ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <p>Output <code>var_dump</code>:</p>
    <pre><?php var_dump($canRead, $canWrite, $canDelete); ?></pre>

    <a class="button" href="index.php">Kembali</a>
</main>
</body>
</html>
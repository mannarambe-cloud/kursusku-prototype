<?php

declare(strict_types=1);

$quota      = 30;
$registered = 18;

// Operator perbandingan menghasilkan nilai boolean
$isFull  = $registered >= $quota; // 18 >= 30 -> false
$hasSeat = $registered < $quota;  // 18 < 30  -> true

// Data untuk tabel hasil
$results = [
    ['expr' => '$registered >= $quota', 'name' => '$isFull',  'value' => $isFull],
    ['expr' => '$registered < $quota',  'name' => '$hasSeat', 'value' => $hasSeat],
];
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Logic Test - KursusKu</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="utility-page">
<main class="utility-card wide-card">
    <span class="eyebrow">PENGUJIAN LOGIKA</span>
    <h1>Logic Test Kuota Kursus</h1>
    <p>
        Kuota: <code><?= $quota ?></code>,
        terdaftar: <code><?= $registered ?></code>,
        sisa kursi: <strong><?= max(0, $quota - $registered) ?></strong>
    </p>

    <div class="table-wrap">
        <table class="test-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Variabel</th>
                    <th>Ekspresi</th>
                    <th>Hasil</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $i => $row): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><code><?= htmlspecialchars($row['name']) ?></code></td>
                        <td><code><?= htmlspecialchars($row['expr']) ?></code></td>
                        <td><?= $row['value'] ? 'true' : 'false' ?></td>
                        <td>
                            <span class="<?= $row['value'] ? 'badge-available' : 'badge-full' ?>">
                                <?= $row['value'] ? 'TRUE' : 'FALSE' ?>
                            </span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <p>Output <code>var_dump</code>:</p>
    <pre><?php var_dump($isFull); var_dump($hasSeat); ?></pre>

    <a class="button" href="index.php">Kembali</a>
</main>
</body>
</html>
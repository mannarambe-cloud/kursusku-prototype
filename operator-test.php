<?php

declare(strict_types=1);

$fee          = 350000;
$participants = 2;

// Operator aritmetika (*)
$subtotal = $fee * $participants;

// Operator perbandingan (> dan ===)
$comparisonPositive = $fee > 0;
$comparisonStrict   = $fee === 350000;

// Operator titik (.) = concatenation
$message = 'Biaya: Rp ' . $fee;

// Data untuk tabel hasil
$results = [
    [
        'type'   => 'Aritmetika (*)',
        'expr'   => '$fee * $participants',
        'result' => (string) $subtotal,
    ],
    [
        'type'   => 'Perbandingan (>)',
        'expr'   => '$fee > 0',
        'result' => $comparisonPositive ? 'true' : 'false',
    ],
    [
        'type'   => 'Strict (===)',
        'expr'   => '$fee === 350000',
        'result' => $comparisonStrict ? 'true' : 'false',
    ],
    [
        'type'   => 'Concatenation (.)',
        'expr'   => "'Biaya: Rp ' . \$fee",
        'result' => $message,
    ],
];
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Operator Test - KursusKu</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="utility-page">
<main class="utility-card wide-card">
    <span class="eyebrow">PENGUJIAN OPERATOR</span>
    <h1>Operator PHP</h1>
    <p>
        Fee: <code><?= $fee ?></code>,
        peserta: <code><?= $participants ?></code>
    </p>

    <div class="table-wrap">
        <table class="test-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Jenis Operator</th>
                    <th>Ekspresi</th>
                    <th>Hasil</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $i => $row): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= htmlspecialchars($row['type']) ?></td>
                        <td><code><?= htmlspecialchars($row['expr']) ?></code></td>
                        <td>
                            <?php if ($row['result'] === 'true'): ?>
                                <span class="badge-available">true</span>
                            <?php elseif ($row['result'] === 'false'): ?>
                                <span class="badge-full">false</span>
                            <?php else: ?>
                                <?= htmlspecialchars($row['result']) ?>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <a class="button" href="fee-calculator.php">Kembali ke Kalkulator</a>
</main>
</body>
</html>
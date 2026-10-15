<?php

declare(strict_types=1);

/**
 * Menghitung total akhir sesuai rumus di fee-calculator.php
 */
function hitungTotal(int $fee, int $participants, int $discountPercent, int $adminFee): int
{
    $subtotal = $fee * $participants;
    $discount = intdiv($subtotal * $discountPercent, 100);

    return $subtotal - $discount + $adminFee;
}

function rp(int $angka): string
{
    return 'Rp ' . number_format($angka, 0, ',', '.');
}

$tests = [
    ['fee' => 350000,  'participants' => 1, 'discount' => 0,  'admin' => 25000, 'expected' => 375000],
    ['fee' => 350000,  'participants' => 1, 'discount' => 10, 'admin' => 25000, 'expected' => 340000],
    ['fee' => 350000,  'participants' => 2, 'discount' => 25, 'admin' => 25000, 'expected' => 550000],
    ['fee' => 0,       'participants' => 1, 'discount' => 10, 'admin' => 0,     'expected' => 0],
    ['fee' => 2500000, 'participants' => 3, 'discount' => 10, 'admin' => 50000, 'expected' => 6800000],
];

$passCount = 0;

foreach ($tests as $index => $test) {
    $actual = hitungTotal(
        $test['fee'],
        $test['participants'],
        $test['discount'],
        $test['admin']
    );

    $tests[$index]['actual'] = $actual;
    $tests[$index]['status'] = $actual === $test['expected'] ? 'PASS' : 'FAIL';

    if ($actual === $test['expected']) {
        $passCount++;
    }
}

$totalTests = count($tests);
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Fee Tests - KursusKu</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="utility-page">
<main class="utility-card wide-card">
    <span class="eyebrow">PENGUJIAN MILESTONE 3</span>
    <h1>Fee Tests Kalkulator Biaya</h1>
    <p>Lima skenario diuji dengan membandingkan nilai expected dan actual.</p>

    <p class="test-summary">
        Hasil: <strong><?= $passCount ?> dari <?= $totalTests ?></strong> test berhasil.
    </p>

    <div class="table-wrap">
        <table class="test-table">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Fee</th>
                    <th>Peserta</th>
                    <th>Diskon</th>
                    <th>Admin</th>
                    <th>Expected</th>
                    <th>Actual</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tests as $i => $test): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= rp($test['fee']) ?></td>
                        <td><?= $test['participants'] ?></td>
                        <td><?= $test['discount'] ?>%</td>
                        <td><?= rp($test['admin']) ?></td>
                        <td><?= rp($test['expected']) ?></td>
                        <td><?= rp($test['actual']) ?></td>
                        <td>
                            <span class="<?= $test['status'] === 'PASS' ? 'badge-available' : 'badge-full' ?>">
                                <?= $test['status'] ?>
                            </span>
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
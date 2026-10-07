<?php
$courseName       = 'Laravel Fundamental';
$fee              = 2500000;
$participantCount = 3;
$discountPercent  = 10;
$adminFee         = 50000;
$isActive         = true;

$subtotal = $fee * $participantCount;
$discount = intdiv($subtotal * $discountPercent, 100);
$total    = $subtotal - $discount + $adminFee;

function rp(int $angka): string
{
    return 'Rp ' . number_format($angka, 0, ',', '.');
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kalkulator Biaya KursusKu</title>
    <style>
        :root {
            --primary: #4f46e5;
            --primary-dark: #4338ca;
            --success: #16a34a;
            --bg: #f1f5f9;
            --text: #0f172a;
            --muted: #64748b;
            --border: #e2e8f0;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            padding: 40px 16px;
            font-family: "Segoe UI", system-ui, -apple-system, Roboto, Arial, sans-serif;
            background: linear-gradient(180deg, #e0e7ff 0%, var(--bg) 320px);
            color: var(--text);
            line-height: 1.6;
            min-height: 100vh;
        }
        .card {
            max-width: 720px;
            margin: 0 auto;
            background: #fff;
            padding: 32px;
            border-radius: 16px;
            border-top: 5px solid var(--primary);
            box-shadow: 0 10px 30px rgba(15, 23, 42, .08);
        }
        .eyebrow {
            display: inline-block;
            background: #e0e7ff;
            color: var(--primary-dark);
            padding: 4px 14px;
            border-radius: 999px;
            font-size: .8rem;
            font-weight: 700;
            letter-spacing: .05em;
            text-transform: uppercase;
        }
        h1 { margin: 12px 0 6px; font-size: 1.8rem; line-height: 1.25; }
        .course {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
            margin: 16px 0 24px;
            padding: 14px 16px;
            background: #f8fafc;
            border: 1px solid var(--border);
            border-radius: 12px;
        }
        .course small { display: block; color: var(--muted); font-size: .78rem; text-transform: uppercase; letter-spacing: .04em; }
        .course strong { font-size: 1.1rem; }
        .badge {
            padding: 4px 14px;
            border-radius: 999px;
            font-size: .85rem;
            font-weight: 600;
        }
        .badge--on  { background: #dcfce7; color: #166534; }
        .badge--off { background: #fee2e2; color: #991b1b; }

        table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid var(--border);
            border-radius: 12px;
            overflow: hidden;
        }
        th, td { padding: 13px 16px; text-align: left; border-bottom: 1px solid var(--border); }
        th { background: #eef2ff; color: var(--primary-dark); font-size: .85rem; text-transform: uppercase; letter-spacing: .04em; }
        td:last-child, th:last-child { text-align: right; }
        tbody tr:hover { background: #f8fafc; }
        .discount td:last-child { color: var(--success); font-weight: 600; }
        .total td {
            background: var(--primary);
            color: #fff;
            font-size: 1.15rem;
            font-weight: 700;
            border-bottom: 0;
        }
        .back {
            display: inline-block;
            margin-top: 24px;
            padding: 11px 22px;
            background: #fff;
            color: var(--primary-dark);
            border: 1px solid var(--border);
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            transition: background .15s, border-color .15s;
        }
        .back:hover { background: #eef2ff; border-color: var(--primary); }

        @media (max-width: 560px) {
            .card { padding: 22px 18px; }
            h1 { font-size: 1.4rem; }
            th, td { padding: 11px 12px; }
        }
    </style>
</head>
<body>
    <main class="card">
        <span class="eyebrow">Kalkulator</span>
        <h1>Estimasi Biaya Kursus</h1>

        <div class="course">
            <div>
                <small>Kursus</small>
                <strong><?= htmlspecialchars($courseName, ENT_QUOTES, 'UTF-8') ?></strong>
            </div>
            <span class="badge <?= $isActive ? 'badge--on' : 'badge--off' ?>">
                <?= $isActive ? 'Aktif' : 'Tidak aktif' ?>
            </span>
        </div>

        <table>
            <thead>
                <tr><th>Komponen</th><th>Nilai</th></tr>
            </thead>
            <tbody>
                <tr><td>Biaya per peserta</td><td><?= rp($fee) ?></td></tr>
                <tr><td>Jumlah peserta</td><td><?= $participantCount ?> orang</td></tr>
                <tr><td>Subtotal</td><td><?= rp($subtotal) ?></td></tr>
                <tr class="discount"><td>Diskon (<?= $discountPercent ?>%)</td><td>- <?= rp($discount) ?></td></tr>
                <tr><td>Biaya admin</td><td><?= rp($adminFee) ?></td></tr>
                <tr class="total"><td>Total akhir</td><td><?= rp($total) ?></td></tr>
            </tbody>
        </table>

        <a class="back" href="index.php">&larr; Kembali ke Beranda KursusKu</a>
    </main>
</body>
</html>
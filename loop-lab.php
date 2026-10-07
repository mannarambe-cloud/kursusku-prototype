<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lab Perulangan PHP</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            min-height: 100vh;
            padding: 40px 20px;
            color: #2d3748;
        }
        h1 { text-align: center; color: #fff; margin-bottom: 8px; }
        .subtitle { text-align: center; color: #e2e8f0; margin-bottom: 32px; }
        .container {
            max-width: 1000px;
            margin: auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 24px;
        }
        .card {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .25);
            transition: transform .2s;
        }
        .card:hover { transform: translateY(-6px); }
        .card-header { padding: 18px 20px; color: #fff; }
        .card-header h3 { text-transform: uppercase; letter-spacing: 1px; }
        .card-header small { opacity: .9; }
        .for      .card-header { background: linear-gradient(90deg, #11998e, #38ef7d); }
        .while    .card-header { background: linear-gradient(90deg, #f7971e, #ffd200); color: #333; }
        .dowhile  .card-header { background: linear-gradient(90deg, #ee0979, #ff6a00); }
        .card-body { padding: 20px; }
        .item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            margin-bottom: 8px;
            background: #f7fafc;
            border-left: 5px solid #cbd5e0;
            border-radius: 8px;
        }
        .for .item     { border-left-color: #11998e; }
        .while .item   { border-left-color: #f7971e; }
        .dowhile .item { border-left-color: #ee0979; }
        .badge {
            min-width: 30px;
            height: 30px;
            display: grid;
            place-items: center;
            border-radius: 50%;
            background: #2d3748;
            color: #fff;
            font-weight: bold;
            font-size: 14px;
        }
        .code {
            background: #1a202c;
            color: #68d391;
            font-family: Consolas, monospace;
            font-size: 13px;
            padding: 12px 20px;
        }
    </style>
</head>
<body>

<h1>🔁 Lab Perulangan PHP</h1>
<p class="subtitle">Perbandingan for, while, dan do-while</p>

<div class="container">

    <!-- FOR -->
    <div class="card for">
        <div class="card-header">
            <h3>for</h3>
            <small>Jumlah perulangan sudah diketahui</small>
        </div>
        <div class="card-body">
            <?php
            for ($i = 1; $i <= 5; $i++) {
                echo "<div class='item'><span class='badge'>$i</span> Pertemuan ke-$i</div>";
            }
            ?>
        </div>
        <div class="code">for ($i = 1; $i &lt;= 5; $i++)</div>
    </div>

    <!-- WHILE -->
    <div class="card while">
        <div class="card-header">
            <h3>while</h3>
            <small>Cek kondisi dulu, baru jalan</small>
        </div>
        <div class="card-body">
            <?php
            $i = 1;
            while ($i <= 5) {
                echo "<div class='item'><span class='badge'>$i</span> Nomor antrean: $i</div>";
                $i++;
            }
            ?>
        </div>
        <div class="code">while ($i &lt;= 5)</div>
    </div>

    <!-- DO-WHILE -->
    <div class="card dowhile">
        <div class="card-header">
            <h3>do-while</h3>
            <small>Jalan dulu, baru cek kondisi</small>
        </div>
        <div class="card-body">
            <?php
            $i = 1;
            do {
                echo "<div class='item'><span class='badge'>$i</span> Percobaan ke-$i</div>";
                $i++;
            } while ($i <= 5);
            ?>
        </div>
        <div class="code">do { ... } while ($i &lt;= 5);</div>
    </div>

</div>

</body>
</html>
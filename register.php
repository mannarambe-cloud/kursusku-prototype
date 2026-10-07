<?php
require __DIR__ . '/data.php';
require __DIR__ . '/helpers.php';
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Daftar Kursus - KursusKu</title>
  <link rel="stylesheet" href="assets/css/style.css">
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
  <div class="page-intro">
    <span class="eyebrow">Pertemuan 6</span>
    <h1>Pendaftaran Kursus</h1>
    <p>Isi data berikut untuk menghitung biaya dan melihat ringkasan pendaftaran Anda.</p>
  </div>

  <div class="form-page">
    <div class="form-card">
      <form class="registration-form" method="POST" action="process.php">

        <div class="form-grid">
          <div class="form-group">
            <label for="name">Nama lengkap</label>
            <input id="name" name="name" type="text" placeholder="Contoh: Budi Santoso" required>
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" placeholder="nama@email.com" required>
          </div>
        </div>

        <div class="form-group">
          <label for="course_code">Pilih kursus</label>
          <select id="course_code" name="course_code" required>
            <option value="">-- Pilih kursus --</option>
            <?php foreach ($courses as $course): ?>
              <option value="<?= e($course['code']) ?>">
                <?= e($course['name']) ?> - <?= formatRupiah($course['fee']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <fieldset class="form-group">
          <legend>Tipe peserta</legend>
          <div class="choice-group">
            <label class="choice"><input type="radio" name="participant_type" value="mahasiswa" required> Mahasiswa</label>
            <label class="choice"><input type="radio" name="participant_type" value="guru"> Guru</label>
            <label class="choice"><input type="radio" name="participant_type" value="umum"> Umum</label>
          </div>
        </fieldset>

        <fieldset class="form-group">
          <legend>Minat belajar</legend>
          <div class="choice-group">
            <?php foreach ($interestOptions as $value => $label): ?>
              <label class="choice">
                <input type="checkbox" name="interests[]" value="<?= e($value) ?>">
                <?= e($label) ?>
              </label>
            <?php endforeach; ?>
          </div>
        </fieldset>

        <div class="form-grid">
          <div class="form-group">
            <label for="learning_mode">Metode belajar</label>
            <select id="learning_mode" name="learning_mode" required>
              <option value="">-- Pilih metode --</option>
              <option value="offline">Tatap muka</option>
              <option value="online">Online</option>
              <option value="hybrid">Hybrid</option>
            </select>
          </div>
          <div class="form-group">
            <label for="package_count">Jumlah paket</label>
            <select id="package_count" name="package_count" required>
              <?php for ($i = 1; $i <= 3; $i++): ?>
                <option value="<?= $i ?>"><?= $i ?> paket</option>
              <?php endfor; ?>
            </select>
          </div>
        </div>

        <div class="form-group">
          <label for="notes">Catatan tambahan</label>
          <textarea id="notes" name="notes" rows="4" maxlength="300" placeholder="Tulis catatan jika ada (opsional)"></textarea>
          <span class="help">Maksimal 300 karakter.</span>
        </div>

        <div class="form-actions">
          <button type="submit" class="btn-primary">Proses Pendaftaran</button>
          <a href="history.php" class="btn-action">History Dummy</a>
          <a href="loop-lab.php" class="btn-action">Loop Lab</a>
        </div>
      </form>
    </div>

    <aside class="facility-card">
      <h2>Fasilitas</h2>
      <ul class="facility-list">
        <?php foreach ($facilities as $facility): ?>
          <li><?= e($facility) ?></li>
        <?php endforeach; ?>
      </ul>
    </aside>
  </div>
</main>

</body>
</html>
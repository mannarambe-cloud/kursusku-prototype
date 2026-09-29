<?php

// =========================================================
// MENGAMBIL DATA DARI FORM
// =========================================================

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$studyProgram = trim($_POST['study_program'] ?? '');
$course = trim($_POST['course'] ?? '');
$participantType = trim($_POST['participant_type'] ?? '');

$interests = $_POST['interests'] ?? [];

$note = trim($_POST['note'] ?? '');
$source = trim($_POST['source'] ?? '');


// =========================================================
// MEMASTIKAN INTERESTS BERUPA ARRAY
// =========================================================

if (!is_array($interests)) {
    $interests = [$interests];
}


// =========================================================
// FUNGSI KEAMANAN OUTPUT
// =========================================================

function e($value): string
{
    return htmlspecialchars(
        (string) $value,
        ENT_QUOTES,
        'UTF-8'
    );
}


// =========================================================
// FUNGSI MENAMPILKAN DATA
// =========================================================

function showData($value): string
{
    if (trim((string) $value) === '') {
        return '<span class="empty">-</span>';
    }

    return e($value);
}

?>

<!doctype html>

<html lang="id">

<head>

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>Hasil Pendaftaran - KursusKu</title>

    <!-- CSS UTAMA -->
    <link
        rel="stylesheet"
        href="assets/css/style.css"
    >

</head>


<body>


<!-- =====================================================
     HEADER / NAVBAR
===================================================== -->

<header class="navbar">

    <nav>

        <!-- LOGO -->

        <a href="index.php">
            <strong>KursusKu</strong>
        </a>


        <!-- MENU -->

        <a href="index.php">
            Beranda
        </a>

        <a href="index.php#katalog">
            Katalog
        </a>

        <a href="registration.php">
            Daftar
        </a>

    </nav>

</header>



<!-- =====================================================
     MAIN
===================================================== -->

<main class="result-container">


    <!-- =================================================
         HEADER HASIL
    ================================================== -->

    <section class="result-header">

        <div class="success-icon">
            ✓
        </div>

        <h1>
            Pendaftaran Berhasil!
        </h1>

        <p>
            Data pendaftaran kamu berhasil diterima
            dan sedang diproses.
        </p>

    </section>



    <!-- =================================================
         CARD HASIL PENDAFTARAN
    ================================================== -->

    <section class="summary-card">


        <!-- CARD HEADER -->

        <div class="card-title">

            <div>

                <span class="small-title">
                    KURSUSKU
                </span>

                <h2>
                    Ringkasan Pendaftaran
                </h2>

            </div>


            <span class="status-badge">
                ✓ Diterima
            </span>

        </div>



        <!-- =================================================
             DATA UTAMA
        ================================================== -->

        <div class="data-grid">


            <!-- NAMA -->

            <div class="data-item">

                <span class="data-label">
                    Nama
                </span>

                <strong>
                    <?= showData($name) ?>
                </strong>

            </div>



            <!-- EMAIL -->

            <div class="data-item">

                <span class="data-label">
                    Email
                </span>

                <strong>
                    <?= showData($email) ?>
                </strong>

            </div>



            <!-- NOMOR HP -->

            <div class="data-item">

                <span class="data-label">
                    Nomor HP
                </span>

                <strong>
                    <?= showData($phone) ?>
                </strong>

            </div>



            <!-- PROGRAM STUDI -->

            <div class="data-item">

                <span class="data-label">
                    Program Studi
                </span>

                <strong>
                    <?= showData($studyProgram) ?>
                </strong>

            </div>



            <!-- KURSUS -->

            <div class="data-item highlight">

                <span class="data-label">
                    Kursus
                </span>

                <strong>
                    <?= showData($course) ?>
                </strong>

            </div>



            <!-- JENIS PESERTA -->

            <div class="data-item">

                <span class="data-label">
                    Jenis Peserta
                </span>

                <strong>
                    <?= showData($participantType) ?>
                </strong>

            </div>

        </div>



        <!-- =================================================
             DATA TAMBAHAN
        ================================================== -->

        <div class="additional-data">


            <!-- MINAT -->

            <div class="additional-item">

                <span class="data-label">
                    Minat
                </span>


                <div class="interest-list">

                    <?php if (!empty($interests)): ?>

                        <?php foreach ($interests as $interest): ?>

                            <?php if (trim($interest) !== ''): ?>

                                <span class="interest-badge">

                                    <?= e($interest) ?>

                                </span>

                            <?php endif; ?>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <span class="empty">
                            Tidak ada minat yang dipilih
                        </span>

                    <?php endif; ?>

                </div>

            </div>



            <!-- CATATAN -->

            <div class="additional-item">

                <span class="data-label">
                    Catatan
                </span>


                <?php if ($note !== ''): ?>

                    <p class="note-box">
                        <?= nl2br(e($note)) ?>
                    </p>

                <?php else: ?>

                    <span class="empty">
                        Tidak ada catatan
                    </span>

                <?php endif; ?>

            </div>



            <!-- SUMBER -->

            <div class="additional-item">

                <span class="data-label">
                    Sumber
                </span>

                <strong>
                    <?= showData($source) ?>
                </strong>

            </div>

        </div>



        <!-- =================================================
             TOMBOL
        ================================================== -->

        <div class="action-buttons">


            <!-- KEMBALI KE FORM -->

            <a
                href="registration.php"
                class="btn btn-primary"
            >
                ← Kembali ke Form
            </a>


            <!-- KEMBALI KE BERANDA -->

            <a
                href="index.php"
                class="btn btn-secondary"
            >
                🏠 Beranda
            </a>

        </div>


    </section>



    <!-- =================================================
         FOOTER
    ================================================== -->

    <p class="result-footer">

        © <?= date('Y') ?> KursusKu.
        Belajar lebih mudah, berkembang lebih cepat.

    </p>


</main>


</body>

</html>
<?php

// ==========================================
// MENGAMBIL DATA DARI FORM
// ==========================================

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$studyProgram = trim($_POST['study_program'] ?? '');
$course = trim($_POST['course'] ?? '');
$participantType = trim($_POST['participant_type'] ?? '');
$interests = $_POST['interests'] ?? [];
$note = trim($_POST['note'] ?? '');
$source = trim($_POST['source'] ?? '');


// ==========================================
// MEMASTIKAN INTERESTS BERBENTUK ARRAY
// ==========================================

if (!is_array($interests)) {
    $interests = [$interests];
}


// ==========================================
// FUNGSI KEAMANAN
// ==========================================

function e($value): string
{
    return htmlspecialchars(
        (string) $value,
        ENT_QUOTES,
        'UTF-8'
    );
}


// ==========================================
// MENAMPILKAN DATA
// ==========================================

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

    <title>
        Hasil Pendaftaran - KursusKu
    </title>


    <!-- GOOGLE FONT -->

    <link
        rel="preconnect"
        href="https://fonts.googleapis.com"
    >

    <link
        rel="preconnect"
        href="https://fonts.gstatic.com"
        crossorigin
    >

    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >


    <!-- CSS -->

    <link
        rel="stylesheet"
        href="assets/css/style.css"
    >

</head>


<body>


    <!-- =====================================
         NAVBAR
    ====================================== -->

    <header class="navbar">

        <div class="nav-container">

            <a
                href="index.php"
                class="logo"
            >

                <span class="logo-icon">
                    K
                </span>

                <span>
                    KursusKu
                </span>

            </a>


            <nav>

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

        </div>

    </header>



    <!-- =====================================
         HASIL PENDAFTARAN
    ====================================== -->

    <main class="result-container">


        <!-- SUCCESS -->

        <section class="result-header">

            <div class="success-icon">
                ✓
            </div>


            <h1>
                Pendaftaran Berhasil!
            </h1>


            <p>
                Data pendaftaran kamu berhasil
                diterima dan sedang diproses.
            </p>

        </section>



        <!-- =================================
             CARD DATA
        ================================== -->

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



            <!-- =================================
                 DATA PENDAFTAR
            ================================== -->

            <div class="data-grid">


                <!-- Nama -->

                <div class="data-item">

                    <span class="data-label">
                        Nama Lengkap
                    </span>

                    <strong>
                        <?= showData($name) ?>
                    </strong>

                </div>


                <!-- Email -->

                <div class="data-item">

                    <span class="data-label">
                        Email
                    </span>

                    <strong>
                        <?= showData($email) ?>
                    </strong>

                </div>


                <!-- HP -->

                <div class="data-item">

                    <span class="data-label">
                        Nomor HP
                    </span>

                    <strong>
                        <?= showData($phone) ?>
                    </strong>

                </div>


                <!-- Program Studi -->

                <div class="data-item">

                    <span class="data-label">
                        Program Studi
                    </span>

                    <strong>
                        <?= showData($studyProgram) ?>
                    </strong>

                </div>


                <!-- Kursus -->

                <div class="data-item highlight">

                    <span class="data-label">
                        Kursus yang Dipilih
                    </span>

                    <strong>
                        <?= showData($course) ?>
                    </strong>

                </div>


                <!-- Jenis Peserta -->

                <div class="data-item">

                    <span class="data-label">
                        Jenis Peserta
                    </span>

                    <strong>
                        <?= showData($participantType) ?>
                    </strong>

                </div>

            </div>



            <!-- =================================
                 DATA TAMBAHAN
            ================================== -->

            <div class="additional-data">


                <!-- MINAT -->

                <div class="additional-item">

                    <span class="data-label">
                        Minat Pembelajaran
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

                        <p class="empty">
                            Tidak ada catatan
                        </p>

                    <?php endif; ?>

                </div>



                <!-- SUMBER -->

                <div class="additional-item">

                    <span class="data-label">
                        Sumber Informasi
                    </span>

                    <strong>
                        <?= showData($source) ?>
                    </strong>

                </div>

            </div>



            <!-- =================================
                 TOMBOL
            ================================== -->

            <div class="action-buttons">


                <!-- KEMBALI -->

                <a
                    href="registration.php"
                    class="btn btn-primary"
                >
                    ← Kembali ke Form
                </a>


                <!-- BERANDA -->

                <a
                    href="index.php"
                    class="btn btn-secondary"
                >
                    🏠 Beranda
                </a>

            </div>


        </section>



        <!-- FOOTER -->

        <p class="result-footer">

            © <?= date('Y') ?> KursusKu.
            Belajar lebih mudah, berkembang lebih cepat.

        </p>


    </main>


</body>

</html>
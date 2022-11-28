<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Example\Entity\NilaiSemester;

$nim = $_GET['nim'];
$nilaiMahasiswa = new \Example\Repository\NilaiSemesterRepository(\Example\Config\Database::getConnection());
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a09b11b4b2.js" crossorigin="anonymous"></script>
</head>
<body class="bg-light">

<div class="container">
    <?php
    if (isset($_POST['update'])) :
        $nilai = new NilaiSemester();
        $nilai->setNim($_GET['nim']);
        $nilai->setNama($_POST['nama']);
        $nilai->setPresensi($_POST['presensi']);
        $nilai->setTugas($_POST['tugas']);
        $nilai->setUts($_POST['uts']);
        $nilai->setUas($_POST['uas']);
        $nilaiMahasiswa->update($nilai); ?>

        <div class="alert alert-success alert-dismissible fade show py-2 col-4 m-auto mb-2 mt-3" id="alert-success">
            <strong>Success!</strong> Data berhasil diupdate.
        </div>
    <?php endif; $find = $nilaiMahasiswa->findByNim($nim); ?>
    <form class="px-5 mt-3 d-grid card shadow-lg" method="post">
        <div class="card-body">
            <div class="input-group mb-2">
                <span class="form-control"><?= $find->getNim() ?></span>
                <button class="input-group-text btn btn-outline-primary" type="button" id="clipboard"
                        data-bs-toggle="tooltip" data-bs-placement="top" title="Copy to clipboard">
                    <i class="fa-solid fa-clipboard" id="clipboard"></i>
                </button>
            </div>
            <div class="input-group mb-2">
                <label class="input-group-text" for="nama">Nama</label>
                <input class="form-control" type="text" name="nama" id="nama" value="<?= $find->getNama() ?>">
            </div>
            <div class="input-group mb-2">
                <label class="input-group-text" for="presensi">Presensi</label>
                <input class="form-control" type="text" name="presensi" id="presensi"
                       value="<?= $find->getPresensi() ?>">
            </div>
            <div class="input-group mb-2">
                <label class="input-group-text" for="tugas">Tugas</label>
                <input class="form-control" type="text" name="tugas" id="tugas" value="<?= $find->getTugas() ?>">
            </div>
            <div class="input-group mb-2">
                <label class="input-group-text" for="uts">UTS</label>
                <input class="form-control" type="text" name="uts" id="uts" value="<?= $find->getUts() ?>">
            </div>
            <div class="input-group mb-2">
                <label class="input-group-text" for="uas">UAS</label>
                <input class="form-control" type="text" name="uas" id="uas" value="<?= $find->getUas() ?>">
            </div>
            <button type="submit" name="update" class="btn btn-primary mt-3">update</button>
            <a href="index.php" class="btn btn-warning mt-3 text-dark">back</a>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
<script type="text/javascript">

    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

    const copy = document.querySelector('#clipboard');
    const icon = document.querySelector('#clipboard i');

    copy.addEventListener('click', () => {
        const span = document.querySelector('.form-control');
        navigator.clipboard.writeText(span.textContent);
        copy.setAttribute('data-bs-original-title', 'Copied!');
        icon.classList.remove('fa-clipboard');
        copy.classList.remove('btn-outline-primary');
        icon.classList.add('fa-check');
        copy.classList.add('btn-success');
        setTimeout(() => {
            copy.setAttribute('data-bs-original-title', 'Copy to clipboard');
            icon.classList.remove('fa-check');
            copy.classList.remove('btn-success');
            icon.classList.add('fa-clipboard');
            copy.classList.add('btn-outline-primary');
        }, 1000);
        tooltipList[0].show();
    });
//    alert fade out
    const alert = document.querySelector('#alert-success');
    setTimeout(() => {
        alert.classList.remove('show');
    }, 3000);
</script>
</body>
</html>

<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Example\Entity\NilaiSemester;

$nilaiMahasiswa = new \Example\Repository\NilaiSemesterRepository(\Example\Config\Database::getConnection());

if (isset($_POST['submit'])) {
    $nilai = new NilaiSemester();
    $nilai->setNim($_POST['nim']);
    $nilai->setNama($_POST['nama']);
    $nilai->setPresensi($_POST['presensi']);
    $nilai->setTugas($_POST['tugas']);
    $nilai->setUts($_POST['uts']);
    $nilai->setUas($_POST['uas']);
    $nilaiMahasiswa->save($nilai);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body class="bg-light">
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 mb-2">
            <form class="px-5 mt-3 d-grid card shadow-lg" method="post">
                <div class="card-body">
                    <div class="input-group mb-2">
                        <label class="input-group-text" for="nim">NIM</label>
                        <input class="form-control" type="text" name="nim" id="nim">
                    </div>
                    <div class="input-group mb-2">
                        <label class="input-group-text" for="nama">Nama</label>
                        <input class="form-control" type="text" name="nama" id="nama">
                    </div>
                    <div class="input-group mb-2">
                        <label class="input-group-text" for="presensi">Presensi</label>
                        <input class="form-control" type="text" name="presensi" id="presensi">
                    </div>
                    <div class="input-group mb-2">
                        <label class="input-group-text" for="tugas">Tugas</label>
                        <input class="form-control" type="text" name="tugas" id="tugas">
                    </div>
                    <div class="input-group mb-2">
                        <label class="input-group-text" for="uts">UTS</label>
                        <input class="form-control" type="text" name="uts" id="uts">
                    </div>
                    <div class="input-group mb-2">
                        <label class="input-group-text" for="uas">UAS</label>
                        <input class="form-control" type="text" name="uas" id="uas">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary mt-3">submit</button>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">NIM</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Presensi</th>
                    <th scope="col">Tugas</th>
                    <th scope="col">UTS</th>
                    <th scope="col">UAS</th>
                    <th scope="col">Nilai</th>
                </tr>
                </thead>
                <tbody class="table-group-divider">
                <?php foreach ($nilaiMahasiswa->findAll() as $key => $value): ?>
                    <tr>
                        <th scope="row"><a href="update.php?nim=<?= $value->getNim() ?>"
                                           class=""><?= $value->getNim() ?></a></th>
                        <td><?= $value->getNama() ?></td>
                        <td><?= $value->getPresensi() ?></td>
                        <td><?= $value->getTugas() ?></td>
                        <td><?= $value->getUts() ?></td>
                        <td><?= $value->getUas() ?></td>
                        <td class="bg-primary text-light"><?= ($value->getPresensi() * 0.1) + ($value->getTugas() * 0.25) + ($value->getUts() * 0.3)
                            + ($value->getUas() * 0.35) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous"></script>
</body>
</html>

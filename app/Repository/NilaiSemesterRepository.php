<?php

namespace Example\Repository;

use Example\Entity\NilaiSemester;

class NilaiSemesterRepository
{
    private \PDO $connection;

    /**
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function save(NilaiSemester $nilaiSemester): NilaiSemester
    {
        $statement = $this->connection->prepare("INSERT INTO nilai_mahasiswa(nim, nama, presensi, tugas, uts, uas) VALUES (?,?,?,?,?,?)");
        $statement->execute([$nilaiSemester->getNim(), $nilaiSemester->getNama(), $nilaiSemester->getPresensi(), $nilaiSemester->getTugas(), $nilaiSemester->getUts(), $nilaiSemester->getUas()]);

        return $nilaiSemester;
    }

    public function update(NilaiSemester $nilaiSemester): NilaiSemester
    {
        $statement = $this->connection->prepare("UPDATE nilai_mahasiswa SET nim = ?, nama = ?, presensi = ?, tugas = ?, uts = ?, uas = ? WHERE nim = ?");
        $statement->execute([$nilaiSemester->getNim(), $nilaiSemester->getNama(), $nilaiSemester->getPresensi(), $nilaiSemester->getTugas(), $nilaiSemester->getUts(), $nilaiSemester->getUas(), $nilaiSemester->getNim()]);

        return $nilaiSemester;
    }

    public function findByNim(string $nim): ?NilaiSemester
    {
        $statement = $this->connection->prepare("SELECT nim, nama, presensi, tugas, uts, uas FROM nilai_mahasiswa WHERE nim = ?");
        $statement->execute([$nim]);

        try {
            if ($row = $statement->fetch()) {
                $nilaiSemester = new NilaiSemester();
                $nilaiSemester->setNim($row['nim']);
                $nilaiSemester->setNama($row['nama']);
                $nilaiSemester->setPresensi($row['presensi']);
                $nilaiSemester->setTugas($row['tugas']);
                $nilaiSemester->setUts($row['uts']);
                $nilaiSemester->setUas($row['uas']);

                return $nilaiSemester;
            } else {
                return null;
            }
        } finally {
            $statement->closeCursor();
        }
    }

    public function findAll(): array
    {
        $statement = $this->connection->prepare("SELECT nim, nama, presensi, tugas, uts, uas FROM nilai_mahasiswa");
        $statement->execute();

        $result = [];
        $nilai = $statement->fetchAll();

        foreach ($nilai as $row) {
            $nilaiSemester = new NilaiSemester();
            $nilaiSemester->setNim($row['nim']);
            $nilaiSemester->setNama($row['nama']);
            $nilaiSemester->setPresensi($row['presensi']);
            $nilaiSemester->setTugas($row['tugas']);
            $nilaiSemester->setUts($row['uts']);
            $nilaiSemester->setUas($row['uas']);
            $result[] = $nilaiSemester;
        }

        return $result;
    }
}
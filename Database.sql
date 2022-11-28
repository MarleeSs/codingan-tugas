CREATE TABLE nilai_mahasiswa(
    nim VARCHAR(55) PRIMARY KEY NOT NULL ,
    nama VARCHAR(55) NOT NULL ,
    presensi INT NOT NULL ,
    tugas INT NOT NULL ,
    uts INT NOT NULL ,
    uas INT NOT NULL
) ENGINE = InnoDB;


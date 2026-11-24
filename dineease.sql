CREATE DATABASE IF NOT EXISTS dineease;
USE dineease;

CREATE TABLE IF NOT EXISTS pengguna (
    id_pengguna INT AUTO_INCREMENT PRIMARY KEY,
    nama_lengkap VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    no_telepon VARCHAR(20) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS reservasi (
    id_reservasi INT AUTO_INCREMENT PRIMARY KEY,
    id_pengguna INT NOT NULL,
    nama_pemesan VARCHAR(100) NOT NULL,
    tanggal_reservasi DATE NOT NULL,
    waktu_reservasi TIME NOT NULL,
    jumlah_tamu INT NOT NULL,
    area_meja VARCHAR(50) NOT NULL,
    catatan_khusus TEXT,
    status_reservasi VARCHAR(30) DEFAULT 'Terkonfirmasi',
    FOREIGN KEY (id_pengguna) REFERENCES pengguna(id_pengguna) ON DELETE CASCADE
);
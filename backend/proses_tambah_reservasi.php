<?php
    session_start();
    include 'koneksi.php';

    if(!isset($_SESSION['id_pengguna'])){
        header("Location: ../login.php");
        exit();
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id_pengguna = $_SESSION['id_pengguna'];
        $nama_pemesan = mysqli_real_escape_string($koneksi, $_POST['nama_pemesan']);
        $tanggal_reservasi = mysqli_real_escape_string($koneksi, $_POST['tanggal_reservasi']);
        $waktu_reservasi = mysqli_real_escape_string($koneksi, $_POST['waktu_reservasi']);
        $jumlah_tamu = (int) $_POST['jumlah_tamu'];
        $area_meja = mysqli_real_escape_string($koneksi, $_POST['area_meja']);
        $catatan_khusus = mysqli_real_escape_string($koneksi, $_POST['catatan_khusus']);

        $query_tambah = "INSERT INTO reservasi (id_pengguna, nama_pemesan, tanggal_reservasi, waktu_reservasi, jumlah_tamu, area_meja, catatan_khusus) 
                        VALUES ('$id_pengguna', '$nama_pemesan', '$tanggal_reservasi', '$waktu_reservasi', '$jumlah_tamu', '$area_meja', '$catatan_khusus')";

        if(mysqli_query($koneksi, $query_tambah)){
            header("Location: ../index.php?pesan=reservasi_berhasil");
        }else{
            header("Location: ../tambah_reservasi.php?pesan=gagal");
        }
    }
?>
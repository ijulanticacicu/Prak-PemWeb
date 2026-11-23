<?php
    session_start();
    include 'koneksi.php';

    if(!isset($_SESSION['id_pengguna'])){
        header("Location: ../login.php");
        exit();
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id_reservasi = (int) $_POST['id_reservasi'];
        $id_pengguna = $_SESSION['id_pengguna'];
        $nama_pemesan = mysqli_real_escape_string($koneksi, $_POST['nama_pemesan']);
        $tanggal_reservasi = mysqli_real_escape_string($koneksi, $_POST['tanggal_reservasi']);
        $waktu_reservasi = mysqli_real_escape_string($koneksi, $_POST['waktu_reservasi']);
        $jumlah_tamu = (int) $_POST['jumlah_tamu'];
        $area_meja = mysqli_real_escape_string($koneksi, $_POST['area_meja']);
        $catatan_khusus = mysqli_real_escape_string($koneksi, $_POST['catatan_khusus']);

        $query_ubah = "UPDATE reservasi SET 
                    nama_pemesan = '$nama_pemesan',
                    tanggal_reservasi = '$tanggal_reservasi',
                    waktu_reservasi = '$waktu_reservasi',
                    jumlah_tamu = '$jumlah_tamu',
                    area_meja = '$area_meja',
                    catatan_khusus = '$catatan_khusus'
                    WHERE id_reservasi = '$id_reservasi' AND id_pengguna = '$id_pengguna'";

        if(mysqli_query($koneksi, $query_ubah)){
            header("Location: ../index.php?pesan=ubah_berhasil");
        }else{
            header("Location: ../edit_reservasi.php?id=$id_reservasi&pesan=gagal");
        }
    }
?>
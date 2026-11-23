<?php
    session_start();
    include 'koneksi.php';

    if(!isset($_SESSION['id_pengguna'])){
        header("Location: ../login.php");
        exit();
    }

    if(isset($_GET['id'])){
        $id_reservasi = (int) $_GET['id'];
        $id_pengguna  = $_SESSION['id_pengguna'];

        $query_hapus = "DELETE FROM reservasi WHERE id_reservasi = '$id_reservasi' AND id_pengguna = '$id_pengguna'";
        mysqli_query($koneksi, $query_hapus);
    }

    header("Location: ../index.php?pesan=hapus_berhasil");
    exit();
?>
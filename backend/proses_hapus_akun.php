<?php
    session_start();
    include 'koneksi.php';

    if(!isset($_SESSION['id_pengguna'])){
        header("Location: ../login.php");
        exit();
    }

    $id_pengguna = $_SESSION['id_pengguna'];
    $query_hapus_akun = "DELETE FROM pengguna WHERE id_pengguna = '$id_pengguna'";

    if(mysqli_query($koneksi, $query_hapus_akun)){
        session_unset();
        session_destroy();
        header("Location: ../daftar.php?pesan=akun_dihapus");
    }else{
        header("Location: ../akun.php?pesan=gagal_hapus");
    }
?>
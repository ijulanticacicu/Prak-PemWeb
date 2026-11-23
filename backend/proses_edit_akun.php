<?php
    session_start();
    include 'koneksi.php';

    if(!isset($_SESSION['id_pengguna'])){
        header("Location: ../login.php");
        exit();
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id_pengguna = $_SESSION['id_pengguna'];
        $nama_lengkap = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
        $email = mysqli_real_escape_string($koneksi, $_POST['email']);
        $no_telepon = mysqli_real_escape_string($koneksi, $_POST['no_telepon']);
        $password_baru = $_POST['password_baru'];

        if(!empty($password_baru)){
            $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);
            $query_akun = "UPDATE pengguna SET nama_lengkap='$nama_lengkap', email='$email', no_telepon='$no_telepon', password='$password_hash' WHERE id_pengguna='$id_pengguna'";
        }else{
            $query_akun = "UPDATE pengguna SET nama_lengkap='$nama_lengkap', email='$email', no_telepon='$no_telepon' WHERE id_pengguna='$id_pengguna'";
        }

        if(mysqli_query($koneksi, $query_akun)){
            $_SESSION['nama_lengkap'] = $nama_lengkap;
            header("Location: ../akun.php?pesan=akun_diperbarui");
        }else{
            header("Location: ../edit_akun.php?pesan=gagal");
        }
    }
?>
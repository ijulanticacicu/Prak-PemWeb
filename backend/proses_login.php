<?php
    session_start();
    include 'koneksi.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $email    = mysqli_real_escape_string($koneksi, $_POST['email']);
        $password = $_POST['password'];

        $query_login = "SELECT * FROM pengguna WHERE email = '$email'";
        $hasil_login = mysqli_query($koneksi, $query_login);

        if($data_pengguna = mysqli_fetch_assoc($hasil_login)){
            if(password_verify($password, $data_pengguna['password'])){
                $_SESSION['id_pengguna']  = $data_pengguna['id_pengguna'];
                $_SESSION['nama_lengkap'] = $data_pengguna['nama_lengkap'];
                header("Location: ../index.php");
                exit();
            }
        }
        header("Location: ../login.php?pesan=gagal_login");
    }
?>
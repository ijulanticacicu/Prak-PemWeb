<?php
    include 'koneksi.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nama_lengkap = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
        $email = mysqli_real_escape_string($koneksi, $_POST['email']);
        $no_telepon = mysqli_real_escape_string($koneksi, $_POST['no_telepon']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $query_cek = "SELECT id_pengguna FROM pengguna WHERE email = '$email'";
        $hasil_cek = mysqli_query($koneksi, $query_cek);

        if(mysqli_num_rows($hasil_cek) > 0){
            header("Location: ../daftar.php?pesan=email_terdaftar");
            exit();
        }

        $query_daftar = "INSERT INTO pengguna (nama_lengkap, email, no_telepon, password) VALUES ('$nama_lengkap', '$email', '$no_telepon', '$password')";

        if(mysqli_query($koneksi, $query_daftar)){
            header("Location: ../login.php?pesan=daftar_berhasil");
        }else{
            header("Location: ../daftar.php?pesan=gagal");
        }
    }
?>
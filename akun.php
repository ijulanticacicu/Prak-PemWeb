<?php
    session_start();
    include 'backend/koneksi.php';

    if(!isset($_SESSION['id_pengguna'])){
        header("Location: login.php");
        exit();
    }

    $id_pengguna = $_SESSION['id_pengguna'];
    $query_profil = "SELECT * FROM pengguna WHERE id_pengguna = '$id_pengguna'";
    $profil = mysqli_fetch_assoc(mysqli_query($koneksi, $query_profil));
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Akun - DineEase</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dineease shadow-sm">
        <div class="container">
            <a class="navbar-brand brand-font fw-bold" href="index.php">DineEase</a>
            <a href="index.php" class="btn btn-sm btn-outline-light rounded-pill px-3">Kembali ke Jadwal</a>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card card-dineease overflow-hidden">
                    <div class="row g-0">
                        <div class="col-md-5 panel-brand-side d-flex flex-column justify-content-between">
                            <div>
                                <span class="badge rounded-pill px-3 py-1 mb-3" style="background-color: rgba(212, 163, 115, 0.22); color: #f5d7b5;">
                                    Profil Pelanggan
                                </span>
                                <h3 class="fw-bold mb-2"><?= htmlspecialchars($profil['nama_lengkap']) ?></h3>
                                <p class="small mb-0" style="color: #eadfd4;">
                                    Pastikan nomor telepon aktif agar staf restoran mudah menghubungi saat konfirmasi kedatangan.
                                </p>
                            </div>
                            <div class="small pt-3 mt-4" style="border-top: 1px solid rgba(255,255,255,0.14); color: #dccab8;">
                                ID Anggota #<?= (int) $profil['id_pengguna'] ?>
                            </div>
                        </div>

                        <div class="col-md-7 p-4 p-md-5">
                            <h4 class="fw-bold mb-3">Informasi Akun</h4>

                            <?php if (isset($_GET['pesan']) && $_GET['pesan'] == 'akun_diperbarui'): ?>
                                <div class="alert alert-success py-2 small">Data profil berhasil diperbarui!</div>
                            <?php endif; ?>

                            <div class="p-3 rounded-3 mb-4 kotak-detail-reservasi">
                                <div class="mb-2">
                                    <span class="text-muted small d-block">Nama Lengkap</span>
                                    <strong><?= htmlspecialchars($profil['nama_lengkap']) ?></strong>
                                </div>
                                <div class="mb-2">
                                    <span class="text-muted small d-block">Alamat Email</span>
                                    <strong><?= htmlspecialchars($profil['email']) ?></strong>
                                </div>
                                <div>
                                    <span class="text-muted small d-block">Nomor Telepon</span>
                                    <strong><?= htmlspecialchars($profil['no_telepon']) ?></strong>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <a href="edit_akun.php" class="btn btn-utama py-2">Ubah Data Profil</a>
                                <a href="index.php" class="btn btn-outline-secondary">Kembali ke Dashboard</a>
                                <a href="backend/proses_hapus_akun.php" class="btn btn-outline-danger mt-2"
                                   onclick="return confirm('Hapus akun permanen? Semua data reservasi Anda juga akan terhapus.')">Hapus Akun Permanen</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
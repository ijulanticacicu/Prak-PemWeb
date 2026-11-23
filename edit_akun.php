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
    <title>Edit Profil - DineEase</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dineease shadow-sm">
        <div class="container">
            <a class="navbar-brand brand-font fw-bold" href="index.php">DineEase</a>
            <a href="akun.php" class="btn btn-sm btn-outline-light rounded-pill px-3">Kembali ke Profil</a>
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
                                    Pengaturan Akun
                                </span>
                                <h3 class="fw-bold mb-2">Perbarui Identitas Anda</h3>
                                <p class="small mb-0" style="color: #eadfd4;">
                                    Biarkan kolom kata sandi baru tetap kosong jika Anda tidak ingin mengganti kata sandi saat ini.
                                </p>
                            </div>
                        </div>

                        <div class="col-md-7 p-4 p-md-5">
                            <h4 class="fw-bold mb-3">Edit Profil Akun</h4>

                            <?php if(isset($_GET['pesan']) && $_GET['pesan'] == 'gagal'): ?>
                                <div class="alert alert-danger py-2 small">Gagal memperbarui profil. Email mungkin sudah digunakan.</div>
                            <?php endif; ?>

                            <form action="backend/proses_edit_akun.php" method="POST">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Nama Lengkap</label>
                                    <input type="text" name="nama_lengkap" class="form-control" value="<?= htmlspecialchars($profil['nama_lengkap']) ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Email</label>
                                    <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($profil['email']) ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Nomor Telepon</label>
                                    <input type="text" name="no_telepon" class="form-control" value="<?= htmlspecialchars($profil['no_telepon']) ?>" required>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Kata Sandi Baru (Opsional)</label>
                                    <input type="password" name="password_baru" class="form-control" minlength="6" placeholder="Kosongkan jika tidak diubah">
                                </div>
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="akun.php" class="btn btn-outline-secondary px-4">Batal</a>
                                    <button type="submit" class="btn btn-utama px-4">Simpan Perubahan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
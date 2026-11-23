<?php
    session_start();
    if(isset($_SESSION['id_pengguna'])){
        header("Location: index.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - DineEase</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body class="d-flex align-items-center py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                <div class="card card-dineease overflow-hidden">
                    <div class="row g-0">
                        <div class="col-md-5 panel-brand-side d-flex flex-column justify-content-between">
                            <div>
                                <span class="badge rounded-pill px-3 py-1 mb-3" style="background-color: rgba(212, 163, 115, 0.22); color: #f5d7b5;">
                                    Keanggotaan DineEase
                                </span>
                                <h2 class="fw-bold mb-3">Pengalaman Bersantap Tanpa Antre.</h2>
                                <p class="small mb-0" style="color: #eadfd4; line-height: 1.65;">
                                    Satu akun untuk mengelola seluruh jadwal reservasi meja keluarga, pertemuan bisnis, maupun perayaan spesial Anda.
                                </p>
                            </div>
                            <div class="small pt-4 mt-4" style="border-top: 1px solid rgba(255,255,255,0.14); color: #dccab8;">
                                Pilihan Zona: Indoor, Outdoor, VIP &amp; Jendela
                            </div>
                        </div>

                        <div class="col-md-7 p-4 p-md-5 d-flex flex-column justify-content-center">
                            <h3 class="fw-bold mb-1">Buat Akun Baru</h3>
                            <p class="text-muted small mb-4">Lengkapi data diri Anda untuk mulai memesan meja.</p>

                            <?php if(isset($_GET['pesan'])): ?>
                                <?php if($_GET['pesan'] == 'email_terdaftar'): ?>
                                    <div class="alert alert-warning py-2 small">Email sudah terdaftar, silakan gunakan email lain.</div>
                                <?php elseif($_GET['pesan'] == 'akun_dihapus'): ?>
                                    <div class="alert alert-secondary py-2 small">Akun Anda telah berhasil dihapus permanen.</div>
                                <?php elseif($_GET['pesan'] == 'gagal'): ?>
                                    <div class="alert alert-danger py-2 small">Terjadi kesalahan saat mendaftar. Coba lagi.</div>
                                <?php endif; ?>
                            <?php endif; ?>

                            <form action="backend/proses_daftar.php" method="POST">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Nama Lengkap</label>
                                    <input type="text" name="nama_lengkap" class="form-control" placeholder="Contoh: Budi Santoso" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="nama@email.com" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Nomor Telepon</label>
                                    <input type="text" name="no_telepon" class="form-control" placeholder="08xxxxxxxxxx" required>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Kata Sandi</label>
                                    <input type="password" name="password" class="form-control" minlength="6" placeholder="Minimal 6 karakter" required>
                                </div>
                                <button type="submit" class="btn btn-utama w-100 py-2">Daftar Sekarang</button>
                            </form>

                            <p class="text-center mt-4 mb-0 small text-muted">
                                Sudah punya akun? <a href="login.php" class="fw-semibold text-decoration-none" style="color: var(--terakota);">Masuk di sini</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
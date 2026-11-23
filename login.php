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
    <title>Masuk - DineEase</title>
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
                                    DineEase Table Booking
                                </span>
                                <h2 class="fw-bold mb-3">Meja Siap Menanti Kehadiran Anda.</h2>
                                <p class="small mb-0" style="color: #eadfd4; line-height: 1.65;">
                                    Atur jadwal duduk lebih awal, pilih area favorit seperti taman atau ruang privat, dan ubah jadwal kapan saja tanpa ribet.
                                </p>
                            </div>
                            <div class="small pt-4 mt-4" style="border-top: 1px solid rgba(255,255,255,0.14); color: #dccab8;">
                                Buka setiap hari: 10.00 – 22.00 WIB
                            </div>
                        </div>

                        <div class="col-md-7 p-4 p-md-5 d-flex flex-column justify-content-center">
                            <h3 class="fw-bold mb-1">Masuk ke Akun</h3>
                            <p class="text-muted small mb-4">Silakan masukkan email dan kata sandi Anda.</p>

                            <?php if(isset($_GET['pesan'])): ?>
                                <?php if($_GET['pesan'] == 'gagal_login'): ?>
                                    <div class="alert alert-danger py-2 small">Email atau kata sandi tidak sesuai.</div>
                                <?php elseif($_GET['pesan'] == 'daftar_berhasil'): ?>
                                    <div class="alert alert-success py-2 small">Akun berhasil dibuat! Silakan masuk.</div>
                                <?php elseif($_GET['pesan'] == 'logout'): ?>
                                    <div class="alert alert-info py-2 small">Sesi Anda telah berakhir.</div>
                                <?php endif; ?>
                            <?php endif; ?>

                            <form action="backend/proses_login.php" method="POST">
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Email</label>
                                    <input type="email" name="email" class="form-control" placeholder="nama@email.com" required>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Kata Sandi</label>
                                    <input type="password" name="password" class="form-control" placeholder="Masukkan kata sandi" required>
                                </div>
                                <button type="submit" class="btn btn-utama w-100 py-2">Masuk Sekarang</button>
                            </form>

                            <p class="text-center mt-4 mb-0 small text-muted">
                                Belum memiliki akun? <a href="daftar.php" class="fw-semibold text-decoration-none" style="color: var(--terakota);">Daftar Akun Baru</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
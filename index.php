<?php
    session_start();
    include 'backend/koneksi.php';

    if(!isset($_SESSION['id_pengguna'])){
        header("Location: login.php");
        exit();
    }

    $id_pengguna = $_SESSION['id_pengguna'];
    $query_reservasi = "SELECT * FROM reservasi WHERE id_pengguna = '$id_pengguna' ORDER BY tanggal_reservasi ASC, waktu_reservasi ASC";
    $hasil_reservasi = mysqli_query($koneksi, $query_reservasi);

    $daftar_data = [];
    $total_tamu = 0;
    while($baris = mysqli_fetch_assoc($hasil_reservasi)){
        $daftar_data[] = $baris;
        $total_tamu += (int) $baris['jumlah_tamu'];
    }
    $total_reservasi = count($daftar_data);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Reservasi - DineEase</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dineease shadow-sm">
        <div class="container">
            <a class="navbar-brand brand-font fw-bold" href="index.php">DineEase</a>
            <div class="d-flex align-items-center gap-3">
                <a href="akun.php" class="nav-link fw-medium">Halo, <?= htmlspecialchars($_SESSION['nama_lengkap']) ?></a>
                <a href="backend/proses_logout.php" class="btn btn-sm btn-outline-light rounded-pill px-3">Keluar</a>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div>
                <span class="badge badge-area rounded-pill px-3 py-1 mb-2">Manajemen Meja Restoran</span>
                <h2 class="fw-bold mb-1">Jadwal Reservasi Meja</h2>
                <p class="text-muted mb-0">Atur waktu kedatangan, jumlah tamu, dan area duduk favorit Anda.</p>
            </div>
            <a href="tambah_reservasi.php" class="btn btn-utama px-4 py-2">+ Reservasi Meja Baru</a>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="stat-box">
                    <div class="text-muted small">Total Reservasi Aktif</div>
                    <div class="stat-angka"><?= $total_reservasi ?> <span class="fs-6 fw-normal text-muted">Jadwal</span></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="stat-box" style="border-left-color: #d4a373;">
                    <div class="text-muted small">Akumulasi Tamu Terdaftar</div>
                    <div class="stat-angka"><?= $total_tamu ?> <span class="fs-6 fw-normal text-muted">Orang</span></div>
                </div>
            </div>
        </div>

        <?php if(isset($_GET['pesan'])): ?>
            <div class="alert alert-success alert-dismissible fade show rounded-3 border-0 shadow-sm" role="alert">
                <?php
                if($_GET['pesan'] == 'reservasi_berhasil') echo "Reservasi meja berhasil ditambahkan!";
                elseif($_GET['pesan'] == 'ubah_berhasil') echo "Detail reservasi berhasil diperbarui!";
                elseif($_GET['pesan'] == 'hapus_berhasil') echo "Reservasi telah dibatalkan.";
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <div class="row g-4">
            <?php if($total_reservasi > 0): ?>
                <?php foreach ($daftar_data as $data): ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card card-dineease card-reservasi h-100 p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge badge-area px-3 py-2 rounded-pill"><?= htmlspecialchars($data['area_meja']) ?></span>
                                <span class="badge badge-status-aktif px-2 py-1 rounded-pill"><?= htmlspecialchars($data['status_reservasi']) ?></span>
                            </div>

                            <h5 class="fw-bold mb-1"><?= htmlspecialchars($data['nama_pemesan']) ?></h5>
                            <p class="text-muted small mb-3">
                                <?= date('d M Y', strtotime($data['tanggal_reservasi'])) ?> &bull; Pukul <?= date('H:i', strtotime($data['waktu_reservasi'])) ?> WIB
                            </p>

                            <div class="p-3 rounded-3 mb-3 small kotak-detail-reservasi">
                                <div class="mb-1"><strong>Kapasitas Tamu:</strong> <?= (int) $data['jumlah_tamu'] ?> Orang</div>
                                <div><strong>Catatan:</strong> <?= !empty($data['catatan_khusus']) ? htmlspecialchars($data['catatan_khusus']) : 'Tidak ada catatan khusus' ?></div>
                            </div>

                            <div class="mt-auto d-flex gap-2 pt-1">
                                <a href="edit_reservasi.php?id=<?= (int) $data['id_reservasi'] ?>" class="btn btn-sm btn-outline-dark w-50 rounded-3">Ubah Jadwal</a>
                                <a href="backend/proses_hapus_reservasi.php?id=<?= (int) $data['id_reservasi'] ?>"
                                   class="btn btn-sm btn-outline-danger w-50 rounded-3"
                                   onclick="return confirm('Batalkan reservasi atas nama <?= htmlspecialchars($data['nama_pemesan']) ?>?')">Batalkan</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="card card-dineease p-5 text-center">
                        <h4 class="fw-bold mb-2">Belum Ada Reservasi Meja</h4>
                        <p class="text-muted mb-4">Pesan meja sesuai suasana yang Anda inginkan sebelum datang ke restoran.</p>
                        <div>
                            <a href="tambah_reservasi.php" class="btn btn-utama px-4 py-2">Buat Reservasi Pertama</a>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
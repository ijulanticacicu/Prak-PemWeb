<?php
    session_start();
    if(!isset($_SESSION['id_pengguna'])){
        header("Location: login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Reservasi Meja - DineEase</title>
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
        <div class="row g-4 align-items-start">
            <div class="col-lg-7">
                <div class="card card-dineease p-4 p-md-5">
                    <h3 class="fw-bold mb-1">Formulir Reservasi Meja</h3>
                    <p class="text-muted small mb-4">Lengkapi detail kedatangan Anda (khusus layanan reservasi meja).</p>

                    <form action="backend/proses_tambah_reservasi.php" method="POST" onsubmit="return validasiReservasi()">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Nama Pemesan</label>
                            <input type="text" id="input_nama" name="nama_pemesan" class="form-control"
                                   value="<?= htmlspecialchars($_SESSION['nama_lengkap']) ?>" oninput="perbaruiPratinjau()" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Tanggal Kedatangan</label>
                                <input type="date" id="input_tanggal" name="tanggal_reservasi" class="form-control"
                                       min="<?= date('Y-m-d') ?>" onchange="perbaruiPratinjau()" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Jam Kedatangan</label>
                                <input type="time" id="input_waktu" name="waktu_reservasi" class="form-control"
                                       min="10:00" max="21:30" onchange="perbaruiPratinjau()" required>
                                <div class="form-text small">Jam layanan reservasi: 10:00 – 21:30 WIB</div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Jumlah Tamu</label>
                                <input type="number" id="input_tamu" name="jumlah_tamu" class="form-control"
                                       min="1" max="20" value="2" oninput="perbaruiPratinjau()" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Pilihan Area Meja</label>
                                <select id="input_area" name="area_meja" class="form-select" onchange="perbaruiPratinjau()" required>
                                    <option value="Indoor Reguler">Indoor Reguler</option>
                                    <option value="Outdoor Taman">Outdoor Taman</option>
                                    <option value="VIP Room">VIP Room</option>
                                    <option value="Area Dekat Jendela">Area Dekat Jendela</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Catatan Tambahan (Opsional)</label>
                            <textarea id="input_catatan" name="catatan_khusus" class="form-control" rows="2"
                                      placeholder="Contoh: Kursi anak, meja sudut tenang, acara keluarga..." oninput="perbaruiPratinjau()"></textarea>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="index.php" class="btn btn-outline-secondary px-4">Batal</a>
                            <button type="submit" class="btn btn-utama px-4">Simpan Reservasi</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card card-dineease p-4">
                    <div class="text-muted small text-uppercase fw-semibold mb-2">Pratinjau Kartu Reservasi</div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span id="preview_area" class="badge badge-area px-3 py-2 rounded-pill">Indoor Reguler</span>
                        <span class="badge badge-status-aktif px-2 py-1 rounded-pill">Terkonfirmasi</span>
                    </div>
                    <h5 id="preview_nama" class="fw-bold mb-1"><?= htmlspecialchars($_SESSION['nama_lengkap']) ?></h5>
                    <p id="preview_waktu" class="text-muted small mb-3">Pilih tanggal &amp; jam kedatangan</p>
                    <div class="p-3 rounded-3 small kotak-detail-reservasi">
                        <div class="mb-1"><strong>Kapasitas Tamu:</strong> <span id="preview_tamu">2 Orang</span></div>
                        <div><strong>Catatan:</strong> <span id="preview_catatan">Tidak ada catatan khusus</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function perbaruiPratinjau(){
            const nama = document.getElementById('input_nama').value.trim() || 'Nama Pemesan';
            const tanggal = document.getElementById('input_tanggal').value;
            const waktu = document.getElementById('input_waktu').value;
            const tamu = document.getElementById('input_tamu').value || 1;
            const area = document.getElementById('input_area').value;
            const catatan = document.getElementById('input_catatan').value.trim();

            document.getElementById('preview_nama').textContent = nama;
            document.getElementById('preview_area').textContent = area;
            document.getElementById('preview_tamu').textContent = tamu + ' Orang';
            document.getElementById('preview_catatan').textContent = catatan !== '' ? catatan : 'Tidak ada catatan khusus';

            let infoWaktu = 'Pilih tanggal & jam kedatangan';
            if(tanggal && waktu){
                infoWaktu = tanggal + ' • Pukul ' + waktu + ' WIB';
            }else if(tanggal){
                infoWaktu = tanggal;
            }else if(waktu){
                infoWaktu = 'Pukul ' + waktu + ' WIB';
            }
            document.getElementById('preview_waktu').textContent = infoWaktu;
        }

        function validasiReservasi(){
            const tamu = parseInt(document.getElementById('input_tamu').value, 10);
            if(isNaN(tamu) || tamu < 1 || tamu > 20){
                alert("Jumlah tamu per reservasi harus antara 1 hingga 20 orang.");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
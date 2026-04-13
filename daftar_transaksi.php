<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Transaksi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .stat-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
            transition: transform 0.2s;
        }
        .stat-card:hover {
            transform: translateY(-3px);
        }
        .stat-card .card-body {
            padding: 20px 24px;
        }
        .stat-icon {
            font-size: 2rem;
            margin-bottom: 8px;
        }
        .stat-number {
            font-size: 2rem;
            font-weight: 700;
        }
        .table-container {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
            padding: 24px;
        }
        .table thead th {
            background-color: #343a40;
            color: #fff;
            border: none;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .table tbody tr {
            transition: background 0.15s;
        }
        .table tbody tr:hover {
            background-color: #f0f4ff;
        }
        .badge-dipinjam {
            background-color: #fff3cd;
            color: #856404;
            font-weight: 600;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.8rem;
        }
        .badge-dikembalikan {
            background-color: #d4edda;
            color: #155724;
            font-weight: 600;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.8rem;
        }
        .info-note {
            background: #e8f4fd;
            border-left: 4px solid #2196F3;
            padding: 12px 16px;
            border-radius: 6px;
            font-size: 0.9rem;
            color: #1565c0;
        }
    </style>
</head>
<body>
    <div class="container mt-5 mb-5">
        <h1 class="mb-2 fw-bold">📋 Daftar Transaksi Peminjaman</h1>
        <p class="text-muted mb-4">Riwayat transaksi peminjaman buku perpustakaan</p>

        <?php
        // ============================================
        // LOOP PERTAMA: Hitung statistik
        // ============================================
        $total_transaksi = 0;
        $total_dipinjam = 0;
        $total_dikembalikan = 0;

        for ($i = 1; $i <= 10; $i++) {
            // Skip transaksi genap (CONTINUE)
            if ($i % 2 == 0) {
                continue;
            }

            // Stop di transaksi ke-8 (BREAK)
            if ($i > 8) {
                break;
            }

            $status = ($i % 3 == 0) ? "Dikembalikan" : "Dipinjam";
            $total_transaksi++;

            if ($status == "Dipinjam") {
                $total_dipinjam++;
            } else {
                $total_dikembalikan++;
            }
        }
        ?>

        <!-- Statistik Cards -->
        <div class="row mb-4 g-3">
            <div class="col-md-4">
                <div class="card stat-card border-start border-4 border-primary">
                    <div class="card-body">
                        <div class="stat-icon">📊</div>
                        <div class="stat-number text-primary"><?= $total_transaksi ?></div>
                        <div class="text-muted fw-semibold">Total Transaksi Ditampilkan</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card border-start border-4 border-warning">
                    <div class="card-body">
                        <div class="stat-icon">📖</div>
                        <div class="stat-number text-warning"><?= $total_dipinjam ?></div>
                        <div class="text-muted fw-semibold">Masih Dipinjam</div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card stat-card border-start border-4 border-success">
                    <div class="card-body">
                        <div class="stat-icon">✅</div>
                        <div class="stat-number text-success"><?= $total_dikembalikan ?></div>
                        <div class="text-muted fw-semibold">Sudah Dikembalikan</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Info Note -->
        <div class="info-note mb-4">
            ℹ️ <strong>Catatan:</strong> Transaksi genap di-<em>skip</em> menggunakan <code>CONTINUE</code>, dan loop berhenti di transaksi ke-8 menggunakan <code>BREAK</code>.
        </div>

        <!-- Tabel Transaksi -->
        <div class="table-container">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Transaksi</th>
                        <th>Peminjam</th>
                        <th>Buku</th>
                        <th>Tgl Pinjam</th>
                        <th>Tgl Kembali</th>
                        <th>Hari</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // ============================================
                    // LOOP KEDUA: Tampilkan data dalam tabel
                    // ============================================
                    $nomor = 0;

                    for ($i = 1; $i <= 10; $i++) {
                        // Skip transaksi genap dengan CONTINUE
                        if ($i % 2 == 0) {
                            continue;
                        }

                        // Stop di transaksi ke-8 dengan BREAK
                        if ($i > 8) {
                            break;
                        }

                        // Generate data transaksi
                        $id_transaksi = "TRX-" . str_pad($i, 4, "0", STR_PAD_LEFT);
                        $nama_peminjam = "Anggota " . $i;
                        $judul_buku = "Buku Teknologi Vol. " . $i;
                        $tanggal_pinjam = date('Y-m-d', strtotime("-$i days"));
                        $tanggal_kembali = date('Y-m-d', strtotime("+7 days", strtotime($tanggal_pinjam)));
                        $status = ($i % 3 == 0) ? "Dikembalikan" : "Dipinjam";

                        // Hitung jumlah hari sejak pinjam
                        $tgl_pinjam_obj = new DateTime($tanggal_pinjam);
                        $tgl_sekarang = new DateTime(date('Y-m-d'));
                        $selisih_hari = $tgl_sekarang->diff($tgl_pinjam_obj)->days;

                        $nomor++;

                        // Tentukan badge class berdasarkan status
                        $badge_class = ($status == "Dikembalikan") ? "badge-dikembalikan" : "badge-dipinjam";
                        $badge_icon = ($status == "Dikembalikan") ? "✅" : "📖";
                    ?>
                    <tr>
                        <td class="fw-bold"><?= $nomor ?></td>
                        <td><code><?= $id_transaksi ?></code></td>
                        <td><?= $nama_peminjam ?></td>
                        <td><?= $judul_buku ?></td>
                        <td><?= $tanggal_pinjam ?></td>
                        <td><?= $tanggal_kembali ?></td>
                        <td>
                            <span class="badge bg-light text-dark border"><?= $selisih_hari ?> hari</span>
                        </td>
                        <td>
                            <span class="<?= $badge_class ?>"><?= $badge_icon ?> <?= $status ?></span>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <p class="text-muted text-center mt-4 small">
            &copy; <?= date('Y') ?> Perpustakaan Digital — Sistem Manajemen Peminjaman
        </p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

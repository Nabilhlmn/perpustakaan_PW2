<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Anggota Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --bs-body-bg: #0f172a;
            --bs-body-color: #e2e8f0;
        }

        body {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: #e2e8f0;
            min-height: 100vh;
        }

        .card {
            background: rgba(30, 41, 59, 0.85);
            border: 1px solid rgba(148, 163, 184, 0.12);
            backdrop-filter: blur(12px);
        }

        .card-header {
            border-bottom: 1px solid rgba(148, 163, 184, 0.12);
        }

        .stat-card {
            border-radius: 16px;
            padding: 24px;
            text-align: center;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.4);
        }

        .stat-card .icon {
            font-size: 2rem;
            margin-bottom: 8px;
        }

        .stat-card .value {
            font-size: 1.75rem;
            font-weight: 700;
        }

        .stat-card .label {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.7;
            margin-top: 4px;
        }

        .table-dark {
            --bs-table-bg: transparent;
            --bs-table-border-color: rgba(148, 163, 184, 0.1);
        }

        .table-dark thead th {
            background: rgba(255, 255, 255, 0.05);
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #94a3b8;
        }

        .table-dark tbody tr:hover {
            background: rgba(255, 255, 255, 0.04);
        }

        .badge-aktif {
            background: rgba(34, 197, 94, 0.15);
            border: 1px solid rgba(34, 197, 94, 0.4);
            color: #4ade80;
        }

        .badge-nonaktif {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.4);
            color: #f87171;
        }

        .trophy-card {
            background: linear-gradient(135deg, rgba(168, 85, 247, 0.12), rgba(236, 72, 153, 0.12));
            border: 1px solid rgba(168, 85, 247, 0.25);
            border-radius: 16px;
        }

        .search-box {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(148, 163, 184, 0.2);
            border-radius: 12px;
            padding: 14px 20px;
        }

        .form-control, .form-select {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(148, 163, 184, 0.2);
            color: #e2e8f0;
        }

        .form-control:focus, .form-select:focus {
            background: rgba(255, 255, 255, 0.1);
            border-color: #6366f1;
            color: #e2e8f0;
            box-shadow: 0 0 0 0.2rem rgba(99, 102, 241, 0.25);
        }

        .form-control::placeholder { color: #64748b; }

        .form-select option { background: #1e293b; color: #e2e8f0; }

        .section-title {
            font-size: 1.1rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding-bottom: 8px;
            border-bottom: 2px solid rgba(99, 102, 241, 0.4);
            display: inline-block;
            margin-bottom: 16px;
        }

        .list-group-item {
            background: rgba(255, 255, 255, 0.04);
            border-color: rgba(148, 163, 184, 0.1);
            color: #e2e8f0;
        }

        .list-group-item:hover {
            background: rgba(255, 255, 255, 0.08);
        }

        .email-valid { color: #4ade80; }
        .email-invalid { color: #f87171; }
    </style>
</head>
<body>
    <?php
    // Include functions
    require_once 'functions_anggota.php';

    // Data anggota (minimal 5)
    $anggota_list = [
        [
            "id" => "AGT-001",
            "nama" => "Budi Santoso",
            "email" => "budi@email.com",
            "telepon" => "081234567890",
            "alamat" => "Jakarta",
            "tanggal_daftar" => "2024-01-15",
            "status" => "Aktif",
            "total_pinjaman" => 5
        ],
        [
            "id" => "AGT-002",
            "nama" => "Siti Rahayu",
            "email" => "siti@email.com",
            "telepon" => "081298765432",
            "alamat" => "Bandung",
            "tanggal_daftar" => "2024-02-20",
            "status" => "Aktif",
            "total_pinjaman" => 12
        ],
        [
            "id" => "AGT-003",
            "nama" => "Ahmad Fauzi",
            "email" => "ahmad@email.com",
            "telepon" => "085312345678",
            "alamat" => "Surabaya",
            "tanggal_daftar" => "2024-03-10",
            "status" => "Non-Aktif",
            "total_pinjaman" => 3
        ],
        [
            "id" => "AGT-004",
            "nama" => "Dewi Lestari",
            "email" => "dewi@email.com",
            "telepon" => "087654321098",
            "alamat" => "Yogyakarta",
            "tanggal_daftar" => "2024-04-05",
            "status" => "Aktif",
            "total_pinjaman" => 8
        ],
        [
            "id" => "AGT-005",
            "nama" => "Rizky Pratama",
            "email" => "rizky@email.com",
            "telepon" => "089876543210",
            "alamat" => "Semarang",
            "tanggal_daftar" => "2024-05-18",
            "status" => "Non-Aktif",
            "total_pinjaman" => 1
        ],
    ];

    // --- Gunakan semua functions ---
    $total_anggota      = hitung_total_anggota($anggota_list);
    $jumlah_aktif       = hitung_anggota_aktif($anggota_list);
    $jumlah_nonaktif    = $total_anggota - $jumlah_aktif;
    $persen_aktif       = ($total_anggota > 0) ? ($jumlah_aktif / $total_anggota) * 100 : 0;
    $persen_nonaktif    = ($total_anggota > 0) ? ($jumlah_nonaktif / $total_anggota) * 100 : 0;
    $rata_rata          = hitung_rata_rata_pinjaman($anggota_list);
    $anggota_teraktif   = cari_anggota_teraktif($anggota_list);
    $anggota_aktif_list = filter_by_status($anggota_list, "Aktif");
    $anggota_nonak_list = filter_by_status($anggota_list, "Non-Aktif");

    // --- Bonus: Search & Sort ---
    $keyword = isset($_GET['search']) ? trim($_GET['search']) : '';
    $sort    = isset($_GET['sort']) ? $_GET['sort'] : '';

    $anggota_tampil = $anggota_list;

    if ($keyword !== '') {
        $anggota_tampil = search_by_nama($anggota_tampil, $keyword);
    }

    if ($sort === 'nama') {
        $anggota_tampil = sort_by_nama($anggota_tampil);
    }
    ?>

    <div class="container py-5">
        <!-- Header -->
        <h1 class="mb-4 text-center">
            <i class="bi bi-people-fill" style="color:#6366f1;"></i>
            Sistem Anggota Perpustakaan
        </h1>

        <!-- ====== Dashboard Statistik ====== -->
        <div class="row g-3 mb-4">
            <div class="col-6 col-md-4 col-lg">
                <div class="stat-card card">
                    <div class="icon">👥</div>
                    <div class="value" style="color:#60a5fa;"><?= $total_anggota ?></div>
                    <div class="label">Total Anggota</div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg">
                <div class="stat-card card">
                    <div class="icon">✅</div>
                    <div class="value" style="color:#4ade80;"><?= $jumlah_aktif ?> <small style="font-size:0.55em">(<?= number_format($persen_aktif, 0) ?>%)</small></div>
                    <div class="label">Anggota Aktif</div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg">
                <div class="stat-card card">
                    <div class="icon">🚫</div>
                    <div class="value" style="color:#f87171;"><?= $jumlah_nonaktif ?> <small style="font-size:0.55em">(<?= number_format($persen_nonaktif, 0) ?>%)</small></div>
                    <div class="label">Non-Aktif</div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg">
                <div class="stat-card card">
                    <div class="icon">📖</div>
                    <div class="value" style="color:#fbbf24;"><?= number_format($rata_rata, 1) ?></div>
                    <div class="label">Rata-rata Pinjaman</div>
                </div>
            </div>
            <div class="col-12 col-md-8 col-lg">
                <div class="stat-card card">
                    <div class="icon">🏆</div>
                    <div class="value" style="color:#c084fc;"><?= htmlspecialchars($anggota_teraktif["nama"]) ?></div>
                    <div class="label">Anggota Teraktif (<?= $anggota_teraktif["total_pinjaman"] ?> pinjaman)</div>
                </div>
            </div>
        </div>

        <!-- ====== Search & Sort (BONUS) ====== -->
        <div class="search-box d-flex flex-wrap gap-2 align-items-center mb-4">
            <form class="d-flex gap-2 flex-grow-1 flex-wrap" method="GET">
                <div class="input-group" style="max-width:360px;">
                    <span class="input-group-text bg-transparent border-end-0" style="border-color:rgba(148,163,184,0.2); color:#94a3b8;">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" name="search" class="form-control border-start-0" placeholder="Cari nama anggota..." value="<?= htmlspecialchars($keyword) ?>" style="border-color:rgba(148,163,184,0.2);">
                </div>
                <select name="sort" class="form-select" style="max-width:200px;">
                    <option value="">Urutkan...</option>
                    <option value="nama" <?= $sort === 'nama' ? 'selected' : '' ?>>Nama (A-Z)</option>
                </select>
                <button type="submit" class="btn btn-primary"><i class="bi bi-funnel"></i> Terapkan</button>
                <a href="sistem_anggota.php" class="btn btn-outline-secondary">Reset</a>
            </form>
        </div>

        <!-- ====== Tabel Semua Anggota ====== -->
        <div class="card mb-4">
            <div class="card-header" style="background:rgba(99,102,241,0.15);">
                <h5 class="mb-0" style="color:#818cf8;">
                    <i class="bi bi-table"></i> Daftar Anggota
                    <?php if ($keyword !== ''): ?>
                        <small class="ms-2" style="font-size:0.75em; opacity:0.7;">— hasil pencarian "<?= htmlspecialchars($keyword) ?>"</small>
                    <?php endif; ?>
                    <span class="badge rounded-pill ms-2" style="background:rgba(99,102,241,0.3); font-size:0.7em;"><?= count($anggota_tampil) ?> orang</span>
                </h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-dark table-hover mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Telepon</th>
                                <th>Alamat</th>
                                <th>Tgl Daftar</th>
                                <th>Status</th>
                                <th>Pinjaman</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (count($anggota_tampil) === 0): ?>
                                <tr><td colspan="9" class="text-center py-4 text-muted">Tidak ada anggota ditemukan.</td></tr>
                            <?php else: ?>
                                <?php $no = 1; foreach ($anggota_tampil as $a): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><code><?= htmlspecialchars($a["id"]) ?></code></td>
                                    <td class="fw-semibold text-white"><?= htmlspecialchars($a["nama"]) ?></td>
                                    <td>
                                        <?= htmlspecialchars($a["email"]) ?>
                                        <?php if (validasi_email($a["email"])): ?>
                                            <i class="bi bi-check-circle-fill email-valid ms-1" title="Email valid"></i>
                                        <?php else: ?>
                                            <i class="bi bi-x-circle-fill email-invalid ms-1" title="Email tidak valid"></i>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= htmlspecialchars($a["telepon"]) ?></td>
                                    <td><?= htmlspecialchars($a["alamat"]) ?></td>
                                    <td><?= format_tanggal_indo($a["tanggal_daftar"]) ?></td>
                                    <td>
                                        <span class="badge rounded-pill <?= $a['status'] === 'Aktif' ? 'badge-aktif' : 'badge-nonaktif' ?>">
                                            <?= $a["status"] ?>
                                        </span>
                                    </td>
                                    <td class="fw-bold"><?= $a["total_pinjaman"] ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- ====== Anggota Teraktif Card ====== -->
        <div class="card trophy-card mb-4">
            <div class="card-header" style="background:transparent; border-bottom:1px solid rgba(168,85,247,0.2);">
                <h5 class="mb-0" style="color:#c084fc;">
                    <i class="bi bi-trophy-fill"></i> Anggota Teraktif
                </h5>
            </div>
            <div class="card-body d-flex align-items-center gap-4 flex-wrap">
                <div style="font-size:3rem;">🏆</div>
                <div class="flex-grow-1">
                    <h4 class="mb-1" style="color:#c084fc;"><?= htmlspecialchars($anggota_teraktif["nama"]) ?></h4>
                    <p class="mb-0 text-muted">
                        <?= $anggota_teraktif["id"] ?> &middot;
                        <?= htmlspecialchars($anggota_teraktif["alamat"]) ?> &middot;
                        Bergabung: <?= format_tanggal_indo($anggota_teraktif["tanggal_daftar"]) ?>
                    </p>
                </div>
                <div class="text-center">
                    <div style="font-size:2.2rem; font-weight:700; color:#c084fc;"><?= $anggota_teraktif["total_pinjaman"] ?></div>
                    <div class="text-muted" style="font-size:0.8rem; text-transform:uppercase; letter-spacing:1px;">Total Pinjaman</div>
                </div>
            </div>
        </div>

        <!-- ====== Daftar Aktif & Non-Aktif Terpisah ====== -->
        <div class="row g-4 mb-5">
            <!-- Anggota Aktif -->
            <div class="col-md-6">
                <h6 class="section-title" style="color:#4ade80; border-color:rgba(34,197,94,0.4);">
                    <i class="bi bi-check-circle-fill"></i> Anggota Aktif (<?= count($anggota_aktif_list) ?>)
                </h6>
                <div class="list-group">
                    <?php foreach ($anggota_aktif_list as $a): ?>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong><?= htmlspecialchars($a["nama"]) ?></strong>
                            <br><small class="text-muted"><?= $a["id"] ?> &middot; <?= htmlspecialchars($a["alamat"]) ?></small>
                        </div>
                        <span class="badge rounded-pill badge-aktif"><?= $a["total_pinjaman"] ?> pinjaman</span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Anggota Non-Aktif -->
            <div class="col-md-6">
                <h6 class="section-title" style="color:#f87171; border-color:rgba(239,68,68,0.4);">
                    <i class="bi bi-x-circle-fill"></i> Anggota Non-Aktif (<?= count($anggota_nonak_list) ?>)
                </h6>
                <div class="list-group">
                    <?php foreach ($anggota_nonak_list as $a): ?>
                    <div class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong><?= htmlspecialchars($a["nama"]) ?></strong>
                            <br><small class="text-muted"><?= $a["id"] ?> &middot; <?= htmlspecialchars($a["alamat"]) ?></small>
                        </div>
                        <span class="badge rounded-pill badge-nonaktif"><?= $a["total_pinjaman"] ?> pinjaman</span>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

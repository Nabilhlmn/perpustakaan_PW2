<?php
// ============================================
// ARRAY ANGGOTA PERPUSTAKAAN
// ============================================

// --- Data Anggota (Multidimensional Array) ---
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

// --- Hitung Statistik ---
$total_anggota = count($anggota_list);

$anggota_aktif = 0;
$anggota_nonaktif = 0;
$total_semua_pinjaman = 0;
$anggota_teraktif = $anggota_list[0]; // inisialisasi dengan anggota pertama

foreach ($anggota_list as $anggota) {
    // Hitung aktif vs non-aktif
    if ($anggota["status"] === "Aktif") {
        $anggota_aktif++;
    } else {
        $anggota_nonaktif++;
    }

    // Jumlahkan total pinjaman
    $total_semua_pinjaman += $anggota["total_pinjaman"];

    // Cari anggota dengan total pinjaman terbanyak
    if ($anggota["total_pinjaman"] > $anggota_teraktif["total_pinjaman"]) {
        $anggota_teraktif = $anggota;
    }
}

$persen_aktif = ($anggota_aktif / $total_anggota) * 100;
$persen_nonaktif = ($anggota_nonaktif / $total_anggota) * 100;
$rata_rata_pinjaman = $total_semua_pinjaman / $total_anggota;

// --- Filter berdasarkan status (dari query string) ---
$filter_status = isset($_GET['status']) ? $_GET['status'] : 'Semua';

$anggota_filtered = [];
foreach ($anggota_list as $anggota) {
    if ($filter_status === 'Semua' || $anggota["status"] === $filter_status) {
        $anggota_filtered[] = $anggota;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Array Anggota - Perpustakaan</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            min-height: 100vh;
            padding: 30px 20px;
            color: #e0e0e0;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
        }

        h1 {
            text-align: center;
            font-size: 1.6rem;
            margin-bottom: 30px;
            color: #e94560;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        /* ---- Statistik Cards ---- */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 16px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 14px;
            padding: 22px 20px;
            text-align: center;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.35);
        }

        .stat-card .icon {
            font-size: 2rem;
            margin-bottom: 8px;
        }

        .stat-card .value {
            font-size: 1.8rem;
            font-weight: 700;
            color: #fff;
        }

        .stat-card .label {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #aaa;
            margin-top: 4px;
        }

        .stat-card.highlight {
            border-color: rgba(233, 69, 96, 0.4);
            background: rgba(233, 69, 96, 0.08);
        }

        .stat-card.highlight .value {
            color: #ff6b6b;
        }

        .stat-card.green .value { color: #69f0ae; }
        .stat-card.yellow .value { color: #ffd54f; }
        .stat-card.blue .value { color: #53d8fb; }
        .stat-card.purple .value { color: #b388ff; }

        /* ---- Filter ---- */
        .filter-bar {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            padding: 14px 20px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .filter-bar span {
            font-size: 0.9rem;
            color: #aaa;
        }

        .filter-bar a {
            text-decoration: none;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            transition: all 0.2s ease;
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: #ccc;
        }

        .filter-bar a:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        .filter-bar a.active {
            background: #e94560;
            border-color: #e94560;
            color: #fff;
        }

        /* ---- Tabel ---- */
        .table-wrapper {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .table-wrapper h2 {
            padding: 18px 24px;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #53d8fb;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            background: rgba(255, 255, 255, 0.08);
            padding: 12px 16px;
            text-align: left;
            font-size: 0.78rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #aaa;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        tbody td {
            padding: 12px 16px;
            font-size: 0.9rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            color: #ddd;
        }

        tbody tr:hover {
            background: rgba(255, 255, 255, 0.04);
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .badge {
            display: inline-block;
            padding: 3px 12px;
            border-radius: 20px;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .badge-aktif {
            background: rgba(0, 200, 83, 0.15);
            border: 1px solid rgba(0, 200, 83, 0.4);
            color: #69f0ae;
        }

        .badge-nonaktif {
            background: rgba(233, 69, 96, 0.15);
            border: 1px solid rgba(233, 69, 96, 0.4);
            color: #ff6b6b;
        }

        .teraktif-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(179, 136, 255, 0.3);
            border-radius: 14px;
            padding: 20px 24px;
            margin-top: 20px;
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .teraktif-card .trophy {
            font-size: 2.4rem;
        }

        .teraktif-card .info {
            flex: 1;
        }

        .teraktif-card .info .name {
            font-size: 1.1rem;
            font-weight: 700;
            color: #b388ff;
        }

        .teraktif-card .info .detail {
            font-size: 0.85rem;
            color: #aaa;
            margin-top: 2px;
        }

        .teraktif-card .count {
            font-size: 1.6rem;
            font-weight: 700;
            color: #b388ff;
        }

        /* ---- Responsif ---- */
        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            table, thead, tbody, th, td, tr {
                display: block;
            }

            thead { display: none; }

            tbody tr {
                margin-bottom: 12px;
                border: 1px solid rgba(255, 255, 255, 0.1);
                border-radius: 10px;
                padding: 12px;
                background: rgba(255, 255, 255, 0.03);
            }

            tbody td {
                padding: 6px 0;
                border-bottom: 1px dashed rgba(255, 255, 255, 0.06);
                display: flex;
                justify-content: space-between;
            }

            tbody td::before {
                content: attr(data-label);
                font-weight: 600;
                color: #aaa;
                font-size: 0.78rem;
                text-transform: uppercase;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>📚 Data Anggota Perpustakaan</h1>

        <!-- ====== Statistik Cards ====== -->
        <div class="stats-grid">
            <div class="stat-card blue">
                <div class="icon">👥</div>
                <div class="value"><?= $total_anggota ?></div>
                <div class="label">Total Anggota</div>
            </div>
            <div class="stat-card green">
                <div class="icon">✅</div>
                <div class="value"><?= $anggota_aktif ?> <small style="font-size:0.6em">(<?= number_format($persen_aktif, 0) ?>%)</small></div>
                <div class="label">Anggota Aktif</div>
            </div>
            <div class="stat-card highlight">
                <div class="icon">🚫</div>
                <div class="value"><?= $anggota_nonaktif ?> <small style="font-size:0.6em">(<?= number_format($persen_nonaktif, 0) ?>%)</small></div>
                <div class="label">Anggota Non-Aktif</div>
            </div>
            <div class="stat-card yellow">
                <div class="icon">📖</div>
                <div class="value"><?= number_format($rata_rata_pinjaman, 1) ?></div>
                <div class="label">Rata-rata Pinjaman</div>
            </div>
            <div class="stat-card purple">
                <div class="icon">🏆</div>
                <div class="value"><?= htmlspecialchars($anggota_teraktif["nama"]) ?></div>
                <div class="label">Anggota Teraktif (<?= $anggota_teraktif["total_pinjaman"] ?> pinjaman)</div>
            </div>
        </div>

        <!-- ====== Filter ====== -->
        <div class="filter-bar">
            <span>🔍 Filter Status:</span>
            <a href="?status=Semua" class="<?= $filter_status === 'Semua' ? 'active' : '' ?>">Semua</a>
            <a href="?status=Aktif" class="<?= $filter_status === 'Aktif' ? 'active' : '' ?>">Aktif</a>
            <a href="?status=Non-Aktif" class="<?= $filter_status === 'Non-Aktif' ? 'active' : '' ?>">Non-Aktif</a>
        </div>

        <!-- ====== Tabel Anggota ====== -->
        <div class="table-wrapper">
            <h2>📋 Daftar Anggota <?= $filter_status !== 'Semua' ? "— Status: $filter_status" : '' ?> (<?= count($anggota_filtered) ?> orang)</h2>
            <table>
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
                    <?php if (count($anggota_filtered) === 0): ?>
                        <tr><td colspan="9" style="text-align:center; padding:24px; color:#aaa;">Tidak ada anggota ditemukan.</td></tr>
                    <?php else: ?>
                        <?php $no = 1; foreach ($anggota_filtered as $a): ?>
                        <tr>
                            <td data-label="No"><?= $no++ ?></td>
                            <td data-label="ID"><?= htmlspecialchars($a["id"]) ?></td>
                            <td data-label="Nama" style="font-weight:600; color:#fff;"><?= htmlspecialchars($a["nama"]) ?></td>
                            <td data-label="Email"><?= htmlspecialchars($a["email"]) ?></td>
                            <td data-label="Telepon"><?= htmlspecialchars($a["telepon"]) ?></td>
                            <td data-label="Alamat"><?= htmlspecialchars($a["alamat"]) ?></td>
                            <td data-label="Tgl Daftar"><?= $a["tanggal_daftar"] ?></td>
                            <td data-label="Status">
                                <span class="badge <?= $a["status"] === 'Aktif' ? 'badge-aktif' : 'badge-nonaktif' ?>">
                                    <?= $a["status"] ?>
                                </span>
                            </td>
                            <td data-label="Pinjaman"><?= $a["total_pinjaman"] ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- ====== Anggota Teraktif ====== -->
        <div class="teraktif-card">
            <div class="trophy">🏆</div>
            <div class="info">
                <div class="name"><?= htmlspecialchars($anggota_teraktif["nama"]) ?></div>
                <div class="detail"><?= $anggota_teraktif["id"] ?> · <?= $anggota_teraktif["alamat"] ?> · Daftar: <?= $anggota_teraktif["tanggal_daftar"] ?></div>
            </div>
            <div class="count"><?= $anggota_teraktif["total_pinjaman"] ?> buku</div>
        </div>
    </div>
</body>
</html>

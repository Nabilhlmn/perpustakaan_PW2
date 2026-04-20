<?php
// ============================================================
// Tugas 2: Sistem Pencarian Buku Lanjutan (60%)
// Pertemuan 5 - Form Handling
// ============================================================

// Function sanitasi input
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Function highlight keyword pada teks
function highlight_keyword($text, $keyword) {
    if (empty($keyword)) return $text;
    return preg_replace('/(' . preg_quote($keyword, '/') . ')/i', '<mark class="bg-warning px-0">$1</mark>', $text);
}

// Data buku (minimal 10 buku)
$buku_list = [
    [
        "kode" => "BK-001",
        "judul" => "Pemrograman PHP untuk Pemula",
        "kategori" => "Programming",
        "pengarang" => "Budi Raharjo",
        "penerbit" => "Informatika",
        "tahun" => 2023,
        "harga" => 75000,
        "stok" => 10
    ],
    [
        "kode" => "BK-002",
        "judul" => "Mastering MySQL Database",
        "kategori" => "Database",
        "pengarang" => "Andi Nugroho",
        "penerbit" => "Graha Ilmu",
        "tahun" => 2022,
        "harga" => 95000,
        "stok" => 5
    ],
    [
        "kode" => "BK-003",
        "judul" => "Laravel Framework Advanced",
        "kategori" => "Programming",
        "pengarang" => "Siti Aminah",
        "penerbit" => "Informatika",
        "tahun" => 2024,
        "harga" => 125000,
        "stok" => 8
    ],
    [
        "kode" => "BK-004",
        "judul" => "Web Design Principles",
        "kategori" => "Web Design",
        "pengarang" => "Dedi Santoso",
        "penerbit" => "Andi",
        "tahun" => 2023,
        "harga" => 85000,
        "stok" => 15
    ],
    [
        "kode" => "BK-005",
        "judul" => "Network Security Fundamentals",
        "kategori" => "Networking",
        "pengarang" => "Rina Wijaya",
        "penerbit" => "Erlangga",
        "tahun" => 2023,
        "harga" => 110000,
        "stok" => 3
    ],
    [
        "kode" => "BK-006",
        "judul" => "PHP Web Services & REST API",
        "kategori" => "Programming",
        "pengarang" => "Budi Raharjo",
        "penerbit" => "Informatika",
        "tahun" => 2024,
        "harga" => 90000,
        "stok" => 12
    ],
    [
        "kode" => "BK-007",
        "judul" => "PostgreSQL Advanced Tutorial",
        "kategori" => "Database",
        "pengarang" => "Ahmad Yani",
        "penerbit" => "Graha Ilmu",
        "tahun" => 2024,
        "harga" => 115000,
        "stok" => 7
    ],
    [
        "kode" => "BK-008",
        "judul" => "JavaScript Modern ES6+",
        "kategori" => "Programming",
        "pengarang" => "Siti Aminah",
        "penerbit" => "Informatika",
        "tahun" => 2023,
        "harga" => 80000,
        "stok" => 0
    ],
    [
        "kode" => "BK-009",
        "judul" => "Data Science dengan Python",
        "kategori" => "Programming",
        "pengarang" => "Faisal Rahman",
        "penerbit" => "Erlangga",
        "tahun" => 2024,
        "harga" => 135000,
        "stok" => 6
    ],
    [
        "kode" => "BK-010",
        "judul" => "UI/UX Design Handbook",
        "kategori" => "Web Design",
        "pengarang" => "Maya Putri",
        "penerbit" => "Andi",
        "tahun" => 2023,
        "harga" => 98000,
        "stok" => 0
    ],
    [
        "kode" => "BK-011",
        "judul" => "MongoDB untuk Developer",
        "kategori" => "Database",
        "pengarang" => "Andi Nugroho",
        "penerbit" => "Graha Ilmu",
        "tahun" => 2022,
        "harga" => 88000,
        "stok" => 4
    ],
    [
        "kode" => "BK-012",
        "judul" => "Cisco Networking Essentials",
        "kategori" => "Networking",
        "pengarang" => "Rina Wijaya",
        "penerbit" => "Erlangga",
        "tahun" => 2021,
        "harga" => 105000,
        "stok" => 9
    ],
    [
        "kode" => "BK-013",
        "judul" => "React.js dan Next.js Praktis",
        "kategori" => "Programming",
        "pengarang" => "Faisal Rahman",
        "penerbit" => "Informatika",
        "tahun" => 2024,
        "harga" => 120000,
        "stok" => 11
    ],
    [
        "kode" => "BK-014",
        "judul" => "Responsive Web Design Modern",
        "kategori" => "Web Design",
        "pengarang" => "Dedi Santoso",
        "penerbit" => "Andi",
        "tahun" => 2022,
        "harga" => 78000,
        "stok" => 0
    ],
    [
        "kode" => "BK-015",
        "judul" => "Administrasi Server Linux",
        "kategori" => "Networking",
        "pengarang" => "Ahmad Yani",
        "penerbit" => "Erlangga",
        "tahun" => 2023,
        "harga" => 100000,
        "stok" => 2
    ]
];

// =====================
// Ambil dan sanitasi parameter GET
// =====================
$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';
$kategori = isset($_GET['kategori']) ? trim($_GET['kategori']) : '';
$min_harga = isset($_GET['min_harga']) ? trim($_GET['min_harga']) : '';
$max_harga = isset($_GET['max_harga']) ? trim($_GET['max_harga']) : '';
$tahun = isset($_GET['tahun']) ? trim($_GET['tahun']) : '';
$status = isset($_GET['status']) ? trim($_GET['status']) : 'semua';
$sort = isset($_GET['sort']) ? trim($_GET['sort']) : 'judul';
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;

// Sanitasi input
$keyword_safe = htmlspecialchars($keyword);
$kategori_safe = htmlspecialchars($kategori);

// =====================
// VALIDASI
// =====================
$errors = [];
$is_search = false;

if (!empty($min_harga) && !is_numeric($min_harga)) {
    $errors[] = "Harga minimum harus berupa angka";
}
if (!empty($max_harga) && !is_numeric($max_harga)) {
    $errors[] = "Harga maksimum harus berupa angka";
}
if (!empty($min_harga) && !empty($max_harga) && is_numeric($min_harga) && is_numeric($max_harga)) {
    if ((int)$min_harga > (int)$max_harga) {
        $errors[] = "Harga minimum tidak boleh lebih besar dari harga maksimum";
    }
}
if (!empty($tahun)) {
    if (!is_numeric($tahun)) {
        $errors[] = "Tahun harus berupa angka";
    } elseif ($tahun < 1900 || $tahun > date('Y')) {
        $errors[] = "Tahun harus antara 1900 - " . date('Y');
    }
}

// =====================
// FILTER DATA
// =====================
$hasil = [];

// Cek jika ada parameter pencarian
if (!empty($keyword) || !empty($kategori) || !empty($min_harga) || !empty($max_harga) || !empty($tahun) || $status !== 'semua') {
    $is_search = true;
}

if ($is_search && count($errors) == 0) {
    foreach ($buku_list as $buku) {
        $match = true;

        // Filter by keyword (judul atau pengarang)
        if (!empty($keyword)) {
            if (stripos($buku['judul'], $keyword) === false && stripos($buku['pengarang'], $keyword) === false) {
                $match = false;
            }
        }

        // Filter by kategori
        if (!empty($kategori) && $buku['kategori'] != $kategori) {
            $match = false;
        }

        // Filter by harga minimum
        if (!empty($min_harga) && is_numeric($min_harga) && $buku['harga'] < (int)$min_harga) {
            $match = false;
        }

        // Filter by harga maksimum
        if (!empty($max_harga) && is_numeric($max_harga) && $buku['harga'] > (int)$max_harga) {
            $match = false;
        }

        // Filter by tahun terbit
        if (!empty($tahun) && is_numeric($tahun) && $buku['tahun'] != (int)$tahun) {
            $match = false;
        }

        // Filter by status ketersediaan
        if ($status == 'tersedia' && $buku['stok'] <= 0) {
            $match = false;
        }
        if ($status == 'habis' && $buku['stok'] > 0) {
            $match = false;
        }

        if ($match) {
            $hasil[] = $buku;
        }
    }

    // =====================
    // SORTING
    // =====================
    usort($hasil, function($a, $b) use ($sort) {
        switch ($sort) {
            case 'judul':
                return strcasecmp($a['judul'], $b['judul']);
            case 'judul_desc':
                return strcasecmp($b['judul'], $a['judul']);
            case 'harga':
                return $a['harga'] - $b['harga'];
            case 'harga_desc':
                return $b['harga'] - $a['harga'];
            case 'tahun':
                return $a['tahun'] - $b['tahun'];
            case 'tahun_desc':
                return $b['tahun'] - $a['tahun'];
            case 'stok':
                return $a['stok'] - $b['stok'];
            case 'stok_desc':
                return $b['stok'] - $a['stok'];
            default:
                return strcasecmp($a['judul'], $b['judul']);
        }
    });
}

// =====================
// PAGINATION
// =====================
$items_per_page = 5;
$total_items = count($hasil);
$total_pages = max(1, ceil($total_items / $items_per_page));
$page = min($page, $total_pages);
$offset = ($page - 1) * $items_per_page;
$hasil_page = array_slice($hasil, $offset, $items_per_page);

// Fungsi untuk membuat URL parameter
function build_query_string($params = []) {
    $defaults = [
        'keyword' => $_GET['keyword'] ?? '',
        'kategori' => $_GET['kategori'] ?? '',
        'min_harga' => $_GET['min_harga'] ?? '',
        'max_harga' => $_GET['max_harga'] ?? '',
        'tahun' => $_GET['tahun'] ?? '',
        'status' => $_GET['status'] ?? 'semua',
        'sort' => $_GET['sort'] ?? 'judul',
    ];
    $merged = array_merge($defaults, $params);

    // Hapus parameter kosong
    $filtered = array_filter($merged, function($v, $k) {
        if ($k == 'status' && $v == 'semua') return false;
        if ($k == 'sort' && $v == 'judul') return false;
        return $v !== '';
    }, ARRAY_FILTER_USE_BOTH);

    return http_build_query($filtered);
}

// =====================
// SESSION: Recent Searches (Bonus)
// =====================
session_start();
if (!isset($_SESSION['recent_searches'])) {
    $_SESSION['recent_searches'] = [];
}
if ($is_search && count($errors) == 0 && !empty($keyword)) {
    // Simpan ke recent searches (maks 5)
    $search_entry = [
        'keyword' => $keyword,
        'time' => date('H:i:s'),
        'results' => $total_items
    ];
    // Cek jika sudah ada keyword yang sama, hapus dulu
    $_SESSION['recent_searches'] = array_filter($_SESSION['recent_searches'], function($s) use ($keyword) {
        return $s['keyword'] !== $keyword;
    });
    array_unshift($_SESSION['recent_searches'], $search_entry);
    $_SESSION['recent_searches'] = array_slice($_SESSION['recent_searches'], 0, 5);
}

// =====================
// EXPORT CSV (Bonus)
// =====================
if (isset($_GET['export']) && $_GET['export'] == 'csv' && $is_search) {
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=hasil_pencarian_buku_' . date('Ymd_His') . '.csv');

    $output = fopen('php://output', 'w');
    // BOM for UTF-8
    fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF));

    // Header
    fputcsv($output, ['No', 'Kode', 'Judul', 'Kategori', 'Pengarang', 'Penerbit', 'Tahun', 'Harga', 'Stok', 'Status']);

    // Data
    $no = 1;
    foreach ($hasil as $buku) {
        fputcsv($output, [
            $no++,
            $buku['kode'],
            $buku['judul'],
            $buku['kategori'],
            $buku['pengarang'],
            $buku['penerbit'],
            $buku['tahun'],
            $buku['harga'],
            $buku['stok'],
            $buku['stok'] > 0 ? 'Tersedia' : 'Habis'
        ]);
    }

    fclose($output);
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencarian Buku Lanjutan - Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <div class="container mt-5 mb-5">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2><i class="bi bi-search text-primary"></i> Pencarian Buku Lanjutan</h2>
            <span class="badge bg-secondary fs-6">
                <i class="bi bi-book"></i> Total Koleksi: <?php echo count($buku_list); ?> buku
            </span>
        </div>

        <!-- Error Messages -->
        <?php if (count($errors) > 0): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <h6><i class="bi bi-exclamation-triangle-fill"></i> Terdapat kesalahan:</h6>
            <ul class="mb-0">
                <?php foreach ($errors as $error): ?>
                <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>

        <!-- Form Pencarian -->
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-funnel"></i> Filter Pencarian</h5>
            </div>
            <div class="card-body">
                <form method="GET" action="">
                    <div class="row">
                        <!-- Keyword -->
                        <div class="col-md-6 mb-3">
                            <label for="keyword" class="form-label">
                                <i class="bi bi-search"></i> Kata Kunci (Judul / Pengarang)
                            </label>
                            <input type="text" class="form-control" id="keyword" name="keyword" 
                                   value="<?php echo $keyword_safe; ?>" 
                                   placeholder="Masukkan kata kunci...">
                        </div>

                        <!-- Kategori -->
                        <div class="col-md-3 mb-3">
                            <label for="kategori" class="form-label">
                                <i class="bi bi-tag"></i> Kategori
                            </label>
                            <select class="form-select" id="kategori" name="kategori">
                                <option value="">-- Semua Kategori --</option>
                                <option value="Programming" <?php echo ($kategori == 'Programming') ? 'selected' : ''; ?>>Programming</option>
                                <option value="Database" <?php echo ($kategori == 'Database') ? 'selected' : ''; ?>>Database</option>
                                <option value="Web Design" <?php echo ($kategori == 'Web Design') ? 'selected' : ''; ?>>Web Design</option>
                                <option value="Networking" <?php echo ($kategori == 'Networking') ? 'selected' : ''; ?>>Networking</option>
                            </select>
                        </div>

                        <!-- Tahun Terbit -->
                        <div class="col-md-3 mb-3">
                            <label for="tahun" class="form-label">
                                <i class="bi bi-calendar"></i> Tahun Terbit
                            </label>
                            <input type="number" class="form-control" id="tahun" name="tahun" 
                                   value="<?php echo htmlspecialchars($tahun); ?>" 
                                   min="1900" max="<?php echo date('Y'); ?>" 
                                   placeholder="Contoh: 2024">
                        </div>
                    </div>

                    <div class="row">
                        <!-- Harga Min -->
                        <div class="col-md-3 mb-3">
                            <label for="min_harga" class="form-label">
                                <i class="bi bi-currency-dollar"></i> Harga Minimum (Rp)
                            </label>
                            <input type="number" class="form-control" id="min_harga" name="min_harga" 
                                   value="<?php echo htmlspecialchars($min_harga); ?>" 
                                   min="0" step="5000" placeholder="0">
                        </div>

                        <!-- Harga Max -->
                        <div class="col-md-3 mb-3">
                            <label for="max_harga" class="form-label">
                                <i class="bi bi-currency-dollar"></i> Harga Maksimum (Rp)
                            </label>
                            <input type="number" class="form-control" id="max_harga" name="max_harga" 
                                   value="<?php echo htmlspecialchars($max_harga); ?>" 
                                   min="0" step="5000" placeholder="1000000">
                        </div>

                        <!-- Status Ketersediaan -->
                        <div class="col-md-3 mb-3">
                            <label class="form-label">
                                <i class="bi bi-box"></i> Status Ketersediaan
                            </label>
                            <div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status_semua" value="semua" 
                                           <?php echo ($status == 'semua') ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="status_semua">Semua</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status_tersedia" value="tersedia" 
                                           <?php echo ($status == 'tersedia') ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="status_tersedia">Tersedia</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status" id="status_habis" value="habis" 
                                           <?php echo ($status == 'habis') ? 'checked' : ''; ?>>
                                    <label class="form-check-label" for="status_habis">Habis</label>
                                </div>
                            </div>
                        </div>

                        <!-- Sorting -->
                        <div class="col-md-3 mb-3">
                            <label for="sort" class="form-label">
                                <i class="bi bi-sort-alpha-down"></i> Urutkan Berdasarkan
                            </label>
                            <select class="form-select" id="sort" name="sort">
                                <option value="judul" <?php echo ($sort == 'judul') ? 'selected' : ''; ?>>Judul (A-Z)</option>
                                <option value="judul_desc" <?php echo ($sort == 'judul_desc') ? 'selected' : ''; ?>>Judul (Z-A)</option>
                                <option value="harga" <?php echo ($sort == 'harga') ? 'selected' : ''; ?>>Harga (Termurah)</option>
                                <option value="harga_desc" <?php echo ($sort == 'harga_desc') ? 'selected' : ''; ?>>Harga (Termahal)</option>
                                <option value="tahun" <?php echo ($sort == 'tahun') ? 'selected' : ''; ?>>Tahun (Terlama)</option>
                                <option value="tahun_desc" <?php echo ($sort == 'tahun_desc') ? 'selected' : ''; ?>>Tahun (Terbaru)</option>
                                <option value="stok_desc" <?php echo ($sort == 'stok_desc') ? 'selected' : ''; ?>>Stok (Terbanyak)</option>
                                <option value="stok" <?php echo ($sort == 'stok') ? 'selected' : ''; ?>>Stok (Tersedikit)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-search"></i> Cari
                        </button>
                        <a href="search_advanced.php" class="btn btn-secondary">
                            <i class="bi bi-arrow-counterclockwise"></i> Reset
                        </a>
                        <?php if ($is_search && $total_items > 0): ?>
                        <a href="?<?php echo build_query_string(['export' => 'csv']); ?>" class="btn btn-success">
                            <i class="bi bi-download"></i> Export CSV
                        </a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>

        <!-- Recent Searches (Bonus) -->
        <?php if (!empty($_SESSION['recent_searches'])): ?>
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-secondary text-white py-2">
                <h6 class="mb-0"><i class="bi bi-clock-history"></i> Pencarian Terakhir</h6>
            </div>
            <div class="card-body py-2">
                <div class="d-flex flex-wrap gap-2">
                    <?php foreach ($_SESSION['recent_searches'] as $recent): ?>
                    <a href="?keyword=<?php echo urlencode($recent['keyword']); ?>" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-search"></i> <?php echo htmlspecialchars($recent['keyword']); ?>
                        <span class="badge bg-primary"><?php echo $recent['results']; ?> hasil</span>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Hasil Pencarian -->
        <?php if ($is_search && count($errors) == 0): ?>
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="bi bi-table"></i> Hasil Pencarian
                    <span class="badge bg-light text-dark"><?php echo $total_items; ?> buku ditemukan</span>
                </h5>
                <?php if ($total_pages > 1): ?>
                <span class="text-white-50">Halaman <?php echo $page; ?> dari <?php echo $total_pages; ?></span>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <?php if ($total_items > 0): ?>
                <div class="table-responsive">
                    <table class="table table-hover table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>No</th>
                                <th>Kode</th>
                                <th>Judul</th>
                                <th>Kategori</th>
                                <th>Pengarang</th>
                                <th>Penerbit</th>
                                <th>Tahun</th>
                                <th>Harga</th>
                                <th>Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $no = $offset + 1;
                            foreach ($hasil_page as $buku): 
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><code><?php echo $buku['kode']; ?></code></td>
                                <td>
                                    <strong><?php echo highlight_keyword($buku['judul'], $keyword); ?></strong>
                                    <?php if ($buku['tahun'] >= 2024): ?>
                                    <span class="badge bg-danger">NEW</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php
                                    $badge_colors = [
                                        'Programming' => 'primary',
                                        'Database' => 'success',
                                        'Web Design' => 'info',
                                        'Networking' => 'warning'
                                    ];
                                    $badge_color = $badge_colors[$buku['kategori']] ?? 'secondary';
                                    ?>
                                    <span class="badge bg-<?php echo $badge_color; ?>"><?php echo $buku['kategori']; ?></span>
                                </td>
                                <td><?php echo highlight_keyword($buku['pengarang'], $keyword); ?></td>
                                <td><?php echo $buku['penerbit']; ?></td>
                                <td><?php echo $buku['tahun']; ?></td>
                                <td>Rp <?php echo number_format($buku['harga'], 0, ',', '.'); ?></td>
                                <td class="text-center">
                                    <?php if ($buku['stok'] > 0): ?>
                                    <span class="badge bg-success"><?php echo $buku['stok']; ?></span>
                                    <?php else: ?>
                                    <span class="badge bg-danger">Habis</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <?php if ($total_pages > 1): ?>
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center mt-3 mb-0">
                        <!-- Previous -->
                        <li class="page-item <?php echo ($page <= 1) ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?<?php echo build_query_string(['page' => $page - 1]); ?>">
                                <i class="bi bi-chevron-left"></i> Prev
                            </a>
                        </li>

                        <!-- Page Numbers -->
                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                            <a class="page-link" href="?<?php echo build_query_string(['page' => $i]); ?>">
                                <?php echo $i; ?>
                            </a>
                        </li>
                        <?php endfor; ?>

                        <!-- Next -->
                        <li class="page-item <?php echo ($page >= $total_pages) ? 'disabled' : ''; ?>">
                            <a class="page-link" href="?<?php echo build_query_string(['page' => $page + 1]); ?>">
                                Next <i class="bi bi-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
                <?php endif; ?>

                <!-- Info Parameter Pencarian -->
                <div class="alert alert-info mt-3 mb-0">
                    <strong><i class="bi bi-info-circle"></i> Parameter Pencarian Aktif:</strong>
                    <ul class="mb-0 mt-1">
                        <?php if (!empty($keyword)): ?>
                        <li>Kata kunci: <strong><?php echo $keyword_safe; ?></strong></li>
                        <?php endif; ?>
                        <?php if (!empty($kategori)): ?>
                        <li>Kategori: <strong><?php echo $kategori_safe; ?></strong></li>
                        <?php endif; ?>
                        <?php if (!empty($tahun)): ?>
                        <li>Tahun terbit: <strong><?php echo htmlspecialchars($tahun); ?></strong></li>
                        <?php endif; ?>
                        <?php if (!empty($min_harga)): ?>
                        <li>Harga minimal: <strong>Rp <?php echo number_format($min_harga, 0, ',', '.'); ?></strong></li>
                        <?php endif; ?>
                        <?php if (!empty($max_harga)): ?>
                        <li>Harga maksimal: <strong>Rp <?php echo number_format($max_harga, 0, ',', '.'); ?></strong></li>
                        <?php endif; ?>
                        <?php if ($status !== 'semua'): ?>
                        <li>Status: <strong><?php echo ucfirst($status); ?></strong></li>
                        <?php endif; ?>
                        <li>Urutan: <strong>
                            <?php 
                            $sort_labels = [
                                'judul' => 'Judul (A-Z)',
                                'judul_desc' => 'Judul (Z-A)',
                                'harga' => 'Harga (Termurah)',
                                'harga_desc' => 'Harga (Termahal)',
                                'tahun' => 'Tahun (Terlama)',
                                'tahun_desc' => 'Tahun (Terbaru)',
                                'stok' => 'Stok (Tersedikit)',
                                'stok_desc' => 'Stok (Terbanyak)'
                            ];
                            echo $sort_labels[$sort] ?? 'Judul (A-Z)';
                            ?>
                        </strong></li>
                    </ul>
                </div>

                <?php else: ?>
                <div class="alert alert-warning mb-0">
                    <i class="bi bi-exclamation-triangle"></i>
                    <strong>Tidak ada buku yang ditemukan</strong> dengan kriteria pencarian tersebut.
                    Silakan coba dengan kriteria lain.
                </div>
                <?php endif; ?>
            </div>
        </div>

        <?php else: ?>
        <!-- Tampilkan Ringkasan Koleksi jika belum search -->
        <div class="card shadow-sm">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">
                    <i class="bi bi-book"></i> Ringkasan Koleksi Perpustakaan
                </h5>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <i class="bi bi-info-circle"></i> Gunakan form di atas untuk mencari buku berdasarkan kriteria tertentu.
                    Pencarian mendukung filter by keyword, kategori, range harga, tahun terbit, dan status ketersediaan.
                </div>

                <!-- Statistik -->
                <?php
                $total_buku = count($buku_list);
                $total_tersedia = count(array_filter($buku_list, fn($b) => $b['stok'] > 0));
                $total_habis = $total_buku - $total_tersedia;
                $total_stok = array_sum(array_column($buku_list, 'stok'));

                // Hitung per kategori
                $kategori_count = [];
                foreach ($buku_list as $buku) {
                    if (!isset($kategori_count[$buku['kategori']])) {
                        $kategori_count[$buku['kategori']] = 0;
                    }
                    $kategori_count[$buku['kategori']]++;
                }
                ?>
                <div class="row text-center mb-4">
                    <div class="col-md-3">
                        <div class="card bg-primary text-white">
                            <div class="card-body py-3">
                                <h3 class="mb-0"><?php echo $total_buku; ?></h3>
                                <small>Total Judul</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-success text-white">
                            <div class="card-body py-3">
                                <h3 class="mb-0"><?php echo $total_tersedia; ?></h3>
                                <small>Tersedia</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-danger text-white">
                            <div class="card-body py-3">
                                <h3 class="mb-0"><?php echo $total_habis; ?></h3>
                                <small>Stok Habis</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card bg-info text-white">
                            <div class="card-body py-3">
                                <h3 class="mb-0"><?php echo $total_stok; ?></h3>
                                <small>Total Eksemplar</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Daftar per kategori -->
                <h6><i class="bi bi-bar-chart"></i> Distribusi per Kategori:</h6>
                <div class="row">
                    <?php foreach ($kategori_count as $kat => $count): ?>
                    <div class="col-md-3 mb-2">
                        <a href="?kategori=<?php echo urlencode($kat); ?>" class="text-decoration-none">
                            <div class="card h-100">
                                <div class="card-body text-center py-2">
                                    <strong><?php echo $kat; ?></strong><br>
                                    <span class="badge bg-primary"><?php echo $count; ?> buku</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

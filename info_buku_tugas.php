<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info Buku - Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Informasi Buku</h1>
        
        <?php
        // Data buku
        $judul = "Pemrograman Web dengan PHP";
        $pengarang = "Budi Raharjo";
        $penerbit = "Informatika";
        $tahun_terbit = 2023;
        $harga = 85000;
        $stok = 15;
        $isbn = "978-602-1234-56-7";
        ?>

        
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><?php echo $judul; ?></h5>
            </div>
            <div class="card-body">
                <?php
                // Data buku
                $books = [
                    [
                        'judul' => "Pemrograman Web dengan PHP",
                        'pengarang' => "Budi Raharjo",
                        'penerbit' => "Informatika",
                        'tahun_terbit' => 2023,
                        'harga' => 85000,
                        'stok' => 15,
                        'isbn' => "978-602-1234-56-7",
                        'kategori' => "Programming",
                        'bahasa' => "Indonesia",
                        'halaman' => 350,
                        'berat' => 500
                    ],
                    [
                        'judul' => "Database Management Systems",
                        'pengarang' => "Wawan kurniawan",
                        'penerbit' => "TechBooks",
                        'tahun_terbit' => 2022,
                        'harga' => 95000,
                        'stok' => 10,
                        'isbn' => "978-603-5678-90-1",
                        'kategori' => "Database",
                        'bahasa' => "Inggris",
                        'halaman' => 400,
                        'berat' => 600
                    ],
                    [
                        'judul' => "Web Design Essentials",
                        'pengarang' => "Jhon slamet",
                        'penerbit' => "DesignPress",
                        'tahun_terbit' => 2021,
                        'harga' => 75000,
                        'stok' => 20,
                        'isbn' => "978-604-1122-33-4",
                        'kategori' => "Web Design",
                        'bahasa' => "Indonesia",
                        'halaman' => 300,
                        'berat' => 450
                    ],
                    [
                        'judul' => "Advanced PHP Programming",
                        'pengarang' => "Alice wibu",
                        'penerbit' => "CodeMasters",
                        'tahun_terbit' => 2024,
                        'harga' => 105000,
                        'stok' => 8,
                        'isbn' => "978-605-4455-66-7",
                        'kategori' => "Programming",
                        'bahasa' => "Inggris",
                        'halaman' => 450,
                        'berat' => 550
                    ]
                ];

                function getBadgeClass($kategori) {
                    switch ($kategori) {
                        case 'Programming': return 'bg-primary';
                        case 'Database': return 'bg-success';
                        case 'Web Design': return 'bg-danger';
                        default: return 'bg-secondary';
                    }
                }

                foreach ($books as $book) {
                    $badgeClass = getBadgeClass($book['kategori']);
                    ?>
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><?php echo $book['judul']; ?> <span class="badge <?php echo $badgeClass; ?>"><?php echo $book['kategori']; ?></span></h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="200">Pengarang</th>
                                    <td>: <?php echo $book['pengarang']; ?></td>
                                </tr>
                                <tr>
                                    <th>Penerbit</th>
                                    <td>: <?php echo $book['penerbit']; ?></td>
                                </tr>
                                <tr>
                                    <th>Tahun Terbit</th>
                                    <td>: <?php echo $book['tahun_terbit']; ?></td>
                                </tr>
                                <tr>
                                    <th>ISBN</th>
                                    <td>: <?php echo $book['isbn']; ?></td>
                                </tr>
                                <tr>
                                    <th>Harga</th>
                                    <td>: Rp <?php echo number_format($book['harga'], 0, ',', '.'); ?></td>
                                </tr>
                                <tr>
                                    <th>Stok</th>
                                    <td>: <?php echo $book['stok']; ?> buku</td>
                                </tr>
                                <tr>
                                    <th>Kategori</th>
                                    <td>: <?php echo $book['kategori']; ?></td>
                                </tr>
                                <tr>
                                    <th>Bahasa</th>
                                    <td>: <?php echo $book['bahasa']; ?></td>
                                </tr>
                                <tr>
                                    <th>Jumlah Halaman</th>
                                    <td>: <?php echo $book['halaman']; ?> halaman</td>
                                </tr>
                                <tr>
                                    <th>Berat Buku</th>
                                    <td>: <?php echo $book['berat']; ?> gram</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <table class="table table-borderless">
                    <tr>
                        <th width="200">Pengarang</th>
                        <td>: <?php echo $pengarang; ?></td>
                    </tr>
                    <tr>
                        <th>Penerbit</th>
                        <td>: <?php echo $penerbit; ?></td>
                    </tr>
                    <tr>
                        <th>Tahun Terbit</th>
                        <td>: <?php echo $tahun_terbit; ?></td>
                    </tr>
                    <tr>
                        <th>ISBN</th>
                        <td>: <?php echo $isbn; ?></td>
                    </tr>
                    <tr>
                        <th>Harga</th>
                        <td>: Rp <?php echo number_format($harga, 0, ',', '.'); ?></td>
                    </tr>
                    <tr>
                        <th>Stok</th>
                        <td>: <?php echo $stok; ?> buku</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
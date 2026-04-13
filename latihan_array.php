<?php
// Array buku - setiap elemen adalah array associative
$buku_list = [
    [
        "kode" => "BK-001",
        "judul" => "Pemrograman PHP",
        "harga" => 75000,
        "stok" => 10
    ],
    [
        "kode" => "BK-002",
        "judul" => "MySQL Database",
        "harga" => 95000,
        "stok" => 5
    ],
    [
        "kode" => "BK-003",
        "judul" => "Laravel Framework",
        "harga" => 125000,
        "stok" => 8
    ]
];
 
// Akses elemen
echo $buku_list[0]["judul"];  // Pemrograman PHP
echo $buku_list[1]["harga"];  // 95000
echo $buku_list[2]["stok"];   // 8
 
// Loop semua buku
foreach ($buku_list as $buku) {
    echo "Judul: " . $buku["judul"] . "<br />";
    echo "Harga: Rp " . number_format($buku["harga"], 0, ',', '.') . "<br />";
    echo "Stok: " . $buku["stok"] . "<br /><br />";
}
 
// Loop dengan index
for ($i = 0; $i < count($buku_list); $i++) {
    echo ($i + 1) . ". " . $buku_list[$i]["judul"] . "<br />";
}
?>
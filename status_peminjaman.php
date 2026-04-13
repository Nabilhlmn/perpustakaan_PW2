<?php
// ============================================
// SISTEM STATUS PEMINJAMAN PERPUSTAKAAN
// ============================================

// --- Data Anggota ---
$nama_anggota = "Budi Santoso";
$total_pinjaman = 2;
$buku_terlambat = 1;
$hari_keterlambatan = 5; // hari

// --- Konstanta Aturan ---
$maks_pinjam = 3;
$denda_per_hari = 1000; // Rp 1.000/hari/buku
$maks_denda = 50000; // Rp 50.000

// --- Hitung Denda ---
$total_denda = $buku_terlambat * $hari_keterlambatan * $denda_per_hari;
if ($total_denda > $maks_denda) {
    $total_denda = $maks_denda;
}

// --- IF-ELSEIF-ELSE: Cek status peminjaman ---
if ($buku_terlambat > 0) {
    $status_pinjam = "TIDAK BISA PINJAM - Ada buku terlambat dikembalikan";
    $bisa_pinjam = false;
}
elseif ($total_pinjaman >= $maks_pinjam) {
    $status_pinjam = "TIDAK BISA PINJAM - Kuota peminjaman penuh ($maks_pinjam buku)";
    $bisa_pinjam = false;
}
else {
    $sisa_kuota = $maks_pinjam - $total_pinjaman;
    $status_pinjam = "BISA PINJAM - Sisa kuota: $sisa_kuota buku";
    $bisa_pinjam = true;
}

// --- SWITCH: Tentukan level member ---
switch (true) {
    case ($total_pinjaman > 15):
        $level_member = "Gold";
        $warna_level = "gold";
        break;
    case ($total_pinjaman >= 6):
        $level_member = "Silver";
        $warna_level = "silver";
        break;
    default:
        $level_member = "Bronze";
        $warna_level = "#cd7f32";
        break;
}
?>


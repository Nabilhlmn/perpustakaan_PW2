<?php
// ============================================
// LIBRARY FUNCTIONS ANGGOTA PERPUSTAKAAN
// ============================================

// 1. Function untuk hitung total anggota
function hitung_total_anggota($anggota_list) {
    return count($anggota_list);
}

// 2. Function untuk hitung anggota aktif
function hitung_anggota_aktif($anggota_list) {
    $count = 0;
    foreach ($anggota_list as $anggota) {
        if ($anggota["status"] === "Aktif") {
            $count++;
        }
    }
    return $count;
}

// 3. Function untuk hitung rata-rata pinjaman
function hitung_rata_rata_pinjaman($anggota_list) {
    $total = count($anggota_list);
    if ($total === 0) return 0;

    $jumlah_pinjaman = 0;
    foreach ($anggota_list as $anggota) {
        $jumlah_pinjaman += $anggota["total_pinjaman"];
    }
    return $jumlah_pinjaman / $total;
}

// 4. Function untuk cari anggota by ID
function cari_anggota_by_id($anggota_list, $id) {
    foreach ($anggota_list as $anggota) {
        if ($anggota["id"] === $id) {
            return $anggota;
        }
    }
    return null;
}

// 5. Function untuk cari anggota teraktif
function cari_anggota_teraktif($anggota_list) {
    if (count($anggota_list) === 0) return null;

    $teraktif = $anggota_list[0];
    foreach ($anggota_list as $anggota) {
        if ($anggota["total_pinjaman"] > $teraktif["total_pinjaman"]) {
            $teraktif = $anggota;
        }
    }
    return $teraktif;
}

// 6. Function untuk filter by status
function filter_by_status($anggota_list, $status) {
    $hasil = [];
    foreach ($anggota_list as $anggota) {
        if ($anggota["status"] === $status) {
            $hasil[] = $anggota;
        }
    }
    return $hasil;
}

// 7. Function untuk validasi email
function validasi_email($email) {
    if (empty($email)) return false;
    if (strpos($email, '@') === false) return false;
    if (strpos($email, '.') === false) return false;
    return true;
}

// 8. Function untuk format tanggal Indonesia
function format_tanggal_indo($tanggal) {
    $bulan = [
        1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
        4 => 'April',   5 => 'Mei',      6 => 'Juni',
        7 => 'Juli',     8 => 'Agustus',  9 => 'September',
        10 => 'Oktober', 11 => 'November', 12 => 'Desember'
    ];

    $parts = explode('-', $tanggal);
    $tgl   = (int) $parts[2];
    $bln   = (int) $parts[1];
    $thn   = $parts[0];

    return "$tgl " . $bulan[$bln] . " $thn";
}

// ============================================
// BONUS FUNCTIONS
// ============================================

// 9. Function untuk sort anggota by nama (A-Z)
function sort_by_nama($anggota_list) {
    usort($anggota_list, function ($a, $b) {
        return strcmp($a["nama"], $b["nama"]);
    });
    return $anggota_list;
}

// 10. Function untuk search anggota by nama (partial match)
function search_by_nama($anggota_list, $keyword) {
    $hasil = [];
    foreach ($anggota_list as $anggota) {
        if (stripos($anggota["nama"], $keyword) !== false) {
            $hasil[] = $anggota;
        }
    }
    return $hasil;
}
?>

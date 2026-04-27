-- ============================================================
-- TUGAS SQL - DATABASE PERPUSTAKAAN
-- Nama Database: perpustakaan
-- ============================================================

-- Membuat dan menggunakan database
CREATE DATABASE IF NOT EXISTS perpustakaan;
USE perpustakaan;

-- Membuat tabel buku
CREATE TABLE IF NOT EXISTS buku (
    id INT AUTO_INCREMENT PRIMARY KEY,
    kode VARCHAR(10) NOT NULL UNIQUE,
    judul VARCHAR(255) NOT NULL,
    kategori VARCHAR(50) NOT NULL,
    pengarang VARCHAR(100) NOT NULL,
    penerbit VARCHAR(100),
    tahun_terbit YEAR,
    isbn VARCHAR(20),
    harga DECIMAL(10,2) NOT NULL,
    stok INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- ============================================================
-- INSERT DATA SAMPEL
-- ============================================================
INSERT INTO buku (kode, judul, kategori, pengarang, penerbit, tahun_terbit, isbn, harga, stok) VALUES
('BK-001', 'Pemrograman PHP untuk Pemula', 'Programming', 'Budi Raharjo', 'Informatika', 2023, '978-602-1234-56-7', 75000, 10),
('BK-002', 'Mastering MySQL Database', 'Database', 'Andi Nugroho', 'Gramedia', 2022, '978-602-1234-57-8', 95000, 5),
('BK-003', 'Laravel Framework Advanced', 'Programming', 'Siti Aminah', 'Informatika', 2024, '978-602-1234-58-9', 125000, 8),
('BK-004', 'Web Design Principles', 'Web Design', 'Dedi Santoso', 'Andi Publisher', 2023, '978-602-1234-59-0', 85000, 15),
('BK-005', 'Network Security Fundamentals', 'Networking', 'Rina Wijaya', 'Gramedia', 2023, '978-602-1234-60-1', 110000, 3),
('BK-006', 'JavaScript Modern ES6+', 'Programming', 'Budi Raharjo', 'Informatika', 2024, '978-602-1234-61-2', 89000, 12),
('BK-007', 'Belajar PHP dan MySQL Lengkap', 'Programming', 'Budi Raharjo', 'Gramedia', 2024, '978-602-1234-62-3', 98000, 7),
('BK-008', 'Database MySQL untuk Pemula', 'Database', 'Andi Nugroho', 'Informatika', 2023, '978-602-1234-63-4', 65000, 4),
('BK-009', 'Responsive Web Design', 'Web Design', 'Dedi Santoso', 'Andi Publisher', 2022, '978-602-1234-64-5', 78000, 6),
('BK-010', 'Python Programming Dasar', 'Programming', 'Siti Aminah', 'Gramedia', 2024, '978-602-1234-65-6', 92000, 2);


-- ============================================================
-- A. STATISTIK BUKU (5 Query)
-- ============================================================

-- 1. Total buku seluruhnya
SELECT COUNT(*) AS total_buku 
FROM buku;

-- 2. Total nilai inventaris (SUM harga × stok)
SELECT SUM(harga * stok) AS total_nilai_inventaris 
FROM buku;

-- 3. Rata-rata harga buku
SELECT AVG(harga) AS rata_rata_harga 
FROM buku;

-- 4. Buku termahal (tampilkan judul dan harga)
SELECT judul, harga 
FROM buku 
ORDER BY harga DESC 
LIMIT 1;

-- 5. Buku dengan stok terbanyak
SELECT judul, stok 
FROM buku 
ORDER BY stok DESC 
LIMIT 1;


-- ============================================================
-- B. FILTER DAN PENCARIAN (5 Query)
-- ============================================================

-- 1. Semua buku kategori Programming yang harga < 100.000
SELECT judul, kategori, harga 
FROM buku 
WHERE kategori = 'Programming' AND harga < 100000;

-- 2. Buku yang judulnya mengandung kata "PHP" atau "MySQL"
SELECT judul, kategori, pengarang 
FROM buku 
WHERE judul LIKE '%PHP%' OR judul LIKE '%MySQL%';

-- 3. Buku yang terbit tahun 2024
SELECT judul, pengarang, tahun_terbit 
FROM buku 
WHERE tahun_terbit = 2024;

-- 4. Buku yang stoknya antara 5-10
SELECT judul, stok 
FROM buku 
WHERE stok BETWEEN 5 AND 10;

-- 5. Buku yang pengarangnya "Budi Raharjo"
SELECT judul, kategori, harga, stok 
FROM buku 
WHERE pengarang = 'Budi Raharjo';


-- ============================================================
-- C. GROUPING DAN AGREGASI (3 Query)
-- ============================================================

-- 1. Jumlah buku per kategori (dengan total stok per kategori)
SELECT kategori, 
       COUNT(*) AS jumlah_buku, 
       SUM(stok) AS total_stok 
FROM buku 
GROUP BY kategori;

-- 2. Rata-rata harga per kategori
SELECT kategori, 
       AVG(harga) AS rata_rata_harga 
FROM buku 
GROUP BY kategori;

-- 3. Kategori dengan total nilai inventaris terbesar
SELECT kategori, 
       SUM(harga * stok) AS total_nilai_inventaris 
FROM buku 
GROUP BY kategori 
ORDER BY total_nilai_inventaris DESC 
LIMIT 1;


-- ============================================================
-- D. UPDATE DATA (2 Query)
-- ============================================================

-- 1. Naikkan harga semua buku kategori Programming sebesar 5%
UPDATE buku 
SET harga = harga * 1.05 
WHERE kategori = 'Programming';

-- 2. Tambah stok 10 untuk semua buku yang stoknya < 5
UPDATE buku 
SET stok = stok + 10 
WHERE stok < 5;


-- ============================================================
-- E. LAPORAN KHUSUS (2 Query)
-- ============================================================

-- 1. Daftar buku yang perlu restocking (stok < 5)
SELECT kode, judul, kategori, stok 
FROM buku 
WHERE stok < 5 
ORDER BY stok ASC;

-- 2. Top 5 buku termahal
SELECT judul, kategori, pengarang, harga 
FROM buku 
ORDER BY harga DESC 
LIMIT 5;

-- ============================================================
-- DATABASE PERPUSTAKAAN LENGKAP
-- Nama  : Nabil
-- NIM   : 60324015
-- ============================================================

-
-- 1. TABEL KATEGORI BUKU

CREATE TABLE kategori_buku (
    id_kategori INT AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(50) NOT NULL UNIQUE,
    deskripsi TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


-- 2. TABEL PENERBIT

CREATE TABLE penerbit (
    id_penerbit INT AUTO_INCREMENT PRIMARY KEY,
    nama_penerbit VARCHAR(100) NOT NULL,
    alamat TEXT,
    telepon VARCHAR(15),
    email VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 3. TABEL BUKU (dengan Foreign Key ke kategori_buku & penerbit)

CREATE TABLE buku (
    id_buku INT AUTO_INCREMENT PRIMARY KEY,
    kode_buku VARCHAR(10) NOT NULL UNIQUE,
    judul VARCHAR(255) NOT NULL,
    id_kategori INT NOT NULL,
    pengarang VARCHAR(100) NOT NULL,
    id_penerbit INT NOT NULL,
    tahun_terbit YEAR,
    isbn VARCHAR(20),
    harga DECIMAL(10,2) NOT NULL,
    stok INT NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_kategori) REFERENCES kategori_buku(id_kategori)
        ON UPDATE CASCADE ON DELETE RESTRICT,
    FOREIGN KEY (id_penerbit) REFERENCES penerbit(id_penerbit)
        ON UPDATE CASCADE ON DELETE RESTRICT
);


-- INSERT DATA KATEGORI BUKU 

INSERT INTO kategori_buku (nama_kategori, deskripsi) VALUES
('Programming', 'Buku-buku tentang pemrograman dan pengembangan perangkat lunak'),
('Database', 'Buku-buku tentang sistem manajemen basis data'),
('Web Design', 'Buku-buku tentang desain dan pengembangan tampilan web'),
('Networking', 'Buku-buku tentang jaringan komputer dan keamanan jaringan'),
('Mobile Development', 'Buku-buku tentang pengembangan aplikasi mobile');

-- INSERT DATA PENERBIT

INSERT INTO penerbit (nama_penerbit, alamat, telepon, email) VALUES
('Informatika', 'Jl. Buah Batu No. 97, Bandung', '0227272838', 'info@informatika.co.id'),
('Gramedia Pustaka Utama', 'Jl. Palmerah Barat No. 29-37, Jakarta', '0215360008', 'cs@gramedia.com'),
('Andi Publisher', 'Jl. Beo No. 38-40, Yogyakarta', '0274561881', 'info@andipublisher.com'),
('Elex Media Komputindo', 'Jl. Palmerah Barat No. 29-37, Jakarta', '0215360009', 'elex@gramedia.com'),
('Deepublish', 'Jl. Kaliurang Km 9.3, Yogyakarta', '02747467744', 'cs@deepublish.co.id');


-- INSERT DATA BUKU 

INSERT INTO buku (kode_buku, judul, id_kategori, pengarang, id_penerbit, tahun_terbit, isbn, harga, stok) VALUES
-- Buku Programming
('BK-001', 'Pemrograman PHP untuk Pemula', 1, 'Budi Raharjo', 1, 2023, '978-602-1234-56-7', 75000, 10),
('BK-002', 'Laravel Framework Advanced', 1, 'Siti Aminah', 1, 2024, '978-602-1234-58-9', 125000, 8),
('BK-003', 'JavaScript Modern ES6+', 1, 'Budi Raharjo', 2, 2024, '978-602-1234-61-2', 89000, 12),
('BK-004', 'Belajar PHP dan MySQL Lengkap', 1, 'Budi Raharjo', 2, 2024, '978-602-1234-62-3', 98000, 7),
('BK-005', 'Python Programming Dasar', 1, 'Siti Aminah', 3, 2024, '978-602-1234-65-6', 92000, 2),

-- Buku Database
('BK-006', 'Mastering MySQL Database', 2, 'Andi Nugroho', 2, 2022, '978-602-1234-57-8', 95000, 5),
('BK-007', 'Database MySQL untuk Pemula', 2, 'Andi Nugroho', 1, 2023, '978-602-1234-63-4', 65000, 4),
('BK-008', 'PostgreSQL Administration', 2, 'Rina Wijaya', 4, 2023, '978-602-1234-70-1', 115000, 3),

-- Buku Web Design
('BK-009', 'Web Design Principles', 3, 'Dedi Santoso', 3, 2023, '978-602-1234-59-0', 85000, 15),
('BK-010', 'Responsive Web Design', 3, 'Dedi Santoso', 3, 2022, '978-602-1234-64-5', 78000, 6),
('BK-011', 'UI/UX Design Fundamentals', 3, 'Rina Wijaya', 4, 2024, '978-602-1234-71-2', 105000, 9),

-- Buku Networking
('BK-012', 'Network Security Fundamentals', 4, 'Rina Wijaya', 2, 2023, '978-602-1234-60-1', 110000, 3),
('BK-013', 'Cisco Networking Essentials', 4, 'Andi Nugroho', 1, 2023, '978-602-1234-72-3', 135000, 4),

-- Buku Mobile Development
('BK-014', 'Flutter Mobile App Development', 5, 'Siti Aminah', 5, 2024, '978-602-1234-73-4', 120000, 6),
('BK-015', 'React Native untuk Pemula', 5, 'Budi Raharjo', 5, 2024, '978-602-1234-74-5', 99000, 1);


-- QUERY JOIN & AGREGASI

-- 1. JOIN: Tampilkan buku dengan nama kategori dan nama penerbit
SELECT b.kode_buku, 
       b.judul, 
       k.nama_kategori, 
       b.pengarang, 
       p.nama_penerbit, 
       b.tahun_terbit, 
       b.harga, 
       b.stok
FROM buku b
INNER JOIN kategori_buku k ON b.id_kategori = k.id_kategori
INNER JOIN penerbit p ON b.id_penerbit = p.id_penerbit
ORDER BY b.kode_buku;

-- 2. Jumlah buku per kategori
SELECT k.nama_kategori, 
       COUNT(*) AS jumlah_buku, 
       SUM(b.stok) AS total_stok
FROM buku b
INNER JOIN kategori_buku k ON b.id_kategori = k.id_kategori
GROUP BY k.nama_kategori
ORDER BY jumlah_buku DESC;

-- 3. Jumlah buku per penerbit
SELECT p.nama_penerbit, 
       COUNT(*) AS jumlah_buku, 
       SUM(b.stok) AS total_stok
FROM buku b
INNER JOIN penerbit p ON b.id_penerbit = p.id_penerbit
GROUP BY p.nama_penerbit
ORDER BY jumlah_buku DESC;

-- 4. Buku beserta detail lengkap (kategori + penerbit)
SELECT b.kode_buku,
       b.judul,
       b.pengarang,
       k.nama_kategori AS kategori,
       k.deskripsi AS deskripsi_kategori,
       p.nama_penerbit AS penerbit,
       p.alamat AS alamat_penerbit,
       p.telepon AS telepon_penerbit,
       p.email AS email_penerbit,
       b.tahun_terbit,
       b.isbn,
       b.harga,
       b.stok,
       (b.harga * b.stok) AS nilai_inventaris
FROM buku b
INNER JOIN kategori_buku k ON b.id_kategori = k.id_kategori
INNER JOIN penerbit p ON b.id_penerbit = p.id_penerbit
ORDER BY k.nama_kategori, b.judul;

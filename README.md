Tugas 1 

1. Statistik Buku 5 Query
   Total buku seluruhnya
   <img width="1015" height="255" alt="image" src="https://github.com/user-attachments/assets/f2394b4b-df9f-4e6d-ad01-d2e02a066817" />
   
   Total nilai inventaris (sum harga × stok)
   <img width="1015" height="295" alt="image" src="https://github.com/user-attachments/assets/97ae2b1a-b115-43a3-bae9-9d15b1a45088" />

   Rata-rata harga buku
   <img width="1015" height="301" alt="image" src="https://github.com/user-attachments/assets/66896d1a-8bba-4782-90b9-130f6a596e89" />

   Buku termahal (tampilkan judul dan harga)
   <img width="1015" height="301" alt="image" src="https://github.com/user-attachments/assets/1572889b-644c-469f-a06e-ffa7767cf675" />

   Buku dengan stok terbanyak
   <img width="1015" height="290" alt="image" src="https://github.com/user-attachments/assets/dfff3602-14ce-49a6-81ba-f433343e3767" />

   
3. Filter dan Pencarian (5 query):

   Semua buku kategori Programming yang harga < 100.000
   <img width="1015" height="290" alt="image" src="https://github.com/user-attachments/assets/45edac7b-c585-4b57-8fc9-cf1c9d1a44a6" />

   Buku yang judulnya mengandung kata "PHP" atau "MySQL"
   <img width="1015" height="291" alt="image" src="https://github.com/user-attachments/assets/142e9992-d982-42cd-950f-e2a977e772ac" />

   Buku yang terbit tahun 2024
   <img width="1015" height="377" alt="image" src="https://github.com/user-attachments/assets/c249cf4a-6d0c-4f75-98b8-5ba382b894f4" />

   Buku yang stoknya antara 5-10
   <img width="1015" height="377" alt="image" src="https://github.com/user-attachments/assets/f8c48c33-04d4-4a7b-b676-31494fc2ff8e" />

   Buku yang pengarangnya "Budi Raharjo"
<img width="1015" height="274" alt="image" src="https://github.com/user-attachments/assets/fa407ab9-a743-49d3-9361-2c17867e05aa" />

   
5. Grouping dan Agregasi (3 query):

   Jumlah buku per kategori (dengan total stok per kategori)
   <img width="1015" height="266" alt="image" src="https://github.com/user-attachments/assets/954e5d5d-b2ff-4485-8aa8-d0f6257ab758" />

   Rata-rata harga per kategori
   <img width="1015" height="266" alt="image" src="https://github.com/user-attachments/assets/7ae0b26a-f5a9-46fc-8039-975d334fba6b" />

   Kategori dengan total nilai inventaris terbesar
   <img width="1015" height="142" alt="image" src="https://github.com/user-attachments/assets/c3e24a19-f88d-453a-b44c-660624733817" />

   
Update Data (2 query):

   Naikkan harga semua buku kategori Programming sebesar 5%
   Tambah stok 10 untuk semua buku yang stoknya < 5
   <img width="1015" height="142" alt="image" src="https://github.com/user-attachments/assets/d21a5064-5d18-439d-a8db-026bff6eab31" />

Laporan Khusus (2 query):

Daftar buku yang perlu restocking (stok < 5)
<img width="1015" height="142" alt="image" src="https://github.com/user-attachments/assets/201a8cbd-b51c-48d9-848a-ab8f6a022885" />

Top 5 buku termahal

<img width="1015" height="384" alt="image" src="https://github.com/user-attachments/assets/7a39be76-748d-4418-8ed5-ab4716c03b2b" />




Tugas 2

ERD
<img width="1060" height="430" alt="image" src="https://github.com/user-attachments/assets/6979701d-002e-4bc8-bded-a605c1c9b9c4" />


A. Screenshot Struktur tabel

1. tabel anggota
<img width="1366" height="449" alt="image" src="https://github.com/user-attachments/assets/076b9879-18f3-4f28-a3e1-44071d2ea8e1" />

2. Tabel buku
   <img width="1397" height="522" alt="image" src="https://github.com/user-attachments/assets/cf6b24cb-a573-4fed-be4f-38dcf67a3706" />
   
3. Tabel kategori_buku
   <img width="1028" height="222" alt="image" src="https://github.com/user-attachments/assets/25a0e648-af8e-454f-9a59-98855cebf5d5" />

5. tabel penerbit
   <img width="1019" height="292" alt="image" src="https://github.com/user-attachments/assets/be79da9d-1ec7-4452-9922-713e759482b6" />

7. Tabel Transaksi
<img width="1388" height="398" alt="image" src="https://github.com/user-attachments/assets/fae31eae-1288-48c1-8fc2-e7bd4a897768" />

Screenshot data tabel

1. tabel anggota
   <img width="1688" height="303" alt="image" src="https://github.com/user-attachments/assets/ae1a8693-e24e-4acb-a4e7-e315d706994c" />

2. tabel buku
   <img width="1578" height="524" alt="image" src="https://github.com/user-attachments/assets/4d07e81d-2c98-401e-aea6-ff3845a3a032" />

3. tabel kaegori_buku
   <img width="1090" height="253" alt="image" src="https://github.com/user-attachments/assets/5a9b215f-a73a-4b62-a4e2-3240f8ffae89" />

4. tabel penerbit
   <img width="1153" height="192" alt="image" src="https://github.com/user-attachments/assets/f73a20d3-afa5-479f-8e3a-8336fee11bad" />

5. tabel transaksi
    <img width="1388" height="190" alt="image" src="https://github.com/user-attachments/assets/0e9350fa-8865-4fcc-a475-99a9233d2c42" />

Hasil query Join

1. JOIN untuk tampilkan buku dengan nama kategori dan penerbit
   <img width="1630" height="603" alt="image" src="https://github.com/user-attachments/assets/0f4adeee-cdcb-4976-bc8e-b7ca8fb5729c" />

2. Jumlah buku per kategori
   <img width="1517" height="376" alt="image" src="https://github.com/user-attachments/assets/e7a3a1d8-eb25-45af-8d88-3583ac0c3a42" />

3. Jumlah buku per penerbit
   <img width="1513" height="371" alt="image" src="https://github.com/user-attachments/assets/d8499349-3a19-4c72-b9da-7d38629c354e" />
   
4. Buku beserta detail lengkap (kategori + penerbit)
<img width="1557" height="364" alt="image" src="https://github.com/user-attachments/assets/3e23ec9c-0363-4679-9ff2-55b4b6896b9d" />



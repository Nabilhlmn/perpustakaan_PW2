<?php
// ============================================================
// Tugas 1: Form Registrasi Anggota Perpustakaan (40%)
// Pertemuan 5 - Form Handling
// ============================================================

// Function sanitasi input
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Variabel untuk error per field
$errors = [];
$success = '';
$submitted_data = null;

// Variabel untuk keep value
$nama = '';
$email = '';
$telepon = '';
$alamat = '';
$jenis_kelamin = '';
$tanggal_lahir = '';
$pekerjaan = '';

// Proses form jika di-submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Terima dan sanitasi data
    $nama = sanitize_input($_POST['nama'] ?? '');
    $email = sanitize_input($_POST['email'] ?? '');
    $telepon = sanitize_input($_POST['telepon'] ?? '');
    $alamat = sanitize_input($_POST['alamat'] ?? '');
    $jenis_kelamin = sanitize_input($_POST['jenis_kelamin'] ?? '');
    $tanggal_lahir = sanitize_input($_POST['tanggal_lahir'] ?? '');
    $pekerjaan = sanitize_input($_POST['pekerjaan'] ?? '');

    // =====================
    // VALIDASI PER FIELD
    // =====================

    // 1. Nama Lengkap (required, min 3 karakter)
    if (empty($nama)) {
        $errors['nama'] = "Nama lengkap wajib diisi";
    } elseif (strlen($nama) < 3) {
        $errors['nama'] = "Nama lengkap minimal 3 karakter";
    } elseif (strlen($nama) > 100) {
        $errors['nama'] = "Nama lengkap maksimal 100 karakter";
    }

    // 2. Email (required, format email valid)
    if (empty($email)) {
        $errors['email'] = "Email wajib diisi";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Format email tidak valid (contoh: nama@domain.com)";
    }

    // 3. Telepon (required, format: 08xxxxxxxxxx, 10-13 digit)
    if (empty($telepon)) {
        $errors['telepon'] = "Nomor telepon wajib diisi";
    } elseif (!preg_match('/^08\d{8,11}$/', $telepon)) {
        $errors['telepon'] = "Format telepon tidak valid (contoh: 081234567890, 10-13 digit dimulai 08)";
    }

    // 4. Alamat (required, min 10 karakter)
    if (empty($alamat)) {
        $errors['alamat'] = "Alamat wajib diisi";
    } elseif (strlen($alamat) < 10) {
        $errors['alamat'] = "Alamat minimal 10 karakter";
    } elseif (strlen($alamat) > 500) {
        $errors['alamat'] = "Alamat maksimal 500 karakter";
    }

    // 5. Jenis Kelamin (required)
    if (empty($jenis_kelamin)) {
        $errors['jenis_kelamin'] = "Jenis kelamin wajib dipilih";
    } else {
        $valid_jk = ['Laki-laki', 'Perempuan'];
        if (!in_array($jenis_kelamin, $valid_jk)) {
            $errors['jenis_kelamin'] = "Jenis kelamin tidak valid";
        }
    }

    // 6. Tanggal Lahir (required, umur min 10 tahun)
    if (empty($tanggal_lahir)) {
        $errors['tanggal_lahir'] = "Tanggal lahir wajib diisi";
    } else {
        $tgl_lahir = new DateTime($tanggal_lahir);
        $sekarang = new DateTime();
        $umur = $sekarang->diff($tgl_lahir)->y;

        if ($tgl_lahir > $sekarang) {
            $errors['tanggal_lahir'] = "Tanggal lahir tidak boleh di masa depan";
        } elseif ($umur < 10) {
            $errors['tanggal_lahir'] = "Umur minimal 10 tahun (umur Anda saat ini: $umur tahun)";
        }
    }

    // 7. Pekerjaan (required)
    if (empty($pekerjaan)) {
        $errors['pekerjaan'] = "Pekerjaan wajib dipilih";
    } else {
        $valid_pekerjaan = ['Pelajar', 'Mahasiswa', 'Pegawai', 'Lainnya'];
        if (!in_array($pekerjaan, $valid_pekerjaan)) {
            $errors['pekerjaan'] = "Pekerjaan tidak valid";
        }
    }

    // Jika tidak ada error, proses data
    if (count($errors) == 0) {
        // Generate ID anggota otomatis
        $id_anggota = 'AGT-' . date('Ymd') . '-' . str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);

        // Hitung umur
        $tgl_lahir = new DateTime($tanggal_lahir);
        $umur = (new DateTime())->diff($tgl_lahir)->y;

        // Simpan data yang sudah disubmit untuk ditampilkan
        $submitted_data = [
            'id' => $id_anggota,
            'nama' => $nama,
            'email' => $email,
            'telepon' => $telepon,
            'alamat' => $alamat,
            'jenis_kelamin' => $jenis_kelamin,
            'tanggal_lahir' => date('d F Y', strtotime($tanggal_lahir)),
            'umur' => $umur,
            'pekerjaan' => $pekerjaan,
            'tanggal_daftar' => date('d F Y H:i:s')
        ];

        $success = "Registrasi anggota berhasil! ID Anggota: <strong>$id_anggota</strong>";

        // Reset form setelah sukses
        $nama = '';
        $email = '';
        $telepon = '';
        $alamat = '';
        $jenis_kelamin = '';
        $tanggal_lahir = '';
        $pekerjaan = '';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Registrasi Anggota - Perpustakaan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <!-- Header -->
                <div class="text-center mb-4">
                    <h2><i class="bi bi-person-plus-fill text-primary"></i> Registrasi Anggota Perpustakaan</h2>
                    <p class="text-muted">Silakan isi form di bawah ini untuk mendaftar sebagai anggota perpustakaan</p>
                </div>

                <!-- Success Message -->
                <?php if ($success): ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill"></i> <?php echo $success; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php endif; ?>

                <!-- Tampilkan Data yang Berhasil Disubmit -->
                <?php if ($submitted_data): ?>
                <div class="card mb-4 border-success">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0"><i class="bi bi-person-check"></i> Data Anggota Terdaftar</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-borderless mb-0">
                                    <tr>
                                        <th width="140"><i class="bi bi-hash"></i> ID Anggota</th>
                                        <td>: <code><?php echo $submitted_data['id']; ?></code></td>
                                    </tr>
                                    <tr>
                                        <th><i class="bi bi-person"></i> Nama</th>
                                        <td>: <?php echo $submitted_data['nama']; ?></td>
                                    </tr>
                                    <tr>
                                        <th><i class="bi bi-envelope"></i> Email</th>
                                        <td>: <?php echo $submitted_data['email']; ?></td>
                                    </tr>
                                    <tr>
                                        <th><i class="bi bi-telephone"></i> Telepon</th>
                                        <td>: <?php echo $submitted_data['telepon']; ?></td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless mb-0">
                                    <tr>
                                        <th width="140"><i class="bi bi-gender-ambiguous"></i> Jenis Kelamin</th>
                                        <td>: <?php echo $submitted_data['jenis_kelamin']; ?></td>
                                    </tr>
                                    <tr>
                                        <th><i class="bi bi-calendar"></i> Tanggal Lahir</th>
                                        <td>: <?php echo $submitted_data['tanggal_lahir']; ?> (<?php echo $submitted_data['umur']; ?> tahun)</td>
                                    </tr>
                                    <tr>
                                        <th><i class="bi bi-briefcase"></i> Pekerjaan</th>
                                        <td>: <span class="badge bg-info"><?php echo $submitted_data['pekerjaan']; ?></span></td>
                                    </tr>
                                    <tr>
                                        <th><i class="bi bi-clock"></i> Tgl Daftar</th>
                                        <td>: <?php echo $submitted_data['tanggal_daftar']; ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <hr>
                        <p class="mb-0"><strong><i class="bi bi-geo-alt"></i> Alamat:</strong> <?php echo $submitted_data['alamat']; ?></p>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Global Error Summary -->
                <?php if (count($errors) > 0): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <h6><i class="bi bi-exclamation-triangle-fill"></i> Terdapat <?php echo count($errors); ?> kesalahan:</h6>
                    <ul class="mb-0">
                        <?php foreach ($errors as $field => $error): ?>
                        <li><strong><?php echo ucfirst(str_replace('_', ' ', $field)); ?>:</strong> <?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php endif; ?>

                <!-- Form Registrasi -->
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-clipboard-plus"></i> Form Registrasi</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="" novalidate>

                            <!-- Nama Lengkap -->
                            <div class="mb-3">
                                <label for="nama" class="form-label">
                                    <i class="bi bi-person"></i> Nama Lengkap <span class="text-danger">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control <?php echo isset($errors['nama']) ? 'is-invalid' : ''; ?>" 
                                       id="nama" name="nama" 
                                       value="<?php echo htmlspecialchars($nama); ?>" 
                                       placeholder="Masukkan nama lengkap">
                                <?php if (isset($errors['nama'])): ?>
                                <div class="invalid-feedback"><?php echo $errors['nama']; ?></div>
                                <?php endif; ?>
                                <small class="text-muted">Minimal 3 karakter</small>
                            </div>

                            <!-- Email & Telepon -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">
                                        <i class="bi bi-envelope"></i> Email <span class="text-danger">*</span>
                                    </label>
                                    <input type="email" 
                                           class="form-control <?php echo isset($errors['email']) ? 'is-invalid' : ''; ?>" 
                                           id="email" name="email" 
                                           value="<?php echo htmlspecialchars($email); ?>" 
                                           placeholder="contoh@email.com">
                                    <?php if (isset($errors['email'])): ?>
                                    <div class="invalid-feedback"><?php echo $errors['email']; ?></div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="telepon" class="form-label">
                                        <i class="bi bi-telephone"></i> Telepon <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" 
                                           class="form-control <?php echo isset($errors['telepon']) ? 'is-invalid' : ''; ?>" 
                                           id="telepon" name="telepon" 
                                           value="<?php echo htmlspecialchars($telepon); ?>" 
                                           placeholder="081234567890">
                                    <?php if (isset($errors['telepon'])): ?>
                                    <div class="invalid-feedback"><?php echo $errors['telepon']; ?></div>
                                    <?php endif; ?>
                                    <small class="text-muted">Format: 08xxxxxxxxxx (10-13 digit)</small>
                                </div>
                            </div>

                            <!-- Alamat -->
                            <div class="mb-3">
                                <label for="alamat" class="form-label">
                                    <i class="bi bi-geo-alt"></i> Alamat <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control <?php echo isset($errors['alamat']) ? 'is-invalid' : ''; ?>" 
                                          id="alamat" name="alamat" rows="3" 
                                          placeholder="Masukkan alamat lengkap"><?php echo htmlspecialchars($alamat); ?></textarea>
                                <?php if (isset($errors['alamat'])): ?>
                                <div class="invalid-feedback"><?php echo $errors['alamat']; ?></div>
                                <?php endif; ?>
                                <small class="text-muted">
                                    Minimal 10 karakter 
                                    <span id="alamat-count">(<?php echo strlen($alamat); ?>/500)</span>
                                </small>
                            </div>

                            <!-- Jenis Kelamin & Pekerjaan -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">
                                        <i class="bi bi-gender-ambiguous"></i> Jenis Kelamin <span class="text-danger">*</span>
                                    </label>
                                    <div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input <?php echo isset($errors['jenis_kelamin']) ? 'is-invalid' : ''; ?>" 
                                                   type="radio" name="jenis_kelamin" id="jk_laki" value="Laki-laki" 
                                                   <?php echo ($jenis_kelamin == 'Laki-laki') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="jk_laki">Laki-laki</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" 
                                                   type="radio" name="jenis_kelamin" id="jk_perempuan" value="Perempuan" 
                                                   <?php echo ($jenis_kelamin == 'Perempuan') ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="jk_perempuan">Perempuan</label>
                                        </div>
                                        <?php if (isset($errors['jenis_kelamin'])): ?>
                                        <div class="text-danger small"><?php echo $errors['jenis_kelamin']; ?></div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="pekerjaan" class="form-label">
                                        <i class="bi bi-briefcase"></i> Pekerjaan <span class="text-danger">*</span>
                                    </label>
                                    <select class="form-select <?php echo isset($errors['pekerjaan']) ? 'is-invalid' : ''; ?>" 
                                            id="pekerjaan" name="pekerjaan">
                                        <option value="">-- Pilih Pekerjaan --</option>
                                        <option value="Pelajar" <?php echo ($pekerjaan == 'Pelajar') ? 'selected' : ''; ?>>Pelajar</option>
                                        <option value="Mahasiswa" <?php echo ($pekerjaan == 'Mahasiswa') ? 'selected' : ''; ?>>Mahasiswa</option>
                                        <option value="Pegawai" <?php echo ($pekerjaan == 'Pegawai') ? 'selected' : ''; ?>>Pegawai</option>
                                        <option value="Lainnya" <?php echo ($pekerjaan == 'Lainnya') ? 'selected' : ''; ?>>Lainnya</option>
                                    </select>
                                    <?php if (isset($errors['pekerjaan'])): ?>
                                    <div class="invalid-feedback"><?php echo $errors['pekerjaan']; ?></div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <!-- Tanggal Lahir -->
                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">
                                    <i class="bi bi-calendar-date"></i> Tanggal Lahir <span class="text-danger">*</span>
                                </label>
                                <input type="date" 
                                       class="form-control <?php echo isset($errors['tanggal_lahir']) ? 'is-invalid' : ''; ?>" 
                                       id="tanggal_lahir" name="tanggal_lahir" 
                                       value="<?php echo htmlspecialchars($tanggal_lahir); ?>" 
                                       max="<?php echo date('Y-m-d'); ?>">
                                <?php if (isset($errors['tanggal_lahir'])): ?>
                                <div class="invalid-feedback"><?php echo $errors['tanggal_lahir']; ?></div>
                                <?php endif; ?>
                                <small class="text-muted">Umur minimal 10 tahun</small>
                            </div>

                            <!-- Info -->
                            <div class="alert alert-info">
                                <small><i class="bi bi-info-circle"></i> <strong>Catatan:</strong> Field dengan tanda (<span class="text-danger">*</span>) wajib diisi</small>
                            </div>

                            <hr>

                            <!-- Buttons -->
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="bi bi-person-check"></i> Daftar Sebagai Anggota
                                </button>
                                <button type="reset" class="btn btn-outline-secondary">
                                    <i class="bi bi-x-circle"></i> Reset Form
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Info Validasi -->
                <div class="card mt-3 shadow-sm">
                    <div class="card-header bg-info text-white">
                        <h6 class="mb-0"><i class="bi bi-shield-check"></i> Aturan Validasi</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="mb-0">
                                    <li>Nama lengkap minimal 3 karakter</li>
                                    <li>Email harus format valid</li>
                                    <li>Telepon format 08xx (10-13 digit)</li>
                                    <li>Alamat minimal 10 karakter</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="mb-0">
                                    <li>Jenis kelamin harus dipilih</li>
                                    <li>Umur minimal 10 tahun</li>
                                    <li>Pekerjaan harus dipilih</li>
                                    <li>Semua field wajib diisi</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Character counter untuk alamat
        document.getElementById('alamat').addEventListener('input', function() {
            var length = this.value.length;
            document.getElementById('alamat-count').textContent = '(' + length + '/500)';
        });
    </script>
</body>
</html>

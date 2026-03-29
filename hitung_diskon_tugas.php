<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Perhitungan Diskon - Tugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="card">
    <div class="card-header">
        <h5 class="card-title">Detail Pembelian</h5>
    </div>
    <div class="card-body">
        <table class="table table-striped">
            <tbody>
                <tr>
                    <th>Nama Pembeli</th>
                    <td><?php echo $nama_pembeli; ?></td>
                </tr>
                <tr>
                    <th>Judul Buku</th>
                    <td><?php echo $judul_buku; ?></td>
                </tr>
                <tr>
                    <th>Harga Satuan</th>
                    <td>Rp <?php echo number_format($harga_satuan, 0, ',', '.'); ?></td>
                </tr>
                <tr>
                    <th>Jumlah Beli</th>
                    <td><?php echo $jumlah_beli; ?> buku</td>
                </tr>
                <tr>
                    <th>Status Member</th>
                    <td><span class="badge bg-<?php echo $is_member ? 'success' : 'secondary'; ?>"><?php echo $is_member ? 'Member' : 'Non-Member'; ?></span></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">
        <h5 class="card-title">Rincian Perhitungan</h5>
    </div>
    <div class="card-body">
        <table class="table">
            <tbody>
                <tr>
                    <th>Subtotal</th>
                    <td>Rp <?php echo number_format($subtotal, 0, ',', '.'); ?></td>
                </tr>
                <tr>
                    <th>Diskon</th>
                    <td>Rp <?php echo number_format($diskon, 0, ',', '.'); ?> <span class="badge bg-info"><?php echo $persentase_diskon; ?>%</span></td>
                </tr>
                <?php if ($is_member): ?>
                <tr>
                    <th>Diskon Member</th>
                    <td>Rp <?php echo number_format($diskon_member, 0, ',', '.'); ?> <span class="badge bg-success">5%</span></td>
                </tr>
                <?php endif; ?>
                <tr>
                    <th>Total Setelah Diskon</th>
                    <td>Rp <?php echo number_format($total_setelah_diskon, 0, ',', '.'); ?></td>
                </tr>
                <tr>
                    <th>PPN (11%)</th>
                    <td>Rp <?php echo number_format($ppn, 0, ',', '.'); ?></td>
                </tr>
                <tr class="table-primary">
                    <th>Total Akhir</th>
                    <td><strong>Rp <?php echo number_format($total_akhir, 0, ',', '.'); ?></strong></td>
                </tr>
                <tr>
                    <th>Total Penghematan</th>
                    <td>Rp <?php echo number_format($total_hemat, 0, ',', '.'); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

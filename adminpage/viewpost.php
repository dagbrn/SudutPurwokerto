<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h3>Tambah <?php echo htmlspecialchars(ucfirst($type)); ?></h3>

    <form action="" method="post" enctype="multipart/form-data">
        <!-- Nama -->
        <div>
            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" autocomplete="off" required>
        </div>

        <!-- Lokasi -->
        <div>
            <label for="lokasi">Lokasi</label>
            <input type="text" name="lokasi" id="lokasi" required>
        </div>

        <!-- Input Khusus Berdasarkan Jenis Postingan -->
        <?php if ($type == 'kuliner'): ?>
            <div>
                <label for="harga">Harga Rata-Rata</label>
                <input type="text" name="harga" id="harga" required>
            </div>
            <div>
                <label for="jam">Jam Operasional</label>
                <input type="text" name="jam" id="jam" required>
            </div>
            <div>
                <label for="tambahan">Menu Unggulan</label>
                <input type="text" name="tambahan" id="tambahan" required>
            </div>
        <?php elseif ($type == 'wisata'): ?>
            <div>
                <label for="harga">Harga Tiket Masuk</label>
                <input type="text" name="harga" id="harga" required>
            </div>
            <div>
                <label for="jam">Jam Operasional</label>
                <input type="text" name="jam" id="jam" required>
            </div>
            <div>
                <label for="tambahan">Fasilitas</label>
                <input type="text" name="tambahan" id="tambahan" required>
            </div>
        <?php elseif ($type == 'event'): ?>
            <div>
                <label for="tanggal">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" required>
            </div>
            <div>
                <label for="jam">Waktu</label>
                <input type="time" name="jam" id="jam" required>
            </div>
            <div>
                <label for="harga">Tiket Masuk</label>
                <input type="text" name="harga" id="harga" required>
            </div>
            <div>
                <label for="tambahan">Social Media</label>
                <input type="text" name="tambahan" id="tambahan" required>
            </div>
        <?php endif; ?>

        <!-- Deskripsi -->
        <div>
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="4" required></textarea>
        </div>

        <!-- Foto -->
        <div>
            <label for="foto">Foto</label>
            <input type="file" name="foto" id="foto" accept="image/*" required>
        </div>

        <!-- Tombol Submit -->
        <div>
            <button type="submit">Tambah</button>
        </div>
    </form>
</body>
</html>
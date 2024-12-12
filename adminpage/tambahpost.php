<?php
require "../koneksi.php";

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$type = isset($_GET['type']) ? $_GET['type'] : '';

// Proses penyimpanan data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    if (isset($_POST['batal'])) {
        header("Location: kelolapost.php?type=" . urlencode($type));
        exit();
    }
    $nama = $_POST['nama'];
    $lokasi = $_POST['lokasi'];
    $deskripsi = $_POST['deskripsi'];
    $harga = isset($_POST['harga']) ? $_POST['harga'] : null;
    $jam = isset($_POST['jam']) ? $_POST['jam'] : null;
    $tanggal = isset($_POST['tanggal']) ? $_POST['tanggal'] : null;
    $tambahan = isset($_POST['tambahan']) ? $_POST['tambahan'] : null;

    // Upload Foto
    $foto = '';
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
        $targetDir = "../asset/";
        $namafoto = time() . "_" . basename($_FILES['foto']['name']);
        $targetFile = $targetDir . $namafoto;

        if (move_uploaded_file($_FILES['foto']['tmp_name'], $targetFile)) {
            $foto = $namafoto;
        } else {
            echo "Error: Foto gagal diupload.";
            exit;
        }
    }

    // Query untuk menyimpan data berdasarkan jenis postingan
    if ($type == 'kuliner') {
        $query = "INSERT INTO tempat_kuliner (nama_kuliner, lokasi_kuliner, foto_kuliner, deskripsi_kuliner, menu, range_harga, jam_kuliner) 
                  VALUES ('$nama', '$lokasi', '$foto', '$deskripsi', '$tambahan', '$harga', '$jam')";
    } elseif ($type == 'wisata') {
        $query = "INSERT INTO tempat_wisata (nama_wisata, lokasi_wisata, foto_wisata, deskripsi_wisata, fasilitas_wisata, tiket_wisata, jam_wisata) 
                  VALUES ('$nama', '$lokasi', '$foto', '$deskripsi', '$tambahan', '$harga', '$jam')";
    } elseif ($type == 'event') {
        $query = "INSERT INTO event (nama_event, tanggal_event, lokasi_event, foto_event, deskripsi_event, waktu_event, tiket_event, socmed_event) 
                  VALUES ('$nama', '$tanggal', '$lokasi', '$foto', '$deskripsi', '$jam', '$harga', '$tambahan')";
    } else {
        echo "Jenis postingan tidak valid.";
        exit;
    }

    if (mysqli_query($conn, $query)) {
        echo "Data berhasil disimpan.";
        ?>
        <meta http-equiv="refresh" content="2; url=kelolapost.php?type=<?php echo$type; ?>"/>
        <?php
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah <?php echo htmlspecialchars($type); ?></title>
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
            <button type="submit" name="batal">Batal</button>
        </div>
        <div>
            <button type="submit">Tambah</button>
        </div>
    </form>
</body>
</html>

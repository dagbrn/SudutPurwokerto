<?php
require "../koneksi.php";
require "adminonly.php";

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$type = isset($_GET['type']) ? $_GET['type'] : '';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($type == 'kuliner') {
    $title = "Edit Kuliner";
    $query = "SELECT nama_kuliner AS nama, lokasi_kuliner AS lokasi, 
              deskripsi_kuliner AS deskripsi, menu AS tambahan, range_harga AS harga, jam_kuliner AS jam 
              FROM tempat_kuliner WHERE id_kuliner = $id";
} elseif ($type == 'wisata') {
    $title = "Edit Wisata";
    $query = "SELECT nama_wisata AS nama, lokasi_wisata AS lokasi, 
              deskripsi_wisata AS deskripsi, fasilitas_wisata AS tambahan, tiket_wisata AS harga, 
              jam_wisata AS jam FROM tempat_wisata WHERE id_wisata = $id";
} elseif ($type == 'event') {
    $title = "Edit Event";
    $query = "SELECT nama_event AS nama, lokasi_event AS lokasi, 
              deskripsi_event AS deskripsi, tanggal_event AS tanggal, waktu_event AS waktu, 
              tiket_event AS harga, socmed_event AS tambahan 
              FROM event WHERE id_event = $id";
} else {
    echo "Jenis postingan tidak valid.";
    exit();
}

// Ambil data postingan untuk diedit
$result = mysqli_query($conn, $query);
if (!$result || mysqli_num_rows($result) == 0) {
    echo "Postingan tidak ditemukan.";
    exit();
}

$row = mysqli_fetch_assoc($result);

// Proses update jika form disubmit
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


    // Query untuk memperbarui data
    if ($type == 'kuliner') {
        $update_query = "UPDATE tempat_kuliner SET 
            nama_kuliner = '$nama', 
            lokasi_kuliner = '$lokasi', 
            deskripsi_kuliner = '$deskripsi', 
            menu = '$tambahan', 
            range_harga = '$harga', 
            jam_kuliner = '$jam' 
            WHERE id_kuliner = $id";
    } elseif ($type == 'wisata') {
        $update_query = "UPDATE tempat_wisata SET 
            nama_wisata = '$nama', 
            lokasi_wisata = '$lokasi', 
            deskripsi_wisata = '$deskripsi', 
            fasilitas_wisata = '$tambahan', 
            tiket_wisata = '$harga', 
            jam_wisata = '$jam' 
            WHERE id_wisata = $id";
    } elseif ($type == 'event') {
        $update_query = "UPDATE event SET 
            nama_event = '$nama', 
            lokasi_event = '$lokasi', 
            deskripsi_event = '$deskripsi', 
            tanggal_event = '$tanggal', 
            waktu_event = '$waktu', 
            tiket_event = '$harga', 
            socmed_event = '$tambahan' 
            WHERE id_event = $id";
    }

    if (mysqli_query($conn, $update_query)) {
        echo "<p>Postingan berhasil diperbarui.</p>";
        echo '<meta http-equiv="refresh" content="2; url=kelolapost.php?type=' . $type . '"/>';
    } else {
        echo "<p>Error: " . mysqli_error($conn) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?></title>
</head>
<body>
    <h3 > Edit <?php echo htmlspecialchars(ucfirst($type)); ?></h3>

    <form action="" method="post" enctype="multipart/form-data">
        <!-- Nama -->
        <div>
            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($row['nama']); ?>" autocomplete="off" required>
        </div>

        <!-- Lokasi -->
        <div>
            <label for="lokasi">Lokasi</label>
            <input type="text" name="lokasi" id="lokasi" value="<?php echo htmlspecialchars($row['lokasi']); ?>" required>
        </div>

        <!-- Input Khusus Berdasarkan Jenis Postingan -->
        <?php if ($type == 'kuliner'): ?>
            <div>
                <label for="harga">Harga Rata-Rata</label>
                <input type="text" name="harga" id="harga" value="<?php echo htmlspecialchars($row['harga']); ?>" required>
            </div>
            <div>
                <label for="jam">Jam Operasional</label>
                <input type="text" name="jam" id="jam" value="<?php echo htmlspecialchars($row['jam']); ?>" required>
            </div>
            <div>
                <label for="tambahan">Menu Unggulan</label>
                <input type="text" name="tambahan" id="tambahan" value="<?php echo htmlspecialchars($row['tambahan']); ?>" required>
            </div>
        <?php elseif ($type == 'wisata'): ?>
            <div>
                <label for="harga">Harga Tiket Masuk</label>
                <input type="text" name="harga" id="harga" value="<?php echo htmlspecialchars($row['harga']); ?>" required>
            </div>
            <div>
                <label for="jam">Jam Operasional</label>
                <input type="text" name="jam" id="jam" value="<?php echo htmlspecialchars($row['jam']); ?>" required>
            </div>
            <div>
                <label for="tambahan">Fasilitas</label>
                <input type="text" name="tambahan" id="tambahan" value="<?php echo htmlspecialchars($row['tambahan']); ?>" required>
            </div>
        <?php elseif ($type == 'event'): ?>
            <div>
                <label for="tanggal">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" value="<?php echo htmlspecialchars($row['tanggal']); ?>" required>
            </div>
            <div>
                <label for="jam">Waktu</label>
                <input type="time" name="jam" id="jam" value="<?php echo htmlspecialchars($row['waktu']); ?>" required>
            </div>
            <div>
                <label for="harga">Tiket Masuk</label>
                <input type="text" name="harga" id="harga" value="<?php echo htmlspecialchars($row['harga']); ?>" required>
            </div>
            <div>
                <label for="tambahan">Social Media</label>
                <input type="text" name="tambahan" id="tambahan" value="<?php echo htmlspecialchars($row['tambahan']); ?>" required>
            </div>
        <?php endif; ?>

        <!-- Deskripsi -->
        <div>
            <label for="deskripsi">Deskripsi</label>
            <textarea name="deskripsi" id="deskripsi" rows="4" required><?php echo htmlspecialchars($row['deskripsi']); ?></textarea>
        </div>
        
        <!-- Tombol Submit -->
        <div>
            <button type="submit" name="batal">Batal</button>
        </div>
        <div>
            <button type="submit">Update</button>
        </div>
    </form>
</body>
</html>
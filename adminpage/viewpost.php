<?php
require "../koneksi.php";
require "adminonly.php";

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$type = isset($_GET['type']) ? $_GET['type'] : '';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($type == 'kuliner') {
    $query = "SELECT nama_kuliner AS nama, lokasi_kuliner AS lokasi, foto_kuliner AS foto, 
              deskripsi_kuliner AS deskripsi, menu, range_harga, jam_kuliner AS jam 
              FROM tempat_kuliner WHERE id_kuliner = $id";
} elseif ($type == 'wisata') {
    $query = "SELECT nama_wisata AS nama, lokasi_wisata AS lokasi, foto_wisata AS foto, 
              deskripsi_wisata AS deskripsi, fasilitas_wisata AS fasilitas, tiket_wisata AS tiket, 
              jam_wisata AS jam FROM tempat_wisata WHERE id_wisata = $id";
} elseif ($type == 'event') {
    $query = "SELECT nama_event AS nama, tanggal_event AS tanggal, lokasi_event AS lokasi, 
              foto_event AS foto, deskripsi_event AS deskripsi, waktu_event AS waktu, 
              tiket_event AS tiket, socmed_event AS socmed 
              FROM event WHERE id_event = $id";
} else {
    echo "Jenis postingan tidak valid.";
    exit;
}

// Proses penghapusan komentar
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['hapus_komentar'])) {
    $id_komentar = $_POST['id_komentar'];
    $deleteQuery = "DELETE FROM komentar WHERE id_komentar = $id_komentar";

    if (mysqli_query($conn, $deleteQuery)) {
        echo "Komentar berhasil dihapus.";
        echo '<meta http-equiv="refresh" content="2; url=viewpost.php?type=' . $type . '&id=' . $id . '"/>';
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Mengambil data postingan
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

if ($row) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo htmlspecialchars($row['nama']); ?></title>
    </head>
    <body>
        <h1><?php echo htmlspecialchars($row['nama']); ?></h1>
        <img src="../asset/<?php echo htmlspecialchars($row['foto']); ?>" alt="<?php echo htmlspecialchars($row['nama']); ?>" style="width:300px;">
        <p>Lokasi: <?php echo htmlspecialchars($row['lokasi']); ?></p>
        <p>Deskripsi: <?php echo htmlspecialchars($row['deskripsi']); ?></p>

        <?php if ($type == 'kuliner'): ?>
            <p>Menu: <?php echo htmlspecialchars($row['menu']); ?></p>
            <p>Range Harga: <?php echo htmlspecialchars($row['range_harga']); ?></p>
            <p>Jam Operasional: <?php echo htmlspecialchars($row['jam']); ?></p>
        <?php elseif ($type == 'wisata'): ?>
            <p>Fasilitas: <?php echo htmlspecialchars($row['fasilitas']); ?></p>
            <p>Tiket Masuk: <?php echo htmlspecialchars($row['tiket']); ?></p>
            <p>Jam Operasional: <?php echo htmlspecialchars($row['jam']); ?></p>
        <?php elseif ($type == 'event'): ?>
            <p>Tanggal: <?php echo htmlspecialchars($row['tanggal']); ?></p>
            <p>Waktu: <?php echo htmlspecialchars($row['waktu']); ?></p>
            <p>Tiket: <?php echo htmlspecialchars($row['tiket']); ?></p>
            <p>Media Sosial: <?php echo htmlspecialchars($row['socmed']); ?></p>
        <?php endif; ?>

        <h3>Komentar Pengguna</h3>

        <?php
        // Mengambil komentar
        $komentarQuery = "SELECT k.id_komentar, k.isi_komentar, k.tanggal_komentar, a.username 
                          FROM komentar k
                          JOIN akun a ON k.id_akun = a.id_akun
                          WHERE k.id_postingan = $id AND k.type_postingan = '$type'
                          ORDER BY k.tanggal_komentar DESC LIMIT 3";
        $komentarResult = mysqli_query($conn, $komentarQuery);

        if (mysqli_num_rows($komentarResult) > 0) {
            while ($komentar = mysqli_fetch_assoc($komentarResult)) {
                echo "<div><strong>" . htmlspecialchars($komentar['username']) . "</strong>: " . htmlspecialchars($komentar['isi_komentar']) . "<br><small>" . htmlspecialchars($komentar['tanggal_komentar']) . "</small>";
                // Tombol hapus
                echo "<form method='POST' action='' style='display:inline;'>
                        <input type='hidden' name='id_komentar' value='" . intval($komentar['id_komentar']) . "'>
                        <button type='submit' name='hapus_komentar' onclick='return confirm(\"Apakah Anda yakin ingin menghapus komentar ini?\");'>Hapus</button>
                      </form>";
                echo "</div><hr>";
            }
        } else {
            echo "<p>Tidak ada komentar.</p>";
        }
        ?>
    </body>
    </html>
    <?php
} else {
    echo "Postingan tidak ditemukan.";
}

mysqli_close($conn);
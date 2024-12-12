<?php
require "../koneksi.php";
require "adminonly.php";

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$type = isset($_GET['type']) ? $_GET['type'] : '';
if ($type == 'kuliner') {
    $title = "Kelola Kuliner";
    // Query buat tempat kuliner
    $query = "SELECT id_kuliner AS id, nama_kuliner AS nama, tgl AS tanggal FROM tempat_kuliner";
} elseif ($type == 'wisata') {
    $title = "Kelola Wisata";
    // Query buat tempat wisata
    $query = "SELECT id_wisata AS id, nama_wisata AS nama, tgl AS tanggal FROM tempat_wisata";
} elseif ($type == 'event') {
    $title = "Kelola Event";
    // Query buat event
    $query = "SELECT id_event AS id, nama_event AS nama, tgl AS tanggal FROM event";
} else {
    echo "Jenis postingan tidak valid.";
    exit();
}

// Proses hapus kalo ada permintaan
if (isset($_POST['delete'])) {
    $post_id = intval($_POST['post_id']);
    
    // Query buat menghapus postingan
    if ($type == 'kuliner') {
        $delete_query = "DELETE FROM tempat_kuliner WHERE id_kuliner = $post_id";
    } elseif ($type == 'wisata') {
        $delete_query = "DELETE FROM tempat_wisata WHERE id_wisata = $post_id";
    } elseif ($type == 'event') {
        $delete_query = "DELETE FROM event WHERE id_event = $post_id";
    }

    if (mysqli_query($conn, $delete_query)) {
        echo "<p>Postingan berhasil dihapus.</p>";
        ?>
        <meta http-equiv="refresh" content="2; url=kelolapost.php?type=<?php echo$type; ?>"/>
        <?php
    } else {
        echo "<p>Error: " . mysqli_error($conn) . "</p>";
    }
}

$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query gagal: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
</head>
<body>

<h2><?php echo $title; ?></h2>
<a href="tambahpost.php?type=<?php echo $type; ?>">+ Tambah Konten</a>

<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Judul Postingan</th>
            <th>Tanggal</th>
            <th>Komentar</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['nama']; ?></td>
                <td><?php echo date('d-m-Y', strtotime($row['tanggal'])); ?></td>
                <td><?php echo isset($row['komentar']) ? $row['komentar'] : ''; ?></td>
                <td>
                    <a href="editpost.php?type=<?php echo $type; ?>&id=<?php echo $row['id']; ?>">Edit</a>
                    <form action="" method="POST" style="display:inline;">
                        <input type="hidden" name="post_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="delete" class="" onclick="return confirm('Apakah Anda yakin ingin menghapus postingan ini?');">Delete</button>
                    </form>
                    <a href="viewpost.php?type=<?php echo $type; ?>&id=<?php echo $row['id']; ?>">Lihat</a>
                </td>
            </tr>
            <?php
        }
    } else {
        echo "<p>Tidak ada data buat jenis postingan ini.</p>";
    }
    ?>
    </tbody>
</table>

</body>
</html>
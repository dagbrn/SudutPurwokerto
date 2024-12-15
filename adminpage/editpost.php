<?php
require "../koneksi.php";
require "adminonly.php";

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$type = isset($_GET['type']) ? $_GET['type'] : '';
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$queryAdmin = "SELECT nama_lengkap AS nama, foto FROM akun WHERE id_akun = " . $_SESSION["id_akun"];
$informasiAdmin = mysqli_query($conn, $queryAdmin);
$dataAdmin = mysqli_fetch_assoc($informasiAdmin);


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
            waktu_event = '$jam', 
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
    <meta name=" viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?></title>
    <style>
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            margin: 0;
            padding: 20px 40px;
            background-color: rgb(255, 251, 239);
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 24px;
            margin: 0;
        }

        .admin-text {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .container {
            display: flex;
            gap: 30px;
        }
        
        .sidebar {
            width: 250px;
        }
        
        .sidebar a{
            text-decoration: none;
        }

        .menu-item {
            display: flex;
            align -items: center;
            gap: 10px;
            padding: 12px 20px;
            margin: 5px 0;
            border-radius: 10px;
            color: #333;
            font-size: 16px;
            text-decoration: none;
        }

        .menu-item.active {
            background-color: #D7EAE4;
        }


        .content {
            flex: 1;
            background-color: #D7EAE4;
            border-radius: 20px;
            padding: 40px;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.6);
            border-radius: 15px;
            padding: 40px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .form-layout {
            display: flex;
            gap: 60px;
        }

        .left-section, .right-section {
            width: 45%;
        }

        .form-group {
            margin-bottom: 35px;
        }

        .form-group label {
            display: block;
            font-weight: 500;
            margin-bottom: 12px;
            font-size: 16px;
        }

        .form-control {
            width: 100%;
            padding: 15px;
            border: 1px solid #96B6AB;
            border-radius: 12px;
            font-size: 14px;
            background-color: rgba(255, 255, 255, 0.9);
        }

        .button-group {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 30px;
        }

        .btn-cancel {
            padding: 12px 40px;
            border: 2px solid #FFD966;
            background: #fff;
            color: #FFD966;
            border-radius: 25px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
        }

        .btn-submit {
            padding: 12px 40px;
            border: none;
            background: #FFD966;
            color: black;
            border-radius: 25px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
        }

        .btn-cancel:hover {
            background-color: rgba(255, 217, 102, 0.1);
        }

        .btn-submit:hover {
            background-color: #ffd042;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>SudutPurwokerto</h1>
        <div class="admin-text">
            <img src="../userimage/pp.png" width="24" height="24">
            <?php echo $dataAdmin['nama']; ?>
        </div>
    </div>

    <div class="container">
        <div class="sidebar">
            <a href="../adminpage/">
                <div class="menu-item <?php echo $currentPage === 'index.php' ? 'active' : ''; ?>">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M4 13h6c.55 0 1-.45 1-1V4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v8c0 .55.45 1 1 1zm0 8h6c.55 0 1-.45 1-1v-4c0-.55-.45-1-1-1H4c-.55 0-1 .45-1 1v4c0 .55.45 1 1 1zm10 0h6c.55 0 1-.45 1-1v-8c0-.55-.45-1-1-1h-6c-.55 0-1 .45-1 1v8c0 .55.45 1 1 1zM13 4v4c0 .55.45 1 1 1h6c.55 0 1-.45 1-1V4c0-.55-.45-1-1-1h-6c-.55 0-1 .45-1 1z" fill="currentColor"/>
                    </svg>
                    Dashboard
                </div>
            </a>
            <a href="kelolapost.php?type=kuliner">
                <div class="menu-item <?php echo isset($_GET['type']) && $_GET['type'] === 'kuliner' ? 'active' : ''; ?>">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                        <path d="M11 9H9V2H7v7H5V2H3v7c0 2.12 1.66 3.84 3.75 3.97V22h2.5v-9.03C11.34 12.84 13 11.12 13 9V2h-2v7zm5-3v8h2.5v8H21V2c-2.76 0-5 2.24-5 4z"/>
                    </svg>
                    Kelola Kuliner
                </div>
            </a>
            <a href="kelolapost.php?type=wisata">
                <div class="menu-item <?php echo isset($_GET['type']) && $_GET['type'] === 'wisata' ? 'active' : ''; ?>">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                        <path d="M14 6l-4.22 5.63 1.25 1.67L14 9.33 19 16h-8.46l-4.01-5.37L1  18h22L14 6zM5 16l1.52-2.03L8.04 16H5z"/>
                    </svg>
                    Kelola Wisata
                </div>
            </a>
            <a href="kelolapost.php?type=event">
                <div class="menu-item <?php echo isset($_GET['type']) && $_GET['type'] === 'event' ? 'active' : ''; ?>">
                    <svg width="24" height="24" viewBox="0 0 24 24">
                        <path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10zM9 14H7v-2h2v2zm4 0h-2v-2h2v2zm4 0h-2v-2h2v2zm-8 4H7v-2h2v2zm4 0h-2v-2h2v2zm4 0h-2v-2h2v2z"/>
                    </svg>
                    Kelola Event
                </div>
            </a>
        </div>

        <div class="content">
            <h2>Edit <?php echo htmlspecialchars(ucfirst($type)); ?></h2>
            
            <div class="form-container">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-layout">
                    <div class="left-section">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="nama" value="<?php echo htmlspecialchars($row['nama']); ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Lokasi</label>
                            <input type="text" class="form-control" name="lokasi" value="<?php echo htmlspecialchars($row['lokasi']); ?>" required>
                        </div>

                        <?php if ($type == 'kuliner'): ?>
                                <div class="form-group">
                                    <label>Harga Rata-Rata</label>
                                    <input type="text" class="form-control" name="harga" value="<?php echo htmlspecialchars($row['harga']); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Jam Operasional</label>
                                    <input type="text" class="form-control" name="jam" value="<?php echo htmlspecialchars($row['jam']); ?>">
                                </div>
                            <?php elseif ($type == 'wisata'): ?>
                                <div class="form-group">
                                    <label>Harga Tiket Masuk</label>
                                    <input type="text" class="form-control" name="harga" value="<?php echo htmlspecialchars($row['harga']); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Jam Operasional</label>
                                    <input type="text" class="form-control" name="jam" value="<?php echo htmlspecialchars($row['jam']); ?>">
                                </div>
                            <?php elseif ($type == 'event'): ?>
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="date" class="form-control" name="tanggal" value="<?php echo htmlspecialchars($row['tanggal']); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Waktu</label>
                                    <input type="text" class="form-control" name="jam" value="<?php echo htmlspecialchars($row['waktu']); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Tiket Masuk</label>
                                    <input type="text" class="form-control" name="harga" value="<?php echo htmlspecialchars($row['harga']); ?>">
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="right-section">
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" rows="4"><?php echo htmlspecialchars($row['deskripsi']); ?></textarea>
                            </div>

                            <?php if ($type == 'kuliner'): ?>
                                <div class="form-group">
                                    <label>Menu Unggulan</label>
                                    <textarea class="form-control" name="tambahan" rows="4"><?php echo htmlspecialchars($row['tambahan']); ?></textarea>
                                </div>
                            <?php elseif ($type == 'wisata'): ?>
                                <div class="form-group">
                                    <label>Fasilitas</label>
                                    <textarea class="form-control" name="tambahan" rows="4"><?php echo htmlspecialchars($row['tambahan']); ?></textarea>
                                </div>
                            <?php elseif ($type == 'event'): ?>
                                <div class="form-group">
                                    <label>Social Media</label>
                                    <textarea class="form-control" name="tambahan" rows="4"><?php echo htmlspecialchars($row['tambahan']); ?></textarea>
                                </div>
                            <?php endif; ?>
                    </div>
                </div>

                <div class="button-group">
                    <button type="submit" name="batal" class="btn-cancel">Batal</button>
                    <button type="submit" class="btn-submit">Simpan</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</body>
</html>
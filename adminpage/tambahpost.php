<?php
require "../koneksi.php";
require "adminonly.php";

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$type = isset($_GET['type']) ? $_GET['type'] : '';

$queryAdmin = "SELECT nama_lengkap AS nama, foto FROM akun WHERE id_akun = " . $_SESSION["id_akun"];
$informasiAdmin = mysqli_query($conn, $queryAdmin);
$dataAdmin = mysqli_fetch_assoc($informasiAdmin);


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

    if (empty($nama) || empty($lokasi) || empty($deskripsi)) {
        echo "<script>
            alert('Nama, Lokasi, dan Deskripsi Wajib diisi.');
            window.location.href = 'kelolapost.php?type=$type';
            </script>";
            exit();
    }

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
        echo "<script>
            alert('Data berhasil dimasukkan.');
            </script>";
        ?>
        <meta http-equiv="refresh" content="2; url=kelolapost.php?type=<?php echo$type; ?>"/>
        <?php
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah <?php echo htmlspecialchars(ucfirst($type)); ?></title>
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

        .admin-text::before {
            content: '';
            display: inline-block;
            width: 24px;
            height: 24px;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
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

        .content h2 {
            font-size: 32px;
            margin: 0 0 30px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .form-container {
            background: rgba(255, 255, 255, 0.6);
            border-radius: 15px;
            padding: 30px;
        }

        .form-layout {
            display: flex;
            gap: 30px;
        }

        .left-section {
            width: 35%;
        }

        .right-section {
            width: 65%;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #96B6AB;
            border-radius: 8px;
            font-size: 14px;
            box-sizing: border-box;
            background: rgba(255, 255, 255, 0.8);
        }

        .button-group {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 20px;
        }

        .file-upload {
            width: 100%;
            margin: 20px 0;
        }

        .upload-box {
            border: 2px dashed #96B6AB; 
            border-radius: 8px;
            padding: 40px;
            text-align: center; 
            cursor: pointer; 
            background: rgba(255, 255, 255, 0.8);
            transition: background 0.3s;
        }

        .upload-box:hover {
            background: rgba(255, 217, 102, 0.2); 
        }

        .upload-box svg {
            fill: #96B6AB;
            margin-bottom: 10px; 
        }

        .upload-box p {
            color: #96B6AB;
            margin: 0; 
            font-size: 14px;
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
            <h2>Tambah <?php echo htmlspecialchars(ucfirst($type)); ?></h2>
            
            <div class="form-container">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-layout">
                        <div class="left-section">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control" name="nama">
                            </div>
                            
                            <div class="form-group">
                                <label>Lokasi</label>
                                <input type="text" class="form-control" name="lokasi">
                            </div>
                            
                            <?php if ($type == 'kuliner'): ?>
                                <div class="form-group">
                                    <label>Harga Rata-Rata</label>
                                    <input type="text" class="form-control" name="harga">
                                </div>
                                <div class="form-group">
                                    <label>Jam Operasional</label>
                                    <input type="text" class="form-control" name="jam">
                                </div>
                            <?php elseif ($type == 'wisata'): ?>
                                <div class="form-group">
                                    <label>Harga Tiket Masuk</label>
                                    <input type="text" class="form-control" name="harga">
                                </div>
                                <div class="form-group">
                                    <label>Jam Operasional</label>
                                    <input type="text" class="form-control" name="jam">
                                </div>
                            <?php elseif ($type == 'event'): ?>
                                <div class="form-group">
                                    <label>Tanggal</label>
                                    <input type="date" class="form-control" name="tanggal">
                                </div>
                                <div class="form-group">
                                    <label>Waktu</label>
                                    <input type="time" class="form-control" name="jam">
                                </div>
                                <div class="form-group">
                                    <label>Tiket Masuk</label>
                                    <input type="text" class="form-control" name="harga">
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="right-section">
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" rows="4"></textarea>
                            </div>

                            <?php if ($type == 'kuliner'): ?>
                                <div class="form-group">
                                    <label>Menu Unggulan</label>
                                    <textarea class="form-control" name="tambahan" rows="4"></textarea>
                                </div>
                            <?php elseif ($type == 'wisata'): ?>
                                <div class="form-group">
                                    <label>Fasilitas</label>
                                    <textarea class="form-control" name="tambahan" rows="4"></textarea>
                                </div>
                            <?php elseif ($type == 'event'): ?>
                                <div class="form-group">
                                    <label>Social Media</label>
                                    <textarea class="form-control" name="tambahan" rows="4"></textarea>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="file-upload">
    <div class="upload-box" onclick="document.getElementById('foto').click();">
        <svg width="24" height="24" viewBox="0 0 24 24">
            <path d="M19 7v3h-2V7h-3V5h3V2h2v3h3v2h-3zm-3 4V8h-3V5H5c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2v-8h-3zM5 19l3-4 2 3 3-4 4 5H5z"/>
        </svg>
        <p>Klik untuk memilih file</p>
        <input type="file" name="foto" id="foto" accept="image/*" style="display:none;">
    </div>
</div>

                    <div class="button-group">
                        <button type="submit" name="batal" class="btn-cancel">Batal</button>
                        <button type="submit" class="btn-submit">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
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

$komentarQuery = "SELECT k.id_komentar, k.isi_komentar, k.tanggal_komentar, a.username, a.foto 
                  FROM komentar k
                  JOIN akun a ON k.id_akun = a.id_akun
                  WHERE k.id_postingan = $id AND k.type_postingan = '$type'
                  ORDER BY k.tanggal_komentar";
$komentarResult = mysqli_query($conn, $komentarQuery);

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
        <link rel="stylesheet" href="../css/viewpost.css">
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
            <h2>Kelola <?php echo htmlspecialchars(ucfirst($type)); ?> - <?php echo htmlspecialchars(ucfirst($row['nama'])); ?></h2>

            <div class="form-container">
                <h1><?php echo htmlspecialchars(ucfirst($row['nama'])); ?></h1>
                <div class="event-details">
                    <?php if($type == 'event'): ?>
                    <div class="date-info">
                        <svg class="calendar-icon" viewBox="0 0 24 24">
                            <path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10zM9 14H7v-2h2v2zm4 0h-2v-2h2v2zm4 0h-2v-2h2v2z"/>
                        </svg>
                        <span><?php echo htmlspecialchars($row['tanggal']); ?></span>
                    </div>
                    <?php endif; ?>
                    <div class="location-info">
                        <svg class="location-icon" viewBox="0 0 24 24">
                            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                        </svg>
                        <span><?php echo htmlspecialchars(ucfirst($row['lokasi'])); ?></span>
                    </div>
                </div>

                <div class="form-layout">
                    <!-- Kolom Kiri -->
                    <div class="left-section">
                        <img src="../asset/<?php echo htmlspecialchars($row['foto']); ?>" alt="<?php echo htmlspecialchars($row['nama']); ?>" style="width: 100%; border-radius: 10px;">
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="right-section">
                        <div class="form-group">
                            <h3>Deskripsi:</h3>
                            <p><?php echo htmlspecialchars($row['deskripsi']); ?></p>
                        </div>
                        
                        <?php if ($type == 'kuliner'): ?>
                            <div class="form-group">
                                <h3>Menu Unggulan</h3>
                                <ul style="list-style-type: none; margin-bottom: 1rem;">
                                    <?php 
                                $menuItems = explode(", ", $row['menu']);
                                foreach ($menuItems as $item) {
                                    ?>
                                <li style="line-height: 1.6; margin-bottom: 0.1rem;">• <?php echo htmlspecialchars($item); ?></li>
                                    <?php 
                                }
                                    ?>
                                </ul>
                            </div>
                            <div class="form-group">
                                <h3>Harga Rata-Rata:</h3>
                                <p ><?php echo $row['range_harga']; ?></p>
                            </div>

                            <div class="form-group">
                            <h3>Jam Operasional:</h3>
                            <p><?php echo $row['jam']; ?></p>
                            </div>

                        <!-- Untuk Postingan Wisata -->
                        <?php elseif ($type == 'wisata'): ?>
                            <div class="form-group">
                            <h2 style="font-size: 1.5rem; margin-bottom: 0.5rem;">Fasilitas:</h2>
                            <ul style="list-style-type: none; margin-bottom: 2rem;">
                                <?php 
                                    $menuItems = explode(", ", $row['fasilitas']);
                                    foreach ($menuItems as $item) {
                                ?>
                                    <li style="line-height: 1.6; margin-bottom: 0.1rem;">• <?php echo htmlspecialchars($item); ?></li>
                                <?php 
                                    }
                                ?>
                            </ul>
                            </div>

                            <div class="form-group">
                            <h2 style="font-size: 1.5rem; margin-bottom: 0.5rem;">Harga Tiket Masuk:</h2>
                            <ul style="list-style-type: none; margin-bottom: 2rem;">
                                <?php 
                                    $tiketMasuk = explode(". ", $row['tiket']);
                                    foreach ($tiketMasuk as $tiket) {
                                ?>
                                    <li style="line-height: 1; margin-bottom: 0.5rem;"> <?php echo htmlspecialchars($tiket); ?></li>
                                <?php 
                                    }
                                ?>
                            </ul>
                            </div>

                            <div class="form-group">
                            <h2 style="font-size: 1.5rem; margin-bottom: 0.5rem;">Jam Operasional:</h2>
                            <ul style="list-style-type: none; margin-bottom: 2rem;">
                                <?php 
                                    $jamMasuk = explode(". ", $row['jam']);
                                    foreach ($jamMasuk as $jam) {
                                ?>
                                    <li style="line-height: 1; margin-bottom: 0.5rem;"> <?php echo htmlspecialchars($jam); ?></li>
                                <?php 
                                    }
                                    ?>
                            </ul>
                            </div>

                        <?php elseif ($type == 'event'): ?>
                            <div class="form-group">
                            <h2 style="font-size: 1.5rem; margin-bottom: 0.5rem;">Waktu:</h2>
                            <p style="line-height: 1.6; margin-bottom: 1rem;"><?php echo $row['waktu']; ?></p>
                            </div>

                            <div class="form-group">
                            <h2 style="font-size: 1.5rem; margin-bottom: 0.5rem;">Tiket Masuk:</h2>
                            <p style="line-height: 1.6; margin-bottom: 1rem;"><?php echo $row['tiket']; ?></p>
                            </div>

                            <div class="form-group">
                            <h2 style="font-size: 1.5rem; margin-bottom: 0.5rem;">Social Media:</h2>
                            <p style="line-height: 1.6; margin-bottom: 1rem;"><?php echo $row['socmed']; ?></p>
                            </div>  
                        <?php endif; ?>
                    </div>
                </div>

                <div class="comment-section">
                <h2 style="display: inline-flex; align-items: center; justify-content: center; gap: 0.5rem; margin: 0;">
                    Komentar
                    <span style="background: #8AB0A6; 
                                color: white; 
                                padding: 0.2rem 1rem; 
                                border-radius: 20px; 
                                font-size: 1rem;
                                display: inline-flex; 
                                align-items: center; 
                                justify-content: center;">
                        <?php 
                        $jumlahkomentarQuery = "SELECT * FROM komentar WHERE id_postingan = $id AND type_postingan = '$type'";
                        $jumlahkomentarResult = mysqli_query($conn, $jumlahkomentarQuery);
                        echo mysqli_num_rows($jumlahkomentarResult);
                        ?>
                    </span>
                </h2>


                    <div class="comment-list">
                        <?php
                        if (mysqli_num_rows($komentarResult) > 0) {
                            while ($komentar = mysqli_fetch_assoc($komentarResult)) {
                        ?>
                        <div class='comment-item'>
                            <div class='comment-user'>
                                <img src='../userimage/<?php echo $komentar['foto'];?>' alt='user' class='avatar'>
                                <div class='comment-content'>
                                    <div class='user-header'>
                                        <span class='username'><?php echo htmlspecialchars($komentar['username']); ?></span>
                                        <span class='date'><?php echo htmlspecialchars($komentar['tanggal_komentar']); ?></span>
                                    </div>
                                    <p class='comment-text'><?php echo htmlspecialchars($komentar['isi_komentar']); ?></p>
                                </div>
                            </div>

                            <form method='POST' action='' style='display:inline;'>
                                <input type='hidden' name='id_komentar' value='<?php echo intval($komentar['id_komentar']); ?>'>
                                <button type='submit' name='hapus_komentar' class='delete-btn' onclick='return confirm("Apakah Anda yakin ingin menghapus komentar ini?");'>
                                    <svg class='trash-icon' viewBox='0 0 24 24'>
                                        <path d='M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM19 4h-3.5l-1-1h-5l-1 1H5v2h14V4z'/>
                                    </svg>
                                </button>
                            </form>
                        </div><hr>
                        <?php
                            }
                        } else {
                            echo "<p>Tidak ada komentar.</p>";
                        }
                        ?>
                    </div>
</div>
    </body>
    </html>
    <?php
} else {
    echo "Postingan tidak ditemukan.";
}

mysqli_close($conn);
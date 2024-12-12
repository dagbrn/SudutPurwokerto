<?php
session_start();
require "koneksi.php";

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

$result = mysqli_query($conn, $query);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    if (isset($_SESSION['id_akun'])) { 
        $id_postingan = $_POST['id_postingan'];
        $type_postingan = $_POST['type_postingan'];
        $id_akun = $_SESSION['id_akun']; 
        $isi_komentar = $_POST['isi_komentar'];

        // Menyimpan komentar ke database
        $queryKomentar = "INSERT INTO komentar (id_postingan, type_postingan, id_akun, isi_komentar) 
                  VALUES ('$id_postingan', '$type_postingan', '$id_akun', '$isi_komentar')";
                
                if (mysqli_query($conn, $queryKomentar)) {
                echo "Komentar berhasil disimpan.";
                ?>
                <meta http-equiv="refresh" content="2; url=posted-detail.php?type=<?php echo $type; ?>&id=<?php echo $id; ?>"/>
                <?php
            } else {
                echo "Error: " . mysqli_error($conn);
            }

    } else {
        echo "Anda harus login untuk menambahkan komentar.";
    }
}

if ($row = mysqli_fetch_assoc($result)) {
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row['nama']; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/posted-detail.css">
</head>
<body>
    <nav>
        <a href="../sudutpurwokerto/" class="logo">SudutPurwokerto</a>
        <div class="nav-links">
            <a href="../sudutpurwokerto/">Beranda</a>
            <a href="posted.php?type=kuliner" class="<?php echo ($type == 'kuliner') ? 'active' : ''; ?>">Kuliner</a>
            <a href="posted.php?type=wisata" class="<?php echo ($type == 'wisata') ? 'active' : ''; ?>">Wisata</a>
            <a href="posted.php?type=event" class="<?php echo ($type == 'event') ? 'active' : ''; ?>">Event</a>

            <?php
                $login = isset($_SESSION["login"]) && $_SESSION["login"];
                $profilePicture = 'asset/pp.png';

                if ($login): ?>
                    <a href="logout.php" class="logout-btn">Logout</a>
                    <img src="<?php echo $profilePicture; ?>" alt="Profile Picture" class="profile-pic">
                <?php else: ?>
                    <a href="login.php" class="login-btn">Login</a>
                    <a href="register.php" class="register-btn">Register</a>
                <?php endif; ?>
        </div>
    </nav>

    <div class="content-container">
        <h1 style="font-size: 2.5rem; margin-bottom: 0.5rem;"><?php echo $row['nama']; ?></h1>

        <?php if ($type == 'event'): 
            $tanggal = new DateTime($row['tanggal']);
            $formattedTanggal = $tanggal->format('d F Y');
        ?>
        <div style="display: flex; align-items: center; margin-bottom: 1rem;">
        <i class="fas fa-solid fa-calendar" style="margin-right: 0.5rem;"></i>
            <span><?php echo $formattedTanggal ?></span>
        </div>
        <?php endif; ?>

        <div style="display: flex; align-items: center; margin-bottom: 2rem;">
            <i class="fas fa-map-marker-alt" style="margin-right: 0.5rem;"></i>
            <span><?php echo $row['lokasi']; ?></span>
        </div>

        <div style="display: flex; gap: 2rem; margin-bottom: 2rem;">
            <img src="asset/<?php echo $row['foto']; ?>" alt="<?php echo $row['nama']; ?>" 
                 style="width: 50%; border-radius: 10px; object-fit: cover;">
            
            <div style="width: 50%;">
                <h2 style="font-size: 1.5rem; margin-bottom: 0.1rem;">Deskripsi:</h2>
                <p style="margin-bottom: 2rem;">
                    <?php echo $row['deskripsi']; ?>
                </p>

                <!-- Untuk Postingan Kuliner -->
                <?php if ($type == 'kuliner'): ?>
                <h2 style="font-size: 1.5rem; margin-bottom: 0.1rem;">Menu Unggulan:</h2>

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

                <h2 style="font-size: 1.5rem; margin-bottom: 0.5rem;">Harga Rata-Rata:</h2>
                <p style="line-height: 1.6; margin-bottom: 1rem;"><?php echo $row['range_harga']; ?></p>

                <h2 style="font-size: 1.5rem; margin-bottom: 0.1rem;">Jam Operasional:</h2>
                <p style="line-height: 1.6; margin-bottom: 0.5rem;"><?php echo $row['jam']; ?></p>

                <!-- Untuk Postingan Wisata -->
                <?php elseif ($type == 'wisata'): ?>
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

                <!-- Untuk Postingan Event -->
                <?php elseif ($type == 'event'): ?>
                    <h2 style="font-size: 1.5rem; margin-bottom: 0.5rem;">Waktu:</h2>
                    <p style="line-height: 1.6; margin-bottom: 1rem;"><?php echo $row['waktu']; ?></p>

                    <h2 style="font-size: 1.5rem; margin-bottom: 0.5rem;">Tiket Masuk:</h2>
                    <p style="line-height: 1.6; margin-bottom: 1rem;"><?php echo $row['tiket']; ?></p>

                    <h2 style="font-size: 1.5rem; margin-bottom: 0.5rem;">Social Media:</h2>
                    <p style="line-height: 1.6; margin-bottom: 1rem;"><?php echo $row['socmed']; ?></p>
                <?php endif; ?>

            </div>
        </div>

        <!-- Kolom tulis komentar -->
        <div style="padding: 2rem 5% 0 5%;">

            <?php if (isset($_SESSION['id_akun'])): ?>
            <div style="margin-bottom: 2rem;">
                <form action="" method="POST">
                    <input type="hidden" name="id_postingan" value="<?php echo $id; ?>">
                    <input type="hidden" name="type_postingan" value="<?php echo $type; ?>">
                    <textarea name="isi_komentar" required
                        style="width: 100%; 
                            min-height: 150px; 
                            padding: 1.5rem;
                            border: 2px solid #7DBBA9;
                            border-radius: 20px;
                            resize: none;
                            font-family: inherit;
                            font-size: 1rem;
                            background-color: #D7EAE4;
                            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
                            margin-bottom: 1rem;"
                        placeholder="Tulis komentar..."></textarea>
                    <div style="text-align: right;">
                        <button type="submit" name="submit"
                            style="background: #FFD700;
                                border: none;
                                padding: 0.8rem 2rem;
                                border-radius: 25px;
                                cursor: pointer;
                                font-weight: bold;
                                font-size: 1rem;"
                            >Kirim</button>
                    </div>
                </form>
            </div>

            <!-- Garis pembatas -->
            <div style="border-top: 1px solid #000; margin-bottom: 2rem;"></div>
            <div style="margin-bottom: 2rem;">
                <h2 style="font-size: 2rem; display: flex; align-items: center; margin: 0;">
                    Komentar 
                    <span style="background: #8AB0A6; 
                                color: white; 
                                padding: 0.2rem 0.8rem; 
                                border-radius: 20px; 
                                font-size: 1rem;
                                margin-left: 1rem;
                                position: relative;
                                top: 2px;">
                        3
                    </span>
                </h2>
            </div>

            <?php else: ?>
                 <!-- Garis pembatas -->
                <div style="border-top: 1px solid #000; margin-bottom: 2rem;"></div>
                <p style="margin-bottom: 2rem;">
                Silahkan <a href="login.php" style="color: #4B7065; text-decoration: none;"><b>Login</b></a> Untuk Memberikan Komentar.
                </p>
                <div style="margin-bottom: 2rem;">
                <h2 style="font-size: 2rem; display: flex; align-items: center; margin: 0;">
                    Komentar 
                    <span style="background: #8AB0A6; 
                                color: white; 
                                padding: 0.2rem 0.8rem; 
                                border-radius: 20px; 
                                font-size: 1rem;
                                margin-left: 1rem;
                                position: relative;
                                top: 2px;">
                                 <?php 
                        $jumlahkomentarQuery = "SELECT * FROM komentar WHERE id_postingan = $id AND type_postingan = '$type'";
                        $jumlahkomentarResult = mysqli_query($conn, $jumlahkomentarQuery);
                        echo mysqli_num_rows($jumlahkomentarResult);
                        ?>  
                    </span>
                </h2>
                </div>
            <?php endif; ?>



            <!-- Komentar Items -->
            <?php
                // Menampilkan komentar
                $komentarQuery = "SELECT k.isi_komentar, k.tanggal_komentar, a.username 
                                FROM komentar k
                                JOIN akun a ON k.id_akun = a.id_akun
                                WHERE k.id_postingan = $id AND k.type_postingan = '$type'
                                ORDER BY k.tanggal_komentar DESC LIMIT 3";

                $komentarResult = mysqli_query($conn, $komentarQuery);

                if (mysqli_num_rows($komentarResult) > 0) {
                    echo '<div style="display: flex; flex-direction: column; gap: 2rem;">';

                    while ($komentar = mysqli_fetch_assoc($komentarResult)) {
                        $username = htmlspecialchars($komentar['username']);
                        $tanggal = htmlspecialchars($komentar['tanggal_komentar']);
                            $tanggalKomen = new DateTime($tanggal);
                            $tanggalKomentar = $tanggalKomen->format('j F Y'); 
                        $isiKomentar = htmlspecialchars($komentar['isi_komentar']);

                        echo '
                        <div style="display: flex; gap: 1rem;">
                            <img src="asset/pp.png" alt="User Avatar" style="width: 48px; height: 48px; border-radius: 50%; background: #eee;">
                            <div>
                                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 0.5rem;">
                                    <h3 style="font-size: 1.1rem;">' . $username . '</h3>
                                    <span style="color: #666; font-size: 0.9rem;">' . $tanggalKomentar . '</span>
                                </div>
                                <p style="line-height: 1.6;">' . $isiKomentar . '</p>
                            </div>
                        </div>';
                    }

                    echo '</div>';
                } else {
                    echo "<p>Tidak ada komentar.</p>";
                }
            }
            ?>

        </div>
    </div>

    <!-- Footer -->
     <?php include "footer.php"; ?>

</body>
</html>

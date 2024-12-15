<?php
session_start();
require "koneksi.php";

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Mendapatkan tipe dari URL
$type = isset($_GET['type']) ? $_GET['type'] : '';

// Judul dan query berdasarkan tipe
if ($type == 'kuliner') {
    $title = "Tempat Kuliner Khas Purwokerto";
    $query = "SELECT id_kuliner AS id, nama_kuliner AS nama, lokasi_kuliner AS lokasi, foto_kuliner AS foto FROM tempat_kuliner";
} elseif ($type == 'wisata') {
    $title = "Tempat Wisata di Purwokerto";
    $query = "SELECT id_wisata AS id, nama_wisata AS nama, lokasi_wisata AS lokasi, foto_wisata AS foto FROM tempat_wisata";
} elseif ($type == 'event') {
    $title = "Event dan Festival di Purwokerto";
    $query = "SELECT id_event AS id, nama_event AS nama, tanggal_event AS tanggal, lokasi_event AS lokasi, foto_event AS foto FROM event";
} else {
    echo "Jenis postingan tidak valid.";
    exit();
}

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/posted.css">
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
                if ($login) {
                    $queryProfile = "SELECT foto FROM akun WHERE id_akun = " . $_SESSION["id_akun"];
                    $fotoProfile = mysqli_query($conn, $queryProfile);
                    $fotoData = mysqli_fetch_assoc($fotoProfile);
                    $profilePicture = 'userimage/' . $fotoData['foto'];

                    // Cek apakah foto ada
                    if (empty($fotoData['foto']) || !file_exists($profilePicture)) {
                        $profilePicture = 'userimage/pp.png';
                    }
                    ?>
                    <a href="logout.php">Logout</a>
                    <a href="profile.php"><img src="<?php echo $profilePicture; ?>" alt="Profile Picture" class="profile-pic"></a>
                <?php } else { ?>
                    <a href="login.php" class="login-btn">Login</a>
                    <a href="register.php" class="register-btn">Register</a>
                <?php } ?>
        </div>
    </nav>

    <main class="content">
        <h1><?php echo $title; ?></h1>
        <div class="posted-grid">
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <div class="posted-card">
                        <a href="posted-detail.php?type=<?php echo $type; ?>&id=<?php echo $row['id']; ?>">
                            <img src="asset/<?php echo $row['foto']; ?>" alt="<?php echo $row['nama']; ?>">
                        </a>
                        <div class="posted-info">
                            <a href="posted-detail.php?type=<?php echo $type; ?>&id=<?php echo $row['id']; ?>">
                                <h3><?php echo $row['nama']; ?></h3>
                            </a>
                            <?php if ($type == 'event'):
                                $tanggal = new DateTime($row['tanggal']);
                                $formattedTanggal = $tanggal->format('d F Y');
                            ?>
                                <p class="date"><?php echo $formattedTanggal ?></p>
                            <?php endif; ?>
                            <p><i class="fas fa-map-marker-alt"></i> <?php echo $row['lokasi']; ?></p>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "<p>Tidak ada data untuk jenis postingan ini.</p>";
            }
            ?>
        </div>
    </main>

    <!-- Footer -->
    <?php include "footer.php";?>
</body>
</html>
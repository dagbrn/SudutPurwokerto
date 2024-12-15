<?php
session_start();
require "koneksi.php";

if (!isset($_SESSION['login']) || $_SESSION['login'] == false) {
    header('location: login.php');
    exit;
}

$queryAkun = "SELECT nama_lengkap AS nama, email, username, role, foto FROM akun WHERE id_akun = " . $_SESSION["id_akun"];
$akun = mysqli_query($conn, $queryAkun);
$akunData = mysqli_fetch_assoc($akun);
$profilePicture = 'userimage/' . $akunData['foto'];

if (empty($akunData['foto']) || !file_exists($profilePicture)) {
    $profilePicture = 'userimage/pp.png';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    // Ambil email dan username baru dari form
    $newEmail = $_POST['email'];
    $newUsername = $_POST['username'];
    
    $updateMessage = []; // Array untuk menyimpan pesan update

    // Update email dan username
    $queryUpdateProfile = "UPDATE akun SET email = '$newEmail', username = '$newUsername' WHERE id_akun = " . $_SESSION["id_akun"];
    
    if (mysqli_query($conn, $queryUpdateProfile)) {
        if ($newEmail !== $akunData['email']) {
            $updateMessage[] = "Email berhasil diupdate";
        }
        if ($newUsername !== $akunData['username']) {
            $updateMessage[] = "Username berhasil diupdate";
        }
    }

    // Memeriksa apakah file diupload
    if ($_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $targetDir = "userimage/";
        $namafoto = time() . "_" . basename($_FILES['foto']['name']);
        $targetFile = $targetDir . $namafoto;

        // Memeriksa ekstensi file
        $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($fileType, $allowedTypes)) {
            // Memindahkan file
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $targetFile)) {
                $queryUpdateFoto = "UPDATE akun SET foto = '$namafoto' WHERE id_akun = " . $_SESSION["id_akun"];
                if (mysqli_query($conn, $queryUpdateFoto)) {
                    $updateMessage[] = "Foto berhasil diupdate";
                }
            }
        } else {
            echo "<script>
                    alert('Error: Hanya file gambar yang diizinkan.');
                  </script>";
        }
    }

    // Menampilkan alert berdasarkan apa yang diupdate
    if (!empty($updateMessage)) {
        $alertMessage = implode(", ", $updateMessage);
        echo "<script>
                alert('$alertMessage');
                window.location.href = 'profile.php';
              </script>";
    } else {
        echo "<script>
                alert('Tidak ada perubahan yang dilakukan.');
                window.location.href = 'profile.php';
              </script>";
    }
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/profile.css">
</head>
<body>
<nav>
    <a href="../sudutpurwokerto/" class="logo">SudutPurwokerto</a>
    <div class="nav-links">
        <a href="../sudutpurwokerto/">Beranda</a>
        <a href="posted.php?type=kuliner" class="<?php echo ($type == 'kuliner') ? 'active' : ''; ?>">Kuliner</a>
        <a href="posted.php?type=wisata" class="<?php echo ($type == 'wisata') ? 'active' : ''; ?>">Wisata</a>
        <a href="posted.php?type=event" class="<?php echo ($type == 'event') ? 'active' : ''; ?>">Event</a>
        <?php if (isset($_SESSION["login"]) && $_SESSION["login"]) { ?>
            <a href="logout.php">Logout</a>
            <?php if($akunData['role'] == "admin"):?>
            <a href="adminpage/">Admin</a> 
            <?php endif; ?>
            <a href="profile.php"><img src="<?php echo $profilePicture; ?>" alt="Profile Picture" class="profile-pic"></a>
        <?php } else { ?>
            <a href="login.php" class ="login-btn">Login</a>
            <a href="register.php" class="register-btn">Register</a>
        <?php } ?>
    </div>
</nav>

<div class="container">
    <h1 style="font-size: 2.5rem; margin-bottom: 2rem; padding-left: 15rem;">Profile Saya</h1>
    
    <div class="form-container">
        <!-- Avatar -->
        <div class="avatar">
            <?php
            if (file_exists($profilePicture)) {
                echo '<img src="' . $profilePicture . '" alt="Foto Profile">';
            } else {
                echo '<p>Foto tidak ditemukan.</p>';
            }
            ?>
        </div>

        <form action="" method="post" enctype="multipart/form-data">
            <label for="foto">Upload Foto Baru (Opsional)</label>
            <input type="file" name="foto" id="foto" class="form-control"><br>

            <div class="form-group">
                <label>Nama:</label>
                <input type="text" id="nama" name="nama" value="<?php echo htmlspecialchars($akunData['nama']); ?>" disabled class="form-control"><br>
            </div>

            <div class="form-group">
                <label>Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($akunData['email']); ?>" class="form-control"><br>
            </div>

            <div class="form-group">
                <label>Username:</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($akunData['username']); ?>" class="form-control"><br>
            </div>

            <div class="button-group">
                <button type="submit" name="submit" class="btn-submit">Update</button>
            </div>
        </form>
    </div>
</div>

<?php include "footer.php"; ?>
</body>
</html>
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>
    <link rel="stylesheet" href="css/navbar.css">
</head>
<body>
<nav class="navbar">
        <div class="logo">SudutPurwokerto</div>
        <ul class="menu">
            <li><a href="../sudutpurwokerto/">Beranda</a></li>
            <li><a href="posted.php?type=kuliner">Kuliner</a></li>
            <li><a href="posted.php?type=wisata">Wisata</a></li>
            <li><a href="posted.php?type=event">Event</a></li>
            <?php
            $login = isset($_SESSION["login"]) && $_SESSION["login"];
            $profilePicture = 'asset/pp.png';

            if ($login): ?>
                <li><a href="logout.php">Logout</a></li>
                <li><img src="<?php echo $profilePicture; ?>" alt="Profile Picture" class="profile-pic"></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</body>
</html>
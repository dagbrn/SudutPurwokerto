    <nav>
        <div class="logo">SudutPurwokerto</div>
        <div class="nav-links">

            <a href="../sudutpurwokerto/" class="active">Beranda</a>
            <a href="posted.php?type=kuliner">Kuliner</a>
            <a href="posted.php?type=wisata">Wisata</a>
            <a href="posted.php?type=event">Event</a>

            <?php
            $login = isset($_SESSION["login"]) && $_SESSION["login"];
            $profilePicture = 'userimage/pp.png';

            if ($login): ?>
                <a href="logout.php">Logout</a>
                <img src="<?php echo $profilePicture; ?>" alt="Profile Picture" class="profile-pic">
            <?php else: ?>
                <a href="login.php" class="login-btn">Login</a>
                <a href="register.php" class="register-btn">Register</a>
            <?php endif; ?>
            
            
        </div>
    </nav>
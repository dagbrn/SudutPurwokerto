<?php
session_start();
require "koneksi.php";

// Ambil data kuliner, wisata, dan event
$queryKuliner = mysqli_query($conn, "SELECT id_kuliner AS id, nama_kuliner AS nama, lokasi_kuliner AS lokasi, foto_kuliner AS foto FROM tempat_kuliner LIMIT 3");
$queryWisata = mysqli_query($conn, "SELECT id_wisata AS id, nama_wisata AS nama, lokasi_wisata AS lokasi, foto_wisata AS foto FROM tempat_wisata LIMIT 3");
$queryEvent = mysqli_query($conn, "SELECT id_event AS id, nama_event AS nama, tanggal_event AS tanggal, lokasi_event AS lokasi, foto_event AS foto FROM event LIMIT 3");

// Fungsi untuk menampilkan data
function displayPosts($result, $type) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="place-card">
                <a href="posted-detail.php?type=<?php echo $type; ?>&id=<?php echo $row['id']; ?>">
                    <img src="asset/<?php echo $row['foto']; ?>" alt="<?php echo $row['nama']; ?>">
                </a>
                <div class="place-info">
                    <a href="posted-detail.php?type=<?php echo $type; ?>&id=<?php echo $row['id']; ?>">
                        <h4><?php echo $row['nama']; ?></h4>
                    </a>
                    <?php if (isset($row['tanggal'])): 
                        $tanggal = new DateTime($row['tanggal']);
                        $formattedTanggal = $tanggal->format('d F Y');
                    ?>
                        <p class="date"><?php echo $formattedTanggal ?></p>
                    <?php endif; ?>
                    <p><i class="fas fa-map-marker-alt"></i><?php echo $row['lokasi']; ?></p>
                </div>
            </div>
            <?php
        }
    } else {
        echo "<p>Tidak ada data untuk jenis ini.</p>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SudutPurwokerto</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/index.css">

</head>
<body>

        <nav>
            <div class="logo">SudutPurwokerto</div>
            <div class="nav-links">
                <a href="../sudutpurwokerto/" class="active">Beranda</a>
                <a href="posted.php?type=kuliner">Kuliner</a>
                <a href="posted.php?type=wisata">Wisata</a>
                <a href="posted.php?type=event">Event</a>

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

    <section class="hero">
        <div class="hero-content">
            <h1>Selamat Datang<br>di Purwokerto</h1>
            <p>Temukan Kuliner Lezat, Destinasi Wisata Menarik,<br>dan Event Seru yang Ada di Purwokerto</p>
            <a href="#jelajahi"><button class="jelajahi-btn">Jelajahi Sekarang!</button></a>
        </div>
    </section>

    <section class="about curved-top">
        <div class="about-img">
            <img src="imagepage/Alun-Alun.jpeg" alt="Purwokerto">
        </div>
        <div class="about-content">
            <h2>Tentang Purwokerto</h2>
            <p>Purwokerto, ibu kota Kabupaten Banyumas, terletak di Jawa Tengah, Indonesia. Dikenal dengan suasana yang tenang, alam yang indah, dan kaya akan budaya, Purwokerto menjadi destinasi yang sempurna bagi mereka yang ingin merasakan kehidupan kota kecil dengan pesona alam yang memikat. Di sini, Anda dapat menikmati kuliner tradisional yang lezat, menjelajahi tempat wisata alam yang menakjubkan, dan menghadiri berbagai event menarik.</p>
        </div>
    </section>

    <section class="features">
        <div class="features-container">
            <div class="features-header">
                <h2>Temukan Keseruan di Purwokerto</h2>
                <p>Dari kuliner lezat, tempat wisata yang memukau, hingga event seru, kami punya rekomendasi terbaik untuk Anda.</p>
            </div>
            <div class="features-grid">
                <div class="feature-card">
                    <i class="fas fa-utensils" style="font-size: 50px; color: #4A665B;"></i>
                    <h3>Kuliner</h3>
                    <p>Nikmati berbagai hidangan khas Purwokerto di restoran dan kafe terbaik.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-mountain" style="font-size: 50px; color: #4A665B;"></i>
                    <h3>Wisata</h3>
                    <p>Nikmati berbagai hidangan khas Purwokerto di restoran dan kafe terbaik.</p>
                </div>
                <div class="feature-card">
                    <i class="fas fa-calendar" style="font-size: 50px; color: #4A665B;"></i>
                    <h3>Event</h3>
                    <p>Dapatkan informasi tentang event dan festival yang sedang berlangsung.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="explore curved-top" id="jelajahi">
        <div class="explore-header">
            <h2>Eksplor Sudut Terbaik Purwokerto</h2>
            <p>Jelajahi setiap sudut kota dengan pilihan kuliner, wisata, dan event yang membuat Purwokerto semakin istimewa.</p>
        </div>
        
        <div class="explore-carousel">
            <button class="nav-btn prev">&#10094;</button>
            <div class="carousel-container">
                <div class="card-wrapper">
                    <div class="card">
                        <img src="imagepage/tempatkuliner.jpg" alt="Kuliner">
                        <div class="card-content">
                            <h3>Kuliner</h3>
                            <a href="posted.php?type=kuliner" class="eksplor-btn">Eksplor</a>
                        </div>
                    </div>
                </div>
                <div class="card-wrapper active">
                    <div class="card">
                        <img src="imagepage/simpang.jpeg" alt="Tempat Wisata">
                        <div class="card-content">
                            <h3>Tempat Wisata</h3>
                            <a href="posted.php?type=wisata"class="eksplor-btn">Eksplor</a>
                        </div>
                    </div>
                </div>
                <div class="card-wrapper">
                    <div class="card">
                        <img src="imagepage/oranglari.jpg" alt="Event">
                        <div class="card-content">
                            <h3>Event</h3>
                            <a href="posted.php?type=event"class="eksplor-btn">Eksplor</a>
                        </div>
                    </div>
                </div>
            </div>
            <button class="nav-btn next">&#10095;</button>
        </div>
    </section>
    
    <section class="recommendations curved-top">
        <div class="section-container">
            <h2>Rekomendasi Tempat di Purwokerto</h2>

            <!-- Kuliner Khas -->
            <div class="category">
                <div class="category-header">
                    <h3>Kuliner Khas</h3>
                    <a href="posted.php?type=kuliner" class="see-more">></a>
                </div>
                <div class="places-grid">
                    <?php displayPosts($queryKuliner, 'kuliner'); ?>
                </div>
            </div>

            <!-- Tempat Wisata -->
            <div class="category">
                <div class="category-header">
                    <h3>Tempat Wisata</h3>
                    <a href="posted.php?type=wisata" class="see-more">></a>
                </div>
                <div class="places-grid">
                    <?php displayPosts($queryWisata, 'wisata'); ?>
                </div>
            </div>

            <!-- Event dan Festival -->
            <div class="category">
                <div class="category-header">
                    <h3>Event dan Festival</h3>
                    <a href="posted.php?type=event" class="see-more">></a>
                </div>
                <div class="places-grid">
                    <?php displayPosts($queryEvent, 'event'); ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php include "footer.php";?>

    <!-- Javascript -->
    <script>
        const carousel = document.querySelector('.carousel-container');
        const cards = document.querySelectorAll('.card-wrapper');
        const prevBtn = document.querySelector('.prev');
        const nextBtn = document.querySelector('.next');
        let currentIndex = 1;

        function updateCards() {
            cards.forEach((card, index) => {
                card.classList.remove('active');
                if (index === currentIndex) {
                    card.classList.add('active');
                }
                
                // Mengatur posisi dan skala card
                if (index < currentIndex) {
                    card.style.transform = 'scale(0.85) translateX(25%)';
                } else if (index > currentIndex) {
                    card.style.transform = 'scale(0.85) translateX(-25%)';
                } else {
                    card.style.transform = 'scale(1.1) translateX(0)';
                }
            });
        }

        // Inisialisasi posisi awal
        updateCards();

        prevBtn.addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex--;
                updateCards();
            }
        });

        nextBtn.addEventListener('click', () => {
            if (currentIndex < cards.length - 1) {
                currentIndex++;
                updateCards();
            }
        });

        // Touch events
        let startX = 0;
        let isDragging = false;

        carousel.addEventListener('touchstart', (e) => {
            startX = e.touches[0].clientX;
            isDragging = true;
        });

        carousel.addEventListener('touchmove', (e) => {
            if (!isDragging) return;
            const currentX = e.touches[0].clientX;
            const diff = startX - currentX;
            
            if (Math.abs(diff) > 50) {
                if (diff > 0 && currentIndex < cards.length - 1) {
                    currentIndex++;
                    updateCards();
                    isDragging = false;
                } else if (diff < 0 && currentIndex > 0) {
                    currentIndex--;
                    updateCards();
                    isDragging = false;
                }
            }
        });

        carousel.addEventListener('touchend', () => {
            isDragging = false;
        });
    </script>
</body>
</html>
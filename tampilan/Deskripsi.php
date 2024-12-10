<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deskripsi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        nav {
            background: #4B7065;
            padding: 1rem 5%;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            position: relative;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            z-index: 10;
        }

        nav::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 100%;
            height: 10px;
            background: linear-gradient(to bottom, rgba(0,0,0,0.1), transparent);
            pointer-events: none;
        }

        .logo {
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            text-decoration: none;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            align-items: center;
            margin-left: auto;
            margin-right: 2rem;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
            font-size: 1rem;
            transition: color 0.3s ease;
        }

        .nav-links a:hover {
            color: #FFD700;
        }

        .nav-links a.active {
            font-weight: bold;
            color: white;
        }

        .nav-links a.active:hover {
            color: #FFD700;
        }

        .auth-buttons {
            display: flex;
            gap: 1rem;
        }

        .login-btn {
            padding: 0.5rem 2rem;
            border: 1px solid #FFD700;
            background: transparent;
            color: #FFD700;
            border-radius: 25px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .register-btn {
            padding: 0.5rem 2rem;
            background: #FFD700;
            border: none;
            color: #000;
            border-radius: 25px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .login-btn:hover {
            background: rgba(255, 215, 0, 0.2);
        }

        .register-btn:hover {
            background: rgba(255, 215, 0, 0.8);
        }

        .footer {
            background: #38544C;
            border-radius: 0;
            padding: 5rem 5% 2rem;
            position: relative;
            z-index: 6;
            margin: 0;
        }

        .footer-container {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 3rem;
            margin-top: 0;
        }

        .footer-column h3 {
            font-size: 1.3rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
            color: white;
        }

        .footer-column p {
            line-height: 1.6;
            opacity: 0.9;
            margin-bottom: 1rem;
            color: white;
        }

        .footer-column ul {
            list-style: none;
            padding: 0;
        }

        .footer-column ul li {
            margin-bottom: 0.8rem;
            color: white;
        }

        .footer-column ul li a {
            color: white;
            text-decoration: none;
            opacity: 0.9;
            transition: opacity 0.3s ease;
        }

        .footer-column ul li a:hover {
            opacity: 1;
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .social-icon {
            width: 35px;
            height: 35px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #4A665B;
            text-decoration: none;
            transition: transform 0.3s ease;
        }

        .social-icon:hover {
            transform: translateY(-3px);
        }

        .copyright {
            margin-top: 3rem;
            padding-top: 2rem;
            border-top: 2px solid white;
            text-align: right;
            opacity: 0.8;
            font-size: 0.9rem;
            color: white;
        }

        body {
            background: rgb(255, 251, 239);
        }

        .content-container {
            background: rgb(255, 251, 239);
            min-height: 100vh;
            padding: 2rem 5% 7rem 5%;
        }
    </style>
</head>
<body>
    <nav>
        <a href="#" class="logo">SudutPurwokerto</a>
        <div class="nav-links">
            <a href="#">Beranda</a>
            <a href="#" class="active">Kuliner</a>
            <a href="#">Wisata</a>
            <a href="#">Event</a>
        </div>
        <div class="auth-buttons">
            <a href="#" class="login-btn">Login</a>
            <a href="#" class="register-btn">Register</a>
        </div>
    </nav>

    <div class="content-container">
        <h1 style="font-size: 2.5rem; margin-bottom: 0.5rem;">Lokawisata Baturraden</h1>
        
        <div style="display: flex; align-items: center; margin-bottom: 2rem;">
            <i class="fas fa-map-marker-alt" style="margin-right: 0.5rem;"></i>
            <span>Jalan Raya Baturraden KM 14, Purwokerto, Jawa Tengah.</span>
        </div>

        <div style="display: flex; gap: 2rem; margin-bottom: 2rem;">
            <img src="baturadden.jpg" alt="Lokawisata Baturraden" 
                 style="width: 50%; border-radius: 10px; object-fit: cover;">
            
            <div style="width: 50%;">
                <h2 style="font-size: 1.5rem; margin-bottom: 1rem;">Deskripsi:</h2>
                <p style="line-height: 1.6; margin-bottom: 2rem;">
                    Lokawisata Baturraden adalah salah satu destinasi wisata unggulan yang terletak di kaki Gunung Slamet. Dengan ketinggian sekitar 640-750 mdpl, kawasan ini menawarkan suasana yang sejuk dan pemandangan alam yang memukau, menjadikannya tempat ideal untuk bersantai dan menikmati keindahan alam.
                </p>

                <h2 style="font-size: 1.5rem; margin-bottom: 1rem;">Fasilitas:</h2>
                <ul style="list-style-type: none; margin-bottom: 2rem;">
                    <li style="margin-bottom: 0.5rem;">• Kolam Renang</li>
                    <li style="margin-bottom: 0.5rem;">• Taman Air</li>
                    <li style="margin-bottom: 0.5rem;">• Pemandian Air Panas</li>
                    <li style="margin-bottom: 0.5rem;">• Spot Foto Intagramable</li>
                </ul>

                <h2 style="font-size: 1.5rem; margin-bottom: 1rem;">Harga Tiket Masuk:</h2>
                <p style="line-height: 1.6; margin-bottom: 0.5rem;">Senin-Jumat Rp20.000 per orang.</p>
                <p style="line-height: 1.6; margin-bottom: 2rem;">Sabtu, Minggu, Hari Libur Nasional Rp25.000 per orang.</p>

                <h2 style="font-size: 1.5rem; margin-bottom: 1rem;">Jam Operasional:</h2>
                <p style="line-height: 1.6; margin-bottom: 0.5rem;">Senin-Jumat, 07.00 - 16.00 WIB.</p>
                <p style="line-height: 1.6;">Sabtu-Minggu 07.00-17.00 WIB.</p>
            </div>
        </div>

        <div style="padding: 2rem 5% 0 5%; border-top: 1px solid #000; margin-top: 4rem;">
            <p style="margin-bottom: 2rem;">
                Silahkan <a href="#" style="color: #4B7065; text-decoration: none;"><b>Login</b></a> Untuk Memberikan Komentar.
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
                        3
                    </span>
                </h2>
            </div>


            <!-- Komentar Items -->
            <div style="display: flex; flex-direction: column; gap: 2rem;">
                <!-- Komentar 1 -->
                <div style="display: flex; gap: 1rem;">
                    <img src="icon.png" alt="User Avatar" style="width: 48px; height: 48px; border-radius: 50%; background: #eee;">
                    <div>
                        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 0.5rem;">
                            <h3 style="font-size: 1.1rem;">Novianto Nugraha</h3>
                            <span style="color: #666; font-size: 0.9rem;">16 November 2024</span>
                        </div>
                        <p style="line-height: 1.6;">Lokawisata Baturraden adalah tempat yang cukup menarik karena alamnya bagus dan luas. Udara segar dan ada pemcuran air panas alami. Cukup ramai dikunjungi pada hari libur, tetapi aksesnya mudah dijangkau. Sangat cocok untuk liburan keluarga!</p>
                    </div>
                </div>

                <!-- Komentar 2 -->
                <div style="display: flex; gap: 1rem;">
                    <img src="icon.png" alt="User Avatar" style="width: 48px; height: 48px; border-radius: 50%; background: #eee;">
                    <div>
                        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 0.5rem;">
                            <h3 style="font-size: 1.1rem;">Fabian Hernanda</h3>
                            <span style="color: #666; font-size: 0.9rem;">9 November 2024</span>
                        </div>
                        <p style="line-height: 1.6;">Baturaden menjadi salah satu destinasi wisata yang wajib dikunjungi jika berkunjung ke wilayah Banyumas. Menawarkan wisata alam yang masih alami namun dilengkapi dengan fasilitas yang memadai. Dengan tiket masuk yang sangat terjangkau, pengunjung bisa menikmati beragam objek wisata dalam satu lokasi, mulai dari pemandian air hangat, air terjun, danau, kolam renang, arena permainan, dan banyak objek lainnya. Apalagi dengan lokasi yang berada di kaki Gunung Slamet, kita dapat menikmati sejuknya udara dan pemandangan yang indah.</p>
                    </div>
                </div>

                <!-- Komentar 3 -->
                <div style="display: flex; gap: 1rem;">
                    <img src="icon.png" alt="User Avatar" style="width: 48px; height: 48px; border-radius: 50%; background: #eee;">
                    <div>
                        <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 0.5rem;">
                            <h3 style="font-size: 1.1rem;">Acip Sibul</h3>
                            <span style="color: #666; font-size: 0.9rem;">3 September 2024</span>
                        </div>
                        <p style="line-height: 1.6;">Salah satu objek wisata andalan di Purwokerto yang menjanjikan pemandangan kaki Gunung Slamet yang sangat indah dan sejuk. Banyak spot menarik yang akan membuat Anda betah berlama-lama di sini. Saya sangat merekomendasikan tempat ini untuk para pecinta alam!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer curved-top">
        <div class="footer-container">
            <!-- Kolom 1 - Tentang -->
            <div class="footer-column">
                <h3>SudutPurwokerto</h3>
                <p>Website untuk menjelajahi keindahan Purwokerto. Temukan rekomendasi kuliner khas, tempat wisata menarik, dan event seru yang tidak boleh Anda lewatkan. Dari tempat makan legendaris hingga destinasi alam yang memukau, SudutPurwokerto membantu Anda merencanakan petualangan terbaik di kota ini.</p>
            </div>

            <!-- Kolom 2 - Menu -->
            <div class="footer-column">
                <h3>SudutPurwokerto</h3>
                <ul>
                    <li><a href="#">Beranda</a></li>
                    <li><a href="#">Kuliner</a></li>
                    <li><a href="#">Wisata</a></li>
                    <li><a href="#">Event</a></li>
                </ul>
            </div>

            <!-- Kolom 3 - Kontak -->
            <div class="footer-column">
                <h3>Kontak Kami</h3>
                <ul>
                    <li><a href="mailto:info@sudutpwt.com">info@sudutpwt.com</a></li>
                    <li>Jl. Raya Purwokerto No. 12</li>
                    <li>(021) 1234-5678</li>
                </ul>
            </div>

            <!-- Kolom 4 - Sosial Media -->
            <div class="footer-column">
                <h3>Ikuti Kami</h3>
                <p>Sosial Media Kami</p>
                <div class="social-links">
                    <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <!-- Copyright -->
        <div class="copyright">
            <p>Copy Right© 2024 SudutPurwokerto. Semua Hak Dilindungi.</p>
        </div>
    </footer>
</body>
</html>
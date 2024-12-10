<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuliner - Sudut Purwokerto</title>
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

        .content {
            padding: 2rem 5%;
            background: rgb(255, 251, 239);
            min-height: 110vh;
            position: relative;
            z-index: 5;
            margin: 0;
            padding-bottom: 4rem;
        }

        h1 {
            font-size: 2rem;
            margin: 3rem 0;
            color: #333;
        }

        .kuliner-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            margin-top: 0;
            margin-bottom: 3rem;
        }

        .kuliner-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .kuliner-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .kuliner-info {
            padding: 1rem;
            background: rgb(255, 251, 239);
        }

        .kuliner-info h3 {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
            color: #333;
        }

        .kuliner-info p {
            color: #666;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
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

        @media (max-width: 1024px) {
            .kuliner-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .kuliner-grid {
                grid-template-columns: 1fr;
            }
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

    <main class="content">
        <h1>Tempat Kuliner Khas Purwokerto</h1>
        <div class="kuliner-grid">
            <div class="kuliner-card">
                <img src="Cafe Kemangi.jpg" alt="Cafe Kemangi">
                <div class="kuliner-info">
                    <h3>Cafe Kemangi</h3>
                    <p><i class="fas fa-map-marker-alt"></i>Jl. Gerilya Purwokerto</p>
                </div>
            </div>
            <div class="kuliner-card">
                <img src="Djago Jowo.png" alt="Djago Jowo">
                <div class="kuliner-info">
                    <h3>Djago Jowo</h3>
                    <p><i class="fas fa-map-marker-alt"></i>Jl. Gelora Indah No. 1, Purwokerto</p>
                </div>
            </div>
            <div class="kuliner-card">
                <img src="tempatkuliner.jpg" alt="Cafe Kemangi">
                <div class="kuliner-info">
                    <h3>Umaeh Inyong</h3>
                    <p><i class="fas fa-map-marker-alt"></i>Jl. Gerilya Purwokerto</p>
                </div>
            </div>
            <div class="kuliner-card">
                <img src="Cafe Kemangi.jpg" alt="Cafe Kemangi">
                <div class="kuliner-info">
                    <h3>Cafe Kemangi</h3>
                    <p><i class="fas fa-map-marker-alt"></i>Jl. Gerilya Purwokerto</p>
                </div>
            </div>
            <div class="kuliner-card">
                <img src="Djago Jowo.png" alt="Djago Jowo">
                <div class="kuliner-info">
                    <h3>Djago Jowo</h3>
                    <p><i class="fas fa-map-marker-alt"></i>Jl. Gelora Indah No. 1, Purwokerto</p>
                </div>
            </div>
            <div class="kuliner-card">
                <img src="tempatkuliner.jpg" alt="Cafe Kemangi">
                <div class="kuliner-info">
                    <h3>Cafe Kemangi</h3>
                    <p><i class="fas fa-map-marker-alt"></i>Jl. Gerilya Purwokerto</p>
                </div>
            </div>
        </div>
    </main>

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

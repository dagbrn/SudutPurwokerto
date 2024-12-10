<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sudut Purwokerto</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        /* Navbar */
        nav {
            background: transparent; /* Background transparan */
            padding: 1rem 5%;
            display: flex;
            justify-content: flex-start;
            align-items: center;
            position: absolute; /* Ubah menjadi absolute */
            width: 100%; /* Pastikan menutupi seluruh lebar */
            top: 0; /* Posisikan di bagian atas */
            left: 0;
            z-index: 10;
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

        .hero {
            height: 120vh;
            background-image: linear-gradient(rgb(125, 187, 169), rgba(0, 0, 0, 0)), url('BerandaAtas.jpeg');
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .hero-content {
            position: absolute;
            top: 40%;
            left: 5%;
            transform: translateY(-50%);
            color: white;
            max-width: 800px;
        }

        .hero-content h1 {
            font-size: 5rem;
            font-weight: bold;
            line-height: 1.2;
            margin-bottom: 1.5rem;
        }

        .hero-content p {
            font-size: 1.2rem;
            line-height: 1.6;
            margin-bottom: 2rem;
            opacity: 0.9;
        }

        .jelajahi-btn {
            padding: 1rem 2.5rem;
            background: #FFD700;
            border: none;
            border-radius: 25px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .jelajahi-btn:hover {
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 3rem;
            }

            .nav-links {
                gap: 1.5rem;
            }

            .login-btn, .register-btn {
                padding: 0.5rem 1.5rem;
            }
        }

        /* About Section */
        .about {
            background: rgb(255, 251, 239);
            display: flex;
            gap: 3rem;
            align-items: center;
            border-radius: 50px;
            margin: -50px 0 0 0;
            padding: 5rem 5%;
            position: relative;
            z-index: 2;
        }

        .about-img {
            flex: 0 0 auto;
            width: 400px;
            height: 533.33px;
            overflow: hidden;
        }

        .about-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 15px;
        }

        .about-content {
            flex: 1;
            padding: 2rem 0;
        }

        .about-content h2 {
            font-size: 2.5rem;
            margin-bottom: 1.5rem;
            color: #2F4858;
            font-weight: 600;
        }

        .about-content p {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #2F4858;
            opacity: 0.9;
        }

        /* Features Section */
        .features {
            background: rgb(255, 251, 239);
            border-radius: 50px;
            margin: -50px 0 0 0;
            padding: 4rem 5%;
            position: relative;
            z-index: 3;
        }

        .features-container {
            display: flex;
            gap: 4rem;
            align-items: flex-start;
            min-height: 400px;
        }

        .features-header {
            flex: 1;
            max-width: 400px;
        }

        .features-header h2 {
            font-size: 2.5rem;
            color: #2F4858;
            margin-bottom: 1rem;
        }

        .features-header p {
            font-size: 1.1rem;
            color: #2F4858;
            opacity: 0.9;
            line-height: 1.8;
        }

        .features-grid {
            flex: 2;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }

        .feature-card {
            padding: 1.5rem;
            border: 2px solid #4A665B;
            border-radius: 15px;
            text-align: left;
            transition: all 0.3s ease;
            cursor: pointer;
            background: transparent;
        }

        .feature-card:hover {
            border-color: #FFD700;
            transform: translateY(-5px);
            background: transparent;
        }

        .feature-card:hover i {
            color: #FFD700 !important;
        }

        .feature-card:hover h3,
        .feature-card:hover p {
            color: #FFD700;
        }

        .feature-card img {
            width: 40px;
            height: 40px;
            margin-bottom: 1.5rem;
            color: #4A665B;
        }

        .feature-card h3 {
            font-size: 1.8rem;
            color: #2F4858;
            margin-bottom: 1.2rem;
        }

        .feature-card p {
            font-size: 1.1rem;
            color: #2F4858;
            opacity: 0.9;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        @media (max-width: 1024px) {
            .features-container {
                flex-direction: column;
                min-height: auto;
            }
            
            .features-header {
                max-width: 100%;
                margin-bottom: 2rem;
            }
            
            .features-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 768px) {
            .features {
                padding: 6rem 5%;
            }
            
            .features-grid {
                grid-template-columns: 1fr;
            }
            
            .about {
                flex-direction: column;
            }

            .hero h1 {
                font-size: 2.5rem;
            }
        }

        .explore {
            background: #4B7065;
            border-radius: 50px;
            margin: -50px 0 0 0;
            padding: 10rem 0;
            position: relative;
            z-index: 4;
            text-align: center;
        }

        .explore-header {
            margin-bottom: 5rem;
            width: 90%;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
            text-align: center;
            margin-top: -4rem;
        }

        .explore-header h2 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: white;
        }

        .explore-header p {
            font-size: 1.1rem;
            opacity: 0.9;
            color: white;
        }

        .explore-carousel {
            position: relative;
            width: 100%;
            max-width: 1200px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 2rem;
            margin: 0 auto;
            margin-bottom: 3rem;
        }

        .carousel-container {
            position: relative;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1.5rem;
            padding: 2rem 0;
        }

        .card-wrapper {
            position: relative;
            width: 280px;
            transform: scale(0.85) translateX(-50%);
            transition: all 0.5s ease;
            opacity: 0.6;
            z-index: 1;
        }

        .card-wrapper.active {
            transform: scale(1.1);
            opacity: 1;
            z-index: 2;
        }

        .card {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            aspect-ratio: 3/4;
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }

        .card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card-content {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(
                180deg,
                rgba(0,0,0,0) 0%,
                rgba(0,0,0,0.4) 50%,
                rgba(0,0,0,0.7) 100%
            );
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: center;
            padding: 2rem;
        }

        .card-content h3 {
            font-size: 1.8rem;
            color: white;
            margin-top: auto;
            margin-bottom: 1rem;
        }

        .eksplor-btn {
            padding: 0.8rem 3rem;
            background: #FFD700;
            border: none;
            border-radius: 25px;
            font-weight: bold;
            cursor: pointer;
            font-size: 1rem;
            margin-bottom: 1rem;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.3s ease;
        }

        .card-wrapper .eksplor-btn {
            opacity: 1;
            transform: translateY(0);
        }

        .nav-btn {
            position: absolute;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            color: white;
            font-size: 1.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 3;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .nav-btn.prev {
            left: 0;
        }

        .nav-btn.next {
            right: 0;
        }

        .nav-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.1);
        }

        @media (max-width: 1024px) {
            .explore-carousel {
                max-width: 900px;
            }
            
            .card-wrapper {
                width: 280px;
            }
        }

        @media (max-width: 768px) {
            .explore-carousel {
                max-width: 100%;
            }
            
            .card-wrapper {
                width: 260px;
            }
            
            .card-wrapper.active {
                transform: scale(1.05);
            }
        }

        .recommendations {
            background: rgb(255, 251, 239);
            border-radius: 50px;
            margin: -90px 0 0 0;
            padding: 10rem 5%;
            position: relative;
            z-index: 5;
        }

        .section-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .recommendations h2 {
            font-size: 2rem;
            margin-bottom: 2rem;
            color: #333;
            margin-top: -6rem;
        }

        .category {
            margin-bottom: 3rem;
        }

        .category-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .category-header h3 {
            font-size: 1.5rem;
            color: #333;
        }

        .see-more {
            color: #333;
            text-decoration: none;
            font-size: 1.2rem;
            font-weight: bold;
        }

        .places-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }

        .place-card {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .place-card:hover {
            transform: translateY(-5px);
        }

        .place-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .place-info {
            padding: 1rem;
        }

        .place-info h4 {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
            color: #333;
        }

        .place-info p {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 0.3rem;
        }

        .place-info .date {
            color: #333;
            font-weight: 500;
        }

        .fa-map-marker-alt {
            margin-right: 5px;
            color: #666;
        }

        @media (max-width: 768px) {
            .places-grid {
                grid-template-columns: 1fr;
            }
            
            .place-card img {
                height: 180px;
            }
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

        @media (max-width: 992px) {
            .footer-container {
                grid-template-columns: 1fr 1fr;
                gap: 2rem;
            }
        }

        @media (max-width: 576px) {
            .footer-container {
                grid-template-columns: 1fr;
            }
            
            .copyright {
                text-align: center;
            }
        }

        .section-separator {
            height: 50px;
            background: #f9f9f9;
            border-radius: 50px 50px 0 0;
            margin: -25px 20px;
        }

        /* Tambahkan class baru untuk lengkungan bagian atas */
        .curved-top {
            border-radius: 0 0 50px 50px;
            margin: -50px 0 0 0;
            padding-top: 100px;
            position: relative;
            z-index: 1;
        }

        /* Terapkan ke setiap section */
        .about {
            background: rgb(255, 251, 239);
            display: flex;
            gap: 3rem;
            align-items: center;
            border-radius: 50px;
            margin: -50px 0 0 0;
            padding: 5rem 5%;
            position: relative;
            z-index: 2;
        }

        .features {
            background: rgb(255, 251, 239);
            border-radius: 50px;
            margin: -50px 0 0 0;
            padding: 5rem 5%;
            position: relative;
            z-index: 3;
        }

        .explore {
            background: #4A665B;
            border-radius: 50px;
            margin: -50px 0 0 0;
            padding: 10rem 0;
            position: relative;
            z-index: 4;
            text-align: center;
        }

        .recommendations {
            background: rgb(255, 251, 239);
            border-radius: 50px;
            margin: -90px 0 0 0;
            padding: 12rem 5%;
            position: relative;
            z-index: 5;
        }

        .footer {
            background: #38544C;
            border-radius: 0;
            margin: -40px 0 0 0;
            padding: 5rem 5% 2rem;
            position: relative;
            z-index: 6;
            
        }

        /* Responsif untuk layar kecil */
        @media (max-width: 768px) {
            .about-img {
                width: 300px;
                height: 400px;
            }
            
            .about {
                flex-direction: column;
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

    <section class="hero">
        <div class="hero-content">
            <h1>Selamat Datang<br>di Purwokerto</h1>
            <p>Temukan Kuliner Lezat, Destinasi Wisata Menarik,<br>dan Event Seru yang Ada di Purwokerto</p>
            <button class="jelajahi-btn">Jelajahi Sekarang!</button>
        </div>
    </section>

    <section class="about curved-top">
        <div class="about-img">
            <img src="Alun-Alun.jpeg" alt="Purwokerto">
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

    <section class="explore curved-top">
        <div class="explore-header">
            <h2>Eksplor Sudut Terbaik Purwokerto</h2>
            <p>Jelajahi setiap sudut kota dengan pilihan kuliner, wisata, dan event yang membuat Purwokerto semakin istimewa.</p>
        </div>
        
        <div class="explore-carousel">
            <button class="nav-btn prev">&#10094;</button>
            <div class="carousel-container">
                <div class="card-wrapper">
                    <div class="card">
                        <img src="tempatkuliner.jpg" alt="Kuliner">
                        <div class="card-content">
                            <h3>Kuliner</h3>
                            <button class="eksplor-btn">Eksplor</button>
                        </div>
                    </div>
                </div>
                <div class="card-wrapper active">
                    <div class="card">
                        <img src="simpang.jpeg" alt="Tempat Wisata">
                        <div class="card-content">
                            <h3>Tempat Wisata</h3>
                            <button class="eksplor-btn">Eksplor</button>
                        </div>
                    </div>
                </div>
                <div class="card-wrapper">
                    <div class="card">
                        <img src="oranglari.jpg" alt="Event">
                        <div class="card-content">
                            <h3>Event</h3>
                            <button class="eksplor-btn">Eksplor</button>
                        </div>
                    </div>
                </div>
            </div>
            <button class="nav-btn next">&#10095;</button>
        </div>
    </section>

    <section class="recommendations curved-top">
        <div class="section-container">
            <h2>Rekomedasi Tempat di Purwokerto</h2>
            
            <!-- Kuliner Khas -->
            <div class="category">
                <div class="category-header">
                    <h3>Kuliner Khas</h3>
                    <a href="#" class="see-more">></a>
                </div>
                <div class="places-grid">
                    <div class="place-card">
                        <img src="Cafe Kemangi.jpg" alt="Cafe Kemango">
                        <div class="place-info">
                            <h4>Cafe Kemangi</h4>
                            <p><i class="fas fa-map-marker-alt"></i> Jl. Gerliya Purwokerto</p>
                        </div>
                    </div>
                    <div class="place-card">
                        <img src="Djago Jowo.png" alt="Djago Jowo">
                        <div class="place-info">
                            <h4>Djago Jowo</h4>
                            <p><i class="fas fa-map-marker-alt"></i> Jl. Gelora Indah No. 1, Purwokerto</p>
                        </div>
                    </div>
                    <div class="place-card">
                        <img src="tempatkuliner.jpg" alt="Cafe Kemango">
                        <div class="place-info">
                            <h4>Umaeh Inyong</h4>
                            <p><i class="fas fa-map-marker-alt"></i> Jl. Gerliya Purwokerto</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tempat Wisata -->
            <div class="category">
                <div class="category-header">
                    <h3>Tempat Wisata</h3>
                    <a href="#" class="see-more">></a>
                </div>
                <div class="places-grid">
                    <div class="place-card">
                        <img src="Baturadden.jpg" alt="Baturraden">
                        <div class="place-info">
                            <h4>Baturraden</h4>
                            <p><i class="fas fa-map-marker-alt"></i> Jl. Raya Baturraden KM 12, Purwokerto</p>
                        </div>
                    </div>
                    <div class="place-card">
                        <img src="Akuarium Purbasari.jpg" alt="Taman Akuarium Purbasari">
                        <div class="place-info">
                            <h4>Taman Akuarium Purbasari</h4>
                            <p><i class="fas fa-map-marker-alt"></i> Desa Purbayes, Padamara, Purwokerto</p>
                        </div>
                    </div>
                    <div class="place-card">
                        <img src="Andhang Pangrean.jpg" alt="Cafe Kemangi">
                        <div class="place-info">
                            <h4>Andhang Pangrean</h4>
                            <p><i class="fas fa-map-marker-alt"></i> Jl. Gerliya Purwokerto</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Event dan Festival -->
            <div class="category">
                <div class="category-header">
                    <h3>Event dan Festival</h3>
                    <a href="#" class="see-more">></a>
                </div>
                <div class="places-grid">
                    <div class="place-card">
                        <img src="Economic Project.png" alt="Economic Project">
                        <div class="place-info">
                            <h4>Economic Project</h4>
                            <p class="date">19 Desember 2024</p>
                            <p><i class="fas fa-map-marker-alt"></i> Gor Satria Purwokerto</p>
                        </div>
                    </div>
                    <div class="place-card">
                        <img src="Economic Project.png" alt="Economic Project">
                        <div class="place-info">
                            <h4>Economic Project</h4>
                            <p class="date">19 Desember 2024</p>
                            <p><i class="fas fa-map-marker-alt"></i> Gor Satria Purwokerto</p>
                        </div>
                    </div>
                    <div class="place-card">
                        <img src="Economic Project.png" alt="Economic Project">
                        <div class="place-info">
                            <h4>Economic Project</h4>
                            <p class="date">19 Desember 2024</p>
                            <p><i class="fas fa-map-marker-alt"></i> Gor Satria Purwokerto</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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

<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['judul']; ?></title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    
    <!-- AOS Animation CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #2563eb;
            --primary-dark: #1d4ed8;
            --primary-light: #60a5fa;
            --secondary-color: #f1f5f9;
            --accent-color: #f59e0b;
            --text-main: #0f172a;
            --text-muted: #64748b;
            --bg-color: #ffffff;
            --font-heading: 'Inter', sans-serif;
            --font-body: 'Inter', sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-body);
            color: var(--text-main);
            background-color: var(--bg-color);
            overflow-x: hidden;
            line-height: 1.6;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: var(--font-heading);
            font-weight: 700;
            line-height: 1.2;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* Utility Classes */
        .container {
            width: 100%;
            /* Dibuat lebih lebar agar terasa benar-benar full-width */
            max-width: 1440px; 
            margin: 0 auto;
            padding: 0 4%;
        }

        .btn {
            display: inline-block;
            padding: 0.8rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            font-family: var(--font-heading);
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
            text-align: center;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: white;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, 0.4);
        }

        .btn-outline {
            background-color: transparent;
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
        }

        .btn-outline:hover {
            background-color: var(--primary-color);
            color: white;
            transform: translateY(-2px);
        }

        /* Navbar */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            padding: 1.5rem 0;
            z-index: 1000;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .navbar.scrolled {
            padding: 1rem 0;
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .navbar .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-brand {
            font-family: var(--font-heading);
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--primary-color);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .navbar-brand i {
            color: var(--accent-color);
        }

        .navbar-nav {
            display: flex;
            list-style: none;
            gap: 2rem;
            align-items: center;
        }

        .nav-link {
            font-weight: 500;
            color: var(--text-main);
            transition: color 0.3s ease;
            position: relative;
        }

        .nav-link:hover {
            color: var(--primary-color);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background-color: var(--primary-color);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        /* Hero Section */
        .hero {
            min-height: 100vh;
            display: flex;
            align-items: center;
            position: relative;
            padding-top: 80px;
            overflow: hidden;
            background: linear-gradient(135deg, #eff6ff 0%, #ffffff 100%);
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -10%;
            right: -5%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(96,165,250,0.2) 0%, rgba(255,255,255,0) 70%);
            border-radius: 50%;
            z-index: 0;
        }

        .hero::after {
            content: '';
            position: absolute;
            bottom: 10%;
            left: -5%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(245,158,11,0.15) 0%, rgba(255,255,255,0) 70%);
            border-radius: 50%;
            z-index: 0;
        }

        .hero .container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
            position: relative;
            z-index: 1;
        }

        .hero-content h1 {
            font-size: 3.8rem;
            margin-bottom: 1.5rem;
            color: var(--text-main);
        }

        .hero-content h1 span {
            color: var(--primary-color);
            position: relative;
            display: inline-block;
        }

        .hero-content p {
            font-size: 1.15rem;
            color: var(--text-muted);
            margin-bottom: 2rem;
            max-width: 90%;
        }

        .hero-btns {
            display: flex;
            gap: 1rem;
        }

        .hero-image {
            position: relative;
        }

        .hero-image img {
            width: 100%;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            animation: float 6s ease-in-out infinite;
            object-fit: cover;
            height: 500px;
        }

        .floating-card {
            position: absolute;
            background: white;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            gap: 1rem;
            animation: float 5s ease-in-out infinite alternate;
            z-index: 10;
        }

        .floating-card.card-1 {
            top: 10%;
            left: -5%;
            animation-delay: 1s;
        }

        .floating-card.card-2 {
            bottom: 15%;
            right: -5%;
            animation-delay: 2s;
        }

        .card-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(37, 99, 235, 0.1);
            color: var(--primary-color);
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 1.2rem;
        }

        .card-text h4 {
            font-size: 1rem;
            margin-bottom: 0.2rem;
        }
        
        .card-text p {
            font-size: 0.8rem;
            color: var(--text-muted);
            margin: 0;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }

        /* Stats Section */
        .stats {
            padding: 4rem 0;
            background-color: white;
            position: relative;
            z-index: 2;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            background: white;
            padding: 3rem;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.05);
            transform: translateY(-50%);
            margin-bottom: -50px;
        }

        .stat-item {
            text-align: center;
            padding: 1rem;
        }

        .stat-item:not(:last-child) {
            border-right: 1px solid rgba(0,0,0,0.05);
        }

        .stat-number {
            font-size: 2.8rem;
            font-weight: 800;
            color: var(--primary-color);
            font-family: var(--font-heading);
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: var(--text-muted);
            font-weight: 500;
            font-size: 1.1rem;
        }

        /* Gallery Sections Baru (Full Width Feel) */
        .gallery {
            padding: 4rem 0;
            background: var(--secondary-color);
        }
        
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            margin-top: 2rem;
        }
        
        .gallery-item {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            height: 300px;
        }
        
        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .gallery-item:hover img {
            transform: scale(1.1);
        }
        
        .gallery-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            align-items: flex-end;
            padding: 2rem;
        }
        
        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }
        
        .gallery-overlay h3 {
            color: white;
            font-size: 1.2rem;
        }

        /* Features Section */
        .features {
            padding: 6rem 0;
            background-color: white;
        }

        .section-header {
            text-align: center;
            margin-bottom: 4rem;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        .section-header h2 {
            font-size: 2.8rem;
            margin-bottom: 1rem;
            color: var(--text-main);
        }

        .section-header p {
            color: var(--text-muted);
            font-size: 1.1rem;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2.5rem;
        }

        .feature-card {
            background: var(--secondary-color);
            padding: 3rem 2.5rem;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.02);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: var(--primary-color);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.08);
            background: white;
        }

        .feature-card:hover::before {
            transform: scaleX(1);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            border-radius: 20px;
            background: rgba(37, 99, 235, 0.1);
            color: var(--primary-color);
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 2.5rem;
            margin-bottom: 2rem;
            transition: all 0.3s ease;
        }

        .feature-card:hover .feature-icon {
            background: var(--primary-color);
            color: white;
            transform: rotateY(180deg);
        }

        .feature-card h3 {
            font-size: 1.4rem;
            margin-bottom: 1rem;
        }

        .feature-card p {
            color: var(--text-muted);
            font-size: 1.05rem;
        }

        /* Enhanced Library Info Section */
        .info-section {
            padding: 8rem 0;
            background: linear-gradient(135deg, #f8fafc 0%, #e0e7ff 100%);
            overflow: hidden;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 5rem;
            align-items: center;
        }

        .info-image {
            position: relative;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0,0,0,0.15);
        }
        
        .info-image img {
            width: 100%;
            height: 600px;
            object-fit: cover;
            display: block;
            transition: transform 0.8s ease;
        }

        .info-image:hover img {
            transform: scale(1.05);
        }

        .info-content h2 {
            font-size: 3rem;
            margin-bottom: 1.5rem;
        }

        .info-content p {
            color: var(--text-muted);
            margin-bottom: 1.5rem;
            font-size: 1.15rem;
        }

        .check-list {
            list-style: none;
            margin-bottom: 2.5rem;
        }

        .check-list li {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.2rem;
            font-weight: 500;
            font-size: 1.1rem;
        }

        .check-list li i {
            color: #10b981;
            font-size: 1.5rem;
        }

        /* CTA Section */
        .cta-section {
            padding: 8rem 0;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%), url('https://images.unsplash.com/photo-1541963463532-d68292c34b19?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80') center/cover;
            background-blend-mode: multiply;
            color: white;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .cta-content {
            position: relative;
            z-index: 1;
            max-width: 800px;
            margin: 0 auto;
        }

        .cta-content h2 {
            font-size: 3.5rem;
            margin-bottom: 1.5rem;
        }

        .cta-content p {
            font-size: 1.2rem;
            margin-bottom: 3rem;
            opacity: 0.9;
        }

        .btn-white {
            background: white;
            color: var(--primary-color);
        }

        .btn-white:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }

        /* Footer */
        .footer {
            background-color: #0f172a;
            color: white;
            padding: 5rem 0 2rem;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr;
            gap: 4rem;
            margin-bottom: 4rem;
        }

        .footer-brand h3 {
            font-size: 1.8rem;
            font-family: var(--font-heading);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .footer-brand i {
            color: var(--primary-light);
        }

        .footer-brand p {
            color: #94a3b8;
            max-width: 400px;
            font-size: 1.1rem;
        }

        .footer-links h4 {
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 0.8rem;
        }

        .footer-links h4::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 50px;
            height: 2px;
            background: var(--primary-light);
        }

        .footer-links ul {
            list-style: none;
        }

        .footer-links ul li {
            margin-bottom: 1rem;
        }

        .footer-links ul li a {
            color: #94a3b8;
            transition: color 0.3s ease;
            font-size: 1.1rem;
        }

        .footer-links ul li a:hover {
            color: white;
            padding-left: 8px;
        }

        .footer-bottom {
            text-align: center;
            padding-top: 2.5rem;
            border-top: 1px solid rgba(255,255,255,0.1);
            color: #94a3b8;
            font-size: 1rem;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .hero-content h1 {
                font-size: 3rem;
            }
            .gallery-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 992px) {
            .hero .container, .info-grid {
                grid-template-columns: 1fr;
                text-align: center;
            }
            .hero-content {
                order: 1;
            }
            .hero-image {
                order: 2;
                margin-top: 2rem;
            }
            .hero-btns {
                justify-content: center;
            }
            .floating-card {
                display: none;
            }
            .stats-grid {
                transform: translateY(0);
                margin-bottom: 4rem;
                margin-top: -2rem;
            }
            .footer-grid {
                grid-template-columns: 1fr 1fr;
            }
            .check-list li {
                justify-content: center;
            }
        }

        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2.5rem;
            }
            .stats-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
                padding: 2rem;
            }
            .stat-item:not(:last-child) {
                border-right: none;
                border-bottom: 1px solid rgba(0,0,0,0.05);
            }
            .gallery-grid {
                grid-template-columns: 1fr;
            }
            .footer-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
            .navbar-nav {
                display: none;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar" id="navbar">
        <div class="container">
            <a href="#" class="navbar-brand">
                <i class="fas fa-book-reader"></i> E-PERPUS
            </a>
            <ul class="navbar-nav">
                <li><a href="#beranda" class="nav-link">Beranda</a></li>
                <li><a href="#galeri" class="nav-link">Galeri</a></li>
                <li><a href="#fitur" class="nav-link">Fitur</a></li>
                <li><a href="#tentang" class="nav-link">Tentang</a></li>
            </ul>
            <div style="display: flex; gap: 1rem;">
                <a href="<?= BASEURL; ?>/pendaftaran" class="btn btn-outline" style="padding: 0.6rem 1.5rem; font-size: 0.9rem;">Daftar Anggota</a>
                <a href="<?= BASEURL; ?>/auth" class="btn btn-primary" style="padding: 0.6rem 1.5rem; font-size: 0.9rem;">Masuk Aplikasi</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero" id="beranda">
        <div class="container">
            <div class="hero-content" data-aos="fade-right" data-aos-duration="1200">
                <h1 data-aos="zoom-out" data-aos-delay="200">
                    E-PERPUS <br>
                    <span>DISPERSIP KAPUAS</span>
                </h1>
                <p data-aos="fade-up" data-aos-delay="400">Jelajahi dunia pengetahuan dalam genggaman Anda. Akses ribuan koleksi buku digital dan tingkatkan budaya literasi di Kabupaten Kapuas dengan mudah dan cepat.</p>
                <div class="hero-btns" data-aos="fade-up" data-aos-delay="600">
                    <a href="<?= BASEURL; ?>/auth" class="btn btn-primary">Mulai Membaca</a>
                    <a href="<?= BASEURL; ?>/pendaftaran" class="btn btn-outline">Daftar Anggota</a>
                </div>
            </div>
            
            <div class="hero-image" data-aos="fade-left" data-aos-duration="1200">
                <!-- Gambar Perpustakaan Modern -->
                <img src="https://images.unsplash.com/photo-1568667256549-094345857637?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Perpustakaan Kapuas Modern" />
                
                <div class="floating-card card-1" data-aos="fade-up" data-aos-delay="800">
                    <div class="card-icon">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <div class="card-text">
                        <h4>Akses 24/7</h4>
                        <p>Kapanpun & dimanapun</p>
                    </div>
                </div>

                <div class="floating-card card-2" data-aos="fade-up" data-aos-delay="1000">
                    <div class="card-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-text">
                        <h4>Sobat Literasi</h4>
                        <p>Ribuan anggota aktif</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats">
        <div class="container">
            <div class="stats-grid" data-aos="fade-up" data-aos-duration="1000" data-aos-offset="-100">
                <div class="stat-item">
                    <div class="stat-number" data-count="1500">1,500+</div>
                    <div class="stat-label">Koleksi Buku Terkini</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number" data-count="3200">3,200+</div>
                    <div class="stat-label">Anggota Aktif</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number" data-count="50">50+</div>
                    <div class="stat-label">Kategori Pilihan</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section (New Section) -->
    <section class="gallery" id="galeri">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2>Galeri Perpustakaan</h2>
                <p>Suasana dan koleksi terbaik yang kami persiapkan untuk para pencinta buku di wilayah Kapuas.</p>
            </div>
            
            <div class="gallery-grid">
                <div class="gallery-item" data-aos="fade-up" data-aos-delay="100">
                    <img src="https://images.unsplash.com/photo-1507842217343-583bb7270b66?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Lorong Buku" />
                    <div class="gallery-overlay">
                        <h3>Koleksi Super Lengkap</h3>
                    </div>
                </div>
                <div class="gallery-item" data-aos="fade-up" data-aos-delay="300">
                    <img src="https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Fasilitas Belajar" />
                    <div class="gallery-overlay">
                        <h3>Ruang Baca Estetis</h3>
                    </div>
                </div>
                <div class="gallery-item" data-aos="fade-up" data-aos-delay="500">
                    <img src="https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Buku Digital" />
                    <div class="gallery-overlay">
                        <h3>Referensi Membaca</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="fitur">
        <div class="container">
            <div class="section-header" data-aos="fade-up">
                <h2>Layanan Unggulan Kami</h2>
                <p>Nikmati berbagai kemudahan dalam membaca dan meminjam buku melalui layanan perpustakaan digital kami.</p>
            </div>
            
            <div class="features-grid">
                <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-icon">
                        <i class="fas fa-layer-group"></i>
                    </div>
                    <h3>Koleksi Terlengkap</h3>
                    <p>Temukan berbagai jenis buku mulai dari fiksi, non-fiksi, buku pelajaran, hingga jurnal akademik yang terus diperbarui.</p>
                </div>

                <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-icon">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h3>Peminjaman Cepat</h3>
                    <p>Sistem terkomputerisasi yang membuat proses pencarian, peminjaman, dan pengembalian buku menjadi sangat efisien.</p>
                </div>

                <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h3>Akses Mudah</h3>
                    <p>Baca informasi ketersediaan buku dan riwayat peminjaman Anda langsung dari komputer atau ponsel pintar Anda.</p>
                </div>

                <div class="feature-card" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Aman & Terpercaya</h3>
                    <p>Data anggota dan riwayat peminjaman tersimpan dengan aman menggunakan sistem keamanan standar.</p>
                </div>
                
                <div class="feature-card" data-aos="fade-up" data-aos-delay="500">
                    <div class="feature-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3>Pencarian Pintar</h3>
                    <p>Temukan buku yang Anda cari dalam hitungan detik dengan menggunakan fitur pencarian canggih berbasis kategori dan judul.</p>
                </div>

                <div class="feature-card" data-aos="fade-up" data-aos-delay="600">
                    <div class="feature-icon">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <h3>Laporan Terintegrasi</h3>
                    <p>Bagi admin, fitur laporan memudahkan dalam rekapitulasi data pengunjung dan sirkulasi buku perpustakaan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Info Section -->
    <section class="info-section" id="tentang">
        <div class="container">
            <div class="info-grid">
                <div class="info-image" data-aos="fade-right" data-aos-duration="1200">
                    <img src="https://images.unsplash.com/photo-1521587760476-6c12a4b040da?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80" alt="Ruang Perpustakaan Kapuas" />
                </div>
                <div class="info-content" data-aos="fade-left" data-aos-duration="1200">
                    <h2>Meningkatkan Indeks Literasi Masyarakat Kapuas</h2>
                    <p>Aplikasi E-PERPUS DISPERSIP KAPUAS dibangun dengan visi mulia untuk mendekatkan sumber ilmu pengetahuan kepada seluruh lapisan masyarakat Kabupaten Kapuas.</p>
                    <p>Kami percaya bahwa dengan membaca, masyarakat dapat lebih berdaya saing dan memiliki wawasan global meskipun berada di daerah.</p>
                    
                    <ul class="check-list">
                        <li><i class="fas fa-check-circle"></i> Integrasi sistem yang modern</li>
                        <li><i class="fas fa-check-circle"></i> Pendaftaran anggota yang mudah</li>
                        <li><i class="fas fa-check-circle"></i> Dukungan penuh dari Dispersip</li>
                    </ul>

                    <a href="<?= BASEURL; ?>/auth" class="btn btn-outline" style="margin-top: 1rem;">Daftar Menjadi Anggota</a>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section" data-aos="zoom-in" data-aos-duration="1000">
        <div class="container">
            <div class="cta-content">
                <h2>Siap Untuk Mulai Membaca?</h2>
                <p>Bergabunglah dengan ribuan pembaca lainnya dan mulailah petualangan ilmu pengetahuan Anda hari ini bersama E-PERPUS DISPERSIP KAPUAS.</p>
                <a href="<?= BASEURL; ?>/auth" class="btn btn-white btn-lg" style="padding: 1.2rem 3.5rem; font-size: 1.2rem;">Masuk Aplikasi Sekarang</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand" data-aos="fade-up">
                    <h3><i class="fas fa-book-reader"></i> E-PERPUS</h3>
                    <p>Dinas Perpustakaan dan Kearsipan (DISPERSIP) Kabupaten Kapuas. Mewujudkan masyarakat Kapuas yang cerdas dan berbudaya membaca.</p>
                </div>
                <div class="footer-links" data-aos="fade-up" data-aos-delay="100">
                    <h4>Tautan Cepat</h4>
                    <ul>
                        <li><a href="#beranda">Beranda</a></li>
                        <li><a href="#galeri">Galeri</a></li>
                        <li><a href="#fitur">Fitur Unggulan</a></li>
                        <li><a href="#tentang">Tentang Kami</a></li>
                    </ul>
                </div>
                <div class="footer-links" data-aos="fade-up" data-aos-delay="200">
                    <h4>Kontak Kami</h4>
                    <ul>
                        <li><a href="#"><i class="fas fa-map-marker-alt"></i> Kuala Kapuas, Kalteng</a></li>
                        <li><a href="#"><i class="fas fa-envelope"></i> admin@dispersipkapuas.go.id</a></li>
                        <li><a href="#"><i class="fas fa-phone"></i> (0514) 123456</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?= date('Y'); ?> E-PERPUS DISPERSIP KAPUAS. Mengembangkan sistem sirkulasi modern.</p>
            </div>
        </div>
    </footer>

    <!-- AOS Animation Script -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-out-cubic',
            once: true,
            offset: 50
        });

        // Navbar Scroll Effect
        window.addEventListener('scroll', function() {
            var navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
        
        // Counter animation for stats
        const counters = document.querySelectorAll('.stat-number');
        const speed = 200;

        const startCounters = (entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counter = entry.target;
                    const target = +counter.getAttribute('data-count');
                    let count = 0;
                    
                    const updateCount = () => {
                        const inc = target / speed;
                        if (count < target) {
                            count += inc;
                            counter.innerText = Math.ceil(count) + '+';
                            setTimeout(updateCount, 25);
                        } else {
                            counter.innerText = target + '+';
                        }
                    };
                    updateCount();
                    observer.unobserve(counter);
                }
            });
        };

        const counterObserver = new IntersectionObserver(startCounters, {
            threshold: 0.5
        });

        counters.forEach(counter => {
            counterObserver.observe(counter);
        });
    </script>
</body>
</html>

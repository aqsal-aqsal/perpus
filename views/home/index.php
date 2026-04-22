<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['judul']; ?></title>
    <link rel="icon" type="image/png" href="<?= BASEURL; ?>../public/img/logo-kapuas.png">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Inter:wght@400;500;600&display=swap"
        rel="stylesheet">

    <!-- AOS Animation CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="<?= BASEURL; ?>/public/css/home.css">
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar" id="navbar">
        <div class="container">
            <a href="#" class="navbar-brand">
                <img src="<?= BASEURL; ?>../public/img/logo-kapuas.png" alt="Logo Kapuas" style="height: 35px;">
                E-PERPUS
            </a>
            <ul class="navbar-nav">
                <li><a href="#beranda" class="nav-link">Beranda</a></li>
                <li><a href="#galeri" class="nav-link">Galeri</a></li>
                <li><a href="#fitur" class="nav-link">Fitur</a></li>
                <li><a href="#tentang" class="nav-link">Tentang</a></li>
            </ul>
            <div style="display: flex; gap: 1rem;">
                <a href="<?= BASEURL; ?>/pendaftaran" class="btn btn-outline"
                    style="padding: 0.6rem 1.5rem; font-size: 0.9rem;">Daftar Anggota</a>
                <a href="<?= BASEURL; ?>/auth" class="btn btn-primary"
                    style="padding: 0.6rem 1.5rem; font-size: 0.9rem;">Masuk Aplikasi</a>
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
                <p data-aos="fade-up" data-aos-delay="400">Jelajahi dunia pengetahuan dalam genggaman Anda. Akses ribuan
                    koleksi buku digital dan tingkatkan budaya literasi di Kabupaten Kapuas dengan mudah dan cepat.</p>
                <div class="hero-btns" data-aos="fade-up" data-aos-delay="600">
                    <a href="<?= BASEURL; ?>/auth" class="btn btn-primary">Mulai Membaca</a>
                    <a href="<?= BASEURL; ?>/pendaftaran" class="btn btn-outline">Daftar Anggota</a>
                </div>
            </div>

            <div class="hero-image" data-aos="fade-left" data-aos-duration="1200">
                <!-- Gambar Perpustakaan Modern -->
                <img src="https://images.unsplash.com/photo-1568667256549-094345857637?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80"
                    alt="Perpustakaan Kapuas Modern" />

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
                    <img src="https://images.unsplash.com/photo-1507842217343-583bb7270b66?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                        alt="Lorong Buku" />
                    <div class="gallery-overlay">
                        <h3>Koleksi Super Lengkap</h3>
                    </div>
                </div>
                <div class="gallery-item" data-aos="fade-up" data-aos-delay="300">
                    <img src="https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                        alt="Fasilitas Belajar" />
                    <div class="gallery-overlay">
                        <h3>Ruang Baca Estetis</h3>
                    </div>
                </div>
                <div class="gallery-item" data-aos="fade-up" data-aos-delay="500">
                    <img src="https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                        alt="Buku Digital" />
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
                <p>Nikmati berbagai kemudahan dalam membaca dan meminjam buku melalui layanan perpustakaan digital kami.
                </p>
            </div>

            <div class="features-grid">
                <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-icon">
                        <i class="fas fa-layer-group"></i>
                    </div>
                    <h3>Koleksi Terlengkap</h3>
                    <p>Temukan berbagai jenis buku mulai dari fiksi, non-fiksi, buku pelajaran, hingga jurnal akademik
                        yang terus diperbarui.</p>
                </div>

                <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-icon">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h3>Peminjaman Cepat</h3>
                    <p>Sistem terkomputerisasi yang membuat proses pencarian, peminjaman, dan pengembalian buku menjadi
                        sangat efisien.</p>
                </div>

                <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h3>Akses Mudah</h3>
                    <p>Baca informasi ketersediaan buku dan riwayat peminjaman Anda langsung dari komputer atau ponsel
                        pintar Anda.</p>
                </div>

                <div class="feature-card" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Aman & Terpercaya</h3>
                    <p>Data anggota dan riwayat peminjaman tersimpan dengan aman menggunakan sistem keamanan standar.
                    </p>
                </div>

                <div class="feature-card" data-aos="fade-up" data-aos-delay="500">
                    <div class="feature-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h3>Pencarian Pintar</h3>
                    <p>Temukan buku yang Anda cari dalam hitungan detik dengan menggunakan fitur pencarian canggih
                        berbasis kategori dan judul.</p>
                </div>

                <div class="feature-card" data-aos="fade-up" data-aos-delay="600">
                    <div class="feature-icon">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <h3>Laporan Terintegrasi</h3>
                    <p>Bagi admin, fitur laporan memudahkan dalam rekapitulasi data pengunjung dan sirkulasi buku
                        perpustakaan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Info Section -->
    <section class="info-section" id="tentang">
        <div class="container">
            <div class="info-grid">
                <div class="info-image" data-aos="fade-right" data-aos-duration="1200">
                    <img src="https://images.unsplash.com/photo-1521587760476-6c12a4b040da?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80"
                        alt="Ruang Perpustakaan Kapuas" />
                </div>
                <div class="info-content" data-aos="fade-left" data-aos-duration="1200">
                    <h2>Meningkatkan Indeks Literasi Masyarakat Kapuas</h2>
                    <p>Aplikasi E-PERPUS DISPERSIP KAPUAS dibangun dengan visi mulia untuk mendekatkan sumber ilmu
                        pengetahuan kepada seluruh lapisan masyarakat Kabupaten Kapuas.</p>
                    <p>Kami percaya bahwa dengan membaca, masyarakat dapat lebih berdaya saing dan memiliki wawasan
                        global meskipun berada di daerah.</p>

                    <ul class="check-list">
                        <li><i class="fas fa-check-circle"></i> Integrasi sistem yang modern</li>
                        <li><i class="fas fa-check-circle"></i> Pendaftaran anggota yang mudah</li>
                        <li><i class="fas fa-check-circle"></i> Dukungan penuh dari Dispersip</li>
                    </ul>

                    <a href="<?= BASEURL; ?>/auth" class="btn btn-outline" style="margin-top: 1rem;">Daftar Menjadi
                        Anggota</a>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section" data-aos="zoom-in" data-aos-duration="1000">
        <div class="container">
            <div class="cta-content">
                <h2>Siap Untuk Mulai Membaca?</h2>
                <p>Bergabunglah dengan ribuan pembaca lainnya dan mulailah petualangan ilmu pengetahuan Anda hari ini
                    bersama E-PERPUS DISPERSIP KAPUAS.</p>
                <a href="<?= BASEURL; ?>/auth" class="btn btn-white btn-lg"
                    style="padding: 1.2rem 3.5rem; font-size: 1.2rem;">Masuk Aplikasi Sekarang</a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand" data-aos="fade-up">
                    <h3>
                        <img src="<?= BASEURL; ?>../public/img/logo-kapuas.png" alt="Logo Kapuas">
                        E-PERPUS DISPERSIP
                    </h3>
                    <p>Dinas Perpustakaan dan Kearsipan (DISPERSIP) Kabupaten Kapuas. Mewujudkan masyarakat Kapuas yang
                        cerdas dan berbudaya membaca.</p>
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
        window.addEventListener('scroll', function () {
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
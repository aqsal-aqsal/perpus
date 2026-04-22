<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['judul']; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <style>
        <?php 
            $css_path = __DIR__ . '/../../public/css/card.css';
            if (file_exists($css_path)) {
                echo file_get_contents($css_path);
            } else {
                // Critical fallback to ensure basic structure if file not found
                echo ".id-card { background: #001021; color: white; padding: 40px; border-radius: 15px; width: 850px; height: 520px; }";
                echo ".card-header { background: #c5a059; padding: 20px; }";
            }
        ?>
    </style>
</head>
<body>

    <div class="success-header">
        <h1>KARTU ANGGOTA DIGITAL</h1>
        <p>Atas nama <?= htmlspecialchars($data['anggota']['nama']); ?></p>
    </div>

    <div class="card-wrapper" id="card-download">
        <div class="id-card">
            <!-- Decorative Borders -->
            <div class="card-border-1"></div>
            <div class="card-border-2"></div>

            <!-- Background Decoration -->
            <div class="card-bg-patterns">
                <div class="pattern-guilloche"></div>
            </div>
            <div class="bg-watermark">E-PERPUS</div>
            
            <div class="card-header">
                <div class="brand">
                    <div class="brand-icon">
                        <i class="fas fa-university"></i>
                    </div>
                    <div class="brand-info">
                        <h2>PERPUSTAKAAN DIGITAL</h2>
                        <p>DINAS KEARSIPAN DAN PERPUSTAKAAN DAERAH</p>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="photo-section">
                    <div class="photo-frame">
                        <?php 
                            // Check both potential keys: 'foto' (from direct admin add) or 'foto_ktp' (from registration)
                            $foto_name = $data['anggota']['foto_ktp'] ?? $data['anggota']['foto'] ?? null;
                            $foto_path = $data['anggota']['foto_ktp'] ? '/public/img/ktp/' : '/public/img/anggota/';
                            
                            $foto = $foto_name ? BASEURL . $foto_path . $foto_name : 'https://ui-avatars.com/api/?name=' . urlencode($data['anggota']['nama']) . '&background=001021&color=c5a059&size=500';
                        ?>
                        <img src="<?= $foto ?>" alt="Member Photo">
                    </div>
                    <div class="member-id-container">
                        <div class="member-id-label">MEMBER ID</div>
                        <div class="member-id">
                            <?= str_pad($data['anggota']['id_user'], 8, '0', STR_PAD_LEFT); ?>
                        </div>
                    </div>
                </div>

                <div class="info-section">
                    <div class="id-title-area">
                        <h1 class="id-title">KARTU ANGGOTA</h1>
                        <div class="qr-code-box">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?= $data['anggota']['id_user']; ?>" alt="QR Code">
                        </div>
                    </div>
                    
                    <div class="info-grid">
                        <div class="info-item full">
                            <div class="label">NAMA LENGKAP</div>
                            <div class="value uppercase"><?= htmlspecialchars($data['anggota']['nama']); ?></div>
                        </div>
                        <div class="info-item">
                            <div class="label">NOMOR TELEPON</div>
                            <div class="value"><?= htmlspecialchars($data['anggota']['no_telp']); ?></div>
                        </div>
                        <div class="info-item">
                            <div class="label">TANGGAL TERBIT</div>
                            <div class="value"><?= date('d M Y', strtotime($data['anggota']['tanggal_daftar'])); ?></div>
                        </div>
                        <div class="info-item full">
                            <div class="label">ALAMAT</div>
                            <div class="value"><?= htmlspecialchars($data['anggota']['alamat']); ?></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="footer-left">
                    <div class="validity-badge">
                        <i class="fas fa-shield-halved"></i>
                        VALID THRU: <?= date('d M Y', strtotime($data['anggota']['tanggal_daftar'] . ' +1 year')); ?>
                    </div>
                    <div class="legal-notice">
                        * Kartu ini adalah dokumen resmi digital yang sah sebagai identitas anggota Perpustakaan Digital. Harap tunjukkan kartu ini saat melakukan transaksi peminjaman.
                    </div>
                </div>
                <div class="authority-section">
                    <div class="official-seal">
                        OFFICIAL<br>DIGITAL CARD<br>VERIFIED
                    </div>
                    <div class="signature-line"></div>
                    <div class="signee-name">Drs. Budi Santoso, M.Si</div>
                    <div class="signee-rank">Kepala Perpustakaan</div>
                </div>
            </div>
        </div>
    </div>

    <div class="actions">
        <button onclick="downloadCard()" class="btn btn-primary">
            <i class="fas fa-print"></i> Simpan Cetak PDF
        </button>
        <a href="<?= BASEURL; ?>" class="btn btn-outline">
            <i class="fas fa-home"></i> Kembali ke Beranda
        </a>
    </div>

    <script>
        function downloadCard() {
            const element = document.getElementById('card-download');
            
            // Backup inline styles
            const originalShadow = element.style.boxShadow;
            const originalAnimation = element.style.animation;
            
            // Hide shadow and forcefully remove any CSS scaling from media queries during export
            element.style.boxShadow = 'none';
            element.style.transform = 'none';
            // CRITICAL: Disable animation so the cloned element doesn't start at opacity: 0
            element.style.animation = 'none';

            const opt = {
                margin:       [0, 0], 
                filename:     'kartu-anggota-<?= $data['anggota']['id_user']; ?>.pdf',
                image:        { type: 'jpeg', quality: 1.0 },
                html2canvas:  { scale: 3, useCORS: true, logging: false, backgroundColor: '#ffffff', scrollY: 0, scrollX: 0 }, 
                jsPDF:        { unit: 'px', format: [852, 522], orientation: 'landscape' } 
        };

            // Allow the browser a tiny moment to reflow the layout without the scale transform
            setTimeout(() => {
                html2pdf().set(opt).from(element).save().then(() => {
                    // Restore original inline styles (re-enables media queries)
                    element.style.boxShadow = originalShadow;
                    element.style.transform = '';
                    element.style.animation = originalAnimation;
                });
            }, 150);
        }
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['judul']; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <link rel="stylesheet" href="<?= BASEURL; ?>/public/css/card.css">
</head>
<body>

    <div class="success-header">
        <h1>KARTU ANGGOTA DIGITAL</h1>
        <p>Atas nama <?= htmlspecialchars($data['anggota']['nama']); ?></p>
    </div>

    <div class="card-wrapper" id="card-download">
        <div class="id-card">
            <!-- Header Shapes -->
            <div class="top-shape-light">
                <div class="top-shape-light-overlay"></div>
            </div>
            <div class="top-shape-dark">
                <div class="brand">
                    <div class="brand-icon">
                        <i class="fas fa-book-reader"></i>
                    </div>
                    <div class="brand-text">
                        <h2>E-PERPUS</h2>
                        <p>PERPUSTAKAAN KAPUAS</p>
                    </div>
                </div>
            </div>

            <div class="card-content">
                <!-- Photo Area -->
                <div class="photo-column">
                    <div class="photo-frame">
                        <?php 
                            $foto = $data['anggota']['foto'] ? BASEURL . '/public/img/anggota/' . $data['anggota']['foto'] : 'https://ui-avatars.com/api/?name=' . urlencode($data['anggota']['nama']) . '&background=random&size=300';
                        ?>
                        <img src="<?= $foto ?>" alt="Member Photo">
                    </div>
                    <div class="validity">
                        <div class="validity-label">BERLAKU SAMPAI:</div>
                        <div class="validity-date">SEUMUR HIDUP</div>
                    </div>
                </div>

                <!-- Info Area -->
                <div class="details-column">
                    <h1 class="card-title">KARTU ANGGOTA</h1>
                    
                    <table class="info-table">
                        <tr>
                            <td class="info-label">Nama:</td>
                            <td class="info-value"><?= htmlspecialchars($data['anggota']['nama']); ?></td>
                        </tr>
                        <tr>
                            <td class="info-label">Nomor:</td>
                            <td class="info-value"><?= htmlspecialchars($data['anggota']['no_telp']); ?></td>
                        </tr>
                        <tr>
                            <td class="info-label">Tgl Daftar:</td>
                            <td class="info-value"><?= date('d F Y', strtotime($data['anggota']['tanggal_daftar'])); ?></td>
                        </tr>
                        <tr>
                            <td class="info-label">Alamat:</td>
                            <td class="info-value" style="font-size: 1.2rem; line-height: 1.3;">
                                <?= htmlspecialchars((strlen($data['anggota']['alamat']) > 50) ? substr($data['anggota']['alamat'], 0, 50) . '...' : $data['anggota']['alamat']); ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>

            <!-- Footer Area -->
            <div class="card-footer">
                <div class="footer-dots"></div>
                <div class="signature-area">
                    <div class="signature-name">H. Suwarno Muriyat</div>
                    <div class="signature-title">Kepala Dispersip</div>
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
                margin:       10, 
                filename:     'kartu-anggota-<?= $data['anggota']['id_anggota']; ?>.pdf',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2, useCORS: true, logging: true, backgroundColor: '#ffffff', scrollY: 0, scrollX: 0 }, 
                jsPDF:        { unit: 'px', format: [820, 520], orientation: 'landscape' } 
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

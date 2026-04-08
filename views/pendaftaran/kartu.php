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
        :root {
            --primary: #0a3d91; /* Dark blue from reference */
            --secondary: #3c82f6; /* Light blue from reference */
            --bg-body: #f1f5f9;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg-body);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            margin: 0;
            padding: 2rem;
        }

        .success-header {
            text-align: center;
            margin-bottom: 3rem;
            animation: fadeInDown 0.8s ease;
        }

        .success-header h1 {
            color: #0f172a;
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }

        .success-header p {
            color: #64748b;
            font-size: 1.1rem;
        }

        /* Card Container - Matching Reference Scale (appx 800x500) */
        .card-wrapper {
            animation: fadeInUp 1s ease 0.3s both;
            margin-bottom: 3rem;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            border-radius: 8px; /* Slight rounding on outer edge */
            overflow: hidden;
            background: white;
        }

        .id-card {
            width: 800px;
            height: 500px;
            background-color: #ffffff;
            position: relative;
            overflow: hidden; /* To clip shapes */
            box-sizing: border-box;
            background-image: url('data:image/svg+xml;utf8,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><path d="M 0 0 L 100 0 L 100 100 L 0 100 Z" fill="none" stroke="%23f1f5f9" stroke-width="1"/></svg>');
            background-size: 50px 50px;
        }

        /* Top Header Shapes */
        .top-shape-dark {
            position: absolute;
            top: 0;
            left: 0;
            width: 55%;
            height: 120px;
            background-color: var(--primary);
            clip-path: polygon(0 0, 100% 0, 85% 100%, 0% 100%);
            z-index: 2;
            display: flex;
            align-items: center;
            padding-left: 40px;
            color: white;
        }

        .top-shape-light {
            position: absolute;
            top: 0;
            right: 0;
            width: 55%;
            height: 120px;
            background-color: var(--secondary);
            clip-path: polygon(15% 0, 100% 0, 100% 100%, 0% 100%);
            z-index: 1;
            /* Dotted pattern approximation */
            background-image: radial-gradient(white 2px, transparent 2px), radial-gradient(white 2px, transparent 2px);
            background-size: 20px 20px;
            background-position: 0 0, 10px 10px;
            background-repeat: repeat;
        }
        
        .top-shape-light-overlay {
            position: absolute;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, var(--secondary) 10%, rgba(60,130,246,0.3) 100%);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .brand-icon {
            font-size: 2.2rem;
            color: white;
        }

        .brand-text h2 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 800;
            line-height: 1.1;
        }
        
        .brand-text p {
            margin: 0;
            font-size: 1rem;
            font-weight: 600;
        }

        /* Content Area */
        .card-content {
            padding: 150px 40px 10px 40px;
            display: flex;
            gap: 40px;
            height: calc(100% - 130px);
        }

        /* Left Side: Photo Frame */
        .photo-column {
            width: 250px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .photo-frame {
            width: 220px;
            height: 280px;
            border-radius: 110px 110px 0 0;
            background-color: #e2e8f0;
            border: 10px solid var(--primary);
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .photo-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .validity {
            margin-top: 15px;
            text-align: center;
            color: var(--primary);
        }

        .validity-label {
            font-style: italic;
            font-size: 0.9rem;
            margin-bottom: 2px;
        }

        .validity-date {
            font-weight: 800;
            font-size: 1.1rem;
        }

        /* Right Side: Details */
        .details-column {
            flex: 1;
            padding-top: 10px;
        }

        .card-title {
            color: var(--primary);
            font-size: 2.8rem;
            font-weight: 800;
            margin: 0;
            letter-spacing: 1px;
            border-bottom: 4px solid var(--primary);
            padding-bottom: 5px;
            display: inline-block;
            margin-bottom: 25px;
            text-transform: uppercase;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 8px 0;
            font-size: 1.4rem;
        }

        .info-label {
            color: var(--primary);
            font-weight: 800;
            width: 180px;
            vertical-align: top;
        }

        .info-value {
            color: #1e40af;
            font-weight: 500;
        }

        /* Bottom Details */
        .card-footer {
            position: absolute;
            bottom: 30px;
            right: 40px;
            width: calc(100% - 330px);
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
        }

        .footer-dots {
            width: 60px;
            height: 20px;
            background-image: radial-gradient(var(--primary) 3px, transparent 3px);
            background-size: 15px 15px;
            opacity: 0.8;
            margin-left: 50px;
        }

        .signature-area {
            text-align: center;
            color: var(--primary);
        }

        .signature-name {
            font-size: 1.2rem;
            font-style: italic;
            margin-bottom: 2px;
        }

        .signature-title {
            font-size: 1.3rem;
            font-weight: 800;
            font-style: italic;
        }

        /* Actions */
        .actions {
            display: flex;
            gap: 1rem;
            animation: fadeInUp 1s ease 0.6s both;
        }

        .btn {
            padding: 0.8rem 1.5rem;
            border-radius: 12px;
            font-family: 'Inter', sans-serif;
            font-weight: 600;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s;
            cursor: pointer;
            border: none;
            font-size: 1rem;
        }

        .btn-primary {
            background: var(--secondary);
            color: white;
            box-shadow: 0 10px 20px rgba(60, 130, 246, 0.2);
        }

        .btn-primary:hover {
            background: var(--primary);
            transform: translateY(-2px);
        }

        .btn-outline {
            background: transparent;
            color: var(--primary);
            border: 2px solid var(--primary);
        }

        .btn-outline:hover {
            background: rgba(10, 61, 145, 0.05);
        }

        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Responsive handling for small screens to just scale the container */
        @media (max-width: 900px) {
            .card-wrapper {
                transform: scale(0.8);
                transform-origin: top center;
            }
        }
        @media (max-width: 700px) {
            .card-wrapper {
                transform: scale(0.6);
            }
        }
        @media (max-width: 500px) {
            .card-wrapper {
                transform: scale(0.45);
            }
            body { padding: 1rem; }
        }
    </style>
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
            // Hide shadow during export to prevent rendering artifacts
            const originalShadow = element.style.boxShadow;
            element.style.boxShadow = 'none';

            const opt = {
                margin:       [0.2, 0.2, 0.2, 0.2], // minimal margin
                filename:     'kartu-anggota-<?= $data['anggota']['id_anggota']; ?>.pdf',
                image:        { type: 'jpeg', quality: 1 },
                html2canvas:  { scale: 3, useCORS: true, backgroundColor: null }, // useCORS for the photo
                jsPDF:        { unit: 'px', format: [840, 540], orientation: 'landscape' } // perfectly scaled to dimensions
            };

            html2pdf().set(opt).from(element).save().then(() => {
                // Restore shadow
                element.style.boxShadow = originalShadow;
            });
        }
    </script>
</body>
</html>

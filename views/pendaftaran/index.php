<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['judul']; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700&family=Inter:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --bg: #f8fafc;
            --text-main: #0f172a;
            --text-muted: #64748b;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: var(--bg); color: var(--text-main); line-height: 1.6; }
        h1, h2, h3 { font-family: 'Inter', sans-serif; font-weight: 700; }
        
        .navbar {
            background: white; padding: 1rem 5%; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
            display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;
        }
        .navbar-brand { font-family: 'Inter', sans-serif; font-size: 1.5rem; font-weight: 800; color: var(--primary); text-decoration: none; }
        
        .container { max-width: 1200px; margin: 0 auto; padding: 0 2rem; display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; align-items: start; }
        
        .panel {
            background: white; border-radius: 20px; padding: 2.5rem;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
        }

        .panel-header { margin-bottom: 2rem; text-align: center; }
        .panel-header h2 { font-size: 2rem; margin-bottom: 0.5rem; }
        .panel-header p { color: var(--text-muted); }

        .form-group { margin-bottom: 1.5rem; }
        .form-group label { display: block; margin-bottom: 0.5rem; font-weight: 500; }
        .form-control {
            width: 100%; padding: 0.75rem 1rem; border: 1px solid #cbd5e1; border-radius: 8px;
            font-family: inherit; font-size: 1rem; transition: border-color 0.3s;
        }
        .form-control:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(37,99,235,0.1); }

        .camera-container {
            position: relative; width: 100%; aspect-ratio: 4/3; background: #000; border-radius: 12px; overflow: hidden; margin-bottom: 1.5rem;
            display: flex; justify-content: center; align-items: center;
        }
        #webcam { width: 100%; height: 100%; object-fit: cover; }
        #canvas { display: none; }
        #snapshot-preview { display: none; width: 100%; height: 100%; object-fit: cover; position: absolute; top: 0; left: 0; z-index: 10; }
        
        .camera-btn {
            position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%); z-index: 20;
            width: 60px; height: 60px; border-radius: 50%; background: white; border: 4px solid var(--primary);
            cursor: pointer; display: flex; justify-content: center; align-items: center; transition: transform 0.2s;
        }
        .camera-btn:hover { transform: translateX(-50%) scale(1.1); }
        .camera-btn i { color: var(--primary); font-size: 1.5rem; }

        .btn { display: inline-block; width: 100%; padding: 1rem; border-radius: 10px; font-weight: 600; font-family: 'Inter', sans-serif; cursor: pointer; text-align: center; border: none; font-size: 1.1rem; transition: all 0.3s; }
        .btn-primary { background: var(--primary); color: white; }
        .btn-primary:hover { background: var(--primary-dark); transform: translateY(-2px); box-shadow: 0 4px 12px rgba(37,99,235,0.3); }
        .btn-outline { background: transparent; color: var(--primary); border: 2px solid var(--primary); margin-top: 1rem;}
        .btn-outline:hover { background: var(--primary); color: white; }

        .loading-overlay {
            position: fixed; top:0; left:0; width: 100%; height: 100%; background: rgba(255,255,255,0.8); z-index: 1000; display: none; justify-content: center; align-items: center; flex-direction: column;
        }
        .spinner { width: 50px; height: 50px; border: 5px solid #f3f3f3; border-top: 5px solid var(--primary); border-radius: 50%; animation: spin 1s linear infinite; margin-bottom: 1rem; }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }

        @media (max-width: 992px) {
            .container { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <a href="<?= BASEURL; ?>" class="navbar-brand"><i class="fas fa-book-reader"></i> E-PERPUS</a>
        <a href="<?= BASEURL; ?>" style="color: var(--text-muted); text-decoration:none;"><i class="fas fa-arrow-left"></i> Kembali</a>
    </nav>

    <div class="container">
        <!-- Form Panel -->
        <div class="panel">
            <div class="panel-header">
                <h2>Biodata Diri</h2>
                <p>Isi data diri Anda dengan lengkap dan benar.</p>
            </div>
            <form id="registerForm">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" id="nama" class="form-control" required placeholder="Masukkan nama lengkap">
                </div>
                <div class="form-group">
                    <label>No. Telepon / WhatsApp</label>
                    <input type="text" id="no_telp" class="form-control" required placeholder="Contoh: 08123456789">
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" id="email" class="form-control" required placeholder="nama@email.com">
                </div>
                <div class="form-group">
                    <label>Alamat Lengkap</label>
                    <textarea id="alamat" class="form-control" rows="3" required placeholder="Masukkan alamat domisili"></textarea>
                </div>
            </form>
        </div>

        <!-- Camera Panel -->
        <div class="panel">
            <div class="panel-header">
                <h2>Verifikasi Foto</h2>
                <p>Ambil foto wajah untuk kartu perpustakaan digital Anda.</p>
            </div>
            
            <div class="camera-container">
                <video id="webcam" autoplay playsinline></video>
                <canvas id="canvas"></canvas>
                <img id="snapshot-preview" alt="Snapshot Preview">
                
                <button type="button" class="camera-btn" id="btn-snap" title="Ambil Foto">
                    <i class="fas fa-camera"></i>
                </button>
            </div>
            
            <button type="button" class="btn btn-outline" id="btn-retake" style="display:none; margin-bottom: 1.5rem;">
                <i class="fas fa-redo"></i> Ulangi Foto
            </button>

            <button type="button" class="btn btn-primary" id="btn-register">
                <i class="fas fa-user-plus"></i> Daftar Sekarang
            </button>
        </div>
    </div>

    <div class="loading-overlay" id="loading">
        <div class="spinner"></div>
        <h3>Memproses Pendaftaran...</h3>
    </div>

    <script>
        const video = document.getElementById('webcam');
        const canvas = document.getElementById('canvas');
        const snapBtn = document.getElementById('btn-snap');
        const retakeBtn = document.getElementById('btn-retake');
        const preview = document.getElementById('snapshot-preview');
        const registerBtn = document.getElementById('btn-register');
        const loading = document.getElementById('loading');
        
        let photoData = null;

        // Initialize webcam
        async function initWebcam() {
            if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                alert("Browser Anda tidak mendukung akses kamera. Pastikan Anda menggunakan koneksi aman (localhost atau HTTPS) dan telah mengizinkan akses kamera.");
                return;
            }
            try {
                const stream = await navigator.mediaDevices.getUserMedia({ video: true, audio: false });
                video.srcObject = stream;
            } catch (err) {
                console.error("Error accessing webcam: ", err);
                alert("Tidak dapat mengakses kamera. Tolong klik ikon gembok pada URL bar dan pastikan izin Kamera 'Dizinkan' (Allow).");
            }
        }

        initWebcam();

        // Take snapshot
        snapBtn.addEventListener('click', () => {
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            const context = canvas.getContext('2d');
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            
            photoData = canvas.toDataURL('image/png');
            preview.src = photoData;
            preview.style.display = 'block';
            
            snapBtn.style.display = 'none';
            retakeBtn.style.display = 'block';
        });

        // Retake snapshot
        retakeBtn.addEventListener('click', () => {
            preview.style.display = 'none';
            photoData = null;
            snapBtn.style.display = 'flex';
            retakeBtn.style.display = 'none';
        });

        // Submit registration
        registerBtn.addEventListener('click', async () => {
            const nama = document.getElementById('nama').value;
            const no_telp = document.getElementById('no_telp').value;
            const email = document.getElementById('email').value;
            const alamat = document.getElementById('alamat').value;

            if(!nama || !no_telp || !email || !alamat) {
                alert("Harap lengkapi semua biodata!");
                return;
            }

            if(!photoData) {
                alert("Harap ambil foto wajah Anda terlebih dahulu!");
                return;
            }

            loading.style.display = 'flex';

            const payload = {
                nama: nama,
                no_telp: no_telp,
                email: email,
                alamat: alamat,
                foto: photoData
            };

            try {
                const response = await fetch('<?= BASEURL; ?>/pendaftaran/simpan', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(payload)
                });

                const result = await response.json();
                
                if(result.status === 'success') {
                    // Redirect to member card page
                    window.location.href = '<?= BASEURL; ?>/pendaftaran/kartu/' + result.id;
                } else {
                    alert(result.message || "Terjadi kesalahan saat pendaftaran.");
                    loading.style.display = 'none';
                }
            } catch (err) {
                console.error(err);
                alert("Terjadi kesalahan koneksi server.");
                loading.style.display = 'none';
            }
        });
    </script>
</body>
</html>

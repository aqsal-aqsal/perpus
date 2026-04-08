<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['judul']; ?></title>
    <link rel="icon" type="image/png" href="<?= BASEURL; ?>/public/img/logo-kapuas.png">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --bg: #f8fafc;
            --text-main: #0f172a;
            --text-muted: #64748b;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--bg);
            color: var(--text-main);
            line-height: 1.6;
        }

        h1,
        h2,
        h3 {
            font-family: 'Inter', sans-serif;
            font-weight: 700;
        }

        .navbar {
            background: white;
            padding: 1rem 5%;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
        }

        .navbar-brand {
            font-family: 'Inter', sans-serif;
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--primary);
            text-decoration: none;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .panel {
            background: white;
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            display: none;
            /* Controlled via JS */
            animation: fadeIn 0.4s ease;
        }

        .panel.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .panel-header {
            margin-bottom: 2rem;
            text-align: center;
        }

        .panel-header h2 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .panel-header p {
            color: var(--text-muted);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }

        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-family: inherit;
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        /* Camera & Upload Options */
        .photo-options {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
            justify-content: center;
        }

        .option-btn {
            flex: 1;
            padding: 0.8rem;
            border-radius: 10px;
            border: 2px solid #cbd5e1;
            background: white;
            color: var(--text-muted);
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            transition: all 0.2s;
            font-size: 1rem;
        }

        .option-btn.active {
            border-color: var(--primary);
            background: #eff6ff;
            color: var(--primary);
        }

        /* Camera Box */
        .camera-container {
            position: relative;
            width: 100%;
            aspect-ratio: 4/3;
            background: #000;
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 1.5rem;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #webcam {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        #canvas {
            display: none;
        }

        #snapshot-preview {
            display: none;
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 10;
        }

        .camera-btn {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 20;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: white;
            border: 4px solid var(--primary);
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: transform 0.2s;
        }

        .camera-btn:hover {
            transform: translateX(-50%) scale(1.1);
        }

        .camera-btn i {
            color: var(--primary);
            font-size: 1.5rem;
        }

        /* Upload Box */
        .upload-container {
            position: relative;
            width: 100%;
            aspect-ratio: 4/3;
            background: #f8fafc;
            border: 2px dashed #cbd5e1;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            display: none;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            overflow: hidden;
        }

        .upload-container.active {
            display: flex;
        }

        .upload-container input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
            z-index: 20;
        }

        .upload-placeholder {
            text-align: center;
            color: var(--text-muted);
            z-index: 10;
            pointer-events: none;
        }

        .upload-placeholder i {
            font-size: 3rem;
            margin-bottom: 1rem;
            color: #cbd5e1;
        }

        #upload-preview {
            display: none;
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
            z-index: 15;
        }

        .btn {
            display: inline-block;
            width: 100%;
            padding: 1rem;
            border-radius: 10px;
            font-weight: 600;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            text-align: center;
            border: none;
            font-size: 1.1rem;
            transition: all 0.3s;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
        }

        .btn-outline {
            background: white;
            color: var(--text-muted);
            border: 1px solid #cbd5e1;
            font-weight: 500;
        }

        .btn-outline:hover {
            background: #f8fafc;
            color: var(--text-main);
        }

        .btn-group {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.8);
            z-index: 1000;
            display: none;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .spinner {
            width: 50px;
            height: 50px;
            border: 5px solid #f3f3f3;
            border-top: 5px solid var(--primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-bottom: 1rem;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Stepper indicator */
        .stepper {
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;
            gap: 1rem;
            align-items: center;
        }

        .step {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #cbd5e1;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 600;
        }

        .step.active {
            background: var(--primary);
        }

        .step-line {
            width: 50px;
            height: 2px;
            background: #cbd5e1;
        }

        .step-line.active {
            background: var(--primary);
        }

        @media (max-width: 600px) {
            .container {
                padding: 0 1rem;
            }

            .panel {
                padding: 1.5rem;
            }
        }
    </style>
    <link rel="icon" href="<?= BASEURL; ?>/public/img/logo-kapuas.png" type="image/png">
</head>

<body>
    <nav class="navbar">
        <a href="<?= BASEURL; ?>" class="navbar-brand">
            <img src="<?= BASEURL; ?>/public/img/logo-kapuas.png" alt="Logo" style="height: 30px; vertical-align: middle; margin-right: 10px;"> E-PERPUS
        </a>
        <a href="<?= BASEURL; ?>" style="color: var(--text-muted); text-decoration:none;"><i class="fas fa-arrow-left"></i> Kembali</a>
    </nav>

    <div class="container">

        <div class="stepper">
            <div class="step active" id="indicator-1">1</div>
            <div class="step-line" id="line-1"></div>
            <div class="step" id="indicator-2">2</div>
        </div>

        <!-- Step 1: Form Panel -->
        <div class="panel active" id="step-1">
            <div class="panel-header">
                <h2>Biodata Diri</h2>
                <p>Isi data diri Anda terlebih dahulu.</p>
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
                    <textarea id="alamat" class="form-control" rows="3" required
                        placeholder="Masukkan alamat domisili"></textarea>
                </div>
                <button type="button" class="btn btn-primary" id="btn-next">
                    Lanjutkan<i class="fas fa-arrow-right ml-2"></i>
                </button>
            </form>
        </div>

        <!-- Step 2: Camera/Upload Panel -->
        <div class="panel" id="step-2">
            <div class="panel-header">
                <h2>Verifikasi Wajah</h2>
                <p>Tambahkan foto untuk kartu perpustakaan digital Anda.</p>
            </div>

            <div class="photo-options">
                <button type="button" class="option-btn active" id="opt-camera"><i class="fas fa-camera mr-2"></i>
                    Gunakan Kamera</button>
                <button type="button" class="option-btn" id="opt-upload"><i class="fas fa-upload mr-2"></i> Unggah
                    Foto</button>
            </div>

            <!-- Webcam Area -->
            <div class="camera-container" id="camera-area">
                <video id="webcam" autoplay playsinline></video>
                <canvas id="canvas"></canvas>
                <img id="snapshot-preview" alt="Snapshot Preview">

                <button type="button" class="camera-btn" id="btn-snap" title="Ambil Foto">
                    <i class="fas fa-camera"></i>
                </button>
            </div>

            <!-- Upload Area -->
            <div class="upload-container" id="upload-area">
                <div class="upload-placeholder" id="upload-placeholder">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <p>Klik di sini untuk memilih foto<br><small>(Format: JPG, PNG, max 2MB)</small></p>
                </div>
                <input type="file" id="file-input" accept="image/*">
                <img id="upload-preview" alt="Upload Preview">
            </div>

            <button type="button" class="btn btn-outline" id="btn-retake"
                style="display:none; margin-bottom: 1rem; width: 100%;">
                <i class="fas fa-redo"></i> Ulangi Foto
            </button>

            <div class="btn-group">
                <button type="button" class="btn btn-outline" id="btn-prev">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </button>
                <button type="button" class="btn btn-primary" id="btn-register">
                    <i class="fas fa-user-plus"></i> Daftar Sekarang
                </button>
            </div>
        </div>
    </div>

    <div class="loading-overlay" id="loading">
        <div class="spinner"></div>
        <h3>Memproses Pendaftaran...</h3>
    </div>

    <script>
        // DOM Elements
        const step1 = document.getElementById('step-1');
        const step2 = document.getElementById('step-2');
        const btnNext = document.getElementById('btn-next');
        const btnPrev = document.getElementById('btn-prev');
        const ind1 = document.getElementById('indicator-1');
        const line1 = document.getElementById('line-1');
        const ind2 = document.getElementById('indicator-2');

        const optCamera = document.getElementById('opt-camera');
        const optUpload = document.getElementById('opt-upload');
        const cameraArea = document.getElementById('camera-area');
        const uploadArea = document.getElementById('upload-area');

        const video = document.getElementById('webcam');
        const canvas = document.getElementById('canvas');
        const snapBtn = document.getElementById('btn-snap');
        const retakeBtn = document.getElementById('btn-retake');
        const snapshotPreview = document.getElementById('snapshot-preview');

        const fileInput = document.getElementById('file-input');
        const uploadPreview = document.getElementById('upload-preview');
        const uploadPlaceholder = document.getElementById('upload-placeholder');

        const registerBtn = document.getElementById('btn-register');
        const loading = document.getElementById('loading');

        let photoData = null;
        let streamActive = null;
        let currentMode = 'camera'; // camera or upload

        // Navigation Step 1 to 2
        btnNext.addEventListener('click', () => {
            const nama = document.getElementById('nama').value.trim();
            const no_telp = document.getElementById('no_telp').value.trim();
            const email = document.getElementById('email').value.trim();
            const alamat = document.getElementById('alamat').value.trim();

            if (!nama || !no_telp || !email || !alamat) {
                alert("Harap lengkapi semua biodata terlebih dahulu!");
                return;
            }

            step1.classList.remove('active');
            step2.classList.add('active');
            line1.classList.add('active');
            ind2.classList.add('active');

            if (currentMode === 'camera' && !photoData) {
                initWebcam();
            }
        });

        // Navigation Step 2 to 1
        btnPrev.addEventListener('click', () => {
            step2.classList.remove('active');
            step1.classList.add('active');
            line1.classList.remove('active');
            ind2.classList.remove('active');
            stopWebcam();
        });

        // Toggle Option
        optCamera.addEventListener('click', () => {
            currentMode = 'camera';
            optCamera.classList.add('active');
            optUpload.classList.remove('active');
            cameraArea.style.display = 'flex';
            uploadArea.classList.remove('active');

            photoData = null;
            resetCameraView();
            resetUploadView();

            initWebcam();
        });

        optUpload.addEventListener('click', () => {
            currentMode = 'upload';
            optUpload.classList.add('active');
            optCamera.classList.remove('active');
            uploadArea.classList.add('active');
            cameraArea.style.display = 'none';

            photoData = null;
            resetUploadView();
            resetCameraView();

            stopWebcam();
        });

        // Webcam logic
        async function initWebcam() {
            if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
                alert("Browser Anda tidak mendukung akses kamera. Pastikan menggunakan HTTPS atau localhost.");
                return;
            }
            try {
                streamActive = await navigator.mediaDevices.getUserMedia({ video: true, audio: false });
                video.srcObject = streamActive;
            } catch (err) {
                console.error("Error accessing webcam: ", err);
                alert("Tidak dapat mengakses kamera. Tolong izinkan akses kamera di pengaturan browser.");
            }
        }

        function stopWebcam() {
            if (streamActive) {
                streamActive.getTracks().forEach(track => track.stop());
                streamActive = null;
            }
        }

        // Take snapshot
        snapBtn.addEventListener('click', () => {
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            const context = canvas.getContext('2d');
            context.drawImage(video, 0, 0, canvas.width, canvas.height);

            photoData = canvas.toDataURL('image/png');
            snapshotPreview.src = photoData;
            snapshotPreview.style.display = 'block';

            snapBtn.style.display = 'none';
            retakeBtn.style.display = 'block';
        });

        // Retake Camera
        function resetCameraView() {
            snapshotPreview.style.display = 'none';
            snapBtn.style.display = 'flex';
            retakeBtn.style.display = 'none';
        }

        retakeBtn.addEventListener('click', () => {
            photoData = null;
            if (currentMode === 'camera') {
                resetCameraView();
            } else if (currentMode === 'upload') {
                resetUploadView();
            }
        });

        // Upload Logic
        fileInput.addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (!file) return;

            const reader = new FileReader();
            reader.onload = function (event) {
                photoData = event.target.result;
                uploadPreview.src = photoData;
                uploadPreview.style.display = 'block';
                uploadPlaceholder.style.display = 'none';
                retakeBtn.style.display = 'block';
            };
            reader.readAsDataURL(file);
        });

        function resetUploadView() {
            uploadPreview.style.display = 'none';
            uploadPlaceholder.style.display = 'block';
            fileInput.value = '';
            retakeBtn.style.display = 'none';
        }

        // Submit registration
        registerBtn.addEventListener('click', async () => {
            const nama = document.getElementById('nama').value;
            const no_telp = document.getElementById('no_telp').value;
            const email = document.getElementById('email').value;
            const alamat = document.getElementById('alamat').value;

            if (!photoData) {
                alert("Harap ambil foto wajah atau unggah foto Anda terlebih dahulu!");
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

                if (result.status === 'success') {
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
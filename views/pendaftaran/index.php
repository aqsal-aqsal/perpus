<?php $this->view('templates/header_auth', $data); ?>

<div class="w-full max-w-2xl p-4 my-8">
    <div class="bg-white shadow-2xl rounded-3xl mx-auto p-8 relative overflow-hidden ring-1 ring-gray-900/5 min-h-[600px] flex flex-col">
        <!-- Decorative blobs -->
        <div class="absolute -top-24 -right-24 w-64 h-64 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob"></div>
        <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-indigo-500 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob animation-delay-2000"></div>
        
        <div class="text-center mb-10 relative z-10 pt-4">
            <h1 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600 mb-2">Pendaftaran Anggota</h1>
            <p class="text-slate-500 text-sm font-medium">Lengkapi biodata KTP untuk akses penuh layanan E-Perpus</p>
        </div>

        <!-- Stepper -->
        <div class="relative z-10 mb-10">
            <div class="flex items-center justify-center gap-4">
                <div id="indicator-1" class="w-10 h-10 rounded-2xl bg-blue-600 text-white flex items-center justify-center font-bold shadow-lg shadow-blue-500/30 transition-all duration-300">1</div>
                <div id="line-1" class="w-16 h-1 bg-slate-100 rounded-full overflow-hidden">
                    <div id="line-1-progress" class="w-0 h-full bg-gradient-to-r from-blue-500 to-indigo-600 transition-all duration-500"></div>
                </div>
                <div id="indicator-2" class="w-10 h-10 rounded-2xl bg-slate-100 text-slate-400 flex items-center justify-center font-bold transition-all duration-300">2</div>
            </div>
            <div class="flex justify-center gap-16 mt-2">
                <span class="text-[10px] font-bold uppercase tracking-widest text-blue-600 ml-2">Biodata</span>
                <span class="text-[10px] font-bold uppercase tracking-widest text-slate-400">Foto KTP</span>
            </div>
        </div>

        <!-- Step 1: Form Panel -->
        <div class="flex-grow flex flex-col relative z-10 transition-all duration-500" id="step-1">
            <form id="registerForm" class="space-y-6">
                <!-- Group: Identitas Utama -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-slate-700 text-sm font-bold ml-1">NIK (Nomor Induk Kependudukan)</label>
                        <div class="relative group">
                            <i class="ph ph-identification-card absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-500 transition-colors"></i>
                            <input type="text" id="nik" class="w-full pl-11 pr-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100 outline-none transition-all text-slate-700" required placeholder="16 digit NIK" maxlength="16">
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-slate-700 text-sm font-bold ml-1">Nama Lengkap</label>
                        <div class="relative group">
                            <i class="ph ph-user absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-500 transition-colors"></i>
                            <input type="text" id="nama" class="w-full pl-11 pr-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100 outline-none transition-all text-slate-700" required placeholder="Sesuai KTP">
                        </div>
                    </div>
                </div>

                <!-- Group: Kelahiran -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-slate-700 text-sm font-bold ml-1">Tempat Lahir</label>
                        <input type="text" id="tempat_lahir" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100 outline-none transition-all text-slate-700" required placeholder="Kabupaten/Kota">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-slate-700 text-sm font-bold ml-1">Tanggal Lahir</label>
                        <input type="date" id="tanggal_lahir" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100 outline-none transition-all text-slate-700" required>
                    </div>
                </div>

                <!-- Group: Profil -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-slate-700 text-sm font-bold ml-1">Jenis Kelamin</label>
                        <select id="jenis_kelamin" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100 outline-none transition-all text-slate-700 appearance-none cursor-pointer" required>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-slate-700 text-sm font-bold ml-1">Agama</label>
                        <select id="agama" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100 outline-none transition-all text-slate-700 appearance-none cursor-pointer" required>
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Katolik">Katolik</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Budha">Budha</option>
                            <option value="Khonghucu">Khonghucu</option>
                        </select>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="block text-slate-700 text-sm font-bold ml-1">Alamat Lengkap</label>
                    <textarea id="alamat" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100 outline-none transition-all text-slate-700 resize-none" rows="2" required placeholder="Alamat sesuai KTP"></textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-2">
                        <label class="block text-slate-700 text-sm font-bold ml-1">Pekerjaan</label>
                        <input type="text" id="pekerjaan" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100 outline-none transition-all text-slate-700" required placeholder="Contoh: Pelajar/Mahasiswa">
                    </div>
                    <div class="space-y-2">
                        <label class="block text-slate-700 text-sm font-bold ml-1">No. Telp / WhatsApp</label>
                        <div class="relative group">
                            <i class="ph ph-whatsapp-logo absolute left-4 top-1/2 -translate-y-1/2 text-emerald-500 transition-colors"></i>
                            <input type="text" id="no_telp" class="w-full pl-11 pr-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100 outline-none transition-all text-slate-700" required placeholder="08123xxxx">
                        </div>
                    </div>
                </div>

                <div class="pt-4 border-t border-slate-100">
                    <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest mb-4">Pengaturan Akun</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="block text-slate-700 text-sm font-bold ml-1">Username</label>
                            <input type="text" id="username" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100 outline-none transition-all text-slate-700" required placeholder="Untuk login">
                        </div>
                        <div class="space-y-2">
                            <label class="block text-slate-700 text-sm font-bold ml-1">Password</label>
                            <input type="password" id="password" class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-100 outline-none transition-all text-slate-700" required placeholder="Min. 6 karakter">
                        </div>
                    </div>
                </div>

                <button type="button" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-4 px-4 rounded-xl shadow-xl shadow-blue-500/30 focus:outline-none transition-all duration-300 transform hover:-translate-y-1 flex items-center justify-center gap-2 group mt-8" id="btn-next">
                    Lanjutkan ke Foto
                    <i class="ph ph-arrow-right font-bold transition-transform group-hover:translate-x-1"></i>
                </button>
            </form>
        </div>

        <!-- Step 2: Camera/Upload Panel -->
        <div class="hidden flex-grow flex flex-col relative z-10 animate-fade-in" id="step-2">
            <div class="text-center mb-8">
                <p class="text-slate-500 text-sm">Ambil foto KTP Anda melalui kamera atau unggah file secara manual.</p>
            </div>

            <div class="flex p-1 bg-slate-100 rounded-2xl mb-8">
                <button type="button" class="flex-1 py-3 px-4 rounded-[14px] text-sm font-bold transition-all duration-300 bg-white text-blue-600 shadow-sm flex items-center justify-center gap-2" id="opt-camera">
                    <i class="ph ph-camera"></i> Gunakan Kamera
                </button>
                <button type="button" class="flex-1 py-3 px-4 rounded-[14px] text-sm font-bold transition-all duration-300 text-slate-500 hover:text-slate-700 flex items-center justify-center gap-2" id="opt-upload">
                    <i class="ph ph-upload-simple"></i> Unggah File
                </button>
            </div>

            <!-- Webcam Area -->
            <div class="relative w-full aspect-[4/3] bg-slate-900 rounded-3xl overflow-hidden shadow-2xl group border-4 border-white" id="camera-area">
                <video id="webcam" autoplay playsinline class="w-full h-full object-cover"></video>
                <canvas id="canvas" class="hidden"></canvas>
                <img id="snapshot-preview" alt="Snapshot Preview" class="hidden absolute inset-0 w-full h-full object-cover z-10">

                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent pointer-events-none opacity-0 group-hover:opacity-100 transition-opacity"></div>
                
                <button type="button" class="absolute bottom-6 left-1/2 -translate-x-1/2 w-16 h-16 rounded-full bg-white text-blue-600 flex items-center justify-center shadow-2xl transform transition-all active:scale-90 hover:scale-110 z-20" id="btn-snap">
                    <i class="ph ph-camera text-2xl font-bold"></i>
                </button>
            </div>

            <!-- Upload Area -->
            <div class="hidden relative w-full aspect-[4/3] bg-slate-50 rounded-3xl overflow-hidden border-2 border-dashed border-slate-300 flex flex-col items-center justify-center transition-all hover:bg-slate-100 hover:border-blue-400 group cursor-pointer" id="upload-area">
                <div class="text-center" id="upload-placeholder">
                    <div class="w-20 h-20 rounded-3xl bg-blue-50 text-blue-500 flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform">
                        <i class="ph-fill ph-cloud-arrow-up text-4xl"></i>
                    </div>
                    <p class="font-bold text-slate-700">Pilih Foto KTP</p>
                    <p class="text-xs text-slate-400 mt-1">Format: JPG, PNG, Max 2MB</p>
                </div>
                <input type="file" id="file-input" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer">
                <img id="upload-preview" alt="Upload Preview" class="hidden absolute inset-0 w-full h-full object-cover">
            </div>

            <!-- Retake Button -->
            <button type="button" class="hidden w-full mt-6 py-3 text-slate-500 hover:text-red-500 font-bold flex items-center justify-center gap-2 transition-colors" id="btn-retake">
                <i class="ph ph-arrow-counter-clockwise"></i> Ambil Ulang Foto
            </button>

            <div class="mt-auto pt-8 flex gap-4">
                <button type="button" class="flex-1 py-4 px-4 rounded-xl border border-slate-200 text-slate-500 font-bold hover:bg-slate-50 transition-all flex items-center justify-center gap-2" id="btn-prev">
                    <i class="ph ph-arrow-left"></i> Kembali
                </button>
                <button type="button" class="flex-[2] py-4 px-4 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold shadow-xl shadow-blue-500/30 hover:opacity-90 transition-all flex items-center justify-center gap-2" id="btn-register">
                    Selesaikan Pendaftaran <i class="ph ph-user-plus font-bold"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Back Link -->
    <div class="mt-8 text-center">
        <a href="<?= BASEURL; ?>" class="text-slate-400 hover:text-blue-600 text-sm font-medium transition-all duration-200 flex items-center justify-center gap-2 group">
            <i class="ph ph-arrow-left transition-transform duration-200 group-hover:-translate-x-1"></i>
            Kembali ke Beranda
        </a>
    </div>
</div>

<!-- Loading Overlay -->
<div class="fixed inset-0 z-[100] hidden items-center justify-center" id="loading">
    <div class="absolute inset-0 bg-white/80 backdrop-blur-md"></div>
    <div class="relative z-10 flex flex-col items-center">
        <div class="w-16 h-16 border-4 border-blue-50 border-t-blue-600 rounded-full animate-spin"></div>
        <h3 class="mt-6 font-bold text-slate-800 text-lg">Memproses Pendaftaran...</h3>
        <p class="text-slate-500 text-sm">Mohon tunggu sebentar</p>
    </div>
</div>

<style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in { animation: fade-in 0.4s ease-out forwards; }
    
    @keyframes blob {
        0% { transform: translate(0px, 0px) scale(1); }
        33% { transform: translate(30px, -50px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
        100% { transform: translate(0px, 0px) scale(1); }
    }
    .animate-blob { animation: blob 7s infinite; }
    .animation-delay-2000 { animation-delay: 2s; }

    /* Hide default radio circle */
    select {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
        background-position: right 1rem center;
        background-repeat: no-repeat;
        background-size: 1.5em 1.5em;
    }
</style>

<script>
    // DOM Elements
    const step1 = document.getElementById('step-1');
    const step2 = document.getElementById('step-2');
    const btnNext = document.getElementById('btn-next');
    const btnPrev = document.getElementById('btn-prev');
    const ind1 = document.getElementById('indicator-1');
    const ind2 = document.getElementById('indicator-2');
    const progressLine = document.getElementById('line-1-progress');

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
    let currentMode = 'camera';

    // Navigation Step 1 to 2
    btnNext.addEventListener('click', () => {
        const requiredInputs = ['nik', 'nama', 'tempat_lahir', 'tanggal_lahir', 'alamat', 'no_telp', 'username', 'password'];
        let isValid = true;
        
        requiredInputs.forEach(id => {
            const input = document.getElementById(id);
            if (!input.value.trim()) {
                input.classList.add('border-red-500', 'bg-red-50');
                isValid = false;
            } else {
                input.classList.remove('border-red-500', 'bg-red-50');
            }
        });

        if (!isValid) {
            return alert("Harap lengkapi semua data identitas dan akun.");
        }

        const nik = document.getElementById('nik').value.trim();
        if (nik.length !== 16) {
            return alert("NIK harus berjumlah 16 digit!");
        }

        // Transition to Step 2
        step1.classList.add('hidden');
        step2.classList.remove('hidden');
        
        // Update Stepper UI
        ind1.classList.remove('bg-blue-600', 'shadow-blue-500/30');
        ind1.classList.add('bg-emerald-500', 'shadow-emerald-500/30');
        ind1.innerHTML = '<i class="ph ph-check text-xl"></i>';
        
        progressLine.classList.remove('w-0');
        progressLine.classList.add('w-full');
        
        ind2.classList.remove('bg-slate-100', 'text-slate-400');
        ind2.classList.add('bg-blue-600', 'text-white', 'shadow-lg', 'shadow-blue-500/30');

        if (currentMode === 'camera' && !photoData) {
            initWebcam();
        }
    });

    // Navigation Step 2 to 1
    btnPrev.addEventListener('click', () => {
        step2.classList.add('hidden');
        step1.classList.remove('hidden');
        
        // Reset Stepper UI
        ind1.classList.add('bg-blue-600', 'shadow-blue-500/30');
        ind1.classList.remove('bg-emerald-500', 'shadow-emerald-500/30');
        ind1.innerHTML = '1';
        
        progressLine.classList.add('w-0');
        progressLine.classList.remove('w-full');
        
        ind2.classList.add('bg-slate-100', 'text-slate-400');
        ind2.classList.remove('bg-blue-600', 'text-white', 'shadow-lg', 'shadow-blue-500/30');
        
        stopWebcam();
    });

    // Toggle Modes
    optCamera.addEventListener('click', () => {
        currentMode = 'camera';
        toggleModeUI(optCamera, optUpload, cameraArea, uploadArea);
        initWebcam();
    });

    optUpload.addEventListener('click', () => {
        currentMode = 'upload';
        toggleModeUI(optUpload, optCamera, uploadArea, cameraArea);
        stopWebcam();
    });

    function toggleModeUI(activeBtn, inactiveBtn, activeArea, inactiveArea) {
        activeBtn.classList.add('bg-white', 'text-blue-600', 'shadow-sm');
        activeBtn.classList.remove('text-slate-500');
        inactiveBtn.classList.remove('bg-white', 'text-blue-600', 'shadow-sm');
        inactiveBtn.classList.add('text-slate-500');
        
        activeArea.classList.remove('hidden');
        inactiveArea.classList.add('hidden');
        
        photoData = null;
        resetCameraView();
        resetUploadView();
    }

    // Webcam Logic
    async function initWebcam() {
        if (!navigator.mediaDevices?.getUserMedia) {
            return alert("Kamera tidak didukung di browser ini.");
        }
        try {
            streamActive = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'user' }, audio: false });
            video.srcObject = streamActive;
        } catch (err) {
            alert("Gagal mengakses kamera. Pastikan izin kamera telah diberikan.");
        }
    }

    function stopWebcam() {
        if (streamActive) {
            streamActive.getTracks().forEach(track => track.stop());
            streamActive = null;
        }
    }

    // Capture Snapshot
    snapBtn.addEventListener('click', () => {
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        canvas.getContext('2d').drawImage(video, 0, 0);
        
        photoData = canvas.toDataURL('image/png');
        snapshotPreview.src = photoData;
        snapshotPreview.classList.remove('hidden');
        snapBtn.classList.add('hidden');
        retakeBtn.classList.remove('hidden');
    });

    // File Upload Logic
    fileInput.addEventListener('change', (e) => {
        const file = e.target.files[0];
        if (!file) return;
        
        const reader = new FileReader();
        reader.onload = (ev) => {
            photoData = ev.target.result;
            uploadPreview.src = photoData;
            uploadPreview.classList.remove('hidden');
            uploadPlaceholder.classList.add('hidden');
            retakeBtn.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    });

    retakeBtn.addEventListener('click', () => {
        photoData = null;
        resetCameraView();
        resetUploadView();
    });

    function resetCameraView() {
        snapshotPreview.classList.add('hidden');
        snapBtn.classList.remove('hidden');
        retakeBtn.classList.add('hidden');
    }

    function resetUploadView() {
        uploadPreview.classList.add('hidden');
        uploadPlaceholder.classList.remove('hidden');
        fileInput.value = '';
        retakeBtn.classList.add('hidden');
    }

    // Submit Action
    registerBtn.addEventListener('click', async () => {
        if (!photoData) {
            return alert("Harap ambil atau unggah foto KTP Anda.");
        }

        loading.classList.remove('hidden');
        loading.classList.add('flex');

        const payload = {
            nik: document.getElementById('nik').value,
            nama: document.getElementById('nama').value,
            tempat_lahir: document.getElementById('tempat_lahir').value,
            tanggal_lahir: document.getElementById('tanggal_lahir').value,
            jenis_kelamin: document.getElementById('jenis_kelamin').value,
            agama: document.getElementById('agama').value,
            alamat: document.getElementById('alamat').value,
            status_perkawinan: 'Belum Kawin', // Default from original code flow
            pekerjaan: document.getElementById('pekerjaan').value,
            kewarganegaraan: 'WNI',
            no_telp: document.getElementById('no_telp').value,
            username: document.getElementById('username').value,
            password: document.getElementById('password').value,
            foto: photoData
        };

        try {
            const resp = await fetch('<?= BASEURL; ?>/pendaftaran/simpan', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(payload)
            });
            const res = await resp.json();
            
            if (res.status === 'success') {
                window.location.href = '<?= BASEURL; ?>/pendaftaran/kartu/' + res.id;
            } else {
                alert(res.message || "Gagal mendaftar.");
                loading.classList.add('hidden');
                loading.classList.remove('flex');
            }
        } catch (err) {
            alert("Kesalahan koneksi.");
            loading.classList.add('hidden');
            loading.classList.remove('flex');
        }
    });
</script>

<?php $this->view('templates/footer_auth'); ?>
<?php
class Pendaftaran extends Controller {
    public function index() {
        $data['judul'] = 'Pendaftaran Anggota | E-PERPUS';
        $this->view('pendaftaran/index', $data);
    }

    public function simpan() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $input = json_decode(file_get_contents('php://input'), true);

            if (!$input) {
                echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
                return;
            }

            // Extract KTP Fields
            $data = [
                'nik' => htmlspecialchars($input['nik']),
                'nama' => htmlspecialchars($input['nama']),
                'tempat_lahir' => htmlspecialchars($input['tempat_lahir']),
                'tanggal_lahir' => htmlspecialchars($input['tanggal_lahir']),
                'jenis_kelamin' => htmlspecialchars($input['jenis_kelamin']),
                'agama' => htmlspecialchars($input['agama']),
                'alamat' => htmlspecialchars($input['alamat']),
                'status_perkawinan' => htmlspecialchars($input['status_perkawinan']),
                'pekerjaan' => htmlspecialchars($input['pekerjaan']),
                'kewarganegaraan' => htmlspecialchars($input['kewarganegaraan']),
                'no_telp' => htmlspecialchars($input['no_telp']),
                'username' => htmlspecialchars($input['username']),
                'password' => $input['password'],
                'foto' => 'default_ktp.png'
            ];
            
            // Process the base64 image (KTP Photo)
            if (!empty($input['foto'])) {
                $fotoBase64 = $input['foto'];
                $image_parts = explode(";base64,", $fotoBase64);
                if (count($image_parts) == 2) {
                    $image_base64 = base64_decode($image_parts[1]);
                    $fileName = 'ktp_' . $data['nik'] . '_' . time() . '.png';
                    $fileDir = $_SERVER['DOCUMENT_ROOT'] . '/perpus/public/img/ktp/';
                    
                    if (!is_dir($fileDir)) {
                        mkdir($fileDir, 0777, true);
                    }
                    
                    if(file_put_contents($fileDir . $fileName, $image_base64)) {
                        $data['foto'] = $fileName;
                    }
                }
            }
            
            $anggotaModel = $this->model('Anggota_model');
            if ($anggotaModel->daftarAnggotaBaru($data) > 0) {
                // Get the ID to allow downloading/viewing card if needed
                $this->db = new Database;
                $this->db->query("SELECT id_user FROM users WHERE username = :un");
                $this->db->bind('un', $data['username']);
                $user = $this->db->single();

                echo json_encode([
                    'status' => 'success', 
                    'message' => 'Pendaftaran berhasil!',
                    'id' => $user['id_user']
                ]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal mendaftar. Kemungkinan NIK atau Username sudah ada.']);
            }
        }
    }

    public function kartu($id) {
        $data['judul'] = 'Kartu Anggota | E-PERPUS';
        $data['anggota'] = $this->model('Anggota_model')->getAnggotaById($id);

        if (!$data['anggota']) {
            // Handle error, redirect home or show not found
            header('Location: ' . BASEURL);
            exit;
        }

        $this->view('pendaftaran/kartu', $data);
    }
}

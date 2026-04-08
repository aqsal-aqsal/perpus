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

            $nama = htmlspecialchars($input['nama']);
            $alamat = htmlspecialchars($input['alamat']);
            $no_telp = htmlspecialchars($input['no_telp']);
            $email = htmlspecialchars($input['email']);
            $fotoBase64 = $input['foto']; // base64 encoded image string
            
            // Process the base64 image
            $image_parts = explode(";base64,", $fotoBase64);
            if (count($image_parts) == 2) {
                $image_type_aux = explode("image/", $image_parts[0]);
                $image_type = $image_type_aux[1];
                $image_base64 = base64_decode($image_parts[1]);
                
                $fileName = uniqid() . '.png'; // Store as PNG since canvas exports as PNG
                $fileDir = $_SERVER['DOCUMENT_ROOT'] . '/perpus/public/img/anggota/';
                
                // Ensure directory exists (we created it earlier but good to have)
                if (!is_dir($fileDir)) {
                    mkdir($fileDir, 0777, true);
                }
                
                $fileLocation = $fileDir . $fileName;
                
                if(file_put_contents($fileLocation, $image_base64)) {
                    $dataAnggota = [
                        'nama' => $nama,
                        'alamat' => $alamat,
                        'no_telp' => $no_telp,
                        'email' => $email,
                        'tanggal_daftar' => date('Y-m-d'),
                        'foto' => $fileName
                    ];
                    
                    $anggotaModel = $this->model('Anggota_model');
                    $result = $anggotaModel->daftarAnggotaBaru($dataAnggota);
                    
                    if ($result > 0) {
                        // Retrieve the last inserted ID to show the card
                        // Since PDO might not reliably return it without a specific query, let's fetch it by email and descending id
                        $lastAnggota = $anggotaModel->getLastAnggotaByEmail($email);
                        $id_anggota = $lastAnggota['id_anggota'];
                        
                        echo json_encode([
                            'status' => 'success', 
                            'message' => 'Pendaftaran berhasil!',
                            'id' => $id_anggota
                        ]);
                        return;
                    } else {
                        echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan ke database']);
                        return;
                    }
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan foto']);
                    return;
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Format foto tidak valid']);
                return;
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

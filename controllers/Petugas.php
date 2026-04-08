<?php

class Petugas extends Controller {
    public function __construct()
    {
        // Harus login dulu
        if (!isset($_SESSION['user_ses'])) {
            header('Location: ' . BASEURL . '/auth');
            exit;
        }

        // Cek jika petugas bukan level 'admin', maka tendang balik (Opsional proteksi)
        if ($_SESSION['user_ses']['level'] !== 'admin') {
            header('Location: ' . BASEURL . '/dashboard');
            exit;
        }
    }

    public function index()
    {
        $data['judul'] = 'Manajemen Petugas | E-Perpus';
        $data['user'] = $_SESSION['user_ses'];
        $data['petugas'] = $this->model('Petugas_model')->getAllPetugas();
        
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('petugas/index', $data);
        $this->view('templates/footer');
    }

    public function tambah()
    {
        if ($this->model('Petugas_model')->tambahDataPetugas($_POST) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
        }
        header('Location: ' . BASEURL . '/petugas');
        exit;
    }

    public function edit()
    {
        if ($this->model('Petugas_model')->ubahDataPetugas($_POST) > 0) {
            Flasher::setFlash('berhasil', 'diubah', 'success');
        } else {
            Flasher::setFlash('gagal', 'diubah', 'danger');
            // Jika rowCount == 0 tapi tidak ada error, mungkin datanya persis sama. 
            // Opsional: berikan pesan "Data tidak ada perubahan"
        }
        header('Location: ' . BASEURL . '/petugas');
        exit;
    }
}

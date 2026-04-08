<?php
class Anggota extends Controller {
    public function __construct() {
        if(!isset($_SESSION['user_ses'])) {
            $this->redirect('auth');
        }
    }

    public function index() {
        $data['judul'] = 'Daftar Anggota | Aplikasi Perpus';
        $data['user'] = $_SESSION['user_ses'];
        $data['anggota'] = $this->model('Anggota_model')->getAllAnggota();
        
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('anggota/index', $data);
        $this->view('templates/footer');
    }

    public function tambah()
    {
        if ($this->model('Anggota_model')->tambahDataAnggota($_POST) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
        }
        header('Location: ' . BASEURL . '/anggota');
        exit;
    }

    public function edit()
    {
        if ($this->model('Anggota_model')->ubahDataAnggota($_POST) > 0) {
            Flasher::setFlash('berhasil', 'diubah', 'success');
        } else {
            Flasher::setFlash('gagal', 'diubah', 'danger');
        }
        header('Location: ' . BASEURL . '/anggota');
        exit;
    }

    public function hapus($id)
    {
        if ($this->model('Anggota_model')->hapusDataAnggota($id) > 0) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
        }
        header('Location: ' . BASEURL . '/anggota');
        exit;
    }
}

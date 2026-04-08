<?php
class Buku extends Controller {
    public function __construct() {
        if(!isset($_SESSION['user_ses'])) {
            $this->redirect('auth');
        }
    }

    public function index() {
        $data['judul'] = 'Daftar Buku | Aplikasi Perpus';
        $data['user'] = $_SESSION['user_ses'];
        $data['buku'] = $this->model('Buku_model')->getAllBuku();
        $data['kategori'] = $this->model('Kategori_model')->getAllKategori();
        
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('buku/index', $data);
        $this->view('templates/footer');
    }

    public function tambah()
    {
        if ($this->model('Buku_model')->tambahDataBuku($_POST) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: ' . BASEURL . '/buku');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: ' . BASEURL . '/buku');
            exit;
        }
    }

    public function edit()
    {
        if ($this->model('Buku_model')->ubahDataBuku($_POST) > 0) {
            Flasher::setFlash('berhasil', 'diubah', 'success');
            header('Location: ' . BASEURL . '/buku');
            exit;
        } else {
            Flasher::setFlash('gagal', 'diubah', 'danger');
            header('Location: ' . BASEURL . '/buku');
            exit;
        }
    }

    public function hapus($id)
    {
        if ($this->model('Buku_model')->hapusDataBuku($id) > 0) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('Location: ' . BASEURL . '/buku');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('Location: ' . BASEURL . '/buku');
            exit;
        }
    }
}

<?php

class Kategori extends Controller {
    public function __construct()
    {
        if (!isset($_SESSION['user_ses'])) {
            header('Location: ' . BASEURL . '/auth');
            exit;
        }
    }

    public function index()
    {
        $data['judul'] = 'Kategori Buku | E-Perpus';
        $data['user'] = $_SESSION['user_ses'];
        $data['kategori'] = $this->model('Kategori_model')->getAllKategori();
        
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('kategori/index', $data);
        $this->view('templates/footer');
    }

    public function tambah()
    {
        if ($this->model('Kategori_model')->tambahDataKategori($_POST) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
        }
        header('Location: ' . BASEURL . '/kategori');
        exit;
    }

    public function edit()
    {
        if ($this->model('Kategori_model')->ubahDataKategori($_POST) > 0) {
            Flasher::setFlash('berhasil', 'diubah', 'success');
        } else {
            Flasher::setFlash('gagal', 'diubah', 'danger');
        }
        header('Location: ' . BASEURL . '/kategori');
        exit;
    }

    public function hapus($id)
    {
        if ($this->model('Kategori_model')->hapusDataKategori($id) > 0) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
        }
        header('Location: ' . BASEURL . '/kategori');
        exit;
    }
}

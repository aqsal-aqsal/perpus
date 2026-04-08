<?php
class Peminjaman extends Controller {
    public function __construct() {
        if(!isset($_SESSION['user_ses'])) {
            $this->redirect('auth');
        }
    }

    public function index() {
        $data['judul'] = 'Transaksi Peminjaman | Aplikasi Perpus';
        $data['user'] = $_SESSION['user_ses'];
        $data['peminjaman'] = $this->model('Peminjaman_model')->getAllPeminjaman();
        $data['buku'] = $this->model('Buku_model')->getAllBuku();
        $data['anggota'] = $this->model('Anggota_model')->getAllAnggota();
        
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('peminjaman/index', $data);
        $this->view('templates/footer');
    }

    public function tambah()
    {
        if ($this->model('Peminjaman_model')->tambahDataPeminjaman($_POST) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
        }
        header('Location: ' . BASEURL . '/peminjaman');
        exit;
    }
}

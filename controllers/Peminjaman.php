<?php
class Peminjaman extends Controller {
    public function __construct() {
        if(!isset($_SESSION['user_ses'])) {
            $this->redirect('auth');
        }
    }

    public function index() {
        $data['judul'] = 'Daftar Peminjaman | Aplikasi Perpus';
        $data['peminjaman'] = $this->model('Peminjaman_model')->getAllPeminjaman();
        
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

    public function verifikasi($id) {
        if ($this->model('Peminjaman_model')->verifikasiBooking($id)) {
            Flasher::setFlash('Booking berhasil diverifikasi!', 'Berhasil', 'success');
        } else {
            Flasher::setFlash('Gagal memverifikasi booking.', 'Gagal', 'danger');
        }
        $this->redirect('peminjaman');
    }

    public function kembalikan($id) {
        if ($this->model('Peminjaman_model')->kembalikanBuku($id)) {
            Flasher::setFlash('Buku telah dikembalikan.', 'Berhasil', 'success');
        } else {
            Flasher::setFlash('Gagal memproses pengembalian.', 'Gagal', 'danger');
        }
        $this->redirect('peminjaman');
    }
}

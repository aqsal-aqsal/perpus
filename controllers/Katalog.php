<?php
class Katalog extends Controller {
    public function __construct() {
        if(!isset($_SESSION['user_ses'])) {
            $this->redirect('auth');
        }
        if($_SESSION['user_ses']['role'] != 'peminjam') {
            $this->redirect('dashboard');
        }
    }

    public function index() {
        $search = isset($_POST['search']) ? $_POST['search'] : null;
        $kategori = isset($_POST['kategori']) ? $_POST['kategori'] : null;

        $data['judul'] = 'Katalog Buku | E-PERPUS';
        $data['buku'] = $this->model('Katalog_model')->getAllBuku($search, $kategori);
        $data['kategori'] = $this->model('Kategori_model')->getAllKategori();
        $data['cart_count'] = count($this->model('Katalog_model')->getCartByUser($_SESSION['user_ses']['id']));

        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('katalog/index', $data);
        $this->view('templates/footer');
    }

    public function add_to_cart($id_buku) {
        if ($this->model('Katalog_model')->addToCart($_SESSION['user_ses']['id'], $id_buku)) {
            Flasher::setFlash('Buku berhasil ditambahkan ke keranjang.', 'Berhasil', 'success');
        } else {
            Flasher::setFlash('Buku sudah ada di keranjang atau terjadi kesalahan.', 'Info', 'info');
        }
        $this->redirect('catalog');
    }

    public function cart() {
        $data['judul'] = 'Keranjang Pinjam | E-PERPUS';
        $data['cart'] = $this->model('Katalog_model')->getCartByUser($_SESSION['user_ses']['id']);

        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('katalog/cart', $data);
        $this->view('templates/footer');
    }

    public function remove_cart($id_buku) {
        if ($this->model('Katalog_model')->removeFromCart($_SESSION['user_ses']['id'], $id_buku)) {
            Flasher::setFlash('Buku dihapus dari keranjang.', 'Berhasil', 'success');
        }
        $this->redirect('catalog/cart');
    }

    public function checkout() {
        if ($this->model('Katalog_model')->checkout($_SESSION['user_ses']['id'])) {
            Flasher::setFlash('Booking berhasil! Silakan ambil buku di perpustakaan.', 'Berhasil', 'success');
            $this->redirect('history');
        } else {
            Flasher::setFlash('Gagal melakukan checkout.', 'Gagal', 'danger');
            $this->redirect('catalog/cart');
        }
    }
}

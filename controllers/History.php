<?php
class History extends Controller {
    public function __construct() {
        if(!isset($_SESSION['user_ses'])) {
            $this->redirect('auth');
        }
    }

    public function index() {
        $data['judul'] = 'Riwayat Pinjam | E-PERPUS';
        $user_id = $_SESSION['user_ses']['id'];
        
        $this->db = new Database;
        $this->db->query("SELECT peminjaman.*, buku.judul, buku.gambar 
                          FROM peminjaman 
                          JOIN detail_peminjaman ON peminjaman.id_peminjaman = detail_peminjaman.id_peminjaman 
                          JOIN buku ON detail_peminjaman.id_buku = buku.id_buku 
                          WHERE peminjaman.id_user = :id 
                          ORDER BY peminjaman.id_peminjaman DESC");
        $this->db->bind('id', $user_id);
        $data['history'] = $this->db->resultSet();

        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('history/index', $data);
        $this->view('templates/footer');
    }
}

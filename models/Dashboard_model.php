<?php
class Dashboard_model {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAdminStats() {
        $stats = [];
        
        // Total Buku
        $this->db->query("SELECT SUM(stok) as total FROM buku");
        $stats['total_buku'] = $this->db->single()['total'] ?? 0;
        
        // Total Anggota
        $this->db->query("SELECT COUNT(*) as total FROM users WHERE role = 'peminjam'");
        $stats['total_anggota'] = $this->db->single()['total'] ?? 0;
        
        // Sedang Dipinjam
        $this->db->query("SELECT COUNT(*) as total FROM peminjaman WHERE status = 'dipinjam'");
        $stats['total_dipinjam'] = $this->db->single()['total'] ?? 0;
        
        // Terlambat
        $this->db->query("SELECT COUNT(*) as total FROM peminjaman WHERE status = 'terlambat'");
        $stats['total_terlambat'] = $this->db->single()['total'] ?? 0;

        return $stats;
    }

    public function getUserStats($id_user) {
        $stats = [];
        
        // Buku yang sedang dipinjam
        $this->db->query("SELECT COUNT(*) as total FROM peminjaman WHERE id_user = :id AND status = 'dipinjam'");
        $this->db->bind('id', $id_user);
        $stats['sedang_pinjam'] = $this->db->single()['total'] ?? 0;
        
        // Booking aktif
        $this->db->query("SELECT COUNT(*) as total FROM peminjaman WHERE id_user = :id AND status = 'booking'");
        $this->db->bind('id', $id_user);
        $stats['booking_aktif'] = $this->db->single()['total'] ?? 0;
        
        // Total riwayat
        $this->db->query("SELECT COUNT(*) as total FROM peminjaman WHERE id_user = :id");
        $this->db->bind('id', $id_user);
        $stats['total_riwayat'] = $this->db->single()['total'] ?? 0;

        return $stats;
    }

    public function getRecentActivities() {
        $this->db->query("SELECT peminjaman.*, users.nama as nama_user, buku.judul 
                          FROM peminjaman 
                          JOIN users ON peminjaman.id_user = users.id_user 
                          JOIN detail_peminjaman ON peminjaman.id_peminjaman = detail_peminjaman.id_peminjaman
                          JOIN buku ON detail_peminjaman.id_buku = buku.id_buku
                          ORDER BY peminjaman.id_peminjaman DESC LIMIT 5");
        return $this->db->resultSet();
    }
}

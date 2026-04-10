<?php
class Peminjaman_model {
    private $table = 'peminjaman';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllPeminjaman() {
        // Gabungkan tabel peminjaman, users (peminjam) dan users (petugas)
        $query = "SELECT p.*, a.nama as nama_anggota, pt.nama as nama_petugas, b.judul
                  FROM peminjaman p
                  LEFT JOIN users a ON p.id_user = a.id_user
                  LEFT JOIN users pt ON p.id_petugas = pt.id_user
                  JOIN detail_peminjaman dp ON p.id_peminjaman = dp.id_peminjaman
                  JOIN buku b ON dp.id_buku = b.id_buku
                  ORDER BY p.id_peminjaman DESC";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function verifikasiBooking($id_peminjaman) {
        $id_petugas = $_SESSION['user_ses']['id'];
        $tanggal_pinjam = date('Y-m-d');
        $batas_kembali = date('Y-m-d', strtotime('+7 days'));

        // 1. Update status peminjaman
        $this->db->query("UPDATE peminjaman SET 
                            id_petugas = :id_petugas, 
                            tanggal_pinjam = :tanggal_pinjam, 
                            batas_kembali = :batas_kembali, 
                            status = 'dipinjam' 
                          WHERE id_peminjaman = :id");
        $this->db->bind('id_petugas', $id_petugas);
        $this->db->bind('tanggal_pinjam', $tanggal_pinjam);
        $this->db->bind('batas_kembali', $batas_kembali);
        $this->db->bind('id', $id_peminjaman);
        $this->db->execute();

        // 2. Reduce book stock
        $this->db->query("SELECT id_buku FROM detail_peminjaman WHERE id_peminjaman = :id");
        $this->db->bind('id', $id_peminjaman);
        $detail = $this->db->single();
        
        $this->db->query("UPDATE buku SET stok = stok - 1 WHERE id_buku = :id_buku");
        $this->db->bind('id_buku', $detail['id_buku']);
        $this->db->execute();

        return $this->db->rowCount();
    }

    public function kembalikanBuku($id_peminjaman)
    {
        // Update status peminjaman
        $this->db->query("UPDATE peminjaman SET status = 'dikembalikan', tanggal_kembali = CURRENT_DATE WHERE id_peminjaman = :id");
        $this->db->bind('id', $id_peminjaman);
        $this->db->execute();

        // Get details to revert stock
        $this->db->query("SELECT * FROM detail_peminjaman WHERE id_peminjaman = :id");
        $this->db->bind('id', $id_peminjaman);
        $details = $this->db->resultSet();

        // Tambah stok buku
        foreach ($details as $detail) {
            $this->db->query("UPDATE buku SET stok = stok + :jumlah WHERE id_buku = :id_buku");
            $this->db->bind('jumlah', $detail['jumlah']);
            $this->db->bind('id_buku', $detail['id_buku']);
            $this->db->execute();
        }

        return 1;
    }

    public function checkReminders() {
        // 1. Check for H-2 (Due in 2 days)
        $h_min_2 = date('Y-m-d', strtotime('+2 days'));
        $this->db->query("SELECT p.*, u.nama, b.judul 
                          FROM peminjaman p 
                          JOIN users u ON p.id_user = u.id_user 
                          JOIN detail_peminjaman dp ON p.id_peminjaman = dp.id_peminjaman
                          JOIN buku b ON dp.id_buku = b.id_buku
                          WHERE p.batas_kembali = :h2 AND p.status = 'dipinjam'");
        $this->db->bind('h2', $h_min_2);
        $reminders = $this->db->resultSet();
        
        return $reminders;
    }

    public function tambahDataPeminjaman($data) {
        $id_petugas = $_SESSION['user_ses']['id'];
        
        $this->db->query("START TRANSACTION");

        try {
            // 1. Insert into peminjaman
            $this->db->query("INSERT INTO peminjaman (id_user, id_petugas, tanggal_pinjam, batas_kembali, status) 
                              VALUES (:id_user, :id_petugas, :tanggal_pinjam, :tanggal_kembali, 'dipinjam')");
            $this->db->bind('id_user', $data['id_anggota']);
            $this->db->bind('id_petugas', $id_petugas);
            $this->db->bind('tanggal_pinjam', $data['tanggal_pinjam']);
            $this->db->bind('tanggal_kembali', $data['tanggal_kembali']);
            $this->db->execute();
            
            $id_peminjaman = $this->db->lastInsertId();

            // 2. Insert into detail_peminjaman
            $this->db->query("INSERT INTO detail_peminjaman (id_peminjaman, id_buku, jumlah) 
                              VALUES (:id_pinjam, :id_buku, 1)");
            $this->db->bind('id_pinjam', $id_peminjaman);
            $this->db->bind('id_buku', $data['id_buku']);
            $this->db->execute();

            // 3. Kurangi stok buku
            $this->db->query("UPDATE buku SET stok = stok - 1 WHERE id_buku = :id_buku");
            $this->db->bind('id_buku', $data['id_buku']);
            $this->db->execute();

            $this->db->query("COMMIT");
            return 1;
        } catch (Exception $e) {
            $this->db->query("ROLLBACK");
            return 0;
        }
    }
}

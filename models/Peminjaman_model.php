<?php
class Peminjaman_model {
    private $table = 'peminjaman';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllPeminjaman() {
        // Gabungkan tabel peminjaman, anggota dan petugas
        $query = "SELECT p.*, a.nama as nama_anggota, pt.nama as nama_petugas 
                  FROM {$this->table} p
                  LEFT JOIN anggota a ON p.id_anggota = a.id_anggota
                  LEFT JOIN petugas pt ON p.id_petugas = pt.id_petugas
                  ORDER BY p.id_peminjaman DESC";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    public function tambahDataPeminjaman($data)
    {
        // $data includes: id_anggota, id_buku, tanggal_pinjam, tanggal_kembali
        $id_petugas = $_SESSION['user_ses']['id'];
        
        // Use direct PDO object to begin transaction if we could, but our wrapper doesn't expose it.
        // We'll just execute sequentially.
        
        // 1. Insert ke peminjaman
        $queryPeminjaman = "INSERT INTO peminjaman (id_anggota, id_petugas, tanggal_pinjam, tanggal_kembali, status) 
                            VALUES (:id_anggota, :id_petugas, :tanggal_pinjam, :tanggal_kembali, 'dipinjam')";
        
        $this->db->query($queryPeminjaman);
        $this->db->bind('id_anggota', $data['id_anggota']);
        $this->db->bind('id_petugas', $id_petugas);
        $this->db->bind('tanggal_pinjam', $data['tanggal_pinjam']);
        $this->db->bind('tanggal_kembali', $data['tanggal_kembali']);
        $this->db->execute();
        
        $id_peminjaman = $this->db->lastInsertId();
        
        // 2. Insert ke detail_peminjaman
        $queryDetail = "INSERT INTO detail_peminjaman (id_peminjaman, id_buku, jumlah) 
                        VALUES (:id_peminjaman, :id_buku, 1)";
        $this->db->query($queryDetail);
        $this->db->bind('id_peminjaman', $id_peminjaman);
        $this->db->bind('id_buku', $data['id_buku']);
        $this->db->execute();
        
        // 3. Kurangi stok buku
        $queryStok = "UPDATE buku SET stok = stok - 1 WHERE id_buku = :id_buku";
        $this->db->query($queryStok);
        $this->db->bind('id_buku', $data['id_buku']);
        $this->db->execute();
        
        return $this->db->rowCount();
    }
}

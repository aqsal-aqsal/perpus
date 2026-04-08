<?php
class Buku_model {
    private $table = 'buku';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllBuku() {
        // Gabungkan tabel buku dengan kategori
        $this->db->query("SELECT buku.*, kategori.nama_kategori FROM {$this->table} LEFT JOIN kategori ON buku.id_kategori = kategori.id_kategori ORDER BY buku.id_buku DESC");
        return $this->db->resultSet();
    }

    public function tambahDataBuku($data)
    {
        $query = "INSERT INTO buku
                    (judul, penulis, penerbit, tahun_terbit, id_kategori, stok)
                  VALUES
                    (:judul, :penulis, :penerbit, :tahun_terbit, :id_kategori, :stok)";
        
        $this->db->query($query);
        $this->db->bind('judul', $data['judul']);
        $this->db->bind('penulis', $data['penulis']);
        $this->db->bind('penerbit', $data['penerbit']);
        $this->db->bind('tahun_terbit', $data['tahun_terbit']);
        $this->db->bind('id_kategori', $data['id_kategori']);
        $this->db->bind('stok', $data['stok']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function ubahDataBuku($data)
    {
        $query = "UPDATE buku SET 
                    judul = :judul, 
                    penulis = :penulis, 
                    penerbit = :penerbit, 
                    tahun_terbit = :tahun_terbit, 
                    id_kategori = :id_kategori, 
                    stok = :stok 
                  WHERE id_buku = :id_buku";
        
        $this->db->query($query);
        $this->db->bind('judul', $data['judul']);
        $this->db->bind('penulis', $data['penulis']);
        $this->db->bind('penerbit', $data['penerbit']);
        $this->db->bind('tahun_terbit', $data['tahun_terbit']);
        $this->db->bind('id_kategori', $data['id_kategori']);
        $this->db->bind('stok', $data['stok']);
        $this->db->bind('id_buku', $data['id_buku']);

        $this->db->execute();
        return $this->db->rowCount();
    }

    public function hapusDataBuku($id)
    {
        $query = "DELETE FROM buku WHERE id_buku = :id_buku";
        $this->db->query($query);
        $this->db->bind('id_buku', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }
}

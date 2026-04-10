<?php
class Katalog_model {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllBuku($search = null, $kategori = null) {
        $query = "SELECT buku.*, kategori.nama_kategori 
                  FROM buku 
                  LEFT JOIN kategori ON buku.id_kategori = kategori.id_kategori 
                  WHERE 1=1";
        
        if ($search) {
            $query .= " AND (buku.judul LIKE :search OR buku.penulis LIKE :search)";
        }
        
        if ($kategori) {
            $query .= " AND buku.id_kategori = :kategori";
        }
        
        $query .= " ORDER BY buku.id_buku DESC";
        
        $this->db->query($query);
        if ($search) $this->db->bind('search', "%$search%");
        if ($kategori) $this->db->bind('kategori', $kategori);
        
        return $this->db->resultSet();
    }

    public function getBukuById($id) {
        $this->db->query("SELECT buku.*, kategori.nama_kategori 
                          FROM buku 
                          LEFT JOIN kategori ON buku.id_kategori = kategori.id_kategori 
                          WHERE id_buku = :id");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    // Cart System
    public function addToCart($id_user, $id_buku) {
        // Check if already in cart
        $this->db->query("SELECT id_keranjang FROM keranjang WHERE id_user = :id_user AND id_buku = :id_buku");
        $this->db->bind('id_user', $id_user);
        $this->db->bind('id_buku', $id_buku);
        if ($this->db->single()) return false;

        $this->db->query("INSERT INTO keranjang (id_user, id_buku) VALUES (:id_user, :id_buku)");
        $this->db->bind('id_user', $id_user);
        $this->db->bind('id_buku', $id_buku);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getCartByUser($id_user) {
        $this->db->query("SELECT keranjang.*, buku.judul, buku.penulis, buku.gambar, buku.stok 
                          FROM keranjang 
                          JOIN buku ON keranjang.id_buku = buku.id_buku 
                          WHERE keranjang.id_user = :id_user");
        $this->db->bind('id_user', $id_user);
        return $this->db->resultSet();
    }

    public function removeFromCart($id_user, $id_buku) {
        $this->db->query("DELETE FROM keranjang WHERE id_user = :id_user AND id_buku = :id_buku");
        $this->db->bind('id_user', $id_user);
        $this->db->bind('id_buku', $id_buku);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function clearCart($id_user) {
        $this->db->query("DELETE FROM keranjang WHERE id_user = :id_user");
        $this->db->bind('id_user', $id_user);
        $this->db->execute();
    }

    // Booking System
    public function checkout($id_user) {
        $cart = $this->getCartByUser($id_user);
        if (empty($cart)) return false;

        $this->db->query("START TRANSACTION");
        
        try {
            foreach ($cart as $item) {
                // Create Peminjaman record with 'booking' status
                $this->db->query("INSERT INTO peminjaman (id_user, tanggal_pinjam, status) 
                                  VALUES (:id_user, :tanggal, 'booking')");
                $this->db->bind('id_user', $id_user);
                $this->db->bind('tanggal', date('Y-m-d'));
                $this->db->execute();
                
                $id_peminjaman = $this->db->lastInsertId();

                // Create Detail Peminjaman
                $this->db->query("INSERT INTO detail_peminjaman (id_peminjaman, id_buku, jumlah) 
                                  VALUES (:id_pinjam, :id_buku, 1)");
                $this->db->bind('id_pinjam', $id_peminjaman);
                $this->db->bind('id_buku', $item['id_buku']);
                $this->db->execute();
            }

            $this->clearCart($id_user);
            $this->db->query("COMMIT");
            return true;
        } catch (Exception $e) {
            $this->db->query("ROLLBACK");
            return false;
        }
    }
}

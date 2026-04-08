<?php
class Anggota_model {
    private $table = 'anggota';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllAnggota() {
        $this->db->query("SELECT * FROM {$this->table} ORDER BY id_anggota DESC");
        return $this->db->resultSet();
    }

    public function tambahDataAnggota($data)
    {
        $query = "INSERT INTO {$this->table} (nama, alamat, no_telp, email, tanggal_daftar) 
                  VALUES (:nama, :alamat, :no_telp, :email, :tanggal_daftar)";
        
        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('alamat', $data['alamat']);
        $this->db->bind('no_telp', $data['no_telp']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('tanggal_daftar', $data['tanggal_daftar']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function ubahDataAnggota($data)
    {
        $query = "UPDATE {$this->table} SET 
                    nama = :nama, 
                    alamat = :alamat, 
                    no_telp = :no_telp, 
                    email = :email, 
                    tanggal_daftar = :tanggal_daftar 
                  WHERE id_anggota = :id_anggota";
        
        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('alamat', $data['alamat']);
        $this->db->bind('no_telp', $data['no_telp']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('tanggal_daftar', $data['tanggal_daftar']);
        $this->db->bind('id_anggota', $data['id_anggota']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function hapusDataAnggota($id)
    {
        $query = "DELETE FROM {$this->table} WHERE id_anggota = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }
}

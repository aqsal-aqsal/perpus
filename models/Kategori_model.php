<?php

class Kategori_model {
    private $table = 'kategori';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllKategori()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function tambahDataKategori($data)
    {
        $query = "INSERT INTO {$this->table} (nama_kategori) VALUES (:nama_kategori)";
        $this->db->query($query);
        $this->db->bind('nama_kategori', $data['nama_kategori']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function ubahDataKategori($data)
    {
        $query = "UPDATE {$this->table} SET nama_kategori = :nama_kategori WHERE id_kategori = :id_kategori";
        $this->db->query($query);
        $this->db->bind('nama_kategori', $data['nama_kategori']);
        $this->db->bind('id_kategori', $data['id_kategori']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function hapusDataKategori($id)
    {
        $query = "DELETE FROM {$this->table} WHERE id_kategori = :id";
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }
}

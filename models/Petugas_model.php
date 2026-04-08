<?php

class Petugas_model {
    private $table = 'petugas';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllPetugas()
    {
        $this->db->query('SELECT * FROM ' . $this->table);
        return $this->db->resultSet();
    }

    public function tambahDataPetugas($data)
    {
        $query = "INSERT INTO {$this->table} (nama, username, password, level) 
                  VALUES (:nama, :username, :password, :level)";
        
        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('username', $data['username']);
        $this->db->bind('password', password_hash($data['password'], PASSWORD_BCRYPT));
        $this->db->bind('level', $data['level']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function ubahDataPetugas($data)
    {
        if (!empty($data['password'])) {
            $query = "UPDATE {$this->table} SET nama = :nama, username = :username, password = :password, level = :level WHERE id_petugas = :id_petugas";
            $this->db->query($query);
            $this->db->bind('password', password_hash($data['password'], PASSWORD_BCRYPT));
        } else {
            $query = "UPDATE {$this->table} SET nama = :nama, username = :username, level = :level WHERE id_petugas = :id_petugas";
            $this->db->query($query);
        }

        $this->db->bind('nama', $data['nama']);
        $this->db->bind('username', $data['username']);
        $this->db->bind('level', $data['level']);
        $this->db->bind('id_petugas', $data['id_petugas']);

        $this->db->execute();

        return $this->db->rowCount();
    }
}

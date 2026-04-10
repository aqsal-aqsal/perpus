<?php

class Petugas_model {
    private $table = 'users';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllPetugas()
    {
        $this->db->query("SELECT * FROM {$this->table} WHERE role IN ('admin', 'staff')");
        return $this->db->resultSet();
    }

    public function tambahDataPetugas($data)
    {
        $query = "INSERT INTO {$this->table} (nama, username, password, role) 
                  VALUES (:nama, :username, :password, :role)";
        
        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('username', $data['username']);
        $this->db->bind('password', password_hash($data['password'], PASSWORD_BCRYPT));
        $this->db->bind('role', $data['level']); // data['level'] from form

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function ubahDataPetugas($data)
    {
        if (!empty($data['password'])) {
            $query = "UPDATE {$this->table} SET nama = :nama, username = :username, password = :password, role = :role WHERE id_user = :id_user";
            $this->db->query($query);
            $this->db->bind('password', password_hash($data['password'], PASSWORD_BCRYPT));
        } else {
            $query = "UPDATE {$this->table} SET nama = :nama, username = :username, role = :role WHERE id_user = :id_user";
            $this->db->query($query);
        }

        $this->db->bind('nama', $data['nama']);
        $this->db->bind('username', $data['username']);
        $this->db->bind('role', $data['level']); // data['level'] from form
        $this->db->bind('id_user', $data['id_petugas']); // data['id_petugas'] from form

        $this->db->execute();

        return $this->db->rowCount();
    }
}

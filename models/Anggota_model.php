<?php
class Anggota_model {
    private $table = 'users';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getAllAnggota() {
        $this->db->query("SELECT * FROM {$this->table} WHERE role = 'peminjam' ORDER BY id_user DESC");
        return $this->db->resultSet();
    }

    public function tambahDataAnggota($data)
    {
        $query = "INSERT INTO {$this->table} (nama, alamat, no_telp, email, username, password, role) 
                  VALUES (:nama, :alamat, :no_telp, :email, :username, :password, 'peminjam')";
        
        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('alamat', $data['alamat']);
        $this->db->bind('no_telp', $data['no_telp']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('username', $data['username']);
        $this->db->bind('password', password_hash($data['password'], PASSWORD_DEFAULT));

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function ubahDataAnggota($data)
    {
        $query = "UPDATE {$this->table} SET 
                    nama = :nama, 
                    alamat = :alamat, 
                    no_telp = :no_telp, 
                    email = :email
                  WHERE id_user = :id_user AND role = 'peminjam'";
        
        $this->db->query($query);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('alamat', $data['alamat']);
        $this->db->bind('no_telp', $data['no_telp']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('id_user', $data['id_user']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function hapusDataAnggota($id)
    {
        $query = "DELETE FROM {$this->table} WHERE id_user = :id AND role = 'peminjam'";
        $this->db->query($query);
        $this->db->bind('id', $id);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function daftarAnggotaBaru($data)
    {
        $query = "INSERT INTO {$this->table} (nik, nama, tempat_lahir, tanggal_lahir, jenis_kelamin, alamat, agama, status_perkawinan, pekerjaan, kewarganegaraan, no_telp, username, password, foto_ktp, role) 
                  VALUES (:nik, :nama, :tempat_lahir, :tanggal_lahir, :jenis_kelamin, :alamat, :agama, :status_perkawinan, :pekerjaan, :kewarganegaraan, :no_telp, :username, :password, :foto, 'peminjam')";
        
        $this->db->query($query);
        $this->db->bind('nik', $data['nik']);
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('tempat_lahir', $data['tempat_lahir']);
        $this->db->bind('tanggal_lahir', $data['tanggal_lahir']);
        $this->db->bind('jenis_kelamin', $data['jenis_kelamin']);
        $this->db->bind('alamat', $data['alamat']);
        $this->db->bind('agama', $data['agama']);
        $this->db->bind('status_perkawinan', $data['status_perkawinan']);
        $this->db->bind('pekerjaan', $data['pekerjaan']);
        $this->db->bind('kewarganegaraan', $data['kewarganegaraan']);
        $this->db->bind('no_telp', $data['no_telp']);
        $this->db->bind('username', $data['username']);
        $this->db->bind('password', password_hash($data['password'], PASSWORD_DEFAULT));
        $this->db->bind('foto', $data['foto']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function getLastAnggotaByEmail($email)
    {
        $this->db->query("SELECT * FROM {$this->table} WHERE email = :email AND role = 'peminjam' ORDER BY id_user DESC LIMIT 1");
        $this->db->bind('email', $email);
        return $this->db->single();
    }

    public function getAnggotaById($id)
    {
        $this->db->query("SELECT * FROM {$this->table} WHERE id_user = :id AND role = 'peminjam'");
        $this->db->bind('id', $id);
        return $this->db->single();
    }
}

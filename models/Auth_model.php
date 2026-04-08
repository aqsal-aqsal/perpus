<?php
class Auth_model {
    private $table = 'petugas';
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getPetugasByUsername($username) {
        $this->db->query('SELECT * FROM ' . $this->table . ' WHERE username=:username');
        $this->db->bind('username', $username);
        return $this->db->single();
    }
}

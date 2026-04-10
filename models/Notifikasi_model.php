<?php
class Notifikasi_model {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function create($id_user, $judul, $pesan) {
        $this->db->query("INSERT INTO notifikasi (id_user, judul, pesan) VALUES (:id_user, :judul, :pesan)");
        $this->db->bind('id_user', $id_user);
        $this->db->bind('judul', $judul);
        $this->db->bind('pesan', $pesan);
        return $this->db->execute();
    }

    public function getByUser($id_user) {
        $this->db->query("SELECT * FROM notifikasi WHERE id_user = :id_user ORDER BY created_at DESC");
        $this->db->bind('id_user', $id_user);
        return $this->db->resultSet();
    }

    public function getUnreadCount($id_user) {
        $this->db->query("SELECT COUNT(*) as total FROM notifikasi WHERE id_user = :id_user AND is_read = 0");
        $this->db->bind('id_user', $id_user);
        return $this->db->single()['total'];
    }

    public function markAsRead($id_notif) {
        $this->db->query("UPDATE notifikasi SET is_read = 1 WHERE id_notif = :id");
        $this->db->bind('id', $id_notif);
        return $this->db->execute();
    }
}

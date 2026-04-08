<?php
require_once 'config/Config.php';
require_once 'config/Database.php';

$db = new Database();

// Cek apakah sudah ada admin
$db->query("SELECT * FROM petugas WHERE username = 'admin'");
$admin = $db->single();

if(!$admin) {
    $db->query("INSERT INTO petugas (nama, username, password, level) VALUES (:nama, :username, :password, :level)");
    $db->bind('nama', 'Administrator');
    $db->bind('username', 'admin');
    $db->bind('password', password_hash('admin123', PASSWORD_BCRYPT));
    $db->bind('level', 'admin');
    $db->execute();
    echo "Seed: Berhasil membuat akun admin (username: admin, password: admin123)\n";
} else {
    echo "Seed: Akun admin sudah ada di database.\n";
}

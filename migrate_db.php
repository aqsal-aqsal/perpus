<?php
require_once 'config/Config.php';
require_once 'config/Database.php';

$db = new Database();

echo "Starting migration...\n";

// 1. Create users table if not exists
$sql_users = "CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nik` varchar(16) DEFAULT NULL,
  `nama` varchar(100) NOT NULL,
  `tempat_lahir` varchar(100) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT 'Laki-laki',
  `alamat` text,
  `agama` varchar(50) DEFAULT NULL,
  `status_perkawinan` varchar(50) DEFAULT NULL,
  `pekerjaan` varchar(50) DEFAULT NULL,
  `kewarganegaraan` varchar(50) DEFAULT 'WNI',
  `username` varchar(50) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','staff','peminjam') NOT NULL DEFAULT 'peminjam',
  `foto_ktp` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

try {
    $db->query($sql_users);
    $db->execute();
    echo "Table 'users' created or already exists.\n";
} catch (PDOException $e) {
    echo "Error creating table 'users': " . $e->getMessage() . "\n";
}

// 2. Insert default admin if not exists
try {
    $db->query("SELECT COUNT(*) as total FROM users WHERE username = 'admin'");
    $count = $db->single()['total'];
    if ($count == 0) {
        $db->query("INSERT INTO users (nama, username, password, role) VALUES (:nama, :username, :password, :role)");
        $db->bind('nama', 'Administrator');
        $db->bind('username', 'admin');
        $db->bind('password', password_hash('admin123', PASSWORD_BCRYPT));
        $db->bind('role', 'admin');
        $db->execute();
        echo "Default admin created (username: admin, password: admin123).\n";
    } else {
        echo "Admin user already exists.\n";
    }
} catch (PDOException $e) {
    echo "Error checking/creating admin: " . $e->getMessage() . "\n";
}

// 3. Apply other changes from revamp_db.sql
$other_sqls = [
    "ALTER TABLE `buku` ADD COLUMN `gambar` varchar(255) DEFAULT NULL",
    "ALTER TABLE `buku` ADD COLUMN `deskripsi` text DEFAULT NULL",
    "CREATE TABLE IF NOT EXISTS `notifikasi` (
      `id_notif` int NOT NULL AUTO_INCREMENT,
      `id_user` int NOT NULL,
      `judul` varchar(100) DEFAULT NULL,
      `pesan` text NOT NULL,
      `is_read` tinyint(1) DEFAULT '0',
      `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
      PRIMARY KEY (`id_notif`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
    "CREATE TABLE IF NOT EXISTS `keranjang` (
      `id_keranjang` int NOT NULL AUTO_INCREMENT,
      `id_user` int NOT NULL,
      `id_buku` int NOT NULL,
      `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
      PRIMARY KEY (`id_keranjang`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4",
    "ALTER TABLE `peminjaman` MODIFY COLUMN `status` enum('booking','dipinjam','dikembalikan','terlambat') DEFAULT 'booking'",
    "ALTER TABLE `peminjaman` ADD COLUMN `batas_kembali` date DEFAULT NULL",
    "ALTER TABLE `peminjaman` CHANGE `id_anggota` `id_user` int DEFAULT NULL",
];

// Foreach sql, try to execute, ignore if column already exists
foreach ($other_sqls as $sql) {
    try {
        $db->query($sql);
        $db->execute();
        echo "Executed: " . substr($sql, 0, 50) . "...\n";
    } catch (PDOException $e) {
        echo "Skipped/Error: " . $e->getMessage() . "\n";
    }
}

echo "\nMigration finished!\n";

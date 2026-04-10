-- Drop old tables if necessary or modify them
-- We will consolidate petugas and anggota into users

CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nik` varchar(16) NOT NULL UNIQUE,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Migrate existing petugas to users
-- Note: id_petugas will map to id_user. Roles: admin -> admin, staff -> staff.
-- Since it's a new system, we'll assume fresh start or manual migration if needed.
-- For now, let's insert a default admin if table is empty.
INSERT IGNORE INTO `users` (`nama`, `username`, `password`, `role`) VALUES 
('Administrator', 'admin', '$2y$10$wS9X9v.r3p3mK1v/l/t5eO0tX3E5f7z6vE7.vG7/vG7/vG7/vG7/', 'admin'); 
-- password is 'admin' (hashed) or similar.

-- Update Buku table
ALTER TABLE `buku` ADD COLUMN `gambar` varchar(255) DEFAULT NULL;
ALTER TABLE `buku` ADD COLUMN `deskripsi` text DEFAULT NULL;

-- Create Notifikasi table
CREATE TABLE IF NOT EXISTS `notifikasi` (
  `id_notif` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `pesan` text NOT NULL,
  `is_read` tinyint(1) DEFAULT '0',
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_notif`),
  CONSTRAINT `fk_notif_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create Keranjang table
CREATE TABLE IF NOT EXISTS `keranjang` (
  `id_keranjang` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_buku` int NOT NULL,
  `created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_keranjang`),
  CONSTRAINT `fk_cart_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE,
  CONSTRAINT `fk_cart_buku` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Update Peminjaman table
-- We modify statuses and add batas_kembali
ALTER TABLE `peminjaman` MODIFY COLUMN `status` enum('booking','dipinjam','dikembalikan','terlambat') DEFAULT 'booking';
ALTER TABLE `peminjaman` ADD COLUMN `batas_kembali` date DEFAULT NULL;

-- Since we unified users, we need to update the foreign keys in peminjaman
-- id_anggota and id_petugas now refer to id_user
ALTER TABLE `peminjaman` DROP FOREIGN KEY `peminjaman_ibfk_1`;
ALTER TABLE `peminjaman` DROP FOREIGN KEY `peminjaman_ibfk_2`;
ALTER TABLE `peminjaman` CHANGE `id_anggota` `id_user` int DEFAULT NULL;
ALTER TABLE `peminjaman` ADD CONSTRAINT `fk_peminjaman_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE;
ALTER TABLE `peminjaman` ADD CONSTRAINT `fk_peminjaman_petugas` FOREIGN KEY (`id_petugas`) REFERENCES `users` (`id_user`) ON DELETE SET NULL;

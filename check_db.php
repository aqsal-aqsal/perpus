<?php
$db = new PDO("mysql:host=localhost;dbname=perpus", "root", "");
$db->query("ALTER TABLE anggota ADD foto VARCHAR(255) NULL AFTER email");
echo "Column added successfully.\n";

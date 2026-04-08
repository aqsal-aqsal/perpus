<?php
$db = new PDO("mysql:host=localhost;dbname=perpus", "root", "");
$stmt1 = $db->query("DESCRIBE peminjaman");
$stmt2 = $db->query("DESCRIBE detail_peminjaman");

echo "Peminjaman:\n";
print_r($stmt1->fetchAll(PDO::FETCH_ASSOC));
echo "\nDetail Peminjaman:\n";
print_r($stmt2->fetchAll(PDO::FETCH_ASSOC));

$options = array(
  'http'=>array(
    'method'=>"GET",
    'header'=>"User-Agent: Mozilla/5.0\r\n"
  )
);
$context = stream_context_create($options);
file_put_contents('public/img/logo-kapuas.png', file_get_contents('https://upload.wikimedia.org/wikipedia/commons/e/ec/Lambang_Kabupaten_Kapuas.png', false, $context));
echo "\nLogo downloaded.\n";

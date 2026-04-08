<?php
$ch = curl_init('https://upload.wikimedia.org/wikipedia/commons/e/ec/Lambang_Kabupaten_Kapuas.png');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');
$data = curl_exec($ch);
if($data === false) {
    echo curl_error($ch);
} else {
    file_put_contents('public/img/logo-kapuas.png', $data);
    echo "Logo DL Success";
}
curl_close($ch);

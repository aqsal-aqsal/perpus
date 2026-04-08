<?php
class Flasher {
    public static function setFlash($pesan, $aksi, $tipe) {
        $_SESSION['flash'] = [
            'pesan' => $pesan,
            'aksi'  => $aksi,
            'tipe'  => $tipe
        ];
    }

    public static function flash() {
        if( isset($_SESSION['flash']) ) {
            $type = $_SESSION['flash']['tipe'];
            $color = 'blue';
            if($type == 'success') $color = 'green';
            if($type == 'danger' || $type == 'error') $color = 'red';
            if($type == 'warning') $color = 'yellow';

            echo '<div class="bg-'.$color.'-100 border border-'.$color.'-400 text-'.$color.'-700 px-4 py-3 rounded relative mb-4" role="alert">
                    <strong class="font-bold">'.$_SESSION['flash']['pesan'].'</strong> 
                    <span class="block sm:inline">'.$_SESSION['flash']['aksi'].'</span>
                  </div>';
            unset($_SESSION['flash']);
        }
    }
}

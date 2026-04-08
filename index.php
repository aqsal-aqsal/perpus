<?php
if( !session_id() ) session_start();

require_once 'core/App.php';
require_once 'core/Controller.php';
require_once 'config/Config.php';
require_once 'config/Database.php';
require_once 'core/Flasher.php';

$app = new App();

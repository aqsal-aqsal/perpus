<?php
class Controller {
    public function view($view, $data = []) {
        require_once 'views/' . $view . '.php';
    }

    public function model($model) {
        require_once 'models/' . $model . '.php';
        return new $model;
    }
    
    public function redirect($url) {
        header('Location: ' . BASEURL . '/' . $url);
        exit;
    }
}

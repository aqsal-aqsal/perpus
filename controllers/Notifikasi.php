<?php
class Notifikasi extends Controller {
    public function __construct() {
        if(!isset($_SESSION['user_ses'])) {
            $this->redirect('auth');
        }
    }

    public function index() {
        $data['judul'] = 'Notifikasi | E-PERPUS';
        $user_id = $_SESSION['user_ses']['id'];
        
        $notifModel = $this->model('Notifikasi_model');
        $data['notifikasi'] = $notifModel->getByUser($user_id);
        $data['notif_count'] = $notifModel->getUnreadCount($user_id);

        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('notifikasi/index', $data);
        $this->view('templates/footer');
    }

    public function read($id) {
        $this->model('Notifikasi_model')->markAsRead($id);
        $this->redirect('notifikasi');
    }
}

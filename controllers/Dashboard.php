<?php
class Dashboard extends Controller {
    public function __construct() {
        if(!isset($_SESSION['user_ses'])) {
            $this->redirect('auth');
        }
    }

    public function index() {
        $data['judul'] = 'Dashboard | Aplikasi Perpus';
        $data['user'] = $_SESSION['user_ses'];
        
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('dashboard/index', $data);
        $this->view('templates/footer');
    }
}

<?php
class Home extends Controller {
    public function index() {
        if(isset($_SESSION['user_ses'])) {
            $this->redirect('dashboard');
        }

        $data['judul'] = 'E-PERPUS DISPERSIP KAPUAS';
        $this->view('home/index', $data);
    }
}

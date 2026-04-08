<?php
class Home extends Controller {
    public function index() {
        // Removed auto-redirect when logged in to allow visiting landing page

        $data['judul'] = 'E-PERPUS DISPERSIP KAPUAS';
        $this->view('home/index', $data);
    }
}

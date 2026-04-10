<?php
class Auth extends Controller {
    public function index() {
        if(isset($_SESSION['user_ses'])) {
            $this->redirect('dashboard');
        }

        $data['judul'] = 'Login | Aplikasi Perpus';
        $this->view('templates/header_auth', $data);
        $this->view('auth/login', $data);
        $this->view('templates/footer_auth');
    }

    public function proses_login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->model('Auth_model')->getUserByUsername($username);

            if ($user) {
                if (password_verify($password, $user['password'])) {
                    // Berhasil login
                    $_SESSION['user_ses'] = [
                        'id' => $user['id_user'],
                        'nama' => $user['nama'],
                        'username' => $user['username'],
                        'role' => $user['role']
                    ];
                    $this->redirect('dashboard');
                } else {
                    Flasher::setFlash('Password salah!', 'Gagal Login', 'danger');
                    $this->redirect('auth');
                }
            } else {
                Flasher::setFlash('Username tidak ditemukan!', 'Gagal Login', 'danger');
                $this->redirect('auth');
            }
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        $this->redirect('auth');
    }
}

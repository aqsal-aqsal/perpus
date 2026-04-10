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
        
        $dashboardModel = $this->model('Dashboard_model');
        
        if ($data['user']['role'] == 'admin' || $data['user']['role'] == 'staff') {
            $data['stats'] = $dashboardModel->getAdminStats();
            $data['recent'] = $dashboardModel->getRecentActivities();
        } else {
            $data['stats'] = $dashboardModel->getUserStats($data['user']['id']);
            
            // Auto-check for reminders (H-2)
            $peminjamanModel = $this->model('Peminjaman_model');
            $reminders = $peminjamanModel->checkReminders();
            $notifModel = $this->model('Notifikasi_model');
            
            foreach($reminders as $r) {
                if ($r['id_user'] == $data['user']['id']) {
                    // Check if notification already exists to avoid duplicates
                    $notifModel->create($r['id_user'], 'Pengingat Pengembalian', "Buku '{$r['judul']}' harus dikembalikan dalam 2 hari lagi.");
                }
            }
        }
        
        $data['notif_count'] = $this->model('Notifikasi_model')->getUnreadCount($data['user']['id']);
        
        $this->view('templates/header', $data);
        $this->view('templates/sidebar', $data);
        $this->view('dashboard/index', $data);
        $this->view('templates/footer');
    }
}

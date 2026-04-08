<?php 
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : 'dashboard';
$url = explode('/', $url);
$active = strtolower($url[0]); 
?>
<!-- Sidebar -->
<aside class="w-64 bg-white border-r border-slate-200 flex flex-col h-full shadow-sm hidden md:flex z-10 transition-all duration-300">
    <div class="h-16 flex items-center px-6 border-b border-slate-100">
        <img src="<?= BASEURL; ?>/public/img/logo-kapuas.png" alt="Logo" class="w-8 h-8 object-contain mr-3">
        <span class="text-xl font-extrabold tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-blue-600 to-indigo-600">E-Perpus</span>
    </div>
    
    <div class="flex-1 overflow-y-auto py-4 px-3">
        <ul class="space-y-1">
            <li>
                <a href="<?= BASEURL; ?>/dashboard" class="flex items-center px-3 py-2.5 rounded-xl font-semibold transition-colors <?= ($active == 'dashboard') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600'; ?>">
                    <i class="ph ph-squares-four text-xl mr-3"></i>
                    Dashboard
                </a>
            </li>
            
            <li class="pt-4 pb-2">
                <p class="px-3 text-[10px] font-bold uppercase tracking-widest text-slate-400">Master Data</p>
            </li>
            
            <li>
                <a href="<?= BASEURL; ?>/buku" class="flex items-center px-3 py-2.5 rounded-xl font-semibold transition-colors <?= ($active == 'buku') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600'; ?>">
                    <i class="ph ph-books text-xl mr-3"></i>
                    Kelola Buku
                </a>
            </li>
            <li>
                <a href="<?= BASEURL; ?>/anggota" class="flex items-center px-3 py-2.5 rounded-xl font-semibold transition-colors <?= ($active == 'anggota') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600'; ?>">
                    <i class="ph ph-users text-xl mr-3"></i>
                    Data Anggota
                </a>
            </li>
            
            <li class="pt-4 pb-2">
                <p class="px-3 text-[10px] font-bold uppercase tracking-widest text-slate-400">Transaksi</p>
            </li>
            
            <li>
                <a href="<?= BASEURL; ?>/peminjaman" class="flex items-center px-3 py-2.5 rounded-xl font-semibold transition-colors <?= ($active == 'peminjaman') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600'; ?>">
                    <i class="ph ph-hand-coins text-xl mr-3"></i>
                    Peminjaman
                </a>
                </a>
            </li>
            
            <li class="pt-4 pb-2">
                <p class="px-3 text-[10px] font-bold uppercase tracking-widest text-slate-400">Properti Sistem</p>
            </li>
            
            <li>
                <a href="<?= BASEURL; ?>/kategori" class="flex items-center px-3 py-2.5 rounded-xl font-semibold transition-colors <?= ($active == 'kategori') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600'; ?>">
                    <i class="ph ph-list-dashes text-xl mr-3"></i>
                    Kategori Buku
                </a>
            </li>
            <li>
                <a href="<?= BASEURL; ?>/petugas" class="flex items-center px-3 py-2.5 rounded-xl font-semibold transition-colors <?= ($active == 'petugas') ? 'bg-blue-50 text-blue-700' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600'; ?>">
                    <i class="ph ph-user-gear text-xl mr-3"></i>
                    Manajemen Petugas
                </a>
            </li>
        </ul>
    </div>
    
    <div class="p-4 border-t border-slate-100">
        <div class="flex items-center p-3 text-sm bg-slate-50 rounded-xl mb-3 border border-slate-100">
            <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-blue-500 to-indigo-500 flex items-center justify-center text-white font-bold mr-3 shadow-md shadow-blue-500/20">
                <?= substr($data['user']['nama'], 0, 1); ?>
            </div>
            <div class="overflow-hidden">
                <p class="font-bold text-slate-700 truncate text-[13px]"><?= $data['user']['nama']; ?></p>
                <p class="text-[11px] text-slate-500 capitalize tracking-wide font-medium"><?= $data['user']['level']; ?></p>
            </div>
        </div>
        <a href="<?= BASEURL; ?>/auth/logout" class="flex items-center justify-center w-full px-4 py-2.5 text-red-600 bg-red-50 hover:bg-red-100 font-semibold rounded-xl transition-colors">
            <i class="ph ph-sign-out text-lg mr-2"></i> Keluar
        </a>
    </div>
</aside>

<!-- Main Wrapper -->
<div class="flex-1 flex flex-col h-full relative overflow-hidden">
    <!-- Navbar -->
    <header class="h-16 bg-white/80 backdrop-blur-md border-b border-slate-200 flex items-center justify-between px-6 z-10">
        <div class="flex items-center">
            <button class="md:hidden text-slate-500 hover:text-blue-600 focus:outline-none bg-slate-50 p-2 rounded-lg">
                <i class="ph ph-list text-2xl"></i>
            </button>
            <h2 class="text-xl font-bold text-slate-800 ml-4 md:ml-0"><?= explode(" |", $data['judul'])[0]; ?></h2>
        </div>
        <div class="flex items-center gap-4">
            <button class="text-slate-400 hover:text-blue-600 bg-slate-50 p-2 rounded-full relative transition-colors border border-slate-100">
                <i class="ph ph-bell text-xl"></i>
                <span class="absolute top-1.5 right-2 w-2 h-2 bg-red-500 rounded-full ring-2 ring-white"></span>
            </button>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-1 overflow-y-auto bg-slate-50 p-6 md:p-8 relative">
        <?php Flasher::flash(); ?>

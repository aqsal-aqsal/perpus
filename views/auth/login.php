<div class="w-full max-w-md p-4">
    <div class="bg-white shadow-2xl rounded-3xl mx-auto px-8 pt-8 pb-8 mb-4 relative overflow-hidden ring-1 ring-gray-900/5">
        <!-- Decorative blobs -->
        <div class="absolute -top-24 -right-24 w-48 h-48 bg-blue-500 rounded-full mix-blend-multiply filter blur-2xl opacity-20 animate-blob"></div>
        <div class="absolute -bottom-24 -left-24 w-48 h-48 bg-indigo-500 rounded-full mix-blend-multiply filter blur-2xl opacity-20 animate-blob animation-delay-2000"></div>
        
        <div class="text-center mb-8 relative z-10 pt-4">
            <h1 class="text-4xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-indigo-600 mb-2">E-Perpus</h1>
            <p class="text-slate-500 text-sm font-medium">Masuk untuk mengelola perpustakaan</p>
        </div>

        <div class="relative z-10">
            <?php Flasher::flash(); ?>
        </div>

        <form action="<?= BASEURL; ?>/auth/proses_login" method="post" class="relative z-10 mt-6">
            <div class="mb-5">
                <label class="block text-slate-700 text-sm font-bold mb-2 ml-1" for="username">
                    Username
                </label>
                <input class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 outline-none transition-all duration-200 text-slate-700" id="username" name="username" type="text" placeholder="Masukkan username" required autocomplete="off">
            </div>
            <div class="mb-8">
                <label class="block text-slate-700 text-sm font-bold mb-2 ml-1" for="password">
                    Password
                </label>
                <input class="w-full px-4 py-3 rounded-xl bg-slate-50 border border-slate-200 focus:border-blue-500 focus:bg-white focus:ring-2 focus:ring-blue-200 outline-none transition-all duration-200 text-slate-700" id="password" name="password" type="password" placeholder="Masukkan password" required>
            </div>
            <div class="flex items-center justify-between mb-2">
                <button class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-3.5 px-4 rounded-xl shadow-lg shadow-blue-500/30 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 transform hover:-translate-y-0.5 active:translate-y-0" type="submit">
                    Masuk Sekarang
                </button>
            </div>
        </form>
    <div class="mt-8 text-center relative z-10">
        <a href="<?= BASEURL; ?>" class="text-slate-400 hover:text-blue-600 text-sm font-medium transition-all duration-200 flex items-center justify-center gap-2 group">
            <i class="ph ph-arrow-left transition-transform duration-200 group-hover:-translate-x-1"></i>
            Kembali ke Beranda
        </a>
    </div>

    <p class="text-center text-slate-400 text-xs mt-8 font-medium">
        &copy; <?= date('Y'); ?> Aplikasi Perpustakaan Digital.<br>All rights reserved.
    </p>
</div>

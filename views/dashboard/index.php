<div class="mb-8">
    <h3 class="text-2xl font-bold text-slate-800 mb-1">Selamat Datang, <?= $data['user']['nama']; ?>! 👋</h3>
    <p class="text-slate-500 text-sm">Berikut adalah ringkasan perpustakaan untuk Anda.</p>
</div>

<?php if ($data['user']['role'] == 'admin' || $data['user']['role'] == 'staff'): ?>
    <!-- Admin/Staff Stats Card -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Card 1 -->
        <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm hover:shadow-md transition-all duration-300 relative overflow-hidden group hover:-translate-y-1">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-blue-50 rounded-full group-hover:scale-125 transition-transform duration-500 opacity-50"></div>
            <div class="flex items-center justify-between relative z-10">
                <div>
                    <p class="text-[11px] font-bold tracking-widest text-slate-400 uppercase mb-1">Total Buku</p>
                    <h4 class="text-3xl font-extrabold text-slate-800 mb-1"><?= $data['stats']['total_buku'] ?></h4>
                    <p class="text-[11px] text-emerald-600 font-semibold flex items-center bg-emerald-50 w-fit px-2 py-0.5 rounded-full">
                        <i class="ph-bold ph-trend-up mr-1"></i> Tersedia
                    </p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-blue-500 to-indigo-600 text-white flex items-center justify-center shadow-lg shadow-blue-500/30">
                    <i class="ph-fill ph-books text-3xl"></i>
                </div>
            </div>
        </div>
        
        <!-- Card 2 -->
        <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm hover:shadow-md transition-all duration-300 relative overflow-hidden group hover:-translate-y-1">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-indigo-50 rounded-full group-hover:scale-125 transition-transform duration-500 opacity-50"></div>
            <div class="flex items-center justify-between relative z-10">
                <div>
                    <p class="text-[11px] font-bold tracking-widest text-slate-400 uppercase mb-1">Anggota</p>
                    <h4 class="text-3xl font-extrabold text-slate-800 mb-1"><?= $data['stats']['total_anggota'] ?></h4>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-indigo-500 to-purple-600 text-white flex items-center justify-center shadow-lg shadow-indigo-500/30">
                    <i class="ph-fill ph-users-three text-3xl"></i>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm hover:shadow-md transition-all duration-300 relative overflow-hidden group hover:-translate-y-1">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-orange-50 rounded-full group-hover:scale-125 transition-transform duration-500 opacity-50"></div>
            <div class="flex items-center justify-between relative z-10">
                <div>
                    <p class="text-[11px] font-bold tracking-widest text-slate-400 uppercase mb-1">Dipinjam</p>
                    <h4 class="text-3xl font-extrabold text-slate-800 mb-1"><?= $data['stats']['total_dipinjam'] ?></h4>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-orange-400 to-red-500 text-white flex items-center justify-center shadow-lg shadow-orange-500/30">
                    <i class="ph-fill ph-hand-coins text-3xl"></i>
                </div>
            </div>
        </div>

        <!-- Card 4 -->
        <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm hover:shadow-md transition-all duration-300 relative overflow-hidden group hover:-translate-y-1">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-red-50 rounded-full group-hover:scale-125 transition-transform duration-500 opacity-50"></div>
            <div class="flex items-center justify-between relative z-10">
                <div>
                    <p class="text-[11px] font-bold tracking-widest text-slate-400 uppercase mb-1">Tenggat</p>
                    <h4 class="text-3xl font-extrabold text-slate-800 mb-1"><?= $data['stats']['total_terlambat'] ?></h4>
                    <p class="text-[11px] text-red-600 font-semibold flex items-center bg-red-50 w-fit px-2 py-0.5 rounded-full">
                        <i class="ph-bold ph-warning-circle mr-1"></i> Terlambat
                    </p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-gradient-to-tr from-rose-500 to-pink-600 text-white flex items-center justify-center shadow-lg shadow-rose-500/30">
                    <i class="ph-fill ph-calendar-x text-3xl"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-100 p-6 shadow-sm relative overflow-hidden">
        <div class="flex items-center justify-between mb-6">
            <h4 class="font-extrabold text-slate-800 lg:text-lg">Aktivitas Terbaru</h4>
            <a href="<?= BASEURL; ?>/peminjaman" class="text-xs text-blue-600 font-bold hover:underline px-3 py-1.5 bg-blue-50 rounded-lg">Lihat Semua</a>
        </div>
        
        <?php if (empty($data['recent'])): ?>
            <div class="text-center py-12 bg-slate-50/50 rounded-xl border border-dashed border-slate-200">
                <i class="ph ph-ghost text-4xl text-slate-300 mb-4"></i>
                <p class="text-slate-600 font-bold">Belum ada aktivitas tercatat</p>
            </div>
        <?php else: ?>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-slate-400 text-[11px] uppercase tracking-widest border-b border-slate-50">
                            <th class="pb-3 font-bold">Peminjam</th>
                            <th class="pb-3 font-bold">Buku</th>
                            <th class="pb-3 font-bold">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        <?php foreach($data['recent'] as $r): ?>
                            <tr class="text-sm">
                                <td class="py-4 font-bold text-slate-700"><?= $r['nama_user'] ?></td>
                                <td class="py-4 text-slate-500"><?= $r['judul'] ?></td>
                                <td class="py-4">
                                    <span class="px-2 py-1 rounded-lg text-[10px] font-bold uppercase <?= $r['status'] == 'booking' ? 'bg-orange-50 text-orange-600' : 'bg-blue-50 text-blue-600' ?>">
                                        <?= $r['status'] ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

<?php else: ?>
    <!-- User/Peminjam Dashboard -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-3xl p-8 text-white shadow-xl shadow-blue-500/20 relative overflow-hidden group">
             <i class="ph-fill ph-books absolute -right-4 -bottom-4 text-8xl opacity-10 group-hover:scale-110 transition-transform"></i>
             <p class="text-blue-100 text-sm font-medium mb-1">Sedang Dipinjam</p>
             <h4 class="text-5xl font-black mb-4"><?= $data['stats']['sedang_pinjam'] ?></h4>
             <a href="<?= BASEURL; ?>/history" class="inline-flex items-center text-xs font-bold bg-white/20 hover:bg-white/30 px-4 py-2 rounded-xl backdrop-blur-md transition-all">
                Cek Riwayat <i class="ph ph-arrow-right ml-2"></i>
             </a>
        </div>

        <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm hover:shadow-md transition-all">
             <div class="w-12 h-12 bg-orange-50 rounded-2xl flex items-center justify-center text-orange-600 mb-4">
                <i class="ph ph-calendar-check text-2xl"></i>
             </div>
             <p class="text-slate-400 text-sm font-medium mb-1">Booking Menunggu</p>
             <h4 class="text-4xl font-black text-slate-800"><?= $data['stats']['booking_aktif'] ?></h4>
        </div>

        <div class="bg-white rounded-3xl p-8 border border-slate-100 shadow-sm hover:shadow-md transition-all">
             <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 mb-4">
                <i class="ph ph-book-open text-2xl"></i>
             </div>
             <p class="text-slate-400 text-sm font-medium mb-1">Total Dibaca</p>
             <h4 class="text-4xl font-black text-slate-800"><?= $data['stats']['total_riwayat'] ?></h4>
        </div>
    </div>

    <div class="bg-white rounded-3xl border border-slate-100 p-8 shadow-sm">
        <div class="flex flex-col md:flex-row items-center gap-8">
            <div class="w-32 h-32 flex-shrink-0 bg-blue-50 rounded-full flex items-center justify-center">
                <i class="ph ph-sparkle text-5xl text-blue-500"></i>
            </div>
            <div>
                <h4 class="text-2xl font-bold text-slate-800 mb-2">Siap untuk membaca lagi?</h4>
                <p class="text-slate-500 mb-6">Ribuan koleksi buku terbaru sudah menunggu untuk kamu eksplorasi. Yuk, cek katalog dan booking buku favoritmu!</p>
                <a href="<?= BASEURL; ?>/catalog" class="inline-block bg-blue-600 text-white font-bold px-8 py-3.5 rounded-2xl shadow-lg shadow-blue-500/20 hover:bg-blue-700 transition-all active:scale-95">
                    Lihat Katalog Sekarang
                </a>
            </div>
        </div>
    </div>
<?php endif; ?>

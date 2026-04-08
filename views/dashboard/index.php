<div class="mb-8">
    <h3 class="text-2xl font-bold text-slate-800 mb-1">Selamat Datang, <?= $data['user']['nama']; ?>! 👋</h3>
    <p class="text-slate-500 text-sm">Berikut adalah ringkasan sistem perpustakaan hari ini.</p>
</div>

<!-- Stats Card -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Card 1 -->
    <div class="bg-white rounded-2xl p-6 border border-slate-100 shadow-sm hover:shadow-md transition-all duration-300 relative overflow-hidden group hover:-translate-y-1">
        <div class="absolute -right-6 -top-6 w-24 h-24 bg-blue-50 rounded-full group-hover:scale-125 transition-transform duration-500 opacity-50"></div>
        <div class="flex items-center justify-between relative z-10">
            <div>
                <p class="text-[11px] font-bold tracking-widest text-slate-400 uppercase mb-1">Total Buku</p>
                <h4 class="text-3xl font-extrabold text-slate-800 mb-1">210</h4>
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
                <h4 class="text-3xl font-extrabold text-slate-800 mb-1">54</h4>
                <p class="text-[11px] text-blue-600 font-semibold flex items-center bg-blue-50 w-fit px-2 py-0.5 rounded-full">
                    <i class="ph-bold ph-users mr-1"></i> Terdaftar
                </p>
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
                <h4 class="text-3xl font-extrabold text-slate-800 mb-1">12</h4>
                <p class="text-[11px] text-orange-600 font-semibold flex items-center bg-orange-50 w-fit px-2 py-0.5 rounded-full">
                    <i class="ph-bold ph-clock cursor mr-1"></i> Sedang pinjam
                </p>
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
                <h4 class="text-3xl font-extrabold text-slate-800 mb-1">3</h4>
                <p class="text-[11px] text-red-600 font-semibold flex items-center bg-red-50 w-fit px-2 py-0.5 rounded-full">
                    <i class="ph-bold ph-warning-circle mr-1"></i> Belum kembali
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
        <h4 class="font-extrabold text-slate-800 lg:text-lg">Aktivitas Peminjaman Terbaru</h4>
        <button class="text-xs text-blue-600 font-bold hover:underline px-3 py-1.5 bg-blue-50 rounded-lg">Lihat Semua</button>
    </div>
    
    <div class="text-center py-12 bg-slate-50/50 rounded-xl border border-dashed border-slate-200">
        <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-sm border border-slate-100 relative">
            <div class="absolute inset-0 bg-blue-100 rounded-full animate-ping opacity-20"></div>
            <i class="ph ph-ghost text-3xl text-slate-300"></i>
        </div>
        <p class="text-slate-600 font-bold mb-1">Belum ada aktivitas tercatat</p>
        <p class="text-sm text-slate-400 font-medium">Transaksi peminjaman dan pengembalian akan muncul di sini secara realtime.</p>
    </div>
</div>

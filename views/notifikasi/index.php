<div class="container mx-auto max-w-3xl pb-10">
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800">Pusat Notifikasi</h1>
            <p class="text-slate-500">Informasi terbaru mengenai status pinjaman dan booking Anda.</p>
        </div>
        <i class="ph ph-bell-ringing text-4xl text-blue-500 bg-blue-50 p-4 rounded-3xl"></i>
    </div>

    <?php if (empty($data['notifikasi'])): ?>
        <div class="bg-white p-16 rounded-[40px] border border-dashed border-slate-200 text-center">
            <i class="ph ph-bell-slash text-5xl text-slate-200 mb-6"></i>
            <h2 class="text-xl font-bold text-slate-700">Tidak ada notifikasi</h2>
            <p class="text-slate-400">Semua pemberitahuan akan muncul di sini.</p>
        </div>
    <?php else: ?>
        <div class="space-y-4">
            <?php foreach($data['notifikasi'] as $n): ?>
                <div class="bg-white p-6 rounded-[32px] border <?= $n['is_read'] ? 'border-slate-100 opacity-75' : 'border-blue-100 bg-blue-50/20 ring-1 ring-blue-50' ?> flex gap-6 transition-all group">
                    <div class="w-12 h-12 rounded-2xl <?= $n['is_read'] ? 'bg-slate-100 text-slate-400' : 'bg-blue-600 text-white shadow-lg shadow-blue-500/30' ?> flex items-center justify-center flex-shrink-0">
                        <i class="ph ph-info text-2xl"></i>
                    </div>
                    
                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-1">
                            <h3 class="font-bold text-slate-800"><?= $n['judul'] ?></h3>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest"><?= date('d M, H:i', strtotime($n['created_at'])) ?></span>
                        </div>
                        <p class="text-slate-600 text-sm leading-relaxed mb-3"><?= $n['pesan'] ?></p>
                        
                        <?php if (!$n['is_read']): ?>
                            <a href="<?= BASEURL; ?>/notifikasi/read/<?= $n['id_notif'] ?>" class="text-[11px] font-bold text-blue-600 hover:text-blue-800 flex items-center gap-1">
                                Tandai sudah dibaca <i class="ph ph-check-circle"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

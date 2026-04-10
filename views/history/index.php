<div class="container mx-auto pb-10">
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-slate-800">Riwayat Peminjaman</h1>
        <p class="text-slate-500">Pantau status buku yang kamu booking atau sedang dipinjam.</p>
    </div>

    <?php if (empty($data['history'])): ?>
        <div class="bg-white p-12 rounded-[40px] border border-dashed border-slate-200 text-center">
            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="ph ph-clock-counter-clockwise text-4xl text-slate-300"></i>
            </div>
            <h2 class="text-2xl font-bold text-slate-700 mb-2">Belum ada riwayat</h2>
            <p class="text-slate-400 mb-8">Buku yang kamu pinjam atau booking akan muncul di sini.</p>
            <a href="<?= BASEURL; ?>/catalog" class="inline-block bg-blue-600 text-white font-bold px-8 py-3 rounded-2xl shadow-lg shadow-blue-500/20 hover:bg-blue-700 transition-all">
                Cek Katalog
            </a>
        </div>
    <?php else: ?>
        <div class="bg-white rounded-[40px] border border-slate-100 overflow-hidden shadow-sm">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 text-slate-400 text-[11px] uppercase tracking-widest">
                            <th class="px-8 py-5 font-bold">Buku</th>
                            <th class="px-8 py-5 font-bold">Tanggal</th>
                            <th class="px-8 py-5 font-bold">Status</th>
                            <th class="px-8 py-5 font-bold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        <?php foreach($data['history'] as $h): ?>
                            <tr class="group hover:bg-slate-50 transition-colors">
                                <td class="px-8 py-5">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-16 rounded-lg overflow-hidden flex-shrink-0 shadow-sm">
                                            <?php 
                                                $img = ($h['gambar']) ? BASEURL . '/public/img/buku/' . $h['gambar'] : 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80';
                                            ?>
                                            <img src="<?= $img ?>" class="w-full h-full object-cover">
                                        </div>
                                        <span class="font-bold text-slate-700 line-clamp-1"><?= $h['judul'] ?></span>
                                    </div>
                                </td>
                                <td class="px-8 py-5">
                                    <div class="flex flex-col">
                                        <span class="text-slate-700 font-bold text-sm"><?= date('d M Y', strtotime($h['tanggal_pinjam'])) ?></span>
                                        <span class="text-slate-400 text-[11px]">Tanggal Pinjam</span>
                                    </div>
                                </td>
                                <td class="px-8 py-5">
                                    <?php 
                                        $statusClasses = [
                                            'booking' => 'bg-orange-50 text-orange-600',
                                            'dipinjam' => 'bg-blue-50 text-blue-600',
                                            'dikembalikan' => 'bg-emerald-50 text-emerald-600',
                                            'terlambat' => 'bg-red-50 text-red-600'
                                        ];
                                        $class = $statusClasses[$h['status']] ?? 'bg-slate-50 text-slate-600';
                                    ?>
                                    <span class="px-3 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-wider <?= $class ?>">
                                        <?= $h['status'] ?>
                                    </span>
                                </td>
                                <td class="px-8 py-5">
                                    <?php if ($h['status'] == 'booking'): ?>
                                        <p class="text-[10px] text-slate-400 font-medium max-w-[150px]">
                                            <i class="ph ph-info mr-1"></i> Bawa HP/Kartu ke perpus untuk verifikasi
                                        </p>
                                    <?php else: ?>
                                        <span class="text-slate-300">-</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
</div>

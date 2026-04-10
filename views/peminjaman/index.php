<div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8 gap-4">
    <div>
        <h3 class="text-2xl font-bold text-slate-800 mb-1">Transaksi Peminjaman</h3>
        <p class="text-slate-500 text-sm">Kelola proses sirkulasi peminjaman dan pengembalian buku.</p>
    </div>
    <button onclick="openModal('modalTambahPeminjaman')" class="bg-gradient-to-r from-orange-500 to-rose-500 hover:from-orange-600 hover:to-rose-600 text-white font-semibold py-2.5 px-5 rounded-xl shadow-lg shadow-orange-500/30 transition-all transform hover:-translate-y-0.5 flex items-center w-full sm:w-auto justify-center">
        <i class="ph-bold ph-plus mr-2 text-lg"></i> Transaksi Baru
    </button>
</div>

<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden relative">
    <!-- Header Tabel -->
    <div class="p-6 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4 bg-slate-50/50">
        <div class="relative w-full md:max-w-md">
            <i class="ph ph-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-lg"></i>
            <input type="text" placeholder="Cari id transaksi atau info anggota..." class="w-full pl-11 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl focus:outline-none focus:border-orange-500 focus:ring-2 focus:ring-orange-100 transition-all text-sm font-medium text-slate-700 placeholder-slate-400 disabled:opacity-50" autocomplete="off">
        </div>
        <button class="text-slate-600 hover:text-orange-600 font-medium text-sm flex items-center justify-center rounded-xl border border-slate-200 px-4 py-2.5 bg-white hover:bg-orange-50 hover:border-orange-200 transition-colors w-full md:w-auto">
            <i class="ph ph-funnel mr-2 text-lg text-slate-400"></i> Filter Status
        </button>
    </div>

    <!-- Wrapper Tabel -->
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse whitespace-nowrap min-w-max">
            <thead>
                <tr class="text-slate-400 text-[11px] uppercase tracking-wider font-bold border-b border-slate-100 bg-white">
                    <th class="px-6 py-5 w-16 text-center">ID Trx</th>
                    <th class="px-6 py-5">Identitas Peminjam</th>
                    <th class="px-6 py-5">Periode Pinjam</th>
                    <th class="px-6 py-5 text-center">Status</th>
                    <th class="px-6 py-5 w-32 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50 text-sm">
                <?php if (empty($data['peminjaman'])) : ?>
                <tr>
                    <td colspan="5" class="px-6 py-16 text-center text-slate-500 bg-slate-50/30">
                        <div class="mx-auto w-16 h-16 bg-white shadow-sm border border-slate-100 rounded-full flex items-center justify-center mb-4 relative">
                            <div class="absolute inset-0 rounded-full border-2 border-slate-100 border-dashed animate-[spin_10s_linear_infinite]"></div>
                            <i class="ph ph-hand-coins text-3xl text-slate-300"></i>
                        </div>
                        <p class="font-bold text-slate-600 text-base mb-1">Belum ada transaksi peminjaman.</p>
                        <p class="text-sm text-slate-400 max-w-sm mx-auto">Riwayat sirkulasi peminjaman dan pengembalian buku akan terekam di sini.</p>
                    </td>
                </tr>
                <?php else : ?>
                <?php foreach ($data['peminjaman'] as $p) : ?>
                    <tr class="hover:bg-orange-50/30 transition-colors group cursor-default">
                        <td class="px-6 py-4 text-center">
                            <div class="text-[11px] font-bold text-slate-500 bg-slate-50 px-2.5 py-1.5 rounded w-fit mx-auto border border-slate-200 shadow-[0_2px_0_0_rgba(226,232,240,1)]">
                                TR-<?= str_pad($p['id_peminjaman'], 4, '0', STR_PAD_LEFT); ?>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-bold text-slate-800 group-hover:text-orange-600 transition-colors">
                                <?= $p['nama_anggota'] ?: '<span class="text-slate-400 italic">User</span>'; ?>
                            </div>
                            <div class="text-xs font-medium text-slate-500 mt-1 truncate max-w-xs">
                                <i class="ph ph-book text-slate-400 mr-1"></i> <?= $p['judul']; ?>
                            </div>
                        </td>
                        <td class="px-6 py-4 font-medium text-slate-600">
                            <?php if ($p['status'] == 'booking'): ?>
                                <span class="text-xs text-orange-500 font-bold italic">Menunggu Diambil</span>
                            <?php else: ?>
                                <div class="flex items-center gap-1.5 mb-1 text-xs">
                                    <i class="ph-bold ph-calendar-plus text-emerald-500"></i> <?= date('d M Y', strtotime($p['tanggal_pinjam'])) ?>
                                </div>
                                <div class="flex items-center gap-1.5 text-xs text-rose-500">
                                    <i class="ph-bold ph-calendar-check"></i> <span class="font-bold"><?= $p['batas_kembali'] ? date('d M Y', strtotime($p['batas_kembali'])) : '-'; ?></span>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <?php if ($p['status'] == 'booking'): ?>
                                <span class="bg-orange-50 text-orange-700 px-3 py-1.5 rounded-full font-bold text-xs border border-orange-100 shadow-sm flex items-center justify-center w-fit mx-auto">
                                    Booking
                                </span>
                            <?php elseif ($p['status'] == 'dipinjam'): ?>
                                <span class="bg-blue-50 text-blue-700 px-3 py-1.5 rounded-full font-bold text-xs border border-blue-100 shadow-sm flex items-center justify-center w-fit mx-auto">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500 mr-1.5 animate-pulse"></span> Dipinjam
                                </span>
                            <?php elseif ($p['status'] == 'terlambat'): ?>
                                <span class="bg-red-50 text-red-700 px-3 py-1.5 rounded-full font-bold text-xs border border-red-100 shadow-sm flex items-center justify-center w-fit mx-auto">
                                    Terlambat
                                </span>
                            <?php else: ?>
                                <span class="bg-emerald-50 text-emerald-700 px-3 py-1.5 rounded-full font-bold text-xs border border-emerald-100 shadow-sm flex items-center justify-center w-fit mx-auto">
                                    <i class="ph-bold ph-check mr-1"></i> Kembali
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2 opacity-100 md:opacity-0 group-hover:opacity-100 transition-opacity">
                                <?php if ($p['status'] == 'booking'): ?>
                                    <button onclick="verifikasiBooking('<?= $p['id_peminjaman']; ?>')" class="px-4 py-2 rounded-xl bg-orange-500 text-white text-xs font-bold hover:bg-orange-600 transition-all shadow-md shadow-orange-500/20" title="Verifikasi Pengambilan">
                                        Verifikasi <i class="ph ph-check-circle ml-1"></i>
                                    </button>
                                <?php elseif ($p['status'] == 'dipinjam' || $p['status'] == 'terlambat'): ?>
                                    <button onclick="prosesKembali('<?= $p['id_peminjaman']; ?>')" class="w-9 h-9 rounded-xl bg-white border border-slate-200 text-slate-500 hover:bg-emerald-50 hover:text-emerald-600 hover:border-emerald-200 flex items-center justify-center transition-all shadow-sm border-b-2" title="Proses Pengembalian">
                                        <i class="ph-bold ph-check-square-offset text-sm"></i>
                                    </button>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Footer Tabel / Pagination Placeholder -->
    <div class="p-4 border-t border-slate-100 bg-slate-50/50 flex flex-col sm:flex-row sm:items-center justify-between gap-4 text-sm">
        <p class="text-slate-500 font-medium">Menampilkan <span class="font-bold text-slate-800"><?= count($data['peminjaman']); ?></span> laporan transaksi.</p>
        
        <div class="flex gap-1">
            <button class="w-8 h-8 rounded-lg border border-slate-200 flex items-center justify-center text-slate-400 bg-white cursor-not-allowed border-b-2">
                <i class="ph-bold ph-caret-left"></i>
            </button>
            <button class="w-8 h-8 rounded-lg border border-orange-500 flex items-center justify-center text-white bg-orange-500 font-bold border-b-2 shadow-sm shadow-orange-500/20">
                1
            </button>
            <button class="w-8 h-8 rounded-lg border border-slate-200 flex items-center justify-center text-slate-600 bg-white hover:bg-slate-50 transition-colors border-b-2">
                <i class="ph-bold ph-caret-right"></i>
            </button>
        </div>
    </div>
</div>

<!-- MODAL TRANSAKSI BARU -->
<div id="modalTambahPeminjaman" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 sm:p-0">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeModal('modalTambahPeminjaman')"></div>
    <div class="bg-white rounded-2xl w-full max-w-lg shadow-2xl overflow-hidden transform scale-95 opacity-0 translate-y-4 transition-all duration-300 relative z-10 flex flex-col max-h-[90vh]">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
            <h3 class="font-bold text-lg text-slate-800">Catat Transaksi Peminjaman</h3>
            <button type="button" onclick="closeModal('modalTambahPeminjaman')" class="text-slate-400 hover:text-red-500 transition-colors">
                <i class="ph-bold ph-x text-xl"></i>
            </button>
        </div>
        <div class="p-6 overflow-y-auto">
            <form action="<?= BASEURL; ?>/peminjaman/tambah" method="POST">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Anggota Peminjam</label>
                        <select name="id_anggota" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-orange-100 focus:border-orange-500 outline-none transition-all">
                            <option value="">Cari member...</option>
                            <?php foreach ($data['anggota'] as $a): ?>
                                <option value="<?= $a['id_user']; ?>"><?= $a['nama']; ?> ( <?= $a['email']; ?> )</option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Buku yang Dipinjam</label>
                        <select name="id_buku" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-orange-100 focus:border-orange-500 outline-none transition-all">
                            <option value="">Pilih judul buku...</option>
                            <?php foreach ($data['buku'] as $b): ?>
                                <?php if($b['stok'] > 0): ?>
                                    <option value="<?= $b['id_buku']; ?>"><?= $b['judul']; ?> - Tersisa: <?= $b['stok']; ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-1">Tanggal Pinjam</label>
                            <input type="date" name="tanggal_pinjam" required value="<?= date('Y-m-d'); ?>" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-orange-100 focus:border-orange-500 outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-1">Tenggat Kembali (7 Hari)</label>
                            <input type="date" name="tanggal_kembali" required value="<?= date('Y-m-d', strtotime('+7 days')); ?>" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-orange-100 focus:border-orange-500 outline-none transition-all">
                        </div>
                    </div>
                </div>
                <div class="mt-8 flex justify-end gap-3">
                    <button type="button" onclick="closeModal('modalTambahPeminjaman')" class="px-5 py-2.5 text-slate-500 bg-white border border-slate-200 hover:bg-slate-50 font-semibold rounded-xl transition-colors">Batal</button>
                    <button type="submit" class="px-5 py-2.5 text-white bg-orange-500 hover:bg-orange-600 font-semibold rounded-xl shadow-lg shadow-orange-500/30 transition-colors">Proses Peminjaman</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL INFO TRANSAKSI -->
<div id="modalInfoPeminjaman" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 sm:p-0">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeModal('modalInfoPeminjaman')"></div>
    <div class="bg-white rounded-2xl w-full max-w-lg shadow-2xl overflow-hidden transform scale-95 opacity-0 translate-y-4 transition-all duration-300 relative z-10 flex flex-col max-h-[90vh]">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
            <h3 class="font-bold text-lg text-slate-800">Detail Transaksi Peminjaman</h3>
            <button type="button" onclick="closeModal('modalInfoPeminjaman')" class="text-slate-400 hover:text-red-500 transition-colors">
                <i class="ph-bold ph-x text-xl"></i>
            </button>
        </div>
        <div class="p-6 overflow-y-auto">
            <p class="text-slate-500 text-sm mb-4">Ringkasan detail entri transaksi dan histori denda (Data dummy untuk mockup).</p>
            <div class="mt-8 flex justify-end gap-3">
                <button type="button" onclick="closeModal('modalInfoPeminjaman')" class="px-5 py-2.5 text-slate-500 bg-white border border-slate-200 hover:bg-slate-50 font-semibold rounded-xl transition-colors w-full">Tutup Detail</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL PROSES KEMBALI -->
<div id="modalKembaliPeminjaman" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 sm:p-0">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeModal('modalKembaliPeminjaman')"></div>
    <div class="bg-white rounded-2xl w-full max-w-md shadow-2xl overflow-hidden transform scale-95 opacity-0 translate-y-4 transition-all duration-300 relative z-10">
        <div class="p-6 text-center">
            <div class="w-16 h-16 rounded-full bg-emerald-100 text-emerald-500 flex items-center justify-center mx-auto mb-4">
                <i class="ph-fill ph-check-circle text-4xl"></i>
            </div>
            <h3 class="font-bold text-xl text-slate-800 mb-2">Proses Pengembalian?</h3>
            <p class="text-slate-500 text-sm mb-8">Anda akan mencatat bahwa buku spesifik pada transaksi ini telah dikembalikan oleh anggota perpustakaan.</p>
            
            <div class="flex justify-center gap-3">
                <button type="button" onclick="closeModal('modalKembaliPeminjaman')" class="px-5 py-2.5 text-slate-500 bg-white border border-slate-200 hover:bg-slate-50 font-semibold rounded-xl transition-colors w-full">Kembali</button>
                <a id="btnKembaliFinal" href="#" class="px-5 py-2.5 text-white bg-emerald-500 hover:bg-emerald-600 font-semibold rounded-xl shadow-lg shadow-emerald-500/30 transition-colors w-full flex items-center justify-center">Proses Finalisasi</a>
            </div>
        </div>
    </div>
</div>

<!-- MODAL VERIFIKASI BOOKING -->
<div id="modalVerifikasiBooking" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 sm:p-0">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeModal('modalVerifikasiBooking')"></div>
    <div class="bg-white rounded-2xl w-full max-w-md shadow-2xl overflow-hidden transform scale-95 opacity-0 translate-y-4 transition-all duration-300 relative z-10">
        <div class="p-6 text-center">
            <div class="w-16 h-16 rounded-full bg-orange-100 text-orange-500 flex items-center justify-center mx-auto mb-4">
                <i class="ph-fill ph-check-circle text-4xl"></i>
            </div>
            <h3 class="font-bold text-xl text-slate-800 mb-2">Verifikasi Pengambilan?</h3>
            <p class="text-slate-500 text-sm mb-8">Konfirmasi bahwa anggota telah mengambil buku secara fisik. Status akan berubah menjadi <b>Dipinjam</b>.</p>
            
            <div class="flex justify-center gap-3">
                <button type="button" onclick="closeModal('modalVerifikasiBooking')" class="px-5 py-2.5 text-slate-500 bg-white border border-slate-200 hover:bg-slate-50 font-semibold rounded-xl transition-colors w-full">Batal</button>
                <a id="btnVerifikasiFinal" href="#" class="px-5 py-2.5 text-white bg-orange-500 hover:bg-orange-600 font-semibold rounded-xl shadow-lg shadow-orange-500/30 transition-colors w-full flex items-center justify-center">Ya, Verifikasi</a>
            </div>
        </div>
    </div>
</div>

<script>
function prosesKembali(id) {
    document.getElementById('btnKembaliFinal').href = "<?= BASEURL; ?>/peminjaman/kembalikan/" + id;
    openModal('modalKembaliPeminjaman');
}

function verifikasiBooking(id) {
    document.getElementById('btnVerifikasiFinal').href = "<?= BASEURL; ?>/peminjaman/verifikasi/" + id;
    openModal('modalVerifikasiBooking');
}
</script>

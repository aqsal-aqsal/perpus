<div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8 gap-4">
    <div>
        <h3 class="text-2xl font-bold text-slate-800 mb-1">Manajemen Buku</h3>
        <p class="text-slate-500 text-sm">Kelola inventaris judul buku yang tersedia di perpustakaan.</p>
    </div>
    <button onclick="openModal('modalTambahBuku')" class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-2.5 px-5 rounded-xl shadow-lg shadow-blue-500/30 transition-all transform hover:-translate-y-0.5 flex items-center w-full sm:w-auto justify-center">
        <i class="ph-bold ph-plus mr-2 text-lg"></i> Tambah Buku Baru
    </button>
</div>

<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden relative">
    <!-- Header Tabel -->
    <div class="p-6 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4 bg-slate-50/50">
        <div class="relative w-full md:max-w-md">
            <i class="ph ph-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-lg"></i>
            <input type="text" placeholder="Cari judul, penulis, atau penerbit buku..." class="w-full pl-11 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all text-sm font-medium text-slate-700 placeholder-slate-400 disabled:opacity-50" autocomplete="off">
        </div>
        <button class="text-slate-600 hover:text-blue-600 font-medium text-sm flex items-center justify-center rounded-xl border border-slate-200 px-4 py-2.5 bg-white hover:bg-blue-50 hover:border-blue-200 transition-colors w-full md:w-auto">
            <i class="ph ph-funnel mr-2 text-lg text-slate-400"></i> Filter Data
        </button>
    </div>

    <!-- Wrapper Tabel -->
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse whitespace-nowrap min-w-max">
            <thead>
                <tr class="text-slate-400 text-[11px] uppercase tracking-wider font-bold border-b border-slate-100 bg-white">
                    <th class="px-6 py-5 w-16 text-center">Id</th>
                    <th class="px-6 py-5">Identitas Buku</th>
                    <th class="px-6 py-5">Kategori</th>
                    <th class="px-6 py-5">Penerbit</th>
                    <th class="px-6 py-5 w-24">Stok</th>
                    <th class="px-6 py-5 w-32 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50 text-sm">
                <?php if (empty($data['buku'])) : ?>
                <tr>
                    <td colspan="6" class="px-6 py-16 text-center text-slate-500 bg-slate-50/30">
                        <div class="mx-auto w-16 h-16 bg-white shadow-sm border border-slate-100 rounded-full flex items-center justify-center mb-4 relative">
                            <div class="absolute inset-0 rounded-full border-2 border-slate-100 border-dashed animate-[spin_10s_linear_infinite]"></div>
                            <i class="ph ph-books text-3xl text-slate-300"></i>
                        </div>
                        <p class="font-bold text-slate-600 text-base mb-1">Belum ada data buku.</p>
                        <p class="text-sm text-slate-400 max-w-sm mx-auto">Inventaris rak buku Anda masih kosong. Tekan tombol Tambah Buku Baru di atas untuk memulai.</p>
                    </td>
                </tr>
                <?php else : ?>
                    <?php foreach ($data['buku'] as $b) : ?>
                    <tr class="hover:bg-blue-50/30 transition-colors group cursor-default">
                        <td class="px-6 py-4">
                            <div class="text-xs font-bold text-slate-400 bg-slate-50 px-2 py-1 rounded w-fit text-center border border-slate-100">
                                #<?= str_pad($b['id_buku'], 3, '0', STR_PAD_LEFT); ?>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-bold text-slate-800 group-hover:text-blue-700 transition-colors">
                                <?= $b['judul']; ?>
                            </div>
                            <div class="text-xs font-medium text-slate-500 mt-1 flex items-center gap-1.5">
                                <i class="ph-fill ph-pen-nib text-slate-400"></i> <?= $b['penulis']; ?> 
                                <span class="w-1 h-1 bg-slate-300 rounded-full mx-1"></span> 
                                <?= $b['tahun_terbit']; ?>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 text-[11px] font-bold tracking-wide text-indigo-700 bg-indigo-50 border border-indigo-100 rounded-full w-fit flex gap-1 items-center">
                                <span class="w-1.5 h-1.5 bg-indigo-500 rounded-full"></span>
                                <?= $b['nama_kategori'] ?? 'Tanpa Kategori'; ?>
                            </span>
                        </td>
                        <td class="px-6 py-4 font-medium text-slate-600"><?= $b['penerbit']; ?></td>
                        <td class="px-6 py-4">
                            <?php if ($b['stok'] > 5): ?>
                                <span class="bg-emerald-50 text-emerald-700 px-2.5 py-1.5 rounded-lg font-bold text-[11px] border border-emerald-100 flex items-center w-fit">
                                    <i class="ph-bold ph-check text-emerald-500 mr-1.5"></i> <?= $b['stok']; ?>
                                </span>
                            <?php elseif ($b['stok'] > 0): ?>
                                <span class="bg-orange-50 text-orange-700 px-2.5 py-1.5 rounded-lg font-bold text-[11px] border border-orange-100 flex items-center w-fit">
                                    <i class="ph-bold ph-warning text-orange-500 mr-1.5"></i> <?= $b['stok']; ?>
                                </span>
                            <?php else: ?>
                                <span class="bg-red-50 text-red-700 px-2.5 py-1.5 rounded-lg font-bold text-[11px] border border-red-100 flex items-center w-fit">
                                    <i class="ph-bold ph-x text-red-500 mr-1.5"></i> Habis
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2 opacity-100 md:opacity-0 group-hover:opacity-100 transition-opacity">
                                <button onclick="editBuku('<?= $b['id_buku']; ?>', '<?= addslashes($b['judul']); ?>', '<?= addslashes($b['penulis']); ?>', '<?= addslashes($b['penerbit']); ?>', '<?= $b['tahun_terbit']; ?>', '<?= $b['id_kategori'] ?? ''; ?>', '<?= $b['stok']; ?>')" class="w-9 h-9 rounded-xl bg-white border border-slate-200 text-slate-500 hover:bg-blue-50 hover:text-blue-600 hover:border-blue-200 flex items-center justify-center transition-all shadow-sm">
                                    <i class="ph-bold ph-pencil-simple text-sm"></i>
                                </button>
                                <button onclick="hapusBuku('<?= $b['id_buku']; ?>')" class="w-9 h-9 rounded-xl bg-white border border-slate-200 text-slate-500 hover:bg-red-50 hover:text-red-600 hover:border-red-200 flex items-center justify-center transition-all shadow-sm">
                                    <i class="ph-bold ph-trash text-sm"></i>
                                </button>
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
        <p class="text-slate-500 font-medium">Menampilkan <span class="font-bold text-slate-800"><?= count($data['buku']); ?></span> buku dari total inventaris.</p>
        
        <div class="flex gap-1">
            <button class="w-8 h-8 rounded-lg border border-slate-200 flex items-center justify-center text-slate-400 bg-white cursor-not-allowed">
                <i class="ph-bold ph-caret-left"></i>
            </button>
            <button class="w-8 h-8 rounded-lg border border-blue-500 flex items-center justify-center text-white bg-blue-600 font-bold">
                1
            </button>
            <button class="w-8 h-8 rounded-lg border border-slate-200 flex items-center justify-center text-slate-600 bg-white hover:bg-slate-50 transition-colors">
                <i class="ph-bold ph-caret-right"></i>
            </button>
        </div>
    </div>
</div>

<!-- MODAL TAMBAH BUKU -->
<div id="modalTambahBuku" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 sm:p-0">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeModal('modalTambahBuku')"></div>
    <div class="bg-white rounded-2xl w-full max-w-lg shadow-2xl overflow-hidden transform scale-95 opacity-0 translate-y-4 transition-all duration-300 relative z-10 flex flex-col max-h-[90vh]">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
            <h3 class="font-bold text-lg text-slate-800">Tambah Buku Baru</h3>
            <button type="button" onclick="closeModal('modalTambahBuku')" class="text-slate-400 hover:text-red-500 transition-colors">
                <i class="ph-bold ph-x text-xl"></i>
            </button>
        </div>
        <div class="p-6 overflow-y-auto">
            <form action="<?= BASEURL; ?>/buku/tambah" method="POST">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Judul Buku</label>
                        <input type="text" name="judul" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all" placeholder="Masukkan judul buku">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Penulis</label>
                        <input type="text" name="penulis" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all" placeholder="Nama penulis">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-1">Penerbit</label>
                            <input type="text" name="penerbit" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all" placeholder="Penerbit">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-1">Tahun Terbit</label>
                            <input type="number" name="tahun_terbit" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all" placeholder="YYYY">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-1">Kategori</label>
                            <select name="id_kategori" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all">
                                <option value="">Pilih Kategori</option>
                                <?php foreach ($data['kategori'] as $k): ?>
                                    <option value="<?= $k['id_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-1">Stok Awal</label>
                            <input type="number" name="stok" value="1" min="1" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all">
                        </div>
                    </div>
                </div>
                <div class="mt-8 flex justify-end gap-3">
                    <button type="button" onclick="closeModal('modalTambahBuku')" class="px-5 py-2.5 text-slate-500 bg-white border border-slate-200 hover:bg-slate-50 font-semibold rounded-xl transition-colors">Batal</button>
                    <button type="submit" class="px-5 py-2.5 text-white bg-blue-600 hover:bg-blue-700 font-semibold rounded-xl shadow-lg shadow-blue-500/30 transition-colors">Simpan Buku</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDIT BUKU -->
<div id="modalEditBuku" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 sm:p-0">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeModal('modalEditBuku')"></div>
    <div class="bg-white rounded-2xl w-full max-w-lg shadow-2xl overflow-hidden transform scale-95 opacity-0 translate-y-4 transition-all duration-300 relative z-10 flex flex-col max-h-[90vh]">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
            <h3 class="font-bold text-lg text-slate-800">Edit Data Buku</h3>
            <button type="button" onclick="closeModal('modalEditBuku')" class="text-slate-400 hover:text-red-500 transition-colors">
                <i class="ph-bold ph-x text-xl"></i>
            </button>
        </div>
        <div class="p-6 overflow-y-auto">
            <form action="<?= BASEURL; ?>/buku/edit" method="POST">
                <input type="hidden" name="id_buku" id="edit_id_buku">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Judul Buku</label>
                        <input type="text" name="judul" id="edit_judul" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Penulis</label>
                        <input type="text" name="penulis" id="edit_penulis" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-1">Penerbit</label>
                            <input type="text" name="penerbit" id="edit_penerbit" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-1">Tahun Terbit</label>
                            <input type="number" name="tahun_terbit" id="edit_tahun_terbit" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-1">Kategori</label>
                            <select name="id_kategori" id="edit_id_kategori" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all">
                                <option value="">Pilih Kategori</option>
                                <?php foreach ($data['kategori'] as $k): ?>
                                    <option value="<?= $k['id_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-1">Stok Awal</label>
                            <input type="number" name="stok" id="edit_stok" min="0" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all">
                        </div>
                    </div>
                </div>
                <div class="mt-8 flex justify-end gap-3">
                    <button type="button" onclick="closeModal('modalEditBuku')" class="px-5 py-2.5 text-slate-500 bg-white border border-slate-200 hover:bg-slate-50 font-semibold rounded-xl transition-colors">Batal</button>
                    <button type="submit" class="px-5 py-2.5 text-white bg-blue-600 hover:bg-blue-700 font-semibold rounded-xl shadow-lg shadow-blue-500/30 transition-colors">Perbarui</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL HAPUS BUKU -->
<div id="modalHapusBuku" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 sm:p-0">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeModal('modalHapusBuku')"></div>
    <div class="bg-white rounded-2xl w-full max-w-md shadow-2xl overflow-hidden transform scale-95 opacity-0 translate-y-4 transition-all duration-300 relative z-10">
        <div class="p-6 text-center">
            <div class="w-16 h-16 rounded-full bg-red-100 text-red-500 flex items-center justify-center mx-auto mb-4">
                <i class="ph-fill ph-warning-circle text-4xl"></i>
            </div>
            <h3 class="font-bold text-xl text-slate-800 mb-2">Hapus Buku?</h3>
            <p class="text-slate-500 text-sm mb-8">Apakah Anda yakin ingin menghapus data buku ini secara permanen? Data yang telah dihapus tidak dapat dikembalikan.</p>
            
            <div class="flex justify-center gap-3">
                <button type="button" onclick="closeModal('modalHapusBuku')" class="px-5 py-2.5 text-slate-500 bg-white border border-slate-200 hover:bg-slate-50 font-semibold rounded-xl transition-colors w-full">Batal</button>
                <a id="btnHapusBuku" href="#" class="px-5 py-2.5 text-white bg-red-500 hover:bg-red-600 font-semibold rounded-xl shadow-lg shadow-red-500/30 transition-colors w-full flex justify-center items-center">Hapus</a>
            </div>
        </div>
    </div>
</div>

<script>
function editBuku(id, judul, penulis, penerbit, tahun_terbit, id_kategori, stok) {
    document.getElementById('edit_id_buku').value = id;
    document.getElementById('edit_judul').value = judul;
    document.getElementById('edit_penulis').value = penulis;
    document.getElementById('edit_penerbit').value = penerbit;
    document.getElementById('edit_tahun_terbit').value = tahun_terbit;
    document.getElementById('edit_id_kategori').value = id_kategori;
    document.getElementById('edit_stok').value = stok;
    openModal('modalEditBuku');
}

function hapusBuku(id) {
    document.getElementById('btnHapusBuku').href = "<?= BASEURL; ?>/buku/hapus/" + id;
    openModal('modalHapusBuku');
}
</script>

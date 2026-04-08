<div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8 gap-4">
    <div>
        <h3 class="text-2xl font-bold text-slate-800 mb-1">Kategori Buku</h3>
        <p class="text-slate-500 text-sm">Kelola klasifikasi kategori untuk mempermudah pencarian buku.</p>
    </div>
    <button onclick="openModal('modalTambahKategori')" class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold py-2.5 px-5 rounded-xl shadow-lg shadow-blue-500/30 transition-all transform hover:-translate-y-0.5 flex items-center w-full sm:w-auto justify-center">
        <i class="ph-bold ph-plus mr-2 text-lg"></i> Kategori Baru
    </button>
</div>

<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden relative max-w-4xl">
    <!-- Header Tabel -->
    <div class="p-6 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4 bg-slate-50/50">
        <div class="relative w-full md:max-w-md">
            <i class="ph ph-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-lg"></i>
            <input type="text" placeholder="Cari nama kategori..." class="w-full pl-11 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition-all text-sm font-medium text-slate-700 placeholder-slate-400 disabled:opacity-50" autocomplete="off">
        </div>
    </div>

    <!-- Wrapper Tabel -->
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse whitespace-nowrap min-w-max">
            <thead>
                <tr class="text-slate-400 text-[11px] uppercase tracking-wider font-bold border-b border-slate-100 bg-white">
                    <th class="px-6 py-5 w-16 text-center">Id</th>
                    <th class="px-6 py-5">Nama Kategori</th>
                    <th class="px-6 py-5 w-32 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50 text-sm">
                <?php if (empty($data['kategori'])) : ?>
                <tr>
                    <td colspan="3" class="px-6 py-16 text-center text-slate-500 bg-slate-50/30">
                        <div class="mx-auto w-16 h-16 bg-white shadow-sm border border-slate-100 rounded-full flex items-center justify-center mb-4 relative">
                            <i class="ph ph-list-dashes text-3xl text-slate-300"></i>
                        </div>
                        <p class="font-bold text-slate-600 text-base mb-1">Belum ada kategori.</p>
                        <p class="text-sm text-slate-400 max-w-sm mx-auto">Tambahkan kategori untuk mengelompokkan koleksi buku perpustakaan.</p>
                    </td>
                </tr>
                <?php else : ?>
                    <?php foreach ($data['kategori'] as $k) : ?>
                    <tr class="hover:bg-blue-50/30 transition-colors group cursor-default">
                        <td class="px-6 py-4">
                            <div class="text-xs font-bold text-slate-400 bg-slate-50 px-2 py-1 rounded w-fit text-center border border-slate-100">
                                #<?= str_pad($k['id_kategori'], 3, '0', STR_PAD_LEFT); ?>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-bold text-slate-800 group-hover:text-blue-700 transition-colors">
                                <?= $k['nama_kategori']; ?>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2 opacity-100 md:opacity-0 group-hover:opacity-100 transition-opacity">
                                <button onclick="editKategori('<?= $k['id_kategori']; ?>', '<?= addslashes($k['nama_kategori']); ?>')" class="w-9 h-9 rounded-xl bg-white border border-slate-200 text-slate-500 hover:bg-blue-50 hover:text-blue-600 hover:border-blue-200 flex items-center justify-center transition-all shadow-sm border-b-2">
                                    <i class="ph-bold ph-pencil-simple text-sm"></i>
                                </button>
                                <button onclick="hapusKategori('<?= $k['id_kategori']; ?>')" class="w-9 h-9 rounded-xl bg-white border border-slate-200 text-slate-500 hover:bg-red-50 hover:text-red-600 hover:border-red-200 flex items-center justify-center transition-all shadow-sm border-b-2">
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
        <p class="text-slate-500 font-medium">Menampilkan <span class="font-bold text-slate-800"><?= count($data['kategori']); ?></span> kategori jenis buku.</p>
        
        <div class="flex gap-1">
            <button class="w-8 h-8 rounded-lg border border-slate-200 flex items-center justify-center text-slate-400 bg-white cursor-not-allowed border-b-2">
                <i class="ph-bold ph-caret-left"></i>
            </button>
            <button class="w-8 h-8 rounded-lg border border-blue-500 flex items-center justify-center text-white bg-blue-600 font-bold border-b-2 shadow-sm shadow-blue-500/20">
                1
            </button>
            <button class="w-8 h-8 rounded-lg border border-slate-200 flex items-center justify-center text-slate-600 bg-white hover:bg-slate-50 transition-colors border-b-2">
                <i class="ph-bold ph-caret-right"></i>
            </button>
        </div>
    </div>
</div>

<!-- MODAL TAMBAH KATEGORI -->
<div id="modalTambahKategori" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 sm:p-0">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeModal('modalTambahKategori')"></div>
    <div class="bg-white rounded-2xl w-full max-w-md shadow-2xl overflow-hidden transform scale-95 opacity-0 translate-y-4 transition-all duration-300 relative z-10 flex flex-col max-h-[90vh]">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
            <h3 class="font-bold text-lg text-slate-800">Tambah Kategori</h3>
            <button type="button" onclick="closeModal('modalTambahKategori')" class="text-slate-400 hover:text-red-500 transition-colors">
                <i class="ph-bold ph-x text-xl"></i>
            </button>
        </div>
        <div class="p-6 overflow-y-auto">
            <form action="<?= BASEURL; ?>/kategori/tambah" method="POST">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Nama Kategori</label>
                        <input type="text" name="nama_kategori" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all" placeholder="Contoh: Novel, Komik...">
                    </div>
                </div>
                <div class="mt-8 flex justify-end gap-3">
                    <button type="button" onclick="closeModal('modalTambahKategori')" class="px-5 py-2.5 text-slate-500 bg-white border border-slate-200 hover:bg-slate-50 font-semibold rounded-xl transition-colors">Batal</button>
                    <button type="submit" class="px-5 py-2.5 text-white bg-blue-600 hover:bg-blue-700 font-semibold rounded-xl shadow-lg shadow-blue-500/30 transition-colors">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDIT KATEGORI -->
<div id="modalEditKategori" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 sm:p-0">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeModal('modalEditKategori')"></div>
    <div class="bg-white rounded-2xl w-full max-w-md shadow-2xl overflow-hidden transform scale-95 opacity-0 translate-y-4 transition-all duration-300 relative z-10 flex flex-col max-h-[90vh]">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
            <h3 class="font-bold text-lg text-slate-800">Edit Kategori</h3>
            <button type="button" onclick="closeModal('modalEditKategori')" class="text-slate-400 hover:text-red-500 transition-colors">
                <i class="ph-bold ph-x text-xl"></i>
            </button>
        </div>
        <div class="p-6 overflow-y-auto">
            <form action="<?= BASEURL; ?>/kategori/edit" method="POST">
                <input type="hidden" name="id_kategori" id="edit_id_kategori">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Nama Kategori</label>
                        <input type="text" name="nama_kategori" id="edit_nama_kategori" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all">
                    </div>
                </div>
                <div class="mt-8 flex justify-end gap-3">
                    <button type="button" onclick="closeModal('modalEditKategori')" class="px-5 py-2.5 text-slate-500 bg-white border border-slate-200 hover:bg-slate-50 font-semibold rounded-xl transition-colors">Batal</button>
                    <button type="submit" class="px-5 py-2.5 text-white bg-blue-600 hover:bg-blue-700 font-semibold rounded-xl shadow-lg shadow-blue-500/30 transition-colors">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL HAPUS KATEGORI -->
<div id="modalHapusKategori" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 sm:p-0">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeModal('modalHapusKategori')"></div>
    <div class="bg-white rounded-2xl w-full max-w-sm shadow-2xl overflow-hidden transform scale-95 opacity-0 translate-y-4 transition-all duration-300 relative z-10">
        <div class="p-6 text-center">
            <div class="w-16 h-16 rounded-full bg-red-100 text-red-500 flex items-center justify-center mx-auto mb-4">
                <i class="ph-fill ph-warning-circle text-4xl"></i>
            </div>
            <h3 class="font-bold text-xl text-slate-800 mb-2">Hapus Kategori?</h3>
            <p class="text-slate-500 text-sm mb-8">Apakah Anda yakin ingin menghapus kategori ini? Pastikan kategori ini tidak sedang dipakai oleh data buku.</p>
            
            <div class="flex justify-center gap-3">
                <button type="button" onclick="closeModal('modalHapusKategori')" class="px-5 py-2.5 text-slate-500 bg-white border border-slate-200 hover:bg-slate-50 font-semibold rounded-xl transition-colors w-full">Batal</button>
                <a id="btnHapusKategori" href="#" class="px-5 py-2.5 text-white bg-red-500 hover:bg-red-600 font-semibold rounded-xl shadow-lg shadow-red-500/30 transition-colors w-full flex items-center justify-center">Hapus</a>
            </div>
        </div>
    </div>
</div>

<script>
function editKategori(id, nama) {
    document.getElementById('edit_id_kategori').value = id;
    document.getElementById('edit_nama_kategori').value = nama;
    openModal('modalEditKategori');
}

function hapusKategori(id) {
    document.getElementById('btnHapusKategori').href = "<?= BASEURL; ?>/kategori/hapus/" + id;
    openModal('modalHapusKategori');
}
</script>

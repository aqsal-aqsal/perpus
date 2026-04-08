<div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8 gap-4">
    <div>
        <h3 class="text-2xl font-bold text-slate-800 mb-1">Data Anggota</h3>
        <p class="text-slate-500 text-sm">Kelola data anggota perpustakaan yang terdaftar.</p>
    </div>
    <button onclick="openModal('modalTambahAnggota')" class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold py-2.5 px-5 rounded-xl shadow-lg shadow-indigo-500/30 transition-all transform hover:-translate-y-0.5 flex items-center w-full sm:w-auto justify-center">
        <i class="ph-bold ph-plus mr-2 text-lg"></i> Tambah Anggota Baru
    </button>
</div>

<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden relative">
    <!-- Header Tabel -->
    <div class="p-6 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4 bg-slate-50/50">
        <div class="relative w-full md:max-w-md">
            <i class="ph ph-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-lg"></i>
            <input type="text" placeholder="Cari nama, email atau no telepon..." class="w-full pl-11 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-100 transition-all text-sm font-medium text-slate-700 placeholder-slate-400 disabled:opacity-50" autocomplete="off">
        </div>
        <button class="text-slate-600 hover:text-indigo-600 font-medium text-sm flex items-center justify-center rounded-xl border border-slate-200 px-4 py-2.5 bg-white hover:bg-indigo-50 hover:border-indigo-200 transition-colors w-full md:w-auto">
            <i class="ph ph-funnel mr-2 text-lg text-slate-400"></i> Filter Data
        </button>
    </div>

    <!-- Wrapper Tabel -->
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse whitespace-nowrap min-w-max">
            <thead>
                <tr class="text-slate-400 text-[11px] uppercase tracking-wider font-bold border-b border-slate-100 bg-white">
                    <th class="px-6 py-5 w-16 text-center">Id</th>
                    <th class="px-6 py-5">Identitas Anggota</th>
                    <th class="px-6 py-5">Kontak</th>
                    <th class="px-6 py-5">Tanggal Daftar</th>
                    <th class="px-6 py-5 w-32 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50 text-sm">
                <?php if (empty($data['anggota'])) : ?>
                <tr>
                    <td colspan="5" class="px-6 py-16 text-center text-slate-500 bg-slate-50/30">
                        <div class="mx-auto w-16 h-16 bg-white shadow-sm border border-slate-100 rounded-full flex items-center justify-center mb-4 relative">
                            <div class="absolute inset-0 rounded-full border-2 border-slate-100 border-dashed animate-[spin_10s_linear_infinite]"></div>
                            <i class="ph ph-users text-3xl text-slate-300"></i>
                        </div>
                        <p class="font-bold text-slate-600 text-base mb-1">Belum ada data anggota.</p>
                        <p class="text-sm text-slate-400 max-w-sm mx-auto">Sistem belum memiliki catatan anggota yang terdaftar. Tekan tombol Tambah Anggota Baru untuk memulai.</p>
                    </td>
                </tr>
                <?php else : ?>
                    <?php foreach ($data['anggota'] as $a) : ?>
                    <tr class="hover:bg-indigo-50/30 transition-colors group cursor-default">
                        <td class="px-6 py-4">
                            <div class="text-xs font-bold text-slate-400 bg-slate-50 px-2 py-1 rounded w-fit text-center border border-slate-100">
                                #<?= str_pad($a['id_anggota'], 3, '0', STR_PAD_LEFT); ?>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-indigo-100 to-purple-100 text-indigo-600 flex items-center justify-center font-bold mr-3 border border-indigo-200 uppercase text-xs shadow-sm">
                                    <?= substr($a['nama'], 0, 2); ?>
                                </div>
                                <div>
                                    <div class="font-bold text-slate-800 group-hover:text-indigo-700 transition-colors">
                                        <?= $a['nama']; ?>
                                    </div>
                                    <div class="text-xs font-medium text-slate-500 mt-1 flex items-center gap-1.5 truncate max-w-xs">
                                        <i class="ph-fill ph-map-pin text-slate-400"></i> <?= $a['alamat'] ?: '-'; ?>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 font-medium text-slate-600">
                            <div class="flex items-center gap-1.5 mb-1 text-xs">
                                <i class="ph-fill ph-phone-call text-green-500"></i> <?= $a['no_telp'] ?: '-'; ?>
                            </div>
                            <div class="flex items-center gap-1.5 text-xs">
                                <i class="ph-fill ph-envelope-simple text-blue-500"></i> <?= $a['email'] ?: '-'; ?>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-slate-600 text-sm font-medium w-40">
                            <?= $a['tanggal_daftar'] ? date('d M Y', strtotime($a['tanggal_daftar'])) : '-'; ?>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2 opacity-100 md:opacity-0 group-hover:opacity-100 transition-opacity">
                                <a href="<?= BASEURL; ?>/pendaftaran/kartu/<?= $a['id_anggota']; ?>" target="_blank" class="w-9 h-9 rounded-xl bg-white border border-slate-200 text-slate-500 hover:bg-green-50 hover:text-green-600 hover:border-green-200 flex items-center justify-center transition-all shadow-sm border-b-2" title="Cetak Kartu">
                                    <i class="ph-bold ph-printer text-sm"></i>
                                </a>
                                <button onclick="editAnggota('<?= $a['id_anggota']; ?>', '<?= addslashes($a['nama']); ?>', '<?= addslashes($a['alamat']); ?>', '<?= addslashes($a['no_telp']); ?>', '<?= addslashes($a['email']); ?>', '<?= $a['tanggal_daftar']; ?>')" class="w-9 h-9 rounded-xl bg-white border border-slate-200 text-slate-500 hover:bg-indigo-50 hover:text-indigo-600 hover:border-indigo-200 flex items-center justify-center transition-all shadow-sm border-b-2" title="Edit">
                                    <i class="ph-bold ph-pencil-simple text-sm"></i>
                                </button>
                                <button onclick="hapusAnggota('<?= $a['id_anggota']; ?>')" class="w-9 h-9 rounded-xl bg-white border border-slate-200 text-slate-500 hover:bg-red-50 hover:text-red-600 hover:border-red-200 flex items-center justify-center transition-all shadow-sm border-b-2">
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
        <p class="text-slate-500 font-medium">Menampilkan <span class="font-bold text-slate-800"><?= count($data['anggota']); ?></span> anggota perpustakaan.</p>
        
        <div class="flex gap-1">
            <button class="w-8 h-8 rounded-lg border border-slate-200 flex items-center justify-center text-slate-400 bg-white cursor-not-allowed border-b-2">
                <i class="ph-bold ph-caret-left"></i>
            </button>
            <button class="w-8 h-8 rounded-lg border border-indigo-500 flex items-center justify-center text-white bg-indigo-600 font-bold border-b-2">
                1
            </button>
            <button class="w-8 h-8 rounded-lg border border-slate-200 flex items-center justify-center text-slate-600 bg-white hover:bg-slate-50 transition-colors border-b-2">
                <i class="ph-bold ph-caret-right"></i>
            </button>
        </div>
    </div>
</div>

<!-- MODAL TAMBAH ANGGOTA -->
<div id="modalTambahAnggota" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 sm:p-0">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeModal('modalTambahAnggota')"></div>
    <div class="bg-white rounded-2xl w-full max-w-lg shadow-2xl overflow-hidden transform scale-95 opacity-0 translate-y-4 transition-all duration-300 relative z-10 flex flex-col max-h-[90vh]">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
            <h3 class="font-bold text-lg text-slate-800">Tambah Anggota Baru</h3>
            <button type="button" onclick="closeModal('modalTambahAnggota')" class="text-slate-400 hover:text-red-500 transition-colors">
                <i class="ph-bold ph-x text-xl"></i>
            </button>
        </div>
        <div class="p-6 overflow-y-auto">
            <form action="<?= BASEURL; ?>/anggota/tambah" method="POST">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="nama" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 outline-none transition-all" placeholder="Masukkan nama langkap anggota">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-1">Nomor Telepon</label>
                            <input type="text" name="no_telp" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 outline-none transition-all" placeholder="Misal: 0812...">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-1">Email</label>
                            <input type="email" name="email" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 outline-none transition-all" placeholder="email@contoh.com">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Alamat Lengkap</label>
                        <textarea name="alamat" rows="3" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 outline-none transition-all resize-none" placeholder="Masukkan alamat lengkap divisi atau domisili"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Tanggal Daftar</label>
                        <input type="date" name="tanggal_daftar" required value="<?= date('Y-m-d'); ?>" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 outline-none transition-all">
                    </div>
                </div>
                <div class="mt-8 flex justify-end gap-3">
                    <button type="button" onclick="closeModal('modalTambahAnggota')" class="px-5 py-2.5 text-slate-500 bg-white border border-slate-200 hover:bg-slate-50 font-semibold rounded-xl transition-colors">Batal</button>
                    <button type="submit" class="px-5 py-2.5 text-white bg-indigo-600 hover:bg-indigo-700 font-semibold rounded-xl shadow-lg shadow-indigo-500/30 transition-colors">Simpan Anggota</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDIT ANGGOTA -->
<div id="modalEditAnggota" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 sm:p-0">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeModal('modalEditAnggota')"></div>
    <div class="bg-white rounded-2xl w-full max-w-lg shadow-2xl overflow-hidden transform scale-95 opacity-0 translate-y-4 transition-all duration-300 relative z-10 flex flex-col max-h-[90vh]">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
            <h3 class="font-bold text-lg text-slate-800">Edit Data Anggota</h3>
            <button type="button" onclick="closeModal('modalEditAnggota')" class="text-slate-400 hover:text-red-500 transition-colors">
                <i class="ph-bold ph-x text-xl"></i>
            </button>
        </div>
        <div class="p-6 overflow-y-auto">
            <form action="<?= BASEURL; ?>/anggota/edit" method="POST">
                <input type="hidden" name="id_anggota" id="edit_id_anggota">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="nama" id="edit_nama" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 outline-none transition-all">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-1">Nomor Telepon</label>
                            <input type="text" name="no_telp" id="edit_no_telp" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-1">Email</label>
                            <input type="email" name="email" id="edit_email" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 outline-none transition-all">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Alamat Lengkap</label>
                        <textarea name="alamat" id="edit_alamat" rows="3" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 outline-none transition-all resize-none"></textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Tanggal Daftar</label>
                        <input type="date" name="tanggal_daftar" id="edit_tanggal_daftar" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-100 focus:border-indigo-500 outline-none transition-all">
                    </div>
                </div>
                <div class="mt-8 flex justify-end gap-3">
                    <button type="button" onclick="closeModal('modalEditAnggota')" class="px-5 py-2.5 text-slate-500 bg-white border border-slate-200 hover:bg-slate-50 font-semibold rounded-xl transition-colors">Batal</button>
                    <button type="submit" class="px-5 py-2.5 text-white bg-indigo-600 hover:bg-indigo-700 font-semibold rounded-xl shadow-lg shadow-indigo-500/30 transition-colors">Perbarui</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL HAPUS ANGGOTA -->
<div id="modalHapusAnggota" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 sm:p-0">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeModal('modalHapusAnggota')"></div>
    <div class="bg-white rounded-2xl w-full max-w-md shadow-2xl overflow-hidden transform scale-95 opacity-0 translate-y-4 transition-all duration-300 relative z-10">
        <div class="p-6 text-center">
            <div class="w-16 h-16 rounded-full bg-red-100 text-red-500 flex items-center justify-center mx-auto mb-4">
                <i class="ph-fill ph-warning-circle text-4xl"></i>
            </div>
            <h3 class="font-bold text-xl text-slate-800 mb-2">Hapus Anggota?</h3>
            <p class="text-slate-500 text-sm mb-8">Apakah Anda yakin ingin menghapus data anggota ini secara permanen? Data yang telah dihapus tidak dapat dikembalikan.</p>
            
            <div class="flex justify-center gap-3">
                <button type="button" onclick="closeModal('modalHapusAnggota')" class="px-5 py-2.5 text-slate-500 bg-white border border-slate-200 hover:bg-slate-50 font-semibold rounded-xl transition-colors w-full">Batal</button>
                <a id="btnHapusAnggota" href="#" class="px-5 py-2.5 text-white bg-red-500 hover:bg-red-600 font-semibold rounded-xl shadow-lg shadow-red-500/30 transition-colors w-full flex items-center justify-center">Hapus</a>
            </div>
        </div>
    </div>
</div>

<script>
function editAnggota(id, nama, alamat, no_telp, email, tanggal_daftar) {
    document.getElementById('edit_id_anggota').value = id;
    document.getElementById('edit_nama').value = nama;
    document.getElementById('edit_alamat').value = alamat;
    document.getElementById('edit_no_telp').value = no_telp;
    document.getElementById('edit_email').value = email;
    document.getElementById('edit_tanggal_daftar').value = tanggal_daftar;
    openModal('modalEditAnggota');
}

function hapusAnggota(id) {
    document.getElementById('btnHapusAnggota').href = "<?= BASEURL; ?>/anggota/hapus/" + id;
    openModal('modalHapusAnggota');
}
</script>

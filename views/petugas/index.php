<div class="flex flex-col sm:flex-row sm:items-center justify-between mb-8 gap-4">
    <div>
        <h3 class="text-2xl font-bold text-slate-800 mb-1">Manajemen Petugas</h3>
        <p class="text-slate-500 text-sm">Kelola akses, jabatan staf admin, serta hak kelola perpustakaan.</p>
    </div>
    <button onclick="openModal('modalTambahPetugas')" class="bg-gradient-to-r from-teal-600 to-emerald-600 hover:from-teal-700 hover:to-emerald-700 text-white font-semibold py-2.5 px-5 rounded-xl shadow-lg shadow-teal-500/30 transition-all transform hover:-translate-y-0.5 flex items-center w-full sm:w-auto justify-center">
        <i class="ph-bold ph-plus mr-2 text-lg"></i> Petugas Baru
    </button>
</div>

<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden relative">
    <!-- Header Tabel -->
    <div class="p-6 border-b border-slate-100 flex flex-col md:flex-row md:items-center justify-between gap-4 bg-slate-50/50">
        <div class="relative w-full md:max-w-md">
            <i class="ph ph-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 text-lg"></i>
            <input type="text" placeholder="Cari nama atau username petugas..." class="w-full pl-11 pr-4 py-2.5 bg-white border border-slate-200 rounded-xl focus:outline-none focus:border-teal-500 focus:ring-2 focus:ring-teal-100 transition-all text-sm font-medium text-slate-700 placeholder-slate-400 disabled:opacity-50" autocomplete="off">
        </div>
    </div>

    <!-- Wrapper Tabel -->
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse whitespace-nowrap min-w-max">
            <thead>
                <tr class="text-slate-400 text-[11px] uppercase tracking-wider font-bold border-b border-slate-100 bg-white">
                    <th class="px-6 py-5 w-16 text-center">Id</th>
                    <th class="px-6 py-5">Identitas Petugas</th>
                    <th class="px-6 py-5">Username Akses</th>
                    <th class="px-6 py-5">Akses Kelola (Level)</th>
                    <th class="px-6 py-5 w-32 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50 text-sm">
                <?php if (empty($data['petugas'])) : ?>
                <tr>
                    <td colspan="5" class="px-6 py-16 text-center text-slate-500 bg-slate-50/30">
                        <div class="mx-auto w-16 h-16 bg-white shadow-sm border border-slate-100 rounded-full flex items-center justify-center mb-4 relative">
                            <i class="ph ph-users-three text-3xl text-slate-300"></i>
                        </div>
                        <p class="font-bold text-slate-600 text-base mb-1">Belum ada staf.</p>
                        <p class="text-sm text-slate-400 max-w-sm mx-auto">Tambahkan petugas atau staf perpustakaan untuk membantu proses manajerial.</p>
                    </td>
                </tr>
                <?php else : ?>
                    <?php foreach ($data['petugas'] as $p) : ?>
                    <tr class="hover:bg-teal-50/30 transition-colors group cursor-default">
                        <td class="px-6 py-4">
                            <div class="text-xs font-bold text-slate-400 bg-slate-50 px-2 py-1 rounded w-fit text-center border border-slate-100">
                                #<?= str_pad($p['id_user'], 3, '0', STR_PAD_LEFT); ?>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-teal-500 to-emerald-500 text-white flex items-center justify-center font-bold mr-3 border border-emerald-200 uppercase text-xs shadow-sm shadow-emerald-500/20">
                                    <?= substr($p['nama'], 0, 1); ?>
                                </div>
                                <div class="font-bold text-slate-800 group-hover:text-teal-700 transition-colors">
                                    <?= $p['nama']; ?>
                                    <?php if ($p['id_user'] == $_SESSION['user_ses']['id']): ?>
                                        <span class="ml-2 text-[10px] bg-slate-100 text-slate-500 px-2 py-0.5 rounded-full font-bold">Anda</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 font-medium text-slate-600">
                            <span class="bg-slate-100 text-slate-600 border border-slate-200 px-2 py-1 rounded text-xs font-mono">@<?= $p['username']; ?></span>
                        </td>
                        <td class="px-6 py-4">
                            <?php if ($p['role'] == 'admin'): ?>
                                <span class="bg-emerald-50 text-emerald-700 px-3 py-1.5 rounded-full font-bold text-[11px] border border-emerald-100 flex items-center w-fit shadow-sm">
                                    <i class="ph-bold ph-shield-check text-emerald-500 mr-1.5"></i> Administrator
                                </span>
                            <?php else: ?>
                                <span class="bg-slate-50 text-slate-600 px-3 py-1.5 rounded-full font-bold text-[11px] border border-slate-200 flex items-center w-fit shadow-sm">
                                    <i class="ph-bold ph-user text-slate-400 mr-1.5"></i> Staf Reguler
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2 opacity-100 md:opacity-0 group-hover:opacity-100 transition-opacity">
                                <button onclick="editPetugas('<?= $p['id_user']; ?>', '<?= addslashes($p['nama']); ?>', '<?= addslashes($p['username']); ?>', '<?= $p['role']; ?>')" class="w-9 h-9 rounded-xl bg-white border border-slate-200 text-slate-500 hover:bg-teal-50 hover:text-teal-600 hover:border-teal-200 flex items-center justify-center transition-all shadow-sm border-b-2">
                                    <i class="ph-bold ph-pencil-simple text-sm"></i>
                                </button>
                                <?php if ($p['id_user'] != $_SESSION['user_ses']['id']): ?>
                                <button onclick="openModal('modalHapusPetugas')" class="w-9 h-9 rounded-xl bg-white border border-slate-200 text-slate-500 hover:bg-red-50 hover:text-red-600 hover:border-red-200 flex items-center justify-center transition-all shadow-sm border-b-2">
                                    <i class="ph-bold ph-trash text-sm"></i>
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
        <p class="text-slate-500 font-medium">Sistem diawasi dan dimoderasi oleh <span class="font-bold text-slate-800"><?= count($data['petugas']); ?></span> staf dan otoritas.</p>
        
        <div class="flex gap-1">
            <button class="w-8 h-8 rounded-lg border border-slate-200 flex items-center justify-center text-slate-400 bg-white cursor-not-allowed border-b-2">
                <i class="ph-bold ph-caret-left"></i>
            </button>
            <button class="w-8 h-8 rounded-lg border border-teal-500 flex items-center justify-center text-white bg-teal-600 font-bold border-b-2 shadow-sm shadow-teal-500/20">
                1
            </button>
            <button class="w-8 h-8 rounded-lg border border-slate-200 flex items-center justify-center text-slate-600 bg-white hover:bg-slate-50 transition-colors border-b-2">
                <i class="ph-bold ph-caret-right"></i>
            </button>
        </div>
    </div>
</div>

<!-- MODAL TAMBAH PETUGAS -->
<div id="modalTambahPetugas" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 sm:p-0">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeModal('modalTambahPetugas')"></div>
    <div class="bg-white rounded-2xl w-full max-w-lg shadow-2xl overflow-hidden transform scale-95 opacity-0 translate-y-4 transition-all duration-300 relative z-10 flex flex-col max-h-[90vh]">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
            <h3 class="font-bold text-lg text-slate-800">Tambah Petugas Baru</h3>
            <button type="button" onclick="closeModal('modalTambahPetugas')" class="text-slate-400 hover:text-red-500 transition-colors">
                <i class="ph-bold ph-x text-xl"></i>
            </button>
        </div>
        <div class="p-6 overflow-y-auto">
            <form action="<?= BASEURL; ?>/petugas/tambah" method="POST">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="nama" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-teal-100 focus:border-teal-500 outline-none transition-all" placeholder="Masukkan nama petugas">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-1">Username Akun</label>
                            <input type="text" name="username" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-teal-100 focus:border-teal-500 outline-none transition-all" placeholder="Username">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-1">Kata Sandi (Password)</label>
                            <input type="password" name="password" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-teal-100 focus:border-teal-500 outline-none transition-all" placeholder="******">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Hak Akses Sistem</label>
                        <select name="level" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-teal-100 focus:border-teal-500 outline-none transition-all">
                            <option value="staff">Staff / Petugas (Data View/Input)</option>
                            <option value="admin">Administrator (Akses Penuh)</option>
                        </select>
                    </div>
                </div>
                <div class="mt-8 flex justify-end gap-3">
                    <button type="button" onclick="closeModal('modalTambahPetugas')" class="px-5 py-2.5 text-slate-500 bg-white border border-slate-200 hover:bg-slate-50 font-semibold rounded-xl transition-colors">Batal</button>
                    <button type="submit" class="px-5 py-2.5 text-white bg-teal-600 hover:bg-teal-700 font-semibold rounded-xl shadow-lg shadow-teal-500/30 transition-colors">Simpan Akun</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL EDIT PETUGAS -->
<div id="modalEditPetugas" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 sm:p-0">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeModal('modalEditPetugas')"></div>
    <div class="bg-white rounded-2xl w-full max-w-lg shadow-2xl overflow-hidden transform scale-95 opacity-0 translate-y-4 transition-all duration-300 relative z-10 flex flex-col max-h-[90vh]">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
            <h3 class="font-bold text-lg text-slate-800">Edit Akun Petugas</h3>
            <button type="button" onclick="closeModal('modalEditPetugas')" class="text-slate-400 hover:text-red-500 transition-colors">
                <i class="ph-bold ph-x text-xl"></i>
            </button>
        </div>
        <div class="p-6 overflow-y-auto">
            <form action="<?= BASEURL; ?>/petugas/edit" method="POST">
                <input type="hidden" name="id_petugas" id="edit_id_petugas">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Nama Lengkap</label>
                        <input type="text" name="nama" id="edit_nama" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-teal-100 focus:border-teal-500 outline-none transition-all">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-1">Username Akun</label>
                            <input type="text" name="username" id="edit_username" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-teal-100 focus:border-teal-500 outline-none transition-all">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-700 mb-1">Kata Sandi Baru (Opsional)</label>
                            <input type="password" name="password" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-teal-100 focus:border-teal-500 outline-none transition-all" placeholder="Biarkan kosong jika tdk diubah">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Hak Akses Sistem</label>
                        <select name="level" id="edit_level" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-teal-100 focus:border-teal-500 outline-none transition-all">
                            <option value="staff">Staff / Petugas (Data View/Input)</option>
                            <option value="admin">Administrator (Akses Penuh)</option>
                        </select>
                    </div>
                </div>
                <div class="mt-8 flex justify-end gap-3">
                    <button type="button" onclick="closeModal('modalEditPetugas')" class="px-5 py-2.5 text-slate-500 bg-white border border-slate-200 hover:bg-slate-50 font-semibold rounded-xl transition-colors">Batal</button>
                    <button type="submit" class="px-5 py-2.5 text-white bg-teal-600 hover:bg-teal-700 font-semibold rounded-xl shadow-lg shadow-teal-500/30 transition-colors">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL HAPUS PETUGAS -->
<div id="modalHapusPetugas" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 sm:p-0">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm transition-opacity" onclick="closeModal('modalHapusPetugas')"></div>
    <div class="bg-white rounded-2xl w-full max-w-md shadow-2xl overflow-hidden transform scale-95 opacity-0 translate-y-4 transition-all duration-300 relative z-10">
        <div class="p-6 text-center">
            <div class="w-16 h-16 rounded-full bg-red-100 text-red-500 flex items-center justify-center mx-auto mb-4">
                <i class="ph-fill ph-warning-circle text-4xl"></i>
            </div>
            <h3 class="font-bold text-xl text-slate-800 mb-2">Hapus Akun Petugas?</h3>
            <p class="text-slate-500 text-sm mb-8">Anda akan mencabut akses petugas ini secara permanen dari sistem E-Perpus. Lanjutkan?</p>
            
            <div class="flex justify-center gap-3">
                <button type="button" onclick="closeModal('modalHapusPetugas')" class="px-5 py-2.5 text-slate-500 bg-white border border-slate-200 hover:bg-slate-50 font-semibold rounded-xl transition-colors w-full">Batal</button>
                <button type="button" onclick="closeModal('modalHapusPetugas')" class="px-5 py-2.5 text-white bg-red-500 hover:bg-red-600 font-semibold rounded-xl shadow-lg shadow-red-500/30 transition-colors w-full">Hapus Akses</button>
            </div>
        </div>
    </div>
</div>

<script>
function editPetugas(id, nama, username, role) {
    document.getElementById('edit_id_petugas').value = id;
    document.getElementById('edit_nama').value = nama;
    document.getElementById('edit_username').value = username;
    document.getElementById('edit_level').value = role;
    openModal('modalEditPetugas');
}
</script>

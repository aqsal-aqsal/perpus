<div class="container mx-auto pb-10">
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800">Katalog Buku</h1>
            <p class="text-slate-500">Temukan koleksi buku terbaik untuk dipinjam.</p>
        </div>
        
        <div class="flex items-center gap-3">
            <a href="<?= BASEURL; ?>/catalog/cart" class="relative p-3 bg-white border border-slate-200 rounded-2xl hover:bg-slate-50 transition-all group">
                <i class="ph ph-shopping-cart text-2xl text-slate-600 group-hover:text-blue-600"></i>
                <?php if ($data['cart_count'] > 0): ?>
                    <span class="absolute -top-1 -right-1 w-5 h-5 bg-blue-600 text-white text-[10px] font-bold flex items-center justify-center rounded-full ring-2 ring-white">
                        <?= $data['cart_count']; ?>
                    </span>
                <?php endif; ?>
            </a>
        </div>
    </div>

    <!-- Filters & Search -->
    <div class="bg-white p-4 rounded-3xl shadow-sm border border-slate-100 mb-8">
        <form action="<?= BASEURL; ?>/catalog" method="post" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1 relative">
                <i class="ph ph-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
                <input type="text" name="search" placeholder="Cari judul buku atau penulis..." 
                       class="w-full pl-12 pr-4 py-3 rounded-2xl bg-slate-50 border-none focus:ring-2 focus:ring-blue-500 outline-none transition-all">
            </div>
            
            <select name="kategori" class="px-6 py-3 rounded-2xl bg-slate-50 border-none focus:ring-2 focus:ring-blue-500 outline-none text-slate-600 cursor-pointer">
                <option value="">Semua Kategori</option>
                <?php foreach($data['kategori'] as $kat): ?>
                    <option value="<?= $kat['id_kategori']; ?>"><?= $kat['nama_kategori']; ?></option>
                <?php endforeach; ?>
            </select>
            
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-2xl transition-all shadow-lg shadow-blue-500/20 active:scale-95">
                Cari
            </button>
        </form>
    </div>

    <!-- Book Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        <?php foreach($data['buku'] as $buku): ?>
            <div class="bg-white rounded-[32px] overflow-hidden border border-slate-100 group hover:shadow-xl hover:shadow-slate-200/50 transition-all duration-300 flex flex-col">
                <div class="relative aspect-[3/4] overflow-hidden bg-slate-100">
                    <?php 
                        $img = ($buku['gambar']) ? BASEURL . '/public/img/buku/' . $buku['gambar'] : 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80';
                    ?>
                    <img src="<?= $img ?>" alt="<?= $buku['judul'] ?>" 
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    
                    <div class="absolute top-4 right-4">
                        <span class="px-3 py-1.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-white/90 backdrop-blur-md shadow-sm border border-white/20 text-blue-600">
                            <?= $buku['nama_kategori'] ?>
                        </span>
                    </div>

                    <?php if($buku['stok'] > 0): ?>
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center p-6">
                            <a href="<?= BASEURL; ?>/catalog/add_to_cart/<?= $buku['id_buku']; ?>" 
                               class="w-full bg-white text-slate-900 font-bold py-3 rounded-2xl text-center transform translate-y-4 group-hover:translate-y-0 transition-all duration-300 hover:bg-blue-600 hover:text-white">
                                <i class="ph ph-plus-circle mr-2"></i> Tambah Keranjang
                            </a>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="p-6 flex-1 flex flex-col">
                    <div class="flex-1">
                        <h3 class="font-bold text-slate-800 line-clamp-2 text-lg leading-tight mb-2 group-hover:text-blue-600 transition-colors">
                            <?= $buku['judul'] ?>
                        </h3>
                        <p class="text-slate-500 text-sm font-medium mb-4">
                            <i class="ph ph-user-circle mr-1"></i> <?= $buku['penulis'] ?>
                        </p>
                    </div>

                    <div class="flex items-center justify-between pt-4 border-t border-slate-50">
                        <div class="flex items-center gap-2">
                            <i class="ph ph-stack text-slate-400"></i>
                            <span class="text-sm font-bold <?= $buku['stok'] > 0 ? 'text-slate-600' : 'text-red-500' ?>">
                                <?= $buku['stok'] ?> <span class="font-normal text-slate-400">Stok</span>
                            </span>
                        </div>
                        
                        <?php if($buku['stok'] > 0): ?>
                            <span class="flex items-center gap-1.5 text-xs font-bold text-emerald-600">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                Tersedia
                            </span>
                        <?php else: ?>
                             <button class="bg-red-50 text-red-600 px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-red-600 hover:text-white transition-all">
                                Notify Me
                             </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if(empty($data['buku'])): ?>
        <div class="flex flex-col items-center justify-center py-20 bg-white rounded-[40px] border border-dashed border-slate-200">
            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mb-4">
                <i class="ph ph-magnifying-glass text-4xl text-slate-300"></i>
            </div>
            <h2 class="text-xl font-bold text-slate-700">Buku tidak ditemukan</h2>
            <p class="text-slate-400">Coba kata kunci lain atau pilih kategori berbeda.</p>
        </div>
    <?php endif; ?>
</div>

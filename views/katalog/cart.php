<div class="container mx-auto max-w-4xl pb-10">
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-extrabold text-slate-800">Keranjang Pinjam</h1>
            <p class="text-slate-500">Tinjau daftar buku yang akan kamu booking.</p>
        </div>
        <a href="<?= BASEURL; ?>/catalog" class="text-blue-600 font-bold flex items-center gap-2 hover:gap-3 transition-all">
            <i class="ph ph-arrow-left"></i> Kembali ke Katalog
        </a>
    </div>

    <?php if (empty($data['cart'])): ?>
        <div class="bg-white p-12 rounded-[40px] border border-dashed border-slate-200 text-center">
            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="ph ph-shopping-cart text-4xl text-slate-300"></i>
            </div>
            <h2 class="text-2xl font-bold text-slate-700 mb-2">Keranjangmu masih kosong</h2>
            <p class="text-slate-400 mb-8">Jelajahi katalog dan temukan buku menarik untuk dibaca.</p>
            <a href="<?= BASEURL; ?>/catalog" class="inline-block bg-blue-600 text-white font-bold px-8 py-3 rounded-2xl shadow-lg shadow-blue-500/20 hover:bg-blue-700 transition-all">
                Mulai Menjelajah
            </a>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 gap-6 mb-8">
            <?php foreach($data['cart'] as $item): ?>
                <div class="bg-white p-4 rounded-[32px] border border-slate-100 flex items-center gap-6 group hover:shadow-lg hover:shadow-slate-100 transition-all">
                    <div class="w-24 h-32 rounded-2xl overflow-hidden shadow-md">
                        <?php 
                            $img = ($item['gambar']) ? BASEURL . '/public/img/buku/' . $item['gambar'] : 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80';
                        ?>
                        <img src="<?= $img ?>" class="w-full h-full object-cover">
                    </div>
                    
                    <div class="flex-1">
                        <h3 class="font-bold text-slate-800 text-lg leading-tight mb-1"><?= $item['judul'] ?></h3>
                        <p class="text-slate-500 text-sm font-medium">Oleh: <?= $item['penulis'] ?></p>
                        
                        <div class="flex items-center gap-4 mt-3">
                             <span class="flex items-center gap-1.5 text-xs font-bold text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                Stok Tersedia
                            </span>
                        </div>
                    </div>

                    <a href="<?= BASEURL; ?>/catalog/remove_cart/<?= $item['id_buku']; ?>" 
                       class="p-4 text-red-400 hover:text-red-600 hover:bg-red-50 rounded-2xl transition-all"
                       onclick="return confirm('Hapus buku ini dari keranjang?')">
                        <i class="ph ph-trash text-2xl"></i>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="bg-white p-8 rounded-[40px] border border-slate-200 flex flex-col md:flex-row items-center justify-between gap-6 shadow-xl shadow-slate-100 mb-10">
            <div>
                <p class="text-slate-500 font-medium mb-1">Total Buku</p>
                <h4 class="text-3xl font-extrabold text-slate-800"><?= count($data['cart']); ?> <span class="text-lg font-bold text-slate-400">Item</span></h4>
            </div>

            <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto">
                <a href="<?= BASEURL; ?>/catalog/checkout" 
                   class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-10 rounded-2xl text-center transition-all shadow-xl shadow-blue-600/20 active:scale-95 text-lg">
                    Lakukan Booking <i class="ph ph-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
        
        <div class="bg-blue-50 border border-blue-100 p-6 rounded-3xl flex gap-4">
            <i class="ph ph-info text-2xl text-blue-500"></i>
            <div class="text-sm text-blue-700">
                <p class="font-bold mb-1">Catatan Penting:</p>
                <p>Booking ini bersifat sementara. Silakan datang ke perpustakaan dalam waktu <strong>maksimal 24 jam</strong> untuk mengambil buku secara fisik. Staff kami akan melakukan verifikasi di tempat.</p>
            </div>
        </div>
    <?php endif; ?>
</div>

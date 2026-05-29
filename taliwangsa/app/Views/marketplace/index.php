<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<section class="py-16 bg-gradient-to-b from-[#EAF7FF] to-[#F5FAFD]">
    <div class="max-w-7xl mx-auto px-6">

        <div class="mb-10">
            <h1 class="text-5xl font-extrabold mb-4">
                Cari Jasa Profesional
            </h1>

            <p class="text-[#64748B] text-xl">
                Temukan freelancer terbaik untuk mewujudkan proyekmu
            </p>
        </div>

        <div class="bg-white rounded-3xl shadow-soft p-6 flex flex-col lg:flex-row gap-4 mb-10">
            <input type="text"
                id="searchKeyword"
                value="<?= esc($search ?? '') ?>"
                placeholder="Cari jasa, skill, atau nama freelancer..."
                class="flex-1 px-4 py-4 outline-none rounded-2xl bg-[#F5FAFD]">

            <select id="searchCategory" class="px-4 py-4 rounded-2xl bg-[#F5FAFD] outline-none">
                <option value="">Semua Kategori</option>
                <?php foreach($categories as $cat): ?>
                    <option value="<?= esc($cat->slug) ?>" <?= $category == $cat->slug ? 'selected' : '' ?>>
                        <?= esc($cat->name) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button onclick="handleMarketplaceSearch()" class="bg-[#00A9FF] hover:bg-[#0094E0] text-white px-8 py-4 rounded-2xl font-semibold">
                Cari
            </button>
        </div>

    </div>
</section>

<section class="py-20">
    <div class="max-w-7xl mx-auto px-6">

        <div class="flex flex-col lg:flex-row gap-8">

            <!-- SIDEBAR KATEGORI -->
            <aside class="lg:w-64 flex-shrink-0">
                <div class="bg-white rounded-3xl shadow-soft p-6 sticky top-24">
                    <h3 class="font-bold text-lg mb-6">Kategori</h3>

                    <div class="flex flex-col gap-3">
                        <a href="/marketplace" class="<?= !$category ? 'bg-[#EAF7FF] text-[#00A9FF]' : 'text-[#64748B] hover:text-[#00A9FF]' ?> px-4 py-2 rounded-lg transition">
                            Semua Kategori
                        </a>

                        <?php foreach($categories as $cat): ?>
                            <a href="/marketplace?category=<?= esc($cat->slug) ?>"
                                class="<?= $category == $cat->slug ? 'bg-[#EAF7FF] text-[#00A9FF]' : 'text-[#64748B] hover:text-[#00A9FF]' ?> px-4 py-2 rounded-lg transition">
                                <?= esc($cat->name) ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                </div>
            </aside>

            <!-- HASIL PENCARIAN -->
            <main class="flex-1">

                <?php if (count($services) > 0): ?>

                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-10">
                        <?php foreach($services as $service): ?>

                            <div class="bg-white rounded-3xl overflow-hidden shadow-soft hover:shadow-lg transition">

                                <div class="h-48 bg-gradient-to-br from-[#00A9FF] to-cyan-400 flex items-center justify-center">
                                    <div class="text-white text-6xl">
                                        🛠
                                    </div>
                                </div>

                                <div class="p-6">

                                    <div class="flex items-start gap-3 mb-4">
                                        <div class="w-12 h-12 rounded-full overflow-hidden bg-[#EAF7FF] flex items-center justify-center text-[#00A9FF] font-bold">
                                            <?= strtoupper(substr($service->freelancer_name, 0, 1)) ?>
                                        </div>

                                        <div class="flex-1">
                                            <span class="bg-[#EAF7FF] text-[#00A9FF] text-xs font-semibold px-3 py-1 rounded-full">
                                                <?= esc($service->category_name ?? 'Kategori') ?>
                                            </span>

                                            <p class="text-sm text-[#64748B] mt-2">
                                                <?= esc($service->freelancer_name) ?>
                                            </p>
                                        </div>
                                    </div>

                                    <h3 class="text-lg font-bold text-slate-800 mb-3 line-clamp-2">
                                        <?= esc($service->title) ?>
                                    </h3>

                                    <p class="text-[#64748B] text-sm mb-4 line-clamp-3">
                                        <?= esc($service->description) ?>
                                    </p>

                                    <div class="flex items-center justify-between mb-6 pb-6 border-b border-slate-200">
                                        <div>
                                            <p class="text-xs text-[#64748B]">Mulai dari</p>
                                            <p class="text-xl font-bold text-[#00A9FF]">
                                                Rp <?= number_format($service->price_start ?? 0, 0, ',', '.') ?>
                                            </p>
                                        </div>

                                        <div class="text-right">
                                            <p class="text-xs text-[#64748B]">Rating</p>
                                            <p class="text-lg font-bold text-yellow-500">
                                                ★ <?= number_format($service->rating_avg ?? 5, 1) ?>
                                            </p>
                                        </div>
                                    </div>

                                    <a href="/marketplace/service/<?= esc($service->id) ?>"
                                        class="block w-full bg-[#00A9FF] hover:bg-[#0094E0] text-white py-3 rounded-2xl text-center font-semibold transition">
                                        Lihat Detail
                                    </a>

                                </div>

                            </div>

                        <?php endforeach; ?>
                    </div>

                    <!-- PAGINATION -->
                    <div class="flex justify-center mt-12">
                        <?= $pager->links('default', 'default', 1) ?>
                    </div>

                <?php else: ?>

                    <div class="bg-white rounded-3xl shadow-soft p-12 text-center">
                        <div class="text-6xl mb-4">🔍</div>
                        <h3 class="text-2xl font-bold text-slate-800 mb-2">
                            Tidak Ada Layanan
                        </h3>

                        <p class="text-[#64748B] mb-6">
                            Coba ubah kategori atau kata kunci pencarian Anda
                        </p>

                        <a href="/marketplace" class="inline-block bg-[#00A9FF] hover:bg-[#0094E0] text-white px-8 py-3 rounded-2xl font-semibold transition">
                            Kembali ke Marketplace
                        </a>
                    </div>

                <?php endif; ?>

            </main>

        </div>

    </div>
</section>

<script>
    function handleMarketplaceSearch() {
        const keyword = document.getElementById('searchKeyword').value;
        const category = document.getElementById('searchCategory').value;
        let url = '/marketplace';
        let params = [];
        if (keyword) params.push('search=' + encodeURIComponent(keyword));
        if (category) params.push('category=' + encodeURIComponent(category));
        if (params.length > 0) url += '?' + params.join('&');
        window.location.href = url;
    }
    document.getElementById('searchKeyword').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') handleMarketplaceSearch();
    });
</script>

<?= $this->endSection() ?>

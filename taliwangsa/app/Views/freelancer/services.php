<?= $this->extend('layouts/freelancer') ?>
<?= $this->section('content') ?>

<div class="space-y-6">

    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Layanan Saya
            </h1>

            <p class="text-slate-500 mt-1">
                Kelola semua layanan freelancer Anda
            </p>

        </div>

        <a href="/freelancer/services/create"
            class="bg-[#00A9FF] hover:bg-[#0094E0] text-white px-6 py-3 rounded-2xl font-semibold transition">

            + Tambah Layanan Baru

        </a>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">

        <?php foreach($services as $service): ?>

        <div class="bg-white rounded-3xl overflow-hidden shadow-soft">

            <div class="h-52 bg-gradient-to-br from-[#00A9FF] to-cyan-400 flex items-center justify-center">

                <div class="text-white text-6xl">
                    🛠
                </div>

            </div>

            <div class="p-6">

                <div class="flex items-start justify-between gap-3 mb-4">

                    <div>

                        <span class="bg-[#EAF7FF] text-[#00A9FF] text-xs font-semibold px-3 py-1 rounded-full">

                            <?= $service->category_name ?? 'Kategori' ?>

                        </span>

                        <h3 class="text-xl font-bold text-slate-800 mt-3">

                            <?= $service->title ?>

                        </h3>

                    </div>

                    <?php if($service->is_active): ?>

                        <span class="bg-green-100 text-green-600 text-xs font-semibold px-3 py-1 rounded-full">
                            Aktif
                        </span>

                    <?php else: ?>

                        <span class="bg-red-100 text-red-600 text-xs font-semibold px-3 py-1 rounded-full">
                            Nonaktif
                        </span>

                    <?php endif; ?>

                </div>

                <div class="space-y-3 mb-6">

                    <div class="flex items-center justify-between">

                        <span class="text-slate-500">
                            Harga
                        </span>

                        <span class="font-bold text-[#00A9FF]">

                            Rp <?= number_format($service->price_start ?? 0,0,',','.') ?>

                        </span>

                    </div>

                    <div class="flex items-center justify-between">

                        <span class="text-slate-500">
                            Total Order
                        </span>

                        <span class="font-semibold text-slate-700">

                            <?= $service->total_orders ?? 0 ?>

                        </span>

                    </div>

                    <div class="flex items-center justify-between">

                        <span class="text-slate-500">
                            Rating
                        </span>

                        <span class="font-semibold text-yellow-500">

                            ★ <?= $service->rating ?? 5 ?>

                        </span>

                    </div>

                </div>

                <div class="flex items-center gap-3">

                    <a href="#"
                        class="flex-1 bg-[#00A9FF] hover:bg-[#0094E0] text-white py-3 rounded-2xl text-center font-semibold transition">

                        Edit

                    </a>

                    <?php if($service->is_active): ?>

                        <button
                            class="flex-1 border border-red-500 text-red-500 py-3 rounded-2xl font-semibold hover:bg-red-50 transition">

                            Nonaktifkan

                        </button>

                    <?php else: ?>

                        <button
                            class="flex-1 border border-green-500 text-green-600 py-3 rounded-2xl font-semibold hover:bg-green-50 transition">

                            Aktifkan

                        </button>

                    <?php endif; ?>

                </div>

            </div>

        </div>

        <?php endforeach; ?>

    </div>

</div>

<?= $this->endSection() ?>
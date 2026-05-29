<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="max-w-7xl mx-auto px-6 py-12">

    <a href="/marketplace" class="text-[#00A9FF] hover:text-[#0094E0] font-semibold mb-8 inline-flex items-center gap-2">
        ← Kembali ke Marketplace
    </a>

    <div class="grid lg:grid-cols-3 gap-12">

        <!-- MAIN CONTENT -->
        <main class="lg:col-span-2">

            <!-- SERVICE HEADER -->
            <div class="bg-white rounded-3xl shadow-soft overflow-hidden mb-8">

                <div class="h-64 bg-gradient-to-br from-[#00A9FF] to-cyan-400 flex items-center justify-center">
                    <div class="text-white text-8xl">🛠</div>
                </div>

                <div class="p-8">

                    <div class="flex flex-col sm:flex-row sm:items-start gap-6 mb-8 pb-8 border-b border-slate-200">

                        <div class="w-24 h-24 rounded-full bg-[#EAF7FF] flex items-center justify-center text-[#00A9FF] font-bold text-3xl flex-shrink-0">
                            <?= strtoupper(substr($service->freelancer_name, 0, 1)) ?>
                        </div>

                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                <h1 class="text-3xl lg:text-4xl font-extrabold"><?= esc($service->title) ?></h1>
                                <span class="bg-[#EAF7FF] text-[#00A9FF] text-sm font-semibold px-4 py-2 rounded-full">
                                    <?= esc($service->category_name) ?>
                                </span>
                            </div>

                            <p class="text-[#64748B] text-lg mb-4"><?= esc($service->freelancer_name) ?></p>

                            <div class="flex flex-wrap items-center gap-6 text-sm">
                                <div class="flex items-center gap-2">
                                    <span class="text-lg text-yellow-500">★</span>
                                    <strong><?= number_format($service->rating_avg ?? 5, 1) ?></strong>
                                    <span class="text-[#64748B]">(<?= $service->total_completed ?? 0 ?> project selesai)</span>
                                </div>

                                <div class="flex items-center gap-2">
                                    <span class="text-2xl">✓</span>
                                    <span class="text-[#64748B]">Diverifikasi</span>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- PRICE & CTA -->
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6 mb-8 pb-8 border-b border-slate-200">

                        <div>
                            <p class="text-[#64748B] text-sm mb-1">Harga Mulai Dari</p>
                            <p class="text-3xl font-extrabold text-[#00A9FF]">
                                Rp <?= number_format($service->price_start ?? 0, 0, ',', '.') ?>
                            </p>
                        </div>

                        <button onclick="contactFreelancer(<?= $service->freelancer_user_id ?>)" class="bg-[#00A9FF] hover:bg-[#0094E0] text-white font-semibold py-4 px-8 rounded-2xl transition w-full sm:w-auto">
                            Hubungi Freelancer
                        </button>

                    </div>

                    <!-- DESCRIPTION -->
                    <div>
                        <h2 class="text-2xl font-bold mb-4">Deskripsi Lengkap</h2>
                        <div class="prose max-w-none text-[#64748B] leading-relaxed">
                            <?= nl2br(esc($service->description)) ?>
                        </div>
                    </div>

                </div>

            </div>

            <!-- REVIEWS SECTION -->
            <?php if (count($reviews) > 0): ?>

                <div class="bg-white rounded-3xl shadow-soft p-8">

                    <h2 class="text-2xl font-bold mb-8">Review dari Klien</h2>

                    <div class="space-y-6">

                        <?php foreach($reviews as $review): ?>

                            <div class="pb-6 border-b border-slate-200 last:border-0">

                                <div class="flex items-center gap-2 mb-2">
                                    <strong><?= esc($review->reviewer_name) ?></strong>
                                    <div class="flex text-yellow-500">
                                        <?php for ($i = 0; $i < $review->rating; $i++): ?>
                                            <span>★</span>
                                        <?php endfor; ?>
                                    </div>
                                </div>

                                <p class="text-[#64748B]"><?= esc($review->review) ?></p>

                            </div>

                        <?php endforeach; ?>

                    </div>

                </div>

            <?php endif; ?>

        </main>

        <!-- SIDEBAR -->
        <aside class="lg:col-span-1">

            <!-- FREELANCER CARD -->
            <div class="bg-white rounded-3xl shadow-soft p-6 sticky top-24 mb-8">

                <h3 class="font-bold text-lg mb-6">Tentang Freelancer</h3>

                <div class="text-center mb-6">
                    <div class="w-20 h-20 rounded-full bg-[#EAF7FF] flex items-center justify-center text-[#00A9FF] font-bold text-2xl mx-auto mb-3">
                        <?= strtoupper(substr($service->freelancer_name, 0, 1)) ?>
                    </div>
                    <p class="font-bold"><?= esc($service->freelancer_name) ?></p>
                    <p class="text-sm text-[#64748B]"><?= esc($service->email) ?></p>
                </div>

                <div class="bg-[#F5FAFD] rounded-2xl p-4 mb-6 space-y-3 text-sm">

                    <div>
                        <p class="text-[#64748B]">Rating Rata-rata</p>
                        <p class="font-bold text-lg">★ <?= number_format($service->rating_avg ?? 5, 1) ?></p>
                    </div>

                    <div>
                        <p class="text-[#64748B]">Project Selesai</p>
                        <p class="font-bold text-lg"><?= $service->total_completed ?? 0 ?></p>
                    </div>

                    <div>
                        <p class="text-[#64748B]">Jam Kerja</p>
                        <p class="font-bold"><?= esc($service->working_hours ?? '8 jam/hari') ?></p>
                    </div>

                </div>

                <button onclick="contactFreelancer(<?= $service->freelancer_user_id ?>)" class="w-full bg-[#00A9FF] hover:bg-[#0094E0] text-white font-semibold py-3 rounded-2xl transition">
                    Pesan Sekarang
                </button>

            </div>

            <!-- QUICK INFO -->
            <div class="bg-white rounded-3xl shadow-soft p-6">

                <h3 class="font-bold text-lg mb-4">Informasi</h3>

                <ul class="space-y-4 text-sm">

                    <li class="flex gap-3">
                        <span class="text-[#00A9FF]">📍</span>
                        <div>
                            <p class="text-[#64748B]">Lokasi</p>
                            <p class="font-semibold"><?= esc($service->city ?? 'Indonesia') ?></p>
                        </div>
                    </li>

                    <li class="flex gap-3">
                        <span class="text-[#00A9FF]">⏱</span>
                        <div>
                            <p class="text-[#64748B]">Waktu Respons</p>
                            <p class="font-semibold">Kurang dari 1 jam</p>
                        </div>
                    </li>

                    <li class="flex gap-3">
                        <span class="text-[#00A9FF]">👥</span>
                        <div>
                            <p class="text-[#64748B]">Klien Aktif</p>
                            <p class="font-semibold"><?= $service->total_completed ?? 0 ?>+</p>
                        </div>
                    </li>

                </ul>

            </div>

        </aside>

    </div>

</div>

<script>
    function contactFreelancer(freelancerId) {
        // Redirect ke order/chat page - akan diimplementasikan kemudian
        alert('Fitur hubungi freelancer akan segera tersedia!');
    }
</script>

<?= $this->endSection() ?>

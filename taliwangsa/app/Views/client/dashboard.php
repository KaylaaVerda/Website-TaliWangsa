<?= $this->extend('layouts/client') ?>

<?= $this->section('content') ?>

<div class="grid lg:grid-cols-4 gap-6 mb-8">

    <div class="bg-white rounded-[24px] p-6 shadow-soft border-l-4 border-[#00A9FF]">
        <p class="text-[#64748B] mb-2">
            Total Pesanan Aktif
        </p>

        <h2 class="text-4xl font-bold mb-3">
            <?= $totalActive ?>
        </h2>

        <p class="text-green-500 text-sm">
            +12% dari bulan lalu
        </p>
    </div>

    <div class="bg-white rounded-[24px] p-6 shadow-soft border-l-4 border-[#F59E0B]">
        <p class="text-[#64748B] mb-2">
            Menunggu Pembayaran
        </p>

        <h2 class="text-4xl font-bold mb-3">
            <?= $waitingPayment ?>
        </h2>

        <p class="text-red-500 text-sm">
            -3% dari bulan lalu
        </p>
    </div>

    <div class="bg-white rounded-[24px] p-6 shadow-soft border-l-4 border-[#10B981]">
        <p class="text-[#64748B] mb-2">
            Selesai Bulan Ini
        </p>

        <h2 class="text-4xl font-bold mb-3">
            <?= $completedThisMonth ?>
        </h2>

        <p class="text-green-500 text-sm">
            +18% dari bulan lalu
        </p>
    </div>

    <div class="bg-white rounded-[24px] p-6 shadow-soft border-l-4 border-purple-500">
        <p class="text-[#64748B] mb-2">
            Total Pengeluaran
        </p>

        <h2 class="text-4xl font-bold mb-3">
            Rp <?= number_format($totalSpent,0,',','.') ?>
        </h2>

        <p class="text-green-500 text-sm">
            +7% dari bulan lalu
        </p>
    </div>

</div>

<div class="bg-white rounded-[24px] shadow-soft overflow-hidden mb-8">

    <div class="p-6 border-b border-gray-100 flex justify-between items-center">

        <h3 class="text-2xl font-bold">
            Pesanan Terbaru
        </h3>

        <a href="/orders" class="text-[#00A9FF] font-semibold">
            Lihat Semua
        </a>

    </div>

    <?php if(count($latestOrders) > 0): ?>

    <div class="overflow-x-auto">

        <table class="w-full">

            <thead class="bg-[#F5FAFD]">
                <tr>
                    <th class="text-left p-5">No</th>
                    <th class="text-left p-5">Layanan</th>
                    <th class="text-left p-5">Freelancer</th>
                    <th class="text-left p-5">Status</th>
                    <th class="text-left p-5">Deadline</th>
                    <th class="text-left p-5">Harga</th>
                    <th class="text-left p-5">Aksi</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach($latestOrders as $i => $order): ?>

                <tr class="border-t border-gray-100">

                    <td class="p-5">
                        <?= $i + 1 ?>
                    </td>

                    <td class="p-5 font-semibold">
                        <?= $order->service_title ?>
                    </td>

                    <td class="p-5">
                        <?= $order->freelancer_name ?>
                    </td>

                    <td class="p-5">

                        <span class="px-4 py-2 rounded-full text-sm
                        <?= $order->status == 'completed' ? 'bg-green-100 text-green-600' : '' ?>
                        <?= $order->status == 'in_progress' ? 'bg-yellow-100 text-yellow-600' : '' ?>
                        <?= $order->status == 'paid' ? 'bg-blue-100 text-blue-600' : '' ?>
                        <?= $order->status == 'unpaid' ? 'bg-gray-100 text-gray-600' : '' ?>
                        ">
                            <?= $order->status ?>
                        </span>

                    </td>

                    <td class="p-5">
                        <?= $order->deadline ?>
                    </td>

                    <td class="p-5 font-semibold">
                        Rp <?= number_format($order->price,0,',','.') ?>
                    </td>

                    <td class="p-5">

                        <a href="/orders/<?= $order->id ?>"
                            class="border border-[#00A9FF] text-[#00A9FF] px-4 py-2 rounded-xl">
                            Detail
                        </a>

                    </td>

                </tr>

                <?php endforeach; ?>

            </tbody>

        </table>

    </div>

    <?php else: ?>

    <div class="text-center py-20">

        <h3 class="text-3xl font-bold mb-4">
            Belum ada pesanan
        </h3>

        <a href="/marketplace"
            class="bg-[#00A9FF] text-white px-6 py-4 rounded-2xl inline-block">
            Cari Jasa
        </a>

    </div>

    <?php endif; ?>

</div>

<div class="grid lg:grid-cols-2 gap-8">

    <div class="bg-white rounded-[24px] p-8 shadow-soft">

        <h3 class="text-2xl font-bold mb-8">
            Aktivitas Terbaru
        </h3>

        <div class="space-y-6">

            <div class="flex gap-4">
                <div class="w-4 h-4 rounded-full bg-[#00A9FF] mt-2"></div>
                <div>
                    <h4 class="font-semibold">
                        Pembayaran berhasil
                    </h4>

                    <p class="text-[#64748B]">
                        2 jam lalu
                    </p>
                </div>
            </div>

            <div class="flex gap-4">
                <div class="w-4 h-4 rounded-full bg-green-500 mt-2"></div>
                <div>
                    <h4 class="font-semibold">
                        Proyek selesai
                    </h4>

                    <p class="text-[#64748B]">
                        Kemarin
                    </p>
                </div>
            </div>

        </div>

    </div>

    <div class="bg-white rounded-[24px] p-8 shadow-soft">

        <h3 class="text-2xl font-bold mb-8">
            Shortcut Kategori
        </h3>

        <div class="grid grid-cols-2 gap-5">

            <a href="/marketplace?category=desain-grafis"
                class="bg-[#EAF7FF] p-5 rounded-2xl font-semibold">
                🎨 Desain Grafis
            </a>

            <a href="/marketplace?category=pengembangan-web"
                class="bg-[#EAF7FF] p-5 rounded-2xl font-semibold">
                💻 Website
            </a>

            <a href="/marketplace?category=video"
                class="bg-[#EAF7FF] p-5 rounded-2xl font-semibold">
                🎬 Video
            </a>

            <a href="/marketplace?category=digital-marketing"
                class="bg-[#EAF7FF] p-5 rounded-2xl font-semibold">
                📈 Marketing
            </a>

        </div>

    </div>

</div>

<?= $this->endSection() ?>
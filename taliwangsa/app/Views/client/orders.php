<?= $this->extend('layouts/client') ?>

<?= $this->section('content') ?>

<div class="bg-white rounded-[24px] shadow-soft overflow-hidden">

    <div class="p-6 border-b border-gray-100">

        <h2 class="text-3xl font-bold mb-6">
            Pesanan Saya
        </h2>

        <div class="flex flex-wrap gap-3">

            <a href="/orders"
                class="px-5 py-3 rounded-xl bg-[#EAF7FF] text-[#00A9FF]">
                Semua
            </a>

            <a href="/orders?status=in_progress"
                class="px-5 py-3 rounded-xl bg-gray-100">
                Aktif
            </a>

            <a href="/orders?status=unpaid"
                class="px-5 py-3 rounded-xl bg-gray-100">
                Menunggu
            </a>

            <a href="/orders?status=completed"
                class="px-5 py-3 rounded-xl bg-gray-100">
                Selesai
            </a>

            <a href="/orders?status=disputed"
                class="px-5 py-3 rounded-xl bg-gray-100">
                Sengketa
            </a>

        </div>

    </div>

    <div class="overflow-x-auto">

        <table class="w-full">

            <thead class="bg-[#F5FAFD]">
                <tr>
                    <th class="text-left p-5">Order</th>
                    <th class="text-left p-5">Freelancer</th>
                    <th class="text-left p-5">Status</th>
                    <th class="text-left p-5">Harga</th>
                    <th class="text-left p-5">Aksi</th>
                </tr>
            </thead>

            <tbody>

                <?php if(count($orders) > 0): ?>

                    <?php foreach($orders as $order): ?>

                    <tr class="border-t border-gray-100">

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
                            <?= $order->status == 'disputed' ? 'bg-red-100 text-red-600' : '' ?>
                            ">
                                <?= $order->status ?>
                            </span>

                        </td>

                        <td class="p-5 font-semibold">
                            Rp <?= number_format($order->price,0,',','.') ?>
                        </td>

                        <td class="p-5">

                            <a href="/orders/<?= $order->id ?>"
                                class="border border-[#00A9FF] text-[#00A9FF] px-4 py-2 rounded-xl hover:bg-[#00A9FF] hover:text-white transition">
                                Detail
                            </a>

                        </td>

                    </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>

                        <td colspan="5" class="text-center py-20">

                            <h3 class="text-2xl font-bold mb-4">
                                Tidak ada pesanan
                            </h3>

                            <a href="/marketplace"
                                class="bg-[#00A9FF] text-white px-6 py-4 rounded-2xl inline-block">
                                Cari Jasa
                            </a>

                        </td>

                    </tr>

                <?php endif; ?>

            </tbody>

        </table>

    </div>

    <div class="p-6 border-t border-gray-100 flex justify-center gap-3">

        <?php
        $totalPages = ceil($total / $perPage);

        for($i=1; $i <= $totalPages; $i++):
        ?>

        <a href="/orders?page=<?= $i ?><?= $status ? '&status='.$status : '' ?>"
        class="w-11 h-11 rounded-xl flex items-center justify-center transition
        <?= $page == $i 
                ? 'bg-[#00A9FF] text-white' 
                : 'bg-[#F5FAFD] text-[#64748B]' ?>">
            <?= $i ?>
        </a>

        <?php endfor; ?>

    </div>

</div>

<?= $this->endSection() ?>
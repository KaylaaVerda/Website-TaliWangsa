<?= $this->extend('layouts/freelancer') ?>
<?= $this->section('content') ?>

<div class="space-y-6">

    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

        <div>

            <h1 class="text-3xl font-bold text-slate-800">
                Pesanan Masuk
            </h1>

            <p class="text-slate-500 mt-1">
                Kelola semua pesanan client
            </p>

        </div>

        <div class="flex flex-wrap gap-3">

            <a href="/freelancer/orders"
                class="px-5 py-3 rounded-2xl font-medium <?= !$status ? 'bg-[#00A9FF] text-white' : 'bg-white text-slate-700' ?>">
                Semua
            </a>

            <a href="/freelancer/orders?status=paid"
                class="px-5 py-3 rounded-2xl font-medium <?= $status=='paid' ? 'bg-[#00A9FF] text-white' : 'bg-white text-slate-700' ?>">
                Paid
            </a>

            <a href="/freelancer/orders?status=in_progress"
                class="px-5 py-3 rounded-2xl font-medium <?= $status=='in_progress' ? 'bg-[#00A9FF] text-white' : 'bg-white text-slate-700' ?>">
                Dikerjakan
            </a>

            <a href="/freelancer/orders?status=completed"
                class="px-5 py-3 rounded-2xl font-medium <?= $status=='completed' ? 'bg-[#00A9FF] text-white' : 'bg-white text-slate-700' ?>">
                Selesai
            </a>

        </div>

    </div>

    <div class="bg-white rounded-3xl shadow-soft overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-slate-50">

                    <tr>

                        <th class="p-5 text-left text-sm font-semibold text-slate-600">
                            Client
                        </th>

                        <th class="p-5 text-left text-sm font-semibold text-slate-600">
                            Layanan
                        </th>

                        <th class="p-5 text-left text-sm font-semibold text-slate-600">
                            Harga
                        </th>

                        <th class="p-5 text-left text-sm font-semibold text-slate-600">
                            Status
                        </th>

                        <th class="p-5 text-left text-sm font-semibold text-slate-600">
                            Deadline
                        </th>

                        <th class="p-5 text-center text-sm font-semibold text-slate-600">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    <?php if(count($orders) > 0): ?>

                        <?php foreach($orders as $order): ?>

                        <tr class="border-b border-slate-100 hover:bg-slate-50 transition">

                            <td class="p-5">

                                <div class="flex items-center gap-3">

                                    <div class="w-11 h-11 rounded-full bg-[#EAF7FF] flex items-center justify-center font-bold text-[#00A9FF]">
                                        <?= strtoupper(substr($order->client_name,0,1)) ?>
                                    </div>

                                    <div>

                                        <h4 class="font-semibold text-slate-800">
                                            <?= $order->client_name ?>
                                        </h4>

                                        <p class="text-sm text-slate-500">
                                            Client
                                        </p>

                                    </div>

                                </div>

                            </td>

                            <td class="p-5">

                                <h4 class="font-semibold text-slate-800">
                                    <?= $order->service_title ?>
                                </h4>

                            </td>

                            <td class="p-5 font-semibold text-slate-800">

                                Rp <?= number_format($order->freelancer_amount ?? 0,0,',','.') ?>

                            </td>

                            <td class="p-5">

                                <?php
                                    $badge = 'bg-slate-100 text-slate-600';

                                    if($order->status == 'paid'){
                                        $badge = 'bg-blue-100 text-blue-600';
                                    }

                                    if($order->status == 'in_progress'){
                                        $badge = 'bg-yellow-100 text-yellow-700';
                                    }

                                    if($order->status == 'completed'){
                                        $badge = 'bg-green-100 text-green-600';
                                    }
                                ?>

                                <span class="<?= $badge ?> px-3 py-1 rounded-full text-xs font-semibold">
                                    <?= ucfirst(str_replace('_',' ',$order->status)) ?>
                                </span>

                            </td>

                            <td class="p-5 text-slate-600">

                                <?= date('d M Y', strtotime($order->deadline ?? '+3 days')) ?>

                            </td>

                            <td class="p-5 text-center">

                                <div class="flex items-center justify-center gap-2">

                                    <?php if($order->status == 'paid'): ?>

                                        <a href="#"
                                            class="bg-[#00A9FF] text-white px-4 py-2 rounded-xl text-sm font-medium">
                                            Kerjakan
                                        </a>

                                    <?php elseif($order->status == 'in_progress'): ?>

                                        <a href="#"
                                            class="bg-green-500 text-white px-4 py-2 rounded-xl text-sm font-medium">
                                            Kirim
                                        </a>

                                    <?php endif; ?>

                                    <a href="#"
                                        class="bg-slate-200 text-slate-700 px-4 py-2 rounded-xl text-sm font-medium">
                                        Detail
                                    </a>

                                </div>

                            </td>

                        </tr>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <tr>

                            <td colspan="6" class="p-10 text-center text-slate-500">

                                Belum ada pesanan masuk

                            </td>

                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<?= $this->endSection() ?>
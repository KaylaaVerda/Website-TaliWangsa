<?= $this->extend('layouts/client') ?>

<?= $this->section('content') ?>

<div class="bg-white rounded-[24px] p-8 shadow-soft mb-8">

    <div class="flex flex-col lg:flex-row justify-between gap-8">

        <div>

            <h1 class="text-4xl font-bold mb-4">
                <?= $order->title ?>
            </h1>

            <span class="bg-blue-100 text-blue-600 px-5 py-2 rounded-full">
                <?= $order->status ?>
            </span>

        </div>

        <div class="text-right">

            <p class="text-[#64748B] mb-2">
                Total Harga
            </p>

            <h2 class="text-4xl font-bold">
                Rp <?= number_format($order->price,0,',','.') ?>
            </h2>

        </div>

    </div>

</div>

<div class="bg-white rounded-[24px] p-8 shadow-soft mb-8 overflow-x-auto">

    <div class="flex items-center min-w-[700px]">

        <div class="text-center">
            <div class="w-10 h-10 rounded-full bg-[#00A9FF] mx-auto mb-3"></div>
            <p>Unpaid</p>
        </div>

        <div class="flex-1 h-1 bg-[#00A9FF]"></div>

        <div class="text-center">
            <div class="w-10 h-10 rounded-full bg-[#00A9FF] mx-auto mb-3"></div>
            <p>Paid</p>
        </div>

        <div class="flex-1 h-1 bg-[#00A9FF]"></div>

        <div class="text-center">
            <div class="w-10 h-10 rounded-full bg-[#00A9FF] mx-auto mb-3"></div>
            <p>Progress</p>
        </div>

        <div class="flex-1 h-1 bg-gray-200"></div>

        <div class="text-center">
            <div class="w-10 h-10 rounded-full bg-gray-200 mx-auto mb-3"></div>
            <p>Delivered</p>
        </div>

        <div class="flex-1 h-1 bg-gray-200"></div>

        <div class="text-center">
            <div class="w-10 h-10 rounded-full bg-gray-200 mx-auto mb-3"></div>
            <p>Completed</p>
        </div>

    </div>

</div>

<div class="flex gap-4 mb-8 overflow-x-auto">

    <button onclick="showTab('detail', this)"
        class="tab-btn bg-[#00A9FF] text-white px-6 py-3 rounded-2xl whitespace-nowrap">
        Detail Proyek
    </button>

    <button onclick="showTab('history', this)"
        class="tab-btn bg-white px-6 py-3 rounded-2xl border whitespace-nowrap">
        Riwayat Status
    </button>

    <button onclick="showTab('invoice', this)"
        class="tab-btn bg-white px-6 py-3 rounded-2xl border whitespace-nowrap">
        Invoice
    </button>

</div>

<div class="grid lg:grid-cols-3 gap-8">

    <div class="lg:col-span-2">

        <div id="detail" class="tab-content space-y-8">

            <div class="bg-white rounded-[24px] p-8 shadow-soft">

                <h3 class="text-2xl font-bold mb-6">
                    Detail Proyek
                </h3>

                <p class="text-[#64748B] leading-relaxed mb-6">
                    <?= $order->description ?>
                </p>

                <div class="grid lg:grid-cols-2 gap-6">

                    <div>
                        <p class="text-[#64748B] mb-2">
                            Deadline
                        </p>

                        <h4 class="font-bold">
                            <?= $order->deadline ?>
                        </h4>
                    </div>

                    <div>
                        <p class="text-[#64748B] mb-2">
                            Freelancer
                        </p>

                        <h4 class="font-bold">
                            <?= $order->freelancer_name ?>
                        </h4>
                    </div>

                </div>

            </div>

        </div>

        <div id="history" class="tab-content hidden">

            <div class="bg-white rounded-[24px] p-8 shadow-soft">

                <h3 class="text-2xl font-bold mb-8">
                    Riwayat Status
                </h3>

                <div class="space-y-8">

                    <div class="flex gap-5">

                        <div class="w-5 h-5 rounded-full bg-green-500 mt-1"></div>

                        <div>
                            <h4 class="font-bold mb-1">
                                Pembayaran Berhasil
                            </h4>

                            <p class="text-[#64748B]">
                                Klien berhasil melakukan pembayaran escrow.
                            </p>

                            <span class="text-sm text-gray-400">
                                2 hari lalu
                            </span>
                        </div>

                    </div>

                    <div class="flex gap-5">

                        <div class="w-5 h-5 rounded-full bg-[#00A9FF] mt-1"></div>

                        <div>
                            <h4 class="font-bold mb-1">
                                Freelancer Memulai Proyek
                            </h4>

                            <p class="text-[#64748B]">
                                Freelancer mulai mengerjakan proyek.
                            </p>

                            <span class="text-sm text-gray-400">
                                1 hari lalu
                            </span>
                        </div>

                    </div>

                    <div class="flex gap-5">

                        <div class="w-5 h-5 rounded-full bg-yellow-400 mt-1"></div>

                        <div>
                            <h4 class="font-bold mb-1">
                                Proyek Dalam Progress
                            </h4>

                            <p class="text-[#64748B]">
                                Progress pengerjaan sedang berlangsung.
                            </p>

                            <span class="text-sm text-gray-400">
                                Hari ini
                            </span>
                        </div>

                    </div>

                </div>

            </div>

        </div>

        <div id="invoice" class="tab-content hidden">

            <div class="bg-white rounded-[24px] p-8 shadow-soft">

                <h3 class="text-2xl font-bold mb-6">
                    Invoice
                </h3>

                <table class="w-full">

                    <tr class="border-b">
                        <td class="py-4">
                            Harga Layanan
                        </td>

                        <td class="py-4 text-right">
                            Rp <?= number_format($order->price,0,',','.') ?>
                        </td>
                    </tr>

                    <tr class="border-b">
                        <td class="py-4">
                            Platform Fee
                        </td>

                        <td class="py-4 text-right">
                            10%
                        </td>
                    </tr>

                    <tr>
                        <td class="py-4 font-bold">
                            Total
                        </td>

                        <td class="py-4 text-right font-bold">
                            Rp <?= number_format($order->price,0,',','.') ?>
                        </td>
                    </tr>

                </table>

            </div>

        </div>

    </div>

    <div>

        <div class="bg-white rounded-[24px] p-8 shadow-soft">

            <h3 class="text-2xl font-bold mb-6">
                Freelancer
            </h3>

            <div class="text-center">

                <div class="w-24 h-24 rounded-full bg-[#EAF7FF] mx-auto mb-5"></div>

                <h4 class="text-2xl font-bold mb-2">
                    <?= $order->freelancer_name ?>
                </h4>

                <p class="text-[#64748B] mb-4">
                    ⭐ <?= number_format($order->rating_avg,1) ?>
                </p>

            </div>

        </div>

        <?php if($order->status == 'delivered'): ?>

        <div class="space-y-4 mt-6">

            <button class="w-full bg-green-500 text-white py-4 rounded-2xl font-semibold">
                Setujui Hasil
            </button>

            <button class="w-full bg-yellow-400 text-white py-4 rounded-2xl font-semibold">
                Minta Revisi
            </button>

            <button class="w-full border border-red-500 text-red-500 py-4 rounded-2xl font-semibold">
                Ajukan Sengketa
            </button>

        </div>

        <?php endif; ?>

    </div>

</div>

<script>

function showTab(tab, button){

    document.querySelectorAll('.tab-content').forEach(item => {
        item.classList.add('hidden');
    });

    document.getElementById(tab).classList.remove('hidden');

    document.querySelectorAll('.tab-btn').forEach(btn => {

        btn.classList.remove('bg-[#00A9FF]');
        btn.classList.remove('text-white');

        btn.classList.add('bg-white');
    });

    button.classList.remove('bg-white');

    button.classList.add('bg-[#00A9FF]');
    button.classList.add('text-white');
}

</script>

<?= $this->endSection() ?>
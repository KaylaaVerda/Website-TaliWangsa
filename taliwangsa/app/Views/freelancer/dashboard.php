<?= $this->extend('layouts/freelancer') ?>
<?= $this->section('content') ?>

<div class="space-y-6">

    <!-- STAT CARD -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-5 gap-5">

        <div class="bg-white rounded-3xl p-5 border-l-4 border-green-500 shadow-soft">
            <p class="text-sm text-slate-500 mb-2">Saldo Tersedia</p>
            <h2 class="text-2xl font-bold text-slate-800">
                Rp <?= number_format($walletBalance,0,',','.') ?>
            </h2>
        </div>

        <div class="bg-white rounded-3xl p-5 border-l-4 border-[#00A9FF] shadow-soft">
            <p class="text-sm text-slate-500 mb-2">Pesanan Aktif</p>
            <h2 class="text-2xl font-bold text-slate-800">
                <?= $activeOrders ?>
            </h2>
        </div>

        <div class="bg-white rounded-3xl p-5 border-l-4 border-indigo-500 shadow-soft">
            <p class="text-sm text-slate-500 mb-2">Pesanan Bulan Ini</p>
            <h2 class="text-2xl font-bold text-slate-800">
                <?= $monthlyOrders ?>
            </h2>
        </div>

        <div class="bg-white rounded-3xl p-5 border-l-4 border-teal-500 shadow-soft">
            <p class="text-sm text-slate-500 mb-2">Total Pendapatan</p>
            <h2 class="text-2xl font-bold text-slate-800">
                Rp <?= number_format($totalRevenue,0,',','.') ?>
            </h2>
        </div>

        <div class="bg-white rounded-3xl p-5 border-l-4 border-yellow-400 shadow-soft">
            <p class="text-sm text-slate-500 mb-2">Rating Rata-rata</p>

            <div class="flex items-center gap-2">
                <h2 class="text-2xl font-bold text-slate-800">
                    <?= number_format($rating->rating_avg ?? 0,1) ?>
                </h2>

                <div class="text-yellow-400 text-lg">
                    ★★★★★
                </div>
            </div>
        </div>

    </div>

    <!-- CHART -->
    <div class="bg-white rounded-3xl p-6 shadow-soft">

        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

            <div>
                <h3 class="text-xl font-bold text-slate-800">
                    Grafik Pendapatan
                </h3>

                <p class="text-slate-500 text-sm">
                    Statistik pendapatan freelancer
                </p>
            </div>

            <div class="flex gap-3">

                <button onclick="loadChart(7)"
                    class="chartBtn bg-[#00A9FF] text-white px-5 py-2 rounded-2xl font-medium">
                    7 Hari
                </button>

                <button onclick="loadChart(30)"
                    class="chartBtn bg-slate-100 px-5 py-2 rounded-2xl font-medium">
                    30 Hari
                </button>

                <button onclick="loadChart(90)"
                    class="chartBtn bg-slate-100 px-5 py-2 rounded-2xl font-medium">
                    90 Hari
                </button>

            </div>

        </div>

        <canvas id="incomeChart" height="100"></canvas>

    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-3xl shadow-soft overflow-hidden">

        <div class="p-6 border-b border-slate-100">

            <h3 class="text-xl font-bold text-slate-800">
                Pesanan Masuk Terbaru
            </h3>

        </div>

        <div class="overflow-x-auto">

            <table class="w-full">

                <thead class="bg-slate-50">

                    <tr>

                        <th class="text-left p-5 text-sm font-semibold text-slate-600">
                            Klien
                        </th>

                        <th class="text-left p-5 text-sm font-semibold text-slate-600">
                            Layanan
                        </th>

                        <th class="text-left p-5 text-sm font-semibold text-slate-600">
                            Harga
                        </th>

                        <th class="text-left p-5 text-sm font-semibold text-slate-600">
                            Status
                        </th>

                        <th class="text-left p-5 text-sm font-semibold text-slate-600">
                            Deadline
                        </th>

                        <th class="text-center p-5 text-sm font-semibold text-slate-600">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    <?php foreach($latestOrders as $order): ?>

                    <tr class="border-b border-slate-100 hover:bg-slate-50 transition">

                        <td class="p-5">

                            <div class="flex items-center gap-3">

                                <div class="w-11 h-11 rounded-full bg-[#EAF7FF] flex items-center justify-center text-[#00A9FF] font-bold">
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

                        <td class="p-5 font-medium text-slate-700">
                            <?= $order->service_title ?>
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

                            <?php else: ?>

                                <a href="#"
                                    class="bg-slate-200 text-slate-700 px-4 py-2 rounded-xl text-sm font-medium">
                                    Detail
                                </a>

                            <?php endif; ?>

                        </td>

                    </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </div>

    <!-- SERVICES -->
    <div>

        <div class="flex items-center justify-between mb-5">

            <h3 class="text-xl font-bold text-slate-800">
                Layanan Aktif
            </h3>

            <a href="/freelancer/services"
                class="text-[#00A9FF] font-semibold">
                Lihat Semua
            </a>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">

            <?php foreach($services as $service): ?>

            <div class="bg-white rounded-3xl p-5 shadow-soft">

                <div class="flex items-start justify-between mb-4">

                    <div>

                        <h4 class="font-bold text-slate-800 text-lg mb-2">
                            <?= $service->title ?>
                        </h4>

                        <p class="text-[#00A9FF] font-semibold">
                            Rp <?= number_format($service->price_start ?? 0,0,',','.') ?>
                        </p>

                    </div>

                    <label class="relative inline-flex items-center cursor-pointer">

                        <input type="checkbox"
                            class="sr-only peer"
                            <?= $service->is_active ? 'checked' : '' ?>>

                        <div class="w-11 h-6 bg-slate-200 rounded-full peer peer-checked:bg-[#00A9FF]"></div>

                    </label>

                </div>

                <div class="flex items-center justify-between text-sm text-slate-500">

                    <span>
                        <?= $service->total_orders ?? 0 ?> Orders
                    </span>

                    <span class="text-yellow-500 font-semibold">
                        ★ <?= $service->rating ?? 5 ?>
                    </span>

                </div>

            </div>

            <?php endforeach; ?>

        </div>

    </div>

</div>

<script>

const ctx = document.getElementById('incomeChart');

let incomeChart = new Chart(ctx, {

    type: 'line',

    data: {

        labels: <?= $chartLabels ?>,

        datasets: [{
            label: 'Pendapatan',
            data: <?= $chartData ?>,
            borderColor: '#00A9FF',
            backgroundColor: 'rgba(0,169,255,0.1)',
            tension: 0.4,
            fill: true
        }]
    },

    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        }
    }
});

function loadChart(days){

    fetch('/freelancer/chart-data/' + days)
    .then(res => res.json())
    .then(data => {

        incomeChart.data.labels = data.labels;
        incomeChart.data.datasets[0].data = data.data;
        incomeChart.update();

    });

}

</script>

<?= $this->endSection() ?>
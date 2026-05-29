<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="space-y-6">

    <!-- STATISTIC CARD -->

    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">

        <!-- TOTAL USER -->

        <div class="bg-white rounded-3xl p-6 shadow-sm">

            <div class="flex items-center justify-between mb-5">

                <div>

                    <p class="text-gray-500 text-sm">
                        Total Pengguna
                    </p>

                    <h2 class="text-4xl font-extrabold mt-2">
                        <?= number_format($totalUsers) ?>
                    </h2>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-[#EAF7FF] flex items-center justify-center text-[#00A9FF]">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-7 h-7"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M17 20h5V4H2v16h5m10 0v-2a4 4 0 00-4-4H9a4 4 0 00-4 4v2m12 0H7"/>

                    </svg>

                </div>

            </div>

            <p class="text-green-600 text-sm font-semibold">
                Platform berkembang aktif
            </p>

        </div>

        <!-- FREELANCER -->

        <div class="bg-white rounded-3xl p-6 shadow-sm">

            <div class="flex items-center justify-between mb-5">

                <div>

                    <p class="text-gray-500 text-sm">
                        Total Freelancer
                    </p>

                    <h2 class="text-4xl font-extrabold mt-2">
                        <?= number_format($totalFreelancer) ?>
                    </h2>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-indigo-100 flex items-center justify-center text-indigo-600">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-7 h-7"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>

                    </svg>

                </div>

            </div>

            <p class="text-gray-500 text-sm">
                Freelancer aktif platform
            </p>

        </div>

        <!-- ACTIVE ORDER -->

        <div class="bg-white rounded-3xl p-6 shadow-sm">

            <div class="flex items-center justify-between mb-5">

                <div>

                    <p class="text-gray-500 text-sm">
                        Pesanan Aktif
                    </p>

                    <h2 class="text-4xl font-extrabold mt-2">
                        <?= number_format($activeOrders) ?>
                    </h2>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-teal-100 flex items-center justify-center text-teal-600">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-7 h-7"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z"/>

                    </svg>

                </div>

            </div>

            <p class="text-gray-500 text-sm">
                Order sedang berjalan
            </p>

        </div>

        <!-- DISPUTE -->

        <div class="bg-white rounded-3xl p-6 shadow-sm border-l-4 border-red-500">

            <div class="flex items-center justify-between mb-5">

                <div>

                    <p class="text-gray-500 text-sm">
                        Sengketa Terbuka
                    </p>

                    <h2 class="text-4xl font-extrabold mt-2 text-red-500">
                        <?= number_format($openDisputes) ?>
                    </h2>

                </div>

                <div class="w-14 h-14 rounded-2xl bg-red-100 flex items-center justify-center text-red-500">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-7 h-7"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 9v2m0 4h.01m-7.938 4h15.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L2.34 16c-.77 1.333.192 3 1.732 3z"/>

                    </svg>

                </div>

            </div>

            <p class="text-red-500 text-sm font-semibold">
                Perlu penanganan admin
            </p>

        </div>

    </div>

    <!-- CHART -->

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

        <!-- INCOME -->

        <div class="bg-white rounded-3xl p-6 shadow-sm">

            <div class="flex items-center justify-between mb-6">

                <div>

                    <h3 class="text-xl font-bold">
                        Pendapatan Platform
                    </h3>

                    <p class="text-gray-500 text-sm">
                        6 bulan terakhir
                    </p>

                </div>

            </div>

            <canvas id="incomeChart" height="120"></canvas>

        </div>

        <!-- REGISTER -->

        <div class="bg-white rounded-3xl p-6 shadow-sm">

            <div class="flex items-center justify-between mb-6">

                <div>

                    <h3 class="text-xl font-bold">
                        Registrasi User
                    </h3>

                    <p class="text-gray-500 text-sm">
                        30 hari terakhir
                    </p>

                </div>

            </div>

            <canvas id="registerChart" height="120"></canvas>

        </div>

    </div>

    <!-- TABLE PANEL -->

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <!-- ORDER TERBARU -->

        <div class="bg-white rounded-3xl p-6 shadow-sm overflow-auto">

            <div class="flex items-center justify-between mb-6">

                <h3 class="text-xl font-bold">
                    Order Terbaru
                </h3>

                <a href="/admin/orders"
                    class="text-[#00A9FF] font-semibold text-sm">
                    Lihat Semua
                </a>

            </div>

            <div class="space-y-4">

                <?php foreach($latestOrders as $order): ?>

                <div class="border border-gray-100 rounded-2xl p-4">

                    <div class="flex justify-between items-start gap-4">

                        <div>

                            <h4 class="font-bold">
                                #<?= $order->order_number ?>
                            </h4>

                            <p class="text-sm text-gray-500 mt-1">
                                Client:
                                <?= $order->client_name ?>
                            </p>

                            <p class="text-sm text-gray-500">
                                Freelancer:
                                <?= $order->freelancer_name ?>
                            </p>

                        </div>

                        <span class="text-[#00A9FF] font-bold whitespace-nowrap">
                            Rp <?= number_format($order->price,0,',','.') ?>
                        </span>

                    </div>

                    <div class="mt-4">

                        <?php
                            $statusClass = 'bg-gray-100 text-gray-600';

                            if($order->status == 'completed'){
                                $statusClass = 'bg-green-100 text-green-600';
                            }

                            elseif($order->status == 'cancelled'){
                                $statusClass = 'bg-red-100 text-red-600';
                            }

                            elseif($order->status == 'in_progress'){
                                $statusClass = 'bg-blue-100 text-blue-600';
                            }

                            elseif($order->status == 'paid'){
                                $statusClass = 'bg-yellow-100 text-yellow-600';
                            }
                        ?>

                        <span class="<?= $statusClass ?> px-3 py-1 rounded-full text-xs font-semibold">
                            <?= ucfirst(str_replace('_',' ',$order->status)) ?>
                        </span>

                    </div>

                </div>

                <?php endforeach; ?>

            </div>

        </div>

        <!-- DISPUTE -->

        <div class="bg-white rounded-3xl p-6 shadow-sm overflow-auto">

            <div class="flex items-center justify-between mb-6">

                <h3 class="text-xl font-bold">
                    Sengketa Aktif
                </h3>

                <a href="/admin/disputes"
                    class="text-[#00A9FF] font-semibold text-sm">
                    Lihat Semua
                </a>

            </div>

            <div class="space-y-4">

                <?php foreach($latestDisputes as $dispute): ?>

                <div class="border border-red-100 rounded-2xl p-4">

                    <h4 class="font-bold">
                        Order #<?= $dispute->order_number ?>
                    </h4>

                    <p class="text-sm text-gray-500 mt-2">
                        <?= $dispute->reporter_name ?>
                    </p>

                    <p class="text-sm mt-2 line-clamp-2">
                        <?= $dispute->reason ?>
                    </p>

                    <div class="mt-4 flex items-center justify-between">

                        <span class="bg-red-100 text-red-600 text-xs px-3 py-1 rounded-full font-semibold">
                            <?= ucfirst($dispute->status) ?>
                        </span>

                        <a href="/admin/disputes"
                            class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl text-sm font-semibold transition">
                            Tangani
                        </a>

                    </div>

                </div>

                <?php endforeach; ?>

            </div>

        </div>

        <!-- CATEGORY -->

        <div class="bg-white rounded-3xl p-6 shadow-sm overflow-auto">

            <div class="flex items-center justify-between mb-6">

                <h3 class="text-xl font-bold">
                    Statistik Kategori
                </h3>

            </div>

            <div class="space-y-4">

                <?php foreach($categoryStats as $category): ?>

                <div class="border border-gray-100 rounded-2xl p-4">

                    <div class="flex items-center justify-between">

                        <h4 class="font-bold">
                            <?= $category->name ?>
                        </h4>

                        <span class="bg-[#EAF7FF] text-[#00A9FF] px-3 py-1 rounded-full text-xs font-semibold">
                            <?= $category->total_services ?> Service
                        </span>

                    </div>

                    <p class="text-sm text-gray-500 mt-3">
                        <?= $category->total_orders ?> order masuk
                    </p>

                </div>

                <?php endforeach; ?>

            </div>

        </div>

    </div>

</div>

<script>

const incomeData = <?= $incomeChart ?>;

new Chart(document.getElementById('incomeChart'),{
    type:'bar',
    data:{
        labels:incomeData.labels,
        datasets:[{
            label:'Pendapatan',
            data:incomeData.data,
            backgroundColor:'#00A9FF',
            borderRadius:12
        }]
    },
    options:{
        responsive:true,
        plugins:{
            legend:{
                display:false
            }
        },
        scales:{
            y:{
                beginAtZero:true
            }
        }
    }
});

new Chart(document.getElementById('registerChart'),{
    type:'line',
    data:{
        labels:<?= $registerLabels ?>,
        datasets:[{
            label:'Registrasi',
            data:<?= $registerData ?>,
            borderColor:'#00A9FF',
            backgroundColor:'rgba(0,169,255,0.15)',
            fill:true,
            tension:0.4
        }]
    },
    options:{
        responsive:true,
        plugins:{
            legend:{
                display:false
            }
        },
        scales:{
            y:{
                beginAtZero:true
            }
        }
    }
});

</script>

<?= $this->endSection() ?>
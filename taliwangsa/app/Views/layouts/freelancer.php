```php
<!DOCTYPE html>
<html lang="id">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Freelancer Dashboard - TaliWangsa</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@500;600;700;800&display=swap" rel="stylesheet">

    <style>

        body{
            font-family:'Inter',sans-serif;
            background:#F5FAFD;
        }

        h1,h2,h3,h4,h5{
            font-family:'Poppins',sans-serif;
        }

        .shadow-soft{
            box-shadow:0 4px 24px rgba(0,169,255,0.08);
        }

    </style>

</head>

<body>

<div class="flex min-h-screen">

    <aside id="sidebar"
        class="fixed left-0 top-0 z-50 w-[260px] h-screen bg-white shadow-soft p-6 transform -translate-x-full lg:translate-x-0 transition duration-300">

        <div class="flex items-center gap-4 mb-10">

            <div class="w-16 h-16 rounded-full overflow-hidden bg-[#EAF7FF]">

                <?php if(session()->get('avatar')): ?>

                    <img src="<?= base_url('uploads/avatar/'.session()->get('avatar')) ?>"
                        class="w-full h-full object-cover">

                <?php else: ?>

                    <div class="w-full h-full flex items-center justify-center text-[#00A9FF] text-2xl font-bold">

                        <?= strtoupper(substr(session()->get('name'),0,1)) ?>

                    </div>

                <?php endif; ?>

            </div>

            <div>

                <h3 class="font-bold text-lg">
                    <?= session()->get('name') ?>
                </h3>

                <?php if(session()->get('is_verified')): ?>

                    <span class="bg-green-100 text-green-600 text-xs px-3 py-1 rounded-full">
                        ✓ Terverifikasi
                    </span>

                <?php else: ?>

                    <span class="bg-yellow-100 text-yellow-700 text-xs px-3 py-1 rounded-full">
                        ⚠ Belum Verifikasi
                    </span>

                <?php endif; ?>

            </div>

        </div>

        <nav class="space-y-3">

            <a href="/freelancer"
                class="flex items-center gap-4 px-5 py-4 rounded-2xl font-semibold transition
                <?= uri_string() == 'freelancer'
                    ? 'bg-[#EAF7FF] text-[#00A9FF]'
                    : 'hover:bg-[#F5FAFD]' ?>">

                📊 Dashboard

            </a>

            <a href="/freelancer/services"
                class="flex items-center justify-between px-5 py-4 rounded-2xl transition
                <?= uri_string() == 'freelancer/services'
                    ? 'bg-[#EAF7FF] text-[#00A9FF]'
                    : 'hover:bg-[#F5FAFD]' ?>">

                <div class="flex items-center gap-4">

                    🛠 Layanan Saya

                </div>

                <span class="bg-[#00A9FF] text-white text-xs px-2 py-1 rounded-full">

                    <?= $serviceCount ?? 0 ?>

                </span>

            </a>

            <a href="/freelancer/orders"
                class="flex items-center justify-between px-5 py-4 rounded-2xl transition
                <?= uri_string() == 'freelancer/orders'
                    ? 'bg-[#EAF7FF] text-[#00A9FF]'
                    : 'hover:bg-[#F5FAFD]' ?>">

                <div class="flex items-center gap-4">

                    📦 Pesanan Masuk

                </div>

                <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full">

                    <?= $activeOrderCount ?? 0 ?>

                </span>

            </a>

            <a href="#"
                class="flex items-center gap-4 px-5 py-4 rounded-2xl hover:bg-[#F5FAFD] transition">

                🖼 Portofolio

            </a>

            <a href="/freelancer/wallet"
                class="flex items-center gap-4 px-5 py-4 rounded-2xl transition
                <?= uri_string() == 'freelancer/wallet'
                    ? 'bg-[#EAF7FF] text-[#00A9FF]'
                    : 'hover:bg-[#F5FAFD]' ?>">

                💰 Wallet & Penarikan

            </a>

            <a href="#"
                class="flex items-center justify-between px-5 py-4 rounded-2xl hover:bg-[#F5FAFD] transition">

                <div class="flex items-center gap-4">

                    ✔ Verifikasi

                </div>

                <?php if(!session()->get('is_verified')): ?>

                    <span class="bg-yellow-100 text-yellow-700 text-xs px-2 py-1 rounded-full">
                        Belum
                    </span>

                <?php else: ?>

                    <span class="bg-green-100 text-green-600 text-xs px-2 py-1 rounded-full">
                        Sudah
                    </span>

                <?php endif; ?>

            </a>

            <a href="/freelancer/profile"
                class="flex items-center gap-4 px-5 py-4 rounded-2xl transition
                <?= uri_string() == 'freelancer/profile'
                    ? 'bg-[#EAF7FF] text-[#00A9FF]'
                    : 'hover:bg-[#F5FAFD]' ?>">

                ⚙ Pengaturan Profil

            </a>

        </nav>

        <div class="absolute bottom-6 left-6 right-6">

            <a href="/logout"
                class="border border-red-500 text-red-500 py-4 rounded-2xl w-full block text-center font-semibold hover:bg-red-50 transition">

                Logout

            </a>

        </div>

    </aside>

    <div class="flex-1 lg:ml-[260px]">

        <header class="bg-white sticky top-0 z-40 px-6 py-5 shadow-soft flex items-center justify-between">

            <div class="flex items-center gap-4">

                <button onclick="toggleSidebar()" class="lg:hidden text-2xl">
                    ☰
                </button>

                <div>

                    <h2 class="text-2xl font-bold">

                        <?php

                        $hour = date('H');

                        if($hour < 12){

                            echo 'Selamat pagi';

                        }elseif($hour < 18){

                            echo 'Selamat siang';

                        }else{

                            echo 'Selamat malam';

                        }

                        ?>,

                        <?= session()->get('name') ?> 👋

                    </h2>

                    <p class="text-[#64748B]">

                        <?= date('d F Y') ?>

                    </p>

                </div>

            </div>

            <a href="/freelancer/services/create"
                class="bg-[#00A9FF] hover:bg-[#0094E0] text-white px-6 py-3 rounded-2xl font-semibold transition">

                + Tambah Layanan

            </a>

        </header>

        <main class="p-6">

            <?= $this->renderSection('content') ?>

        </main>

    </div>

</div>

<div id="overlay"
    onclick="toggleSidebar()"
    class="fixed inset-0 bg-black/50 hidden z-40 lg:hidden"></div>

<script>

function toggleSidebar(){

    const sidebar = document.getElementById('sidebar');
    const overlay = document.getElementById('overlay');

    sidebar.classList.toggle('-translate-x-full');

    overlay.classList.toggle('hidden');
}

</script>

</body>
</html>

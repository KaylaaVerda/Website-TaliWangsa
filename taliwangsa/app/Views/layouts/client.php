<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaliWangsa Client</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body{
            font-family:'Inter',sans-serif;
            background:#F5FAFD;
        }

        h1,h2,h3,h4{
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
        class="fixed lg:static z-50 left-0 top-0 w-[260px] h-screen bg-white shadow-soft p-6 transform -translate-x-full lg:translate-x-0 transition">

        <div class="flex items-center gap-4 mb-10">

            <div class="w-16 h-16 rounded-full bg-[#EAF7FF]"></div>

            <div>
                <h3 class="font-bold">
                    <?= session()->get('name') ?>
                </h3>

                <span class="bg-[#EAF7FF] text-[#00A9FF] text-sm px-3 py-1 rounded-full">
                    Klien
                </span>
            </div>

        </div>

        <nav class="space-y-3">

            <a href="/dashboard"
                class="flex items-center gap-4 px-5 py-4 rounded-2xl bg-[#EAF7FF] text-[#00A9FF] font-semibold">

                📊 Dashboard
            </a>

            <a href="/orders"
                class="flex items-center justify-between px-5 py-4 rounded-2xl hover:bg-[#F5FAFD]">

                <div class="flex items-center gap-4">
                    📦 Pesanan Saya
                </div>

                <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full">
                    3
                </span>

            </a>

            <a href="/marketplace"
                class="flex items-center gap-4 px-5 py-4 rounded-2xl hover:bg-[#F5FAFD]">
                🔍 Cari Jasa
            </a>

            <a href="#"
                class="flex items-center gap-4 px-5 py-4 rounded-2xl hover:bg-[#F5FAFD]">
                💬 Pesan & Chat
            </a>

            <a href="#"
                class="flex items-center gap-4 px-5 py-4 rounded-2xl hover:bg-[#F5FAFD]">
                ⭐ Ulasan Saya
            </a>

            <a href="#"
                class="flex items-center gap-4 px-5 py-4 rounded-2xl hover:bg-[#F5FAFD]">
                ⚙ Pengaturan
            </a>

        </nav>

        <div class="absolute bottom-6 left-6 right-6">

            <a href="/logout"
                class="border border-red-500 text-red-500 w-full block text-center py-4 rounded-2xl font-semibold">
                Logout
            </a>

        </div>

    </aside>

    <div class="flex-1 lg:ml-0">

        <header class="bg-white px-6 py-5 shadow-soft flex items-center justify-between sticky top-0 z-40">

            <div class="flex items-center gap-4">

                <button onclick="toggleSidebar()" class="lg:hidden text-2xl">
                    ☰
                </button>

                <div>

                    <h2 class="text-2xl font-bold">
                        <?php
                        $hour = date('H');

                        if($hour < 12){
                            echo "Selamat pagi";
                        }elseif($hour < 18){
                            echo "Selamat siang";
                        }else{
                            echo "Selamat malam";
                        }
                        ?>,
                        <?= session()->get('name') ?> 👋
                    </h2>

                    <p class="text-[#64748B]">
                        <?= date('d F Y') ?>
                    </p>

                </div>

            </div>

            <a href="#"
                class="bg-[#00A9FF] hover:bg-[#0094E0] text-white px-6 py-3 rounded-2xl font-semibold">
                + Pasang Kebutuhan
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
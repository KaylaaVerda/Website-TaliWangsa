<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Admin Panel - TaliWangsa' ?></title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #F5FAFD;
            color: #1F2937;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Poppins', sans-serif;
        }

        .sidebar-bg {
            background: #111827;
        }

        .sidebar-link {
            transition: 200ms;
        }

        .sidebar-link:hover {
            background: rgba(255, 255, 255, 0.08);
        }

        .sidebar-active {
            background: #00A9FF;
            color: white;
        }

        .modal-backdrop {
            backdrop-filter: blur(6px);
        }

        .text-primary {
            color: #00A9FF;
        }

        .bg-primary {
            background: #00A9FF;
        }

        .border-primary {
            border-color: #00A9FF;
        }
    </style>
</head>
<body class="min-h-screen">

<div class="min-h-screen flex">
    <aside id="desktopSidebar" class="hidden lg:flex w-72 flex-col sidebar-bg text-white shadow-xl">
        <div class="p-8 flex flex-col gap-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-3xl bg-white/10 flex items-center justify-center">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M3 12h18" />
                        <path d="M3 6h18" />
                        <path d="M3 18h18" />
                    </svg>
                </div>
                <div>
                    <p class="text-sm text-slate-300 uppercase tracking-[0.2em]">TaliWangsa</p>
                    <h1 class="text-2xl font-bold">Admin Panel</h1>
                </div>
            </div>

            <div class="space-y-2">
                <p class="text-xs text-slate-400 uppercase tracking-[0.18em]">Overview</p>
                <a href="/admin" class="sidebar-link rounded-3xl px-5 py-3 flex items-center gap-4 text-sm font-semibold sidebar-active">
                    <span class="w-10 h-10 rounded-2xl bg-white/10 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6"/></svg>
                    </span>
                    Dashboard
                </a>
            </div>

            <div class="space-y-2">
                <p class="text-xs text-slate-400 uppercase tracking-[0.18em]">Platform</p>
                <a href="/admin/users" class="sidebar-link rounded-3xl px-5 py-3 flex items-center gap-4 text-sm font-semibold text-slate-100">
                    <span class="w-10 h-10 rounded-2xl bg-white/10 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5V4H2v16h5m10 0v-2a4 4 0 00-4-4H9a4 4 0 00-4 4v2m12 0H7"/></svg>
                    </span>
                    Kelola Pengguna
                </a>
                <a href="/admin/categories" class="sidebar-link rounded-3xl px-5 py-3 flex items-center gap-4 text-sm font-semibold text-slate-100">
                    <span class="w-10 h-10 rounded-2xl bg-white/10 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </span>
                    Kategori
                </a>
            </div>

            <div class="space-y-2">
                <p class="text-xs text-slate-400 uppercase tracking-[0.18em]">Pesanan</p>
                <a href="/admin/orders" class="sidebar-link rounded-3xl px-5 py-3 flex items-center gap-4 text-sm font-semibold text-slate-100">
                    <span class="w-10 h-10 rounded-2xl bg-white/10 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M12 17h9"/></svg>
                    </span>
                    Semua Pesanan
                </a>
                <a href="/admin/disputes" class="sidebar-link rounded-3xl px-5 py-3 flex items-center gap-4 text-sm font-semibold text-slate-100">
                    <span class="w-10 h-10 rounded-2xl bg-white/10 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-7.938 4h15.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L2.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    </span>
                    Sengketa Aktif
                    <span class="ml-auto bg-red-500 text-white px-3 py-1 rounded-full text-xs font-semibold">5</span>
                </a>
            </div>

            <div class="space-y-2">
                <p class="text-xs text-slate-400 uppercase tracking-[0.18em]">Konten</p>
                <a href="/admin/settings" class="sidebar-link rounded-3xl px-5 py-3 flex items-center gap-4 text-sm font-semibold text-slate-100">
                    <span class="w-10 h-10 rounded-2xl bg-white/10 flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 1.343-3 3m0 0a3 3 0 106 0 3 3 0 00-6 0m3 8v-4"/></svg>
                    </span>
                    Pengaturan
                </a>
            </div>
        </div>
    </aside>

    <div class="flex-1 lg:pl-72">
        <header class="sticky top-0 z-40 bg-white border-b border-slate-200 lg:px-10 px-6 py-4 shadow-sm">
            <div class="flex items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <button id="mobileSidebarButton" class="lg:hidden p-2 rounded-2xl bg-slate-100">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-slate-700" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    </button>
                    <div>
                        <h2 class="text-xl font-bold text-slate-900">Admin Dashboard</h2>
                        <p class="text-sm text-slate-500">Kelola semua aktivitas platform dari sini</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <div class="hidden sm:flex items-center gap-3 px-4 py-2 rounded-3xl bg-slate-50">
                        <div class="w-11 h-11 rounded-2xl bg-[#EAF7FF] flex items-center justify-center text-[#00A9FF] font-bold">A</div>
                        <div>
                            <p class="text-sm font-semibold">Admin TaliWangsa</p>
                            <p class="text-xs text-slate-500">Administrator</p>
                        </div>
                    </div>
                    <a href="/logout" class="bg-[#00A9FF] hover:bg-[#0094E0] text-white px-5 py-3 rounded-2xl font-semibold">Logout</a>
                </div>
            </div>
        </header>

        <main class="px-6 lg:px-10 py-8">
            <?= $this->renderSection('content') ?>
        </main>
    </div>
</div>

<div id="mobileSidebar" class="fixed inset-0 z-50 hidden lg:hidden">
    <div class="absolute inset-0 bg-black/40 modal-backdrop" onclick="closeMobileSidebar()"></div>
    <div class="absolute left-0 top-0 bottom-0 w-80 bg-[#111827] text-white p-6 overflow-y-auto">
        <div class="flex items-center justify-between mb-8">
            <div>
                <p class="text-xs text-slate-400 uppercase tracking-[0.2em]">TaliWangsa</p>
                <h1 class="text-xl font-bold">Admin Panel</h1>
            </div>
            <button onclick="closeMobileSidebar()" class="text-white text-2xl">×</button>
        </div>

        <div class="space-y-3">
            <a href="/admin" class="block px-4 py-3 rounded-3xl bg-[#00A9FF] font-semibold">Dashboard</a>
            <a href="/admin/users" class="block px-4 py-3 rounded-3xl bg-white/10">Kelola Pengguna</a>
            <a href="/admin/categories" class="block px-4 py-3 rounded-3xl bg-white/10">Kategori</a>
            <a href="/admin/orders" class="block px-4 py-3 rounded-3xl bg-white/10">Semua Pesanan</a>
            <a href="/admin/disputes" class="block px-4 py-3 rounded-3xl bg-white/10">Sengketa Aktif</a>
            <a href="/admin/settings" class="block px-4 py-3 rounded-3xl bg-white/10">Pengaturan</a>
        </div>
    </div>
</div>

<script>
    const mobileSidebar = document.getElementById('mobileSidebar');
    const mobileSidebarButton = document.getElementById('mobileSidebarButton');

    function openMobileSidebar() {
        mobileSidebar.classList.remove('hidden');
    }

    function closeMobileSidebar() {
        mobileSidebar.classList.add('hidden');
    }

    mobileSidebarButton?.addEventListener('click', openMobileSidebar);
</script>
</body>
</html>

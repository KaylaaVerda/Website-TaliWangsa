<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<section class="pt-36 pb-24 bg-gradient-to-b from-[#F5FAFD] to-[#EAF7FF] overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-16 items-center">

        <div>

            <div class="inline-flex items-center gap-2 bg-[#EAF7FF] text-[#00A9FF] px-5 py-2 rounded-full font-semibold mb-8">
                ✦ Platform Freelancer #1 Indonesia
            </div>

            <h1 class="text-5xl lg:text-7xl leading-tight font-extrabold mb-6">
                Temukan Talenta Terbaik, Wujudkan Proyek Impianmu
            </h1>

            <p class="text-[#64748B] text-xl leading-relaxed mb-10">
                TaliWangsa menghubungkan bisnis dan kreator profesional untuk menciptakan proyek berkualitas dengan sistem pembayaran aman.
            </p>

            <div class="bg-white rounded-3xl shadow-soft p-4 flex flex-col lg:flex-row gap-4 mb-8">

                <input type="text"
                    id="searchKeyword"
                    placeholder="Cari jasa profesional..."
                    class="flex-1 px-4 py-4 outline-none rounded-2xl bg-[#F5FAFD]">

                <select id="searchCategory" class="px-4 py-4 rounded-2xl bg-[#F5FAFD] outline-none">
                    <option value="">Semua Kategori</option>
                    <option value="desain-grafis">Desain Grafis</option>
                    <option value="pengembangan-web">Website</option>
                    <option value="video">Video</option>
                    <option value="digital-marketing">Digital Marketing</option>
                </select>

                <button onclick="handleSearch()" class="bg-[#00A9FF] hover:bg-[#0094E0] text-white px-8 py-4 rounded-2xl font-semibold btn-hover">
                    Cari
                </button>
            </div>

            <script>
                function handleSearch() {
                    const keyword = document.getElementById('searchKeyword').value;
                    const category = document.getElementById('searchCategory').value;
                    let url = '/marketplace';
                    let params = [];
                    if (keyword) params.push('search=' + encodeURIComponent(keyword));
                    if (category) params.push('category=' + encodeURIComponent(category));
                    if (params.length > 0) url += '?' + params.join('&');
                    window.location.href = url;
                }
                document.getElementById('searchKeyword').addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') handleSearch();
                });
            </script>

            <div class="flex flex-wrap gap-3 mb-10">
                <span class="bg-white px-4 py-2 rounded-full shadow-soft text-[#64748B]">
                    Desain Logo
                </span>

                <span class="bg-white px-4 py-2 rounded-full shadow-soft text-[#64748B]">
                    Website
                </span>

                <span class="bg-white px-4 py-2 rounded-full shadow-soft text-[#64748B]">
                    Konten Instagram
                </span>

                <span class="bg-white px-4 py-2 rounded-full shadow-soft text-[#64748B]">
                    Editing Video
                </span>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">

                <div>
                    <h3 class="text-3xl font-extrabold text-[#00A9FF]">
                        12.000+
                    </h3>

                    <p class="text-[#64748B]">
                        Freelancer
                    </p>
                </div>

                <div>
                    <h3 class="text-3xl font-extrabold text-[#00A9FF]">
                        8.500+
                    </h3>

                    <p class="text-[#64748B]">
                        Proyek
                    </p>
                </div>

                <div>
                    <h3 class="text-3xl font-extrabold text-[#00A9FF]">
                        4.9/5
                    </h3>

                    <p class="text-[#64748B]">
                        Rating
                    </p>
                </div>

                <div>
                    <h3 class="text-3xl font-extrabold text-[#00A9FF]">
                        98%
                    </h3>

                    <p class="text-[#64748B]">
                        Kepuasan
                    </p>
                </div>

            </div>

        </div>

        <div class="relative dot-grid rounded-[40px] p-10">

            <svg viewBox="0 0 600 500" class="w-full">

                <path d="M140 250 C 200 120, 400 120, 460 250"
                    stroke="#00A9FF"
                    stroke-width="8"
                    fill="none"
                    stroke-linecap="round"/>

                <circle cx="130" cy="280" r="70" fill="#00A9FF"/>
                <circle cx="470" cy="280" r="70" fill="#4FCBFF"/>

                <circle cx="130" cy="220" r="28" fill="white"/>
                <circle cx="470" cy="220" r="28" fill="white"/>

                <rect x="90" y="320" rx="24" width="80" height="90" fill="white"/>
                <rect x="430" y="320" rx="24" width="80" height="90" fill="white"/>

                <rect x="230" y="130" rx="24" width="120" height="70" fill="white"/>
                <rect x="200" y="300" rx="24" width="140" height="80" fill="white"/>
                <rect x="360" y="190" rx="24" width="100" height="60" fill="white"/>

                <path d="M260 160 H320" stroke="#00A9FF" stroke-width="6" stroke-linecap="round"/>
                <path d="M230 340 L260 360 L310 320" stroke="#00A9FF" stroke-width="6" fill="none"/>
                <path d="M390 220 L410 240 L440 200" stroke="#00A9FF" stroke-width="6" fill="none"/>

            </svg>

        </div>

    </div>
</section>

<section class="py-20 bg-gradient-to-r from-[#00A9FF] to-[#4FCBFF]">
    <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-4 gap-10 text-center text-white">

        <div>
            <h2 class="counter text-5xl font-extrabold" data-target="12000">0</h2>
            <p class="mt-3">Freelancer Aktif</p>
        </div>

        <div>
            <h2 class="counter text-5xl font-extrabold" data-target="8500">0</h2>
            <p class="mt-3">Proyek Selesai</p>
        </div>

        <div>
            <h2 class="counter text-5xl font-extrabold" data-target="98">0</h2>
            <p class="mt-3">Kepuasan Klien</p>
        </div>

        <div>
            <h2 class="counter text-5xl font-extrabold" data-target="450">0</h2>
            <p class="mt-3">Perusahaan Bergabung</p>
        </div>

    </div>
</section>

<section class="py-24">
    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center mb-16">
            <h2 class="text-5xl font-extrabold mb-4">
                Kategori Populer
            </h2>

            <p class="text-[#64748B] text-lg">
                Temukan layanan profesional terbaik sesuai kebutuhan proyekmu
            </p>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">

            <?php
            $categories = [
                ['Desain Grafis','2.300 Freelancer'],
                ['Pengembangan Web','1.800 Freelancer'],
                ['Video & Animasi','950 Freelancer'],
                ['Pemasaran Digital','1.100 Freelancer'],
                ['Fotografi','700 Freelancer'],
                ['Audio & Musik','620 Freelancer'],
                ['Data & Analitik','540 Freelancer'],
                ['Terjemahan','870 Freelancer'],
            ];

            foreach($categories as $cat):
            ?>

            <div class="bg-white rounded-[24px] p-8 border border-[#E4EEF5] card-hover shadow-soft hover:border-[#00A9FF]">

                <div class="w-16 h-16 rounded-2xl bg-[#EAF7FF] flex items-center justify-center mb-6">

                    <svg width="32" height="32" fill="none" stroke="#00A9FF" stroke-width="2.5">
                        <circle cx="16" cy="16" r="12"/>
                        <path d="M10 16L14 20L22 12"/>
                    </svg>

                </div>

                <h3 class="font-bold text-xl mb-2">
                    <?= $cat[0] ?>
                </h3>

                <p class="text-[#64748B]">
                    <?= $cat[1] ?>
                </p>

            </div>

            <?php endforeach; ?>

        </div>

    </div>
</section>

<section class="py-24 bg-[#EAF7FF]">
    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center mb-20">
            <h2 class="text-5xl font-extrabold mb-5">
                Cara Kerja TaliWangsa
            </h2>
        </div>

        <div class="grid lg:grid-cols-4 gap-10">

            <?php
            $steps = [
                ['1','Cari & Pilih'],
                ['2','Diskusi & Sepakati'],
                ['3','Bayar ke Jalinan Aman'],
                ['4','Terima & Setujui']
            ];

            foreach($steps as $step):
            ?>

            <div class="text-center">

                <div class="w-20 h-20 rounded-full bg-[#00A9FF] text-white text-3xl font-extrabold mx-auto flex items-center justify-center mb-6">
                    <?= $step[0] ?>
                </div>

                <h3 class="text-2xl font-bold mb-4">
                    <?= $step[1] ?>
                </h3>

                <p class="text-[#64748B]">
                    Proses mudah dan aman untuk semua transaksi proyek profesional.
                </p>

            </div>

            <?php endforeach; ?>

        </div>

    </div>
</section>

<section class="py-24">
    <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-16 items-center">

        <div>

            <svg viewBox="0 0 600 350" class="w-full">

                <rect x="40" y="120" width="120" height="80" rx="20" fill="#00A9FF"/>
                <rect x="240" y="120" width="120" height="80" rx="20" fill="#4FCBFF"/>
                <rect x="440" y="120" width="120" height="80" rx="20" fill="#00A9FF"/>

                <path d="M160 160H240" stroke="#00A9FF" stroke-width="8" stroke-dasharray="10 10"/>
                <path d="M360 160H440" stroke="#00A9FF" stroke-width="8" stroke-dasharray="10 10"/>

            </svg>

        </div>

        <div>

            <h2 class="text-5xl font-extrabold mb-8">
                Sistem Escrow Aman
            </h2>

            <div class="space-y-5">

                <?php
                $benefits = [
                    'Dana aman hingga proyek selesai',
                    'Freelancer terverifikasi',
                    'Perlindungan dispute',
                    'Pembayaran transparan',
                    'Tracking proyek realtime'
                ];

                foreach($benefits as $benefit):
                ?>

                <div class="bg-white rounded-2xl p-5 flex items-center gap-4 shadow-soft card-hover">

                    <div class="w-14 h-14 rounded-xl bg-[#EAF7FF] flex items-center justify-center">
                        <svg width="26" height="26" fill="none" stroke="#00A9FF" stroke-width="3">
                            <path d="M5 13L11 19L21 7"/>
                        </svg>
                    </div>

                    <p class="font-semibold">
                        <?= $benefit ?>
                    </p>

                </div>

                <?php endforeach; ?>

            </div>

        </div>

    </div>
</section>

<section class="py-24 bg-[#EAF7FF]">
    <div class="max-w-7xl mx-auto px-6">

        <div class="flex justify-between items-center mb-14">

            <div>
                <h2 class="text-5xl font-extrabold mb-3">
                    Freelancer Unggulan
                </h2>

                <p class="text-[#64748B]">
                    Profesional terbaik dengan rating tinggi
                </p>
            </div>

            <div class="flex gap-4">
                <button onclick="scrollFreelancer(-1)" class="w-14 h-14 rounded-full bg-white shadow-soft">
                    ←
                </button>

                <button onclick="scrollFreelancer(1)" class="w-14 h-14 rounded-full bg-white shadow-soft">
                    →
                </button>
            </div>

        </div>

        <div id="freelancerScroll" class="flex gap-8 overflow-x-auto scroll-smooth pb-5">

            <?php for($i=1;$i<=5;$i++): ?>

            <div class="min-w-[320px] bg-white rounded-[28px] p-8 shadow-soft card-hover">

                <div class="w-24 h-24 rounded-full bg-[#EAF7FF] mx-auto mb-6"></div>

                <h3 class="text-2xl font-bold text-center">
                    Freelancer <?= $i ?>
                </h3>

                <p class="text-center text-[#64748B] mb-5">
                    UI/UX Designer Professional
                </p>

                <div class="flex flex-wrap justify-center gap-2 mb-6">
                    <span class="bg-[#EAF7FF] px-3 py-1 rounded-full text-sm">
                        Figma
                    </span>

                    <span class="bg-[#EAF7FF] px-3 py-1 rounded-full text-sm">
                        UI Design
                    </span>

                    <span class="bg-[#EAF7FF] px-3 py-1 rounded-full text-sm">
                        Branding
                    </span>
                </div>

                <div class="flex justify-between items-center mb-6">
                    <div class="text-[#00A9FF] font-bold">
                        ★ 4.9
                    </div>

                    <div class="font-bold">
                        Mulai 350k
                    </div>
                </div>

                <button class="w-full border border-[#00A9FF] text-[#00A9FF] py-3 rounded-2xl btn-hover">
                    Lihat Profil
                </button>

            </div>

            <?php endfor; ?>

        </div>

    </div>
</section>

<section class="py-24">
    <div class="max-w-7xl mx-auto px-6">

        <div class="text-center mb-16">
            <h2 class="text-5xl font-extrabold mb-4">
                Apa Kata Mereka?
            </h2>

            <p class="text-[#64748B] text-lg">
                Ribuan pengguna mempercayai TaliWangsa
            </p>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">

            <?php for($i=1;$i<=3;$i++): ?>

            <div class="bg-white rounded-[28px] p-8 shadow-soft card-hover">

                <div class="text-6xl text-[#00A9FF] font-extrabold mb-6">
                    “
                </div>

                <p class="text-[#64748B] leading-relaxed mb-8">
                    Platform terbaik untuk mencari freelancer profesional dengan proses pembayaran aman dan cepat.
                </p>

                <div class="flex items-center gap-4">

                    <div class="w-14 h-14 rounded-full bg-[#EAF7FF]"></div>

                    <div>
                        <h4 class="font-bold">
                            User <?= $i ?>
                        </h4>

                        <p class="text-[#64748B] text-sm">
                            Business Owner
                        </p>

                        <div class="text-[#00A9FF] mt-1">
                            ★★★★★
                        </div>
                    </div>

                </div>

            </div>

            <?php endfor; ?>

        </div>

    </div>
</section>

<section class="py-24 bg-[#EAF7FF]">
    <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-20 items-center">

        <div>

            <h2 class="text-5xl font-extrabold mb-10">
                Pertanyaan Umum
            </h2>

            <div class="space-y-5">

                <?php for($i=1;$i<=8;$i++): ?>

                <div class="bg-white rounded-2xl shadow-soft overflow-hidden">

                    <button class="faq-btn w-full text-left px-6 py-5 flex justify-between items-center">

                        <span class="font-semibold">
                            Pertanyaan umum <?= $i ?>?
                        </span>

                        <span class="text-[#00A9FF] text-2xl">
                            +
                        </span>

                    </button>

                    <div class="faq-content px-6">
                        <div class="pb-5 text-[#64748B] leading-relaxed">
                            TaliWangsa menyediakan sistem marketplace freelancer profesional dengan escrow aman.
                        </div>
                    </div>

                </div>

                <?php endfor; ?>

            </div>

        </div>

        <div class="flex justify-center">

            <svg viewBox="0 0 500 500" class="w-full max-w-md">

                <circle cx="250" cy="250" r="200" fill="#DDF3FF"/>

                <circle cx="250" cy="180" r="70" fill="#00A9FF"/>

                <rect x="170" y="260" width="160" height="120" rx="40" fill="#00A9FF"/>

                <circle cx="370" cy="130" r="40" fill="white"/>
                <text x="355" y="145" fill="#00A9FF" font-size="40">?</text>

                <circle cx="120" cy="180" r="32" fill="white"/>
                <text x="108" y="192" fill="#00A9FF" font-size="30">?</text>

            </svg>

        </div>

    </div>
</section>

<section class="py-24 bg-gradient-to-r from-[#00A9FF] to-[#4FCBFF] overflow-hidden">
    <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-16 items-center">

        <div>

            <h2 class="text-5xl text-white font-extrabold leading-tight mb-6">
                Mulai Bangun Proyek Impian Bersama Talenta Terbaik
            </h2>

            <p class="text-white/90 text-xl leading-relaxed mb-10">
                Bergabung dengan ribuan klien dan freelancer profesional di TaliWangsa sekarang juga.
            </p>

            <div class="flex flex-wrap gap-5">

                <a href="/register"
                   class="bg-white text-[#00A9FF] px-8 py-4 rounded-2xl font-semibold btn-hover">
                    Daftar Klien
                </a>

                <a href="/register"
                   class="border border-white text-white px-8 py-4 rounded-2xl font-semibold btn-hover">
                    Bergabung Freelancer
                </a>

            </div>

        </div>

        <div class="relative h-[350px]">

            <div class="notif-float absolute top-0 right-10 bg-white rounded-3xl p-5 shadow-soft w-72">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-[#EAF7FF]"></div>

                    <div>
                        <h4 class="font-bold">
                            Proyek Baru
                        </h4>

                        <p class="text-sm text-[#64748B]">
                            Website Company Profile
                        </p>
                    </div>
                </div>
            </div>

            <div class="notif-float absolute top-32 left-0 bg-white rounded-3xl p-5 shadow-soft w-72"
                 style="animation-delay:1s">

                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-[#EAF7FF]"></div>

                    <div>
                        <h4 class="font-bold">
                            Pembayaran Aman
                        </h4>

                        <p class="text-sm text-[#64748B]">
                            Dana ditahan escrow
                        </p>
                    </div>
                </div>

            </div>

            <div class="notif-float absolute bottom-0 right-0 bg-white rounded-3xl p-5 shadow-soft w-72"
                 style="animation-delay:2s">

                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 rounded-full bg-[#EAF7FF]"></div>

                    <div>
                        <h4 class="font-bold">
                            Freelancer Online
                        </h4>

                        <p class="text-sm text-[#64748B]">
                            1.200+ tersedia hari ini
                        </p>
                    </div>
                </div>

            </div>

        </div>

    </div>
</section>

<?= $this->endSection() ?>
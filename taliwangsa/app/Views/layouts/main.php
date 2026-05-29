<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'TaliWangsa' ?></title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">

    <style>
        body{
            font-family: 'Inter', sans-serif;
            background:#F5FAFD;
            color:#1F2937;
        }

        h1,h2,h3,h4,h5,h6{
            font-family:'Poppins',sans-serif;
        }

        .card-hover{
            transition:300ms;
        }

        .card-hover:hover{
            transform:translateY(-4px);
        }

        .btn-hover{
            transition:200ms;
        }

        .btn-hover:hover{
            transform:scale(1.05);
        }

        .shadow-soft{
            box-shadow:0 4px 24px rgba(0,169,255,0.08);
        }

        .dot-grid{
            background-image: radial-gradient(#cfeeff 1px, transparent 1px);
            background-size: 18px 18px;
        }

        .faq-content{
            max-height:0;
            overflow:hidden;
            transition:max-height .4s ease;
        }

        .notif-float{
            animation: floatNotif 4s infinite ease-in-out;
        }

        @keyframes floatNotif{
            0%{transform:translateY(0)}
            50%{transform:translateY(-10px)}
            100%{transform:translateY(0)}
        }

        .footer-dots{
            background-image: radial-gradient(rgba(255,255,255,.08) 1px, transparent 1px);
            background-size:18px 18px;
        }
    </style>
</head>
<body>

<nav id="navbar" class="fixed top-0 left-0 w-full z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between items-center py-5">

            <div class="flex items-center gap-3">
                <svg width="42" height="42" viewBox="0 0 64 64" fill="none">
                    <path d="M8 42H56" stroke="#00A9FF" stroke-width="4" stroke-linecap="round"/>
                    <path d="M18 42L26 22" stroke="#00A9FF" stroke-width="4"/>
                    <path d="M46 42L38 22" stroke="#00A9FF" stroke-width="4"/>
                    <path d="M26 22H38" stroke="#00A9FF" stroke-width="4"/>
                    <path d="M14 32H50" stroke="#00A9FF" stroke-width="4" stroke-dasharray="5 5"/>
                </svg>

                <div>
                    <h1 class="text-2xl font-extrabold text-[#00A9FF]">
                        TaliWangsa
                    </h1>
                </div>
            </div>

            <div class="hidden lg:flex items-center gap-10">
                <a href="/marketplace" class="text-[#64748B] hover:text-[#00A9FF]">Cari Jasa</a>
                <a href="/marketplace" class="text-[#64748B] hover:text-[#00A9FF]">Kategori</a>
                <a href="/how-it-works" class="text-[#64748B] hover:text-[#00A9FF]">Cara Kerja</a>
            </div>

            <div class="hidden lg:flex items-center gap-4">
                <a href="/login" class="border border-[#00A9FF] text-[#00A9FF] px-5 py-2 rounded-xl btn-hover">
                    Masuk
                </a>

                <a href="/register" class="bg-[#00A9FF] hover:bg-[#0094E0] text-white px-5 py-2 rounded-xl btn-hover">
                    Daftar
                </a>
            </div>

            <button id="menuBtn" class="lg:hidden">
                <svg width="30" height="30" fill="none" stroke="#1F2937" stroke-width="2">
                    <path d="M4 8H26"/>
                    <path d="M4 15H26"/>
                    <path d="M4 22H26"/>
                </svg>
            </button>
        </div>

        <div id="mobileMenu" class="hidden pb-5 lg:hidden">
            <div class="bg-white rounded-2xl shadow-soft p-5 flex flex-col gap-4">
                <a href="/marketplace">Cari Jasa</a>
                <a href="/marketplace">Kategori</a>
                <a href="/how-it-works">Cara Kerja</a>

                <a href="/login" class="border border-[#00A9FF] text-center text-[#00A9FF] py-3 rounded-xl">
                    Masuk
                </a>

                <a href="/register" class="bg-[#00A9FF] text-center text-white py-3 rounded-xl">
                    Daftar
                </a>
            </div>
        </div>
    </div>
</nav>

<?= $this->renderSection('content') ?>

<footer class="bg-[#1F2937] footer-dots text-white pt-20 pb-10 mt-20">
    <div class="max-w-7xl mx-auto px-6">

        <div class="grid lg:grid-cols-5 gap-10">

            <div>
                <h2 class="text-3xl font-extrabold mb-4">
                    TaliWangsa
                </h2>

                <p class="text-gray-300 leading-relaxed">
                    Marketplace jasa profesional terpercaya untuk menghubungkan talenta terbaik dengan proyek impian.
                </p>
            </div>

            <div>
                <h3 class="font-bold mb-5">Marketplace</h3>

                <div class="flex flex-col gap-3 text-gray-300">
                    <a href="/marketplace">Cari Freelancer</a>
                    <a href="/marketplace">Kategori</a>
                    <a href="/marketplace">Proyek</a>
                    <a href="#">Portfolio</a>
                </div>
            </div>

            <div>
                <h3 class="font-bold mb-5">Perusahaan</h3>

                <div class="flex flex-col gap-3 text-gray-300">
                    <a href="#">Tentang</a>
                    <a href="#">Karir</a>
                    <a href="#">Blog</a>
                    <a href="#">Kontak</a>
                </div>
            </div>

            <div>
                <h3 class="font-bold mb-5">Bantuan</h3>

                <div class="flex flex-col gap-3 text-gray-300">
                    <a href="#">FAQ</a>
                    <a href="#">Support</a>
                    <a href="#">Privasi</a>
                    <a href="#">Syarat</a>
                </div>
            </div>

            <div>
                <h3 class="font-bold mb-5">
                    Newsletter
                </h3>

                <div class="flex">
                    <input type="text" placeholder="Email kamu"
                        class="w-full px-4 py-3 rounded-l-xl text-black outline-none">

                    <button class="bg-[#00A9FF] px-5 rounded-r-xl">
                        Kirim
                    </button>
                </div>
            </div>
        </div>

        <div class="border-t border-white/10 mt-14 pt-6 text-center text-gray-400">
            © 2026 TaliWangsa. Semua hak dilindungi.
        </div>
    </div>
</footer>

<script>
    const navbar = document.getElementById('navbar');

    window.addEventListener('scroll', () => {
        if(window.scrollY > 20){
            navbar.classList.add('bg-white','shadow-lg');
        }else{
            navbar.classList.remove('bg-white','shadow-lg');
        }
    });

    const menuBtn = document.getElementById('menuBtn');
    const mobileMenu = document.getElementById('mobileMenu');

    menuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });

    document.querySelectorAll('.faq-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const content = btn.nextElementSibling;

            if(content.style.maxHeight){
                content.style.maxHeight = null;
            }else{
                content.style.maxHeight = content.scrollHeight + 'px';
            }
        });
    });

    const counters = document.querySelectorAll('.counter');

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {

            if(entry.isIntersecting){

                const el = entry.target;
                const target = +el.dataset.target;

                let count = 0;

                const update = () => {
                    count += Math.ceil(target / 50);

                    if(count >= target){
                        el.innerText = target.toLocaleString();
                    }else{
                        el.innerText = count.toLocaleString();
                        requestAnimationFrame(update);
                    }
                }

                update();

                observer.unobserve(el);
            }

        });
    });

    counters.forEach(counter => {
        observer.observe(counter);
    });

    function scrollFreelancer(direction){
        const container = document.getElementById('freelancerScroll');

        container.scrollBy({
            left: direction * 320,
            behavior:'smooth'
        });
    }
</script>

</body>
</html>
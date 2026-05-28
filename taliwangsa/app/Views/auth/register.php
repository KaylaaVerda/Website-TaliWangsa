<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - TaliWangsa</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Poppins:wght@500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body{
            font-family:'Inter',sans-serif;
            background:#F5FAFD;
        }

        h1,h2,h3{
            font-family:'Poppins',sans-serif;
        }

        .shadow-soft{
            box-shadow:0 4px 24px rgba(0,169,255,0.08);
        }

        .role-card.active{
            border:2px solid #00A9FF;
            background:#EAF7FF;
        }
    </style>
</head>
<body>

<div class="min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-5xl">

        <div class="text-center mb-12">

            <h1 class="text-5xl font-extrabold mb-4">
                Bergabung dengan TaliWangsa
            </h1>

            <p class="text-gray-500 text-lg">
                Pilih peran dan mulai perjalanan profesionalmu
            </p>

        </div>

        <?php if(session()->getFlashdata('error')): ?>

        <div class="bg-red-100 border border-red-300 text-red-600 px-4 py-4 rounded-2xl mb-6">
            <?= session()->getFlashdata('error') ?>
        </div>

        <?php endif; ?>

        <div class="grid lg:grid-cols-2 gap-8 mb-10">

            <div onclick="selectRole('client')"
                id="clientCard"
                class="role-card bg-white rounded-[24px] p-10 shadow-soft cursor-pointer transition">

                <div class="w-20 h-20 rounded-3xl bg-[#EAF7FF] flex items-center justify-center mb-6 text-4xl">
                    👨‍💼
                </div>

                <h3 class="text-3xl font-bold mb-4">
                    Saya ingin Menyewa Jasa
                </h3>

                <p class="text-gray-500 leading-relaxed">
                    Cari freelancer terbaik untuk membantu kebutuhan proyek bisnis dan kreatifmu.
                </p>

            </div>

            <div onclick="selectRole('freelancer')"
                id="freelancerCard"
                class="role-card bg-white rounded-[24px] p-10 shadow-soft cursor-pointer transition">

                <div class="w-20 h-20 rounded-3xl bg-[#EAF7FF] flex items-center justify-center mb-6 text-4xl">
                    🎨
                </div>

                <h3 class="text-3xl font-bold mb-4">
                    Saya ingin Menawarkan Jasa
                </h3>

                <p class="text-gray-500 leading-relaxed">
                    Tawarkan skill profesionalmu dan dapatkan klien berkualitas dari seluruh Indonesia.
                </p>

            </div>

        </div>

        <div id="registerForm"
            class="hidden bg-white rounded-[24px] p-10 shadow-soft">

            <form action="/register"
                method="POST"
                onsubmit="return validateForm()">

                <input type="hidden" name="role" id="roleInput">

                <div class="grid lg:grid-cols-2 gap-6">

                    <div>
                        <label class="font-semibold block mb-2">
                            Nama Lengkap
                        </label>

                        <input type="text"
                            id="name"
                            name="name"
                            class="w-full px-5 py-4 rounded-2xl border border-gray-200 outline-none focus:border-[#00A9FF]">
                    </div>

                    <div>
                        <label class="font-semibold block mb-2">
                            Email
                        </label>

                        <input type="email"
                            id="email"
                            name="email"
                            class="w-full px-5 py-4 rounded-2xl border border-gray-200 outline-none focus:border-[#00A9FF]">
                    </div>

                    <div>
                        <label class="font-semibold block mb-2">
                            Nomor HP
                        </label>

                        <input type="text"
                            id="phone"
                            name="phone"
                            class="w-full px-5 py-4 rounded-2xl border border-gray-200 outline-none focus:border-[#00A9FF]">
                    </div>

                    <div>
                        <label class="font-semibold block mb-2">
                            Password
                        </label>

                        <input type="password"
                            id="password"
                            name="password"
                            class="w-full px-5 py-4 rounded-2xl border border-gray-200 outline-none focus:border-[#00A9FF]">
                    </div>

                    <div class="lg:col-span-2">
                        <label class="font-semibold block mb-2">
                            Konfirmasi Password
                        </label>

                        <input type="password"
                            id="confirm"
                            name="confirm_password"
                            class="w-full px-5 py-4 rounded-2xl border border-gray-200 outline-none focus:border-[#00A9FF]">
                    </div>

                </div>

                <label class="flex items-center gap-3 mt-6">
                    <input type="checkbox" id="terms">
                    <span>
                        Saya menyetujui syarat & ketentuan
                    </span>
                </label>

                <button class="w-full bg-[#00A9FF] hover:bg-[#0094E0] text-white py-4 rounded-2xl font-semibold mt-8 transition">
                    Daftar Sekarang
                </button>

            </form>

            <p class="text-center text-gray-500 mt-8">
                Sudah punya akun?
                <a href="/login" class="text-[#00A9FF] font-semibold">
                    Login
                </a>
            </p>

        </div>

    </div>

</div>

<script>

function selectRole(role){

    document.getElementById('registerForm').classList.remove('hidden');

    document.getElementById('roleInput').value = role;

    document.getElementById('clientCard').classList.remove('active');
    document.getElementById('freelancerCard').classList.remove('active');

    if(role === 'client'){
        document.getElementById('clientCard').classList.add('active');
    }else{
        document.getElementById('freelancerCard').classList.add('active');
    }
}

function validateForm(){

    const name = document.getElementById('name').value;
    const email = document.getElementById('email').value;
    const phone = document.getElementById('phone').value;
    const password = document.getElementById('password').value;
    const confirm = document.getElementById('confirm').value;
    const terms = document.getElementById('terms').checked;

    if(!name || !email || !phone || !password || !confirm){
        alert('Semua field wajib diisi.');
        return false;
    }

    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if(!emailRegex.test(email)){
        alert('Format email tidak valid.');
        return false;
    }

    if(password !== confirm){
        alert('Password tidak cocok.');
        return false;
    }

    if(!terms){
        alert('Anda harus menyetujui syarat & ketentuan.');
        return false;
    }

    return true;
}

</script>

</body>
</html>
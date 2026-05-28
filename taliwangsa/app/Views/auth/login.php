<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TaliWangsa</title>

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
    </style>
</head>
<body>

<div class="min-h-screen grid lg:grid-cols-2">

    <div class="hidden lg:flex bg-gradient-to-br from-[#00A9FF] to-[#4FCBFF] p-16 text-white relative overflow-hidden">

        <div class="relative z-10">

            <h1 class="text-6xl font-extrabold mb-6">
                TaliWangsa
            </h1>

            <p class="text-2xl leading-relaxed mb-14">
                Platform freelancer profesional terpercaya untuk membangun proyek impianmu.
            </p>

            <div class="space-y-8">

                <div class="flex items-center gap-5">
                    <div class="w-16 h-16 rounded-2xl bg-white/20 flex items-center justify-center">
                        🔒
                    </div>

                    <div>
                        <h3 class="text-2xl font-bold">
                            Aman
                        </h3>

                        <p class="text-white/90">
                            Sistem escrow dan pembayaran terlindungi
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-5">
                    <div class="w-16 h-16 rounded-2xl bg-white/20 flex items-center justify-center">
                        ✔
                    </div>

                    <div>
                        <h3 class="text-2xl font-bold">
                            Terverifikasi
                        </h3>

                        <p class="text-white/90">
                            Freelancer berkualitas dan profesional
                        </p>
                    </div>
                </div>

                <div class="flex items-center gap-5">
                    <div class="w-16 h-16 rounded-2xl bg-white/20 flex items-center justify-center">
                        ★
                    </div>

                    <div>
                        <h3 class="text-2xl font-bold">
                            Terpercaya
                        </h3>

                        <p class="text-white/90">
                            Digunakan ribuan klien di Indonesia
                        </p>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <div class="flex items-center justify-center p-6">

        <div class="bg-white w-full max-w-md rounded-[24px] p-10 shadow-soft">

            <h2 class="text-4xl font-extrabold mb-3">
                Selamat Datang Kembali
            </h2>

            <p class="text-gray-500 mb-8">
                Masuk untuk melanjutkan ke akun TaliWangsa
            </p>

            <?php if(session()->getFlashdata('error')): ?>

            <div class="bg-red-100 border border-red-300 text-red-600 px-4 py-3 rounded-2xl mb-6">
                <?= session()->getFlashdata('error') ?>
            </div>

            <?php endif; ?>

            <form action="/login" method="POST">

                <div class="mb-5">
                    <label class="font-semibold mb-2 block">
                        Email
                    </label>

                    <input type="email"
                        name="email"
                        required
                        class="w-full px-5 py-4 rounded-2xl border border-gray-200 outline-none focus:border-[#00A9FF]"
                        placeholder="Masukkan email">
                </div>

                <div class="mb-5">
                    <label class="font-semibold mb-2 block">
                        Password
                    </label>

                    <div class="relative">

                        <input type="password"
                            id="password"
                            name="password"
                            required
                            class="w-full px-5 py-4 rounded-2xl border border-gray-200 outline-none focus:border-[#00A9FF]"
                            placeholder="Masukkan password">

                        <button type="button"
                            onclick="togglePassword()"
                            class="absolute right-5 top-4 text-gray-500">
                            👁
                        </button>

                    </div>
                </div>

                <div class="flex justify-between items-center mb-8">

                    <label class="flex items-center gap-2 text-sm">
                        <input type="checkbox">
                        Remember me
                    </label>

                    <a href="#" class="text-[#00A9FF] text-sm">
                        Lupa Password?
                    </a>

                </div>

                <button class="w-full bg-[#00A9FF] hover:bg-[#0094E0] text-white py-4 rounded-2xl font-semibold transition">
                    Masuk
                </button>

                <div class="text-center text-gray-400 my-6">
                    atau
                </div>

                <button type="button"
                    class="w-full border border-gray-200 py-4 rounded-2xl font-semibold">
                    Login dengan Google
                </button>

            </form>

            <p class="text-center text-gray-500 mt-8">
                Belum punya akun?
                <a href="/register" class="text-[#00A9FF] font-semibold">
                    Daftar
                </a>
            </p>

        </div>

    </div>

</div>

<script>
function togglePassword(){
    const input = document.getElementById('password');

    if(input.type === 'password'){
        input.type = 'text';
    }else{
        input.type = 'password';
    }
}
</script>

</body>
</html>
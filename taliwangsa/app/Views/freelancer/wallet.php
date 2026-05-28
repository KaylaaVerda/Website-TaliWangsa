<?= $this->extend('layouts/freelancer') ?>

<?= $this->section('content') ?>

<div class="space-y-6">

    <!-- HEADER -->
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Wallet & Penarikan Dana
            </h1>

            <p class="text-slate-500 mt-1">
                Kelola saldo, pemasukan, dan penarikan dana freelancer.
            </p>
        </div>

        <button
            onclick="openWithdrawModal()"
            class="bg-[#00A9FF] hover:bg-[#0094E0] text-white px-6 py-3 rounded-2xl font-semibold transition">
            Tarik Dana
        </button>

    </div>

    <!-- WALLET CARD -->
    <div class="bg-gradient-to-r from-[#00A9FF] to-cyan-500 rounded-[28px] p-8 text-white shadow-lg">

        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">

            <div>

                <p class="text-white/80 text-sm mb-2">
                    Saldo Tersedia
                </p>

                <h2 class="text-5xl font-extrabold">
                    Rp <?= number_format($balance ?? 0,0,',','.') ?>
                </h2>

                <div class="flex items-center gap-6 mt-6 text-sm text-white/90">

                    <div>
                        <p>Total Pemasukan</p>
                        <h4 class="font-bold text-lg">
                            Rp <?= number_format($totalIncome ?? 0,0,',','.') ?>
                        </h4>
                    </div>

                    <div>
                        <p>Total Penarikan</p>
                        <h4 class="font-bold text-lg">
                            Rp <?= number_format($totalWithdraw ?? 0,0,',','.') ?>
                        </h4>
                    </div>

                </div>

            </div>

            <div class="bg-white/10 backdrop-blur-md rounded-3xl p-6 w-full lg:w-[300px]">

                <h4 class="font-semibold mb-4">
                    Statistik Wallet
                </h4>

                <div class="space-y-4">

                    <div class="flex justify-between">
                        <span class="text-white/80">
                            Transaksi Masuk
                        </span>

                        <span class="font-bold">
                            <?= $incomingCount ?? 0 ?>
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-white/80">
                            Penarikan
                        </span>

                        <span class="font-bold">
                            <?= $withdrawCount ?? 0 ?>
                        </span>
                    </div>

                    <div class="flex justify-between">
                        <span class="text-white/80">
                            Status Akun
                        </span>

                        <span class="font-bold text-green-200">
                            Aktif
                        </span>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- FILTER -->
    <div class="bg-white rounded-[24px] p-5 shadow-soft flex flex-col lg:flex-row gap-4 lg:items-center lg:justify-between">

        <div>

            <h3 class="font-bold text-xl text-slate-800">
                Riwayat Transaksi
            </h3>

            <p class="text-slate-500 text-sm mt-1">
                Semua pemasukan dan pengeluaran wallet freelancer.
            </p>

        </div>

        <form method="GET" class="flex gap-3">

            <select
                name="type"
                class="px-4 py-3 rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#00A9FF]">

                <option value="">
                    Semua Tipe
                </option>

                <option value="Masuk" <?= request()->getGet('type') == 'Masuk' ? 'selected' : '' ?>>
                    Masuk
                </option>

                <option value="Keluar" <?= request()->getGet('type') == 'Keluar' ? 'selected' : '' ?>>
                    Keluar
                </option>

            </select>

            <button
                class="bg-[#00A9FF] text-white px-5 rounded-2xl font-semibold">
                Filter
            </button>

        </form>

    </div>

    <!-- TABLE -->
    <div class="bg-white rounded-[28px] shadow-soft overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full min-w-[900px]">

                <thead class="bg-[#F5FAFD]">

                    <tr>

                        <th class="text-left px-6 py-5 text-slate-600 font-semibold">
                            Tanggal
                        </th>

                        <th class="text-left px-6 py-5 text-slate-600 font-semibold">
                            Keterangan
                        </th>

                        <th class="text-left px-6 py-5 text-slate-600 font-semibold">
                            Tipe
                        </th>

                        <th class="text-left px-6 py-5 text-slate-600 font-semibold">
                            Jumlah
                        </th>

                        <th class="text-left px-6 py-5 text-slate-600 font-semibold">
                            Status
                        </th>

                    </tr>

                </thead>

                <tbody>

                    <?php foreach($transactions as $trx): ?>

                    <tr class="border-b border-slate-100 hover:bg-slate-50 transition">

                        <td class="px-6 py-5 text-slate-700">
                            <?= $trx['date'] ?>
                        </td>

                        <td class="px-6 py-5">

                            <div class="font-semibold text-slate-800">
                                <?= $trx['description'] ?>
                            </div>

                        </td>

                        <td class="px-6 py-5">

                            <?php if($trx['type'] == 'Masuk'): ?>

                            <span class="bg-green-100 text-green-600 px-4 py-2 rounded-full text-sm font-semibold">
                                Masuk
                            </span>

                            <?php else: ?>

                            <span class="bg-red-100 text-red-600 px-4 py-2 rounded-full text-sm font-semibold">
                                Keluar
                            </span>

                            <?php endif; ?>

                        </td>

                        <td class="px-6 py-5 font-bold">

                            <?php if($trx['type'] == 'Masuk'): ?>

                            <span class="text-green-600">
                                + Rp <?= number_format($trx['amount'],0,',','.') ?>
                            </span>

                            <?php else: ?>

                            <span class="text-red-600">
                                - Rp <?= number_format($trx['amount'],0,',','.') ?>
                            </span>

                            <?php endif; ?>

                        </td>

                        <td class="px-6 py-5">

                            <span class="bg-blue-100 text-blue-600 px-4 py-2 rounded-full text-sm font-semibold">
                                <?= $trx['status'] ?>
                            </span>

                        </td>

                    </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

<!-- MODAL -->
<div
    id="withdrawModal"
    class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center p-4">

    <div class="bg-white rounded-[28px] w-full max-w-2xl p-8 relative animate-fadeIn">

        <button
            onclick="closeWithdrawModal()"
            class="absolute top-5 right-5 text-2xl text-slate-400 hover:text-red-500">
            ×
        </button>

        <h2 class="text-3xl font-bold text-slate-800 mb-2">
            Tarik Dana
        </h2>

        <p class="text-slate-500 mb-8">
            Minimum penarikan Rp 50.000
        </p>

        <form action="/freelancer/withdraw" method="POST" class="space-y-6">

            <?= csrf_field() ?>

            <div>

                <label class="block mb-2 font-semibold text-slate-700">
                    Pilih Bank
                </label>

                <select
                    name="bank"
                    required
                    class="w-full border border-slate-200 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-[#00A9FF]">

                    <option value="">
                        Pilih Bank
                    </option>

                    <option value="BCA">BCA</option>
                    <option value="BRI">BRI</option>
                    <option value="BNI">BNI</option>
                    <option value="Mandiri">Mandiri</option>
                    <option value="BSI">BSI</option>

                </select>

            </div>

            <div>

                <label class="block mb-2 font-semibold text-slate-700">
                    Nomor Rekening
                </label>

                <input
                    type="text"
                    name="rekening"
                    required
                    class="w-full border border-slate-200 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-[#00A9FF]">

            </div>

            <div>

                <label class="block mb-2 font-semibold text-slate-700">
                    Nama Pemilik Rekening
                </label>

                <input
                    type="text"
                    name="owner"
                    required
                    class="w-full border border-slate-200 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-[#00A9FF]">

            </div>

            <div>

                <label class="block mb-2 font-semibold text-slate-700">
                    Nominal Penarikan
                </label>

                <input
                    type="number"
                    name="amount"
                    min="50000"
                    required
                    class="w-full border border-slate-200 rounded-2xl px-5 py-4 focus:outline-none focus:ring-2 focus:ring-[#00A9FF]">

            </div>

            <button
                class="w-full bg-[#00A9FF] hover:bg-[#0094E0] text-white py-4 rounded-2xl font-bold text-lg transition">
                Ajukan Penarikan
            </button>

        </form>

    </div>

</div>

<script>

function openWithdrawModal(){

    document.getElementById('withdrawModal').classList.remove('hidden');
}

function closeWithdrawModal(){

    document.getElementById('withdrawModal').classList.add('hidden');
}

</script>

<?= $this->endSection() ?>
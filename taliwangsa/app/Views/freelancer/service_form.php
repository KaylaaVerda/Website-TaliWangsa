<?= $this->extend('layouts/freelancer') ?>
<?= $this->section('content') ?>

<div class="space-y-6">

    <div>

        <h1 class="text-3xl font-bold text-slate-800">
            Tambah Layanan Baru
        </h1>

        <p class="text-slate-500 mt-1">
            Lengkapi informasi layanan freelancer Anda
        </p>

    </div>

    <div class="bg-white rounded-3xl shadow-soft p-8">

        <!-- STEPPER -->
        <div class="flex items-center justify-between mb-10 overflow-x-auto">

            <div class="stepItem flex flex-col items-center flex-1">

                <div class="stepCircle w-12 h-12 rounded-full bg-[#00A9FF] text-white flex items-center justify-center font-bold">
                    1
                </div>

                <p class="mt-3 text-sm font-semibold text-[#00A9FF]">
                    Info Dasar
                </p>

            </div>

            <div class="h-1 flex-1 bg-slate-200"></div>

            <div class="stepItem flex flex-col items-center flex-1">

                <div class="stepCircle w-12 h-12 rounded-full bg-slate-200 text-slate-500 flex items-center justify-center font-bold">
                    2
                </div>

                <p class="mt-3 text-sm font-semibold text-slate-500">
                    Paket
                </p>

            </div>

            <div class="h-1 flex-1 bg-slate-200"></div>

            <div class="stepItem flex flex-col items-center flex-1">

                <div class="stepCircle w-12 h-12 rounded-full bg-slate-200 text-slate-500 flex items-center justify-center font-bold">
                    3
                </div>

                <p class="mt-3 text-sm font-semibold text-slate-500">
                    Persyaratan
                </p>

            </div>

            <div class="h-1 flex-1 bg-slate-200"></div>

            <div class="stepItem flex flex-col items-center flex-1">

                <div class="stepCircle w-12 h-12 rounded-full bg-slate
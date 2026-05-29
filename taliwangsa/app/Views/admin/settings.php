<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<?php
    $settings = $settings ?? [];
    $platformName = $settings['platform_name'] ?? 'TaliWangsa';
    $tagline = $settings['tagline'] ?? 'Marketplace jasa kreatif dan profesional.';
    $contactEmail = $settings['contact_email'] ?? 'support@taliwangsa.id';
    $whatsappNumber = $settings['whatsapp_number'] ?? '+6281234567890';
    $feePercent = $settings['fee_percent'] ?? 10;
    $minWithdrawal = $settings['min_withdrawal'] ?? 150000;
?>

<div class="space-y-6">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Pengaturan Platform</h1>
            <p class="text-slate-500 mt-1">Kelola konfigurasi umum dan komisi platform.</p>
        </div>
    </div>

    <?php if(session()->getFlashdata('success')): ?>
    <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-3xl p-5 shadow-sm">
        <?= session()->getFlashdata('success') ?>
    </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
        <div class="bg-white rounded-3xl p-6 shadow-sm">
            <div class="mb-6">
                <h2 class="text-xl font-bold text-slate-900">Umum</h2>
                <p class="text-slate-500 text-sm">Informasi dasar platform yang tampil di dashboard admin.</p>
            </div>

            <form method="POST" action="/admin/settings" class="space-y-5">
                <input type="hidden" name="group" value="general">
                <div>
                    <label class="text-sm font-semibold text-slate-600 mb-2 block">Nama Platform</label>
                    <input type="text" name="platform_name" value="<?= esc($platformName) ?>" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#00A9FF]">
                </div>
                <div>
                    <label class="text-sm font-semibold text-slate-600 mb-2 block">Tagline</label>
                    <input type="text" name="tagline" value="<?= esc($tagline) ?>" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#00A9FF]">
                </div>
                <div>
                    <label class="text-sm font-semibold text-slate-600 mb-2 block">Email Kontak</label>
                    <input type="email" name="contact_email" value="<?= esc($contactEmail) ?>" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#00A9FF]">
                </div>
                <div>
                    <label class="text-sm font-semibold text-slate-600 mb-2 block">Nomor WhatsApp</label>
                    <input type="text" name="whatsapp_number" value="<?= esc($whatsappNumber) ?>" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#00A9FF]">
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-[#00A9FF] hover:bg-[#0094E0] text-white rounded-2xl px-6 py-3 font-semibold">Simpan Pengaturan</button>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-3xl p-6 shadow-sm">
            <div class="mb-6">
                <h2 class="text-xl font-bold text-slate-900">Komisi</h2>
                <p class="text-slate-500 text-sm">Tentukan biaya platform dan minimum penarikan.</p>
            </div>

            <form method="POST" action="/admin/settings" class="space-y-5">
                <input type="hidden" name="group" value="commission">
                <div>
                    <label class="text-sm font-semibold text-slate-600 mb-2 block">Platform Fee (%)</label>
                    <input type="number" name="fee_percent" value="<?= esc($feePercent) ?>" min="0" max="100" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#00A9FF]">
                </div>
                <div>
                    <label class="text-sm font-semibold text-slate-600 mb-2 block">Minimum Penarikan</label>
                    <div class="relative">
                        <span class="absolute left-4 top-4 text-slate-500">Rp</span>
                        <input type="number" name="min_withdrawal" value="<?= esc($minWithdrawal) ?>" min="0" class="w-full border border-slate-200 rounded-2xl px-12 py-3 focus:outline-none focus:ring-2 focus:ring-[#00A9FF]">
                    </div>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="bg-[#00A9FF] hover:bg-[#0094E0] text-white rounded-2xl px-6 py-3 font-semibold">Simpan Komisi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

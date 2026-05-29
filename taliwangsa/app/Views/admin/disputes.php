<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="space-y-6">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Sengketa</h1>
            <p class="text-slate-500 mt-1">Kelola sengketa aktif dan beri keputusan cepat.</p>
        </div>
    </div>

    <div class="bg-white rounded-3xl p-6 shadow-sm overflow-x-auto">
        <table class="w-full min-w-[1000px]">
            <thead class="bg-[#F8FAFC] border-b border-slate-200">
                <tr>
                    <th class="text-left px-6 py-4 text-sm font-bold text-slate-600">Order ID</th>
                    <th class="text-left px-6 py-4 text-sm font-bold text-slate-600">Pelapor</th>
                    <th class="text-left px-6 py-4 text-sm font-bold text-slate-600">Alasan</th>
                    <th class="text-left px-6 py-4 text-sm font-bold text-slate-600">Status</th>
                    <th class="text-left px-6 py-4 text-sm font-bold text-slate-600">Tanggal</th>
                    <th class="text-center px-6 py-4 text-sm font-bold text-slate-600">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($disputes)): ?>
                <tr><td colspan="6" class="text-center px-6 py-10 text-slate-500">Tidak ada sengketa aktif saat ini.</td></tr>
                <?php endif; ?>
                <?php foreach($disputes as $dispute): ?>
                <tr class="border-b border-slate-100 hover:bg-slate-50 transition">
                    <td class="px-6 py-5 font-semibold text-slate-800">#<?= esc($dispute->order_number ?? $dispute->order_id) ?></td>
                    <td class="px-6 py-5 text-slate-600"><?= esc($dispute->reporter_name) ?></td>
                    <td class="px-6 py-5 text-slate-600 line-clamp-2"><?= esc($dispute->reason) ?></td>
                    <td class="px-6 py-5">
                        <?php
                            $badge = 'bg-slate-100 text-slate-600';
                            if($dispute->status === 'open') { $badge = 'bg-red-100 text-red-600'; }
                            elseif($dispute->status === 'under_review') { $badge = 'bg-amber-100 text-amber-600'; }
                            elseif($dispute->status === 'resolved') { $badge = 'bg-emerald-100 text-emerald-600'; }
                        ?>
                        <span class="<?= $badge ?> px-3 py-1 rounded-full text-xs font-semibold uppercase"><?= esc(ucfirst(str_replace('_', ' ', $dispute->status))) ?></span>
                    </td>
                    <td class="px-6 py-5 text-slate-600"><?= date('d M Y', strtotime($dispute->created_at)) ?></td>
                    <td class="px-6 py-5 text-center">
                        <button type="button" data-dispute-id="<?= esc($dispute->id) ?>" data-order-number="<?= esc($dispute->order_number ?? $dispute->order_id) ?>" data-reporter="<?= esc($dispute->reporter_name) ?>" data-reason="<?= esc($dispute->reason) ?>" data-status="<?= esc($dispute->status) ?>" data-order-title="<?= esc($dispute->service_name ?? $dispute->order_title ?? '-') ?>" onclick="openDisputeModal(this)" class="bg-[#EAF7FF] text-[#00A9FF] px-4 py-2 rounded-xl text-sm font-semibold hover:bg-[#D8F1FF] transition">Tangani</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <p class="text-sm text-slate-500">Review sengketa dan pilih penyelesaian yang tepat.</p>
        <div class="flex items-center gap-2">
            <button class="px-4 py-2 rounded-2xl border border-slate-200 text-slate-500 hover:bg-slate-50">Sebelumnya</button>
            <button class="px-4 py-2 rounded-2xl bg-[#00A9FF] text-white font-semibold">1</button>
            <button class="px-4 py-2 rounded-2xl border border-slate-200 text-slate-500 hover:bg-slate-50">Berikutnya</button>
        </div>
    </div>
</div>

<div id="disputeModal" class="fixed inset-0 hidden items-center justify-center z-50 p-4">
    <div class="absolute inset-0 bg-black/40 modal-backdrop"></div>
    <div class="relative bg-white rounded-3xl w-full max-w-3xl p-8 shadow-2xl">
        <div class="flex items-center justify-between gap-4 mb-6">
            <div>
                <h2 class="text-2xl font-bold text-slate-900">Tangani Sengketa</h2>
                <p class="text-slate-500 text-sm">Detail order dan keputusan admin.</p>
            </div>
            <button type="button" onclick="closeDisputeModal()" class="text-slate-500 text-3xl">×</button>
        </div>

        <form id="disputeForm" method="POST" action="/admin/updateDisputeStatus/0">
            <input type="hidden" name="dispute_id" id="modalDisputeId">
            <input type="hidden" name="status" id="modalResolution" value="">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <div class="space-y-4 p-5 rounded-3xl bg-slate-50 border border-slate-100">
                    <div>
                        <p class="text-sm text-slate-500">Order Terkait</p>
                        <p id="modalOrderNumber" class="text-lg font-semibold text-slate-900"></p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-500">Layanan</p>
                        <p id="modalOrderTitle" class="text-lg font-semibold text-slate-900"></p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-500">Pelapor</p>
                        <p id="modalReporter" class="text-lg font-semibold text-slate-900"></p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-500">Status Saat Ini</p>
                        <span id="modalStatusBadge" class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold"></span>
                    </div>
                </div>
                <div class="space-y-4">
                    <div>
                        <label class="text-sm font-semibold text-slate-600 mb-2 block">Deskripsi Sengketa</label>
                        <div id="modalReason" class="min-h-[120px] rounded-3xl border border-slate-200 bg-slate-50 p-4 text-slate-700"></div>
                    </div>
                    <div>
                        <label class="text-sm font-semibold text-slate-600 mb-2 block">Catatan Admin</label>
                        <textarea name="admin_note" id="modalAdminNote" rows="5" class="w-full border border-slate-200 rounded-3xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#00A9FF]" placeholder="Masukkan catatan untuk penyelesaian..."></textarea>
                    </div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-end gap-3">
                <button type="button" onclick="setDisputeResolution('client')" class="w-full sm:w-auto px-5 py-3 rounded-2xl bg-[#0D6EFD] hover:bg-[#0B5ED7] text-white font-semibold">Selesaikan untuk Klien</button>
                <button type="button" onclick="setDisputeResolution('freelancer')" class="w-full sm:w-auto px-5 py-3 rounded-2xl bg-[#198754] hover:bg-[#157347] text-white font-semibold">Selesaikan untuk Freelancer</button>
                <button type="button" onclick="setDisputeResolution('cancelled')" class="w-full sm:w-auto px-5 py-3 rounded-2xl bg-slate-200 hover:bg-slate-300 text-slate-700 font-semibold">Batalkan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openDisputeModal(button) {
        const modal = document.getElementById('disputeModal');
        const status = button.dataset.status;
        const statusBadge = document.getElementById('modalStatusBadge');

        document.getElementById('modalDisputeId').value = button.dataset.disputeId;
        document.getElementById('modalOrderNumber').innerText = button.dataset.orderNumber;
        document.getElementById('modalOrderTitle').innerText = button.dataset.orderTitle;
        document.getElementById('modalReporter').innerText = button.dataset.reporter;
        document.getElementById('modalReason').innerText = button.dataset.reason;
        document.getElementById('modalAdminNote').value = '';
        document.getElementById('modalResolution').value = '';

        statusBadge.innerText = status.replace('_', ' ').toUpperCase();
        statusBadge.className = 'inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold';
        if(status === 'open') {
            statusBadge.classList.add('bg-red-100','text-red-600');
        } else if(status === 'under_review') {
            statusBadge.classList.add('bg-amber-100','text-amber-600');
        } else {
            statusBadge.classList.add('bg-emerald-100','text-emerald-600');
        }

        const form = document.getElementById('disputeForm');
        form.action = '/admin/updateDisputeStatus/' + button.dataset.disputeId;

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeDisputeModal() {
        const modal = document.getElementById('disputeModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function setDisputeResolution(value) {
        const resolutionField = document.getElementById('modalResolution');
        resolutionField.value = value;
        document.getElementById('disputeForm').submit();
    }
</script>

<?= $this->endSection() ?>

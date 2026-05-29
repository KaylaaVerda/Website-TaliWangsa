<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="space-y-6">

    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Kelola Pesanan</h1>
            <p class="text-slate-500 mt-1">Pantau pesanan, status, dan detail transaksi.</p>
        </div>
    </div>

    <div class="bg-white rounded-3xl p-6 shadow-sm">
        <form method="GET" action="/admin/orders" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="text-sm font-semibold text-slate-600 mb-2 block">Filter Status</label>
                <select name="status" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#00A9FF]">
                    <option value="">Semua Status</option>
                    <option value="pending" <?= isset($status) && $status === 'pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="in_progress" <?= isset($status) && $status === 'in_progress' ? 'selected' : '' ?>>In Progress</option>
                    <option value="paid" <?= isset($status) && $status === 'paid' ? 'selected' : '' ?>>Paid</option>
                    <option value="completed" <?= isset($status) && $status === 'completed' ? 'selected' : '' ?>>Completed</option>
                    <option value="cancelled" <?= isset($status) && $status === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                </select>
            </div>
            <div>
                <label class="text-sm font-semibold text-slate-600 mb-2 block">Cari Pesanan</label>
                <input type="text" name="search" value="<?= esc($search ?? '') ?>" placeholder="Order number / klien..." class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#00A9FF]">
            </div>
            <div class="flex items-end">
                <button type="submit" class="w-full bg-[#00A9FF] hover:bg-[#0094E0] text-white rounded-2xl px-6 py-3 font-semibold transition">Terapkan Filter</button>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-3xl shadow-sm overflow-x-auto">
        <table class="w-full min-w-[1100px]">
            <thead class="bg-[#F8FAFC] border-b border-slate-200">
                <tr>
                    <th class="text-left px-6 py-4 text-sm font-bold text-slate-600">Order Number</th>
                    <th class="text-left px-6 py-4 text-sm font-bold text-slate-600">Klien</th>
                    <th class="text-left px-6 py-4 text-sm font-bold text-slate-600">Freelancer</th>
                    <th class="text-left px-6 py-4 text-sm font-bold text-slate-600">Layanan</th>
                    <th class="text-right px-6 py-4 text-sm font-bold text-slate-600">Harga</th>
                    <th class="text-left px-6 py-4 text-sm font-bold text-slate-600">Status</th>
                    <th class="text-left px-6 py-4 text-sm font-bold text-slate-600">Tanggal</th>
                    <th class="text-center px-6 py-4 text-sm font-bold text-slate-600">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($orders)): ?>
                <tr><td colspan="8" class="text-center px-6 py-10 text-slate-500">Tidak ada pesanan ditemukan.</td></tr>
                <?php endif; ?>
                <?php foreach($orders as $order): ?>
                <tr class="border-b border-slate-100 hover:bg-slate-50 transition">
                    <td class="px-6 py-5 font-semibold text-slate-800">#<?= esc($order->order_number) ?></td>
                    <td class="px-6 py-5 text-slate-600"><?= esc($order->client_name) ?></td>
                    <td class="px-6 py-5 text-slate-600"><?= esc($order->freelancer_name) ?></td>
                    <td class="px-6 py-5 text-slate-600"><?= esc($order->service_name ?? $order->service_title ?? '-') ?></td>
                    <td class="px-6 py-5 text-right text-slate-800 font-semibold">Rp <?= number_format($order->price, 0, ',', '.') ?></td>
                    <td class="px-6 py-5">
                        <?php
                            $statusClass = 'bg-slate-100 text-slate-600';
                            if($order->status === 'completed') { $statusClass = 'bg-emerald-100 text-emerald-600'; }
                            elseif($order->status === 'in_progress') { $statusClass = 'bg-blue-100 text-blue-600'; }
                            elseif($order->status === 'paid') { $statusClass = 'bg-amber-100 text-amber-600'; }
                            elseif($order->status === 'cancelled') { $statusClass = 'bg-red-100 text-red-600'; }
                        ?>
                        <span class="<?= $statusClass ?> px-3 py-1 rounded-full text-xs font-semibold uppercase"><?= esc(ucfirst(str_replace('_', ' ', $order->status))) ?></span>
                    </td>
                    <td class="px-6 py-5 text-slate-600"><?= date('d M Y', strtotime($order->created_at)) ?></td>
                    <td class="px-6 py-5 text-center">
                        <button type="button" data-order-id="<?= esc($order->id) ?>" data-order-number="<?= esc($order->order_number) ?>" data-client="<?= esc($order->client_name) ?>" data-freelancer="<?= esc($order->freelancer_name) ?>" data-service="<?= esc($order->service_name ?? $order->service_title ?? '-') ?>" data-price="Rp <?= number_format($order->price, 0, ',', '.') ?>" data-status="<?= esc($order->status) ?>" data-date="<?= date('d M Y', strtotime($order->created_at)) ?>" data-description="<?= esc($order->description ?? 'Tidak ada detail tambahan.') ?>" onclick="openOrderDetailModal(this)" class="bg-[#EAF7FF] text-[#00A9FF] px-4 py-2 rounded-xl text-sm font-semibold hover:bg-[#D8F1FF] transition">Detail</button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <p class="text-sm text-slate-500">Menampilkan daftar pesanan terbaru.</p>
        <div class="flex items-center gap-2">
            <button class="px-4 py-2 rounded-2xl border border-slate-200 text-slate-500 hover:bg-slate-50">Sebelumnya</button>
            <button class="px-4 py-2 rounded-2xl bg-[#00A9FF] text-white font-semibold">1</button>
            <button class="px-4 py-2 rounded-2xl border border-slate-200 text-slate-500 hover:bg-slate-50">Berikutnya</button>
        </div>
    </div>
</div>

<div id="orderDetailModal" class="fixed inset-0 hidden items-center justify-center z-50 p-4">
    <div class="absolute inset-0 bg-black/40 modal-backdrop"></div>
    <div class="relative bg-white rounded-3xl w-full max-w-3xl p-8 shadow-2xl">
        <div class="flex items-center justify-between gap-4 mb-6">
            <div>
                <h2 class="text-2xl font-bold text-slate-900">Detail Order</h2>
                <p class="text-slate-500 text-sm">Lihat informasi lengkap dan perbarui status order.</p>
            </div>
            <button type="button" onclick="closeOrderDetailModal()" class="text-slate-500 text-3xl">×</button>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <div class="space-y-4">
                <div>
                    <p class="text-sm text-slate-500">Order Number</p>
                    <p id="detailOrderNumber" class="text-lg font-semibold text-slate-900"></p>
                </div>
                <div>
                    <p class="text-sm text-slate-500">Klien</p>
                    <p id="detailClient" class="text-lg font-semibold text-slate-900"></p>
                </div>
                <div>
                    <p class="text-sm text-slate-500">Freelancer</p>
                    <p id="detailFreelancer" class="text-lg font-semibold text-slate-900"></p>
                </div>
            </div>
            <div class="space-y-4">
                <div>
                    <p class="text-sm text-slate-500">Layanan</p>
                    <p id="detailService" class="text-lg font-semibold text-slate-900"></p>
                </div>
                <div>
                    <p class="text-sm text-slate-500">Harga</p>
                    <p id="detailPrice" class="text-lg font-semibold text-slate-900"></p>
                </div>
                <div>
                    <p class="text-sm text-slate-500">Tanggal</p>
                    <p id="detailDate" class="text-lg font-semibold text-slate-900"></p>
                </div>
            </div>
        </div>

        <div class="mb-6">
            <p class="text-sm text-slate-500">Deskripsi Pesanan</p>
            <p id="detailDescription" class="mt-2 text-slate-700 leading-relaxed"></p>
        </div>

        <form id="orderStatusForm" method="POST" action="/admin/orders/updateStatus" class="space-y-5">
            <input type="hidden" name="order_id" id="detailOrderId">
            <div>
                <label class="text-sm font-semibold text-slate-600 mb-2 block">Ubah Status</label>
                <select name="status" id="detailStatus" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#00A9FF]">
                    <option value="pending">Pending</option>
                    <option value="in_progress">In Progress</option>
                    <option value="paid">Paid</option>
                    <option value="completed">Completed</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeOrderDetailModal()" class="px-5 py-3 rounded-2xl border border-slate-200 font-semibold">Tutup</button>
                <button type="submit" class="px-5 py-3 rounded-2xl bg-[#00A9FF] hover:bg-[#0094E0] text-white font-semibold">Simpan Status</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openOrderDetailModal(button) {
        const modal = document.getElementById('orderDetailModal');
        document.getElementById('detailOrderNumber').innerText = button.dataset.orderNumber;
        document.getElementById('detailClient').innerText = button.dataset.client;
        document.getElementById('detailFreelancer').innerText = button.dataset.freelancer;
        document.getElementById('detailService').innerText = button.dataset.service;
        document.getElementById('detailPrice').innerText = button.dataset.price;
        document.getElementById('detailDate').innerText = button.dataset.date;
        document.getElementById('detailDescription').innerText = button.dataset.description;
        document.getElementById('detailOrderId').value = button.dataset.orderId;
        document.getElementById('detailStatus').value = button.dataset.status;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeOrderDetailModal() {
        const modal = document.getElementById('orderDetailModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>

<?= $this->endSection() ?>

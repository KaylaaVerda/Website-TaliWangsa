<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="space-y-6">
    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-900">Kategori</h1>
            <p class="text-slate-500 mt-1">Kelola kategori layanan untuk marketplace.</p>
        </div>
        <button type="button" onclick="openCategoryModal()" class="bg-[#00A9FF] hover:bg-[#0094E0] text-white px-6 py-3 rounded-2xl font-semibold">Tambah Kategori</button>
    </div>

    <div class="bg-white rounded-3xl p-6 shadow-sm overflow-x-auto">
        <table class="w-full min-w-[920px]">
            <thead class="bg-[#F8FAFC] border-b border-slate-200">
                <tr>
                    <th class="text-left px-6 py-4 text-sm font-bold text-slate-600">Nama</th>
                    <th class="text-left px-6 py-4 text-sm font-bold text-slate-600">Slug</th>
                    <th class="text-left px-6 py-4 text-sm font-bold text-slate-600">Status</th>
                    <th class="text-left px-6 py-4 text-sm font-bold text-slate-600">Urutan</th>
                    <th class="text-center px-6 py-4 text-sm font-bold text-slate-600">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if(empty($categories)): ?>
                <tr><td colspan="5" class="text-center px-6 py-10 text-slate-500">Belum ada kategori.</td></tr>
                <?php endif; ?>
                <?php foreach($categories as $category): ?>
                <tr class="border-b border-slate-100 hover:bg-slate-50 transition">
                    <td class="px-6 py-5 font-semibold text-slate-800"><?= esc($category->name) ?></td>
                    <td class="px-6 py-5 text-slate-600"><?= esc($category->slug) ?></td>
                    <?php $catActive = isset($category->is_active) ? $category->is_active : 1; ?>
                    <td class="px-6 py-5">
                        <span class="<?= $catActive ? 'bg-emerald-100 text-emerald-600' : 'bg-slate-100 text-slate-600' ?> px-3 py-1 rounded-full text-xs font-semibold">
                            <?= $catActive ? 'Aktif' : 'Nonaktif' ?>
                        </span>
                    </td>
                    <td class="px-6 py-5 text-slate-600"><?= esc($category->order_value ?? '-') ?></td>
                    <td class="px-6 py-5 text-center">
                        <div class="flex flex-wrap justify-center gap-2">
                            <button type="button" onclick="openCategoryModal(<?= esc($category->id) ?>, '<?= esc($category->name) ?>', '<?= esc($category->slug) ?>', '<?= esc($category->description ?? '') ?>', <?= $catActive ? 'true' : 'false' ?>, <?= esc($category->order_value ?? 0) ?>)" class="bg-[#EAF7FF] text-[#00A9FF] px-4 py-2 rounded-xl text-sm font-semibold hover:bg-[#D8F1FF] transition">Edit</button>
                            <button type="button" onclick="openDeleteModal(<?= esc($category->id) ?>, '<?= esc($category->name) ?>')" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl text-sm font-semibold transition">Hapus</button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div id="categoryModal" class="fixed inset-0 hidden items-center justify-center z-50 p-4">
    <div class="absolute inset-0 bg-black/40 modal-backdrop"></div>
    <div class="relative bg-white rounded-3xl w-full max-w-3xl p-8 shadow-2xl">
        <div class="flex items-center justify-between gap-4 mb-6">
            <div>
                <h2 id="categoryModalTitle" class="text-2xl font-bold text-slate-900">Tambah Kategori</h2>
                <p class="text-slate-500 text-sm">Isi detail kategori baru atau perbarui yang sudah ada.</p>
            </div>
            <button type="button" onclick="closeCategoryModal()" class="text-slate-500 text-3xl">×</button>
        </div>

        <form id="categoryForm" method="POST" action="/admin/storeCategory" class="space-y-5">
            <input type="hidden" name="category_id" id="categoryId" value="">

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                <div>
                    <label class="text-sm font-semibold text-slate-600 mb-2 block">Nama Kategori</label>
                    <input type="text" name="name" id="categoryName" oninput="generateSlug()" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#00A9FF]" placeholder="Contoh: Desain Grafis">
                </div>
                <div>
                    <label class="text-sm font-semibold text-slate-600 mb-2 block">Slug</label>
                    <input type="text" name="slug" id="categorySlug" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#00A9FF]" placeholder="desain-grafis">
                </div>
            </div>

            <div>
                <label class="text-sm font-semibold text-slate-600 mb-2 block">Deskripsi</label>
                <textarea name="description" id="categoryDescription" rows="4" class="w-full border border-slate-200 rounded-3xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#00A9FF]" placeholder="Deskripsi singkat kategori..."></textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="text-sm font-semibold text-slate-600 mb-2 block">Urutan</label>
                    <input type="number" name="order" id="categoryOrder" class="w-full border border-slate-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#00A9FF]" placeholder="1">
                </div>
                <div class="flex flex-col justify-end">
                    <label class="inline-flex items-center gap-3 mt-6">
                        <input type="checkbox" name="is_active" id="categoryActive" class="h-5 w-5 rounded-lg border border-slate-300 text-[#00A9FF] focus:ring-[#00A9FF]">
                        <span class="text-sm font-semibold text-slate-600">Aktifkan Kategori</span>
                    </label>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <button type="button" onclick="closeCategoryModal()" class="px-5 py-3 rounded-2xl border border-slate-200 font-semibold">Batal</button>
                <button type="submit" class="px-5 py-3 rounded-2xl bg-[#00A9FF] hover:bg-[#0094E0] text-white font-semibold">Simpan Kategori</button>
            </div>
        </form>
    </div>
</div>

<div id="categoryDeleteModal" class="fixed inset-0 hidden items-center justify-center z-50 p-4">
    <div class="absolute inset-0 bg-black/40 modal-backdrop"></div>
    <div class="relative bg-white rounded-3xl w-full max-w-xl p-8 shadow-2xl">
        <div class="flex items-center justify-between gap-4 mb-6">
            <div>
                <h2 class="text-2xl font-bold text-slate-900">Hapus Kategori</h2>
                <p class="text-slate-500 text-sm">Konfirmasi sebelum menghapus kategori.</p>
            </div>
            <button type="button" onclick="closeDeleteModal()" class="text-slate-500 text-3xl">×</button>
        </div>

        <form id="categoryDeleteForm" method="POST" action="/admin/deleteCategory/0">
            <p class="text-slate-700">Apakah Anda yakin ingin menghapus kategori <span id="deleteCategoryName" class="font-semibold"></span>?</p>
            <div class="flex justify-end gap-3 mt-8">
                <button type="button" onclick="closeDeleteModal()" class="px-5 py-3 rounded-2xl border border-slate-200 font-semibold">Batal</button>
                <button type="submit" class="px-5 py-3 rounded-2xl bg-red-500 hover:bg-red-600 text-white font-semibold">Hapus</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openCategoryModal(id = '', name = '', slug = '', description = '', active = true, order = '') {
        const modal = document.getElementById('categoryModal');
        const form = document.getElementById('categoryForm');
        const title = document.getElementById('categoryModalTitle');

        document.getElementById('categoryId').value = id;
        document.getElementById('categoryName').value = name;
        document.getElementById('categorySlug').value = slug;
        document.getElementById('categoryDescription').value = description;
        document.getElementById('categoryOrder').value = order;
        document.getElementById('categoryActive').checked = active;

        if(id) {
            title.innerText = 'Edit Kategori';
            form.action = '/admin/updateCategory/' + id;
        } else {
            title.innerText = 'Tambah Kategori';
            form.action = '/admin/storeCategory';
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeCategoryModal() {
        const modal = document.getElementById('categoryModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    function generateSlug() {
        const input = document.getElementById('categoryName');
        const slug = input.value.trim().toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-+|-+$/g, '');
        document.getElementById('categorySlug').value = slug;
    }

    function openDeleteModal(id, name) {
        const modal = document.getElementById('categoryDeleteModal');
        const form = document.getElementById('categoryDeleteForm');
        document.getElementById('deleteCategoryName').innerText = name;
        form.action = '/admin/deleteCategory/' + id;
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeDeleteModal() {
        const modal = document.getElementById('categoryDeleteModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
</script>

<?= $this->endSection() ?>

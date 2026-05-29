<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="space-y-6">

    <!-- HEADER -->

    <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">

        <div>

            <h1 class="text-3xl font-bold text-gray-800">
                Kelola Pengguna
            </h1>

            <p class="text-gray-500 mt-1">
                Manajemen seluruh user platform
            </p>

        </div>

    </div>

    <!-- FILTER -->

    <div class="bg-white rounded-3xl p-6 shadow-sm">

        <form method="GET"
            action="/admin/users"
            class="grid grid-cols-1 md:grid-cols-3 gap-4">

            <div>

                <label class="text-sm font-semibold text-gray-600 mb-2 block">
                    Filter Role
                </label>

                <select name="role"
                    class="w-full border border-gray-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#00A9FF]">

                    <option value="">
                        Semua Role
                    </option>

                    <option value="client"
                        <?= $role == 'client' ? 'selected' : '' ?>>
                        Client
                    </option>

                    <option value="freelancer"
                        <?= $role == 'freelancer' ? 'selected' : '' ?>>
                        Freelancer
                    </option>

                    <option value="admin"
                        <?= $role == 'admin' ? 'selected' : '' ?>>
                        Admin
                    </option>

                </select>

            </div>

            <div>

                <label class="text-sm font-semibold text-gray-600 mb-2 block">
                    Cari User
                </label>

                <input type="text"
                    name="search"
                    value="<?= $search ?>"
                    placeholder="Nama atau email..."
                    class="w-full border border-gray-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-[#00A9FF]">

            </div>

            <div class="flex items-end">

                <button type="submit"
                    class="bg-[#00A9FF] hover:bg-[#0094E0] text-white px-6 py-3 rounded-2xl font-semibold transition w-full">

                    Filter Pengguna

                </button>

            </div>

        </form>

    </div>

    <!-- TABLE -->

    <div class="bg-white rounded-3xl shadow-sm overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full min-w-[1100px]">

                <thead class="bg-[#F8FAFC] border-b border-gray-100">

                    <tr>

                        <th class="text-left px-6 py-4 text-sm font-bold text-gray-600">
                            Pengguna
                        </th>

                        <th class="text-left px-6 py-4 text-sm font-bold text-gray-600">
                            Email
                        </th>

                        <th class="text-left px-6 py-4 text-sm font-bold text-gray-600">
                            Role
                        </th>

                        <th class="text-left px-6 py-4 text-sm font-bold text-gray-600">
                            Status
                        </th>

                        <th class="text-left px-6 py-4 text-sm font-bold text-gray-600">
                            Tanggal Daftar
                        </th>

                        <th class="text-center px-6 py-4 text-sm font-bold text-gray-600">
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    <?php foreach($users as $user): ?>

                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition">

                        <!-- USER -->

                        <td class="px-6 py-5">

                            <div class="flex items-center gap-4">

                                <div class="w-12 h-12 rounded-full bg-[#EAF7FF] flex items-center justify-center text-[#00A9FF] font-bold">

                                    <?= strtoupper(substr($user->name,0,1)) ?>

                                </div>

                                <div>

                                    <h4 class="font-bold text-gray-800">
                                        <?= $user->name ?>
                                    </h4>

                                    <p class="text-sm text-gray-500">
                                        ID #<?= $user->id ?>
                                    </p>

                                </div>

                            </div>

                        </td>

                        <!-- EMAIL -->

                        <td class="px-6 py-5 text-gray-600">

                            <?= $user->email ?>

                        </td>

                        <!-- ROLE -->

                        <td class="px-6 py-5">

                            <?php
                                $roleClass = 'bg-gray-100 text-gray-600';

                                if($user->role == 'admin'){
                                    $roleClass = 'bg-red-100 text-red-600';
                                }

                                elseif($user->role == 'freelancer'){
                                    $roleClass = 'bg-blue-100 text-blue-600';
                                }

                                elseif($user->role == 'client'){
                                    $roleClass = 'bg-green-100 text-green-600';
                                }
                            ?>

                            <span class="<?= $roleClass ?> px-4 py-2 rounded-full text-xs font-bold uppercase">

                                <?= $user->role ?>

                            </span>

                        </td>

                        <!-- STATUS -->

                        <td class="px-6 py-5">

                            <?php if($user->is_active): ?>

                            <span class="bg-green-100 text-green-600 px-4 py-2 rounded-full text-xs font-bold">
                                Aktif
                            </span>

                            <?php else: ?>

                            <span class="bg-red-100 text-red-600 px-4 py-2 rounded-full text-xs font-bold">
                                Suspend
                            </span>

                            <?php endif; ?>

                        </td>

                        <!-- DATE -->

                        <td class="px-6 py-5 text-gray-600">

                            <?= date('d M Y', strtotime($user->created_at)) ?>

                        </td>

                        <!-- ACTION -->

                        <td class="px-6 py-5">

                            <div class="flex items-center justify-center gap-3">

                                <button
                                    class="bg-[#EAF7FF] text-[#00A9FF] px-4 py-2 rounded-xl text-sm font-semibold hover:bg-[#D8F1FF] transition">

                                    Detail

                                </button>

                                <?php if($user->is_active): ?>

                                <button onclick="openSuspendModal(<?= $user->id ?>)"
                                    class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl text-sm font-semibold transition">

                                    Suspend

                                </button>

                                <?php else: ?>

                                <button
                                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-xl text-sm font-semibold transition">

                                    Aktifkan

                                </button>

                                <?php endif; ?>

                            </div>

                        </td>

                    </tr>

                    <?php endforeach; ?>

                </tbody>

            </table>

        </div>

    </div>

    <!-- PAGINATION -->

    <div class="flex items-center justify-between">

        <p class="text-sm text-gray-500">
            Menampilkan data pengguna terbaru
        </p>

        <div class="flex items-center gap-2">

            <button class="px-4 py-2 rounded-xl border border-gray-200 text-gray-500 hover:bg-gray-50">
                Sebelumnya
            </button>

            <button class="px-4 py-2 rounded-xl bg-[#00A9FF] text-white font-semibold">
                1
            </button>

            <button class="px-4 py-2 rounded-xl border border-gray-200 text-gray-500 hover:bg-gray-50">
                Berikutnya
            </button>

        </div>

    </div>

</div>

<!-- MODAL SUSPEND -->

<div id="suspendModal"
    class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4">

    <div class="bg-white rounded-3xl w-full max-w-lg p-8">

        <div class="flex items-center justify-between mb-6">

            <h3 class="text-2xl font-bold">
                Suspend Pengguna
            </h3>

            <button onclick="closeSuspendModal()"
                class="text-2xl text-gray-400 hover:text-gray-600">
                ×
            </button>

        </div>

        <form>

            <input type="hidden" id="userId">

            <div>

                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Alasan Suspend
                </label>

                <textarea rows="5"
                    placeholder="Masukkan alasan suspend..."
                    class="w-full border border-gray-200 rounded-2xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-500"></textarea>

            </div>

            <div class="flex justify-end gap-3 mt-6">

                <button type="button"
                    onclick="closeSuspendModal()"
                    class="px-5 py-3 rounded-2xl border border-gray-200 font-semibold">

                    Batal

                </button>

                <button type="submit"
                    class="px-5 py-3 rounded-2xl bg-red-500 hover:bg-red-600 text-white font-semibold transition">

                    Suspend User

                </button>

            </div>

        </form>

    </div>

</div>

<script>

function openSuspendModal(id){

    document.getElementById('userId').value = id;

    document.getElementById('suspendModal')
        .classList.remove('hidden');

    document.getElementById('suspendModal')
        .classList.add('flex');
}

function closeSuspendModal(){

    document.getElementById('suspendModal')
        .classList.add('hidden');

    document.getElementById('suspendModal')
        .classList.remove('flex');
}

</script>

<?= $this->endSection() ?>
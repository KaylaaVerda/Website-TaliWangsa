<?= $this->extend('layouts/freelancer') ?>

<?= $this->section('content') ?>

<div class="space-y-6">

    <div>

        <h1 class="text-3xl font-bold text-slate-800">
            Pengaturan Profil
        </h1>

        <p class="text-slate-500 mt-1">
            Kelola informasi profil freelancer Anda.
        </p>

    </div>

    <div class="bg-white rounded-[28px] shadow-soft p-8">

        <form
            action="/freelancer/profile/update"
            method="POST"
            enctype="multipart/form-data"
            class="space-y-8">

            <?= csrf_field() ?>

            <!-- FOTO -->
            <div class="flex flex-col lg:flex-row gap-8 items-start">

                <div class="relative">

                    <?php if(!empty($profile->avatar)): ?>

                    <img
                        id="previewImage"
                        src="<?= base_url('uploads/avatar/'.$profile->avatar) ?>"
                        class="w-36 h-36 rounded-full object-cover border-4 border-[#EAF7FF]">

                    <?php else: ?>

                    <img
                        id="previewImage"
                        src="https://ui-avatars.com/api/?name=<?= urlencode($profile->name ?? 'Freelancer') ?>"
                        class="w-36 h-36 rounded-full object-cover border-4 border-[#EAF7FF]">

                    <?php endif; ?>

                    <label class="absolute bottom-0 right-0 bg-[#00A9FF] text-white w-12 h-12 rounded-full flex items-center justify-center cursor-pointer shadow-lg">
                        ✎

                        <input
                            type="file"
                            name="avatar"
                            class="hidden"
                            accept="image/*"
                            onchange="previewAvatar(event)">
                    </label>

                </div>

                <div class="flex-1 grid grid-cols-1 lg:grid-cols-2 gap-6 w-full">

                    <div>

                        <label class="block mb-2 font-semibold">
                            Nama Lengkap
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="<?= old('name', $profile->name ?? '') ?>"
                            class="w-full border border-slate-200 rounded-2xl px-5 py-4 focus:ring-2 focus:ring-[#00A9FF] focus:outline-none">

                    </div>

                    <div>

                        <label class="block mb-2 font-semibold">
                            Headline
                        </label>

                        <input
                            type="text"
                            name="headline"
                            value="<?= old('headline', $profile->headline ?? '') ?>"
                            class="w-full border border-slate-200 rounded-2xl px-5 py-4 focus:ring-2 focus:ring-[#00A9FF] focus:outline-none">

                    </div>

                </div>

            </div>

            <!-- BIO -->
            <div>

                <label class="block mb-2 font-semibold">
                    Bio Freelancer
                </label>

                <textarea
                    name="bio"
                    rows="6"
                    class="w-full border border-slate-200 rounded-2xl px-5 py-4 focus:ring-2 focus:ring-[#00A9FF] focus:outline-none"><?= old('bio', $profile->bio ?? '') ?></textarea>

            </div>

            <!-- SKILLS -->
            <div>

                <label class="block mb-2 font-semibold">
                    Skills
                </label>

                <div class="border border-slate-200 rounded-2xl p-4">

                    <div
                        id="skillsContainer"
                        class="flex flex-wrap gap-3 mb-4">
                    </div>

                    <div class="flex gap-3">

                        <input
                            type="text"
                            id="skillInput"
                            placeholder="Tambah skill..."
                            class="flex-1 border border-slate-200 rounded-2xl px-4 py-3 focus:ring-2 focus:ring-[#00A9FF] focus:outline-none">

                        <button
                            type="button"
                            onclick="addSkill()"
                            class="bg-[#00A9FF] text-white px-6 rounded-2xl font-semibold">
                            Tambah
                        </button>

                    </div>

                </div>

                <input
                    type="hidden"
                    name="skills"
                    id="skillsHidden">

            </div>

            <!-- RATE -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <div>

                    <label class="block mb-2 font-semibold">
                        Rate per Jam
                    </label>

                    <div class="relative">

                        <span class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-500">
                            Rp
                        </span>

                        <input
                            type="number"
                            name="hourly_rate"
                            value="<?= old('hourly_rate', $profile->hourly_rate ?? '') ?>"
                            class="w-full border border-slate-200 rounded-2xl pl-14 pr-5 py-4 focus:ring-2 focus:ring-[#00A9FF] focus:outline-none">

                    </div>

                </div>

                <div>

                    <label class="block mb-2 font-semibold">
                        Status Ketersediaan
                    </label>

                    <label class="flex items-center gap-4 bg-[#F5FAFD] rounded-2xl px-5 py-4 cursor-pointer">

                        <input
                            type="checkbox"
                            name="availability"
                            value="1"
                            <?= !empty($profile->availability) ? 'checked' : '' ?>
                            class="w-5 h-5 accent-[#00A9FF]">

                        <span class="font-medium">
                            Saya tersedia menerima project
                        </span>

                    </label>

                </div>

            </div>

            <!-- SUBMIT -->
            <div class="pt-4">

                <button
                    class="bg-[#00A9FF] hover:bg-[#0094E0] text-white px-8 py-4 rounded-2xl font-bold transition">
                    Simpan Profil
                </button>

            </div>

        </form>

    </div>

</div>

<script>

function previewAvatar(event){

    const image = document.getElementById('previewImage');

    image.src = URL.createObjectURL(event.target.files[0]);
}

let skills = [];

<?php if(!empty($profile->skills)): ?>

skills = <?= json_encode(explode(',', $profile->skills)) ?>;

<?php endif; ?>

function renderSkills(){

    const container = document.getElementById('skillsContainer');
    const hidden = document.getElementById('skillsHidden');

    container.innerHTML = '';

    skills.forEach((skill,index)=>{

        container.innerHTML += `
            <div class="bg-[#EAF7FF] text-[#00A9FF] px-4 py-2 rounded-full flex items-center gap-3 font-medium">
                ${skill}
                <button type="button" onclick="removeSkill(${index})">
                    ×
                </button>
            </div>
        `;
    });

    hidden.value = skills.join(',');
}

function addSkill(){

    const input = document.getElementById('skillInput');

    if(input.value.trim() != ''){

        skills.push(input.value.trim());

        input.value = '';

        renderSkills();
    }
}

function removeSkill(index){

    skills.splice(index,1);

    renderSkills();
}

renderSkills();

</script>

<?= $this->endSection() ?>
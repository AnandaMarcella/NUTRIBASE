@php
    $mode = $mode ?? 'create';
    $item = $penerima ?? null;
    $selectedKategori = old('kategori', $item->kategori ?? '');
    $inputName = old('name', $item->user->name ?? '');
    $inputNik = old('nik', $item->nik ?? '');
    $inputTelepon = old('no_telepon', $item->no_telepon ?? '');
    $inputAlamat = old('alamat', $item->alamat ?? '');
    $inputRt = old('rt', $item->rt ?? '');
    $inputDeskripsi = old('deskripsi_kategori', $item->deskripsi_kategori ?? '');
    $inputEstimasi = old('estimasi_durasi', $item?->estimasi_durasi?->format('Y-m-d') ?? '');
@endphp

<div class="space-y-4" x-data="{ kategori: '{{ $selectedKategori }}' }">
    <div>
        <label class="block text-xs font-semibold text-[#4E6F5C] uppercase tracking-wide mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
        <input
            type="text"
            name="name"
            value="{{ $inputName }}"
            class="w-full px-3 py-2.5 bg-[#FAFCFB] border border-[#CCDFD4] focus:border-[#79C80E] focus:outline-none rounded-xl text-sm"
            required>
    </div>

    @if($mode === 'edit')
    <div>
        <label class="block text-xs font-semibold text-[#4E6F5C] uppercase tracking-wide mb-1">Username</label>
        <input
            type="text"
            value="{{ $item->user->username ?? '' }}"
            class="w-full px-3 py-2.5 bg-[#F0F5F2] border border-[#CCDFD4] rounded-xl text-sm text-[#8A9E90] cursor-not-allowed"
            readonly disabled>
        <p class="text-xs text-[#A0B4A7] mt-1">Username tidak dapat diubah.</p>
    </div>
    @endif

    <div>
        <label class="block text-xs font-semibold text-[#4E6F5C] uppercase tracking-wide mb-1">NIK <span class="text-red-500">*</span></label>
        <input
            type="text"
            name="nik"
            value="{{ $inputNik }}"
            maxlength="16" minlength="16"
            class="w-full px-3 py-2.5 bg-[#FAFCFB] border border-[#CCDFD4] focus:border-[#79C80E] focus:outline-none rounded-xl text-sm font-mono tracking-wider"
            required>
    </div>

    <div class="grid grid-cols-2 gap-3">
        <div>
            <label class="block text-xs font-semibold text-[#4E6F5C] uppercase tracking-wide mb-1">No. Telepon</label>
            <input type="text" name="no_telepon" value="{{ $inputTelepon }}"
                class="w-full px-3 py-2.5 bg-[#FAFCFB] border border-[#CCDFD4] focus:border-[#79C80E] focus:outline-none rounded-xl text-sm">
        </div>
        <div>
            <label class="block text-xs font-semibold text-[#4E6F5C] uppercase tracking-wide mb-1">RT <span class="text-red-500">*</span></label>
            <input type="text" name="rt" value="{{ $inputRt }}"
                class="w-full px-3 py-2.5 bg-[#FAFCFB] border border-[#CCDFD4] focus:border-[#79C80E] focus:outline-none rounded-xl text-sm"
                required>
        </div>
    </div>

    <div>
        <label class="block text-xs font-semibold text-[#4E6F5C] uppercase tracking-wide mb-1">Alamat <span class="text-red-500">*</span></label>
        <textarea
            name="alamat"
            rows="2"
            class="w-full px-3 py-2.5 bg-[#FAFCFB] border border-[#CCDFD4] focus:border-[#79C80E] focus:outline-none rounded-xl text-sm resize-none"
            required>{{ $inputAlamat }}</textarea>
    </div>

    <div>
        <label class="block text-xs font-semibold text-[#4E6F5C] uppercase tracking-wide mb-1">Kategori <span class="text-red-500">*</span></label>
        <select
            name="kategori"
            x-model="kategori"
            class="w-full px-3 py-2.5 bg-[#FAFCFB] border border-[#CCDFD4] focus:border-[#79C80E] focus:outline-none rounded-xl text-sm"
            required>
            <option value="">— Pilih —</option>
            <option value="ibu_hamil" {{ $selectedKategori === 'ibu_hamil' ? 'selected' : '' }}>Ibu Hamil</option>
            <option value="ibu_menyusui" {{ $selectedKategori === 'ibu_menyusui' ? 'selected' : '' }}>Ibu Menyusui</option>
            <option value="balita" {{ $selectedKategori === 'balita' ? 'selected' : '' }}>Balita</option>
            <option value="lainnya" {{ $selectedKategori === 'lainnya' ? 'selected' : '' }}>Lainnya</option>
        </select>
    </div>

    <div x-show="kategori === 'lainnya'" x-cloak>
        <label class="block text-xs font-semibold text-[#4E6F5C] uppercase tracking-wide mb-1">Deskripsi <span class="text-red-500">*</span></label>
        <textarea
            name="deskripsi_kategori"
            rows="2"
            class="w-full px-3 py-2.5 bg-[#FAFCFB] border border-[#CCDFD4] focus:border-[#79C80E] focus:outline-none rounded-xl text-sm resize-none">{{ $inputDeskripsi }}</textarea>
    </div>

    <div>
        <label class="block text-xs font-semibold text-[#4E6F5C] uppercase tracking-wide mb-1">Estimasi Selesai <span class="text-red-500">*</span></label>
        <input
            type="date"
            name="estimasi_durasi"
            value="{{ $inputEstimasi }}"
            class="w-full px-3 py-2.5 bg-[#FAFCFB] border border-[#CCDFD4] focus:border-[#79C80E] focus:outline-none rounded-xl text-sm"
            required>
    </div>
</div>

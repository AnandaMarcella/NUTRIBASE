@extends('layouts.app')

@section('title', 'Edit Profil Penerima — NutriBase')

@section('content')
<div class="min-h-screen bg-[#FAFCFB]">
    @include('layouts.sidebar')

    <main class="flex-1 p-4 sm:p-6 lg:p-8 lg:pl-64">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white rounded-3xl shadow-sm border border-[#DFF0E5] p-6 mb-6">
                <h1 class="text-2xl font-bold text-[#4E6F5C]">Edit Profil Penerima</h1>
                <p class="text-sm text-[#6B7A6F] mt-2">Perbarui informasi penerima Anda agar data tetap akurat.</p>
            </div>

            @if(session('error'))
                <div class="mb-5 p-4 rounded-2xl bg-red-50 border border-red-200 text-red-700 text-sm">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-5 p-4 rounded-2xl bg-red-50 border border-red-200 text-red-700 text-sm">
                    <p class="font-semibold mb-2">Periksa kembali isian:</p>
                    <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white rounded-3xl shadow-sm border border-[#DFF0E5] p-6">
                <form method="POST" action="{{ route('penerima.update', $penerima) }}">
                    @csrf
                    @method('PUT')
                    @include('penerima.form_page', ['mode' => 'edit', 'penerima' => $penerima])

                    <div class="mt-6 flex flex-col sm:flex-row gap-3">
                        <button type="submit" class="inline-flex items-center justify-center px-5 py-3 bg-[#06B13D] hover:bg-[#059933] text-white text-sm font-semibold rounded-2xl transition">
                            <i class="bi bi-check-lg mr-2"></i> Simpan Perubahan
                        </button>
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center px-5 py-3 border border-[#CCDFD4] text-[#4E6F5C] rounded-2xl hover:bg-[#F2F8F4] transition text-sm">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </main>
</div>
@endsection

@extends('layouts.admin')

@section('title', 'Tambah Kategori Baru')
@section('header_title', 'Tambah Kategori Produk')

@section('content')

  <div class="max-w-xl">
    <div class="mb-4">
      <a href="{{ route('admin.kategori.index') }}" class="text-xs text-gray-500 dark:text-gray-400 hover:text-anime-red dark:hover:text-anime-red inline-flex items-center gap-1 font-semibold transition">
        <i class="ph-bold ph-arrow-left"></i> Kembali ke Daftar Kategori
      </a>
    </div>

    <div class="bg-white dark:bg-anime-card rounded-2xl border border-gray-200/80 dark:border-anime-cardborder shadow-sm p-6 sm:p-8 transition-colors duration-200">
      <h2 class="text-base font-bold text-gray-900 dark:text-white mb-1">Form Tambah Kategori</h2>
      <p class="text-xs text-gray-500 dark:text-gray-400 mb-6">Masukkan nama kategori busana. Slug URL akan digenerate otomatis jika dikosongkan.</p>

      @if($errors->any())
        <div class="p-3 mb-5 text-xs text-rose-800 dark:text-rose-300 rounded-xl bg-rose-50 dark:bg-rose-950/40 border border-rose-200 dark:border-rose-800">
          {{ $errors->first() }}
        </div>
      @endif

      <form action="{{ route('admin.kategori.store') }}" method="POST" class="space-y-5">
        @csrf

        <div>
          <label for="nama" class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
            Nama Kategori <span class="text-anime-red">*</span>
          </label>
          <input
            type="text"
            name="nama"
            id="nama"
            value="{{ old('nama') }}"
            required
            placeholder="Contoh: Kemeja, Celana, Dress, Kaos"
            class="w-full px-4 py-2.5 text-xs rounded-xl border border-gray-200 dark:border-anime-cardborder bg-gray-50 dark:bg-anime-black text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-anime-red/20 focus:border-anime-red transition shadow-sm"
          >
        </div>

        <div>
          <label for="slug" class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
            Slug URL <span class="text-gray-400 font-normal">(opsional)</span>
          </label>
          <input
            type="text"
            name="slug"
            id="slug"
            value="{{ old('slug') }}"
            placeholder="Contoh: kemeja-pria (otomatis jika dikosongkan)"
            class="w-full px-4 py-2.5 text-xs rounded-xl border border-gray-200 dark:border-anime-cardborder bg-gray-50 dark:bg-anime-black text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-anime-red/20 focus:border-anime-red transition shadow-sm font-mono text-[11px]"
          >
        </div>

        <div class="pt-3 flex items-center justify-end gap-3 border-t border-gray-100 dark:border-anime-cardborder">
          <a href="{{ route('admin.kategori.index') }}" class="px-4 py-2 text-xs font-semibold rounded-xl text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-[#161826] transition">
            Batal
          </a>
          <button type="submit" class="px-5 py-2.5 text-xs font-bold rounded-xl bg-anime-red hover:bg-anime-redhover text-white transition shadow-sm">
            Simpan Kategori
          </button>
        </div>
      </form>
    </div>
  </div>

@endsection

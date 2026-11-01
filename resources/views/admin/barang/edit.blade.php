@extends('layouts.admin')

@section('title', 'Edit Produk ' . $barang->nama)
@section('header_title', 'Edit Produk & Varian Baju')

@section('content')

  <div class="mb-4">
    <a href="{{ route('admin.barang.index') }}" class="text-xs text-gray-500 dark:text-gray-400 hover:text-anime-red dark:hover:text-anime-red inline-flex items-center gap-1 font-semibold transition">
      <i class="ph-bold ph-arrow-left"></i> Kembali ke Daftar Produk
    </a>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">

    <!-- Left Column: Product Information Form (7 cols) -->
    <div class="lg:col-span-7 bg-white dark:bg-anime-card rounded-2xl border border-gray-200/80 dark:border-anime-cardborder shadow-sm p-6 sm:p-8 space-y-6 transition-colors duration-200">
      <div>
        <h2 class="text-base font-bold text-gray-900 dark:text-white">Informasi Dasar Produk</h2>
        <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Perbarui nama pakaian, kategori, harga dasar, dan foto utama.</p>
      </div>

      @if($errors->any())
        <div class="p-3 text-xs text-rose-800 dark:text-rose-300 rounded-xl bg-rose-50 dark:bg-rose-950/40 border border-rose-200 dark:border-rose-800">
          <ul class="list-disc list-inside space-y-1">
            @foreach($errors->all() as $err)
              <li>{{ $err }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('admin.barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf
        @method('PUT')

        <!-- Nama Produk -->
        <div>
          <label for="nama" class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
            Nama Produk Busana <span class="text-anime-red">*</span>
          </label>
          <input
            type="text"
            name="nama"
            id="nama"
            value="{{ old('nama', $barang->nama) }}"
            required
            class="w-full px-4 py-2.5 text-xs rounded-xl border border-gray-200 dark:border-anime-cardborder bg-gray-50 dark:bg-anime-black text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-anime-red/20 focus:border-anime-red transition shadow-sm font-semibold"
          >
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <!-- Kategori -->
          <div>
            <label for="kategori_id" class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
              Kategori <span class="text-anime-red">*</span>
            </label>
            <select
              name="kategori_id"
              id="kategori_id"
              required
              class="w-full px-4 py-2.5 text-xs rounded-xl border border-gray-200 dark:border-anime-cardborder bg-gray-50 dark:bg-anime-black text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-anime-red/20 focus:border-anime-red transition shadow-sm"
            >
              @foreach($kategoris as $kat)
                <option value="{{ $kat->id }}" {{ old('kategori_id', $barang->kategori_id) === $kat->id ? 'selected' : '' }}>
                  {{ $kat->nama }}
                </option>
              @endforeach
            </select>
          </div>

          <!-- Harga -->
          <div>
            <label for="harga" class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
              Harga Dasar (Rp) <span class="text-anime-red">*</span>
            </label>
            <div class="relative">
              <span class="absolute left-3.5 top-2.5 text-xs font-bold text-gray-400">Rp</span>
              <input
                type="number"
                name="harga"
                id="harga"
                value="{{ old('harga', (int)$barang->harga) }}"
                required
                min="0"
                step="500"
                class="w-full pl-10 pr-4 py-2.5 text-xs rounded-xl border border-gray-200 dark:border-anime-cardborder bg-gray-50 dark:bg-anime-black text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-anime-red/20 focus:border-anime-red transition shadow-sm font-bold"
              >
            </div>
          </div>
        </div>

        <!-- Status -->
        <div>
          <label for="status" class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
            Status Tampilan Katalog <span class="text-anime-red">*</span>
          </label>
          <select
            name="status"
            id="status"
            required
            class="w-full px-4 py-2.5 text-xs rounded-xl border border-gray-200 dark:border-anime-cardborder bg-gray-50 dark:bg-anime-black text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-anime-red/20 focus:border-anime-red transition shadow-sm"
          >
            <option value="aktif" {{ old('status', $barang->status) === 'aktif' ? 'selected' : '' }}>Aktif (Tampil di Katalog)</option>
            <option value="nonaktif" {{ old('status', $barang->status) === 'nonaktif' ? 'selected' : '' }}>Nonaktif (Sembunyikan dari Katalog)</option>
          </select>
        </div>

        <!-- Foto Utama Preview & Replace -->
        <div>
          <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
            Foto Utama Baju
          </label>
          <div class="flex items-start gap-4 p-3 rounded-xl bg-gray-50 dark:bg-anime-black border border-gray-200 dark:border-anime-cardborder">
            <div class="w-16 h-20 rounded-lg overflow-hidden bg-gray-200 dark:bg-gray-800 border border-gray-300 dark:border-gray-700 shrink-0">
              <img src="{{ $barang->foto_url }}" alt="Preview" class="w-full h-full object-cover" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1521572267360-ee0c2909d518?auto=format&fit=crop&w=800&q=80';">
            </div>
            <div class="flex-grow space-y-2">
              <input
                type="file"
                name="foto_file"
                accept="image/*"
                class="w-full text-xs text-gray-500 dark:text-gray-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-anime-red/10 file:text-anime-red hover:file:bg-anime-red/20 cursor-pointer"
              >
              <input
                type="url"
                name="foto_url_input"
                placeholder="Atau ubah via URL gambar (https://...)"
                class="w-full px-3 py-1.5 text-xs rounded-lg border border-gray-200 dark:border-anime-cardborder text-gray-900 dark:text-white focus:outline-none focus:ring-1 focus:ring-anime-red bg-white dark:bg-[#12141f] placeholder-gray-400 dark:placeholder-gray-500"
              >
            </div>
          </div>
        </div>

        <!-- Deskripsi -->
        <div>
          <label for="deskripsi" class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
            Deskripsi Produk, Bahan, & Potongan <span class="text-anime-red">*</span>
          </label>
          <textarea
            name="deskripsi"
            id="deskripsi"
            rows="6"
            required
            class="w-full px-4 py-2.5 text-xs rounded-xl border border-gray-200 dark:border-anime-cardborder bg-gray-50 dark:bg-anime-black text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-anime-red/20 focus:border-anime-red transition shadow-sm leading-relaxed"
          >{{ old('deskripsi', $barang->deskripsi) }}</textarea>
        </div>

        <div class="pt-3 flex items-center justify-between border-t border-gray-100 dark:border-anime-cardborder">
          <a
            href="{{ route('catalog.show', $barang->id) }}"
            target="_blank"
            class="text-xs font-bold text-anime-red hover:underline flex items-center gap-1"
          >
            <i class="ph-bold ph-eye"></i> Lihat di Katalog Publik ↗
          </a>

          <button type="submit" class="px-6 py-2.5 text-xs font-bold rounded-xl bg-anime-red hover:bg-anime-redhover text-white transition shadow-sm">
            Simpan Perubahan Produk
          </button>
        </div>
      </form>
    </div>

    <!-- Right Column: Variants Management (5 cols) -->
    <div class="lg:col-span-5 space-y-6">

      <!-- Variants Table Card -->
      <div class="bg-white dark:bg-anime-card rounded-2xl border border-gray-200/80 dark:border-anime-cardborder shadow-sm p-6 space-y-4 transition-colors duration-200">
        <div class="flex items-center justify-between border-b border-gray-100 dark:border-anime-cardborder pb-3">
          <div>
            <h3 class="font-bold text-sm text-gray-900 dark:text-white">Manajemen Varian & Stok</h3>
            <span class="text-xs text-gray-400">Total Stok: {{ $barang->total_stok }} pcs</span>
          </div>
          <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-gray-100 dark:bg-[#161826] text-gray-800 dark:text-gray-200 border border-gray-200 dark:border-anime-cardborder">
            {{ $barang->varians->count() }} Varian
          </span>
        </div>

        <!-- Current Variants List with Inline Update -->
        <div class="space-y-3">
          @forelse($barang->varians as $var)
            <div class="p-3.5 rounded-xl border border-gray-200 dark:border-anime-cardborder bg-gray-50/60 dark:bg-[#161826]/60 hover:bg-white dark:hover:bg-[#161826] transition space-y-2">
              <form action="{{ route('admin.barang.varian.update', [$barang->id, $var->id]) }}" method="POST" class="space-y-2">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-3 gap-2">
                  <div>
                    <label class="block text-[10px] text-gray-500 dark:text-gray-400 font-bold uppercase">Warna</label>
                    <input type="text" name="warna" value="{{ $var->warna }}" required class="w-full px-2 py-1 text-xs rounded border border-gray-200 dark:border-anime-cardborder bg-white dark:bg-anime-black text-gray-900 dark:text-white">
                  </div>
                  <div>
                    <label class="block text-[10px] text-gray-500 dark:text-gray-400 font-bold uppercase">Ukuran</label>
                    <input type="text" name="ukuran" value="{{ $var->ukuran }}" required class="w-full px-2 py-1 text-xs rounded border border-gray-200 dark:border-anime-cardborder bg-white dark:bg-anime-black text-gray-900 dark:text-white">
                  </div>
                  <div>
                    <label class="block text-[10px] text-gray-500 dark:text-gray-400 font-bold uppercase">Stok</label>
                    <input type="number" name="stok" value="{{ $var->stok }}" min="0" required class="w-full px-2 py-1 text-xs rounded border border-gray-200 dark:border-anime-cardborder bg-white dark:bg-anime-black text-gray-900 dark:text-white font-bold">
                  </div>
                </div>

                <div class="flex items-center justify-between pt-1">
                  <span class="text-[10px] text-gray-400">ID: {{ substr($var->id, 0, 8) }}...</span>
                  <div class="flex items-center gap-2">
                    <button type="submit" class="px-2.5 py-1 rounded bg-anime-red text-white text-[11px] font-bold hover:bg-anime-redhover transition">
                      Simpan Stok
                    </button>
              </form>

              <form action="{{ route('admin.barang.varian.destroy', [$barang->id, $var->id]) }}" method="POST" onsubmit="return confirm('Hapus varian ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="p-1 text-rose-500 hover:text-rose-700" title="Hapus varian">
                  <i class="ph-bold ph-trash text-sm"></i>
                </button>
              </form>
                  </div>
                </div>
            </div>
          @empty
            <p class="text-xs text-gray-400 text-center py-4">Belum ada varian produk. Tambahkan di bawah.</p>
          @endforelse
        </div>

        <!-- Add New Variant Form -->
        <div class="pt-4 border-t border-gray-100 dark:border-anime-cardborder">
          <h4 class="text-xs font-bold text-gray-800 dark:text-white uppercase tracking-wider mb-3 flex items-center gap-1.5">
            <i class="ph-bold ph-plus-circle text-anime-red"></i> Tambah Varian Baru
          </h4>

          <form action="{{ route('admin.barang.varian.store', $barang->id) }}" method="POST" class="space-y-3">
            @csrf

            <div class="grid grid-cols-3 gap-2">
              <div>
                <input type="text" name="warna" placeholder="Warna" required class="w-full px-2.5 py-1.5 text-xs rounded-lg border border-gray-200 dark:border-anime-cardborder bg-white dark:bg-anime-black text-gray-900 dark:text-white">
              </div>
              <div>
                <input type="text" name="ukuran" placeholder="Ukuran" required class="w-full px-2.5 py-1.5 text-xs rounded-lg border border-gray-200 dark:border-anime-cardborder bg-white dark:bg-anime-black text-gray-900 dark:text-white">
              </div>
              <div>
                <input type="number" name="stok" placeholder="Stok" value="10" min="0" required class="w-full px-2.5 py-1.5 text-xs rounded-lg border border-gray-200 dark:border-anime-cardborder bg-white dark:bg-anime-black text-gray-900 dark:text-white">
              </div>
            </div>

            <button type="submit" class="w-full py-2 rounded-xl bg-anime-red/10 dark:bg-anime-red/20 hover:bg-anime-red hover:text-white text-anime-red text-xs font-bold transition">
              + Tambahkan Varian Ini
            </button>
          </form>
        </div>

      </div>

    </div>

  </div>

@endsection

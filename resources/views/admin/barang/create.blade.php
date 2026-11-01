@extends('layouts.admin')

@section('title', 'Tambah Produk Baju Baru')
@section('header_title', 'Tambah Produk Busana Baru')

@section('content')

  <div class="max-w-4xl">
    <div class="mb-4">
      <a href="{{ route('admin.barang.index') }}" class="text-xs text-gray-500 dark:text-gray-400 hover:text-anime-red dark:hover:text-anime-red inline-flex items-center gap-1 font-semibold transition">
        <i class="ph-bold ph-arrow-left"></i> Kembali ke Daftar Produk
      </a>
    </div>

    <div class="bg-white dark:bg-anime-card rounded-2xl border border-gray-200/80 dark:border-anime-cardborder shadow-sm p-6 sm:p-8 transition-colors duration-200">
      <h2 class="text-base font-bold text-gray-900 dark:text-white mb-1">Informasi Produk Busana</h2>
      <p class="text-xs text-gray-500 dark:text-gray-400 mb-6">Lengkapi data pakaian, harga, foto utama, dan varian awal (ukuran, warna, stok).</p>

      @if($errors->any())
        <div class="p-3 mb-5 text-xs text-rose-800 dark:text-rose-300 rounded-xl bg-rose-50 dark:bg-rose-950/40 border border-rose-200 dark:border-rose-800">
          <ul class="list-disc list-inside space-y-1">
            @foreach($errors->all() as $err)
              <li>{{ $err }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('admin.barang.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
          <!-- Nama Produk -->
          <div class="sm:col-span-2">
            <label for="nama" class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
              Nama Produk Busana <span class="text-anime-red">*</span>
            </label>
            <input
              type="text"
              name="nama"
              id="nama"
              value="{{ old('nama') }}"
              required
              placeholder="Contoh: Kaos Anime Oversized Cotton 24s DTF HD"
              class="w-full px-4 py-2.5 text-xs rounded-xl border border-gray-200 dark:border-anime-cardborder bg-gray-50 dark:bg-anime-black text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-anime-red/20 focus:border-anime-red transition shadow-sm font-medium"
            >
          </div>

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
              <option value="">Pilih Kategori</option>
              @foreach($kategoris as $kat)
                <option value="{{ $kat->id }}" {{ old('kategori_id') === $kat->id ? 'selected' : '' }}>
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
                value="{{ old('harga') }}"
                required
                min="0"
                step="500"
                placeholder="Contoh: 195000"
                class="w-full pl-10 pr-4 py-2.5 text-xs rounded-xl border border-gray-200 dark:border-anime-cardborder bg-gray-50 dark:bg-anime-black text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-anime-red/20 focus:border-anime-red transition shadow-sm font-bold"
              >
            </div>
          </div>

          <!-- Status Aktif / Nonaktif -->
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
              <option value="aktif" {{ old('status', 'aktif') === 'aktif' ? 'selected' : '' }}>Aktif (Tampil di Katalog)</option>
              <option value="nonaktif" {{ old('status') === 'nonaktif' ? 'selected' : '' }}>Nonaktif (Sembunyikan Sementara)</option>
            </select>
          </div>

          <!-- Foto Utama (Upload / URL) -->
          <div>
            <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
              Upload Foto Utama Baju
            </label>
            <input
              type="file"
              name="foto_file"
              accept="image/*"
              class="w-full text-xs text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-anime-red/10 file:text-anime-red hover:file:bg-anime-red/20 cursor-pointer"
            >
            <div class="mt-2">
              <input
                type="url"
                name="foto_url_input"
                value="{{ old('foto_url_input') }}"
                placeholder="Atau tempel URL gambar (https://...)"
                class="w-full px-3 py-1.5 text-xs rounded-lg border border-gray-200 dark:border-anime-cardborder bg-gray-50 dark:bg-anime-black text-gray-900 dark:text-white focus:outline-none focus:ring-1 focus:ring-anime-red placeholder-gray-400 dark:placeholder-gray-500"
              >
            </div>
          </div>

          <!-- Deskripsi Produk -->
          <div class="sm:col-span-2">
            <label for="deskripsi" class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
              Deskripsi Produk, Bahan, & Detail Anime <span class="text-anime-red">*</span>
            </label>
            <textarea
              name="deskripsi"
              id="deskripsi"
              rows="5"
              required
              placeholder="Jelaskan jenis bahan (Cotton 24s/Fleece 330gsm), teknik sablon (DTF HD), potongan (oversized streetwear), dan detail anime."
              class="w-full px-4 py-2.5 text-xs rounded-xl border border-gray-200 dark:border-anime-cardborder bg-gray-50 dark:bg-anime-black text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-anime-red/20 focus:border-anime-red transition shadow-sm leading-relaxed"
            >{{ old('deskripsi') }}</textarea>
          </div>
        </div>

        <!-- Initial Variants Block -->
        <div class="pt-6 border-t border-gray-200 dark:border-anime-cardborder space-y-4">
          <div class="flex items-center justify-between">
            <div>
              <h3 class="font-bold text-sm text-gray-900 dark:text-white">Varian Produk (Warna, Ukuran & Stok)</h3>
              <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Tambahkan pilihan warna dan ukuran yang siap dijual.</p>
            </div>
            <button
              type="button"
              id="btnAddVariantRow"
              class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-gray-100 dark:bg-[#161826] hover:bg-gray-200 dark:hover:bg-[#1f2336] text-gray-700 dark:text-gray-200 text-xs font-bold transition"
            >
              <i class="ph-bold ph-plus"></i> Tambah Varian
            </button>
          </div>

          <div class="overflow-x-auto rounded-xl border border-gray-200 dark:border-anime-cardborder">
            <table class="w-full text-left text-xs" id="variantsTable">
              <thead class="bg-gray-50 dark:bg-[#161826] text-gray-500 dark:text-gray-400 font-bold uppercase tracking-wider text-[10px] border-b border-gray-200 dark:border-anime-cardborder">
                <tr>
                  <th class="py-2.5 px-3">Warna Pakaian</th>
                  <th class="py-2.5 px-3">Ukuran (Size)</th>
                  <th class="py-2.5 px-3">Stok (pcs)</th>
                  <th class="py-2.5 px-3 w-12 text-center">Hapus</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-100 dark:divide-anime-cardborder" id="variantsTableBody">
                <tr class="variant-row">
                  <td class="py-2 px-3">
                    <input type="text" name="varians[0][warna]" placeholder="Hitam / Navy" value="Hitam" required class="w-full px-2.5 py-1.5 text-xs rounded-lg border border-gray-200 dark:border-anime-cardborder bg-white dark:bg-[#12141f] text-gray-900 dark:text-white">
                  </td>
                  <td class="py-2 px-3">
                    <input type="text" name="varians[0][ukuran]" placeholder="S / M / L / Oversized" value="M" required class="w-full px-2.5 py-1.5 text-xs rounded-lg border border-gray-200 dark:border-anime-cardborder bg-white dark:bg-[#12141f] text-gray-900 dark:text-white">
                  </td>
                  <td class="py-2 px-3">
                    <input type="number" name="varians[0][stok]" min="0" value="10" required class="w-full px-2.5 py-1.5 text-xs rounded-lg border border-gray-200 dark:border-anime-cardborder bg-white dark:bg-[#12141f] text-gray-900 dark:text-white">
                  </td>
                  <td class="py-2 px-3 text-center">
                    <button type="button" class="text-gray-400 hover:text-rose-600 btn-remove-row">✕</button>
                  </td>
                </tr>
                <tr class="variant-row">
                  <td class="py-2 px-3">
                    <input type="text" name="varians[1][warna]" placeholder="Hitam / Navy" value="Hitam" class="w-full px-2.5 py-1.5 text-xs rounded-lg border border-gray-200 dark:border-anime-cardborder bg-white dark:bg-[#12141f] text-gray-900 dark:text-white">
                  </td>
                  <td class="py-2 px-3">
                    <input type="text" name="varians[1][ukuran]" placeholder="S / M / L / Oversized" value="L" class="w-full px-2.5 py-1.5 text-xs rounded-lg border border-gray-200 dark:border-anime-cardborder bg-white dark:bg-[#12141f] text-gray-900 dark:text-white">
                  </td>
                  <td class="py-2 px-3">
                    <input type="number" name="varians[1][stok]" min="0" value="15" class="w-full px-2.5 py-1.5 text-xs rounded-lg border border-gray-200 dark:border-anime-cardborder bg-white dark:bg-[#12141f] text-gray-900 dark:text-white">
                  </td>
                  <td class="py-2 px-3 text-center">
                    <button type="button" class="text-gray-400 hover:text-rose-600 btn-remove-row">✕</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Form Actions -->
        <div class="pt-6 flex items-center justify-end gap-3 border-t border-gray-100 dark:border-anime-cardborder">
          <a href="{{ route('admin.barang.index') }}" class="px-5 py-2.5 text-xs font-semibold rounded-xl text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-[#161826] transition">
            Batal
          </a>
          <button type="submit" class="px-6 py-2.5 text-xs font-bold rounded-xl bg-anime-red hover:bg-anime-redhover text-white transition shadow-sm">
            Simpan Produk & Varian
          </button>
        </div>

      </form>
    </div>
  </div>

@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    let rowIndex = 2;
    const tbody = document.getElementById('variantsTableBody');
    const btnAdd = document.getElementById('btnAddVariantRow');

    btnAdd.addEventListener('click', function() {
      const tr = document.createElement('tr');
      tr.className = 'variant-row';
      tr.innerHTML = `
        <td class="py-2 px-3">
          <input type="text" name="varians[${rowIndex}][warna]" placeholder="Warna" required class="w-full px-2.5 py-1.5 text-xs rounded-lg border border-gray-200 dark:border-anime-cardborder bg-white dark:bg-[#12141f] text-gray-900 dark:text-white">
        </td>
        <td class="py-2 px-3">
          <input type="text" name="varians[${rowIndex}][ukuran]" placeholder="Size (S/M/L/XL)" required class="w-full px-2.5 py-1.5 text-xs rounded-lg border border-gray-200 dark:border-anime-cardborder bg-white dark:bg-[#12141f] text-gray-900 dark:text-white">
        </td>
        <td class="py-2 px-3">
          <input type="number" name="varians[${rowIndex}][stok]" min="0" value="10" required class="w-full px-2.5 py-1.5 text-xs rounded-lg border border-gray-200 dark:border-anime-cardborder bg-white dark:bg-[#12141f] text-gray-900 dark:text-white">
        </td>
        <td class="py-2 px-3 text-center">
          <button type="button" class="text-gray-400 hover:text-rose-600 btn-remove-row">✕</button>
        </td>
      `;
      tbody.appendChild(tr);
      rowIndex++;
    });

    tbody.addEventListener('click', function(e) {
      if (e.target.classList.contains('btn-remove-row')) {
        const rows = tbody.querySelectorAll('.variant-row');
        if (rows.length > 1) {
          e.target.closest('tr').remove();
        } else {
          alert('Minimal harus ada 1 varian produk.');
        }
      }
    });
  });
</script>
@endpush

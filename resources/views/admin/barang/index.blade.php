@extends('layouts.admin')

@section('title', 'Manajemen Barang & Produk')
@section('header_title', 'Manajemen Produk Busana')

@section('content')

  <!-- Header & Action -->
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2">
    <div>
      <h2 class="text-base font-bold text-gray-900 dark:text-white">Daftar Produk Baju</h2>
      <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Kelola data pakaian anime, harga, foto, status, dan stok varian langsung via modal.</p>
    </div>

    <!-- Trigger Modal Tambah Barang -->
    <button
      type="button"
      onclick="openModal('modalCreateBarang')"
      class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-anime-red hover:bg-anime-redhover text-white text-xs font-bold transition shadow-sm"
    >
      <i class="ph-bold ph-plus-circle text-base"></i>
      <span>Tambah Produk Baru</span>
    </button>
  </div>

  <!-- Filters & Search Toolbar -->
  <div class="bg-white dark:bg-anime-card p-4 rounded-2xl border border-gray-200/80 dark:border-anime-cardborder shadow-sm transition-colors duration-200">
    <form method="GET" action="{{ route('admin.barang.index') }}" class="grid grid-cols-1 sm:grid-cols-12 gap-3 items-center">

      <div class="sm:col-span-5 relative">
        <input
          type="text"
          name="search"
          value="{{ $search }}"
          placeholder="Cari nama produk baju..."
          class="w-full pl-9 pr-4 py-2 text-xs rounded-xl border border-gray-200 dark:border-anime-cardborder bg-gray-50 dark:bg-anime-black text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-anime-red/20 focus:border-anime-red transition placeholder-gray-400 dark:placeholder-gray-500"
        >
        <i class="ph-bold ph-magnifying-glass absolute left-3 top-2.5 text-gray-400 text-sm"></i>
      </div>

      <div class="sm:col-span-3">
        <select
          name="kategori_id"
          class="w-full px-3 py-2 text-xs rounded-xl border border-gray-200 dark:border-anime-cardborder bg-white dark:bg-anime-black text-gray-700 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-anime-red/20 focus:border-anime-red transition"
        >
          <option value="">Semua Kategori</option>
          @foreach($kategoris as $kat)
            <option value="{{ $kat->id }}" {{ $selectedKategori === $kat->id ? 'selected' : '' }}>
              {{ $kat->nama }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="sm:col-span-2">
        <select
          name="status"
          class="w-full px-3 py-2 text-xs rounded-xl border border-gray-200 dark:border-anime-cardborder bg-white dark:bg-anime-black text-gray-700 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-anime-red/20 focus:border-anime-red transition"
        >
          <option value="">Semua Status</option>
          <option value="aktif" {{ $selectedStatus === 'aktif' ? 'selected' : '' }}>Aktif</option>
          <option value="nonaktif" {{ $selectedStatus === 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
        </select>
      </div>

      <div class="sm:col-span-2 flex items-center gap-2">
        <button
          type="submit"
          class="flex-1 py-2 px-3 rounded-xl bg-gray-900 dark:bg-[#161826] hover:bg-black text-white text-xs font-bold transition flex items-center justify-center gap-1 border border-gray-700 dark:border-[#22273d]"
        >
          <i class="ph-bold ph-funnel"></i> Filter
        </button>
        @if($search || $selectedKategori || $selectedStatus)
          <a
            href="{{ route('admin.barang.index') }}"
            class="p-2 rounded-xl border border-gray-200 dark:border-anime-cardborder text-gray-500 hover:text-anime-red transition"
            title="Reset Filter"
          >
            <i class="ph-bold ph-arrow-counter-clockwise"></i>
          </a>
        @endif
      </div>

    </form>
  </div>

  <!-- Products Table Card -->
  <div class="bg-white dark:bg-anime-card rounded-2xl border border-gray-200/80 dark:border-anime-cardborder shadow-sm overflow-hidden transition-colors duration-200">
    <div class="overflow-x-auto">
      <table class="w-full text-left text-xs">
        <thead class="bg-gray-50 dark:bg-[#161826] text-gray-500 dark:text-gray-400 font-bold uppercase tracking-wider text-[10px] border-b border-gray-200 dark:border-anime-cardborder">
          <tr>
            <th class="py-3.5 px-4 w-16 text-center">Foto</th>
            <th class="py-3.5 px-4">Nama Produk & Kategori</th>
            <th class="py-3.5 px-4">Harga Dasar</th>
            <th class="py-3.5 px-4 text-center">Stok Total</th>
            <th class="py-3.5 px-4 text-center">Status</th>
            <th class="py-3.5 px-4 text-right">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 dark:divide-anime-cardborder text-gray-700 dark:text-gray-300">
          @forelse($barangs as $item)
            <tr class="hover:bg-gray-50/50 dark:hover:bg-[#161826]/40 transition">
              <!-- Thumbnail -->
              <td class="py-3.5 px-4 text-center">
                <div class="w-12 h-16 rounded-lg overflow-hidden bg-gray-100 dark:bg-anime-black mx-auto border border-gray-200 dark:border-anime-cardborder">
                  <img src="{{ $item->foto_url }}" alt="{{ $item->nama }}" class="w-full h-full object-cover" onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1521572267360-ee0c2909d518?auto=format&fit=crop&w=800&q=80';">
                </div>
              </td>

              <!-- Info -->
              <td class="py-3.5 px-4">
                <span class="font-bold text-gray-900 dark:text-white text-sm block">{{ $item->nama }}</span>
                <div class="flex items-center gap-2 mt-1">
                  <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-rose-50 dark:bg-rose-950/40 text-anime-red border border-rose-200 dark:border-rose-900/40">
                    {{ $item->kategori->nama ?? 'Tanpa Kategori' }}
                  </span>
                  <span class="text-[11px] text-gray-400">
                    • {{ $item->varians->count() }} Varian ({{ $item->varians->pluck('warna')->unique()->implode(', ') }})
                  </span>
                </div>
              </td>

              <!-- Harga -->
              <td class="py-3.5 px-4 font-bold text-gray-900 dark:text-white text-sm whitespace-nowrap">
                {{ $item->formatted_harga }}
              </td>

              <!-- Total Stock -->
              <td class="py-3.5 px-4 text-center whitespace-nowrap">
                @if($item->total_stok > 10)
                  <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-50 dark:bg-emerald-950/40 text-emerald-800 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-800">
                    {{ $item->total_stok }} pcs
                  </span>
                @elseif($item->total_stok > 0)
                  <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-amber-50 dark:bg-amber-950/40 text-amber-800 dark:text-amber-300 border border-amber-200 dark:border-amber-800">
                    {{ $item->total_stok }} pcs
                  </span>
                @else
                  <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-rose-50 dark:bg-rose-950/40 text-rose-800 dark:text-rose-300 border border-rose-200 dark:border-rose-800">
                    Habis (0)
                  </span>
                @endif
              </td>

              <!-- Status -->
              <td class="py-3.5 px-4 text-center whitespace-nowrap">
                @if($item->status === 'aktif')
                  <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-emerald-100 dark:bg-emerald-950/60 text-emerald-800 dark:text-emerald-300">
                    ● Aktif
                  </span>
                @else
                  <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-gray-100 dark:bg-[#161826] text-gray-600 dark:text-gray-400">
                    ○ Nonaktif
                  </span>
                @endif
              </td>

              <!-- Actions -->
              <td class="py-3.5 px-4 text-right whitespace-nowrap space-x-2">
                <a
                  href="{{ route('catalog.show', $item->id) }}"
                  target="_blank"
                  class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg border border-gray-200 dark:border-anime-cardborder text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-[#161826] hover:text-anime-red text-xs font-bold transition"
                  title="Lihat di Katalog"
                >
                  <i class="ph-bold ph-eye"></i>
                </a>

                <!-- Trigger Modal Edit & Varian -->
                <button
                  type="button"
                  onclick="openModal('modalEditBarang_{{ $item->id }}')"
                  class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg bg-anime-red/10 border border-anime-red/30 text-anime-red hover:bg-anime-red hover:text-white text-xs font-bold transition"
                >
                  <i class="ph-bold ph-pencil-simple"></i> Edit & Varian
                </button>

                <!-- Delete Form -->
                <form action="{{ route('admin.barang.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk {{ addslashes($item->nama) }}?');">
                  @csrf
                  @method('DELETE')
                  <button
                    type="submit"
                    class="inline-flex items-center gap-1 px-2.5 py-1.5 rounded-lg border border-rose-200 dark:border-rose-800/50 text-rose-600 dark:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-950/40 text-xs font-bold transition"
                    title="Hapus Produk"
                  >
                    <i class="ph-bold ph-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="6" class="py-12 text-center text-gray-400 dark:text-gray-500">
                <i class="ph-bold ph-hanger text-3xl mb-2 block"></i>
                Tidak ada produk baju yang sesuai dengan pencarian atau filter.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($barangs->hasPages())
      <div class="p-4 border-t border-gray-200 dark:border-anime-cardborder">
        {{ $barangs->links() }}
      </div>
    @endif
  </div>

  <!-- ============================================================== -->
  <!-- MODAL: Tambah Produk Baju Baru                                 -->
  <!-- ============================================================== -->
  <div id="modalCreateBarang" class="modal-overlay fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4 hidden overflow-y-auto">
    <div class="relative w-full max-w-2xl bg-white dark:bg-[#12141f] rounded-3xl border border-gray-200 dark:border-[#1e2235] shadow-2xl overflow-hidden my-8 transform transition-all animate-in fade-in zoom-in-95 duration-200">

      <!-- Header -->
      <div class="px-6 py-5 border-b border-gray-100 dark:border-[#1e2235] flex items-center justify-between bg-gray-50/60 dark:bg-black/20">
        <div class="flex items-center gap-3">
          <div class="w-9 h-9 rounded-xl bg-anime-red/10 text-anime-red flex items-center justify-center font-bold">
            <i class="ph-bold ph-hanger text-lg"></i>
          </div>
          <div>
            <h3 class="text-sm font-bold text-gray-900 dark:text-white">Tambah Produk Baju Baru</h3>
            <p class="text-[11px] text-gray-400">Lengkapi informasi produk fashion & varian awal</p>
          </div>
        </div>
        <button type="button" onclick="closeModal('modalCreateBarang')" class="p-1.5 rounded-lg text-gray-400 hover:text-gray-700 dark:hover:text-white transition">
          <i class="ph-bold ph-x text-base"></i>
        </button>
      </div>

      <!-- Form -->
      <form action="{{ route('admin.barang.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-4 max-h-[75vh] overflow-y-auto">
        @csrf

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <!-- Nama Produk -->
          <div>
            <label for="create_nama_barang" class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
              Nama Produk Baju <span class="text-anime-red">*</span>
            </label>
            <input
              type="text"
              name="nama"
              id="create_nama_barang"
              required
              placeholder="Contoh: Kaos Anime Gojo Satoru Oversized"
              class="w-full px-4 py-2.5 text-xs rounded-xl border border-gray-200 dark:border-anime-cardborder bg-gray-50 dark:bg-anime-black text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-anime-red/20 focus:border-anime-red transition placeholder-gray-400"
            >
          </div>

          <!-- Kategori -->
          <div>
            <label for="create_kategori_id" class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
              Kategori <span class="text-anime-red">*</span>
            </label>
            <select
              name="kategori_id"
              id="create_kategori_id"
              required
              class="w-full px-4 py-2.5 text-xs rounded-xl border border-gray-200 dark:border-anime-cardborder bg-gray-50 dark:bg-anime-black text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-anime-red/20 focus:border-anime-red transition"
            >
              <option value="">Pilih Kategori Produk...</option>
              @foreach($kategoris as $kat)
                <option value="{{ $kat->id }}">{{ $kat->nama }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
          <!-- Harga Dasar -->
          <div>
            <label for="create_harga" class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
              Harga Dasar (Rp) <span class="text-anime-red">*</span>
            </label>
            <div class="relative">
              <span class="absolute left-3.5 top-2.5 text-xs font-bold text-gray-400">Rp</span>
              <input
                type="number"
                name="harga"
                id="create_harga"
                required
                min="0"
                step="500"
                placeholder="149000"
                class="w-full pl-10 pr-4 py-2.5 text-xs rounded-xl border border-gray-200 dark:border-anime-cardborder bg-gray-50 dark:bg-anime-black text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-anime-red/20 focus:border-anime-red transition font-bold"
              >
            </div>
          </div>

          <!-- Status Tampilan -->
          <div>
            <label for="create_status" class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
              Status Katalog <span class="text-anime-red">*</span>
            </label>
            <select
              name="status"
              id="create_status"
              required
              class="w-full px-4 py-2.5 text-xs rounded-xl border border-gray-200 dark:border-anime-cardborder bg-gray-50 dark:bg-anime-black text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-anime-red/20 focus:border-anime-red transition"
            >
              <option value="aktif" selected>Aktif (Tampil di Katalog)</option>
              <option value="nonaktif">Nonaktif (Sembunyikan)</option>
            </select>
          </div>
        </div>

        <!-- Foto Utama -->
        <div>
          <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
            Foto Utama Baju
          </label>
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
            <input
              type="file"
              name="foto_file"
              accept="image/*"
              class="w-full text-xs text-gray-500 dark:text-gray-400 file:mr-3 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-anime-red/10 file:text-anime-red hover:file:bg-anime-red/20 cursor-pointer"
            >
            <input
              type="url"
              name="foto_url_input"
              placeholder="Atau via URL (https://...)"
              class="w-full px-3 py-2 text-xs rounded-xl border border-gray-200 dark:border-anime-cardborder text-gray-900 dark:text-white bg-gray-50 dark:bg-anime-black placeholder-gray-400"
            >
          </div>
        </div>

        <!-- Deskripsi -->
        <div>
          <label for="create_deskripsi" class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
            Deskripsi Produk & Spesifikasi Bahan <span class="text-anime-red">*</span>
          </label>
          <textarea
            name="deskripsi"
            id="create_deskripsi"
            rows="3"
            required
            placeholder="Deskripsikan bahan (contoh: 100% Cotton 24s), teknik sablon DTF, potongan boxy oversized fit..."
            class="w-full px-4 py-2.5 text-xs rounded-xl border border-gray-200 dark:border-anime-cardborder bg-gray-50 dark:bg-anime-black text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-anime-red/20 focus:border-anime-red transition"
          ></textarea>
        </div>

        <!-- Varian Awal -->
        <div class="p-4 rounded-2xl bg-gray-50 dark:bg-black/30 border border-gray-100 dark:border-[#1e2235] space-y-3">
          <span class="text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider flex items-center gap-1.5">
            <i class="ph-bold ph-circles-three text-anime-red"></i> Varian Awal (Opsional)
          </span>
          <div class="grid grid-cols-3 gap-3">
            <div>
              <label class="block text-[10px] text-gray-400 uppercase font-semibold mb-1">Ukuran</label>
              <input type="text" name="varians[0][ukuran]" placeholder="M / L / XL" value="L" class="w-full px-3 py-1.5 text-xs rounded-lg border border-gray-200 dark:border-anime-cardborder bg-white dark:bg-anime-black text-gray-900 dark:text-white">
            </div>
            <div>
              <label class="block text-[10px] text-gray-400 uppercase font-semibold mb-1">Warna</label>
              <input type="text" name="varians[0][warna]" placeholder="Hitam / Putih" value="Jet Black" class="w-full px-3 py-1.5 text-xs rounded-lg border border-gray-200 dark:border-anime-cardborder bg-white dark:bg-anime-black text-gray-900 dark:text-white">
            </div>
            <div>
              <label class="block text-[10px] text-gray-400 uppercase font-semibold mb-1">Stok</label>
              <input type="number" name="varians[0][stok]" placeholder="Jumlah" value="25" min="0" class="w-full px-3 py-1.5 text-xs rounded-lg border border-gray-200 dark:border-anime-cardborder bg-white dark:bg-anime-black text-gray-900 dark:text-white">
            </div>
          </div>
        </div>

        <!-- Footer Actions -->
        <div class="pt-4 flex items-center justify-end gap-2.5 border-t border-gray-100 dark:border-[#1e2235]">
          <button
            type="button"
            onclick="closeModal('modalCreateBarang')"
            class="px-4 py-2.5 rounded-xl border border-gray-200 dark:border-anime-cardborder text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-[#181a28] text-xs font-bold transition"
          >
            Batal
          </button>
          <button
            type="submit"
            class="px-5 py-2.5 rounded-xl bg-anime-red hover:bg-anime-redhover text-white text-xs font-bold transition shadow-sm flex items-center gap-1.5"
          >
            <i class="ph-bold ph-check"></i>
            <span>Simpan Produk</span>
          </button>
        </div>

      </form>
    </div>
  </div>

  <!-- ============================================================== -->
  <!-- MODALS: Edit Produk & Kelola Varian (Per-Barang)                -->
  <!-- ============================================================== -->
  @foreach($barangs as $item)
    <div id="modalEditBarang_{{ $item->id }}" class="modal-overlay fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4 hidden overflow-y-auto">
      <div class="relative w-full max-w-3xl bg-white dark:bg-[#12141f] rounded-3xl border border-gray-200 dark:border-[#1e2235] shadow-2xl overflow-hidden my-8 transform transition-all animate-in fade-in zoom-in-95 duration-200">

        <!-- Modal Header -->
        <div class="px-6 py-5 border-b border-gray-100 dark:border-[#1e2235] flex items-center justify-between bg-gray-50/60 dark:bg-black/20">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl overflow-hidden bg-gray-100 dark:bg-anime-black border border-gray-200 dark:border-anime-cardborder shrink-0">
              <img src="{{ $item->foto_url }}" alt="{{ $item->nama }}" class="w-full h-full object-cover">
            </div>
            <div>
              <h3 class="text-sm font-bold text-gray-900 dark:text-white truncate max-w-md">{{ $item->nama }}</h3>
              <p class="text-[11px] text-gray-400">Edit informasi pakaian, harga, dan kelola stok varian</p>
            </div>
          </div>
          <button type="button" onclick="closeModal('modalEditBarang_{{ $item->id }}')" class="p-1.5 rounded-lg text-gray-400 hover:text-gray-700 dark:hover:text-white transition">
            <i class="ph-bold ph-x text-base"></i>
          </button>
        </div>

        <!-- Modal Body: Tabs / Sections -->
        <div class="p-6 max-h-[75vh] overflow-y-auto space-y-8 divide-y divide-gray-100 dark:divide-[#1e2235]">

          <!-- SECTION 1: Edit Informasi Produk -->
          <form action="{{ route('admin.barang.update', $item->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div class="flex items-center justify-between">
              <span class="text-xs font-bold text-anime-red uppercase tracking-wider flex items-center gap-1.5">
                <i class="ph-bold ph-info"></i> Informasi Utama Baju
              </span>
              <span class="text-[11px] text-gray-400">ID: {{ substr($item->id, 0, 8) }}...</span>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <!-- Nama -->
              <div>
                <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
                  Nama Produk <span class="text-anime-red">*</span>
                </label>
                <input
                  type="text"
                  name="nama"
                  value="{{ $item->nama }}"
                  required
                  class="w-full px-4 py-2 text-xs rounded-xl border border-gray-200 dark:border-anime-cardborder bg-gray-50 dark:bg-anime-black text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-anime-red/20 focus:border-anime-red transition"
                >
              </div>

              <!-- Kategori -->
              <div>
                <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
                  Kategori <span class="text-anime-red">*</span>
                </label>
                <select
                  name="kategori_id"
                  required
                  class="w-full px-4 py-2 text-xs rounded-xl border border-gray-200 dark:border-anime-cardborder bg-gray-50 dark:bg-anime-black text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-anime-red/20 focus:border-anime-red transition"
                >
                  @foreach($kategoris as $kat)
                    <option value="{{ $kat->id }}" {{ $item->kategori_id === $kat->id ? 'selected' : '' }}>
                      {{ $kat->nama }}
                    </option>
                  @endforeach
                </select>
              </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <!-- Harga -->
              <div>
                <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
                  Harga Dasar (Rp) <span class="text-anime-red">*</span>
                </label>
                <input
                  type="number"
                  name="harga"
                  value="{{ (int)$item->harga }}"
                  required
                  min="0"
                  step="500"
                  class="w-full px-4 py-2 text-xs rounded-xl border border-gray-200 dark:border-anime-cardborder bg-gray-50 dark:bg-anime-black text-gray-900 dark:text-white font-bold"
                >
              </div>

              <!-- Status -->
              <div>
                <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
                  Status Katalog <span class="text-anime-red">*</span>
                </label>
                <select
                  name="status"
                  required
                  class="w-full px-4 py-2 text-xs rounded-xl border border-gray-200 dark:border-anime-cardborder bg-gray-50 dark:bg-anime-black text-gray-900 dark:text-white"
                >
                  <option value="aktif" {{ $item->status === 'aktif' ? 'selected' : '' }}>Aktif (Tampil di Katalog)</option>
                  <option value="nonaktif" {{ $item->status === 'nonaktif' ? 'selected' : '' }}>Nonaktif (Sembunyikan)</option>
                </select>
              </div>
            </div>

            <!-- Ganti Foto -->
            <div>
              <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
                Ubah Foto Utama (Opsional)
              </label>
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <input
                  type="file"
                  name="foto_file"
                  accept="image/*"
                  class="w-full text-xs text-gray-500 dark:text-gray-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-anime-red/10 file:text-anime-red hover:file:bg-anime-red/20"
                >
                <input
                  type="url"
                  name="foto_url_input"
                  placeholder="Atau ubah via URL (https://...)"
                  class="w-full px-3 py-1.5 text-xs rounded-xl border border-gray-200 dark:border-anime-cardborder bg-gray-50 dark:bg-anime-black text-gray-900 dark:text-white placeholder-gray-400"
                >
              </div>
            </div>

            <!-- Deskripsi -->
            <div>
              <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
                Deskripsi Bahan & Spesifikasi <span class="text-anime-red">*</span>
              </label>
              <textarea
                name="deskripsi"
                rows="2"
                required
                class="w-full px-4 py-2 text-xs rounded-xl border border-gray-200 dark:border-anime-cardborder bg-gray-50 dark:bg-anime-black text-gray-900 dark:text-white"
              >{{ $item->deskripsi }}</textarea>
            </div>

            <div class="flex justify-end">
              <button
                type="submit"
                class="px-4 py-2 rounded-xl bg-gray-900 hover:bg-black dark:bg-[#181a28] dark:hover:bg-[#202336] text-white text-xs font-bold transition flex items-center gap-1.5 border border-gray-700 dark:border-[#2a2f4c]"
              >
                <i class="ph-bold ph-floppy-disk"></i>
                <span>Simpan Perubahan Info Baju</span>
              </button>
            </div>
          </form>

          <!-- SECTION 2: Kelola Varian & Stok Langsung -->
          <div class="pt-6 space-y-4">
            <div class="flex items-center justify-between">
              <div>
                <span class="text-xs font-bold text-purple-600 dark:text-purple-400 uppercase tracking-wider flex items-center gap-1.5">
                  <i class="ph-bold ph-stack"></i> Kelola Varian Ukuran & Stok
                </span>
                <span class="text-[11px] text-gray-400">Total Stok: {{ $item->total_stok }} pcs ({{ $item->varians->count() }} varian terdaftar)</span>
              </div>
            </div>

            <!-- Daftar Varian Table -->
            <div class="rounded-2xl border border-gray-200 dark:border-anime-cardborder overflow-hidden bg-gray-50/50 dark:bg-black/20">
              <table class="w-full text-xs text-left">
                <thead class="bg-gray-100 dark:bg-[#161826] text-gray-500 text-[10px] uppercase font-bold">
                  <tr>
                    <th class="py-2.5 px-3">Ukuran</th>
                    <th class="py-2.5 px-3">Warna / Tema</th>
                    <th class="py-2.5 px-3 w-28">Stok</th>
                    <th class="py-2.5 px-3 text-right">Aksi</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-anime-cardborder text-gray-700 dark:text-gray-300">
                  @forelse($item->varians as $var)
                    <tr>
                      <td class="py-2.5 px-3 font-bold text-gray-900 dark:text-white">
                        {{ $var->ukuran }}
                      </td>
                      <td class="py-2.5 px-3">
                        {{ $var->warna }}
                      </td>
                      <!-- Inline Quick Stock Edit -->
                      <td class="py-2.5 px-3">
                        <form action="{{ route('admin.barang.varian.update', [$item->id, $var->id]) }}" method="POST" class="flex items-center gap-1">
                          @csrf
                          @method('PUT')
                          <input
                            type="number"
                            name="stok"
                            value="{{ $var->stok }}"
                            min="0"
                            class="w-16 px-2 py-1 text-xs font-bold rounded-lg border border-gray-200 dark:border-anime-cardborder bg-white dark:bg-anime-black text-gray-900 dark:text-white"
                          >
                          <button type="submit" class="p-1 rounded bg-gray-200 dark:bg-[#202336] text-gray-700 dark:text-gray-300 hover:text-anime-red text-xs" title="Update Stok">
                            ✓
                          </button>
                        </form>
                      </td>
                      <!-- Delete Variant -->
                      <td class="py-2.5 px-3 text-right">
                        <form action="{{ route('admin.barang.varian.destroy', [$item->id, $var->id]) }}" method="POST" class="inline" onsubmit="return confirm('Hapus varian ini?');">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="text-rose-500 hover:text-rose-700 p-1 rounded" title="Hapus Varian">
                            <i class="ph-bold ph-trash"></i>
                          </button>
                        </form>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="4" class="py-4 text-center text-gray-400">Belum ada varian. Tambah varian di bawah.</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>

            <!-- Form Tambah Varian Baru -->
            <form action="{{ route('admin.barang.varian.store', $item->id) }}" method="POST" class="p-3 rounded-xl border border-dashed border-gray-300 dark:border-gray-700 bg-white dark:bg-anime-card flex flex-wrap items-center gap-2">
              @csrf
              <span class="text-[11px] font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider block w-full sm:w-auto">
                + Tambah Varian:
              </span>
              <input
                type="text"
                name="ukuran"
                placeholder="Ukuran (M, L, XL...)"
                required
                class="px-2.5 py-1.5 text-xs rounded-lg border border-gray-200 dark:border-anime-cardborder bg-gray-50 dark:bg-anime-black text-gray-900 dark:text-white flex-1 min-w-[100px]"
              >
              <input
                type="text"
                name="warna"
                placeholder="Warna / Corak"
                required
                class="px-2.5 py-1.5 text-xs rounded-lg border border-gray-200 dark:border-anime-cardborder bg-gray-50 dark:bg-anime-black text-gray-900 dark:text-white flex-1 min-w-[120px]"
              >
              <input
                type="number"
                name="stok"
                placeholder="Stok"
                value="10"
                min="0"
                required
                class="w-20 px-2.5 py-1.5 text-xs rounded-lg border border-gray-200 dark:border-anime-cardborder bg-gray-50 dark:bg-anime-black text-gray-900 dark:text-white"
              >
              <button
                type="submit"
                class="px-3 py-1.5 rounded-lg bg-anime-red hover:bg-anime-redhover text-white text-xs font-bold transition flex items-center gap-1 shadow-xs"
              >
                <i class="ph-bold ph-plus"></i> Tambah
              </button>
            </form>
          </div>

        </div>

        <!-- Modal Footer -->
        <div class="px-6 py-4 bg-gray-50/60 dark:bg-black/20 border-t border-gray-100 dark:border-[#1e2235] flex justify-end">
          <button
            type="button"
            onclick="closeModal('modalEditBarang_{{ $item->id }}')"
            class="px-5 py-2 rounded-xl bg-gray-200 dark:bg-[#181a28] hover:bg-gray-300 dark:hover:bg-[#202336] text-gray-800 dark:text-gray-200 text-xs font-bold transition"
          >
            Tutup Modal
          </button>
        </div>

      </div>
    </div>
  @endforeach

@endsection

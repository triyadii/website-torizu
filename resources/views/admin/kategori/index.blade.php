@extends('layouts.admin')

@section('title', 'Manajemen Kategori')
@section('header_title', 'Manajemen Kategori Produk')

@section('content')

  <!-- Header & Action -->
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2">
    <div>
      <h2 class="text-base font-bold text-gray-900 dark:text-white">Daftar Kategori Pakaian</h2>
      <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Kelola pengelompokan produk baju untuk katalog dan navigasi.</p>
    </div>

    <!-- Trigger Modal Tambah Kategori -->
    <button
      type="button"
      onclick="openModal('modalCreateKategori')"
      class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-anime-red hover:bg-anime-redhover text-white text-xs font-bold transition shadow-sm"
    >
      <i class="ph-bold ph-plus-circle text-base"></i>
      <span>Tambah Kategori Baru</span>
    </button>
  </div>

  <!-- Category List Card -->
  <div class="bg-white dark:bg-anime-card rounded-2xl border border-gray-200/80 dark:border-anime-cardborder shadow-sm overflow-hidden transition-colors duration-200">
    <div class="overflow-x-auto">
      <table class="w-full text-left text-xs">
        <thead class="bg-gray-50 dark:bg-[#161826] text-gray-500 dark:text-gray-400 font-bold uppercase tracking-wider text-[10px] border-b border-gray-200 dark:border-anime-cardborder">
          <tr>
            <th class="py-3.5 px-6">Nama Kategori</th>
            <th class="py-3.5 px-6">Slug URL</th>
            <th class="py-3.5 px-6 text-center">Jumlah Produk</th>
            <th class="py-3.5 px-6">Dibuat</th>
            <th class="py-3.5 px-6 text-right">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 dark:divide-anime-cardborder text-gray-700 dark:text-gray-300">
          @forelse($kategoris as $kat)
            <tr class="hover:bg-gray-50/50 dark:hover:bg-[#161826]/40 transition">
              <td class="py-4 px-6 font-bold text-gray-900 dark:text-white text-sm">
                {{ $kat->nama }}
              </td>
              <td class="py-4 px-6 text-gray-500 dark:text-gray-400 font-mono text-[11px]">
                /katalog?kategori={{ $kat->slug }}
              </td>
              <td class="py-4 px-6 text-center">
                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-gray-100 dark:bg-[#161826] text-gray-800 dark:text-gray-200 border border-gray-200 dark:border-anime-cardborder">
                  {{ $kat->barangs_count }} Barang
                </span>
              </td>
              <td class="py-4 px-6 text-gray-500 dark:text-gray-400 whitespace-nowrap">
                {{ $kat->created_at->format('d M Y, H:i') }}
              </td>
              <td class="py-4 px-6 text-right whitespace-nowrap space-x-2">
                <!-- Trigger Modal Edit Kategori -->
                <button
                  type="button"
                  onclick="openEditKategoriModal('{{ $kat->id }}', '{{ addslashes($kat->nama) }}', '{{ $kat->slug }}')"
                  class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg border border-gray-200 dark:border-anime-cardborder text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-[#161826] hover:text-anime-red text-xs font-bold transition"
                >
                  <i class="ph-bold ph-pencil-simple"></i> Edit
                </button>

                <!-- Delete Form -->
                <form action="{{ route('admin.kategori.destroy', $kat->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori {{ addslashes($kat->nama) }}?');">
                  @csrf
                  @method('DELETE')
                  <button
                    type="submit"
                    class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg border border-rose-200 dark:border-rose-900/40 text-rose-600 dark:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-950/40 text-xs font-bold transition"
                  >
                    <i class="ph-bold ph-trash"></i> Hapus
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="5" class="py-12 text-center text-gray-400 dark:text-gray-500">
                <i class="ph-bold ph-tag text-3xl mb-2 block"></i>
                Belum ada kategori pakaian. Klik "Tambah Kategori Baru" untuk menambahkan.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($kategoris->hasPages())
      <div class="p-4 border-t border-gray-200 dark:border-anime-cardborder">
        {{ $kategoris->links() }}
      </div>
    @endif
  </div>

  <!-- ============================================================== -->
  <!-- MODAL: Tambah Kategori Baru                                    -->
  <!-- ============================================================== -->
  <div id="modalCreateKategori" class="modal-overlay fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4 hidden">
    <div class="relative w-full max-w-md bg-white dark:bg-[#12141f] rounded-3xl border border-gray-200 dark:border-[#1e2235] shadow-2xl overflow-hidden transform transition-all animate-in fade-in zoom-in-95 duration-200">

      <!-- Modal Header -->
      <div class="px-6 py-5 border-b border-gray-100 dark:border-[#1e2235] flex items-center justify-between bg-gray-50/60 dark:bg-black/20">
        <div class="flex items-center gap-3">
          <div class="w-9 h-9 rounded-xl bg-anime-red/10 text-anime-red flex items-center justify-center font-bold">
            <i class="ph-bold ph-tag text-lg"></i>
          </div>
          <div>
            <h3 class="text-sm font-bold text-gray-900 dark:text-white">Tambah Kategori Baru</h3>
            <p class="text-[11px] text-gray-400">Pengelompokan jenis pakaian di katalog</p>
          </div>
        </div>
        <button type="button" onclick="closeModal('modalCreateKategori')" class="p-1.5 rounded-lg text-gray-400 hover:text-gray-700 dark:hover:text-white transition">
          <i class="ph-bold ph-x text-base"></i>
        </button>
      </div>

      <!-- Modal Form -->
      <form action="{{ route('admin.kategori.store') }}" method="POST" class="p-6 space-y-4">
        @csrf

        <div>
          <label for="create_nama" class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
            Nama Kategori <span class="text-anime-red">*</span>
          </label>
          <input
            type="text"
            name="nama"
            id="create_nama"
            required
            placeholder="Contoh: Kaos Oversized, Hoodie, Kemeja..."
            oninput="document.getElementById('create_slug').value = this.value.toLowerCase().trim().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)+/g, '')"
            class="w-full px-4 py-2.5 text-xs rounded-xl border border-gray-200 dark:border-anime-cardborder bg-gray-50 dark:bg-anime-black text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-anime-red/20 focus:border-anime-red transition placeholder-gray-400"
          >
        </div>

        <div>
          <label for="create_slug" class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
            Slug URL <span class="text-gray-400 font-normal">(Otomatis untuk URL)</span>
          </label>
          <div class="relative">
            <span class="absolute left-3.5 top-2.5 text-xs text-gray-400 font-mono">/kategori/</span>
            <input
              type="text"
              name="slug"
              id="create_slug"
              placeholder="kaos-oversized"
              class="w-full pl-22 pr-4 py-2.5 text-xs rounded-xl border border-gray-200 dark:border-anime-cardborder bg-gray-50 dark:bg-anime-black text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-anime-red/20 focus:border-anime-red transition font-mono placeholder-gray-400"
            >
          </div>
        </div>

        <!-- Modal Actions -->
        <div class="pt-4 flex items-center justify-end gap-2.5 border-t border-gray-100 dark:border-[#1e2235]">
          <button
            type="button"
            onclick="closeModal('modalCreateKategori')"
            class="px-4 py-2.5 rounded-xl border border-gray-200 dark:border-anime-cardborder text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-[#181a28] text-xs font-bold transition"
          >
            Batal
          </button>
          <button
            type="submit"
            class="px-5 py-2.5 rounded-xl bg-anime-red hover:bg-anime-redhover text-white text-xs font-bold transition shadow-sm flex items-center gap-1.5"
          >
            <i class="ph-bold ph-check"></i>
            <span>Simpan Kategori</span>
          </button>
        </div>
      </form>

    </div>
  </div>

  <!-- ============================================================== -->
  <!-- MODAL: Edit Kategori                                           -->
  <!-- ============================================================== -->
  <div id="modalEditKategori" class="modal-overlay fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4 hidden">
    <div class="relative w-full max-w-md bg-white dark:bg-[#12141f] rounded-3xl border border-gray-200 dark:border-[#1e2235] shadow-2xl overflow-hidden transform transition-all animate-in fade-in zoom-in-95 duration-200">

      <!-- Modal Header -->
      <div class="px-6 py-5 border-b border-gray-100 dark:border-[#1e2235] flex items-center justify-between bg-gray-50/60 dark:bg-black/20">
        <div class="flex items-center gap-3">
          <div class="w-9 h-9 rounded-xl bg-purple-500/10 text-purple-500 flex items-center justify-center font-bold">
            <i class="ph-bold ph-pencil-simple text-lg"></i>
          </div>
          <div>
            <h3 class="text-sm font-bold text-gray-900 dark:text-white">Edit Kategori</h3>
            <p class="text-[11px] text-gray-400">Perbarui nama atau slug kategori pakaian</p>
          </div>
        </div>
        <button type="button" onclick="closeModal('modalEditKategori')" class="p-1.5 rounded-lg text-gray-400 hover:text-gray-700 dark:hover:text-white transition">
          <i class="ph-bold ph-x text-base"></i>
        </button>
      </div>

      <!-- Modal Form -->
      <form id="formEditKategori" method="POST" action="" class="p-6 space-y-4">
        @csrf
        @method('PUT')

        <div>
          <label for="edit_nama" class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
            Nama Kategori <span class="text-anime-red">*</span>
          </label>
          <input
            type="text"
            name="nama"
            id="edit_nama"
            required
            oninput="document.getElementById('edit_slug').value = this.value.toLowerCase().trim().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)+/g, '')"
            class="w-full px-4 py-2.5 text-xs rounded-xl border border-gray-200 dark:border-anime-cardborder bg-gray-50 dark:bg-anime-black text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-anime-red/20 focus:border-anime-red transition"
          >
        </div>

        <div>
          <label for="edit_slug" class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
            Slug URL <span class="text-gray-400 font-normal">(Otomatis untuk URL)</span>
          </label>
          <div class="relative">
            <span class="absolute left-3.5 top-2.5 text-xs text-gray-400 font-mono">/kategori/</span>
            <input
              type="text"
              name="slug"
              id="edit_slug"
              class="w-full pl-22 pr-4 py-2.5 text-xs rounded-xl border border-gray-200 dark:border-anime-cardborder bg-gray-50 dark:bg-anime-black text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-anime-red/20 focus:border-anime-red transition font-mono"
            >
          </div>
        </div>

        <!-- Modal Actions -->
        <div class="pt-4 flex items-center justify-end gap-2.5 border-t border-gray-100 dark:border-[#1e2235]">
          <button
            type="button"
            onclick="closeModal('modalEditKategori')"
            class="px-4 py-2.5 rounded-xl border border-gray-200 dark:border-anime-cardborder text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-[#181a28] text-xs font-bold transition"
          >
            Batal
          </button>
          <button
            type="submit"
            class="px-5 py-2.5 rounded-xl bg-anime-red hover:bg-anime-redhover text-white text-xs font-bold transition shadow-sm flex items-center gap-1.5"
          >
            <i class="ph-bold ph-check"></i>
            <span>Perbarui Kategori</span>
          </button>
        </div>
      </form>

    </div>
  </div>

@endsection

@push('scripts')
<script>
  function openEditKategoriModal(id, nama, slug) {
    const form = document.getElementById('formEditKategori');
    form.action = '{{ url("admin/kategori") }}/' + id;
    document.getElementById('edit_nama').value = nama;
    document.getElementById('edit_slug').value = slug;
    openModal('modalEditKategori');
  }
</script>
@endpush

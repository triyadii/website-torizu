@extends('layouts.app')

@section('title', $barang->nama . ' — TORIZU Anime Apparel')

@section('content')

  <!-- Breadcrumbs (Dark & Light) -->
  <div class="bg-white dark:bg-[#0c0d14] border-b border-gray-200 dark:border-anime-cardborder py-3.5 transition-colors duration-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <nav class="flex items-center text-xs text-gray-500 dark:text-gray-400 gap-2">
        <a href="{{ route('catalog.index') }}" class="hover:text-anime-red transition">Katalog</a>
        <span>/</span>
        <a href="{{ route('catalog.index', ['kategori' => $barang->kategori->slug ?? '']) }}" class="hover:text-anime-red transition">
          {{ $barang->kategori->nama ?? 'Anime' }}
        </a>
        <span>/</span>
        <span class="text-gray-900 dark:text-white font-semibold truncate max-w-xs">{{ $barang->nama }}</span>
      </nav>
    </div>
  </div>

  <!-- Product Detail Showcase -->
  <section class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">

        <!-- Product Image Preview (5 cols) -->
        <div class="lg:col-span-5 space-y-4">
          <div class="relative aspect-square rounded-3xl overflow-hidden bg-gray-100 dark:bg-anime-card border border-gray-200 dark:border-anime-cardborder shadow-md group">
            <img
              src="{{ $barang->foto_url }}"
              alt="{{ $barang->nama }}"
              id="mainProductImage"
              class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
              onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1521572267360-ee0c2909d518?auto=format&fit=crop&w=800&q=80';"
            >
            <div class="absolute top-4 left-4">
              <span class="px-3 py-1 rounded-md text-[10px] font-black uppercase tracking-wider bg-white/90 dark:bg-[#0c0d13]/90 text-anime-red shadow-sm border border-gray-200 dark:border-anime-cardborder">
                {{ $barang->kategori->nama ?? 'Anime Merch' }}
              </span>
            </div>
            <div class="absolute bottom-4 left-4 right-4 p-3 rounded-xl bg-white/95 dark:bg-[#0c0d13]/90 text-xs text-gray-700 dark:text-gray-300 flex items-center justify-between border border-gray-200 dark:border-anime-cardborder shadow-sm">
              <span class="flex items-center gap-1 font-bold text-emerald-600 dark:text-emerald-400">
                <i class="ph-fill ph-check-circle text-base"></i> 100% Original Torizu
              </span>
              <span class="text-[11px] font-mono text-gray-500 dark:text-gray-400">Total Stok: {{ $barang->total_stok }} pcs</span>
            </div>
          </div>
        </div>

        <!-- Product Details & Ordering Form (7 cols) -->
        <div class="lg:col-span-7 space-y-6">

          <!-- Title & Price Block -->
          <div class="border-b border-gray-200 dark:border-anime-cardborder pb-6 space-y-2">
            <div class="flex items-center gap-2">
              <span class="px-2.5 py-0.5 rounded text-[10px] font-black uppercase tracking-wider bg-gray-100 dark:bg-anime-card text-anime-red border border-gray-200 dark:border-anime-cardborder">
                OFFICIAL DROP 2026
              </span>
              @if($barang->total_stok > 0)
                <span class="px-2.5 py-0.5 rounded text-[10px] font-bold text-emerald-700 dark:text-emerald-400 bg-emerald-50 dark:bg-emerald-950/70 border border-emerald-200 dark:border-emerald-500/30">
                  Ready Stock Siap Kirim
                </span>
              @else
                <span class="px-2.5 py-0.5 rounded text-[10px] font-bold text-rose-700 dark:text-rose-400 bg-rose-50 dark:bg-rose-950/70 border border-rose-200 dark:border-rose-500/30">
                  Stok Habis
                </span>
              @endif
            </div>

            <h1 class="font-display font-black text-2xl sm:text-3xl lg:text-4xl text-gray-900 dark:text-white leading-tight">
              {{ $barang->nama }}
            </h1>

            <div class="flex items-baseline gap-3 pt-1">
              <span class="font-display font-black text-3xl sm:text-4xl text-gray-900 dark:text-white tracking-tight">
                {{ $barang->formatted_harga }}
              </span>
              <span class="text-xs text-gray-500 dark:text-gray-400 font-mono">Harga Spesial Promo</span>
            </div>
          </div>

          <!-- Description Block -->
          <div class="prose prose-sm max-w-none text-gray-600 dark:text-gray-300 leading-relaxed whitespace-pre-line text-xs sm:text-sm bg-white dark:bg-anime-card p-5 rounded-2xl border border-gray-200 dark:border-anime-cardborder">
            <h4 class="font-bold text-gray-900 dark:text-white text-xs uppercase tracking-wider mb-2 flex items-center gap-1.5 text-anime-red">
              <i class="ph-bold ph-info"></i> Deskripsi & Detail Bahan Anime
            </h4>
            {{ $barang->deskripsi }}
          </div>

          <!-- Interactive Order Form via WhatsApp -->
          <div id="pesan-wa" class="bg-white dark:bg-anime-card p-6 sm:p-7 rounded-3xl border border-gray-200 dark:border-anime-cardborder shadow-md space-y-6">
            <div class="flex items-center justify-between border-b border-gray-200 dark:border-anime-cardborder pb-4">
              <div>
                <h3 class="font-display font-bold text-base text-gray-900 dark:text-white flex items-center gap-2">
                  <i class="ph-fill ph-whatsapp-logo text-emerald-500 text-xl"></i>
                  Pesan Cepat via WhatsApp
                </h3>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Pilih varian, lengkapi nama & nomor WA, sistem otomatis membuka chat WhatsApp.</p>
              </div>
            </div>

            <form action="{{ route('catalog.orderWa', $barang->id) }}" method="POST" class="space-y-5" id="orderForm">
              @csrf

              <!-- Step 1: Select Variant -->
              @if($barang->varians->count() > 0)
                <div class="space-y-3">
                  <label class="block text-xs font-bold text-gray-800 dark:text-white uppercase tracking-wider flex items-center justify-between">
                    <span>1. Pilih Varian Ukuran & Warna:</span>
                    <span id="stockIndicator" class="text-emerald-600 dark:text-emerald-400 text-xs font-mono font-bold"></span>
                  </label>

                  <div class="grid grid-cols-2 sm:grid-cols-3 gap-2.5">
                    @foreach($barang->varians as $index => $varian)
                      <label class="relative flex flex-col p-3 rounded-xl border border-gray-200 dark:border-anime-cardborder bg-gray-50 dark:bg-anime-black/60 cursor-pointer hover:border-anime-red/60 transition group has-[:checked]:border-anime-red has-[:checked]:bg-anime-red/10 has-[:checked]:ring-1 has-[:checked]:ring-anime-red">
                        <input
                          type="radio"
                          name="varian_id"
                          value="{{ $varian->id }}"
                          data-stok="{{ $varian->stok }}"
                          data-label="{{ $varian->warna }} ({{ $varian->ukuran }})"
                          class="sr-only variant-radio"
                          {{ $index === 0 ? 'checked' : '' }}
                          {{ $varian->stok <= 0 ? 'disabled' : '' }}
                        >
                        <div class="flex items-center justify-between">
                          <span class="font-bold text-xs text-gray-900 dark:text-white group-hover:text-anime-red transition">
                            {{ $varian->ukuran }}
                          </span>
                          @if($varian->stok > 0)
                            <span class="text-[10px] font-mono text-emerald-600 dark:text-emerald-400">
                              {{ $varian->stok }} pcs
                            </span>
                          @else
                            <span class="text-[10px] font-mono text-rose-500">Habis</span>
                          @endif
                        </div>
                        <span class="text-[11px] text-gray-500 dark:text-gray-400 mt-1 truncate">
                          {{ $varian->warna }}
                        </span>
                      </label>
                    @endforeach
                  </div>
                </div>
              @endif

              <!-- Step 2: Customer Contact -->
              <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                  <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                    Nama Pemesan <span class="text-anime-red">*</span>
                  </label>
                  <input
                    type="text"
                    name="nama_pemesan"
                    required
                    placeholder="Contoh: Rian Pratama"
                    class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-gray-200 dark:border-anime-cardborder bg-gray-50 dark:bg-anime-black text-gray-900 dark:text-white focus:outline-none focus:border-anime-red transition placeholder-gray-400 dark:placeholder-gray-500"
                  >
                </div>

                <div>
                  <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                    Nomor WhatsApp <span class="text-anime-red">*</span>
                  </label>
                  <input
                    type="tel"
                    name="nomor_wa"
                    required
                    placeholder="Contoh: 081234567890"
                    class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-gray-200 dark:border-anime-cardborder bg-gray-50 dark:bg-anime-black text-gray-900 dark:text-white focus:outline-none focus:border-anime-red transition placeholder-gray-400 dark:placeholder-gray-500"
                  >
                </div>
              </div>

              <!-- Step 3: Optional Notes -->
              <div>
                <label class="block text-xs font-semibold text-gray-700 dark:text-gray-300 mb-1.5">
                  Catatan Tambahan (Opsional)
                </label>
                <input
                  type="text"
                  name="catatan"
                  placeholder="Contoh: Tolong kirim pakai box jika ada, terima kasih"
                  class="w-full px-3.5 py-2.5 text-xs rounded-xl border border-gray-200 dark:border-anime-cardborder bg-gray-50 dark:bg-anime-black text-gray-900 dark:text-white focus:outline-none focus:border-anime-red transition placeholder-gray-400 dark:placeholder-gray-500"
                >
              </div>

              <!-- Submit WhatsApp Button -->
              <div class="pt-2">
                <button
                  type="submit"
                  class="w-full py-4 px-6 rounded-2xl bg-emerald-600 hover:bg-emerald-500 text-white font-extrabold text-sm uppercase tracking-wider flex items-center justify-center gap-2.5 shadow-sm transition transform active:scale-[0.99]"
                >
                  <i class="ph-fill ph-whatsapp-logo text-2xl"></i>
                  <span>Pesan Sekarang via WhatsApp ↗</span>
                </button>
                <p class="text-[11px] text-gray-500 dark:text-gray-400 text-center mt-2">
                  🔒 Data Anda aman. Pesanan otomatis tersimpan dan Anda langsung diarahkan ke chat WhatsApp admin.
                </p>
              </div>

            </form>
          </div>

        </div>

      </div>

      <!-- Related Products -->
      @if($relatedBarangs->count() > 0)
        <div class="mt-20 pt-10 border-t border-gray-200 dark:border-anime-cardborder">
          <div class="flex items-center justify-between mb-6">
            <h3 class="font-display font-black text-xl text-gray-900 dark:text-white uppercase flex items-center gap-2">
              <span class="text-anime-red">⚡</span> Koleksi Anime Lainnya
            </h3>
            <a href="{{ route('catalog.index') }}#katalog-section" class="text-xs font-bold text-anime-red hover:underline uppercase">
              Lihat Semua →
            </a>
          </div>

          <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @foreach($relatedBarangs as $rel)
              <a href="{{ route('catalog.show', $rel->id) }}" class="group bg-white dark:bg-anime-card p-3 rounded-2xl border border-gray-200 dark:border-anime-cardborder hover:border-anime-red/40 transition block shadow-sm">
                <div class="aspect-square rounded-xl overflow-hidden bg-gray-100 dark:bg-anime-black mb-3">
                  <img src="{{ $rel->foto_url }}" alt="{{ $rel->nama }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                </div>
                <h4 class="font-bold text-xs text-gray-900 dark:text-white group-hover:text-anime-red transition truncate">
                  {{ $rel->nama }}
                </h4>
                <div class="font-display font-bold text-xs text-amber-500 dark:text-anime-gold mt-1">
                  {{ $rel->formatted_harga }}
                </div>
              </a>
            @endforeach
          </div>
        </div>
      @endif

    </div>
  </section>

@endsection

@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const radios = document.querySelectorAll('.variant-radio');
    const stockIndicator = document.getElementById('stockIndicator');

    function updateStock() {
      const selected = document.querySelector('.variant-radio:checked');
      if (selected && stockIndicator) {
        const stok = selected.getAttribute('data-stok');
        const label = selected.getAttribute('data-label');
        if (parseInt(stok) > 0) {
          stockIndicator.innerText = `Stok Tersedia: ${stok} pcs (${label})`;
          stockIndicator.className = 'text-emerald-400 text-xs font-mono font-bold';
        } else {
          stockIndicator.innerText = `Stok Habis untuk varian ini`;
          stockIndicator.className = 'text-rose-400 text-xs font-mono font-bold';
        }
      }
    }

    radios.forEach(r => r.addEventListener('change', updateStock));
    updateStock();
  });
</script>
@endpush

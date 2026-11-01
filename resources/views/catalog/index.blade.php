@extends('layouts.app')

@section('title', 'TORIZU — Katalog Kaos Anime Oversized & Streetwear Jepang')

@section('content')

  <!-- Hero Section (Light & Dark Compatible) -->
  <section class="relative bg-gradient-to-b from-gray-100 to-gray-50 dark:from-[#0d0e14] dark:to-anime-black pt-12 pb-20 border-b border-gray-200 dark:border-anime-cardborder overflow-hidden transition-colors duration-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">

        <!-- Left Copy -->
        <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
          <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-md bg-red-50 dark:bg-anime-card border border-red-200 dark:border-anime-cardborder text-anime-red text-xs font-bold tracking-wider uppercase">
            <span class="w-2 h-2 rounded-full bg-anime-red"></span>
            【公式】DROP KOLEKSI ANIME STREETWEAR 2026
          </div>

          <h1 class="font-display font-black text-4xl sm:text-5xl lg:text-6xl text-gray-900 dark:text-white tracking-tight leading-[1.08] uppercase">
            STYLE ANIME HYPE, <br class="hidden sm:inline">
            <span class="text-anime-red">
              POTONGAN OVERSIZED
            </span>
            PREMIUM.
          </h1>

          <p class="text-sm sm:text-base text-gray-600 dark:text-gray-300 max-w-xl mx-auto lg:mx-0 leading-relaxed font-normal">
            Koleksi kaos anime grafis Monkey D. Luffy, Gojo Satoru, Levi Ackerman, serta hoodie Akatsuki. Dibuat dengan material <strong>Cotton Combed 24s Heavyweight</strong> & sablon <strong>DTF High Definition</strong> tahan cuci. Langsung order cepat via WhatsApp!
          </p>

          <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
            <a href="#katalog-section"
               class="w-full sm:w-auto px-8 py-3.5 rounded-xl bg-anime-red hover:bg-anime-redhover text-white font-extrabold text-xs tracking-wider uppercase shadow-sm transition transform hover:-translate-y-0.5 text-center flex items-center justify-center gap-2">
              <i class="ph-bold ph-flame text-base"></i>
              <span>Lihat Katalog Baju</span>
            </a>
            <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Torizu%2C%20saya%20tertarik%20dengan%20kaos%20anime%20oversized" target="_blank"
               class="w-full sm:w-auto px-6 py-3.5 rounded-xl bg-white dark:bg-anime-card hover:bg-gray-50 dark:hover:bg-anime-cardborder text-gray-800 dark:text-gray-200 font-bold text-xs border border-gray-300 dark:border-anime-cardborder transition text-center flex items-center justify-center gap-2 shadow-xs">
              <i class="ph-fill ph-whatsapp-logo text-emerald-600 dark:text-emerald-400 text-base"></i>
              <span>Konsultasi Ukuran via WA</span>
            </a>
          </div>

          <!-- Trust Badges -->
          <div class="grid grid-cols-3 gap-4 pt-6 border-t border-gray-200 dark:border-anime-cardborder max-w-lg mx-auto lg:mx-0">
            <div>
              <div class="font-display font-black text-2xl text-gray-900 dark:text-white">{{ $totalProducts }}+ Model</div>
              <div class="text-[11px] text-gray-500 dark:text-gray-400 font-medium">Anime Grafis Siap Kirim</div>
            </div>
            <div>
              <div class="font-display font-black text-2xl text-gray-900 dark:text-white">24s Cotton</div>
              <div class="text-[11px] text-gray-500 dark:text-gray-400 font-medium">Heavyweight & Adem</div>
            </div>
            <div>
              <div class="font-display font-black text-2xl text-gray-900 dark:text-white">100% Garansi</div>
              <div class="text-[11px] text-gray-500 dark:text-gray-400 font-medium">Bisa Tukar Size Baju</div>
            </div>
          </div>
        </div>

        <!-- Right Visual Showcase (Luffy Kaos Graphic) -->
        <div class="lg:col-span-5 relative">
          <div class="relative mx-auto max-w-md lg:max-w-none">

            <!-- Card without neon border -->
            <div class="relative rounded-3xl overflow-hidden border border-gray-300 dark:border-anime-cardborder bg-white dark:bg-anime-card shadow-lg group">
              <img
                src="{{ asset('images/produk/luffy-one-piece.jpg') }}"
                alt="Kaos Anime Luffy King of Pirates Oversized"
                class="w-full aspect-square object-cover group-hover:scale-105 transition-transform duration-500"
                onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1521572267360-ee0c2909d518?auto=format&fit=crop&w=800&q=80';"
              >
              <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent"></div>

              <!-- Overlaid badge -->
              <div class="absolute bottom-5 left-5 right-5 p-4 rounded-2xl bg-white/95 dark:bg-[#0c0d13]/90 backdrop-blur-md border border-gray-200 dark:border-anime-cardborder shadow-md flex items-center justify-between">
                <div>
                  <div class="flex items-center gap-1.5 text-[10px] font-black text-anime-red uppercase tracking-wider">
                    <span class="w-1.5 h-1.5 rounded-full bg-anime-red"></span>
                    FEATURED DROP · ONE PIECE
                  </div>
                  <div class="text-sm font-bold text-gray-900 dark:text-white mt-0.5">Kaos Luffy King of Pirates</div>
                  <div class="text-xs font-bold text-gray-900 dark:text-white">Rp 149.000</div>
                </div>
                <a href="#katalog-section" class="px-3.5 py-1.5 rounded-lg bg-anime-red hover:bg-anime-redhover text-white text-xs font-bold transition uppercase">
                  Pesan ↗
                </a>
              </div>
            </div>

            <!-- Floating feature badge -->
            <div class="absolute -top-4 -left-4 bg-white dark:bg-[#12141e] p-3 rounded-2xl shadow-md border border-gray-200 dark:border-anime-cardborder flex items-center gap-3">
              <div class="w-9 h-9 rounded-xl bg-red-50 dark:bg-anime-card text-anime-red flex items-center justify-center font-bold border border-red-100 dark:border-anime-cardborder">
                <i class="ph-bold ph-sketch-logo text-lg"></i>
              </div>
              <div class="text-xs">
                <span class="block font-bold text-gray-900 dark:text-white">Sablon DTF High Definition</span>
                <span class="text-gray-500 dark:text-gray-400 text-[10px]">Warna pekat & tahan cuci mesin</span>
              </div>
            </div>

            <!-- Floating size badge -->
            <div class="absolute -bottom-3 -right-3 bg-white dark:bg-[#12141e] p-3 rounded-2xl shadow-md border border-gray-200 dark:border-anime-cardborder flex items-center gap-2">
              <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
              <span class="text-[11px] font-bold text-gray-900 dark:text-white font-mono">SIZE: M, L, XL, XXL</span>
            </div>

          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- Keunggulan Section -->
  <section class="py-10 bg-white dark:bg-[#07080c] border-b border-gray-200 dark:border-anime-cardborder transition-colors duration-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">

        <div class="p-5 rounded-2xl bg-gray-50 dark:bg-anime-card/50 border border-gray-200 dark:border-anime-cardborder hover:border-anime-red/40 transition">
          <i class="ph-bold ph-shield-check text-3xl text-anime-red mb-2 inline-block"></i>
          <h4 class="font-bold text-xs uppercase tracking-wider text-gray-900 dark:text-white">100% Cotton 24s</h4>
          <p class="text-[11px] text-gray-500 dark:text-gray-400 mt-1">Bahan tebal heavyweight, tidak menerawang & adem</p>
        </div>

        <div class="p-5 rounded-2xl bg-gray-50 dark:bg-anime-card/50 border border-gray-200 dark:border-anime-cardborder hover:border-anime-red/40 transition">
          <i class="ph-bold ph-paint-brush text-3xl text-anime-red mb-2 inline-block"></i>
          <h4 class="font-bold text-xs uppercase tracking-wider text-gray-900 dark:text-white">Sablon DTF Premium</h4>
          <p class="text-[11px] text-gray-500 dark:text-gray-400 mt-1">Warna tajam beresolusi tinggi, lentur dan tahan setrika</p>
        </div>

        <div class="p-5 rounded-2xl bg-gray-50 dark:bg-anime-card/50 border border-gray-200 dark:border-anime-cardborder hover:border-anime-red/40 transition">
          <i class="ph-bold ph-arrows-out-simple text-3xl text-anime-red mb-2 inline-block"></i>
          <h4 class="font-bold text-xs uppercase tracking-wider text-gray-900 dark:text-white">Boxy Oversized Fit</h4>
          <p class="text-[11px] text-gray-500 dark:text-gray-400 mt-1">Potongan streetwear kekinian yang jatuh pas di badan</p>
        </div>

        <div class="p-5 rounded-2xl bg-gray-50 dark:bg-anime-card/50 border border-gray-200 dark:border-anime-cardborder hover:border-emerald-500/40 transition">
          <i class="ph-fill ph-whatsapp-logo text-3xl text-emerald-500 mb-2 inline-block"></i>
          <h4 class="font-bold text-xs uppercase tracking-wider text-gray-900 dark:text-white">Order Mudah via WA</h4>
          <p class="text-[11px] text-gray-500 dark:text-gray-400 mt-1">1-klik langsung pesan tanpa perlu registrasi rumit</p>
        </div>

      </div>
    </div>
  </section>

  <!-- Katalog Baju Section -->
  <section id="katalog-section" class="py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

      <!-- Section Title & Search Header -->
      <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 pb-8 border-b border-gray-200 dark:border-anime-cardborder">
        <div>
          <div class="inline-flex items-center gap-2 text-xs font-bold text-anime-red uppercase tracking-widest mb-1.5">
            <span class="font-jp text-sm">【製品一覧】</span> KATALOG RESMI ANIME MERCH
          </div>
          <h2 class="font-display font-black text-3xl sm:text-4xl text-gray-900 dark:text-white uppercase tracking-tight">
            Koleksi Anime Streetwear
          </h2>
          <p class="text-xs sm:text-sm text-gray-500 dark:text-gray-400 mt-1">Pilih kaos anime, hoodie, atau haori favoritmu. Pesan langsung via WhatsApp!</p>
        </div>

        <!-- Search Bar & Sort Form -->
        <form method="GET" action="{{ route('catalog.index') }}#katalog-section" class="flex flex-wrap items-center gap-3 w-full md:w-auto">
          @if(request('kategori'))
            <input type="hidden" name="kategori" value="{{ request('kategori') }}">
          @endif

          <div class="relative flex-grow sm:flex-grow-0 sm:w-64">
            <input
              type="text"
              name="search"
              value="{{ $search }}"
              placeholder="Cari Luffy, Gojo, AOT..."
              class="w-full pl-10 pr-4 py-2.5 text-xs rounded-xl border border-gray-300 dark:border-anime-cardborder bg-white dark:bg-anime-card text-gray-900 dark:text-white focus:outline-none focus:border-anime-red transition placeholder-gray-400 dark:placeholder-gray-500"
            >
            <i class="ph ph-magnifying-glass absolute left-3.5 top-3 text-gray-400 text-sm"></i>
          </div>

          <div class="relative">
            <select
              name="sort"
              onchange="this.form.submit()"
              class="pl-3.5 pr-8 py-2.5 text-xs rounded-xl border border-gray-300 dark:border-anime-cardborder bg-white dark:bg-anime-card text-gray-800 dark:text-gray-200 focus:outline-none focus:border-anime-red transition cursor-pointer"
            >
              <option value="terbaru" {{ $sort === 'terbaru' ? 'selected' : '' }}>Terbaru</option>
              <option value="harga_rendah" {{ $sort === 'harga_rendah' ? 'selected' : '' }}>Harga: Terendah</option>
              <option value="harga_tinggi" {{ $sort === 'harga_tinggi' ? 'selected' : '' }}>Harga: Tertinggi</option>
              <option value="nama" {{ $sort === 'nama' ? 'selected' : '' }}>Nama (A-Z)</option>
            </select>
          </div>

          <button type="submit" class="px-4 py-2.5 rounded-xl bg-anime-red hover:bg-anime-redhover text-white text-xs font-bold transition">
            Filter
          </button>
        </form>
      </div>

      <!-- Category Navigation Pills -->
      <div class="flex items-center gap-2 overflow-x-auto py-6 no-scrollbar">
        <a
          href="{{ route('catalog.index') }}#katalog-section"
          class="px-5 py-2.5 rounded-xl text-xs font-bold whitespace-nowrap transition uppercase tracking-wider {{ !request('kategori') ? 'bg-anime-red text-white shadow-sm' : 'bg-white dark:bg-anime-card text-gray-700 dark:text-gray-300 hover:text-anime-red border border-gray-300 dark:border-anime-cardborder' }}"
        >
          Semua Koleksi ({{ $totalProducts }})
        </a>

        @foreach($kategoris as $kat)
          <a
            href="{{ route('catalog.index', array_merge(request()->except(['page', 'kategori']), ['kategori' => $kat->slug])) }}#katalog-section"
            class="px-5 py-2.5 rounded-xl text-xs font-bold whitespace-nowrap transition uppercase tracking-wider {{ request('kategori') === $kat->slug ? 'bg-anime-red text-white shadow-sm' : 'bg-white dark:bg-anime-card text-gray-700 dark:text-gray-300 hover:text-anime-red border border-gray-300 dark:border-anime-cardborder' }}"
          >
            {{ $kat->nama }} ({{ $kat->barangs_count }})
          </a>
        @endforeach
      </div>

      <!-- Active Filters Tag -->
      @if($search || request('kategori'))
        <div class="flex items-center gap-2 mb-6 text-xs text-gray-500 dark:text-gray-400">
          <span class="font-semibold text-gray-700 dark:text-gray-300">Filter Aktif:</span>
          @if(request('kategori'))
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-gray-100 dark:bg-anime-card border border-gray-300 dark:border-anime-cardborder text-anime-red font-medium">
              Kategori: {{ $currentKategori?->nama ?? request('kategori') }}
              <a href="{{ route('catalog.index', request()->except('kategori')) }}#katalog-section" class="hover:text-black dark:hover:text-white font-bold">✕</a>
            </span>
          @endif
          @if($search)
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-gray-100 dark:bg-anime-card border border-gray-300 dark:border-gray-700 text-gray-800 dark:text-gray-200 font-medium">
              Pencarian: "{{ $search }}"
              <a href="{{ route('catalog.index', request()->except('search')) }}#katalog-section" class="hover:text-black dark:hover:text-white font-bold">✕</a>
            </span>
          @endif
          <a href="{{ route('catalog.index') }}#katalog-section" class="text-xs text-anime-red hover:underline font-semibold ml-2">Reset Semua</a>
        </div>
      @endif

      <!-- Products Grid -->
      @if($barangs->count() > 0)
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-7">
          @foreach($barangs as $item)
            <div class="group bg-white dark:bg-anime-card rounded-2xl overflow-hidden border border-gray-200 dark:border-anime-cardborder hover:border-gray-400 dark:hover:border-gray-600 shadow-sm hover:shadow-md transition-all duration-300 flex flex-col transform hover:-translate-y-1">

              <!-- Image Frame -->
              <div class="relative aspect-square bg-gray-100 dark:bg-[#0d0e15] overflow-hidden">
                <img
                  src="{{ $item->foto_url }}"
                  alt="{{ $item->nama }}"
                  class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                  loading="lazy"
                  onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1521572267360-ee0c2909d518?auto=format&fit=crop&w=800&q=80';"
                >

                <!-- Category Badge -->
                <div class="absolute top-3 left-3">
                  <span class="px-2.5 py-1 rounded-md text-[10px] font-black uppercase tracking-wider bg-white/90 dark:bg-[#0c0d13]/90 text-anime-red shadow-sm border border-gray-200 dark:border-anime-cardborder">
                    {{ $item->kategori->nama ?? 'Anime' }}
                  </span>
                </div>

                <!-- Stock status pill -->
                <div class="absolute top-3 right-3">
                  @if($item->total_stok > 0)
                    <span class="px-2.5 py-1 rounded-md text-[10px] font-bold bg-emerald-100 dark:bg-emerald-950/90 text-emerald-800 dark:text-emerald-300 border border-emerald-300 dark:border-emerald-500/30 shadow-sm flex items-center gap-1">
                      <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                      Stok: {{ $item->total_stok }}
                    </span>
                  @else
                    <span class="px-2.5 py-1 rounded-md text-[10px] font-bold bg-rose-100 dark:bg-rose-950/90 text-rose-800 dark:text-rose-300 border border-rose-300 dark:border-rose-500/30 shadow-sm">
                      Habis
                    </span>
                  @endif
                </div>
              </div>

              <!-- Content Area -->
              <div class="p-5 flex-1 flex flex-col justify-between space-y-4">
                <div>
                  <h3 class="font-bold text-sm sm:text-base text-gray-900 dark:text-white group-hover:text-anime-red transition-colors line-clamp-1">
                    <a href="{{ route('catalog.show', $item->id) }}">
                      {{ $item->nama }}
                    </a>
                  </h3>

                  <p class="text-xs text-gray-500 dark:text-gray-400 line-clamp-2 mt-1.5 leading-relaxed">
                    {{ $item->deskripsi }}
                  </p>

                  <!-- Variants Preview Badges -->
                  @if($item->varians->count() > 0)
                    <div class="flex flex-wrap gap-1 mt-3">
                      @foreach($item->varians->take(3) as $var)
                        <span class="px-2 py-0.5 rounded text-[10px] font-mono bg-gray-100 dark:bg-anime-black text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-anime-cardborder">
                          {{ $var->warna }} ({{ $var->ukuran }})
                        </span>
                      @endforeach
                      @if($item->varians->count() > 3)
                        <span class="px-1.5 py-0.5 rounded text-[10px] font-mono bg-gray-100 dark:bg-anime-black text-gray-500 border border-gray-200 dark:border-anime-cardborder">
                          +{{ $item->varians->count() - 3 }}
                        </span>
                      @endif
                    </div>
                  @endif
                </div>

                <!-- Price & CTA -->
                <div class="pt-3 border-t border-gray-100 dark:border-anime-cardborder flex items-center justify-between">
                  <div>
                    <span class="text-[10px] font-mono text-gray-400 dark:text-gray-500 uppercase block">Harga</span>
                    <span class="font-display font-black text-lg text-gray-900 dark:text-white">
                      {{ $item->formatted_harga }}
                    </span>
                  </div>

                  <div class="flex items-center gap-1.5">
                    <a
                      href="{{ route('catalog.show', $item->id) }}"
                      class="px-3 py-2 rounded-xl bg-gray-100 hover:bg-gray-200 dark:bg-anime-cardborder dark:hover:bg-gray-700 text-gray-800 dark:text-white font-bold text-xs transition"
                      title="Lihat Detail & Pilih Varian"
                    >
                      Detail
                    </a>

                    <a
                      href="{{ route('catalog.show', $item->id) }}#pesan-wa"
                      class="px-3 py-2 rounded-xl bg-anime-red hover:bg-anime-redhover text-white font-extrabold text-xs transition flex items-center gap-1 shadow-sm"
                      title="Pesan via WhatsApp"
                    >
                      <i class="ph-fill ph-whatsapp-logo text-sm"></i>
                      <span>Order</span>
                    </a>
                  </div>
                </div>

              </div>

            </div>
          @endforeach
        </div>

        <!-- Pagination -->
        @if($barangs->hasPages())
          <div class="mt-12 flex justify-center">
            <div class="p-2 bg-white dark:bg-anime-card rounded-xl border border-gray-200 dark:border-anime-cardborder text-gray-800 dark:text-white text-xs shadow-xs">
              {{ $barangs->links() }}
            </div>
          </div>
        @endif

      @else
        <!-- Empty State -->
        <div class="text-center py-16 bg-white dark:bg-anime-card rounded-3xl border border-gray-200 dark:border-anime-cardborder p-8 shadow-xs">
          <i class="ph-bold ph-ghost text-5xl text-anime-red mb-3 inline-block"></i>
          <h3 class="font-display font-bold text-xl text-gray-900 dark:text-white">Produk Tidak Ditemukan</h3>
          <p class="text-xs text-gray-500 dark:text-gray-400 max-w-md mx-auto mt-1">
            Belum ada koleksi anime yang sesuai dengan filter atau kata kunci pencarian Anda.
          </p>
          <a href="{{ route('catalog.index') }}#katalog-section" class="mt-4 inline-block px-5 py-2.5 rounded-xl bg-anime-red text-white text-xs font-bold uppercase tracking-wider">
            Lihat Semua Koleksi Anime
          </a>
        </div>
      @endif

    </div>
  </section>

  <!-- CTA Banner Anime Fanbase -->
  <section class="py-12 bg-gray-100 dark:bg-[#0e0f17] border-t border-gray-200 dark:border-anime-cardborder transition-colors duration-200">
    <div class="max-w-5xl mx-auto px-4 text-center space-y-4">
      <span class="text-xs font-mono font-bold text-anime-red uppercase tracking-widest">
        【TORIZU VIP COMMUNITY】
      </span>
      <h3 class="font-display font-black text-2xl sm:text-3xl text-gray-900 dark:text-white uppercase">
        CARI KARAKTER ANIME LAIN ATAU MAU REQUEST KAOS KHUSUS?
      </h3>
      <p class="text-xs sm:text-sm text-gray-600 dark:text-gray-400 max-w-xl mx-auto">
        Bisa tanyakan langsung ke admin kami via WhatsApp! Kami siap bantu cek ketersediaan ukuran dan katalog anime terbaru.
      </p>
      <div class="pt-2">
        <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Torizu%2C%20saya%20mau%20request%20kaos%20anime%20favorit%20saya" target="_blank"
           class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-extrabold text-xs uppercase tracking-wider transition shadow-sm">
          <i class="ph-fill ph-whatsapp-logo text-lg"></i>
          <span>Hubungi Admin WhatsApp Sekarang</span>
        </a>
      </div>
    </div>
  </section>

@endsection

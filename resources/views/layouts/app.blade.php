<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'TORIZU — Anime Streetwear & Japanese Apparel')</title>
  <meta name="description" content="Torizu Official Anime Streetwear — Katalog kaos anime oversized, hoodie Akatsuki, haori kimono dan celana techwear berkualitas premium dengan sablon DTF HD dan bahan Cotton 24s.">

  <!-- Favicon -->
  <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

  <!-- Immediate Theme Initializer to prevent Flash of Unstyled Content -->
  <script>
    if (localStorage.getItem('theme') === 'light') {
      document.documentElement.classList.remove('dark');
    } else {
      document.documentElement.classList.add('dark');
    }
  </script>

  <!-- Google Fonts: Plus Jakarta Sans, Archivo & Japanese Noto Sans JP -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Archivo:wdth,wght@62..125,100..900&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Noto+Sans+JP:wght@400;700;900&display=swap" rel="stylesheet">

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      darkMode: 'class',
      theme: {
        extend: {
          fontFamily: {
            sans: ['"Plus Jakarta Sans"', 'sans-serif'],
            display: ['"Archivo"', 'sans-serif'],
            jp: ['"Noto Sans JP"', 'sans-serif'],
          },
          colors: {
            anime: {
              black: '#0a0b10',
              card: '#12141f',
              cardborder: '#1e2235',
              red: '#ff2a5f',
              redhover: '#e01e50',
              cyan: '#00f0ff',
              gold: '#ffb703',
              purple: '#9d4edd',
            }
          }
        }
      }
    }
  </script>

  <!-- Phosphor Icons CDN -->
  <script src="https://unpkg.com/@phosphor-icons/web"></script>

  <style>
    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
    }
  </style>
  @stack('styles')
</head>
<body class="bg-gray-50 dark:bg-[#0b0c11] text-gray-900 dark:text-gray-100 antialiased min-h-screen flex flex-col selection:bg-anime-red selection:text-white transition-colors duration-200">

  <!-- Top Announcement Bar -->
  <div class="bg-gray-900 dark:bg-[#12141c] text-gray-200 dark:text-gray-300 text-xs py-2 px-4 text-center font-semibold tracking-wider border-b border-gray-800 dark:border-anime-cardborder flex items-center justify-center gap-2">
    <span class="inline-block px-1.5 py-0.5 rounded bg-anime-red text-white text-[10px] font-bold tracking-wider font-mono">NEW DROP</span>
    <span>Koleksi Anime Kaos Oversized One Piece, JJK & AOT Ready Stock</span>
    <span class="text-gray-600 dark:text-gray-500 hidden sm:inline">|</span>
    <a href="https://wa.me/6281234567890?text=Halo%20Torizu%20Anime%20Store%2C%20saya%20mau%20tanya%20kaos%20anime%20ready%20stock" target="_blank" class="text-anime-red hover:underline transition font-bold">
      Chat Admin WA ↗
    </a>
  </div>

  <!-- Header / Navigation -->
  <header class="sticky top-0 z-40 bg-white/95 dark:bg-[#0b0c11]/95 backdrop-blur-md border-b border-gray-200 dark:border-anime-cardborder transition-colors duration-200 shadow-xs">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-20">

        <!-- Logo -->
        <a href="{{ route('catalog.index') }}" class="flex items-center gap-3 group">
          <div class="w-10 h-10 rounded-xl bg-anime-red text-white flex items-center justify-center shadow-sm group-hover:bg-anime-redhover transition-colors">
            <span class="font-jp font-black text-lg">鳥</span>
          </div>
          <div>
            <div class="flex items-center gap-1.5">
              <span class="font-display font-black text-2xl tracking-wider text-gray-900 dark:text-white uppercase group-hover:text-anime-red transition-colors">
                TORIZU
              </span>
              <span class="text-[10px] font-bold px-1.5 py-0.5 rounded bg-anime-red text-white uppercase">ANIME</span>
            </div>
            <span class="block text-[10px] tracking-widest uppercase font-mono text-gray-500 dark:text-gray-400 -mt-1 font-semibold">
              鳥図 · STREETWEAR APPAREL
            </span>
          </div>
        </a>

        <!-- Desktop Navigation Links -->
        <nav class="hidden md:flex items-center gap-7 text-xs font-bold uppercase tracking-wider text-gray-700 dark:text-gray-300">
          <a href="{{ route('catalog.index') }}" class="hover:text-anime-red transition-colors {{ request()->routeIs('catalog.index') && !request('kategori') ? 'text-anime-red font-black border-b-2 border-anime-red pb-1' : '' }}">
            Semua Produk
          </a>
          @php
            $navKategoris = \App\Models\Kategori::orderBy('nama', 'asc')->take(4)->get();
          @endphp
          @foreach($navKategoris as $navKat)
            <a href="{{ route('catalog.index', ['kategori' => $navKat->slug]) }}#katalog-section"
               class="hover:text-anime-red transition-colors {{ request('kategori') === $navKat->slug ? 'text-anime-red font-black border-b-2 border-anime-red pb-1' : '' }}">
              {{ $navKat->nama }}
            </a>
          @endforeach
        </nav>

        <!-- Right Action Button & Dark/Light Toggle -->
        <div class="flex items-center gap-3">
          <!-- Theme Toggle Button -->
          <button id="themeToggleBtn" type="button"
                  class="p-2.5 rounded-xl border border-gray-200 dark:border-anime-cardborder bg-gray-100 dark:bg-anime-card text-gray-700 dark:text-gray-300 hover:text-anime-red dark:hover:text-anime-red transition-colors"
                  title="Ganti Mode Gelap / Terang">
            <i class="ph-bold ph-sun text-lg hidden dark:inline-block text-amber-400"></i>
            <i class="ph-bold ph-moon text-lg inline-block dark:hidden text-gray-700"></i>
          </button>

          <a href="https://wa.me/6281234567890?text=Halo%20Admin%20Torizu%2C%20saya%20mau%20konsultasi%20ukuran%20kaos%20anime" target="_blank"
             class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs tracking-wide transition shadow-sm">
            <i class="ph-fill ph-whatsapp-logo text-base"></i>
            <span>Chat Admin WA</span>
          </a>
        </div>

      </div>
    </div>
  </header>

  <!-- Main Content -->
  <main class="flex-grow">
    @yield('content')
  </main>

  <!-- Anime Streetwear Footer -->
  <footer class="bg-gray-900 dark:bg-[#07080c] border-t border-gray-800 dark:border-anime-cardborder pt-16 pb-12 text-gray-400 text-xs transition-colors duration-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-10 pb-12 border-b border-gray-800 dark:border-anime-cardborder">

        <!-- Col 1: Brand Info -->
        <div class="space-y-4 md:col-span-1">
          <div class="flex items-center gap-2">
            <div class="w-8 h-8 rounded-lg bg-anime-red text-white flex items-center justify-center font-jp font-black text-sm">
              鳥
            </div>
            <span class="font-display font-black text-lg text-white tracking-wider">TORIZU APPAREL</span>
          </div>
          <p class="text-xs text-gray-400 leading-relaxed">
            Brand busana anime streetwear Indonesia terinspirasi dari shonen manga, dark fantasy, dan kultur street fashion Harajuku Jepang.
          </p>
          <div class="flex items-center gap-2 text-gray-300">
            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
            <span class="text-[11px] font-semibold">Admin WhatsApp Online (08:00 - 22:00 WIB)</span>
          </div>
        </div>

        <!-- Col 2: Kategori -->
        <div class="space-y-3">
          <h4 class="font-display font-bold text-white text-xs uppercase tracking-wider text-anime-red">Koleksi Anime</h4>
          <ul class="space-y-2 text-xs">
            <li><a href="{{ route('catalog.index', ['kategori' => 'kaos-oversized']) }}#katalog-section" class="hover:text-white transition">Kaos Anime Oversized</a></li>
            <li><a href="{{ route('catalog.index', ['kategori' => 'hoodie-crewneck']) }}#katalog-section" class="hover:text-white transition">Hoodie & Crewneck</a></li>
            <li><a href="{{ route('catalog.index', ['kategori' => 'haori-jaket']) }}#katalog-section" class="hover:text-white transition">Haori Kimono Modern</a></li>
            <li><a href="{{ route('catalog.index', ['kategori' => 'celana-techwear']) }}#katalog-section" class="hover:text-white transition">Celana Techwear Cargo</a></li>
          </ul>
        </div>

        <!-- Col 3: Jaminan Mutu -->
        <div class="space-y-3">
          <h4 class="font-display font-bold text-white text-xs uppercase tracking-wider text-anime-cyan">Spesifikasi Bahan</h4>
          <ul class="space-y-2 text-xs text-gray-400">
            <li class="flex items-center gap-1.5"><i class="ph-bold ph-check text-anime-cyan"></i> 100% Cotton Combed 24s Heavyweight</li>
            <li class="flex items-center gap-1.5"><i class="ph-bold ph-check text-anime-cyan"></i> Sablon DTF High Definition Tahan Cuci</li>
            <li class="flex items-center gap-1.5"><i class="ph-bold ph-check text-anime-cyan"></i> Jahitan Rantai Standar Streetwear Hype</li>
            <li class="flex items-center gap-1.5"><i class="ph-bold ph-check text-anime-cyan"></i> Garansi Tukar Ukuran 100% Aman</li>
          </ul>
        </div>

        <!-- Col 4: Layanan Pemesanan -->
        <div class="space-y-3">
          <h4 class="font-display font-bold text-white text-xs uppercase tracking-wider text-anime-gold">Pemesanan WhatsApp</h4>
          <p class="text-xs text-gray-400">
            Pilih varian baju favorit Anda, lengkapi data pemesan, dan sistem kami langsung membuatkan format pesanan ke WhatsApp resmi.
          </p>
          <a href="https://wa.me/6281234567890" target="_blank"
             class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs transition shadow-sm">
            <i class="ph-fill ph-whatsapp-logo text-base"></i>
            <span>+62 812-3456-7890</span>
          </a>
        </div>

      </div>

      <div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-[11px] text-gray-500">
        <div>
          © 2026 TORIZU Official Anime Apparel. All rights reserved.
        </div>
        <div class="flex items-center gap-4">
          <a href="{{ route('catalog.index') }}" class="hover:text-gray-300">Katalog Utama</a>
        </div>
      </div>
    </div>
  </footer>

  <!-- Theme Toggle Script -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const toggleBtn = document.getElementById('themeToggleBtn');
      if (toggleBtn) {
        toggleBtn.addEventListener('click', function () {
          const isDark = document.documentElement.classList.toggle('dark');
          localStorage.setItem('theme', isDark ? 'dark' : 'light');
        });
      }
    });
  </script>

  @stack('scripts')
</body>
</html>

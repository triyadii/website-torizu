<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Admin Dashboard') — TORIZU Anime Apparel</title>

  <!-- Immediate Theme Initializer to prevent Flash of Unstyled Content -->
  <script>
    if (localStorage.getItem('theme') === 'light') {
      document.documentElement.classList.remove('dark');
    } else {
      document.documentElement.classList.add('dark');
    }
  </script>

  <!-- Google Fonts: Plus Jakarta Sans, Archivo & Noto Sans JP -->
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
            },
            brand: {
              50: '#fff1f4',
              500: '#ff2a5f',
              600: '#e01e50',
              dark: '#0c0d14',
            }
          }
        }
      }
    }
  </script>

  <!-- Phosphor Icons CDN -->
  <script src="https://unpkg.com/@phosphor-icons/web"></script>

  <style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; }
  </style>
  @stack('styles')
</head>
<body class="bg-[#f8f9fa] dark:bg-anime-black text-gray-800 dark:text-gray-100 antialiased min-h-screen flex transition-colors duration-200">

  <!-- Sidebar -->
  <aside class="w-64 bg-white dark:bg-[#0c0d14] text-gray-600 dark:text-gray-300 flex flex-col shrink-0 min-h-screen border-r border-gray-200 dark:border-[#1e2235] hidden md:flex transition-colors duration-200">
    <!-- Brand -->
    <div class="h-20 flex items-center gap-3 px-6 border-b border-gray-200 dark:border-[#1e2235]">
      <div class="w-9 h-9 rounded-xl bg-anime-red text-white flex items-center justify-center font-bold shadow-md shadow-anime-red/20">
        <i class="ph-bold ph-sketch-logo text-xl"></i>
      </div>
      <div>
        <div class="flex items-center gap-1.5">
          <span class="font-display font-black text-gray-900 dark:text-white text-base tracking-wider block">TORIZU</span>
          <span class="font-jp text-[10px] text-anime-red font-bold">鳥図</span>
        </div>
        <span class="text-[10px] text-gray-400 dark:text-gray-400 uppercase tracking-widest font-semibold block">Anime Studio Admin</span>
      </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-grow p-4 space-y-1.5 text-xs font-semibold">
      <div class="px-3 py-2 text-[10px] uppercase tracking-wider text-gray-400 font-bold">Ringkasan</div>

      <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.dashboard') ? 'bg-anime-red text-white font-bold shadow-sm' : 'hover:bg-gray-100 dark:hover:bg-[#161826] hover:text-gray-900 dark:hover:text-white text-gray-600 dark:text-gray-300' }}">
        <i class="ph-bold ph-squares-four text-base"></i>
        <span>Dashboard</span>
      </a>

      <div class="pt-4 px-3 py-2 text-[10px] uppercase tracking-wider text-gray-400 font-bold">Katalog Produk</div>

      <a href="{{ route('admin.kategori.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.kategori.*') ? 'bg-anime-red text-white font-bold shadow-sm' : 'hover:bg-gray-100 dark:hover:bg-[#161826] hover:text-gray-900 dark:hover:text-white text-gray-600 dark:text-gray-300' }}">
        <i class="ph-bold ph-tag text-base"></i>
        <span>Manajemen Kategori</span>
      </a>

      <a href="{{ route('admin.barang.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.barang.*') ? 'bg-anime-red text-white font-bold shadow-sm' : 'hover:bg-gray-100 dark:hover:bg-[#161826] hover:text-gray-900 dark:hover:text-white text-gray-600 dark:text-gray-300' }}">
        <i class="ph-bold ph-hanger text-base"></i>
        <span>Manajemen Barang</span>
      </a>

      <div class="pt-4 px-3 py-2 text-[10px] uppercase tracking-wider text-gray-400 font-bold">Pelanggan & Leads</div>

      @php
        $pendingLeadsCount = \App\Models\Lead::where('status', 'klik_wa')->count();
      @endphp
      <a href="{{ route('admin.leads.index') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.leads.*') ? 'bg-anime-red text-white font-bold shadow-sm' : 'hover:bg-gray-100 dark:hover:bg-[#161826] hover:text-gray-900 dark:hover:text-white text-gray-600 dark:text-gray-300' }}">
        <div class="flex items-center gap-3">
          <i class="ph-bold ph-whatsapp-logo text-base text-emerald-500"></i>
          <span>Data Leads WhatsApp</span>
        </div>
        @if($pendingLeadsCount > 0)
          <span class="px-2 py-0.5 rounded-full text-[10px] {{ request()->routeIs('admin.leads.*') ? 'bg-white text-anime-red' : 'bg-amber-400 text-gray-900' }} font-bold">
            {{ $pendingLeadsCount }}
          </span>
        @endif
      </a>

      @if(auth()->user() && auth()->user()->isSuperadmin())
        <div class="pt-4 px-3 py-2 text-[10px] uppercase tracking-wider text-gray-400 font-bold">Pengaturan</div>
        <a href="{{ route('admin.users.index') }}" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl transition {{ request()->routeIs('admin.users.*') ? 'bg-anime-red text-white font-bold shadow-sm' : 'hover:bg-gray-100 dark:hover:bg-[#161826] hover:text-gray-900 dark:hover:text-white text-gray-600 dark:text-gray-300' }}">
          <i class="ph-bold ph-users text-base"></i>
          <span>Kelola Admin & Staf</span>
        </a>
      @endif

      <div class="pt-6 border-t border-gray-200 dark:border-[#1e2235] mt-6">
        <a href="{{ route('catalog.index') }}" target="_blank" class="flex items-center gap-3 px-3.5 py-2.5 rounded-xl hover:bg-gray-100 dark:hover:bg-[#161826] text-gray-500 dark:text-gray-400 hover:text-anime-red transition">
          <i class="ph-bold ph-arrow-square-out text-base"></i>
          <span>Buka Toko / Katalog ↗</span>
        </a>
      </div>
    </nav>

    <!-- Admin User Badge -->
    <div class="p-4 border-t border-gray-200 dark:border-[#1e2235] bg-gray-50/60 dark:bg-black/30">
      <div class="flex items-center justify-between">
        <div class="flex items-center gap-3 min-w-0">
          <div class="w-8 h-8 rounded-full bg-anime-red text-white flex items-center justify-center font-bold text-xs uppercase shadow-sm">
            {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
          </div>
          <div class="truncate">
            <span class="block text-xs font-bold text-gray-900 dark:text-white truncate">{{ auth()->user()->name ?? 'Administrator' }}</span>
            <span class="block text-[10px] text-gray-500 dark:text-gray-400 uppercase tracking-wider">{{ auth()->user()->role ?? 'admin' }}</span>
          </div>
        </div>

        <form action="{{ route('admin.logout') }}" method="POST">
          @csrf
          <button type="submit" class="p-2 text-gray-400 hover:text-rose-500 transition" title="Logout">
            <i class="ph-bold ph-sign-out text-lg"></i>
          </button>
        </form>
      </div>
    </div>
  </aside>

  <!-- Main Container -->
  <div class="flex-grow flex flex-col min-w-0 overflow-y-auto">

    <!-- Top Header -->
    <header class="h-20 bg-white dark:bg-[#0c0d14] border-b border-gray-200 dark:border-[#1e2235] px-6 sm:px-8 flex items-center justify-between sticky top-0 z-30 shadow-sm transition-colors duration-200">
      <div class="flex items-center gap-4">
        <!-- Mobile Menu Toggle Button -->
        <button type="button" onclick="document.querySelector('aside').classList.toggle('hidden'); document.querySelector('aside').classList.toggle('fixed'); document.querySelector('aside').classList.toggle('z-50');" class="md:hidden p-2 rounded-lg bg-gray-100 dark:bg-[#161826] text-gray-700 dark:text-gray-200">
          <i class="ph-bold ph-list text-xl"></i>
        </button>

        <div>
          <h1 class="text-lg font-bold text-gray-900 dark:text-white">@yield('header_title', 'Dashboard')</h1>
          <span class="text-xs text-gray-500 dark:text-gray-400">{{ date('l, d F Y') }}</span>
        </div>
      </div>

      <div class="flex items-center gap-3">
        <!-- Dark / Light Theme Toggle Button -->
        <button
          id="themeToggleBtn"
          type="button"
          class="p-2.5 rounded-xl border border-gray-200 dark:border-[#1e2235] bg-gray-50 dark:bg-[#12141f] text-gray-600 dark:text-gray-300 hover:text-anime-red dark:hover:text-anime-red hover:bg-gray-100 dark:hover:bg-[#161826] transition shadow-sm"
          title="Ganti Mode Gelap / Terang"
        >
          <i id="themeToggleDarkIcon" class="ph-bold ph-moon text-lg hidden"></i>
          <i id="themeToggleLightIcon" class="ph-bold ph-sun text-lg hidden text-amber-400"></i>
        </button>

        <a href="{{ route('catalog.index') }}" target="_blank" class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl border border-gray-200 dark:border-[#1e2235] text-xs font-bold text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-[#161826] hover:text-anime-red transition">
          <i class="ph-bold ph-storefront"></i>
          <span>Katalog Publik ↗</span>
        </a>

        <div class="h-8 w-px bg-gray-200 dark:bg-[#1e2235] hidden sm:block"></div>

        <!-- User Profile Dropdown -->
        <div class="relative" id="profileDropdownContainer">
          <button
            id="profileDropdownBtn"
            type="button"
            class="flex items-center gap-2.5 pl-2 pr-3 py-1.5 rounded-2xl border border-gray-200 dark:border-[#1e2235] bg-gray-50 dark:bg-[#12141f] hover:bg-gray-100 dark:hover:bg-[#181a28] transition-all shadow-xs group"
          >
            <!-- Avatar -->
            <div class="relative">
              <div class="w-8 h-8 rounded-xl bg-gradient-to-tr from-anime-red to-rose-400 text-white flex items-center justify-center font-display font-black text-xs shadow-xs uppercase">
                {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
              </div>
              <span class="absolute -bottom-0.5 -right-0.5 w-2.5 h-2.5 rounded-full bg-emerald-500 border-2 border-white dark:border-[#12141f]"></span>
            </div>

            <!-- Name & Role -->
            <div class="text-left hidden sm:block">
              <div class="flex items-center gap-1.5">
                <span class="text-xs font-bold text-gray-900 dark:text-white group-hover:text-anime-red transition-colors truncate max-w-[120px]">
                  {{ auth()->user()->name ?? 'Admin' }}
                </span>
                <span class="px-1.5 py-0.5 rounded text-[9px] font-black uppercase tracking-wider {{ (auth()->user()->role ?? '') === 'superadmin' ? 'bg-purple-100 dark:bg-purple-950/60 text-purple-700 dark:text-purple-300 border border-purple-200 dark:border-purple-800' : 'bg-blue-100 dark:bg-blue-950/60 text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-800' }}">
                  {{ auth()->user()->role ?? 'admin' }}
                </span>
              </div>
              <span class="block text-[10px] text-gray-400 font-mono -mt-0.5">{{ '@' . (auth()->user()->username ?? 'admin') }}</span>
            </div>

            <i class="ph-bold ph-caret-down text-xs text-gray-400 group-hover:text-anime-red transition-transform duration-200" id="profileDropdownCaret"></i>
          </button>

          <!-- Dropdown Menu Box -->
          <div
            id="profileDropdownMenu"
            class="hidden absolute right-0 mt-2 w-72 rounded-2xl bg-white dark:bg-[#12141f] border border-gray-200 dark:border-[#1e2235] shadow-xl z-50 overflow-hidden transform transition-all duration-150 origin-top-right divide-y divide-gray-100 dark:divide-[#1e2235]"
          >
            <!-- User Header Card -->
            <div class="p-4 bg-gray-50/70 dark:bg-black/20 flex items-center gap-3">
              <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-anime-red to-rose-400 text-white flex items-center justify-center font-display font-black text-sm shadow-md uppercase">
                {{ substr(auth()->user()->name ?? 'A', 0, 1) }}
              </div>
              <div class="truncate">
                <span class="block font-bold text-xs text-gray-900 dark:text-white truncate">{{ auth()->user()->name ?? 'Administrator' }}</span>
                <span class="block text-[11px] text-gray-400 truncate">{{ auth()->user()->email ?? 'admin@fashionbaju.com' }}</span>
                <span class="inline-block mt-1 px-2 py-0.5 rounded-full text-[9px] font-black uppercase tracking-wider {{ (auth()->user()->role ?? '') === 'superadmin' ? 'bg-purple-100 dark:bg-purple-950/80 text-purple-700 dark:text-purple-300' : 'bg-blue-100 dark:bg-blue-950/80 text-blue-700 dark:text-blue-300' }}">
                  Role: {{ auth()->user()->role ?? 'admin' }}
                </span>
              </div>
            </div>

            <!-- Menu Links -->
            <div class="p-2 space-y-1 text-xs font-semibold text-gray-700 dark:text-gray-300">
              <a href="{{ route('catalog.index') }}" target="_blank" class="flex items-center gap-2.5 px-3 py-2 rounded-xl hover:bg-gray-100 dark:hover:bg-[#181a28] hover:text-anime-red transition">
                <i class="ph-bold ph-storefront text-base text-gray-400"></i>
                <span class="flex-grow">Katalog Publik Toko</span>
                <i class="ph-bold ph-arrow-up-right text-xs text-gray-400"></i>
              </a>

              <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-xl hover:bg-gray-100 dark:hover:bg-[#181a28] hover:text-anime-red transition">
                <i class="ph-bold ph-squares-four text-base text-gray-400"></i>
                <span>Dashboard Overview</span>
              </a>

              @if(auth()->user() && auth()->user()->isSuperadmin())
                <a href="{{ route('admin.users.index') }}" class="flex items-center gap-2.5 px-3 py-2 rounded-xl hover:bg-gray-100 dark:hover:bg-[#181a28] hover:text-anime-red transition">
                  <i class="ph-bold ph-users text-base text-gray-400"></i>
                  <span>Kelola Akun Admin & Staf</span>
                </a>
              @endif
            </div>

            <!-- Logout -->
            <div class="p-2 bg-gray-50/50 dark:bg-black/20">
              <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button
                  type="submit"
                  class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl text-rose-600 dark:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-950/40 text-xs font-bold transition"
                >
                  <i class="ph-bold ph-sign-out text-base"></i>
                  <span>Keluar dari Akun (Logout)</span>
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Body Content Area -->
    <main class="flex-grow p-6 sm:p-8 max-w-7xl w-full mx-auto space-y-6">

      <!-- Flash Notifications -->
      @if(session('success'))
        <div class="p-4 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-300 text-xs font-medium flex items-center justify-between shadow-sm">
          <div class="flex items-center gap-2">
            <i class="ph-fill ph-check-circle text-lg text-emerald-600 dark:text-emerald-400"></i>
            <span>{{ session('success') }}</span>
          </div>
          <button type="button" onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-700 dark:hover:text-emerald-300 font-bold">✕</button>
        </div>
      @endif

      @if(session('error'))
        <div class="p-4 rounded-xl bg-rose-50 dark:bg-rose-950/40 border border-rose-200 dark:border-rose-800 text-rose-800 dark:text-rose-300 text-xs font-medium flex items-center justify-between shadow-sm">
          <div class="flex items-center gap-2">
            <i class="ph-fill ph-warning-circle text-lg text-rose-600 dark:text-rose-400"></i>
            <span>{{ session('error') }}</span>
          </div>
          <button type="button" onclick="this.parentElement.remove()" class="text-rose-500 hover:text-rose-700 dark:hover:text-rose-300 font-bold">✕</button>
        </div>
      @endif

      @if(session('info'))
        <div class="p-4 rounded-xl bg-blue-50 dark:bg-blue-950/40 border border-blue-200 dark:border-blue-800 text-blue-800 dark:text-blue-300 text-xs font-medium flex items-center justify-between shadow-sm">
          <div class="flex items-center gap-2">
            <i class="ph-fill ph-info text-lg text-blue-600 dark:text-blue-400"></i>
            <span>{{ session('info') }}</span>
          </div>
          <button type="button" onclick="this.parentElement.remove()" class="text-blue-500 hover:text-blue-700 dark:hover:text-blue-300 font-bold">✕</button>
        </div>
      @endif

      @yield('content')

    </main>

    <!-- Admin Footer -->
    <footer class="p-6 text-center text-xs text-gray-500 dark:text-gray-400 border-t border-gray-200 dark:border-[#1e2235] bg-white dark:bg-[#0c0d14] transition-colors duration-200">
      TORIZU Anime Streetwear Management Portal &copy; {{ date('Y') }} — Sistem Katalog, Varian Busana & Leads WhatsApp.
    </footer>

  </div>

  <!-- Theme Toggle & Profile Dropdown & Modal Helpers Script -->
  <script>
    (function() {
      const themeToggleBtn = document.getElementById('themeToggleBtn');
      const darkIcon = document.getElementById('themeToggleDarkIcon');
      const lightIcon = document.getElementById('themeToggleLightIcon');

      function updateIcons() {
        if (document.documentElement.classList.contains('dark')) {
          darkIcon.classList.add('hidden');
          lightIcon.classList.remove('hidden');
        } else {
          lightIcon.classList.add('hidden');
          darkIcon.classList.remove('hidden');
        }
      }

      updateIcons();

      if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', function () {
          const isDark = document.documentElement.classList.toggle('dark');
          localStorage.setItem('theme', isDark ? 'dark' : 'light');
          updateIcons();
        });
      }

      // Profile Dropdown Toggle
      const profileBtn = document.getElementById('profileDropdownBtn');
      const profileMenu = document.getElementById('profileDropdownMenu');
      const profileCaret = document.getElementById('profileDropdownCaret');

      if (profileBtn && profileMenu) {
        profileBtn.addEventListener('click', function (e) {
          e.stopPropagation();
          const isHidden = profileMenu.classList.toggle('hidden');
          if (profileCaret) {
            profileCaret.style.transform = isHidden ? 'rotate(0deg)' : 'rotate(180deg)';
          }
        });

        document.addEventListener('click', function (e) {
          if (!profileMenu.contains(e.target) && !profileBtn.contains(e.target)) {
            profileMenu.classList.add('hidden');
            if (profileCaret) profileCaret.style.transform = 'rotate(0deg)';
          }
        });

        document.addEventListener('keydown', function (e) {
          if (e.key === 'Escape') {
            profileMenu.classList.add('hidden');
            if (profileCaret) profileCaret.style.transform = 'rotate(0deg)';
          }
        });
      }
    })();

    // Universal Modal Helper Functions
    function openModal(modalId) {
      const modal = document.getElementById(modalId);
      if (modal) {
        modal.classList.remove('hidden');
        document.body.classList.add('overflow-hidden');
      }
    }

    function closeModal(modalId) {
      const modal = document.getElementById(modalId);
      if (modal) {
        modal.classList.add('hidden');
        document.body.classList.remove('overflow-hidden');
      }
    }

    // Close modal on Escape key
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        const openModals = document.querySelectorAll('.modal-overlay:not(.hidden)');
        openModals.forEach(modal => {
          modal.classList.add('hidden');
        });
        document.body.classList.remove('overflow-hidden');
      }
    });
  </script>

  @stack('scripts')
</body>
</html>

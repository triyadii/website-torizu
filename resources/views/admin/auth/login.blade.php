<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Admin & Staf — TORIZU Anime Apparel</title>

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
            }
          }
        }
      }
    }
  </script>

  <!-- Phosphor Icons -->
  <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>
<body class="bg-[#f8f9fa] dark:bg-anime-black antialiased min-h-screen flex items-center justify-center p-4 transition-colors duration-200 relative">

  <!-- Theme Toggle Button Top Right -->
  <div class="absolute top-6 right-6">
    <button
      id="themeToggleBtn"
      type="button"
      class="p-2.5 rounded-xl border border-gray-200 dark:border-[#1e2235] bg-white dark:bg-[#12141f] text-gray-600 dark:text-gray-300 hover:text-anime-red dark:hover:text-anime-red shadow-sm transition"
      title="Ganti Mode Gelap / Terang"
    >
      <i id="themeToggleDarkIcon" class="ph-bold ph-moon text-lg hidden"></i>
      <i id="themeToggleLightIcon" class="ph-bold ph-sun text-lg hidden text-amber-400"></i>
    </button>
  </div>

  <div class="max-w-md w-full">

    <!-- Brand Header -->
    <div class="text-center mb-8">
      <div class="w-14 h-14 rounded-2xl bg-anime-red text-white flex items-center justify-center mx-auto mb-3 shadow-lg shadow-anime-red/20">
        <i class="ph-bold ph-sketch-logo text-3xl"></i>
      </div>
      <div class="flex items-center justify-center gap-2">
        <h1 class="font-display font-black text-3xl text-gray-900 dark:text-white tracking-wider">TORIZU</h1>
        <span class="font-jp text-sm text-anime-red font-bold">鳥図</span>
      </div>
      <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 uppercase tracking-widest font-semibold">Studio Management Portal</p>
    </div>

    <!-- Login Card -->
    <div class="bg-white dark:bg-anime-card rounded-3xl p-8 border border-gray-200/80 dark:border-anime-cardborder shadow-xl transition-colors duration-200">

      <h2 class="font-bold text-lg text-gray-900 dark:text-white mb-1">Masuk ke Dashboard</h2>
      <p class="text-xs text-gray-500 dark:text-gray-400 mb-6">Gunakan akun admin atau staf Anda untuk mengakses manajemen toko.</p>

      @if(session('error'))
        <div class="p-3 mb-4 text-xs text-rose-800 dark:text-rose-300 rounded-xl bg-rose-50 dark:bg-rose-950/40 border border-rose-200 dark:border-rose-800">
          {{ session('error') }}
        </div>
      @endif

      @if(session('info'))
        <div class="p-3 mb-4 text-xs text-blue-800 dark:text-blue-300 rounded-xl bg-blue-50 dark:bg-blue-950/40 border border-blue-200 dark:border-blue-800">
          {{ session('info') }}
        </div>
      @endif

      @if($errors->any())
        <div class="p-3 mb-4 text-xs text-rose-800 dark:text-rose-300 rounded-xl bg-rose-50 dark:bg-rose-950/40 border border-rose-200 dark:border-rose-800">
          {{ $errors->first() }}
        </div>
      @endif

      <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
        @csrf

        <!-- Username or Email -->
        <div>
          <label for="login" class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
            Email atau Username
          </label>
          <div class="relative">
            <input
              type="text"
              name="login"
              id="login"
              value="{{ old('login') }}"
              required
              autofocus
              placeholder="admin / admin@fashionbaju.com"
              class="w-full pl-10 pr-4 py-2.5 text-xs rounded-xl border border-gray-200 dark:border-anime-cardborder bg-gray-50 dark:bg-anime-black text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-anime-red/20 focus:border-anime-red transition shadow-sm placeholder-gray-400 dark:placeholder-gray-500"
            >
            <i class="ph-bold ph-user absolute left-3.5 top-3 text-gray-400 text-sm"></i>
          </div>
        </div>

        <!-- Password -->
        <div>
          <label for="password" class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
            Password
          </label>
          <div class="relative">
            <input
              type="password"
              name="password"
              id="password"
              required
              placeholder="••••••••"
              class="w-full pl-10 pr-4 py-2.5 text-xs rounded-xl border border-gray-200 dark:border-anime-cardborder bg-gray-50 dark:bg-anime-black text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-anime-red/20 focus:border-anime-red transition shadow-sm placeholder-gray-400 dark:placeholder-gray-500"
            >
            <i class="ph-bold ph-lock-key absolute left-3.5 top-3 text-gray-400 text-sm"></i>
          </div>
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between text-xs">
          <label class="flex items-center gap-2 cursor-pointer">
            <input type="checkbox" name="remember" class="rounded text-anime-red focus:ring-anime-red">
            <span class="text-gray-600 dark:text-gray-400">Ingat saya</span>
          </label>
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
          <button
            type="submit"
            class="w-full py-3 px-4 rounded-xl bg-anime-red hover:bg-anime-redhover text-white font-bold text-xs tracking-wider uppercase transition shadow-md flex items-center justify-center gap-2"
          >
            <span>Masuk ke Dashboard</span>
            <i class="ph-bold ph-arrow-right"></i>
          </button>
        </div>

      </form>


    </div>

    <!-- Back to public catalog -->
    <div class="text-center mt-6">
      <a href="{{ route('catalog.index') }}" class="text-xs text-gray-500 dark:text-gray-400 hover:text-anime-red dark:hover:text-anime-red font-semibold inline-flex items-center gap-1 transition">
        <i class="ph-bold ph-arrow-left"></i> Kembali ke Katalog Publik
      </a>
    </div>

  </div>

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
    })();
  </script>

</body>
</html>

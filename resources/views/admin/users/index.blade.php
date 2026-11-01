@extends('layouts.admin')

@section('title', 'Manajemen Pengguna & Staf')
@section('header_title', 'Manajemen Akun Internal')

@section('content')

  <!-- Header & Action -->
  <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2">
    <div>
      <h2 class="text-base font-bold text-gray-900 dark:text-white">Daftar Akun Staf & Administrator</h2>
      <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Kelola hak akses pengguna internal sistem dashboard TORIZU Anime Apparel.</p>
    </div>

    <!-- Trigger Modal Tambah User -->
    <button
      type="button"
      onclick="openModal('modalCreateUser')"
      class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-anime-red hover:bg-anime-redhover text-white text-xs font-bold transition shadow-sm"
    >
      <i class="ph-bold ph-user-plus text-base"></i>
      <span>Tambah Akun Baru</span>
    </button>
  </div>

  <!-- Users Table Card -->
  <div class="bg-white dark:bg-anime-card rounded-2xl border border-gray-200/80 dark:border-anime-cardborder shadow-sm overflow-hidden transition-colors duration-200">
    <div class="overflow-x-auto">
      <table class="w-full text-left text-xs">
        <thead class="bg-gray-50 dark:bg-[#161826] text-gray-500 dark:text-gray-400 font-bold uppercase tracking-wider text-[10px] border-b border-gray-200 dark:border-anime-cardborder">
          <tr>
            <th class="py-3.5 px-6">Pengguna</th>
            <th class="py-3.5 px-6">Username</th>
            <th class="py-3.5 px-6">Hak Akses (Role)</th>
            <th class="py-3.5 px-6">Terdaftar Sejak</th>
            <th class="py-3.5 px-6 text-right">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100 dark:divide-anime-cardborder text-gray-700 dark:text-gray-300">
          @foreach($users as $user)
            <tr class="hover:bg-gray-50/50 dark:hover:bg-[#161826]/40 transition">
              <!-- Name & Email with Avatar -->
              <td class="py-4 px-6">
                <div class="flex items-center gap-3">
                  <div class="w-9 h-9 rounded-xl font-display font-black text-xs text-white flex items-center justify-center uppercase shadow-xs {{ $user->role === 'superadmin' ? 'bg-gradient-to-tr from-purple-600 to-indigo-500' : 'bg-gradient-to-tr from-blue-600 to-cyan-500' }}">
                    {{ substr($user->name, 0, 1) }}
                  </div>
                  <div>
                    <span class="font-bold text-gray-900 dark:text-white text-sm block">
                      {{ $user->name }}
                      @if(auth()->id() === $user->id)
                        <span class="ml-1 text-[10px] px-1.5 py-0.5 rounded bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 font-normal">Anda</span>
                      @endif
                    </span>
                    <span class="text-[11px] text-gray-400 font-mono">{{ $user->email }}</span>
                  </div>
                </div>
              </td>

              <!-- Username -->
              <td class="py-4 px-6 font-mono text-gray-600 dark:text-gray-300 text-xs">
                {{ '@' . $user->username }}
              </td>

              <!-- Role -->
              <td class="py-4 px-6 whitespace-nowrap">
                @if($user->role === 'superadmin')
                  <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-purple-100 dark:bg-purple-950/60 text-purple-700 dark:text-purple-300 border border-purple-200 dark:border-purple-800">
                    <i class="ph-bold ph-shield-star"></i> Superadmin
                  </span>
                @else
                  <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-[10px] font-black uppercase tracking-wider bg-blue-100 dark:bg-blue-950/60 text-blue-700 dark:text-blue-300 border border-blue-200 dark:border-blue-800">
                    <i class="ph-bold ph-user"></i> Staf Admin
                  </span>
                @endif
              </td>

              <!-- Created At -->
              <td class="py-4 px-6 text-gray-500 dark:text-gray-400 whitespace-nowrap">
                {{ $user->created_at->format('d M Y, H:i') }}
              </td>

              <!-- Action -->
              <td class="py-4 px-6 text-right whitespace-nowrap">
                @if(auth()->id() !== $user->id)
                  <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun {{ addslashes($user->name) }}?');">
                    @csrf
                    @method('DELETE')
                    <button
                      type="submit"
                      class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg border border-rose-200 dark:border-rose-900/40 text-rose-600 dark:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-950/40 text-xs font-bold transition"
                    >
                      <i class="ph-bold ph-trash"></i> Hapus
                    </button>
                  </form>
                @else
                  <span class="text-xs text-gray-400 italic">Akun Aktif</span>
                @endif
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

    @if($users->hasPages())
      <div class="p-4 border-t border-gray-200 dark:border-anime-cardborder">
        {{ $users->links() }}
      </div>
    @endif
  </div>

  <!-- ============================================================== -->
  <!-- MODAL: Tambah Staf / Admin Baru                                -->
  <!-- ============================================================== -->
  <div id="modalCreateUser" class="modal-overlay fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4 hidden">
    <div class="relative w-full max-w-md bg-white dark:bg-[#12141f] rounded-3xl border border-gray-200 dark:border-[#1e2235] shadow-2xl overflow-hidden transform transition-all animate-in fade-in zoom-in-95 duration-200">

      <!-- Header -->
      <div class="px-6 py-5 border-b border-gray-100 dark:border-[#1e2235] flex items-center justify-between bg-gray-50/60 dark:bg-black/20">
        <div class="flex items-center gap-3">
          <div class="w-9 h-9 rounded-xl bg-purple-500/10 text-purple-500 flex items-center justify-center font-bold">
            <i class="ph-bold ph-user-plus text-lg"></i>
          </div>
          <div>
            <h3 class="text-sm font-bold text-gray-900 dark:text-white">Tambah Akun Baru</h3>
            <p class="text-[11px] text-gray-400">Buat akses staf atau superadmin dashboard</p>
          </div>
        </div>
        <button type="button" onclick="closeModal('modalCreateUser')" class="p-1.5 rounded-lg text-gray-400 hover:text-gray-700 dark:hover:text-white transition">
          <i class="ph-bold ph-x text-base"></i>
        </button>
      </div>

      <!-- Form -->
      <form action="{{ route('admin.users.store') }}" method="POST" class="p-6 space-y-4">
        @csrf

        <!-- Nama Lengkap -->
        <div>
          <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
            Nama Lengkap <span class="text-anime-red">*</span>
          </label>
          <input
            type="text"
            name="name"
            required
            placeholder="Contoh: Sarah Jenkins"
            class="w-full px-4 py-2.5 text-xs rounded-xl border border-gray-200 dark:border-anime-cardborder bg-gray-50 dark:bg-anime-black text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-anime-red/20 focus:border-anime-red transition"
          >
        </div>

        <!-- Username -->
        <div>
          <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
            Username <span class="text-anime-red">*</span>
          </label>
          <input
            type="text"
            name="username"
            required
            placeholder="sarah_admin"
            class="w-full px-4 py-2.5 text-xs rounded-xl border border-gray-200 dark:border-anime-cardborder bg-gray-50 dark:bg-anime-black text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-anime-red/20 focus:border-anime-red transition font-mono"
          >
        </div>

        <!-- Email -->
        <div>
          <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
            Alamat Email <span class="text-anime-red">*</span>
          </label>
          <input
            type="email"
            name="email"
            required
            placeholder="sarah@fashionbaju.com"
            class="w-full px-4 py-2.5 text-xs rounded-xl border border-gray-200 dark:border-anime-cardborder bg-gray-50 dark:bg-anime-black text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-anime-red/20 focus:border-anime-red transition font-mono"
          >
        </div>

        <!-- Password -->
        <div>
          <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
            Password <span class="text-anime-red">*</span>
          </label>
          <input
            type="password"
            name="password"
            required
            placeholder="Minimal 6 karakter"
            class="w-full px-4 py-2.5 text-xs rounded-xl border border-gray-200 dark:border-anime-cardborder bg-gray-50 dark:bg-anime-black text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-anime-red/20 focus:border-anime-red transition"
          >
        </div>

        <!-- Role -->
        <div>
          <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-1.5">
            Hak Akses (Role) <span class="text-anime-red">*</span>
          </label>
          <select
            name="role"
            required
            class="w-full px-4 py-2.5 text-xs rounded-xl border border-gray-200 dark:border-anime-cardborder bg-gray-50 dark:bg-anime-black text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-anime-red/20 focus:border-anime-red transition"
          >
            <option value="admin" selected>Staf Admin (Kelola Produk & Leads)</option>
            <option value="superadmin">Superadmin (Akses Penuh termasuk Pengguna)</option>
          </select>
        </div>

        <!-- Footer Actions -->
        <div class="pt-4 flex items-center justify-end gap-2.5 border-t border-gray-100 dark:border-[#1e2235]">
          <button
            type="button"
            onclick="closeModal('modalCreateUser')"
            class="px-4 py-2.5 rounded-xl border border-gray-200 dark:border-anime-cardborder text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-[#181a28] text-xs font-bold transition"
          >
            Batal
          </button>
          <button
            type="submit"
            class="px-5 py-2.5 rounded-xl bg-anime-red hover:bg-anime-redhover text-white text-xs font-bold transition shadow-sm flex items-center gap-1.5"
          >
            <i class="ph-bold ph-check"></i>
            <span>Simpan Akun Baru</span>
          </button>
        </div>

      </form>
    </div>
  </div>

@endsection

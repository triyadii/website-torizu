@extends('layouts.admin')

@section('title', 'Dashboard Overview')
@section('header_title', 'Ringkasan Manajemen Toko')

@section('content')

  <!-- Stat Metric Cards -->
  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

    <!-- Card 1: Total Barang -->
    <div class="p-5 rounded-2xl bg-white dark:bg-anime-card border border-gray-200/80 dark:border-anime-cardborder shadow-sm flex items-center justify-between transition-colors duration-200">
      <div>
        <span class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total Produk</span>
        <span class="font-bold text-2xl text-gray-900 dark:text-white mt-1 block">{{ $totalBarang }}</span>
        <span class="text-[11px] text-emerald-600 dark:text-emerald-400 font-semibold">{{ $totalAktif }} aktif di katalog</span>
      </div>
      <div class="w-12 h-12 rounded-xl bg-blue-50 dark:bg-blue-950/40 text-blue-600 dark:text-blue-400 flex items-center justify-center text-2xl">
        <i class="ph-bold ph-hanger"></i>
      </div>
    </div>

    <!-- Card 2: Total Kategori -->
    <div class="p-5 rounded-2xl bg-white dark:bg-anime-card border border-gray-200/80 dark:border-anime-cardborder shadow-sm flex items-center justify-between transition-colors duration-200">
      <div>
        <span class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Kategori Baju</span>
        <span class="font-bold text-2xl text-gray-900 dark:text-white mt-1 block">{{ $totalKategori }}</span>
        <span class="text-[11px] text-gray-500 dark:text-gray-400 font-semibold">Tergolong rapi</span>
      </div>
      <div class="w-12 h-12 rounded-xl bg-purple-50 dark:bg-purple-950/40 text-purple-600 dark:text-purple-400 flex items-center justify-center text-2xl">
        <i class="ph-bold ph-tag"></i>
      </div>
    </div>

    <!-- Card 3: Total Leads WA -->
    <div class="p-5 rounded-2xl bg-white dark:bg-anime-card border border-gray-200/80 dark:border-anime-cardborder shadow-sm flex items-center justify-between transition-colors duration-200">
      <div>
        <span class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total Leads WA</span>
        <span class="font-bold text-2xl text-gray-900 dark:text-white mt-1 block">{{ $totalLeads }}</span>
        <span class="text-[11px] text-amber-600 dark:text-amber-400 font-semibold">{{ $leadsByStatus['klik_wa'] }} menunggu follow-up</span>
      </div>
      <div class="w-12 h-12 rounded-xl bg-amber-50 dark:bg-amber-950/40 text-amber-600 dark:text-amber-400 flex items-center justify-center text-2xl">
        <i class="ph-bold ph-whatsapp-logo"></i>
      </div>
    </div>

    <!-- Card 4: Closing & Estimasi Omset -->
    <div class="p-5 rounded-2xl bg-white dark:bg-anime-card border border-gray-200/80 dark:border-anime-cardborder shadow-sm flex items-center justify-between transition-colors duration-200">
      <div>
        <span class="block text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Leads Closing</span>
        <span class="font-bold text-2xl text-gray-900 dark:text-white mt-1 block">{{ $totalClosing }} Transaksi</span>
        <span class="text-[11px] text-emerald-600 dark:text-emerald-400 font-bold">Rp {{ number_format($totalOmsetClosing, 0, ',', '.') }}</span>
      </div>
      <div class="w-12 h-12 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 flex items-center justify-center text-2xl">
        <i class="ph-bold ph-handshake"></i>
      </div>
    </div>

  </div>

  <!-- Status Leads Pipeline Progress -->
  <div class="bg-white dark:bg-anime-card p-6 rounded-2xl border border-gray-200/80 dark:border-anime-cardborder shadow-sm space-y-4 transition-colors duration-200">
    <div class="flex items-center justify-between">
      <h3 class="font-bold text-sm text-gray-900 dark:text-white flex items-center gap-2">
        <i class="ph-bold ph-funnel text-anime-red"></i> Pipeline Tindak Lanjut Leads WhatsApp
      </h3>
      <a href="{{ route('admin.leads.index') }}" class="text-xs font-bold text-anime-red hover:underline">
        Lihat Semua Leads →
      </a>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-2">
      <!-- Status: Klik WA -->
      <a href="{{ route('admin.leads.index', ['status' => 'klik_wa']) }}" class="p-4 rounded-xl bg-amber-50/70 dark:bg-amber-950/30 border border-amber-200/60 dark:border-amber-800/50 hover:bg-amber-100/50 dark:hover:bg-amber-950/50 transition">
        <div class="text-[11px] font-bold text-amber-800 dark:text-amber-300 uppercase tracking-wider">1. Klik WA</div>
        <div class="text-2xl font-bold text-amber-900 dark:text-amber-200 mt-1">{{ $leadsByStatus['klik_wa'] }}</div>
        <div class="text-[10px] text-amber-700 dark:text-amber-400 mt-1">Calon pembeli klik tombol</div>
      </a>

      <!-- Status: Terhubung -->
      <a href="{{ route('admin.leads.index', ['status' => 'terhubung']) }}" class="p-4 rounded-xl bg-blue-50/70 dark:bg-blue-950/30 border border-blue-200/60 dark:border-blue-800/50 hover:bg-blue-100/50 dark:hover:bg-blue-950/50 transition">
        <div class="text-[11px] font-bold text-blue-800 dark:text-blue-300 uppercase tracking-wider">2. Terhubung</div>
        <div class="text-2xl font-bold text-blue-900 dark:text-blue-200 mt-1">{{ $leadsByStatus['terhubung'] }}</div>
        <div class="text-[10px] text-blue-700 dark:text-blue-400 mt-1">Admin sedang chat aktif</div>
      </a>

      <!-- Status: Closing -->
      <a href="{{ route('admin.leads.index', ['status' => 'closing']) }}" class="p-4 rounded-xl bg-emerald-50/70 dark:bg-emerald-950/30 border border-emerald-200/60 dark:border-emerald-800/50 hover:bg-emerald-100/50 dark:hover:bg-emerald-950/50 transition">
        <div class="text-[11px] font-bold text-emerald-800 dark:text-emerald-300 uppercase tracking-wider">3. Closing</div>
        <div class="text-2xl font-bold text-emerald-900 dark:text-emerald-200 mt-1">{{ $leadsByStatus['closing'] }}</div>
        <div class="text-[10px] text-emerald-700 dark:text-emerald-400 mt-1">Sukses transfer & dikirim</div>
      </a>

      <!-- Status: Batal -->
      <a href="{{ route('admin.leads.index', ['status' => 'batal']) }}" class="p-4 rounded-xl bg-rose-50/70 dark:bg-rose-950/30 border border-rose-200/60 dark:border-rose-800/50 hover:bg-rose-100/50 dark:hover:bg-rose-950/50 transition">
        <div class="text-[11px] font-bold text-rose-800 dark:text-rose-300 uppercase tracking-wider">4. Batal</div>
        <div class="text-2xl font-bold text-rose-900 dark:text-rose-200 mt-1">{{ $leadsByStatus['batal'] }}</div>
        <div class="text-[10px] text-rose-700 dark:text-rose-400 mt-1">Belum deal / cancel</div>
      </a>
    </div>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">

    <!-- Recent Leads Table (8 cols) -->
    <div class="lg:col-span-8 bg-white dark:bg-anime-card rounded-2xl border border-gray-200/80 dark:border-anime-cardborder shadow-sm overflow-hidden transition-colors duration-200">
      <div class="p-5 border-b border-gray-100 dark:border-anime-cardborder flex items-center justify-between">
        <div>
          <h3 class="font-bold text-sm text-gray-900 dark:text-white">Leads WhatsApp Masuk Terbaru</h3>
          <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">Daftar calon pelanggan yang mengklik tombol pesan.</p>
        </div>
        <a href="{{ route('admin.leads.index') }}" class="px-3 py-1.5 rounded-lg bg-gray-100 dark:bg-[#161826] hover:bg-gray-200 dark:hover:bg-[#1f2336] text-gray-700 dark:text-gray-200 text-xs font-bold transition">
          Kelola Leads
        </a>
      </div>

      <div class="overflow-x-auto">
        <table class="w-full text-left text-xs">
          <thead class="bg-gray-50/80 dark:bg-[#161826]/80 text-gray-500 dark:text-gray-400 font-bold uppercase tracking-wider text-[10px] border-b border-gray-100 dark:border-anime-cardborder">
            <tr>
              <th class="py-3 px-4">Waktu</th>
              <th class="py-3 px-4">Pemesan</th>
              <th class="py-3 px-4">Produk & Varian</th>
              <th class="py-3 px-4">Status</th>
              <th class="py-3 px-4 text-right">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100 dark:divide-anime-cardborder text-gray-700 dark:text-gray-300">
            @forelse($recentLeads as $lead)
              <tr class="hover:bg-gray-50/50 dark:hover:bg-[#161826]/40 transition">
                <td class="py-3 px-4 text-gray-500 dark:text-gray-400 whitespace-nowrap">
                  {{ $lead->created_at->diffForHumans() }}
                </td>
                <td class="py-3 px-4">
                  <span class="font-bold text-gray-900 dark:text-white block">{{ $lead->nama_pemesan ?: 'Tanpa Nama' }}</span>
                  @if($lead->nomor_wa)
                    <span class="text-[11px] text-gray-500 dark:text-gray-400">{{ $lead->nomor_wa }}</span>
                  @endif
                </td>
                <td class="py-3 px-4">
                  <span class="font-medium text-gray-900 dark:text-white block truncate max-w-xs">{{ $lead->barang->nama ?? 'Produk Dihapus' }}</span>
                  <span class="text-[11px] text-gray-500 dark:text-gray-400">
                    {{ $lead->varian ? "{$lead->varian->warna} (Size {$lead->varian->ukuran})" : 'Semua Varian' }}
                  </span>
                </td>
                <td class="py-3 px-4 whitespace-nowrap">
                  @php $badge = $lead->status_badge; @endphp
                  <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold border {{ $badge['bg'] }}">
                    {{ $badge['label'] }}
                  </span>
                </td>
                <td class="py-3 px-4 text-right whitespace-nowrap">
                  @if($lead->nomor_wa)
                    <a
                      href="https://api.whatsapp.com/send?phone={{ preg_replace('/[^0-9]/', '', $lead->nomor_wa) }}"
                      target="_blank"
                      class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-emerald-50 dark:bg-emerald-950/40 text-emerald-700 dark:text-emerald-300 hover:bg-emerald-100 dark:hover:bg-emerald-950/80 font-bold text-[11px] transition"
                    >
                      <i class="ph-bold ph-whatsapp-logo text-sm"></i> Chat
                    </a>
                  @else
                    <span class="text-gray-400 text-[11px]">-</span>
                  @endif
                </td>
              </tr>
            @empty
              <tr>
                <td colspan="5" class="py-8 text-center text-gray-400">
                  Belum ada leads masuk.
                </td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <!-- Low Stock Alerts & Quick Actions (4 cols) -->
    <div class="lg:col-span-4 space-y-6">

      <!-- Low Stock Card -->
      <div class="bg-white dark:bg-anime-card rounded-2xl border border-gray-200/80 dark:border-anime-cardborder shadow-sm p-5 space-y-4 transition-colors duration-200">
        <div class="flex items-center justify-between border-b border-gray-100 dark:border-anime-cardborder pb-3">
          <h3 class="font-bold text-sm text-gray-900 dark:text-white flex items-center gap-1.5">
            <i class="ph-bold ph-warning text-amber-500"></i> Peringatan Stok Menipis
          </h3>
          <span class="text-[10px] font-bold px-2 py-0.5 rounded bg-amber-50 dark:bg-amber-950/40 text-amber-700 dark:text-amber-300 border border-amber-200 dark:border-amber-800">≤ 10 pcs</span>
        </div>

        <div class="space-y-3">
          @forelse($lowStockVariants as $ls)
            <div class="flex items-center justify-between text-xs p-2.5 rounded-xl bg-gray-50 dark:bg-anime-black/60 border border-gray-100 dark:border-anime-cardborder">
              <div class="min-w-0 pr-2">
                <span class="font-bold text-gray-900 dark:text-white block truncate">{{ $ls->barang->nama ?? '' }}</span>
                <span class="text-[11px] text-gray-500 dark:text-gray-400">{{ $ls->warna }} (Size {{ $ls->ukuran }})</span>
              </div>
              <div class="text-right shrink-0">
                <span class="font-bold text-rose-600 dark:text-rose-400 block">{{ $ls->stok }} pcs</span>
                <a href="{{ route('admin.barang.edit', $ls->barang_id) }}" class="text-[10px] text-anime-red hover:underline font-semibold">Tambah</a>
              </div>
            </div>
          @empty
            <p class="text-xs text-gray-400 text-center py-4">Semua stok produk dalam kondisi aman.</p>
          @endforelse
        </div>
      </div>

      <!-- Quick Actions Card -->
      <div class="bg-gradient-to-br from-[#0c0d14] to-[#12141f] border border-gray-200 dark:border-anime-cardborder text-white rounded-2xl p-5 space-y-3 shadow-md">
        <h4 class="font-bold text-xs uppercase tracking-wider text-gray-400">Aksi Cepat</h4>
        <div class="space-y-2">
          <a href="{{ route('admin.barang.create') }}" class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-xs font-bold transition">
            <span class="flex items-center gap-2"><i class="ph-bold ph-plus-circle text-base text-anime-red"></i> Tambah Produk Baju Baru</span>
            <span>→</span>
          </a>
          <a href="{{ route('admin.kategori.create') }}" class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-xs font-bold transition">
            <span class="flex items-center gap-2"><i class="ph-bold ph-tag text-base text-anime-red"></i> Tambah Kategori Baru</span>
            <span>→</span>
          </a>
        </div>
      </div>

    </div>

  </div>

@endsection

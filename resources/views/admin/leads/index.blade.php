@extends('layouts.admin')

@section('title', 'Manajemen Leads WhatsApp')
@section('header_title', 'Data Leads Pelanggan WhatsApp')

@section('content')
<div class="space-y-6">

    <!-- Status Tabs & Filter -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 bg-white dark:bg-anime-card p-4 rounded-2xl border border-gray-200/80 dark:border-anime-cardborder shadow-sm transition-colors duration-200">
        <div class="flex flex-wrap items-center gap-2">
            @php
                $tabs = [
                    '' => ['label' => 'Semua Leads', 'count' => $statusCounts['semua']],
                    'klik_wa' => ['label' => 'Klik WA', 'count' => $statusCounts['klik_wa']],
                    'terhubung' => ['label' => 'Terhubung', 'count' => $statusCounts['terhubung']],
                    'closing' => ['label' => 'Closing', 'count' => $statusCounts['closing']],
                    'batal' => ['label' => 'Batal', 'count' => $statusCounts['batal']],
                ];
            @endphp

            @foreach($tabs as $key => $tab)
                <a href="{{ route('admin.leads.index', array_merge(request()->except('status', 'page'), $key !== '' ? ['status' => $key] : [])) }}"
                   class="px-3.5 py-1.5 rounded-xl text-xs font-semibold transition-all flex items-center gap-2 {{ ($selectedStatus == $key || ($key === '' && empty($selectedStatus))) ? 'bg-anime-red text-white shadow-sm' : 'bg-gray-100 dark:bg-[#161826] text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-[#1f2336]' }}">
                    <span>{{ $tab['label'] }}</span>
                    <span class="px-1.5 py-0.5 rounded-full text-[10px] font-bold {{ ($selectedStatus == $key || ($key === '' && empty($selectedStatus))) ? 'bg-white/20 text-white' : 'bg-white dark:bg-black/40 text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-anime-cardborder' }}">
                        {{ $tab['count'] }}
                    </span>
                </a>
            @endforeach
        </div>

        <!-- Search input -->
        <form action="{{ route('admin.leads.index') }}" method="GET" class="flex items-center gap-2">
            @if($selectedStatus)
                <input type="hidden" name="status" value="{{ $selectedStatus }}">
            @endif
            <div class="relative w-full sm:w-64">
                <i class="ph ph-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama / nomor WA..."
                       class="w-full pl-9 pr-3 py-2 text-xs rounded-xl border border-gray-200 dark:border-anime-cardborder bg-gray-50 dark:bg-anime-black text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-anime-red/20 focus:border-anime-red placeholder-gray-400 dark:placeholder-gray-500">
            </div>
            <button type="submit" class="px-3 py-2 text-xs bg-anime-red text-white rounded-xl hover:bg-anime-redhover transition-colors font-bold">
                Cari
            </button>
            @if($search)
                <a href="{{ route('admin.leads.index', request()->except('search')) }}" class="p-2 text-xs bg-gray-100 dark:bg-[#161826] text-gray-600 dark:text-gray-300 rounded-xl hover:bg-gray-200 dark:hover:bg-[#1f2336]">
                    <i class="ph ph-x"></i>
                </a>
            @endif
        </form>
    </div>

    <!-- Leads Table Card -->
    <div class="bg-white dark:bg-anime-card rounded-2xl border border-gray-200/80 dark:border-anime-cardborder shadow-sm overflow-hidden transition-colors duration-200">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs text-gray-700 dark:text-gray-300">
                <thead class="bg-gray-50 dark:bg-[#161826] border-b border-gray-200 dark:border-anime-cardborder text-gray-500 dark:text-gray-400 uppercase tracking-wider text-[11px]">
                    <tr>
                        <th class="py-3.5 px-4 font-semibold">Waktu Masuk</th>
                        <th class="py-3.5 px-4 font-semibold">Nama Pemesan</th>
                        <th class="py-3.5 px-4 font-semibold">Kontak WhatsApp</th>
                        <th class="py-3.5 px-4 font-semibold">Produk Fashion</th>
                        <th class="py-3.5 px-4 font-semibold">Varian Dipilih</th>
                        <th class="py-3.5 px-4 font-semibold">Status Follow-up</th>
                        <th class="py-3.5 px-4 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 dark:divide-anime-cardborder">
                    @forelse($leads as $lead)
                        <tr class="hover:bg-gray-50/70 dark:hover:bg-[#161826]/40 transition-colors">
                            <!-- Time -->
                            <td class="py-4 px-4 whitespace-nowrap">
                                <span class="font-bold text-gray-900 dark:text-white">{{ $lead->created_at->format('d M Y') }}</span>
                                <span class="block text-[11px] text-gray-400">{{ $lead->created_at->format('H:i') }} WIB ({{ $lead->created_at->diffForHumans() }})</span>
                            </td>

                            <!-- Customer Name -->
                            <td class="py-4 px-4">
                                <div class="font-bold text-gray-900 dark:text-white flex items-center gap-1.5">
                                    <div class="w-7 h-7 rounded-full bg-gray-100 dark:bg-[#161826] text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-anime-cardborder flex items-center justify-center font-bold text-xs uppercase">
                                        {{ substr($lead->nama_pemesan ?? 'G', 0, 1) }}
                                    </div>
                                    <span>{{ $lead->nama_pemesan ?: 'Tanpa Nama' }}</span>
                                </div>
                            </td>

                            <!-- WhatsApp -->
                            <td class="py-4 px-4 whitespace-nowrap">
                                @if($lead->nomor_wa)
                                    @php
                                        $cleanWa = preg_replace('/[^0-9]/', '', $lead->nomor_wa);
                                        if (str_starts_with($cleanWa, '0')) {
                                            $cleanWa = '62' . substr($cleanWa, 1);
                                        }
                                    @endphp
                                    <a href="https://wa.me/{{ $cleanWa }}" target="_blank"
                                       class="inline-flex items-center gap-1.5 text-emerald-600 dark:text-emerald-400 hover:underline font-semibold">
                                        <i class="ph-fill ph-whatsapp-logo text-base text-emerald-500"></i>
                                        <span>{{ $lead->nomor_wa }}</span>
                                        <i class="ph ph-arrow-square-out text-xs text-gray-400"></i>
                                    </a>
                                @else
                                    <span class="text-gray-400 italic">Tidak mengisi WA</span>
                                @endif
                            </td>

                            <!-- Product -->
                            <td class="py-4 px-4">
                                @if($lead->barang)
                                    <div class="flex items-center gap-2.5">
                                        <img src="{{ $lead->barang->foto_url }}" alt="{{ $lead->barang->nama }}"
                                             class="w-9 h-9 object-cover rounded-lg border border-gray-200 dark:border-anime-cardborder shadow-xs">
                                        <div>
                                            <a href="{{ route('catalog.show', $lead->barang->id) }}" target="_blank"
                                               class="font-bold text-gray-900 dark:text-white hover:text-anime-red line-clamp-1">
                                                {{ $lead->barang->nama }}
                                            </a>
                                            <span class="text-[11px] text-gray-500 dark:text-gray-400">{{ $lead->barang->formatted_harga }}</span>
                                        </div>
                                    </div>
                                @else
                                    <span class="text-rose-500 text-xs italic">Produk telah dihapus</span>
                                @endif
                            </td>

                            <!-- Variant -->
                            <td class="py-4 px-4 whitespace-nowrap">
                                @if($lead->varian)
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-[11px] font-bold bg-gray-100 dark:bg-[#161826] text-gray-800 dark:text-gray-200 border border-gray-200 dark:border-anime-cardborder">
                                        {{ $lead->varian->warna }} / {{ $lead->varian->ukuran }}
                                    </span>
                                @else
                                    <span class="text-gray-400 text-xs">-</span>
                                @endif
                            </td>

                            <!-- Status Dropdown Form -->
                            <td class="py-4 px-4 whitespace-nowrap">
                                <form action="{{ route('admin.leads.updateStatus', $lead->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()"
                                            class="text-xs font-semibold rounded-lg px-2.5 py-1.5 border focus:outline-none cursor-pointer
                                            @if($lead->status === 'klik_wa') bg-amber-50 dark:bg-amber-950/40 text-amber-800 dark:text-amber-300 border-amber-200 dark:border-amber-800
                                            @elseif($lead->status === 'terhubung') bg-blue-50 dark:bg-blue-950/40 text-blue-800 dark:text-blue-300 border-blue-200 dark:border-blue-800
                                            @elseif($lead->status === 'closing') bg-emerald-50 dark:bg-emerald-950/40 text-emerald-800 dark:text-emerald-300 border-emerald-200 dark:border-emerald-800
                                            @elseif($lead->status === 'batal') bg-rose-50 dark:bg-rose-950/40 text-rose-800 dark:text-rose-300 border-rose-200 dark:border-rose-800
                                            @endif">
                                        <option value="klik_wa" {{ $lead->status === 'klik_wa' ? 'selected' : '' }}>🟡 Klik WA</option>
                                        <option value="terhubung" {{ $lead->status === 'terhubung' ? 'selected' : '' }}>🔵 Terhubung</option>
                                        <option value="closing" {{ $lead->status === 'closing' ? 'selected' : '' }}>🟢 Closing (Sukses)</option>
                                        <option value="batal" {{ $lead->status === 'batal' ? 'selected' : '' }}>🔴 Batal</option>
                                    </select>
                                </form>
                            </td>

                            <!-- Action -->
                            <td class="py-4 px-4 whitespace-nowrap text-right">
                                <form action="{{ route('admin.leads.destroy', $lead->id) }}" method="POST" class="inline"
                                      onsubmit="return confirm('Hapus riwayat lead ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 text-gray-400 hover:text-rose-600 rounded-lg hover:bg-rose-50 dark:hover:bg-rose-950/30 transition-colors" title="Hapus Lead">
                                        <i class="ph ph-trash text-base"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 text-center text-gray-400">
                                <i class="ph ph-chat-teardrop-slash text-4xl mb-2 text-gray-300 dark:text-gray-600 block"></i>
                                Belum ada prospek/lead pada kategori ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($leads->hasPages())
            <div class="p-4 border-t border-gray-200 dark:border-anime-cardborder bg-gray-50/50 dark:bg-[#161826]/50 flex justify-center">
                {{ $leads->links() }}
            </div>
        @endif
    </div>
</div>
@endsection

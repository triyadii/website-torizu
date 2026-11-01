<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Lead;
use App\Models\VarianBarang;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CatalogController extends Controller
{
    /**
     * Display the public landing page with product catalog.
     */
    public function index(Request $request): View
    {
        $kategoris = Kategori::withCount(['barangs' => function ($q): void {
            $q->where('status', 'aktif');
        }])->get();

        $query = Barang::with(['kategori', 'varians'])
            ->where('status', 'aktif');

        // Filter category by slug
        $currentKategori = null;
        if ($request->filled('kategori')) {
            $currentKategori = Kategori::where('slug', $request->kategori)->first();
            if ($currentKategori) {
                $query->where('kategori_id', $currentKategori->id);
            }
        }

        // Search by keyword
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search): void {
                $q->where('nama', 'ilike', "%{$search}%")
                    ->orWhere('deskripsi', 'ilike', "%{$search}%");
            });
        }

        // Sorting
        $sort = $request->get('sort', 'terbaru');
        match ($sort) {
            'harga_rendah' => $query->orderBy('harga', 'asc'),
            'harga_tinggi' => $query->orderBy('harga', 'desc'),
            'nama' => $query->orderBy('nama', 'asc'),
            default => $query->latest(),
        };

        $barangs = $query->paginate(12)->withQueryString();

        return view('catalog.index', [
            'barangs' => $barangs,
            'kategoris' => $kategoris,
            'currentKategori' => $currentKategori,
            'selectedKategori' => $request->kategori,
            'totalProducts' => Barang::where('status', 'aktif')->count(),
            'search' => $request->search,
            'sort' => $sort,
        ]);
    }

    /**
     * Display product detail page with variants and order form.
     */
    public function show(string $id): View
    {
        $barang = Barang::with(['kategori', 'varians'])
            ->where('status', 'aktif')
            ->findOrFail($id);

        $relatedBarangs = Barang::with(['kategori', 'varians'])
            ->where('kategori_id', $barang->kategori_id)
            ->where('id', '!=', $barang->id)
            ->where('status', 'aktif')
            ->take(4)
            ->get();

        return view('catalog.show', [
            'barang' => $barang,
            'relatedBarangs' => $relatedBarangs,
        ]);
    }

    /**
     * Store lead when customer clicks WhatsApp order and return the redirect URL.
     */
    public function orderViaWa(Request $request, string $id): JsonResponse|RedirectResponse
    {
        $request->validate([
            'nama_pemesan' => ['nullable', 'string', 'max:100'],
            'nomor_wa' => ['nullable', 'string', 'max:20'],
            'varian_id' => ['nullable', 'uuid', 'exists:varian_barang,id'],
        ]);

        $barang = Barang::findOrFail($id);

        $varian = null;
        if ($request->filled('varian_id')) {
            $varian = VarianBarang::where('barang_id', $barang->id)->find($request->varian_id);
        }

        // Record Lead into database with status 'klik_wa'
        $lead = Lead::create([
            'nama_pemesan' => $request->nama_pemesan,
            'nomor_wa' => $request->nomor_wa,
            'barang_id' => $barang->id,
            'varian_id' => $varian?->id,
            'status' => 'klik_wa',
        ]);

        // Build WhatsApp message
        $adminPhone = config('app.whatsapp_admin', '6281234567890');
        $namaPemesan = $request->filled('nama_pemesan') ? $request->nama_pemesan : 'Pelanggan';
        $varianText = $varian ? "{$varian->warna} (Ukuran {$varian->ukuran})" : 'Standar / Menyesuaikan';

        $message = "Halo Torizu Anime Apparel, saya ingin memesan produk:\n\n"
            ."• *Produk*: {$barang->nama}\n"
            ."• *Varian*: {$varianText}\n"
            ."• *Harga*: {$barang->formatted_harga}\n"
            ."• *Nama Pemesan*: {$namaPemesan}\n";

        if ($request->filled('nomor_wa')) {
            $message .= "• *No. WhatsApp*: {$request->nomor_wa}\n";
        }

        $message .= "\nApakah produk ini masih tersedia? Mohon info total dan rekening pembayaran. Terima kasih!";

        $whatsappUrl = 'https://api.whatsapp.com/send?phone='.preg_replace('/[^0-9]/', '', $adminPhone).'&text='.urlencode($message);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Pesanan berhasil dicatat, membuka WhatsApp...',
                'whatsapp_url' => $whatsappUrl,
                'lead_id' => $lead->id,
            ]);
        }

        return redirect()->away($whatsappUrl);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\VarianBarang;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class BarangController extends Controller
{
    /**
     * Display product catalog list for admin.
     */
    public function index(Request $request): View
    {
        $query = Barang::with(['kategori', 'varians'])->latest();

        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('nama', 'ilike', "%{$search}%");
        }

        $barangs = $query->paginate(10)->withQueryString();
        $kategoris = Kategori::orderBy('nama', 'asc')->get();

        return view('admin.barang.index', [
            'barangs' => $barangs,
            'kategoris' => $kategoris,
            'selectedKategori' => $request->kategori_id,
            'selectedStatus' => $request->status,
            'search' => $request->search,
        ]);
    }

    /**
     * Show create product form.
     */
    public function create(): View
    {
        $kategoris = Kategori::orderBy('nama', 'asc')->get();

        return view('admin.barang.create', [
            'kategoris' => $kategoris,
        ]);
    }

    /**
     * Store new product and its initial variants.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'kategori_id' => ['required', 'uuid', 'exists:kategori,id'],
            'nama' => ['required', 'string', 'max:150'],
            'deskripsi' => ['required', 'string'],
            'harga' => ['required', 'numeric', 'min:0'],
            'foto_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:4096'],
            'foto_url_input' => ['nullable', 'url', 'max:255'],
            'status' => ['required', 'in:aktif,nonaktif'],
            'varians' => ['nullable', 'array'],
            'varians.*.ukuran' => ['nullable', 'string', 'max:20'],
            'varians.*.warna' => ['nullable', 'string', 'max:50'],
            'varians.*.stok' => ['nullable', 'integer', 'min:0'],
        ]);

        // Handle Image upload or URL
        $fotoPath = 'https://images.unsplash.com/photo-1521572267360-ee0c2909d518?auto=format&fit=crop&w=800&q=80';
        if ($request->hasFile('foto_file')) {
            $fotoPath = $request->file('foto_file')->store('barang', 'public');
        } elseif (! empty($validated['foto_url_input'])) {
            $fotoPath = $validated['foto_url_input'];
        }

        DB::transaction(function () use ($validated, $fotoPath): void {
            $barang = Barang::create([
                'kategori_id' => $validated['kategori_id'],
                'nama' => $validated['nama'],
                'deskripsi' => $validated['deskripsi'],
                'harga' => $validated['harga'],
                'foto_utama' => $fotoPath,
                'status' => $validated['status'],
            ]);

            // Save initial variants if provided
            if (! empty($validated['varians'])) {
                foreach ($validated['varians'] as $varItem) {
                    if (! empty($varItem['ukuran']) && ! empty($varItem['warna'])) {
                        VarianBarang::create([
                            'barang_id' => $barang->id,
                            'ukuran' => $varItem['ukuran'],
                            'warna' => $varItem['warna'],
                            'stok' => (int) ($varItem['stok'] ?? 0),
                        ]);
                    }
                }
            } else {
                // Default variant All Size
                VarianBarang::create([
                    'barang_id' => $barang->id,
                    'ukuran' => 'All Size',
                    'warna' => 'Standard',
                    'stok' => 10,
                ]);
            }
        });

        return redirect()->route('admin.barang.index')->with('success', 'Produk baju baru berhasil ditambahkan.');
    }

    /**
     * Show edit product form.
     */
    public function edit(string $id): View
    {
        $barang = Barang::with('varians')->findOrFail($id);
        $kategoris = Kategori::orderBy('nama', 'asc')->get();

        return view('admin.barang.edit', [
            'barang' => $barang,
            'kategoris' => $kategoris,
        ]);
    }

    /**
     * Update existing product.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $barang = Barang::findOrFail($id);

        $validated = $request->validate([
            'kategori_id' => ['required', 'uuid', 'exists:kategori,id'],
            'nama' => ['required', 'string', 'max:150'],
            'deskripsi' => ['required', 'string'],
            'harga' => ['required', 'numeric', 'min:0'],
            'foto_file' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:4096'],
            'foto_url_input' => ['nullable', 'url', 'max:255'],
            'status' => ['required', 'in:aktif,nonaktif'],
        ]);

        $updateData = [
            'kategori_id' => $validated['kategori_id'],
            'nama' => $validated['nama'],
            'deskripsi' => $validated['deskripsi'],
            'harga' => $validated['harga'],
            'status' => $validated['status'],
        ];

        // Replace photo if new file or URL is uploaded
        if ($request->hasFile('foto_file')) {
            if (! empty($barang->foto_utama) && ! str_starts_with($barang->foto_utama, 'http')) {
                Storage::disk('public')->delete($barang->foto_utama);
            }
            $updateData['foto_utama'] = $request->file('foto_file')->store('barang', 'public');
        } elseif (! empty($validated['foto_url_input'])) {
            $updateData['foto_utama'] = $validated['foto_url_input'];
        }

        $barang->update($updateData);

        return redirect()->route('admin.barang.index')->with('success', 'Informasi produk berhasil diperbarui.');
    }

    /**
     * Add a variant to the product.
     */
    public function storeVarian(Request $request, string $barangId): RedirectResponse
    {
        $barang = Barang::findOrFail($barangId);

        $validated = $request->validate([
            'ukuran' => ['required', 'string', 'max:20'],
            'warna' => ['required', 'string', 'max:50'],
            'stok' => ['required', 'integer', 'min:0'],
        ]);

        VarianBarang::create([
            'barang_id' => $barang->id,
            'ukuran' => $validated['ukuran'],
            'warna' => $validated['warna'],
            'stok' => $validated['stok'],
        ]);

        return back()->with('success', "Varian {$validated['warna']} ({$validated['ukuran']}) berhasil ditambahkan.");
    }

    /**
     * Update stock for a specific variant.
     */
    public function updateVarian(Request $request, string $barangId, string $varianId): RedirectResponse
    {
        $varian = VarianBarang::where('barang_id', $barangId)->findOrFail($varianId);

        $validated = $request->validate([
            'ukuran' => ['sometimes', 'required', 'string', 'max:20'],
            'warna' => ['sometimes', 'required', 'string', 'max:50'],
            'stok' => ['sometimes', 'required', 'integer', 'min:0'],
        ]);

        $varian->update($validated);

        return back()->with('success', "Varian {$varian->warna} ({$varian->ukuran}) berhasil diperbarui.");
    }

    /**
     * Delete a variant.
     */
    public function destroyVarian(string $barangId, string $varianId): RedirectResponse
    {
        $varian = VarianBarang::where('barang_id', $barangId)->findOrFail($varianId);
        $varian->delete();

        return back()->with('success', 'Varian produk berhasil dihapus.');
    }

    /**
     * Delete product.
     */
    public function destroy(string $id): RedirectResponse
    {
        $barang = Barang::findOrFail($id);

        if (! empty($barang->foto_utama) && ! str_starts_with($barang->foto_utama, 'http')) {
            Storage::disk('public')->delete($barang->foto_utama);
        }

        $barang->delete();

        return redirect()->route('admin.barang.index')->with('success', 'Produk baju berhasil dihapus.');
    }
}

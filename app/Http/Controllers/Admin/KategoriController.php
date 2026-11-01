<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class KategoriController extends Controller
{
    /**
     * Display category listing.
     */
    public function index(): View
    {
        $kategoris = Kategori::withCount('barangs')
            ->orderBy('nama', 'asc')
            ->paginate(15);

        return view('admin.kategori.index', [
            'kategoris' => $kategoris,
        ]);
    }

    /**
     * Show create category form.
     */
    public function create(): View
    {
        return view('admin.kategori.create');
    }

    /**
     * Store new category.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'slug' => ['nullable', 'string', 'max:100', 'unique:kategori,slug'],
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['nama']);
        }

        Kategori::create($validated);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori baru berhasil ditambahkan.');
    }

    /**
     * Show edit category form.
     */
    public function edit(string $id): View
    {
        $kategori = Kategori::findOrFail($id);

        return view('admin.kategori.edit', [
            'kategori' => $kategori,
        ]);
    }

    /**
     * Update existing category.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $kategori = Kategori::findOrFail($id);

        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'slug' => ['nullable', 'string', 'max:100', 'unique:kategori,slug,'.$kategori->id],
        ]);

        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['nama']);
        }

        $kategori->update($validated);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Delete category.
     */
    public function destroy(string $id): RedirectResponse
    {
        $kategori = Kategori::withCount('barangs')->findOrFail($id);

        if ($kategori->barangs_count > 0) {
            return back()->with('error', "Kategori ini masih memiliki {$kategori->barangs_count} barang. Hapus atau pindahkan barang terlebih dahulu.");
        }

        $kategori->delete();

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori berhasil dihapus.');
    }
}

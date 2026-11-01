<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LeadController extends Controller
{
    /**
     * Display list of customer leads.
     */
    public function index(Request $request): View
    {
        $query = Lead::with(['barang', 'varian'])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search): void {
                $q->where('nama_pemesan', 'ilike', "%{$search}%")
                    ->orWhere('nomor_wa', 'like', "%{$search}%");
            });
        }

        $leads = $query->paginate(15)->withQueryString();

        $statusCounts = [
            'semua' => Lead::count(),
            'klik_wa' => Lead::where('status', 'klik_wa')->count(),
            'terhubung' => Lead::where('status', 'terhubung')->count(),
            'closing' => Lead::where('status', 'closing')->count(),
            'batal' => Lead::where('status', 'batal')->count(),
        ];

        return view('admin.leads.index', [
            'leads' => $leads,
            'statusCounts' => $statusCounts,
            'selectedStatus' => $request->status,
            'search' => $request->search,
        ]);
    }

    /**
     * Update the follow-up status of a lead.
     */
    public function updateStatus(Request $request, string $id): RedirectResponse
    {
        $lead = Lead::findOrFail($id);

        $validated = $request->validate([
            'status' => ['required', 'in:klik_wa,terhubung,closing,batal'],
        ]);

        $lead->update(['status' => $validated['status']]);

        return back()->with('success', 'Status lead berhasil diperbarui menjadi '.ucfirst(str_replace('_', ' ', $validated['status'])).'.');
    }

    /**
     * Delete a lead.
     */
    public function destroy(string $id): RedirectResponse
    {
        $lead = Lead::findOrFail($id);
        $lead->delete();

        return back()->with('success', 'Data lead berhasil dihapus.');
    }
}

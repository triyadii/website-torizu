<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Lead;
use App\Models\VarianBarang;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the admin overview dashboard.
     */
    public function index(): View
    {
        $totalBarang = Barang::count();
        $totalAktif = Barang::where('status', 'aktif')->count();
        $totalKategori = Kategori::count();
        $totalLeads = Lead::count();
        $totalClosing = Lead::where('status', 'closing')->count();

        // Calculate estimated closing revenue
        $closingLeads = Lead::with('barang')->where('status', 'closing')->get();
        $totalOmsetClosing = $closingLeads->sum(fn ($lead) => (float) ($lead->barang?->harga ?? 0));

        $leadsByStatus = [
            'klik_wa' => Lead::where('status', 'klik_wa')->count(),
            'terhubung' => Lead::where('status', 'terhubung')->count(),
            'closing' => $totalClosing,
            'batal' => Lead::where('status', 'batal')->count(),
        ];

        // Recent 6 leads
        $recentLeads = Lead::with(['barang', 'varian'])
            ->latest()
            ->take(6)
            ->get();

        // Low stock alerts
        $lowStockVariants = VarianBarang::with('barang')
            ->where('stok', '<=', 10)
            ->orderBy('stok', 'asc')
            ->take(5)
            ->get();

        return view('admin.dashboard', [
            'totalBarang' => $totalBarang,
            'totalAktif' => $totalAktif,
            'totalKategori' => $totalKategori,
            'totalLeads' => $totalLeads,
            'totalClosing' => $totalClosing,
            'totalOmsetClosing' => $totalOmsetClosing,
            'leadsByStatus' => $leadsByStatus,
            'recentLeads' => $recentLeads,
            'lowStockVariants' => $lowStockVariants,
        ]);
    }
}

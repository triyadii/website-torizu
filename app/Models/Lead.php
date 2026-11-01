<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Lead extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'leads';

    protected $fillable = [
        'nama_pemesan',
        'nomor_wa',
        'barang_id',
        'varian_id',
        'status',
    ];

    /**
     * Product relationship.
     */
    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    /**
     * Variant relationship.
     */
    public function varian(): BelongsTo
    {
        return $this->belongsTo(VarianBarang::class, 'varian_id');
    }

    /**
     * Status badge color helper.
     */
    public function getStatusBadgeAttribute(): array
    {
        return match ($this->status) {
            'klik_wa' => ['bg' => 'bg-amber-100 text-amber-800 border-amber-200', 'label' => 'Klik WA'],
            'terhubung' => ['bg' => 'bg-blue-100 text-blue-800 border-blue-200', 'label' => 'Terhubung'],
            'closing' => ['bg' => 'bg-emerald-100 text-emerald-800 border-emerald-200', 'label' => 'Closing'],
            'batal' => ['bg' => 'bg-rose-100 text-rose-800 border-rose-200', 'label' => 'Batal'],
            default => ['bg' => 'bg-gray-100 text-gray-800 border-gray-200', 'label' => ucfirst($this->status)],
        };
    }
}

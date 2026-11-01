<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VarianBarang extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'varian_barang';

    protected $fillable = [
        'barang_id',
        'ukuran',
        'warna',
        'stok',
    ];

    protected function casts(): array
    {
        return [
            'stok' => 'integer',
        ];
    }

    /**
     * Parent product relationship.
     */
    public function barang(): BelongsTo
    {
        return $this->belongsTo(Barang::class, 'barang_id');
    }

    /**
     * Leads for this variant.
     */
    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class, 'varian_id');
    }

    /**
     * Variant label representation.
     */
    public function getLabelAttribute(): string
    {
        return "{$this->warna} - Size {$this->ukuran} (Sisa {$this->stok})";
    }
}

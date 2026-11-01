<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Barang extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'barang';

    protected $fillable = [
        'kategori_id',
        'nama',
        'deskripsi',
        'harga',
        'foto_utama',
        'status',
    ];

    /**
     * Get the attributes that should be cast.
     */
    protected function casts(): array
    {
        return [
            'harga' => 'decimal:2',
        ];
    }

    /**
     * Category relationship.
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    /**
     * Variants relationship.
     */
    public function varians(): HasMany
    {
        return $this->hasMany(VarianBarang::class, 'barang_id');
    }

    /**
     * Leads relationship.
     */
    public function leads(): HasMany
    {
        return $this->hasMany(Lead::class, 'barang_id');
    }

    /**
     * Format Rupiah price helper.
     */
    public function getFormattedHargaAttribute(): string
    {
        return 'Rp '.number_format((float) $this->harga, 0, ',', '.');
    }

    /**
     * Resolve public image URL.
     */
    public function getFotoUrlAttribute(): string
    {
        if (empty($this->foto_utama)) {
            return 'https://images.unsplash.com/photo-1521572267360-ee0c2909d518?auto=format&fit=crop&w=800&q=80';
        }

        if (str_starts_with($this->foto_utama, 'http://') || str_starts_with($this->foto_utama, 'https://')) {
            return $this->foto_utama;
        }

        if (str_starts_with($this->foto_utama, '/images/') || str_starts_with($this->foto_utama, 'images/') || str_starts_with($this->foto_utama, '/')) {
            return asset(ltrim($this->foto_utama, '/'));
        }

        return Storage::disk('public')->url($this->foto_utama);
    }

    /**
     * Total stock attribute.
     */
    public function getTotalStokAttribute(): int
    {
        return (int) $this->varians->sum('stok');
    }
}

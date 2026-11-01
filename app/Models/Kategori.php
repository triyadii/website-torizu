<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Kategori extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'kategori';

    protected $fillable = [
        'nama',
        'slug',
    ];

    /**
     * Boot function to automatically generate slug if empty.
     */
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function (Kategori $kategori): void {
            if (empty($kategori->slug)) {
                $kategori->slug = Str::slug($kategori->nama);
            }
        });
    }

    /**
     * Get the products for the category.
     */
    public function barangs(): HasMany
    {
        return $this->hasMany(Barang::class, 'kategori_id');
    }
}

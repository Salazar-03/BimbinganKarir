<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Obat extends Model
{
    use HasFactory, SoftDeletes;

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'nama_obat',
        'kemasan',
        'harga',
    ];

    // Kolom tanggal, termasuk deleted_at untuk soft deletes
    protected $dates = ['deleted_at'];

    /**
     * Relasi One to Many ke DetailPeriksa
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function detailPeriksas(): HasMany
    {
        return $this->hasMany(DetailPeriksa::class, 'id_obat');
    }
}

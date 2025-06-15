<?php

// app/Models/Poli.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'deskripsi'];

    // Semua user yang berperan sebagai dokter di poli ini
    public function doctors()
    {
        return $this->hasMany(User::class, 'id_poli')
            ->where('role', 'dokter');
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriAset extends Model
{
    use HasFactory;

    protected $table = 'kategori_aset';
    protected $fillable = ['nama', 'kode'];

    public function aset()
    {
        return $this->hasMany(Aset::class, 'kategori_id');
    }
}

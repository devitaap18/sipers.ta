<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aset extends Model {
    use HasFactory;
    
    protected $fillable = ['nama', 'kode_aset', 'kategori_id', 'stok'];

    public function kategori() 
    {
        return $this->belongsTo(KategoriAset::class, 'kategori_id');
    }
}

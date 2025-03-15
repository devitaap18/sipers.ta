<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanAset extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_aset';
    protected $fillable = ['pengajuan_id', 'aset_id', 'jumlah'];

    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class, 'pengajuan_id');
    }

    public function aset()
    {
        return $this->belongsTo(Aset::class, 'aset_id');
    }
}

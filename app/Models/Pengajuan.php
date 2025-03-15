<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $table = 'pengajuan';
    
    protected $fillable = [
        'user_id',
        'departemen',
        'tanggal_pemohon',
        'perihal',
        'deskripsi',
        'status_vp',
        'deskripsi_status_vp',
        'status_bpo',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pengajuanAset()
    {
        return $this->hasMany(PengajuanAset::class, 'pengajuan_id');
    }
}

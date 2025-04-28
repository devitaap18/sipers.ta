<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MsRole extends Model
{
    use HasFactory;

    protected $table = 'ms_role'; // Nama tabel
    protected $primaryKey = 'id'; // Primary key
    protected $fillable = [
        'role_name'
    ];

    public $timestamps = false;

    // Relasi dengan user (one to many)
    public function users()
    {
        return $this->hasMany(MsUser::class, 'role_id');
    }

    // Relasi dengan menu (many to many)
    public function menus()
    {
        return $this->belongsToMany(MsMenu::class, 'role_menu', 'role_id', 'menu_id');
    }
}

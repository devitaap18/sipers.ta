<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; // <-- Ganti ke sini
use Illuminate\Notifications\Notifiable;

class MsUser extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'ms_user';
    protected $primaryKey = 'id';

    protected $fillable = ['name', 'username', 'nik', 'company', 'role_id'];

    public function role()
    {
        return $this->belongsTo(MsRole::class, 'role_id');
    }

    public function menus()
    {
        return $this->belongsToMany(MsMenu::class, 'role_menu', 'role_id', 'menu_id');
    }
}

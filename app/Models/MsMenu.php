<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MsMenu extends Model
{
    use HasFactory;

    protected $table = 'ms_menu'; // Nama tabel
    protected $primaryKey = 'id'; // Primary key
    protected $fillable = ['menu_name', 'url', 'order', 'icon', 'parent_id'];

    // Relasi dengan role (many to many)
    public function roles()
    {
        return $this->belongsToMany(MsRole::class, 'role_menu', 'menu_id', 'role_id');
    }

    // Relasi untuk submenu (self-referencing)
    public function parentMenu()
    {
        return $this->belongsTo(MsMenu::class, 'parent_id');
    }

    public function childMenus()
    {
        return $this->hasMany(MsMenu::class, 'parent_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleMenu extends Model
{
    use HasFactory;

    protected $table = 'role_menu'; // Nama tabel
    public $timestamps = false; // Karena tabel ini tidak memiliki created_at dan updated_at
    protected $fillable = [
        'role_id',
        'menu_id'
    ];
}

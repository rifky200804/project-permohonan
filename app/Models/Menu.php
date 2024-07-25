<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $table = 'menus';
    protected $fillable = [
        'id',
        'name',
        'path',
        'access_permission',
        'created_at',
        'updated_at'
    ];
    protected $primaryKey = 'id';
}

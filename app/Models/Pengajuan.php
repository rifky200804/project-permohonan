<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;
    protected $table = 'pengajuans';

    protected $fillable = [
        'judul',
        'deskripsi',
        'file',
        'file_name',
        'menu_id',
        'user_id',
        'catatan_verifikator',
        'catatan_direktur',
        'status_verifikator',
        'status_direktur',
        'status',
    ];

    protected $primaryKey = 'id';
}

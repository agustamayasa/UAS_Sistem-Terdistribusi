<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjual extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_penjual';
    protected $table = "penjual";
    protected $fillable = [
        'nama_penjual',
        'deskripsi_penjual',
        'kontak',
        'alamat',
        'logo_penjual',
    ];
}

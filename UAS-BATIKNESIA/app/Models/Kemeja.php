<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kemeja extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_kemeja';
    protected $table = "kemeja";
    protected $fillable = [
        'kode_kemeja','nama_kemeja', 'deskripsi_kemeja','harga','gambar_kemeja','id_penjual'
    ];

    static function getKemeja(){
        $return=DB::table('kemeja')
        ->join('penjual','kemeja.id_penjual','=', 'penjual.id_penjual');
        return $return;
    }
    public function produk(){
        return $this->belongsTo(Penjual::class, 'id_penjual','id_penjual');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transaksi extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_transaksi';
    protected $table = 'transaksi';

    protected $fillable = [
        'id_kemeja',
        'nama_pelanggan',
        'tanggal',
        'jumlah',
        'total_harga',
    ];

    public function kemeja()
    {
        return $this->belongsTo(Kemeja::class, 'id_kemeja', 'id_kemeja');
    }

    static function getTransaksi()
    {
        return DB::table('transaksi')
            ->join('kemeja', 'transaksi.id_kemeja', '=', 'kemeja.id_kemeja')
            ->join('penjual', 'kemeja.id_penjual', '=', 'penjual.id_penjual')
            ->select('transaksi.*', 'kemeja.nama_kemeja', 'penjual.nama_penjual')
            ->get();
    }
}

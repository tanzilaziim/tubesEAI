<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembelianAsetModel extends Model
{
    use HasFactory;

    protected $table = 'pembelian_aset_models';
    protected $primaryKey = 'id_pembelian_aset';
    protected $fillable = [
        'id_proyek', 'nama_aset', 'jumlah', 'masa_manfaat', 'tanggal', 
        'total_biaya', 'biaya_satuan', 'bukti_pembayaran'
    ];

    public function proyek()
    {
        return $this->belongsTo(ProyekModel::class, 'id_proyek');
    }

    public function detailPembelianAset()
    {
        return $this->hasMany(DetailPembelianAsetModel::class, 'id_pembelian_aset');
    }
}
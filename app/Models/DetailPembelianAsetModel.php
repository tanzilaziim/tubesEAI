<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPembelianAsetModel extends Model
{
    use HasFactory;

    protected $table = 'detail_pembelian_aset_models';
    protected $primaryKey = 'id_aset';
    protected $fillable = [
        'id_pembelian_aset', 'nama_aset', 'tanggal_pembelian', 'tanggal_update', 'keterangan'
    ];

    public function pembelianAset()
    {
        return $this->belongsTo(PembelianAsetModel::class, 'id_pembelian_aset', 'id_pembelian_aset');
    }
    
}
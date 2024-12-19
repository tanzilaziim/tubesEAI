<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanModel extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_models';
    protected $primaryKey = 'id_pengajuan';
    
    protected $fillable = [
        'nama_desa',
        'kepala_desa',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'jumlah_penduduk',
        'nomor_wa',
        'catatan',
        'trx_code',
        'pay_code',
        'payment_url',
        'expired_date',
        'status',
        'administration_fee',
        'grand_total',     
    ];

    public static function delete_pengajuan($id)
    {
        return self::where('id_pengajuan', $id)->delete();
    }
}

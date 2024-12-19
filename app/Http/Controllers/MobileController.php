<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\OtpCode;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;

class MobileController extends Controller
{
    
    public function getHomeData(Request $request)
    {
        $user = $request->user();
    
        $isInvestor = DB::table('users')
            ->where('id_user', $user->id_user)
            ->value('is_verified');
    
        // Mengambil data berlangganan
        $subscriptionData = $this->getSubscriptionData($user->id_user);
    
        // Ambil semua id_proyek yang dana_terkumpul kurang dari target_invest
        $activeProjectIds = DB::table('proyek_models')
            ->whereColumn('dana_terkumpul', '<', 'target_invest')
            ->pluck('id_proyek');
    
        // Kembalikan data dalam bentuk JSON
        return response()->json([
            'is_investor' => $isInvestor,
            'is_subscriber' => $subscriptionData['is_subscriber'],
            'biaya_berlangganan' => $subscriptionData['biaya_berlangganan'],
            'has_paid_this_month' => $subscriptionData['has_paid_this_month'],
            'active_projects' => $activeProjectIds,
        ], 200);
    }    

    public function getRiwayatPembayaran()
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Ambil id_pelanggan dari tabel user_berlangganan_models berdasarkan id_user
        $pelanggan = DB::table('user_berlangganan_models')
            ->where('id_user', $user->id_user)
            ->first();

        // Cek apakah pelanggan ditemukan
        if (!$pelanggan) {
            return response()->json([
                'status' => 'error',
                'message' => 'Pelanggan tidak ditemukan'
            ], 404);
        }

        // Ambil data tagihan berdasarkan id_pelanggan
        $riwayatPembayaran = DB::table('tagihan_models')
            ->where('id_pelanggan', $pelanggan->id_pelanggan)
            ->select('id_pelanggan', 'tanggal', 'tagihan', 'is_verified')
            ->get();

        // Cek apakah ada data tagihan
        if ($riwayatPembayaran->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Tidak ada riwayat pembayaran yang ditemukan'
            ], 404);
        }

        // Return data riwayat pembayaran dalam bentuk JSON
        return response()->json([
            'status' => 'success',
            'data' => $riwayatPembayaran
        ], 200);
    }

    public function searchProyek(Request $request)
    {
        $query = $request->input('desa');

        // Cek apakah query pencarian ada
        if ($query) {
            // Pencarian proyek berdasarkan nama desa
            $projects = DB::table('proyek_models')->where('desa', 'LIKE', "%{$query}%")->get();
        } else {
            // Jika tidak ada query, tampilkan semua proyek
            $projects = DB::table('proyek_models')->get();
        }

        return response()->json($projects);
    }

    public function getProyekDetail($id)
    {
        // Ambil data proyek berdasarkan id_proyek langsung dari tabel 'proyek_models'
        $proyek = DB::table('proyek_models')->where('id_proyek', $id)->first();

        // Jika proyek tidak ditemukan, kembalikan respons 404
        if (!$proyek) {
            return response()->json(['error' => 'Proyek tidak ditemukan'], 404);
        }

        // Jika gambar disimpan di storage, gunakan Storage::url() untuk mengembalikan URL
        $proyek->foto_banner = Storage::url($proyek->foto_banner);

        // Kembalikan data proyek dalam bentuk JSON, termasuk path gambar asli
        return response()->json([
            'proyek' => $proyek,
        ], 200);
    }

    public function checkUserInvestment(Request $request)
    {
        // Validasi input data
        $validator = Validator::make($request->all(), [
            'id_proyek' => 'required|exists:proyek_models,id_proyek', // Validasi id_proyek harus ada di tabel proyek
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        // Mendapatkan user yang sedang login
        $user = $request->user(); 
    
        // Cek apakah user sudah berinvestasi di proyek tersebut
        $existingInvestment = DB::table('investasi_models')
            ->where('id_user', $user->id_user)
            ->where('id_proyek', $request->id_proyek)
            ->exists(); // Gunakan exists() untuk mengecek apakah data ada atau tidak
    
        // Ambil status verifikasi user dari tabel users
        $isVerified = DB::table('users')
            ->where('id_user', $user->id_user)
            ->value('is_verified'); // Ambil nilai dari kolom is_verified
    
        // Return response dengan 2 data: invested dan is_verified
        return response()->json([
            'invested' => $existingInvestment,
            'is_verified' => $isVerified
        ], 200); // 200 untuk status OK
    }
    
    public function getRekening()
    {
        try {
            // Mengambil semua data dari tabel data_rekening menggunakan Query Builder
            $dataRekening = DB::table('data_rekenings')->get();

            // Mengembalikan respon sukses dengan data rekening
            return response()->json([
                'success' => true,
                'message' => 'Data rekening berhasil diambil',
                'data' => $dataRekening
            ], 200);
        } catch (\Exception $e) {
            // Mengembalikan respon error jika terjadi kesalahan
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data rekening',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function getInvestasiData(Request $request)
    {
        $user = $request->user();

        // Mengambil daftar id_investasi yang dimiliki oleh user
        $investasiIds = DB::table('investasi_models')
            ->where('id_user', $user->id_user)
            ->pluck('id_investasi');

        // Mengambil saldo terakhir user dari tabel mutasi_models
        $mutasiTerakhir = DB::table('mutasi_models')
            ->whereIn('id_investasi', $investasiIds)
            ->orderBy('created_at', 'desc')
            ->first(); // Ambil data terbaru

        if ($mutasiTerakhir) {
            $saldoTerakhir = (float) $mutasiTerakhir->saldo_akhir;
        } else {
            // Jika tidak ada mutasi terkait, saldo default diatur ke 0
            $saldoTerakhir = 0;
        }

        // Mengambil total investasi user berdasarkan keterangan 'Transaksi investasi oleh investor'
        $totalInvestasi = DB::table('mutasi_models')
            ->whereIn('id_investasi', $investasiIds)
            ->where('keterangan', 'Transaksi investasi oleh investor')
            ->sum(DB::raw('CAST(kredit AS DOUBLE)')); // Asumsi kolom debet menyimpan nilai investasi

        // Menghitung saldo: saldo terakhir dikurangi total investasi
        $saldo = $saldoTerakhir - $totalInvestasi;

        // Menghitung penghasilan (total kredit dengan keterangan 'bagi hasil')
        $penghasilan = DB::table('mutasi_models')
            ->whereIn('id_investasi', $investasiIds)
            ->where('keterangan', 'bagi hasil')
            ->sum(DB::raw('CAST(kredit AS DOUBLE)'));

        return response()->json([
            'saldo' => $saldo,
            'penghasilan' => $penghasilan,
        ], 200);
    }

    public function riwayatMutasi(Request $request)
    {
        $user = $request->user();

        // Mengambil daftar id_investasi yang dimiliki oleh user
        $investasiIds = DB::table('investasi_models')
            ->where('id_user', $user->id_user)
            ->pluck('id_investasi');

        // Mengambil data mutasi yang terkait dengan investasi yang dimiliki user, beserta nama desa
        $riwayatMutasi = DB::table('mutasi_models')
            ->whereIn('mutasi_models.id_investasi', $investasiIds)
            ->join('investasi_models', 'mutasi_models.id_investasi', '=', 'investasi_models.id_investasi')
            ->join('proyek_models', 'investasi_models.id_proyek', '=', 'proyek_models.id_proyek')
            ->select('mutasi_models.keterangan', 'mutasi_models.kredit', 'mutasi_models.debit', 'mutasi_models.created_at', 'proyek_models.desa')
            ->get();

        return response()->json([
            'riwayatMutasi' => $riwayatMutasi,
        ], 200);
    }

    public function getInvestDataDetail(Request $request)
    {
        $user = $request->user();

        // Mengambil total investasi pengguna
        $totalInvestasi = DB::table('investasi_models')
            ->where('id_user', $user->id_user)
            ->sum('total_investasi');

        $investasiIds = DB::table('investasi_models')
            ->where('id_user', $user->id_user)
            ->pluck('id_investasi');

        // Mengecek apakah user adalah seorang investor
        $isInvestor = $investasiIds->isNotEmpty(); // Mengembalikan true jika ada id_investasi

        // Menghitung total penghasilan berdasarkan data yang relevan
        $penghasilan = DB::table('mutasi_models')
            ->whereIn('id_investasi', $investasiIds)
            ->where('keterangan', 'bagi hasil')
            ->sum(DB::raw('CAST(kredit AS DOUBLE)'));

        // Mengambil rata-rata ROI dari semua investasi pengguna
        $roi = DB::table('investasi_models')
            ->join('proyek_models', 'investasi_models.id_proyek', '=', 'proyek_models.id_proyek')
            ->where('investasi_models.id_user', $user->id_user)
            ->avg('proyek_models.roi');

        return response()->json([
            'totalInvestasi' => $totalInvestasi,
            'penghasilan' => $penghasilan,
            'roi' => $roi,
            'is_investor' => $isInvestor, // Menambahkan informasi apakah user adalah investor
        ], 200);
    }

    public function getProjectInvestDetail($projectId, Request $request)
    {
        $user = $request->user();

        // Ambil data proyek berdasarkan ID proyek
        $proyek = DB::table('proyek_models')
            ->where('id_proyek', $projectId)
            ->first();

        if (!$proyek) {
            return response()->json(['error' => 'Project not found'], 404);
        }

        // Ambil total target investasi dari tabel proyek
        $totalKebutuhanDana = $proyek->target_invest;

        // Ambil jumlah investasi pengguna pada proyek ini
        $jumlahInvestasi = DB::table('investasi_models')
            ->where('id_proyek', $projectId)
            ->where('id_user', $user->id_user)
            ->sum('total_investasi');

        // Menghitung persentase saham
        $presentasiSaham = 0;
        if ($totalKebutuhanDana > 0) {
            $presentasiSaham = ($jumlahInvestasi / $totalKebutuhanDana) * 100;
        }

        // Menghitung pendapatan bulanan berdasarkan ROI bulanan atau default
        if ($jumlahInvestasi > 0 && $proyek->roi > 0) {
            $pendapatanBulanan = (($jumlahInvestasi * $proyek->roi / 100) / 12);
        }

        // Data lainnya
        $tanggalInvestasi = DB::table('investasi_models')
            ->where('id_proyek', $projectId)
            ->where('id_user', $user->id_user)
            ->value('tanggal');

        $jumlahPendukung = DB::table('investasi_models')
            ->where('id_proyek', $projectId)
            ->distinct('id_user')
            ->count('id_user');

        return response()->json([
            'projectName' => $proyek->nama_proyek,
            'image' => $proyek->foto_banner,
            'location' => "{$proyek->desa}, {$proyek->kecamatan}, {$proyek->kabupaten}",
            'totalInvestasi' => $jumlahInvestasi,
            'tanggalInvestasi' => $tanggalInvestasi,
            'jumlahPendukung' => $jumlahPendukung,
            'status' => $proyek->status,
            'pendapatanBulanan' => $pendapatanBulanan,
            'presentasiSaham' => $presentasiSaham,
        ], 200);
    }

    public function investInProject(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id_proyek' => 'required|exists:proyek_models,id_proyek',
            'total_investasi' => 'required|numeric|min:100000',
            'bukti_transfer' => 'required|file|mimes:png,jpg,jpeg,heic,pdf|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = $request->user();

        $existingInvestment = DB::table('investasi_models')
            ->where('id_user', $user->id_user)
            ->where('id_proyek', $request->id_proyek)
            ->first();

        if ($existingInvestment) {
            return response()->json(['message' => 'You have already invested in this project.'], 400);
        }

        // Store the transfer proof (bukti_transfer)
        $buktiTransferPath = $request->file('bukti_transfer')->store('bukti_transfer');

        // Insert investment data into the database
        DB::table('investasi_models')->insert([
            'id_user' => $user->id_user,
            'id_proyek' => $request->id_proyek,
            'total_investasi' => $request->total_investasi,
            'bukti_transfer' => $buktiTransferPath,
            'tanggal' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['message' => 'Investment successful.'], 201);
    }



    public function submitPengajuanInvestasi(Request $request)
    {
        // Validasi input data. Pastikan validasi dilakukan hanya jika field dikirimkan
        $validator = Validator::make($request->all(), [
            'nama_lengkap' => 'sometimes|required|string|max:255',
            'tempat_lahir' => 'sometimes|required|string|max:255',
            'tgl_lahir' => 'sometimes|required|date',
            'nik' => 'sometimes|required|string|size:16',
            'npwp' => 'sometimes|required|string|max:20',
            'jenis_bank' => 'sometimes|required|string|max:50',
            'no_rekening' => 'sometimes|required|string|max:20',
            'foto_ktp' => 'sometimes|file|mimes:png,jpg,jpeg,heic,pdf|max:10240',
            'foto_npwp' => 'sometimes|file|mimes:png,jpg,jpeg,heic,pdf|max:10240',
            'no_hp' => 'sometimes|required|string|max:15',
            'alamat' => 'sometimes|required|string|max:255',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Array untuk menampung data yang akan di-update
        $dataToUpdate = [];

        // Cek apakah ada input untuk setiap field dan tambahkan ke array jika ada
        if ($request->has('nama_lengkap')) {
            $dataToUpdate['nama_lengkap'] = $request->input('nama_lengkap');
        }

        if ($request->has('tempat_lahir')) {
            $dataToUpdate['tempat_lahir'] = $request->input('tempat_lahir');
        }

        if ($request->has('tgl_lahir')) {
            $dataToUpdate['tgl_lahir'] = $request->input('tgl_lahir');
        }

        if ($request->has('nik')) {
            $dataToUpdate['nik'] = $request->input('nik');
        }

        if ($request->has('npwp')) {
            $dataToUpdate['npwp'] = $request->input('npwp');
        }

        if ($request->has('jenis_bank')) {
            $dataToUpdate['jenis_bank'] = $request->input('jenis_bank');
        }

        if ($request->has('no_rekening')) {
            $dataToUpdate['no_rekening'] = $request->input('no_rekening');
        }

        if ($request->has('no_hp')) {
            $dataToUpdate['no_hp'] = $request->input('no_hp');
            $dataToUpdate['no_hp_verified_at'] = now(); // Tanda nomor sudah diverifikasi
        }

        if ($request->has('alamat')) {
            $dataToUpdate['alamat'] = $request->input('alamat');
        }

        // Handle penyimpanan file KTP jika ada
        if ($request->hasFile('foto_ktp')) {
            $fotoKtpPath = $request->file('foto_ktp')->store('foto_ktp');
            $dataToUpdate['foto_ktp'] = $fotoKtpPath;
        }

        // Handle penyimpanan file NPWP jika ada
        if ($request->hasFile('foto_npwp')) {
            $fotoNpwpPath = $request->file('foto_npwp')->store('foto_npwp');
            $dataToUpdate['foto_npwp'] = $fotoNpwpPath;
        }

        // Update data ke dalam tabel users hanya dengan data yang sudah dimasukkan dalam array
        if (!empty($dataToUpdate)) {
            $dataToUpdate['updated_at'] = now(); // Tambahkan timestamp
            DB::table('users')
                ->where('id_user', $request->user()->id_user)
                ->update($dataToUpdate);
        }

        // Return success response
        return response()->json([
            'status' => 'success',
            'message' => 'Data pengguna berhasil diperbarui.',
        ], 200);
    }


    public function submitPengajuanInternet(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_desa' => 'required|string|max:255',
            'kepala_desa' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kabupaten' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'jumlah_penduduk' => 'required|integer',
            'nomor_wa' => 'required|string|max:20',
            'catatan' => 'nullable|string|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        DB::table('pengajuan_models')->insert([
            'nama_desa' => $request->nama_desa,
            'kepala_desa' => $request->kepala_desa,
            'kecamatan' => $request->kecamatan,
            'kabupaten' => $request->kabupaten,
            'provinsi' => $request->provinsi,
            'jumlah_penduduk' => $request->jumlah_penduduk,
            'nomor_wa' => $request->nomor_wa,
            'catatan' => $request->catatan,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['message' => 'Pengajuan internet berhasil dikirim dan akan diproses.'], 201);
    }

    public function sendOtpWA(Request $request)
    {
        $request->validate([
            'no_hp' => 'required|string',
        ]);

        $user = User::where('no_hp', $request->no_hp)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found.'], 404);
        }

        $otp_code = rand(100000, 999999);

        OtpCode::create([
            'user_id' => $user->id,
            'otp_code' => $otp_code,
            'expires_at' => now()->addMinutes(5),
        ]);

        $response = Http::post('https://app.wati.io/api/v1/sendTemplateMessage', [
            'to' => $user->no_hp,
            'template_name' => 'otp_template',
            'parameters' => [
                ['type' => 'text', 'text' => $otp_code]
            ],
            'key' => env('WATI_API_KEY')
        ]);

        if ($response->successful()) {
            return response()->json(['message' => 'OTP sent successfully.'], 200);
        } else {
            return response()->json(['error' => 'Failed to send OTP.'], 500);
        }
    }

    public function validateOtpWA(Request $request)
    {
        $request->validate([
            'no_hp' => 'required|string',
            'otp_code' => 'required|string',
        ]);

        $user = User::where('no_hp', $request->no_hp)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found.'], 404);
        }

        $otp_record = OtpCode::where('user_id', $user->id)
            ->where('otp_code', $request->otp_code)
            ->where('expires_at', '>', now())
            ->first();

        if ($otp_record) {
            $otp_record->update(['verified_at' => now()]);

            $user->update(['no_hp_verified_at' => now()]);

            return response()->json(['message' => 'OTP validated and phone number verified successfully.'], 200);
        } else {
            return response()->json(['error' => 'Invalid OTP or OTP expired.'], 400);
        }
    }

    public function resendOtpWA(Request $request)
    {
        $request->validate([
            'no_hp' => 'required|string',
        ]);

        $user = User::where('no_hp', $request->no_hp)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found.'], 404);
        }

        $otp_code = rand(100000, 999999);

        OtpCode::create([
            'user_id' => $user->id,
            'otp_code' => $otp_code,
            'expires_at' => now()->addMinutes(5),
        ]);

        $response = Http::post('https://app.wati.io/api/v1/sendTemplateMessage', [
            'to' => $user->no_hp,
            'template_name' => 'otp_template',
            'parameters' => [
                ['type' => 'text', 'text' => $otp_code]
            ],
            'key' => env('WATI_API_KEY')
        ]);

        if ($response->successful()) {
            return response()->json(['message' => 'OTP sent successfully.'], 200);
        } else {
            return response()->json(['error' => 'Failed to send OTP.'], 500);
        }
    }

    public function getUserProfile(Request $request)
    {
        $user = $request->user();
    
        // Ambil data langganan menggunakan fungsi getSubscriptionData
        $subscriptionData = $this->getSubscriptionData($user->id_user);
    
        $data = [
            'username' => $user->username,
            'nama_lengkap' => $user->nama_lengkap,
            'tempat_lahir' => $user->tempat_lahir,
            'tanggal_lahir' => $user->tgl_lahir,
            'email' => $user->email,
            'no_hp' => $user->no_hp,
            'nik' => $user->nik,
            'npwp' => $user->npwp,
            'nama_bank' => $user->jenis_bank,
            'nomor_rekening' => $user->no_rekening,
            'is_verified' => $user->is_verified, // Tambahkan is_verified dari tabel user
            'id_pelanggan' => $subscriptionData['is_subscriber'] ? $subscriptionData['id_pelanggan'] : null, // Tambahkan id_pelanggan jika berlangganan
        ];
    
        return response()->json($data, 200);
    }
    
    public function getSubscriptionData($userId)
    {
        // Ambil data pelanggan terkait user
        $pelanggan = DB::table('user_berlangganan_models')
            ->join('pelanggan_models', 'user_berlangganan_models.id_pelanggan', '=', 'pelanggan_models.id_pelanggan')
            ->where('user_berlangganan_models.id_user', $userId)
            ->select('pelanggan_models.id_pelanggan', 'pelanggan_models.biaya_berlangganan')
            ->first();
    
        if (!$pelanggan) {
            // Jika tidak ada data pelanggan, berarti user tidak berlangganan
            return [
                'is_subscriber' => false,
                'id_pelanggan' => null,
                'biaya_berlangganan' => 0,
                'has_paid_this_month' => false,
            ];
        }
    
        // Cek apakah pelanggan sudah membayar bulan ini
        $hasPaidThisMonth = DB::table('tagihan_models')
            ->where('id_pelanggan', $pelanggan->id_pelanggan)
            ->whereMonth('tanggal', now()->month) // Cek bulan ini
            ->exists();
    
        // Kembalikan hasilnya
        return [
            'is_subscriber' => true,
            'id_pelanggan' => $pelanggan->id_pelanggan,
            'biaya_berlangganan' => $pelanggan->biaya_berlangganan,
            'has_paid_this_month' => $hasPaidThisMonth,
        ];
    }    

    public function updateUserProfile(Request $request)
    {
        $request->validate([
            'username' => 'sometimes|string|max:255',
            'password' => 'sometimes|string|min:8',
            'no_hp' => 'sometimes|string|max:15',
        ]);

        $user = $request->user();

        if ($request->has('username')) {
            $user->username = $request->username;
        }

        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }

        if ($request->has('no_hp')) {
            $user->no_hp = $request->no_hp;
        }

        $user->save();

        return response()->json(['message' => 'Profile updated successfully'], 200);
    }

    public function updateBankAccount(Request $request)
    {
        // Validasi input dari pengguna
        $request->validate([
            'jenis_bank' => 'required|string|max:255',
            'no_rekening' => 'required|string|max:20', // Menyesuaikan format no. rekening
        ]);

        // Ambil pengguna yang sedang login
        $user = $request->user(); // atau bisa juga menggunakan Auth::user();

        // Update kolom jenis_bank dan no_rekening
        $user->jenis_bank = $request->input('jenis_bank');
        $user->no_rekening = $request->input('no_rekening');

        // Simpan perubahan ke database
        if ($user->save()) {
            // Jika berhasil, kirim response sukses
            return response()->json([
                'message' => 'Akun bank berhasil diperbarui',
                'status' => 200,
            ], 200);
        }

        // Jika gagal menyimpan perubahan, kirim response error
        return response()->json([
            'message' => 'Gagal memperbarui akun bank',
            'status' => 500,
        ], 500);
    }

    public function getAllProyekDetails()
    {
        try {
            $proyek = DB::table('proyek_models')
                ->select('id_proyek', 'kabupaten', 'desa')
                ->get();
            return response()->json($proyek, 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve project details.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function getActiveProjects(Request $request)
    {
        try {
            $activeProjectIds = DB::table('proyek_models')
            ->whereColumn('dana_terkumpul', '<', 'target_invest')
            ->pluck('id_proyek');

            return response()->json($activeProjectIds, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch active project ids'], 500);
        }
    }

    public function getUserInvestedProjects(Request $request)
    {
        // Get the authenticated user
        $user = $request->user();

        // Query the 'investasi_models' table to get all project IDs the user has invested in
        $investedProjects = DB::table('investasi_models')
            ->where('id_user', $user->id_user)
            ->where('is_verified', 1)
            ->pluck('id_proyek');

        $investasiIds = DB::table('investasi_models')
            ->where('id_user', $user->id_user)
            ->pluck('id_investasi');

        $isInvestor = $investasiIds->isNotEmpty();

        // Return the project IDs as a JSON response
        return response()->json(['invested_project_ids' => $investedProjects, 'is_investor' => $isInvestor], 200);
    }

    public function tarikSaldo(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'id_investasi' => 'required|exists:investasi_models,id_investasi',
            'jumlah' => 'required|numeric|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()
            ], 400);
        }

        // Ambil user yang sedang login
        $user = Auth::user();
        $id_investasi = $request->input('id_investasi');
        $jumlah = $request->input('jumlah');

        // Validasi apakah user memiliki investasi pada id_investasi tersebut
        $investasi = DB::table('investasi_models')
            ->where('id_investasi', $id_investasi)
            ->where('id_user', $user->id_user)
            ->first();

        if (!$investasi) {
            return response()->json([
                'status' => 'error',
                'message' => 'User tidak memiliki investasi di proyek ini'
            ], 403);
        }

        // Simpan data penarikan saldo ke tabel penarikan_saldo_user_models
        DB::table('penarikan_saldo_user_models')->insert([
            'id_investasi' => $id_investasi,
            'jumlah' => $jumlah,
            'tanggal_pengajuan' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Penarikan saldo berhasil diajukan',
            'data' => [
                'id_investasi' => $id_investasi,
                'jumlah' => $jumlah,
            ]
        ], 200);
    }

    public function getSaldoNonInvestasi(Request $request)
    {
        $user = $request->user();

        // Pastikan user ditemukan
        if (!$user) {
            return response()->json(['error' => 'User tidak ditemukan atau token tidak valid'], 401);
        }

        $investasiIds = DB::table('investasi_models')
            ->where('id_user', $user->id_user) // Menggunakan id user dari token
            ->pluck('id_investasi'); // Mengambil semua id_investasi untuk user ini

        // Jika tidak ada investasi ditemukan untuk user ini, kembalikan error
        if ($investasiIds->isEmpty()) {
            return response()->json(['error' => 'Tidak ada investasi ditemukan untuk user ini'], 404);
        }

        // Query untuk menghitung saldo per investasi untuk transaksi non-investasi
        $result = DB::table('investasi_models as i')
            ->join('proyek_models as p', 'i.id_proyek', '=', 'p.id_proyek')
            ->leftJoin('mutasi_models as m', 'i.id_investasi', '=', 'm.id_investasi')
            ->select('i.id_investasi', 'p.desa', DB::raw('CAST(COALESCE(SUM(m.kredit - m.debit), 0) AS DOUBLE) AS saldo'))
            ->whereIn('i.id_investasi', $investasiIds)
            ->where('m.keterangan', '!=', 'Transaksi investasi oleh investor') // Filter untuk transaksi non-investasi
            ->groupBy('i.id_investasi', 'p.desa')
            ->get();

        // Jika tidak ada transaksi ditemukan
        if ($result->isEmpty()) {
            return response()->json(['error' => 'Tidak ada transaksi non-investasi ditemukan'], 404);
        }

        // Kembalikan respons sukses dengan hasil saldo per investasi
        return response()->json([
            'message' => 'Saldo non-investasi berhasil dihitung',
            'data' => $result
        ], 200);
    }

    public function getJurnalByProyek($id_proyek)
    {
        // Menggunakan Query Builder untuk mengambil data dari tabel jurnal_investasi_models berdasarkan id_proyek
        $jurnalInvestasi = DB::table('jurnal_investasi_models')
            ->where('id_proyek', $id_proyek)
            ->orderBy('id_jurnal', 'desc')
            ->get();

        // Cek apakah ada data yang ditemukan
        if ($jurnalInvestasi->isEmpty()) {
            return response()->json([
                'message' => 'Data jurnal tidak ditemukan untuk id proyek ini',
            ], 404);
        }

        // Format data untuk dikembalikan
        $result = $jurnalInvestasi->map(function ($item) {
            return [
                'keterangan' => $item->keterangan,
                'nominal' => $item->kredit > 0 ? $item->kredit : $item->debit,
                'pemasukan' => $item->kredit > 0, // Jika kredit > 0 maka pemasukan, jika tidak maka pengeluaran
                'saldo_akhir' => $item->saldo_akhir,
                'tanggal' => $item->tanggal,
            ];
        });

        // Kembalikan hasil dalam bentuk JSON
        return response()->json($result, 200);
    }

    public function getNotifikasi(Request $request)
    {
        // Ambil data user dari request (user yang sedang login)
        $user = $request->user();

        // Cek apakah user ditemukan
        if (!$user) {
            return response()->json([
                'message' => 'User tidak ditemukan',
            ], 404);
        }

        // Ambil data investasi yang valid untuk user berdasarkan id_user
        $validInvestments = DB::table('investasi_models')
            ->join('proyek_models', 'investasi_models.id_proyek', '=', 'proyek_models.id_proyek')
            ->select('proyek_models.desa', 'investasi_models.updated_at as tanggal_validasi')
            ->where('investasi_models.id_user', '=', $user->id_user)  // Mengambil ID user dari request
            ->where('investasi_models.is_verified', '=', 1) // Hanya data yang telah diverifikasi
            ->orderBy('investasi_models.updated_at', 'desc')
            ->get();

        // Ambil data proyek yang dibuat dalam satu bulan terakhir
        $oneMonthAgo = Carbon::now()->subMonth();
        $recentProjects = DB::table('proyek_models')
            ->select('nama_proyek', 'desa', 'created_at')
            ->where('created_at', '>=', $oneMonthAgo)
            ->orderBy('created_at', 'desc')
            ->get();

        // Cek apakah data investasi atau proyek ditemukan
        if ($validInvestments->isEmpty() && $recentProjects->isEmpty()) {
            return response()->json([
                'message' => 'Tidak ada notifikasi untuk user ini',
            ], 404);
        }

        // Gabungkan kedua hasil dalam satu array respons
        return response()->json([
            'valid_investments' => $validInvestments,
            'recent_projects' => $recentProjects,
        ], 200);
    }

    public function cekDataUser(Request $request)
    {
        $user = $request->user();

        // Default nilai verificationValue adalah false
        $verificationValue = false;

        // Cek apakah user memiliki NIK dan is_verified bernilai 0
        if (!is_null($user->nik)) {
            $isVerified = DB::table('users')
                ->where('id_user', $user->id_user)
                ->value('is_verified');

            if ($isVerified === 0) {
                $verificationValue = true;
            }
        }

        return response()->json(['verificationValue' => $verificationValue], 200);
    }

}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\OtpCode;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            return redirect('administrator/');
        }

        return view('admin.auth.login_index');
    }

    public function login_attempt(Request $request)
    {
        $rules = [
            'username' => 'required|string',
            'password' => 'required|string',
        ];

        $messages = [
            'username.required' => 'Username atau Email wajib diisi',
            'password.required' => 'Password wajib diisi',
            'password.string' => 'Password harus berupa string',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }

        $username = $request->username;
        $password = $request->password;
        $remember_me = $request->remember_me ? true : false;

        $user = User::where('username', $username)
            ->orWhere('email', $username)
            ->first();

        if (!$user) {
            Session::flash('error', 'Username atau Email Anda salah');
            return redirect('administrator/login');
        }

        if ($user->role_id != 1) {
            Session::flash('error', 'Anda tidak memiliki akses');
            return redirect('administrator/login');
        }

        $data = [
            'email' => $user->email,
            'password' => $password,
        ];

        if (Auth::attempt($data, $remember_me)) {
            //Login Success
            return redirect('administrator/');
        } else {
            //Login Fail
            Session::flash('error', 'Username atau Password anda salah');
            return redirect('administrator/login');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect('administrator/login');
    }

    public function registerMobile(Request $request)
    {
        // Validasi input dari request
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);
    
        // Jika validasi gagal, kembalikan respon error
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        // Pengecekan apakah email sudah terdaftar
        $existingUser = DB::table('users')
        ->where('email', $request->email)
        ->whereNotNull('email_verified_at') // Cek hanya untuk email yang sudah terverifikasi
        ->first();
    
        if ($existingUser) {
            return response()->json(['message' => 'Email sudah terverifikasi.'], 409);
        }
    
        // Generate OTP code
        $otp_code = rand(100000, 999999);
    
        try {
            // Insert data user langsung ke tabel users
            $userId = DB::table('users')->insertGetId([
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        
            // Insert OTP code menggunakan model OtpCode
            OtpCode::create([
                'user_id' => $userId,
                'otp_code' => $otp_code,
                'expires_at' => Carbon::now()->addMinutes(10),
            ]);
        
            // Pemanggilan fungsi sendVerificationEmail
            $this->sendVerificationEmail((object)[
                'id_user' => $userId,
                'email' => $request->email,
                'username' => $request->username,
            ], $otp_code);
        
            return response()->json(['message' => 'User registered successfully. Please verify your email.'], 201);
        } catch (\Exception $e) {
            // Jika terjadi error, rollback dan kirimkan respon error
            return response()->json(['message' => 'Registration failed.', 'error' => $e->getMessage()], 500);
        }
        
    }    

    private function sendVerificationEmail($user, $otp_code)
    {
        $emailContent = "Halo {$user->username},\n\n" .
            "Selamat datang di VestNet!\n" .
            "Kode verifikasi Anda adalah:\n\n" .
            "🔑 {$otp_code}\n\n" .
            "Kode ini berlaku selama 10 menit. Jangan bagikan kode ini kepada siapa pun.\n\n" .
            "Terima kasih telah bergabung dengan kami.\n\n" .
            "Salam hangat,\n" .
            "Tim VestNet";
    
        Mail::raw($emailContent, function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Kode Verifikasi Akun VestNet');
        });
    }
    

    public function verifyOTP(Request $request)
    {
        // Validasi input dari request
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'otp_code' => 'required|string|size:6',
        ]);

        // Jika validasi gagal, kembalikan respon error
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Cek apakah user ada berdasarkan email menggunakan query builder
        $user = DB::table('users')->where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Cek apakah OTP valid dan belum kadaluarsa
        $otpCode = OtpCode::where('user_id', $user->id_user)
            ->where('otp_code', $request->otp_code)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$otpCode) {
            return response()->json(['message' => 'Invalid or expired OTP'], 400);
        }

        // Update verified_at pada tabel otp_codes
        $otpCode->update(['verified_at' => Carbon::now()]);

        // Update email_verified_at pada tabel users menggunakan query builder
        DB::table('users')
            ->where('id_user', $user->id_user)
            ->update(['email_verified_at' => Carbon::now()]);

        return response()->json(['message' => 'Email verified successfully'], 200);
    }


    public function loginMobile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'login' => 'required|string',
            'password' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        $fieldType = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $user = User::where($fieldType, $request->login)->first();
    
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Login failed'], 401);
        }
    
        if (is_null($user->email_verified_at)) {
            return response()->json(['message' => 'Please verify your email before logging in.'], 403);
        }
    
        // Cek apakah NIK user ada di tabel pelanggan
        $pelanggan = DB::table('pelanggan_models')->where('nik', $user->nik)->first();
    
        if ($pelanggan) {
            // Cek apakah sudah ada data di tabel user_berlangganan_models
            $existingSubscription = DB::table('user_berlangganan_models')
                ->where('id_user', $user->id_user)
                ->where('id_pelanggan', $pelanggan->id_pelanggan)
                ->exists();
    
            if (!$existingSubscription) {
                // Buat data baru di tabel user_berlangganan_models
                DB::table('user_berlangganan_models')->insert([
                    'id_user' => $user->id_user,
                    'id_pelanggan' => $pelanggan->id_pelanggan,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    
        $token = $user->createToken('auth_token')->plainTextToken;
    
        return response()->json(['access_token' => $token, 'token_type' => 'Bearer'], 200);
    }
    
    private function sendulangemail($user, $otp_code)
    {
        // Format isi email
        $emailContent = "Halo {$user->username},\n\n" .
            "Anda meminta pengiriman ulang kode verifikasi akun VestNet Anda.\n" .
            "Kode verifikasi Anda adalah:\n\n" .
            "🔑 {$otp_code}\n\n" .
            "Kode ini berlaku selama 10 menit. Jangan bagikan kode ini kepada siapa pun.\n\n" .
            "Jika Anda tidak meminta kode ini, abaikan email ini.\n\n" .
            "Terima kasih telah menggunakan layanan kami.\n\n" .
            "Salam hangat,\n" .
            "Tim VestNet";
    
        // Kirim email
        Mail::raw($emailContent, function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Kode Verifikasi Akun VestNet Anda');
        });
    }
    
    public function resendOTPEmail(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
        ]);
    
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
    
        // Cek apakah user dengan email tersebut ada
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
    
        // Cek apakah email sudah diverifikasi
        if (!is_null($user->email_verified_at)) {
            return response()->json(['message' => 'Email already verified'], 400);
        }
    
        // Buat OTP baru dan simpan di database
        $otp_code = rand(100000, 999999);
        OtpCode::updateOrCreate(
            ['user_id' => $user->id],
            [
                'otp_code' => $otp_code,
                'expires_at' => Carbon::now()->addMinutes(10),
            ]
        );
    
        // Kirim ulang email verifikasi menggunakan fungsi sendulangemail
        $this->sendulangemail($user, $otp_code);
    
        return response()->json(['message' => 'OTP resent successfully. Please check your email.'], 200);
    }
    

    public function forgotPassword(Request $request)
    {
        // Validasi input email
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
        ]);

        // Jika validasi gagal, kembalikan error
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Cek apakah user dengan email tersebut ada
        $user = DB::table('users')->where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Buat OTP reset password
        $otp_code = rand(100000, 999999);

        // Simpan OTP ke tabel otp_codes
        DB::table('otp_codes')->updateOrInsert(
            ['user_id' => $user->id_user],
            [
                'otp_code' => $otp_code,
                'expires_at' => Carbon::now()->addMinutes(10),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );

        // Kirim email berisi OTP
        $this->sendResetPasswordEmail($user, $otp_code);

        return response()->json(['message' => 'OTP sent successfully. Please check your email.'], 200);
    }

    // Fungsi untuk mengirim email reset password dengan OTP
    private function sendResetPasswordEmail($user, $otp_code)
    {
        // Format isi email
        $emailContent = "Halo {$user->username},\n\n" .
            "Kami menerima permintaan untuk mereset password akun VestNet Anda.\n" .
            "Kode OTP untuk mereset password Anda adalah:\n\n" .
            "🔑 {$otp_code}\n\n" .
            "Kode ini berlaku selama 10 menit. Jangan bagikan kode ini kepada siapa pun.\n\n" .
            "Jika Anda tidak meminta reset password, abaikan email ini.\n\n" .
            "Terima kasih telah menggunakan layanan kami.\n\n" .
            "Salam hangat,\n" .
            "Tim VestNet";
    
        // Kirim email
        Mail::raw($emailContent, function ($message) use ($user) {
            $message->to($user->email);
            $message->subject('Reset Password Akun VestNet Anda');
        });
    }
    

    // Endpoint untuk memverifikasi OTP dan mengubah password
    public function resetPassword(Request $request)
    {
        // Validasi input email, OTP, dan password baru
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'otp_code' => 'required|string|size:6',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Jika validasi gagal, kembalikan error
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Cek apakah user ada berdasarkan email
        $user = DB::table('users')->where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Cek OTP yang valid dan belum kadaluarsa
        $otpCode = DB::table('otp_codes')
            ->where('user_id', $user->id_user)
            ->where('otp_code', $request->otp_code)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        if (!$otpCode) {
            return response()->json(['message' => 'Invalid or expired OTP'], 400);
        }

        // Update password user menggunakan query builder
        DB::table('users')->where('id_user', $user->id_user)->update([
            'password' => Hash::make($request->new_password),
            'updated_at' => Carbon::now(),
        ]);

        // Tandai OTP sebagai terverifikasi
        DB::table('otp_codes')->where('user_id', $user->id_user)->update([
            'verified_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        return response()->json(['message' => 'Password reset successfully'], 200);
    }
}

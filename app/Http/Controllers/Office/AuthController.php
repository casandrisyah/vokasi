<?php

namespace App\Http\Controllers\Office;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Civitas\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Default\PasswordReset;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ResetPasswordNotification;
use App\Notifications\PasswordResetedNotification;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('do_logout');
    }
    public function index()
    {
        if (Auth::guard('web')->check()) {
            return redirect()->route('office.dashboard.index');
        }
        $session_data = session()->get('session_data');
        return view('pages.app.auth.login', compact('session_data'));
    }
    public function do_login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ],[
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 8 karakter'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }
        if(Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)){
            return response()->json([
                'alert' => 'success',
                'name' => Auth::guard('web')->user()->name,
                'message' =>  'Selamat datang '. Auth::guard('web')->user()->name
            ]);
        }
        session()->remove('session_data');
        return response()->json([
            'alert' => 'error',
            'message' => 'Kredensial yang diberikan tidak cocok dengan catatan kami.'
        ]);
    }
    public function forgot()
    {
        $session_data = session()->get('session_data');
        return view('pages.app.auth.forgot', compact('session_data'));
    }
    public function do_forgot(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users',
        ],[
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Email tidak valid',
            'email.exists' => 'Email tidak terdaftar'
        ]);
        if ($validator->fails()){
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }
        $user = User::where('email',$request->email)->first();
        $token = Str::random(64);
        $passwordReset = PasswordReset::where('email', $request->email)->first();
        if($passwordReset){
            PasswordReset::where('email', $request->email)->update([
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
        } else{
            PasswordReset::create([
                'email' => $request->email,
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
        }
        $data = array(
            'token' => $token,
            'user' => $user
        );
        Notification::send($data['user'], new ResetPasswordNotification($data));
        $data = [
            'message' => 'Kami telah mengirimkan tautan setel ulang kata sandi Anda melalui email!',
        ];
        session()->flash('session_data', $data);
        return response()->json([
            'alert' => 'success',
            'message' => 'Permintaan berhasil dikirim.'
        ], 200);
    }
    public function do_reset(Request $request)
    {
        $updatePassword = PasswordReset::where('token', $request->token)->latest()->first();

        $validator = Validator::make($request->all(), [
            'token' => 'required',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|min:8'
        ],[
            'token.required' => 'Token tidak boleh kosong',
            'password.required' => 'Password baru tidak boleh kosong',
            'password.string' => 'Password baru harus berupa string',
            'password.min' => 'Password baru minimal 8 karakter',
            'password.confirmed' => 'Password baru tidak cocok',
            'password_confirmation.required' => 'Konfirmasi password tidak boleh kosong',
            'password_confirmation.min' => 'Konfirmasi password minimal 8 karakter'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }

        if ($updatePassword) {
            User::where('email', $updatePassword->email)->update(['password' => Hash::make($request->password)]);
            Notification::send(User::where('email', $updatePassword->email)->first(), new PasswordResetedNotification(User::where('email', $updatePassword->email)->first()));
            PasswordReset::where(['email' => $updatePassword->email])->delete();
            $data = [
                'message' => 'Password berhasil diubah. Silahkan login dengan password baru Anda',
            ];
            session()->flash('session_data', $data);
            return response()->json([
                'alert' => 'success',
                'message' => 'Password berhasil diubah.'
            ], 200);
        } else {
            return response()->json([
                'alert' => 'error',
                'message' => 'Token tidak ditemukan'
            ], 200);
        }
    }
    public function do_logout()
    {
        Auth::logout();
        return redirect()->route('web.home');
    }
}

<?php

namespace App\Http\Controllers\Web;

use Illuminate\Support\Str;
use App\Models\Civitas\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Default\PasswordReset;
use App\Notifications\Web\ResetPasswordNotification;
use App\Notifications\Web\PasswordResetedNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('do_logout');
    }
    public function login()
    {
        if (Auth::guard('web')->check()) {
            return redirect()->route('web.home');
        }
        return view('pages.web.auth.login');
    }

    public function do_login(Request $request) {
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ];

        $messages = [
            'email.required' => 'Email atau password yang anda masukkan tidak sesuai, silahkan isi kembali.',
            'email.email' => 'Email atau password yang anda masukkan tidak sesuai, silahkan isi kembali.',
            'password.required' => 'Email atau password yang anda masukkan tidak sesuai, silahkan isi kembali.',
            'password.min' => 'Email atau password yang anda masukkan tidak sesuai, silahkan isi kembali.',
            'password.confirmed' => 'Email atau password yang anda masukkan tidak sesuai, silahkan isi kembali.',
        ];

        $validation = Validator::make($request->all(), $rules, $messages);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        } else {
            if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
                // toast()->success(null, 'Login berhasil!')->showCloseButton(true)->autoClose(5000);
                return redirect()->route('office.dashboard.index')->with('success', 'Login berhasil!');
            } else {
                session('error', 'Email atau password yang anda masukkan tidak sesuai, silahkan isi kembali.');
                return redirect()->back()->withInput()->with('error', 'Email atau password yang anda masukkan tidak sesuai, silahkan isi kembali.');
            }
        }

    }

    public function forgot()
    {
        return view('pages.web.auth.forgot');
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
            return redirect()->back()->withErrors($validator)->withInput();
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
        toast()->success(null, 'Silahkan cek email anda')->showCloseButton(true)->autoClose(8000);
        return redirect()->back()->with('success', 'Silahkan cek email anda');
    }

    public function reset($token)
    {
        return view('pages.web.auth.reset', compact('token'));
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
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($updatePassword) {
            User::where('email', $updatePassword->email)->update(['password' => Hash::make($request->password)]);
            Notification::send(User::where('email', $updatePassword->email)->first(), new PasswordResetedNotification(User::where('email', $updatePassword->email)->first()));
            PasswordReset::where(['email' => $updatePassword->email])->delete();
            toast()->success(null, 'Password berhasil diubah. Silahkan login kembali')->showCloseButton(true)->autoClose(8000);
            return redirect()->route('web.auth.index')->with('success', 'Password berhasil diubah. Silahkan login kembali');
        } else {
            toast()->error(null, 'Token tidak valid')->showCloseButton(true)->autoClose(8000);
            return redirect()->route('web.auth.index')->with('error', 'Token tidak valid');
        }
    }

    public function do_logout()
    {
        Auth::logout();
        return redirect()->route('web.auth.index');
    }
}

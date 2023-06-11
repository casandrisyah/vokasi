<?php

namespace App\Http\Controllers\Office;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Default\PasswordReset;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use App\Notifications\PasswordResetedNotification;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('do_logout');
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
        return response()->json([
            'alert' => 'error',
            'message' => 'Kredensial yang diberikan tidak cocok dengan catatan kami.'
        ]);
    }
    public function do_forgot(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }
        (Password::sendResetLink($request->only('email')) === Password::RESET_LINK_SENT ?
            response()->json([
                'alert' => 'success',
                'message' => __(Password::RESET_LINK_SENT)
            ]) :
            response()->json([
                'alert' => 'error',
                'message' => 'Gagal mengirim email'
            ])
        );
    }
    public function do_reset(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'token' => 'required|exists:password_resets',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|min:8'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }
        (($updatePassword = PasswordReset::where(['token' => $request->token])->first()) ?
        (function() use($request, $updatePassword) {
            \App\Models\People\User::where('email', $updatePassword->email)->update(['password' => Hash::make($request->password)]);
            Notification::send(\App\Models\People\User::where('email', $updatePassword->email)->first(), new PasswordResetedNotification(\App\Models\People\User::where('email', $updatePassword->email)->first()));
            PasswordReset::where(['email' => $updatePassword->email])->delete();
            return response()->json([
                'alert' => 'success',
                'message' => 'Password berhasil diubah'
            ]);
        }) :
        response()->json([
            'alert' => 'error',
            'message' => 'Token tidak ditemukan'
        ]));
    }
    public function do_logout()
    {
        Auth::logout();
        return redirect()->route('office.auth.index');
    }
}

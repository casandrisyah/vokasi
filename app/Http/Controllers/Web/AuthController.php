<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
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
            'email.required' => 'email atau password yang anda masukkan tidak sesuai, silahkan isi kembali.',
            'email.email' => 'email atau password yang anda masukkan tidak sesuai, silahkan isi kembali.',
            'password.required' => 'email atau password yang anda masukkan tidak sesuai, silahkan isi kembali.',
            'password.min' => 'email atau password yang anda masukkan tidak sesuai, silahkan isi kembali.',
            'password.confirmed' => 'email atau password yang anda masukkan tidak sesuai, silahkan isi kembali.',
        ];

        $validation = Validator::make($request->all(), $rules, $messages);

        if ($validation->fails()) {
            return redirect()->back()->withErrors($validation)->withInput();
        } else {
            if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
                // toast()->success(null, 'Login berhasil!')->showCloseButton(true)->autoClose(5000)->width('300px');
                return redirect()->route('office.dashboard.index')->with('success', 'Login berhasil!');
            } else {
                session('error', 'email atau password yang anda masukkan tidak sesuai, silahkan isi kembali.');
                return redirect()->back()->withInput()->with('error', 'email atau password yang anda masukkan tidak sesuai, silahkan isi kembali.');
            }
        }

    }

    public function do_logout()
    {
        Auth::logout();
        return redirect()->route('web.auth.index');
    }
}

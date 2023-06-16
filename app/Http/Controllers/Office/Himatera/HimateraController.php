<?php

namespace App\Http\Controllers\Office\Himatera;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Timeline\Activity;
use App\Http\Controllers\Controller;
use App\Models\Civitas\User;
use App\Notifications\Web\PasswordResetedNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HimateraController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $collection = Activity::where('category', 'himatera')->paginate(10);
            return view('pages.app.himatera.activity.list',compact('collection'));
        }
        return view('pages.app.himatera.activity.main');
    }

    public function create()
    {
        return view('pages.app.himatera.activity.input', ['data' => new Activity]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'gambar' => 'required',
            'tanggal' => 'required',
            'description' => 'required',
            'lokasi' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }
        $activity = new Activity;
        $activity->title = $request->judul;
        $activity->category = 'himatera';
        $activity->slug = Str::slug($request->judul);
        if(request()->file('gambar')){
            // Storage::delete($organization->thumbnail);
            $file = request()->file('gambar')->store("public/activity");
            $activity->thumbnail = $file;
        }
        $activity->date = $request->tanggal;
        $activity->type = $request->jenis_kegiatan;
        $activity->location = $request->lokasi;
        $activity->url = $request->link_pendaftaran;
        $activity->description = $request->description;
        $activity->user_id = Auth::user()->id;
        $activity->st = true;
        $activity->save();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil ditambahkan',
        ], 200);
    }

    public function show(Activity $activity)
    {
        //
    }

    public function edit(Activity $activity)
    {
        return view('pages.app.himatera.activity.input', ['data' => $activity]);
    }

    public function update(Request $request, Activity $activity)
    {
        if ($request->is_active !== null) {
            $activity->is_active = $request->is_active;
            $message = 'Data berhasil diaktifkan';
            if ($request->is_active == 0) {
                $message = 'Data berhasil dinonaktifkan';
            }
            $activity->update();
            return response()->json([
                'alert' => 'success',
                'message' => $message,
            ]);
        }
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'tanggal' => 'required',
            'lokasi' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }
        $activity->title = $request->judul;
        $activity->category = 'himatera';
        $activity->slug = Str::slug($request->judul);
        if(request()->file('gambar')){
            Storage::delete($activity->thumbnail);
            $file = request()->file('gambar')->store("public/activity");
            $activity->thumbnail = $file;
        }
        $activity->date = $request->tanggal;
        $activity->type = $request->jenis_kegiatan;
        $activity->location = $request->lokasi;
        $activity->url = $request->link_pendaftaran;
        $activity->description = $request->description;
        $activity->update();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil diperbaharui',
        ], 200);
    }

    public function destroy(Activity $activity)
    {
        Storage::delete($activity->thumbnail);
        $activity->delete();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil dihapus',
        ]);
    }

    public function change_password()
    {
        $himatera = User::where('id', Auth::user()->id)->first();
        return view('pages.app.himatera.change_password.input', ['himatera' => $himatera]);
    }

    public function update_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|min:8',
            'password_confirmation' => 'required|min:8',
        ],[
            'old_password.required' => 'Password lama tidak boleh kosong',
            'new_password.required' => 'Password baru tidak boleh kosong',
            'new_password.min' => 'Password baru minimal 8 karakter',
            'password_confirmation.required' => 'Konfirmasi password tidak boleh kosong',
            'password_confirmation.min' => 'Konfirmasi password minimal 8 karakter',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }

        $himatera = User::where('id', Auth::user()->id)->first();
        if (!Hash::check($request->old_password, $himatera->password)) {
            return response()->json([
                'alert' => 'error',
                'message' => 'Password lama tidak sesuai',
            ], 200);
        }
        if ($request->new_password != $request->password_confirmation) {
            return response()->json([
                'alert' => 'error',
                'message' => 'Password baru tidak sama dan konfirmasi password tidak sama',
            ], 200);
        }
        $himatera->password = Hash::make($request->new_password);
        $himatera->update();
        $data = [
            'message' => 'Password berhasil diubah. Silahkan login dengan password baru Anda',
        ];
        session()->flash('session_data', $data);
        Notification::send($himatera, new PasswordResetedNotification($himatera));
        Auth::logout();
        return response()->json([
            'alert' => 'success',
            'message' => 'Password berhasil diubah.',
        ]);
    }
}

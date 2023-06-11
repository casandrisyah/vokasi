<?php

namespace App\Http\Controllers\Office\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account\User as Himatif;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HimatifController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $collection = Himatif::where('role', 7)->paginate(10);
            return view('pages.app.account.himatif.list', compact('collection'));
        }
        return view('pages.app.account.himatif.main');
    }

    public function create()
    {
        return view('pages.app.account.himatif.input', ['data' => new Himatif]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }

        $himatif = new Himatif();
        $himatif->name = $request->name;
        $himatif->email = $request->email;
        $himatif->position = 'Himatif';
        $himatif->password = Hash::make($request->password);
        $himatif->role = '7';
        $himatif->save();

        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil ditambahkan',
        ], 200);
    }

    public function show(Himatif $himatif)
    {
        //
    }

    public function edit(Himatif $himatif)
    {
        return view('pages.app.account.himatif.input', ['data' => $himatif]);
    }

    public function update(Request $request, himatif $himatif)
    {
        if ($request->is_active !== null) {
            $himatif->is_active = $request->is_active;
            $message = 'Data berhasil diaktifkan';
            if ($request->is_active == 0) {
                $message = 'Data berhasil dinonaktifkan';
            }
            $himatif->update();
            return response()->json([
                'alert' => 'success',
                'message' => $message,
            ]);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }

        $himatif->name = $request->name;
        $himatif->email = $request->email;
        $himatif->position = 'Himatif';
        $himatif->password = $request->password ? Hash::make($request->password) : $himatif->password;
        $himatif->update();

        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil diperbaharui',
        ], 200);
    }

    public function destroy(Himatif $himatif)
    {
        if ($himatif->avatar != null) {
            Storage::delete($himatif->avatar);
        }
        $himatif->delete();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil dihapus',
        ], 200);
    }
}

<?php

namespace App\Http\Controllers\Office\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account\User as Himatek;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HimatekController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $collection = Himatek::where('role', 6)->paginate(10);
            return view('pages.app.account.himatek.list', compact('collection'));
        }
        return view('pages.app.account.himatek.main');
    }

    public function create()
    {
        return view('pages.app.account.himatek.input', ['data' => new Himatek]);
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

        $himatek = new Himatek();
        $himatek->name = $request->name;
        $himatek->email = $request->email;
        $himatek->position = 'Himatek';
        $himatek->password = Hash::make($request->password);
        $himatek->role = '6';
        $himatek->save();

        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil ditambahkan',
        ], 200);
    }

    public function show(Himatek $himatek)
    {
        //
    }

    public function edit(Himatek $himatek)
    {
        return view('pages.app.account.himatek.input', ['data' => $himatek]);
    }

    public function update(Request $request, Himatek $himatek)
    {
        if ($request->is_active !== null) {
            $himatek->is_active = $request->is_active;
            $message = 'Data berhasil diaktifkan';
            if ($request->is_active == 0) {
                $message = 'Data berhasil dinonaktifkan';
            }
            $himatek->update();
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

        $himatek->name = $request->name;
        $himatek->email = $request->email;
        $himatek->position = 'Himatek';
        $himatek->password = $request->password ? Hash::make($request->password) : $himatek->password;
        $himatek->update();

        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil diperbaharui',
        ], 200);
    }

    public function destroy(Himatek $himatek)
    {
        if ($himatek->avatar != null) {
            Storage::delete($himatek->avatar);
        }
        $himatek->delete();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil dihapus',
        ], 200);
    }
}

<?php

namespace App\Http\Controllers\Office\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account\User as Himatera;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HimateraController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $collection = Himatera::where('role', 8)->paginate(10);
            return view('pages.app.account.himatera.list', compact('collection'));
        }
        return view('pages.app.account.himatera.main');
    }

    public function create()
    {
        return view('pages.app.account.himatera.input', ['data' => new Himatera]);
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

        $himatera = new Himatera();
        $himatera->name = $request->name;
        $himatera->email = $request->email;
        $himatera->position = 'Himatera';
        $himatera->password = Hash::make($request->password);
        $himatera->role = '8';
        $himatera->save();

        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil ditambahkan',
        ], 200);
    }

    public function show(Himatera $himatera)
    {
        //
    }

    public function edit(Himatera $himatera)
    {
        return view('pages.app.account.himatera.input', ['data' => $himatera]);
    }

    public function update(Request $request, Himatera $himatera)
    {
        if ($request->is_active !== null) {
            $himatera->is_active = $request->is_active;
            $message = 'Data berhasil diaktifkan';
            if ($request->is_active == 0) {
                $message = 'Data berhasil dinonaktifkan';
            }
            $himatera->update();
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

        $himatera->name = $request->name;
        $himatera->email = $request->email;
        $himatera->position = 'Himatera';
        $himatera->password = $request->password ? Hash::make($request->password) : $himatera->password;
        $himatera->update();

        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil diperbaharui',
        ], 200);
    }

    public function destroy(Himatera $himatera)
    {
        if ($himatera->avatar != null) {
            Storage::delete($himatera->avatar);
        }
        $himatera->delete();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil dihapus',
        ], 200);
    }
}

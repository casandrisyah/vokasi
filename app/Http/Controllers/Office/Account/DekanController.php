<?php

namespace App\Http\Controllers\Office\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account\User as Dekan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DekanController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $collection = Dekan::where('role', 2)->paginate(10);
            return view('pages.app.account.dekan.list', compact('collection'));
        }
        return view('pages.app.account.dekan.main');
    }

    public function create()
    {
        return view('pages.app.account.dekan.input', ['data' => new Dekan]);
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

        $dekan = new Dekan();
        $dekan->name = $request->name;
        $dekan->email = $request->email;
        $dekan->position = 'Dekan Fakultas Vokasi';
        $dekan->password = Hash::make($request->password);
        $dekan->role = '2';
        $dekan->save();

        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil ditambahkan',
        ], 200);
    }

    public function show(Dekan $dekan)
    {
        //
    }

    public function edit(Dekan $dekan)
    {
        return view('pages.app.account.dekan.input', ['data' => $dekan]);
    }

    public function update(Request $request, Dekan $dekan)
    {
        if ($request->is_active !== null) {
            $dekan->is_active = $request->is_active;
            $message = 'Data berhasil diaktifkan';
            if ($request->is_active == 0) {
                $message = 'Data berhasil dinonaktifkan';
            }
            $dekan->update();
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

        $dekan->name = $request->name;
        $dekan->email = $request->email;
        $dekan->position = 'Dekan Fakultas Vokasi';
        $dekan->password = $request->password ? Hash::make($request->password) : $dekan->password;
        $dekan->update();

        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil diperbaharui',
        ], 200);
    }

    public function destroy(Dekan $dekan)
    {
        if ($dekan->avatar != null) {
            Storage::delete($dekan->avatar);
        }
        $dekan->delete();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil dihapus',
        ], 200);
    }
}

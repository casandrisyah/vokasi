<?php

namespace App\Http\Controllers\Office\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account\User as KAProdi;
use App\Models\Account\UserCategory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class KAProdiController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $collection = KAProdi::where('role', 3)->paginate(10);
            return view('pages.app.account.ka_prodi.list', compact('collection'));
        }
        return view('pages.app.account.ka_prodi.main');
    }

    public function create()
    {
        $category = UserCategory::where('role', 3)->where('is_active', 1)->get();
        return view('pages.app.account.ka_prodi.input', ['data' => new KAProdi, 'category' => $category]);
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

        $ka_prodi = new KAProdi();
        $ka_prodi->name = $request->name;
        $ka_prodi->email = $request->email;
        $ka_prodi->position = $request->position;
        $ka_prodi->password = Hash::make($request->password);
        $ka_prodi->role = '3';
        $ka_prodi->save();

        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil ditambahkan',
        ], 200);
    }

    public function show(KAProdi $ka_prodi)
    {
        //
    }

    public function edit(KAProdi $ka_prodi)
    {
        $category = UserCategory::where('role', 3)->where('is_active', 1)->get();
        return view('pages.app.account.ka_prodi.input', ['data' => $ka_prodi, 'category' => $category]);
    }

    public function update(Request $request, KAProdi $ka_prodi)
    {
        if ($request->is_active !== null) {
            $ka_prodi->is_active = $request->is_active;
            $message = 'Data berhasil diaktifkan';
            if ($request->is_active == 0) {
                $message = 'Data berhasil dinonaktifkan';
            }
            $ka_prodi->update();
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

        $ka_prodi->name = $request->name;
        $ka_prodi->email = $request->email;
        $ka_prodi->position = $request->position;
        $ka_prodi->password ? Hash::make($request->password) : $ka_prodi->password;
        $ka_prodi->update();

        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil diperbaharui',
        ], 200);
    }

    public function destroy(KAProdi $ka_prodi)
    {
        if ($ka_prodi->avatar != null) {
            Storage::delete($ka_prodi->avatar);
        }
        $ka_prodi->delete();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil dihapus',
        ], 200);
    }
}

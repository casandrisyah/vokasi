<?php

namespace App\Http\Controllers\Office\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account\User as Himpunan;
use App\Models\Account\UserCategory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HimpunanController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $collection = Himpunan::where('role', 6)->paginate(10);
            return view('pages.app.account.himpunan.list', compact('collection'));
        }
        return view('pages.app.account.himpunan.main');
    }

    public function create()
    {
        $category = UserCategory::where('role', 6)->where('is_active', 1)->get();
        return view('pages.app.account.himpunan.input', ['data' => new Himpunan(), 'category' => $category]);
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

        $himpunan = new Himpunan();
        $himpunan->name = $request->name;
        $himpunan->email = $request->email;
        $himpunan->position = $request->position;
        $himpunan->password = Hash::make($request->password);
        $himpunan->role = '6';
        $himpunan->save();

        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil ditambahkan',
        ], 200);
    }

    public function show(Himpunan $himpunan)
    {
        //
    }

    public function edit(Himpunan $himpunan)
    {
        $category = UserCategory::where('role', 6)->where('is_active', 1)->get();
        return view('pages.app.account.himpunan.input', ['data' => $himpunan, 'category' => $category]);
    }

    public function update(Request $request, Himpunan $himpunan)
    {
        if ($request->is_active !== null) {
            $himpunan->is_active = $request->is_active;
            $message = 'Data berhasil diaktifkan';
            if ($request->is_active == 0) {
                $message = 'Data berhasil dinonaktifkan';
            }
            $himpunan->update();
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

        $himpunan->name = $request->name;
        $himpunan->email = $request->email;
        $himpunan->position = $request->position;
        $himpunan->password = $request->password ? Hash::make($request->password) : $himpunan->password;
        $himpunan->update();

        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil diperbaharui',
        ], 200);
    }

    public function destroy(Himpunan $himpunan)
    {
        if ($himpunan->avatar != null) {
            Storage::delete($himpunan->avatar);
        }
        $himpunan->delete();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil dihapus',
        ], 200);
    }
}

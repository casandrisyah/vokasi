<?php

namespace App\Http\Controllers\Office\Civitas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Account\UserCategory;
use Illuminate\Support\Facades\Hash;
use App\Models\Civitas\User AS Dosen;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DosenController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $collection = Dosen::where('role', 4)->paginate(10);
            return view('pages.app.civitas.dosen.list', compact('collection'));
        }
        return view('pages.app.civitas.dosen.main');
    }

    public function create()
    {
        $category = UserCategory::where('role', 4)->where('is_active', 1)->get();
        return view('pages.app.civitas.dosen.input', ['data' => new Dosen, 'category' => $category]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'user_category_id' => 'required'
        ],[
            'name.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password tidak boleh kosong',
            'user_category_id.required' => 'Porgram Studi tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }

        $dosen = new Dosen;
        $dosen->name = $request->name;
        $dosen->email = $request->email;
        $dosen->password = Hash::make($request->password);
        $dosen->user_category_id = $request->user_category_id;
        $dosen->role = '4';
        $dosen->save();

        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil ditambahkan',
        ], 200);
    }

    public function show(Dosen $dosen)
    {
        //
    }

    public function edit(Dosen $dosen)
    {
        $category = UserCategory::where('role', 4)->where('is_active', 1)->get();
        return view('pages.app.civitas.dosen.input', ['data' => $dosen, 'category' => $category]);
    }

    public function update(Request $request, Dosen $dosen)
    {
        if ($request->is_active !== null) {
            $dosen->is_active = $request->is_active;
            $message = 'Data berhasil diaktifkan';
            if ($request->is_active == 0) {
                $message = 'Data berhasil dinonaktifkan';
            }
            $dosen->update();
            return response()->json([
                'alert' => 'success',
                'message' => $message,
            ]);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'user_category_id' => 'required'
        ],[
            'name.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'user_category_id.required' => 'Porgram Studi tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }

        $dosen->name = $request->name;
        $dosen->email = $request->email;
        $dosen->user_category_id = $request->user_category_id;
        $dosen->password = $request->password ? Hash::make($request->password) : $dosen->password;
        $dosen->update();

        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil diperbaharui',
        ], 200);
    }

    public function destroy(Dosen $dosen)
    {
        $dosen->deleteDosen();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil dihapus',
        ], 200);
    }

    public function overview(Dosen $dosen)
    {
        return view('pages.app.civitas.dosen.profile.overview.input', ['data' => $dosen]);
    }

    public function edit_overview(Request $request, Dosen $dosen)
    {
        $validator = Validator::make($request->all(), [
            'biografi' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }

        $dosen->biografi = $request->biografi;
        $dosen->update();

        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil diperbaharui',
        ], 200);
    }

    public function about(Dosen $dosen)
    {
        return view('pages.app.civitas.dosen.profile.about.input', ['data' => $dosen]);
    }

    public function edit_about(Request $request, Dosen $dosen)
    {
        $validator = Validator::make($request->all(), [
            'bio' => 'required',
        ],[
            'bio.required' => 'Kata Kunci tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }

        $dosen->bio = $request->bio;
        $dosen->update();

        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil diperbaharui',
        ], 200);
    }

    public function ikhtisar(Dosen $dosen)
    {
        return view('pages.app.civitas.dosen.profile.ikhtisar.input', ['data' => $dosen]);
    }

    public function edit_ikhtisar(Request $request, Dosen $dosen)
    {
        $validator = Validator::make($request->all(), [
            'ikhtisar' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }

        $dosen->ikhtisar = $request->ikhtisar;
        $dosen->update();

        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil diperbaharui',
        ], 200);
    }

    public function personal(Dosen $dosen)
    {
        $category = UserCategory::where('role', 4)->where('is_active', 1)->get();
        return view('pages.app.civitas.dosen.profile.personal.input', ['data' => $dosen, 'category' => $category]);
    }

    public function edit_personal(Request $request, Dosen $dosen)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'user_category_id' => 'required',
            'nidn' => 'required',
            'sinta_id' => 'required',
        ],[
            'name.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'user_category_id.required' => 'Porgram Studi tidak boleh kosong',
            'nidn.required' => 'NIDN tidak boleh kosong',
            'sinta_id.required' => 'Sinta ID tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }

        $dosen->name = $request->name;
        $dosen->user_category_id = $request->user_category_id;
        $dosen->email = $request->email;
        $dosen->phone = $request->phone;
        $dosen->nidn = $request->nidn;
        $dosen->sinta_id = $request->sinta_id;
        $dosen->place_birth = $request->place_birth;
        $dosen->date_birth = $request->date_birth;
        $dosen->skill = $request->skill;
        $dosen->url = $request->url;
        $dosen->position = $request->position;
        if ($request->file('avatar')) {
            if ($dosen->avatar != null){
                Storage::delete($dosen->avatar);
            }
            $file = $request->file('avatar')->store('public/dosen');
            $dosen->avatar = $file;
        }
        $dosen->update();

        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil diperbaharui',
        ], 200);
    }
}

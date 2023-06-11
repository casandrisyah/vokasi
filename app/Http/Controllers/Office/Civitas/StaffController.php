<?php

namespace App\Http\Controllers\Office\Civitas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Account\UserCategory;
use Illuminate\Support\Facades\Hash;
use App\Models\Civitas\User AS Staff;
use App\Models\Profil\Background;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $collection = Staff::where('role', 5)->paginate(10);
            return view('pages.app.civitas.staff.list', compact('collection'));
        }
        return view('pages.app.civitas.staff.main');
    }

    public function create()
    {
        $category = UserCategory::where('role', 5)->where('is_active', 1)->get();
        return view('pages.app.civitas.staff.input', ['data' => new Staff, 'category' => $category]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
        ],[
            'name.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'email.unique' => 'Email sudah terdaftar',
            'password.required' => 'Password tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }
        $staff = new Staff();
        $staff->name = $request->name;
        $staff->email = $request->email;
        $staff->user_category_id = $request->user_category_id;
        $position = UserCategory::where('id', $request->user_category_id)->first();
        $staff->position = $position->name ? $position->name : '';
        $staff->password = Hash::make($request->password);
        $staff->role = '5';
        $staff->save();

        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil ditambahkan',
        ], 200);
    }

    public function edit(Staff $staff)
    {
        $category = UserCategory::where('role', 5)->where('is_active', 1)->get();
        return view('pages.app.civitas.staff.input', ['data' => $staff, 'category' => $category]);
    }

    public function update(Request $request, Staff $staff)
    {
        if ($request->is_active !== null) {
            $staff->is_active = $request->is_active;
            $message = 'Data berhasil diaktifkan';
            if ($request->is_active == 0) {
                $message = 'Data berhasil dinonaktifkan';
            }
            $staff->update();
            return response()->json([
                'alert' => 'success',
                'message' => $message,
            ]);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
        ],[
            'name.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }

        $staff->name = $request->name;
        $staff->email = $request->email;
        $staff->user_category_id = $request->user_category_id;
        $position = UserCategory::where('id', $request->user_category_id)->first();
        $staff->position = $position->name ? $position->name : '';
        $staff->password = $request->password ? Hash::make($request->password) : $staff->password;
        $staff->update();

        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil diperbaharui',
        ], 200);
    }

    public function destroy(Staff $staff)
    {
        $staff->deleteStaff();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil dihapus',
        ], 200);
    }

    public function identitas_staf(Staff $staff)
    {
        $category = UserCategory::where('role', 5)->where('is_active', 1)->get();
        return view('pages.app.civitas.staff.profile.personal.input', ['data' => $staff, 'category' => $category]);
    }

    public function update_identitas_staf(Request $request, Staff $staff)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'employee_id' => 'required',
            'user_category_id' => 'required',
        ],[
            'name.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'employee_id.required' => 'ID Karyawan tidak boleh kosong',
            'user_category_id.required' => 'Posisi tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }

        $staff->name = $request->name;
        $staff->email = $request->email;
        $staff->employee_id = $request->employee_id;
        $staff->phone = $request->phone;
        $staff->place_birth = $request->place_birth;
        $staff->date_birth = $request->date_birth;
        $staff->skill = $request->skill;
        $position = UserCategory::where('id', $request->user_category_id)->first();
        $staff->position = $position->name;
        $staff->user_category_id = $request->user_category_id;
        if ($request->file('avatar')) {
            if ($staff->avatar != null){
                Storage::delete($staff->avatar);
            }
            $file = $request->file('avatar')->store('public/staff');
            $staff->avatar = $file;
        }
        $staff->update();

        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil diperbaharui',
        ], 200);
    }

    public function latar_staf(Staff $staff)
    {
        return view('pages.app.civitas.staff.profile.background.input', ['staff' => $staff, 'data' => new Background()]);
    }

    public function store_latar_staf(Request $request, Staff $staff)
    {
        $background = new Background();
        $background->user_id = $staff->id;
        $background->keyword = $request->keyword;
        $background->save();

        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil diperbaharui',
        ], 200);
    }

    public function edit_latar_staff(Staff $staff)
    {
        $data = Background::where('user_id', $staff->id)->first();
        return view('pages.app.civitas.staff.profile.background.input', ['staff' => $staff, 'data' => $data]);
    }

    public function update_latar_staff(Request $request, Staff $staff, Background $background)
    {
        $background = Background::where('user_id', $staff->id)->first();
        $background->keyword = $request->keyword;
        $background->update();

        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil diperbaharui',
        ], 200);
    }

    public function tentang_staff(Staff $staff)
    {
        return view('pages.app.civitas.staff.profile.about.input', ['data' => $staff]);
    }

    public function update_tentang_staff(Request $request, Staff $staff) {
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
        $staff->bio = $request->bio;
        $staff->update();

        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil diperbaharui',
        ], 200);
    }
}

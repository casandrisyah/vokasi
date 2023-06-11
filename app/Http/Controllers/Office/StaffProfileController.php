<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Models\Account\UserCategory;
use Illuminate\Http\Request;
use App\Models\Civitas\User AS Staff;
use App\Models\Profil\Education;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class StaffProfileController extends Controller
{
    public function identitas_staff()
    {
        $staff = Staff::where('id', Auth::user()->id)->first();
        $category = UserCategory::where('role', 5)->where('is_active', 1)->get();
        return view('pages.app.staff_profile.personal.input', ['data' => $staff, 'category' => $category]);
    }

    public function update_identitas_staff(Request $request)
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

        $staff = Staff::where('id', Auth::user()->id)->first();
        $staff->name = $request->name;
        $staff->email = $request->email;
        $staff->phone = $request->phone;
        $staff->employee_id = $request->employee_id;
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

    public function pendidikan(Request $request)
    {
        $staff = Staff::where('id', Auth::user()->id)->first();
        if($request->ajax()){
            $collection = Education::where('user_id', $staff->id)->paginate(10);
            return view('pages.app.staff_profile.education.list', compact('collection'));
        }
        return view('pages.app.staff_profile.education.main', compact('staff'));
    }

    public function create_pendidikan()
    {
        $staff = Staff::where('id', Auth::user()->id)->first();
        return view('pages.app.staff_profile.education.input', ['staff' => $staff, 'data' => new Education]);
    }

    public function store_pendidikan(Request $request) {
        $validator = Validator::make($request->all(), [
            'year' => 'required|numeric',
            'knowledge_field' => 'required',
            'university' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }

        $education = new Education();
        $education->user_id = $request->user_id;
        $education->year = $request->year;
        $education->knowledge_field = $request->knowledge_field;
        $education->university = $request->university;
        $education->save();

        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil diperbaharui',
        ], 200);
    }

    public function edit_pendidikan(Education $education)
    {
        $staff = Staff::where('id', Auth::user()->id)->first();
        return view('pages.app.staff_profile.education.input', ['data' => $education, 'staff' => $staff]);
    }

    public function update_pendidikan(Request $request, Education $education)
    {
        if ($request->is_active !== null) {
            $education->is_active = $request->is_active;
            $message = 'Data berhasil diaktifkan';
            if ($request->is_active == 0) {
                $message = 'Data berhasil dinonaktifkan';
            }
            $education->update();
            return response()->json([
                'alert' => 'success',
                'message' => $message,
            ]);
        }
        $validator = Validator::make($request->all(), [
            'year' => 'required|numeric',
            'knowledge_field' => 'required',
            'university' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }

        $education->user_id = $request->user_id;
        $education->year = $request->year;
        $education->knowledge_field = $request->knowledge_field;
        $education->university = $request->university;
        $education->update();

        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil diperbaharui',
        ], 200);
    }

    public function destroy_pendidikan(Education $education)
    {
        $education->delete();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil dihapus',
        ], 200);
    }

    public function tentang_staff()
    {
        $staff = Staff::where('id', Auth::user()->id)->first();
        return view('pages.app.staff_profile.about.input', ['data' => $staff]);
    }

    public function update_tentang_staff(Request $request) {
        $staff = Staff::where('id', Auth::user()->id)->first();
        $staff->bio = $request->bio;
        $staff->update();

        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil diperbaharui',
        ], 200);
    }
}

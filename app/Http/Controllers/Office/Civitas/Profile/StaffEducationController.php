<?php

namespace App\Http\Controllers\Office\Civitas\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Civitas\User AS Staff;
use App\Models\Profil\Education;
use Illuminate\Support\Facades\Validator;

class StaffEducationController extends Controller
{
    public function index(Request $request, Staff $staff)
    {
        $staff = Staff::find($staff->id);
        // dd($staff);
        if($request->ajax()){
            $collection = Education::where('user_id', $staff->id)->paginate(10);
            return view('pages.app.civitas.staff.profile.education.list', compact('collection', 'staff'));
        }
        return view('pages.app.civitas.staff.profile.education.main', ['staff' => $staff]);
    }

    public function create(staff $staff)
    {
        return view('pages.app.civitas.staff.profile.education.input', ['staff' => $staff, 'data' => new Education]);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'year' => 'required',
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

    public function edit(Staff $staff, Education $education)
    {
        return view('pages.app.civitas.staff.profile.education.input', ['data' => $education, 'staff' => $staff]);
    }

    public function update(Request $request, Education $education)
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
            'year' => 'required',
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

    public function destroy(Education $education)
    {
        $education->delete();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil dihapus',
        ], 200);
    }
}

<?php

namespace App\Http\Controllers\Office\Civitas\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Civitas\User as Staff;
use App\Models\Profil\StaffTeaching;
use Illuminate\Support\Facades\Validator;

class StaffTeachingController extends Controller
{
    public function index(Request $request, Staff $staff)
    {
        $staff = Staff::find($staff->id);
        // dd($staff);
        if($request->ajax()){
            $collection = StaffTeaching::where('user_id', $staff->id)->paginate(10);
            return view('pages.app.civitas.staff.profile.staff_teaching.list', compact('collection', 'staff'));
        }
        return view('pages.app.civitas.staff.profile.staff_teaching.main', ['staff' => $staff]);
    }

    public function staff_teaching(Request $request)
    {
        $staff = Staff::find(auth()->user()->id);
        // dd($staff);
        if($request->ajax()){
            $collection = StaffTeaching::where('user_id', $staff->id)->paginate(10);
            return view('pages.app.staff_profile.staff_teaching.list', compact('collection', 'staff'));
        }
        return view('pages.app.staff_profile.staff_teaching.main', ['staff' => $staff]);
    }

    public function create(Staff $staff)
    {
        return view('pages.app.civitas.staff.profile.staff_teaching.input', ['staff' => $staff, 'data' => new StaffTeaching()]);
    }

    public function create_teaching()
    {
        $staff = Staff::find(auth()->user()->id);
        return view('pages.app.staff_profile.staff_teaching.input', ['staff' => $staff, 'data' => new StaffTeaching()]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'year' => 'required',
            'subject' => 'required',
            'prodi' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }

        $staff_teaching = new StaffTeaching();
        $staff_teaching->user_id = $request->user_id;
        $staff_teaching->year = $request->year;
        $staff_teaching->subject = $request->subject;
        $staff_teaching->prodi = $request->prodi;
        $staff_teaching->save();

        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil ditambahkan',
        ], 200);
    }

    public function edit(Staff $staff, StaffTeaching $staff_teaching)
    {
        return view('pages.app.civitas.staff.profile.staff_teaching.input', ['staff' => $staff, 'data' => $staff_teaching]);
    }

    public function edit_teaching(StaffTeaching $staff_teaching)
    {
        $staff = Staff::find(auth()->user()->id);
        return view('pages.app.staff_profile.staff_teaching.input', ['staff' => $staff, 'data' => $staff_teaching]);
    }

    public function update(Request $request, StaffTeaching $staff_teaching)
    {
        if ($request->is_active !== null) {
            $staff_teaching->is_active = $request->is_active;
            $message = 'Data berhasil diaktifkan';
            if ($request->is_active == 0) {
                $message = 'Data berhasil dinonaktifkan';
            }
            $staff_teaching->update();
            return response()->json([
                'alert' => 'success',
                'message' => $message,
            ]);
        }
        $validator = Validator::make($request->all(), [
            'year' => 'required',
            'subject' => 'required',
            'prodi' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }

        $staff_teaching->user_id = $request->user_id;
        $staff_teaching->year = $request->year;
        $staff_teaching->subject = $request->subject;
        $staff_teaching->prodi = $request->prodi;
        $staff_teaching->update();

        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil diperbaharui',
        ], 200);
    }

    public function destroy(StaffTeaching $staff_teaching)
    {
        $staff_teaching->delete();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil dihapus',
        ], 200);
    }
}

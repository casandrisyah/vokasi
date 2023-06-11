<?php

namespace App\Http\Controllers\Office\Civitas;

use App\Http\Controllers\Controller;
use App\Models\Account\UserCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StaffCategoryController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $collection = UserCategory::where('role', 5)->paginate(10);
            return view('pages.app.civitas.staff.category.list',compact('collection'));
        }
        return view('pages.app.civitas.staff.category.main');
    }

    public function create()
    {
        return view('pages.app.civitas.staff.category.input', ['data' => new UserCategory]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }
        $category_staff = new UserCategory;
        $category_staff->name = $request->name;
        $category_staff->slug = $request->slug;
        $category_staff->role = 5;
        $category_staff->save();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil disimpan',
        ], 200);
    }

    public function show($id)
    {

    }

    public function edit($id)
    {
        $data = UserCategory::findOrFail($id);
        return view('pages.app.civitas.staff.category.input', ['data' => $data]);
    }

    public function update(Request $request, UserCategory $category_staff)
    {
        if ($request->is_active !== null) {
            $category_staff->is_active = $request->is_active;
            $message = 'Data berhasil diaktifkan';
            if ($request->is_active == 0) {
                $message = 'Data berhasil dinonaktifkan';
            }
            $category_staff->update();
            return response()->json([
                'alert' => 'success',
                'message' => $message,
            ]);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }
        $category_staff->name = $request->name;
        $category_staff->slug = $request->slug;
        $category_staff->role = 5;
        $category_staff->update();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil diperbaharui',
        ], 200);
    }

    public function destroy(UserCategory $category_staff)
    {
        $category_staff->delete();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil dihapus',
        ], 200);
    }
}

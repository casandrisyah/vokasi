<?php

namespace App\Http\Controllers\Office\Civitas;

use App\Http\Controllers\Controller;
use App\Models\Account\UserCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DosenCategoryController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $collection = UserCategory::where('role', 4)->paginate(10);
            return view('pages.app.civitas.dosen.category.list',compact('collection'));
        }
        return view('pages.app.civitas.dosen.category.main');
    }

    public function create()
    {
        return view('pages.app.civitas.dosen.category.input', ['data' => new UserCategory]);
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
        $category_dosen = new UserCategory;
        $category_dosen->name = $request->name;
        $category_dosen->slug = $request->slug;
        $category_dosen->role = 4;
        $category_dosen->save();
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
        return view('pages.app.civitas.dosen.category.input', ['data' => $data]);
    }

    public function update(Request $request, UserCategory $category_dosen)
    {
        if ($request->is_active !== null) {
            $category_dosen->is_active = $request->is_active;
            $message = 'Data berhasil diaktifkan';
            if ($request->is_active == 0) {
                $message = 'Data berhasil dinonaktifkan';
            }
            $category_dosen->update();
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
        $category_dosen->name = $request->name;
        $category_dosen->slug = $request->slug;
        $category_dosen->role = 4;
        $category_dosen->update();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil diperbaharui',
        ], 200);
    }

    public function destroy(UserCategory $category_dosen)
    {
        $category_dosen->delete();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil dihapus',
        ], 200);
    }
}

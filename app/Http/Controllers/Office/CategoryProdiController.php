<?php

namespace App\Http\Controllers\Office;

use Illuminate\Http\Request;
use App\Models\CategoryProdi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CategoryProdiController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $collection = CategoryProdi::paginate(10);
            return view('pages.app.category_prodi.list',compact('collection'));
        }
        return view('pages.app.category_prodi.main');
    }

    public function create()
    {
        return view('pages.app.category_prodi.input', ['data' => new CategoryProdi]);
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
        $category_prodi = new CategoryProdi;
        $category_prodi->name = $request->name;
        $category_prodi->slug = $request->slug;
        $category_prodi->save();
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
        $data = CategoryProdi::findOrFail($id);
        return view('pages.app.category_prodi.input', ['data' => $data]);
    }

    public function update(Request $request, CategoryProdi $category_prodi)
    {
        if ($request->is_active !== null) {
            $category_prodi->is_active = $request->is_active;
            $message = 'Data berhasil diaktifkan';
            if ($request->is_active == 0) {
                $message = 'Data berhasil dinonaktifkan';
            }
            $category_prodi->update();
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
        $category_prodi->name = $request->name;
        $category_prodi->slug = $request->slug;
        $category_prodi->update();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil diperbaharui',
        ], 200);
    }

    public function destroy(CategoryProdi $category_prodi)
    {
        $category_prodi->delete();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil dihapus',
        ], 200);
    }
}

<?php

namespace App\Http\Controllers\Office\Account;

use App\Http\Controllers\Controller;
use App\Models\Account\UserCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KAProdiCategoryController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $collection = UserCategory::where('role', 3)->paginate(10);
            return view('pages.app.account.ka_prodi.category.list',compact('collection'));
        }
        return view('pages.app.account.ka_prodi.category.main');
    }

    public function create()
    {
        return view('pages.app.account.ka_prodi.category.input', ['data' => new UserCategory]);
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
        $category_ka_prodi = new UserCategory;
        $category_ka_prodi->name = $request->name;
        $category_ka_prodi->slug = $request->slug;
        $category_ka_prodi->role = 3;
        $category_ka_prodi->save();
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
        return view('pages.app.account.ka_prodi.category.input', ['data' => $data]);
    }

    public function update(Request $request, UserCategory $category_ka_prodi)
    {
        if ($request->is_active !== null) {
            $category_ka_prodi->is_active = $request->is_active;
            $message = 'Data berhasil diaktifkan';
            if ($request->is_active == 0) {
                $message = 'Data berhasil dinonaktifkan';
            }
            $category_ka_prodi->update();
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
        $category_ka_prodi->name = $request->name;
        $category_ka_prodi->slug = $request->slug;
        $category_ka_prodi->role = 3;
        $category_ka_prodi->update();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil diperbaharui',
        ], 200);
    }

    public function destroy(UserCategory $category_ka_prodi)
    {
        $category_ka_prodi->delete();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil dihapus',
        ], 200);
    }
}

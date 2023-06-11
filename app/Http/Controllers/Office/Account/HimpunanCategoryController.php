<?php

namespace App\Http\Controllers\Office\Account;

use App\Http\Controllers\Controller;
use App\Models\Account\UserCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HimpunanCategoryController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $collection = UserCategory::where('role', 6)->paginate(10);
            return view('pages.app.account.himpunan.category.list',compact('collection'));
        }
        return view('pages.app.account.himpunan.category.main');
    }

    public function create()
    {
        return view('pages.app.account.himpunan.category.input', ['data' => new UserCategory]);
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
        $category_himpunan = new UserCategory;
        $category_himpunan->name = $request->name;
        $category_himpunan->slug = $request->slug;
        $category_himpunan->role = 6;
        $category_himpunan->save();
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
        return view('pages.app.account.himpunan.category.input', ['data' => $data]);
    }

    public function update(Request $request, UserCategory $category_himpunan)
    {
        if ($request->is_active !== null) {
            $category_himpunan->is_active = $request->is_active;
            $message = 'Data berhasil diaktifkan';
            if ($request->is_active == 0) {
                $message = 'Data berhasil dinonaktifkan';
            }
            $category_himpunan->update();
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
        $category_himpunan->name = $request->name;
        $category_himpunan->slug = $request->slug;
        $category_himpunan->role = 6;
        $category_himpunan->update();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil diperbaharui',
        ], 200);
    }

    public function destroy(UserCategory $category_himpunan)
    {
        $category_himpunan->delete();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil dihapus',
        ], 200);
    }
}

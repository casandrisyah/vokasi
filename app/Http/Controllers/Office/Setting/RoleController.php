<?php

namespace App\Http\Controllers\Office\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoleController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $collection = Role::paginate(10);
            return view('pages.app.setting.role.list', compact('collection'));
        }
        return view('pages.app.setting.role.main');
    }

    public function create()
    {
        return view('pages.app.setting.role.input', ['data' => new Role]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:roles',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }

        $role = new Role();
        $role->name = $request->name;
        $role->guard_name = 'web';
        $role->save();

        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil ditambahkan',
        ], 200);
    }

    public function show(Role $role)
    {
        //
    }

    public function edit(Role $role)
    {
        return view('pages.app.setting.role.input', ['data' => $role]);
    }

    public function update(Request $request, Role $role)
    {
        if ($request->is_active !== null) {
            $role->is_active = $request->is_active;
            $message = 'Data berhasil diaktifkan';
            if ($request->is_active == 0) {
                $message = 'Data berhasil dinonaktifkan';
            }
            $role->update();
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

        $role->name = $request->name;
        $role->update();

        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil diperbaharui',
        ], 200);
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil dihapus',
        ], 200);
    }
}

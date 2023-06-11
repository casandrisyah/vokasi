<?php

namespace App\Http\Controllers\Office\About;

use Illuminate\Http\Request;
use App\Models\About\Organization;
use App\Http\Controllers\Controller;
use App\Models\Setting\Role;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $collection = Organization::paginate(10);
            return view('pages.app.about.organization.list',compact('collection'));
        }
        return view('pages.app.about.organization.main');
    }

    public function create()
    {
        $role = Role::all();
        return view('pages.app.about.organization.input', ['data' => new Organization, 'role' => $role]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'order' => 'required',
            'posisi' => 'required',
            'gambar' => 'nullable|image',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }
        $organization = new Organization;
        $organization->name = $request->nama;
        $organization->position = $request->posisi;
        $organization->order = $request->order;
        if(request()->file('gambar')){
            // Storage::delete($organization->thumbnail);
            $file = request()->file('gambar')->store("public/organization");
            $organization->thumbnail = $file;
        }
        $organization->save();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil ditambahkan',
        ], 200);
    }

    public function show(Organization $organization)
    {
        //
    }

    public function edit(Organization $organization)
    {
        $role = Role::all();
        return view('pages.app.about.organization.input', ['data' => $organization, 'role' => $role]);
    }

    public function update(Request $request, Organization $organization)
    {
        if ($request->is_active !== null) {
            $organization->is_active = $request->is_active;
            $message = 'Data berhasil diaktifkan';
            if ($request->is_active == 0) {
                $message = 'Data berhasil dinonaktifkan';
            }
            $organization->update();
            return response()->json([
                'alert' => 'success',
                'message' => $message,
            ]);
        }
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'posisi' => 'required',
            'order' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }
        $organization->name = $request->nama;
        $organization->position = $request->posisi;
        $organization->order = $request->order;
        if(request()->file('gambar')){
            $organization->thumbnail ? Storage::delete($organization->thumbnail) : '';
            $file = request()->file('gambar')->store("public/organization");
            $organization->thumbnail = $file;
        }
        $organization->save();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil diperbaharui',
        ], 200);
    }

    public function destroy(Organization $organization)
    {
        Storage::delete($organization->thumbnail);
        $organization->delete();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil dihapus',
        ]);
    }
}

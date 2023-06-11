<?php

namespace App\Http\Controllers\Office;

use App\Models\ProgramStudi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CategoryProdi;
use Illuminate\Support\Facades\Validator;

class ProgramStudiController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $collection = ProgramStudi::paginate(10);
            return view('pages.app.program_studi.list',compact('collection'));
        }
        return view('pages.app.program_studi.main');
    }

    public function create()
    {
        $category_prodi = CategoryProdi::where('is_active', 1)->get();
        return view('pages.app.program_studi.input', ['data' => new ProgramStudi, 'category_prodi' => $category_prodi]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_prodi_id' => 'required',
            'definisi' => 'required',
            'sejarah' => 'required',
            'visi' => 'required',
            'misi' => 'required',
            'tujuan' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }
        $programStudi = new ProgramStudi;
        $programStudi->category_prodi_id = $request->category_prodi_id;
        $programStudi->definisi = $request->definisi;
        $programStudi->sejarah = $request->sejarah;
        $programStudi->visi = $request->visi;
        $programStudi->misi = $request->misi;
        $programStudi->tujuan = $request->tujuan;
        $programStudi->link = $request->link;
        $programStudi->save();
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
        $category_prodi = CategoryProdi::all();
        $data = ProgramStudi::findOrFail($id);
        return view('pages.app.program_studi.input', ['data' => $data, 'category_prodi' => $category_prodi]);
    }

    public function update(Request $request, ProgramStudi $programStudi)
    {
        if ($request->is_active !== null) {
            $programStudi->is_active = $request->is_active;
            $message = 'Data berhasil diaktifkan';
            if ($request->is_active == 0) {
                $message = 'Data berhasil dinonaktifkan';
            }
            $programStudi->update();
            return response()->json([
                'alert' => 'success',
                'message' => $message,
            ]);
        }
        $validator = Validator::make($request->all(), [
            'category_prodi_id' => 'required',
            'definisi' => 'required',
            'sejarah' => 'required',
            'visi' => 'required',
            'misi' => 'required',
            'tujuan' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }
        $programStudi->category_prodi_id = $request->category_prodi_id;
        $programStudi->definisi = $request->definisi;
        $programStudi->sejarah = $request->sejarah;
        $programStudi->visi = $request->visi;
        $programStudi->misi = $request->misi;
        $programStudi->tujuan = $request->tujuan;
        $programStudi->link = $request->link;
        $programStudi->update();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil diperbaharui',
        ], 200);
    }

    public function destroy(ProgramStudi $programStudi)
    {
        $programStudi->delete();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil dihapus',
        ], 200);
    }
}

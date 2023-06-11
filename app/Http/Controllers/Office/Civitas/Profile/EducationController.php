<?php

namespace App\Http\Controllers\Office\Civitas\Profile;

use Illuminate\Http\Request;
use App\Models\Profil\Education;
use App\Http\Controllers\Controller;
use App\Models\Civitas\User AS Dosen;
use Illuminate\Support\Facades\Validator;

class EducationController extends Controller
{
    public function index(Request $request, Dosen $dosen)
    {
        $dosen = Dosen::find($dosen->id);
        // dd($dosen);
        if($request->ajax()){
            $collection = Education::where('user_id', $dosen->id)->paginate(10);
            return view('pages.app.civitas.dosen.profile.education.list', compact('collection', 'dosen'));
        }
        return view('pages.app.civitas.dosen.profile.education.main', ['dosen' => $dosen]);
    }

    public function create(Dosen $dosen)
    {
        return view('pages.app.civitas.dosen.profile.education.input', ['dosen' => $dosen, 'data' => new Education]);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'year' => 'required',
            'knowledge_field' => 'required',
            'university' => 'required',
        ],[
            'year.required' => 'Tahun tidak boleh kosong',
            'knowledge_field.required' => 'Bidang ilmu tidak boleh kosong',
            'university.required' => 'Universitas tidak boleh kosong',
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

    public function edit(Dosen $dosen, Education $education)
    {
        return view('pages.app.civitas.dosen.profile.education.input', ['data' => $education, 'dosen' => $dosen]);
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
        ],[
            'year.required' => 'Tahun tidak boleh kosong',
            'knowledge_field.required' => 'Bidang ilmu tidak boleh kosong',
            'university.required' => 'Universitas tidak boleh kosong',
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

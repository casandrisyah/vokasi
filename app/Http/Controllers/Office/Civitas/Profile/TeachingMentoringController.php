<?php

namespace App\Http\Controllers\Office\Civitas\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Civitas\User as Dosen;
use App\Models\Profil\TeachingMentoring;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TeachingMentoringController extends Controller
{
    public function index(Request $request, Dosen $dosen)
    {
        if($request->ajax()){
            $collection = TeachingMentoring::where('user_id', $dosen->id)->paginate(10);
            return view('pages.app.civitas.dosen.profile.teaching_mentoring.list', compact('collection', 'dosen'));
        }
        return view('pages.app.civitas.dosen.profile.teaching_mentoring.main', compact('dosen'));
    }

    public function create(Dosen $dosen)
    {
        return view('pages.app.civitas.dosen.profile.teaching_mentoring.input', ['data' => new TeachingMentoring, 'dosen' => $dosen]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'title' => 'required',
            'year' => 'required',
        ],[
            'category.required' => 'Kategori harus diisi',
            'title.required' => 'Judul harus diisi',
            'year.required' => 'Tahun harus diisi',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }

        $teaching_mentoring = new TeachingMentoring;
        $teaching_mentoring->user_id = $request->user_id;
        $teaching_mentoring->category = $request->category;
        $teaching_mentoring->title = $request->title;
        $teaching_mentoring->student_name = $request->student_name;
        $teaching_mentoring->year = $request->year;
        $teaching_mentoring->save();

        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil disimpan',
        ], 200);
    }

    public function show($id)
    {
        //
    }

    public function edit(Dosen $dosen, TeachingMentoring $teaching_mentoring)
    {
        return view('pages.app.civitas.dosen.profile.teaching_mentoring.input', ['data' => $teaching_mentoring, 'dosen' => $dosen]);
    }

    public function update(Request $request, TeachingMentoring $teaching_mentoring)
    {
        if ($request->is_active !== null) {
            $teaching_mentoring->is_active = $request->is_active;
            $message = 'Data berhasil diaktifkan';
            if ($request->is_active == 0) {
                $message = 'Data berhasil dinonaktifkan';
            }
            $teaching_mentoring->update();
            return response()->json([
                'alert' => 'success',
                'message' => $message,
            ]);
        }
        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'title' => 'required',
            'year' => 'required',
        ],[
            'category.required' => 'Kategori harus diisi',
            'title.required' => 'Judul harus diisi',
            'year.required' => 'Tahun harus diisi',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }

        $teaching_mentoring->user_id = $request->user_id;
        $teaching_mentoring->category = $request->category;
        $teaching_mentoring->title = $request->title;
        $teaching_mentoring->student_name = $request->student_name;
        $teaching_mentoring->year = $request->year;
        $teaching_mentoring->update();

        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil diperbaharui',
        ], 200);
    }

    public function destroy(TeachingMentoring $teaching_mentoring)
    {
        $teaching_mentoring->delete();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil dihapus',
        ], 200);
    }

    public function teaching_mentoring(Request $request)
    {
        $dosen = Dosen::where('id', Auth::user()->id)->first();
        if($request->ajax()){
            $collection = TeachingMentoring::where('user_id', $dosen->id)->paginate(10);
            return view('pages.app.dosen_profile.teaching_mentoring.list', compact('collection', 'dosen'));
        }
        return view('pages.app.dosen_profile.teaching_mentoring.main', compact('dosen'));
    }

    public function create_teaching_mentoring()
    {
        $dosen = Dosen::where('id', Auth::user()->id)->first();
        return view('pages.app.dosen_profile.teaching_mentoring.input', ['data' => new TeachingMentoring, 'dosen' => $dosen]);
    }

    public function store_teaching_mentoring(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'title' => 'required',
            'year' => 'required',
        ],[
            'category.required' => 'Kategori harus diisi',
            'title.required' => 'Judul harus diisi',
            'year.required' => 'Tahun harus diisi',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }

        $teaching_mentoring = new TeachingMentoring;
        $teaching_mentoring->user_id = $request->user_id;
        $teaching_mentoring->category = $request->category;
        $teaching_mentoring->title = $request->title;
        $teaching_mentoring->student_name = $request->student_name;
        $teaching_mentoring->year = $request->year;
        $teaching_mentoring->save();

        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil disimpan',
        ], 200);
    }


    public function edit_teaching_mentoring(TeachingMentoring $teaching_mentoring)
    {
        $dosen = Dosen::where('id', Auth::user()->id)->first();
        return view('pages.app.dosen_profile.teaching_mentoring.input', ['data' => $teaching_mentoring, 'dosen' => $dosen]);
    }

    public function update_teaching_mentoring(Request $request, TeachingMentoring $teaching_mentoring)
    {
        if ($request->is_active !== null) {
            $teaching_mentoring->is_active = $request->is_active;
            $message = 'Data berhasil diaktifkan';
            if ($request->is_active == 0) {
                $message = 'Data berhasil dinonaktifkan';
            }
            $teaching_mentoring->update();
            return response()->json([
                'alert' => 'success',
                'message' => $message,
            ]);
        }
        $validator = Validator::make($request->all(), [
            'category' => 'required',
            'title' => 'required',
            'year' => 'required',
        ],[
            'category.required' => 'Kategori harus diisi',
            'title.required' => 'Judul harus diisi',
            'year.required' => 'Tahun harus diisi',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }

        $teaching_mentoring->user_id = $request->user_id;
        $teaching_mentoring->category = $request->category;
        $teaching_mentoring->title = $request->title;
        $teaching_mentoring->student_name = $request->student_name;
        $teaching_mentoring->year = $request->year;
        $teaching_mentoring->update();

        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil diperbaharui',
        ], 200);
    }

    public function destroy_teaching_mentoring(TeachingMentoring $teaching_mentoring)
    {
        $teaching_mentoring->delete();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil dihapus',
        ], 200);
    }
}

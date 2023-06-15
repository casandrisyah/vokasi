<?php

namespace App\Http\Controllers\Office;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CategoryProdi;
use App\Models\Subject;
use Illuminate\Support\Facades\Validator;

class SubjectController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $collection = Subject::latest()->paginate(10);
            return view('pages.app.subject.list',compact('collection'));
        }
        return view('pages.app.subject.main');
    }

    public function create()
    {
        $prodi = CategoryProdi::where('is_active', 1)->get();
        return view('pages.app.subject.input', ['data' => new Subject, 'prodi' => $prodi]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'requ ired',
            'prodi' => 'nullable',
            'code' => 'required',
            'sks' => 'required',
            'semester' => 'nullable',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }
        $subject = new Subject;
        $subject->name = $request->name;
        $subject->prodi = $request->prodi;
        $subject->code = $request->code;
        $subject->sks = $request->sks;
        $subject->semester = $request->semester;
        $subject->save();
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
        $data = Subject::findOrFail($id);
        $prodi = CategoryProdi::where('is_active', 1)->get();
        return view('pages.app.subject.input', ['data' => $data, 'prodi' => $prodi]);
    }

    public function update(Request $request, Subject $subject)
    {
        if ($request->is_active !== null) {
            $subject->is_active = $request->is_active;
            $message = 'Data berhasil diaktifkan';
            if ($request->is_active == 0) {
                $message = 'Data berhasil dinonaktifkan';
            }
            $subject->update();
            return response()->json([
                'alert' => 'success',
                'message' => $message,
            ]);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'prodi' => 'nullable',
            'code' => 'required',
            'sks' => 'required',
            'semester' => 'nullable',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }
        $subject->name = $request->name;
        $subject->prodi = $request->prodi;
        $subject->code = $request->code;
        $subject->sks = $request->sks;
        $subject->semester = $request->semester;
        $subject->update();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil diperbaharui',
        ], 200);
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil dihapus',
        ], 200);
    }
}

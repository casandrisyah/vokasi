<?php

namespace App\Http\Controllers\Office\Civitas\Profile;

use App\Http\Controllers\Controller;
use App\Models\Profil\Research;
use App\Models\Civitas\User as Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResearchController extends Controller
{
    public function index(Request $request, Dosen $dosen)
    {
        if($request->ajax()){
            $collection = Research::where('user_id', $dosen->id)->paginate(10);
            return view('pages.app.civitas.dosen.profile.research.list', compact('collection', 'dosen'));
        }
        return view('pages.app.civitas.dosen.profile.research.main', compact('dosen'));
    }

    public function create(Dosen $dosen)
    {
        return view('pages.app.civitas.dosen.profile.research.input', ['data' => new Research, 'dosen' => $dosen]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'date' => 'required',
            'published' => 'required',
            'url' => 'required',
        ],[
            'title.required' => 'Judul tidak boleh kosong',
            'date.required' => 'Tanggal tidak boleh kosong',
            'published.required' => 'Tempat Publikasi tidak boleh kosong',
            'url.required' => 'Url tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }

        $research = new Research;
        $research->user_id = $request->user_id;
        $research->title = $request->title;
        $research->date = $request->date;
        $research->published = $request->published;
        $research->url = $request->url;
        $research->desc = $request->desc;
        $research->save();

        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil disimpan',
        ], 200);
    }

    public function show($id)
    {
        //
    }

    public function edit(Dosen $dosen, Research $research)
    {
        return view('pages.app.civitas.dosen.profile.research.input', ['data' => $research, 'dosen' => $dosen]);
    }

    public function update(Request $request, Research $research)
    {
        if ($request->is_active !== null) {
            $research->is_active = $request->is_active;
            $message = 'Data berhasil diaktifkan';
            if ($request->is_active == 0) {
                $message = 'Data berhasil dinonaktifkan';
            }
            $research->update();
            return response()->json([
                'alert' => 'success',
                'message' => $message,
            ]);
        }
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'date' => 'required',
            'published' => 'required',
            'url' => 'required',
        ],[
            'title.required' => 'Judul tidak boleh kosong',
            'date.required' => 'Tanggal tidak boleh kosong',
            'published.required' => 'Tempat Publikasi tidak boleh kosong',
            'url.required' => 'Url tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }

        $research->user_id = $request->user_id;
        $research->title = $request->title;
        $research->date = $request->date;
        $research->published = $request->published;
        $research->url = $request->url;
        $research->desc = $request->desc;
        $research->update();

        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil diperbaharui',
        ], 200);
    }

    public function destroy(Research $research)
    {
        $research->delete();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil dihapus',
        ], 200);
    }
}

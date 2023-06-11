<?php

namespace App\Http\Controllers\Office\Civitas\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Civitas\User as Dosen;
use App\Models\Profil\Funding;
use Illuminate\Support\Facades\Validator;

class FundingController extends Controller
{
    public function index(Request $request, Dosen $dosen)
    {
        if($request->ajax()){
            $collection = Funding::where('user_id', $dosen->id)->paginate(10);
            return view('pages.app.civitas.dosen.profile.funding.list', compact('collection', 'dosen'));
        }
        return view('pages.app.civitas.dosen.profile.funding.main', compact('dosen'));
    }

    public function create(Dosen $dosen)
    {
        return view('pages.app.civitas.dosen.profile.funding.input', ['data' => new Funding, 'dosen' => $dosen]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_name' => 'required',
            'organizer' => 'required',
            'involved_parties' => 'required',
            'working_time' => 'required',
            'working_area' => 'required',
            'type' => 'required',
        ],[
            'project_name.required' => 'Nama Kegiatan tidak boleh kosong',
            'organizer.required' => 'Penyelenggara tidak boleh kosong',
            'involved_parties.required' => 'Sponsor tidak boleh kosong',
            'working_time.required' => 'Waktu Pengerjaan tidak boleh kosong',
            'working_area.required' => 'Tempat Penyelenggaraan boleh kosong',
            'type.required' => 'Jenis Pendanaan tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }

        $funding = new Funding;
        $funding->user_id = $request->user_id;
        $funding->project_name = $request->project_name;
        $funding->organizer = $request->organizer;
        $funding->involved_parties = $request->involved_parties;
        $funding->working_time = $request->working_time;
        $funding->working_area = $request->working_area;
        $funding->desc = $request->desc;
        $funding->type = $request->type;
        $funding->save();

        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil disimpan',
        ], 200);
    }

    public function show($id)
    {
        //
    }

    public function edit(Dosen $dosen, Funding $funding)
    {
        return view('pages.app.civitas.dosen.profile.funding.input', ['data' => $funding, 'dosen' => $dosen]);
    }

    public function update(Request $request, Funding $funding)
    {
        if ($request->is_active !== null) {
            $funding->is_active = $request->is_active;
            $message = 'Data berhasil diaktifkan';
            if ($request->is_active == 0) {
                $message = 'Data berhasil dinonaktifkan';
            }
            $funding->update();
            return response()->json([
                'alert' => 'success',
                'message' => $message,
            ]);
        }
        $validator = Validator::make($request->all(), [
            'project_name' => 'required',
            'organizer' => 'required',
            'involved_parties' => 'required',
            'working_time' => 'required',
            'working_area' => 'required',
            'type' => 'required',
        ],[
            'project_name.required' => 'Nama Kegiatan tidak boleh kosong',
            'organizer.required' => 'Penyelenggara tidak boleh kosong',
            'involved_parties.required' => 'Sponsor tidak boleh kosong',
            'working_time.required' => 'Waktu Pengerjaan tidak boleh kosong',
            'working_area.required' => 'Tempat Penyelenggaraan boleh kosong',
            'type.required' => 'Jenis Pendanaan tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }

        $funding->user_id = $request->user_id;
        $funding->project_name = $request->project_name;
        $funding->organizer = $request->organizer;
        $funding->involved_parties = $request->involved_parties;
        $funding->working_time = $request->working_time;
        $funding->working_area = $request->working_area;
        $funding->type = $request->type;
        $funding->desc = $request->desc;
        $funding->update();

        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil diperbaharui',
        ], 200);
    }

    public function destroy(Funding $funding)
    {
        $funding->delete();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil dihapus',
        ], 200);
    }
}

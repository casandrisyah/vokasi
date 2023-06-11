<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Models\Account\UserCategory;
use Illuminate\Http\Request;
use App\Models\Civitas\User as Dosen;
use App\Models\Profil\Education;
use App\Models\Profil\Funding;
use App\Models\Profil\Research;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DosenProfileController extends Controller
{
    public function identitas_dosen()
    {
        $dosen = Dosen::where('id', Auth::user()->id)->first();
        $category = UserCategory::where('role', 4)->where('is_active', 1)->get();
        return view('pages.app.dosen_profile.personal.input', ['data' => $dosen, 'category' => $category]);
    }

    public function update_identitas_dosen(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'user_category_id' => 'required',
            'nidn' => 'required',
            'sinta_id' => 'required',
        ],[
            'name.required' => 'Nama tidak boleh kosong',
            'email.required' => 'Email tidak boleh kosong',
            'user_category_id.required' => 'Program Studi tidak boleh kosong',
            'nidn.required' => 'NIDN tidak boleh kosong',
            'sinta_id.required' => 'Sinta ID tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }

        $dosen = Dosen::where('id', Auth::user()->id)->first();
        $dosen->name = $request->name;
        $dosen->user_category_id = $request->user_category_id;
        $dosen->email = $request->email;
        $dosen->phone = $request->phone;
        $dosen->nidn = $request->nidn;
        $dosen->sinta_id = $request->sinta_id;
        $dosen->place_birth = $request->place_birth;
        $dosen->date_birth = $request->date_birth;
        $dosen->skill = $request->skill;
        $dosen->url = $request->url;
        $dosen->position = $request->position;
        if ($request->file('avatar')) {
            if ($dosen->avatar != null){
                Storage::delete($dosen->avatar);
            }
            $file = $request->file('avatar')->store('public/dosen');
            $dosen->avatar = $file;
        }
        $dosen->update();

        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil diperbaharui',
        ], 200);
    }

    public function about()
    {
        $dosen = Dosen::where('id', Auth::user()->id)->first();
        return view('pages.app.dosen_profile.about.input', ['data' => $dosen]);
    }

    public function update_about(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bio' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }

        $dosen = Dosen::where('id', Auth::user()->id)->first();
        $dosen->bio = $request->bio;
        $dosen->update();

        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil diperbaharui',
        ], 200);
    }

    public function pendidikan(Request $request)
    {
        $dosen = Dosen::where('id', Auth::user()->id)->first();
        if($request->ajax()){
            $collection = Education::where('user_id', $dosen->id)->paginate(10);
            return view('pages.app.dosen_profile.education.list', compact('collection'));
        }
        return view('pages.app.dosen_profile.education.main', compact('dosen'));
    }

    public function create_pendidikan()
    {
        $dosen = Dosen::where('id', Auth::user()->id)->first();
        return view('pages.app.dosen_profile.education.input', ['dosen' => $dosen, 'data' => new Education]);
    }

    public function store_pendidikan(Request $request) {
        $validator = Validator::make($request->all(), [
            'year' => 'required|numeric',
            'knowledge_field' => 'required',
            'university' => 'required',
        ],[
            'year.required' => 'Tahun tidak boleh kosong',
            'year.numeric' => 'Tahun harus berupa angka',
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

    public function edit_pendidikan(Education $education)
    {
        $dosen = Dosen::where('id', Auth::user()->id)->first();
        return view('pages.app.dosen_profile.education.input', ['data' => $education, 'dosen' => $dosen]);
    }

    public function update_pendidikan(Request $request, Education $education)
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
            'year' => 'required|numeric',
            'knowledge_field' => 'required',
            'university' => 'required',
        ],[
            'year.required' => 'Tahun tidak boleh kosong',
            'year.numeric' => 'Tahun harus berupa angka',
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

    public function destroy_pendidikan(Education $education)
    {
        $education->delete();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil dihapus',
        ], 200);
    }

    public function pendanaan(Request $request)
    {
        $dosen = Dosen::where('id', Auth::user()->id)->first();
        if($request->ajax()){
            $collection = Funding::where('user_id', $dosen->id)->paginate(10);
            return view('pages.app.dosen_profile.funding.list', compact('collection'));
        }
        return view('pages.app.dosen_profile.funding.main', compact('dosen'));
    }

    public function create_pendanaan()
    {
        $dosen = Dosen::where('id', Auth::user()->id)->first();
        return view('pages.app.dosen_profile.funding.input', ['data' => new Funding, 'dosen' => $dosen]);
    }

    public function store_pendanaan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_name' => 'required',
            'organizer' => 'required',
            'involved_parties' => 'required',
            'working_time' => 'required',
            'working_area' => 'required',
            'type' => 'required',
        ],[
            'project_name.required' => 'Nama kegiatan tidak boleh kosong',
            'organizer.required' => 'Penyelenggara tidak boleh kosong',
            'involved_parties.required' => 'Sponsor tidak boleh kosong',
            'working_time.required' => 'Waktu Pengerjaan tidak boleh kosong',
            'working_area.required' => 'Tempat Penyelenggaraan tidak boleh kosong',
            'type.required' => 'Jenis pendanaan tidak boleh kosong',
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
        $funding->type = $request->type;
        $funding->desc = $request->desc;
        $funding->save();

        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil disimpan',
        ], 200);
    }

    public function edit_pendanaan(Funding $funding)
    {
        $dosen = Dosen::where('id', Auth::user()->id)->first();
        return view('pages.app.dosen_profile.funding.input', ['data' => $funding, 'dosen' => $dosen]);
    }

    public function update_pendanaan(Request $request, Funding $funding)
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
            'project_name.required' => 'Nama kegiatan tidak boleh kosong',
            'organizer.required' => 'Penyelenggara tidak boleh kosong',
            'involved_parties.required' => 'Sponsor tidak boleh kosong',
            'working_time.required' => 'Waktu Pengerjaan tidak boleh kosong',
            'working_area.required' => 'Tempat Penyelenggaraan tidak boleh kosong',
            'type.required' => 'Jenis pendanaan tidak boleh kosong',
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

    public function destroy_pendanaan(Funding $funding)
    {
        $funding->delete();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil dihapus',
        ], 200);
    }

    public function research(Request $request)
    {
        $dosen = Dosen::where('id', Auth::user()->id)->first();
        if($request->ajax()){
            $collection = Research::where('user_id', $dosen->id)->paginate(10);
            return view('pages.app.dosen_profile.research.list', compact('collection', 'dosen'));
        }
        return view('pages.app.dosen_profile.research.main', compact('dosen'));
    }

    public function create_research()
    {
        $dosen = Dosen::where('id', Auth::user()->id)->first();
        return view('pages.app.dosen_profile.research.input', ['data' => new Research, 'dosen' => $dosen]);
    }

    public function store_research(Request $request)
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

        $research = new Research();
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

    public function edit_research(Research $research)
    {
        $dosen = Dosen::where('id', Auth::user()->id)->first();
        return view('pages.app.dosen_profile.research.input', ['data' => $research, 'dosen' => $dosen]);
    }

    public function update_research(Request $request, Research $research)
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

    public function destroy_research(Research $research)
    {
        $research->delete();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil dihapus',
        ], 200);
    }
}

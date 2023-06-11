<?php

namespace App\Http\Controllers\Office\Appearance;

use App\Http\Controllers\Controller;
use App\Models\Appearance\Home\BreakingNewsSection;
use App\Models\Appearance\Home\CivitasSection;
use App\Models\Appearance\Home\FacultyExploreSection;
use App\Models\Appearance\Home\FacultyItemsSections;
use App\Models\Appearance\Home\MeetOurStudentsSection;
use App\Models\Appearance\Home\StudyProgramSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HomeMenuController extends Controller
{
    public function breaking_news_sections()
    {
        $bns = BreakingNewsSection::first();
        $compact = $bns ? ['data' => $bns] : ['data' => new BreakingNewsSection];
        return view('pages.app.appearance.home.breaking_news.input', $compact);
    }

    public function breaking_news_sections_update(Request $request)
    {
        $bns = BreakingNewsSection::first();
        if ($bns) {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'limit' => 'numeric',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $validator->errors()->first(),
                ], 200);
            }
            $bns->title = $request->title;
            $bns->limit = $request->limit;
            $bns->is_active = $request->is_active  ? 1 : 0;
            $bns->update();
        } else {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'limit' => 'numeric',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $validator->errors()->first(),
                ], 200);
            }
            $bns = new BreakingNewsSection;
            $bns->title = $request->title;
            $bns->limit = $request->limit;
            $bns->is_active = $request->is_active ? 1 : 0;
            $bns->save();
        }
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil disimpan',
        ]);
    }

    public function civitas_section()
    {
        $civitas = CivitasSection::first();
        $compact = $civitas ? ['data' => $civitas] : ['data' => new CivitasSection];
        return view('pages.app.appearance.home.civitas_section.input', $compact);
    }

    public function civitas_section_update(Request $request)
    {
        $civitas = CivitasSection::first();
        if ($civitas) {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg',
                'url' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $validator->errors()->first(),
                ], 200);
            }
            $civitas->title = $request->title;
            $civitas->desc = $request->desc;
            $civitas->url = $request->url;
            if (request()->file('thumbnail')) {
                $file = request()->file('thumbnail')->store("public/home");
                $civitas->thumbnail = $file;
            }
            $civitas->is_active = $request->is_active ? 1 : 0;
            $civitas->update();
        } else {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'thumbnail' => 'required|image|mimes:jpeg,png,jpg',
                'url' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $validator->errors()->first(),
                ], 200);
            }
            $civitas = new CivitasSection;
            $civitas->title = $request->title;
            $civitas->desc = $request->desc;
            $civitas->url = $request->url;
            if (request()->file('thumbnail')) {
                $file = request()->file('thumbnail')->store("public/home");
                $civitas->thumbnail = $file;
            }
            $civitas->is_active = $request->is_active ? 1 : 0;
            $civitas->save();
        }
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil disimpan',
        ]);
    }

    public function faculty_explore_section(Request $request)
    {
        if($request->ajax()){
            $collection = FacultyItemsSections::paginate(10);
            return view('pages.app.appearance.home.faculty_item_section.list', compact('collection'));
        }
        $fes = FacultyExploreSection::first();
        $compact = $fes ? ['data' => $fes] : ['data' => new FacultyExploreSection];
        return view('pages.app.appearance.home.faculty_explore_section.input', $compact);
    }

    public function faculty_explore_section_update(Request $request)
    {
        $fes = FacultyExploreSection::first();
        if ($fes) {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $validator->errors()->first(),
                ], 200);
            }
            $fes->title = $request->title;
            $fes->text_under_title = $request->text_under_title;
            $fes->is_active = $request->is_active ? 1 : 0;
            $fes->update();
        } else {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $validator->errors()->first(),
                ], 200);
            }
            $fes = new FacultyExploreSection;
            $fes->title = $request->title;
            $fes->text_under_title = $request->text_under_title;
            $fes->is_active = $request->is_active ? 1 : 0;
            $fes->save();
        }
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil disimpan',
        ]);
    }

    public function faculty_items_section(Request $request)
    {
        if($request->ajax()){
            $collection = FacultyItemsSections::paginate(10);
            return view('pages.app.appearance.home.faculty_item_section.list', compact('collection'));
        }
    }

    public function faculty_items_section_create()
    {
        return view('pages.app.appearance.home.faculty_item_section.input', ['data' => new FacultyItemsSections]);
    }

    public function faculty_items_section_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg',
            'url' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }
        $fis = new FacultyItemsSections;
        $fis->title = $request->title;
        $fis->url = $request->url;
        if (request()->file('thumbnail')) {
            $file = request()->file('thumbnail')->store("public/home/fakultas");
            $fis->thumbnail = $file;
        }
        $fis->save();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil disimpan',
        ]);
    }

    public function faculty_items_section_edit(FacultyItemsSections $fis)
    {
        return view('pages.app.appearance.home.faculty_item_section.input', ['data' => $fis]);
    }

    public function faculty_items_section_update(Request $request, FacultyItemsSections $fis)
    {
        if ($request->is_active !== null) {
            $fis->is_active = $request->is_active;
            $message = 'Data berhasil diaktifkan';
            if ($request->is_active == 0) {
                $message = 'Data berhasil dinonaktifkan';
            }
            $fis->update();
            return response()->json([
                'alert' => 'success',
                'message' => $message,
            ]);
        }
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg',
            'url' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }
        $fis->title = $request->title;
        $fis->url = $request->url;
        if (request()->file('thumbnail')) {
            if ($fis->thumbnail !== null) {
                Storage::delete($fis->thumbnail);
            }
            $file = request()->file('thumbnail')->store("public/home/fakultas");
            $fis->thumbnail = $file;
        }
        $fis->update();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil disimpan',
        ]);
    }

    public function study_program_section()
    {
        $sps = StudyProgramSection::first();
        $compact = $sps ? ['data' => $sps] : ['data' => new StudyProgramSection];
        return view('pages.app.appearance.home.study_program_section.input', $compact);
    }

    public function study_program_section_update(Request $request)
    {
        $sps = StudyProgramSection::first();
        if ($sps) {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'desc' => 'required',
                'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg',
                'url' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $validator->errors()->first(),
                ], 200);
            }
            $sps->title = $request->title;
            $sps->desc = $request->desc;
            if (request()->file('thumbnail')) {
                if ($sps->thumbnail !== null) {
                    Storage::delete($sps->thumbnail);
                }
                $file = request()->file('thumbnail')->store("public/home");
                $sps->thumbnail = $file;
            }
            $sps->url = $request->url;
            $sps->is_active = $request->is_active ? 1 : 0;
            $sps->update();
        } else {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'desc' => 'required',
                'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg',
                'url' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $validator->errors()->first(),
                ], 200);
            }
            $sps = new StudyProgramSection;
            $sps->title = $request->title;
            $sps->desc = $request->desc;
            if (request()->file('thumbnail')) {
                $file = request()->file('thumbnail')->store("public/home");
                $sps->thumbnail = $file;
            }
            $sps->url = $request->url;
            $sps->is_active = $request->is_active ? 1 : 0;
            $sps->save();
        }
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil disimpan',
        ]);
    }

    public function meet_our_students_section()
    {
        $moss = MeetOurStudentsSection::first();
        $compact = $moss ? ['data' => $moss] : ['data' => new MeetOurStudentsSection];
        return view('pages.app.appearance.home.meet_our_students_section.input', $compact);
    }

    public function meet_our_students_section_update(Request $request)
    {
        $moss = MeetOurStudentsSection::first();
        if ($moss) {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'desc' => 'required',
                'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg',
                'url' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $validator->errors()->first(),
                ], 200);
            }
            $moss->title = $request->title;
            $moss->desc = $request->desc;
            if (request()->file('thumbnail')) {
                if ($moss->thumbnail !== null) {
                    Storage::delete($moss->thumbnail);
                }
                $file = request()->file('thumbnail')->store("public/home");
                $moss->thumbnail = $file;
            }
            $moss->url = $request->url;
            $moss->is_active = $request->is_active ? 1 : 0;
            $moss->update();
        } else {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'desc' => 'required',
                'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg',
                'url' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $validator->errors()->first(),
                ], 200);
            }
            $moss = new MeetOurStudentsSection;
            $moss->title = $request->title;
            $moss->desc = $request->desc;
            if (request()->file('thumbnail')) {
                $file = request()->file('thumbnail')->store("public/home");
                $moss->thumbnail = $file;
            }
            $moss->url = $request->url;
            $moss->is_active = $request->is_active ? 1 : 0;
            $moss->save();
        }
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil disimpan',
        ]);
    }
}

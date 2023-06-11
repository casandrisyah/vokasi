<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\About\History;
use App\Models\About\Organization;
use App\Models\About\Vision;
use App\Models\Appearance\Home\BreakingNewsSection;
use App\Models\Appearance\Home\CivitasSection;
use App\Models\Appearance\Home\FacultyExploreSection;
use App\Models\Appearance\Home\FacultyItemsSections;
use App\Models\Appearance\Home\MeetOurStudentsSection;
use App\Models\Appearance\Home\StudyProgramSection;
use App\Models\CategoryProdi;
use App\Models\Civitas\User as Dosen;
use App\Models\Civitas\User as Staf;
use App\Models\Comment;
use App\Models\Profil\TeachingMentoring;
use App\Models\ProgramStudi;
use App\Models\Timeline\Activity;
use App\Models\Timeline\News;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class WebController extends Controller
{
    public function index()
    {
        $breaking_news = BreakingNewsSection::where('is_active', 1)->first();
        $limit = 0;
        if ($breaking_news !== null) {
            $limit = $breaking_news->limit;
        } else {
            $limit = 12;
        }
        // dd($limit);
        $civitas_section = CivitasSection::where('is_active', 1)->first();
        $faculty_explore_section = FacultyExploreSection::where('is_active', 1)->first();
        $faculty_items = FacultyItemsSections::where('is_active', 1)->orderBy('title', 'asc')->get();
        $study_program_section = StudyProgramSection::where('is_active', 1)->first();
        $meet_our_student_section = MeetOurStudentsSection::where('is_active', 1)->first();
        $moss_thumbnail = null;
        if ($meet_our_student_section !== null) {
            $moss_thumbnail = Storage::url($meet_our_student_section->thumbnail);
        }

        $news = News::where('is_active', 1)->orderBy('created_at', 'desc')->take($limit)->get();
        $category_prodi = CategoryProdi::where('is_active', 1)->first();
        $activity = Activity::where('is_active', 1)->first();
        return view('pages.web.home.main', compact('news', 'category_prodi', 'activity', 'breaking_news', 'civitas_section', 'faculty_explore_section', 'faculty_items', 'study_program_section', 'meet_our_student_section', 'moss_thumbnail'));
    }

    public function about()
    {
        $history = History::where('is_active', 1)->get();
        $vision = Vision::where('is_active', 1)->first();
        $structure = Organization::where('is_active', 1)->orderBy('order', 'asc')->get();
        return view('pages.web.about.main', compact('history', 'vision', 'structure'));
    }

    public function news()
    {
        $primary = News::where('is_active', 1)->where('is_primary', 1)->first();
        $news = News::where('is_active', 1)->where('is_primary', 0)->orderBy('created_at', 'desc')->paginate(12);
        return view('pages.web.news.main', compact('news', 'primary'));
    }

    public function singleNews($slug)
    {
        $news = News::where('slug', $slug)->first();
        $latest = News::whereNot('slug', $slug)->orderBy('created_at', 'desc')->take(3)->get();
        return view('pages.web.news.show', compact('news', 'latest'));
    }

    public function program($slug)
    {
        $program = ProgramStudi::where('is_active', 1)->whereHas('category_prodi', function($q) use ($slug){
            $q->where('slug', $slug);
        })->first();
        $category = CategoryProdi::where('is_active', 1)->where('slug', $slug)->first();
        return view('pages.web.program.main', compact('program', 'category'));
    }

    public function activity($category)
    {
        $category = $category;
        $activities = Activity::where('is_active', 1)->where('category', $category);

        if (request()->jenis_aktivitas) {
            if (request()->jenis_aktivitas == 'tanggal_terbaru') {
                $activities = $activities->orderBy('created_at', 'desc')->paginate(12)->withQueryString();
            } else if (request()->jenis_aktivitas == 'tanggal_terdahulu') {
                $activities = $activities->orderBy('created_at', 'asc')->paginate(12)->withQueryString();
            } else if (request()->jenis_aktivitas == 'event_virtual') {
                $activities = $activities->where('type', 'Online')->paginate(12)->withQueryString();
            } else if (request()->jenis_aktivitas == 'event_offline') {
                $activities = $activities->where('type', 'Offline')->paginate(12)->withQueryString();
            } else if (request()->jenis_aktivitas == "all") {
                $activities = $activities->orderBy('created_at', 'desc')->paginate(12);
            }
        } else {
            $activities = $activities->orderBy('created_at', 'desc')->paginate(12);
        }
        return view('pages.web.activity.main', compact('activities', 'category'));
    }

    public function send_comment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'body' => 'required|min:3'
        ], [
            'body.required' => 'Mohon isi komentar dengan benar',
            'body.min' => 'Komentar minimal 3 karakter'
        ]);
        if ($validator->fails()) {
            toast()->error($validator->errors()->first())->autoClose(5000)->showCloseButton(true);
            // return redirect()->back()->withErrors($validator)->withInput();
            return response()->json([
                'alert' => 'error',
                'message' => 'Mohon isi komentar dengan benar'
            ]);
        }

        $comment = new Comment;
        $comment->body = $request->body;
        $comment->save();
        toast()->success('Komentar berhasil dikirim')->autoClose(5000)->showCloseButton(true);
        // return redirect()->route('web.home');
        return response()->json([
            'alert' => 'success',
            'message' => 'Komentar berhasil dikirim'
        ]);
    }

    public function dosen()
    {
        $dosen = Dosen::where('role', 4)->where('is_active', 1);
        $urutkan = request()->urutkan;

        if (request()->search) {
            $dosen = $dosen->where(function ($q) {
                $q->where('name', 'like', '%' . request()->search . '%')
                    ->orWhere('nidn', 'like', '%' . request()->search . '%')
                    ->orWhere('sinta_id', 'like', '%' . request()->search . '%')
                    ->orWhere('position', 'like', '%' . request()->search . '%')
                    ->orWhere('email', 'like', '%' . request()->search . '%');
            });
        }

        if (request()->urutkan) {
            if (request()->urutkan == 'dosen_d3_tk') {
                $urutkan = 'D-III Teknologi Komputer';
                $dosen = $dosen->whereHas('user_category', function ($q) use ($urutkan) {
                    $q->where('name', $urutkan);
                });
            } else if (request()->urutkan == 'dosen_d3_ti') {
                $urutkan = 'D-III Teknologi Informasi';
                $dosen = $dosen->whereHas('user_category', function ($q) use ($urutkan) {
                    $q->where('name', $urutkan);
                });
            } else if (request()->urutkan == 'dosen_trpl') {
                $urutkan = 'Sarjana Terapan Teknologi Rekayasa Perangkat Lunak';
                $dosen = $dosen->whereHas('user_category', function ($q) use ($urutkan) {
                    $q->where('name', $urutkan);
                });
            }
        }

        $dosen = $dosen->paginate(12)->withQueryString();

        return view('pages.web.civitas.dosen.main', compact('dosen', 'urutkan'));
    }

    public function show_dosen(Dosen $dosen)
    {
        $education = $dosen->education()->where('is_active', 1)->orderBy('created_at', 'desc')->get();
        $funding = $dosen->pendanaan()->where('is_active', 1)->orderBy('created_at', 'desc')->get();
        $research = $dosen->research()->where('is_active', 1)->orderBy('created_at', 'desc')->get();
        $teaching_mentoring = $dosen->teaching_mentoring()->where('is_active', 1)->orderBy('created_at', 'desc')->get();
        return view('pages.web.civitas.dosen.show', compact('dosen', 'education', 'funding', 'research', 'teaching_mentoring'));
    }

    public function filter_teaching_mentoring(Request $request)
    {
        $category = $request->category;
        $dosen = $request->dosen_id;
        if ($category == 'semua') {
            $teaching_mentoring = TeachingMentoring::where('user_id', $dosen)->where('is_active', 1)->orderBy('created_at', 'desc')->get();
        } else {
            $teaching_mentoring = TeachingMentoring::where('user_id', $dosen)->where('is_active', 1)->where('category', $category)->orderBy('created_at', 'desc')->get();
        }

        if ($teaching_mentoring->count() == 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan',
                'data' =>  $teaching_mentoring,
            ]);
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Data berhasil didapatkan',
            'data' => $teaching_mentoring,
        ]);
    }

    public function staf()
    {
        $staf = Staf::where('role', 5)->where('is_active', 1);

        $urutkan = request()->urutkan;

        if (request()->search) {
            $staf = $staf->where(function ($q) {
                $q->where('name', 'like', '%' . request()->search . '%')
                    ->orWhere('employee_id', 'like', '%' . request()->search . '%')
                    ->orWhere('position', 'like', '%' . request()->search . '%')
                    ->orWhere('email', 'like', '%' . request()->search . '%');
            });
        }

        if (request()->urutkan) {
            if (request()->urutkan == 'asdosos_fakultas') {
                $urutkan = 'Asisten Dosen Fakultas Vokasi';
                $staf = $staf->where('position', $urutkan);
            } else if (request()->urutkan == 'baak_fakultas') {
                $urutkan = 'BAAK Fakultas Vokasi';
                $staf = $staf->where('position', $urutkan);
            }
        }

        $staf = $staf->paginate(12)->withQueryString();
        return view('pages.web.civitas.staf.staf', compact('staf', 'urutkan'));
    }

    public function show_staf(Staf $staf)
    {
        $education = $staf->education()->where('is_active', 1)->orderBy('created_at', 'desc')->get();
        $staff_teaching = $staf->staff_teaching()->where('is_active', 1)->orderBy('created_at', 'desc')->get();
        return view('pages.web.civitas.staf.show', compact('staf', 'education', 'staff_teaching'));
    }
}

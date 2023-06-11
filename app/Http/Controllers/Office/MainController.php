<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Models\About\History;
use App\Models\About\Organization;
use App\Models\Civitas\User as Dosen;
use App\models\Civitas\User as Staff;
use App\models\Account\User;
use App\Models\Comment;
use App\Models\ProgramStudi;
use App\Models\Timeline\Activity;
use App\Models\Timeline\News;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index()
    {
        $role = Auth::user()->role;
        $id = Auth::user()->id;
        $user_category = Auth::user()->user_category ?  Auth::user()->user_category->slug : null;
        if ($role == 1)
        {
            $civitas['dosen'] = User::where('role', 4)->count();
            $civitas['staff'] = User::where('role', 5)->count();
            $account['himpunan'] = User::where('role', 6)->count();

            $about['history'] = History::all()->count();
            $about['organization'] = Organization::all()->count();

            $news = News::all()->count();
            $activity = Activity::all()->count();
            $comment = Comment::all()->count();
            $prodi = ProgramStudi::all()->count();
            return view('pages.app.dashboard.main', ['civitas' => $civitas, 'account' => $account, 'news' => $news, 'activity' => $activity, 'comment' => $comment, 'prodi' => $prodi, 'about' => $about]);
        } else if ($role == 4)
        {
            $dosen = Dosen::where('id', $id)->first();
            // dd($dosen);
            return view('pages.app.dashboard.dosen', ['data' => $dosen]);
        } else if ($role == 5)
        {
            $staff = Staff::where('id', $id)->first();
            return view('pages.app.dashboard.staf', ['data' => $staff]);
        } else if ($user_category == 'himatek')
        {
            $himatek = User::where('id', $id)->first();
            $total_act_himatek = Activity::where('category', 'himatek')->count();
            return view('pages.app.dashboard.himatek', ['data' => $himatek, 'total_act_himatek' => $total_act_himatek]);
        } else if ($user_category == 'himatif')
        {
            $himatif = User::where('id', $id)->first();
            $total_act_himatif = Activity::where('category', 'himatif')->count();
            return view('pages.app.dashboard.himatif', ['data' => $himatif, 'total_act_himatif' => $total_act_himatif]);
        } else if ($user_category == 'himatera')
        {
            $himatera = User::where('id', $id)->first();
            $total_act_himatera = Activity::where('category', 'himatera')->count();
            return view('pages.app.dashboard.himatera', ['data' => $himatera, 'total_act_himatera' => $total_act_himatera]);
        }
    }
}

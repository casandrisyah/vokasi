<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Office\AuthController;
use App\Http\Controllers\Office\About\VisionController;
use App\Http\Controllers\Office\Civitas\DosenController;
use App\Http\Controllers\Office\About\HistoryController;
use App\Http\Controllers\Office\Timeline\NewsController;
use App\Http\Controllers\Office\Timeline\ActivityController;
use App\Http\Controllers\Office\About\OrganizationController;
use App\Http\Controllers\Office\Account\DekanController;
use App\Http\Controllers\Office\Account\HimpunanCategoryController;
use App\Http\Controllers\Office\Account\HimpunanController;
use App\Http\Controllers\Office\Account\KAProdiCategoryController;
use App\Http\Controllers\Office\Account\KAProdiController;
use App\Http\Controllers\Office\Appearance\CarouselController;
use App\Http\Controllers\Office\Appearance\FooterController;
use App\Http\Controllers\Office\Appearance\HomeMenuController;
use App\Http\Controllers\Office\CategoryProdiController;
use App\Http\Controllers\Office\Civitas\DosenCategoryController;
use App\Http\Controllers\Office\Civitas\Profile\EducationController;
use App\Http\Controllers\Office\Civitas\Profile\FundingController;
use App\Http\Controllers\Office\Civitas\Profile\ResearchController;
use App\Http\Controllers\Office\Civitas\Profile\StaffEducationController;
use App\Http\Controllers\Office\Civitas\Profile\StaffTeachingController;
use App\Http\Controllers\Office\Civitas\Profile\TeachingMentoringController;
use App\Http\Controllers\Office\Civitas\StaffCategoryController;
use App\Http\Controllers\Office\Civitas\StaffController;
use App\Http\Controllers\Office\CommentController;
use App\Http\Controllers\Office\DosenProfileController;
use App\Http\Controllers\Office\Himatek\HimatekController as OfficeHimatekController;
use App\Http\Controllers\Office\Himatif\HimatifController as OfficeHimatifController;
use App\Http\Controllers\Office\Himatera\HimateraController as OfficeHimateraController;
use App\Http\Controllers\Office\MainController;
use App\Http\Controllers\Office\PAKSimulationController;
use App\Http\Controllers\Office\ProgramStudiController;
use App\Http\Controllers\Office\Setting\LogoController;
use App\Http\Controllers\Office\Setting\RoleController;
use App\Http\Controllers\Office\StaffProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['domain' => ''], function () {
    Route::prefix('office')->name('office.')->group(function () {
        Route::get('/', function () {
            return redirect()->route('office.dashboard.index');
        });
        Route::prefix('auth')->name('auth.')->middleware('guest')->group(function () {
            Route::view('', 'pages.app.auth.login')->name('index');
            Route::view('forgot', 'pages.app.auth.forgot')->name('forgot');
            Route::get('reset/{token}', fn($token) => view('pages.profile.overview', compact('token')))->name('reset');
            Route::post('authenticate',[AuthController::class, 'do_login'])->name('login');

            Route::post('forgot-password',[AuthController::class, 'do_forgot'])->name('doforgot');

            Route::post('reset',[AuthController::class, 'do_reset'])->name('doreset');

        });
        Route::middleware('auth')->group(function () {
            Route::prefix('dashboard')->name('dashboard.')->group(function () {
                Route::get('', [MainController::class, 'index'])->name('index');
            });
            Route::prefix('dosen')->name('dosen.')->middleware('frole:4')->group(function () {
                Route::get('identitas', [DosenProfileController::class, 'identitas_dosen'])->name('identitas.index');
                Route::patch('identitas/update', [DosenProfileController::class, 'update_identitas_dosen'])->name('identitas.update');
                Route::get('about', [DosenProfileController::class, 'about'])->name('about.index');
                Route::patch('about/update', [DosenProfileController::class, 'update_about'])->name('about.update');

                Route::get('pendidikan', [DosenProfileController::class, 'pendidikan'])->name('pendidikan.index');
                Route::get('pendidikan/create', [DosenProfileController::class, 'create_pendidikan'])->name('pendidikan.create');
                Route::post('pendidikan/store', [DosenProfileController::class, 'store_pendidikan'])->name('pendidikan.store');
                Route::get('pendidikan/{education}/edit', [DosenProfileController::class, 'edit_pendidikan'])->name('pendidikan.edit');
                Route::patch('pendidikan/{education}/update', [DosenProfileController::class, 'update_pendidikan'])->name('pendidikan.update');
                Route::delete('pendidikan/{education}/destroy', [DosenProfileController::class, 'destroy_pendidikan'])->name('pendidikan.destroy');

                Route::get('pendanaan', [DosenProfileController::class, 'pendanaan'])->name('pendanaan.index');
                Route::get('pendanaan/create', [DosenProfileController::class, 'create_pendanaan'])->name('pendanaan.create');
                Route::post('pendanaan/store', [DosenProfileController::class, 'store_pendanaan'])->name('pendanaan.store');
                Route::get('pendanaan/{funding}/edit', [DosenProfileController::class, 'edit_pendanaan'])->name('pendanaan.edit');
                Route::patch('pendanaan/{funding}/update', [DosenProfileController::class, 'update_pendanaan'])->name('pendanaan.update');
                Route::delete('pendanaan/{funding}/destroy', [DosenProfileController::class, 'destroy_pendanaan'])->name('pendanaan.destroy');

                Route::get('research', [DosenProfileController::class, 'research'])->name('research.index');
                Route::get('research/create', [DosenProfileController::class, 'create_research'])->name('research.create');
                Route::post('research/store', [DosenProfileController::class, 'store_research'])->name('research.store');
                Route::get('research/{research}/edit', [DosenProfileController::class, 'edit_research'])->name('research.edit');
                Route::patch('research/{research}/update', [DosenProfileController::class, 'update_research'])->name('research.update');
                Route::delete('research/{research}/destroy', [DosenProfileController::class, 'destroy_research'])->name('research.destroy');

                Route::get('teaching-mentoring', [TeachingMentoringController::class, 'teaching_mentoring'])->name('teaching_mentoring.index');
                Route::get('teaching-mentoring/create', [TeachingMentoringController::class, 'create_teaching_mentoring'])->name('teaching_mentoring.create');
                Route::post('teaching-mentoring/store', [TeachingMentoringController::class, 'store_teaching_mentoring'])->name('teaching_mentoring.store');
                Route::get('teaching-mentoring/{teaching_mentoring}/edit', [TeachingMentoringController::class, 'edit_teaching_mentoring'])->name('teaching_mentoring.edit');
                Route::patch('teaching-mentoring/{teaching_mentoring}/update', [TeachingMentoringController::class, 'update_teaching_mentoring'])->name('teaching_mentoring.update');
                Route::delete('teaching-mentoring/{teaching_mentoring}/destroy', [TeachingMentoringController::class, 'destroy_teaching_mentoring'])->name('teaching_mentoring.destroy');
            });
            Route::prefix('staff')->name('staff.')->middleware('frole:5')->group(function () {
                Route::get('identitas', [StaffProfileController::class, 'identitas_staff'])->name('identitas.index');
                Route::patch('identitas/update', [StaffProfileController::class, 'update_identitas_staff'])->name('identitas.update');

                Route::get('tentang', [StaffProfileController::class, 'tentang_staff'])->name('tentang.index');
                Route::patch('tentang/update', [StaffProfileController::class, 'update_tentang_staff'])->name('tentang.update');

                Route::get('pendidikan', [StaffProfileController::class, 'pendidikan'])->name('pendidikan.index');
                Route::get('pendidikan/create', [StaffProfileController::class, 'create_pendidikan'])->name('pendidikan.create');
                Route::post('pendidikan/store', [StaffProfileController::class, 'store_pendidikan'])->name('pendidikan.store');
                Route::get('pendidikan/{education}/edit', [StaffProfileController::class, 'edit_pendidikan'])->name('pendidikan.edit');
                Route::patch('pendidikan/{education}/update', [StaffProfileController::class, 'update_pendidikan'])->name('pendidikan.update');
                Route::delete('pendidikan/{education}/destroy', [StaffProfileController::class, 'destroy_pendidikan'])->name('pendidikan.destroy');

                Route::get('pengajaran', [StaffTeachingController::class, 'staff_teaching'])->name('staff_teaching.index');
                Route::get('pengajaran/create', [StaffTeachingController::class, 'create_teaching'])->name('staff_teaching.create');
                Route::post('pengajaran/store', [StaffTeachingController::class, 'store'])->name('staff_teaching.store');
                Route::get('pengajaran/{staff_teaching}/edit', [StaffTeachingController::class, 'edit_teaching'])->name('staff_teaching.edit');
                Route::patch('pengajaran/{staff_teaching}/update', [StaffTeachingController::class, 'update'])->name('staff_teaching.update');
                Route::delete('pengajaran/{staff_teaching}/destroy', [StaffTeachingController::class, 'destroy'])->name('staff_teaching.destroy');
            });
            Route::prefix('himatek')->name('himatek.')->middleware('frole:6')->group(function () {
                Route::resource('activity', OfficeHimatekController::class);
            });
            Route::prefix('himatif')->name('himatif.')->middleware('frole:6')->group(function () {
                Route::resource('activity', OfficeHimatifController::class);
            });
            Route::prefix('himatera')->name('himatera.')->middleware('frole:6')->group(function () {
                Route::resource('activity', OfficeHimateraController::class);
            });
            Route::prefix('about')->name('about.')->middleware('frole:1')->group(function () {
                Route::resource('vision', VisionController::class);
                Route::resource('history', HistoryController::class);
                Route::resource('organization', OrganizationController::class);
            });
            Route::prefix('civitas')->name('civitas.')->middleware('frole:1')->group(function () {
                Route::resource('staff', StaffController::class);
                Route::resource('category-staff', StaffCategoryController::class);
                Route::prefix('staff')->name('staff.')->group(function () {
                    Route::get('{staff}/personal', [StaffController::class, 'identitas_staf'])->name('personal.index');
                    Route::patch('{staff}/personal', [StaffController::class, 'update_identitas_staf'])->name('personal.update');

                    Route::get('{staff}/about', [StaffController::class, 'tentang_staff'])->name('about.index');
                    Route::patch('{staff}/about', [StaffController::class, 'update_tentang_staff'])->name('about.update');

                    Route::resource('education', StaffEducationController::class);
                    Route::get('{staff}/education', [StaffEducationController::class, 'index'])->name('education.index');
                    Route::get('{staff}/education/create', [StaffEducationController::class, 'create'])->name('education.create');
                    Route::get('{staff}/education/{education}/edit', [StaffEducationController::class, 'edit'])->name('education.edit');

                    Route::resource('staff-teaching', StaffTeachingController::class);
                    Route::get('{staff}/staff-teaching', [StaffTeachingController::class, 'index'])->name('staff-teaching.index');
                    Route::get('{staff}/staff-teaching/create', [StaffTeachingController::class, 'create'])->name('staff-teaching.create');
                    Route::get('{staff}/staff-teaching/{staff_teaching}/edit', [StaffTeachingController::class, 'edit'])->name('staff-teaching.edit');
                });
                Route::resource('dosen', DosenController::class);
                Route::resource('category-dosen', DosenCategoryController::class);
                Route::prefix('dosen')->name('dosen.')->group(function () {
                    Route::resource('research', ResearchController::class);
                    Route::get('{dosen}/research', [ResearchController::class, 'index'])->name('research.index');
                    Route::get('{dosen}/research/create', [ResearchController::class, 'create'])->name('research.create');
                    Route::get('{dosen}/{research}/edit-research', [ResearchController::class, 'edit'])->name('research.edit');

                    Route::resource('teaching-mentoring', TeachingMentoringController::class);
                    Route::get('{dosen}/teaching-mentoring', [TeachingMentoringController::class, 'index'])->name('teaching-mentoring.index');
                    Route::get('{dosen}/teaching-mentoring/create', [TeachingMentoringController::class, 'create'])->name('teaching-mentoring.create');
                    Route::get('{dosen}/{teaching_mentoring}/edit-teaching-mentoring', [TeachingMentoringController::class, 'edit'])->name('teaching-mentoring.edit');

                    Route::resource('funding', FundingController::class);
                    Route::get('{dosen}/funding', [FundingController::class, 'index'])->name('funding.index');
                    Route::get('{dosen}/funding/create', [FundingController::class, 'create'])->name('funding.create');
                    Route::get('{dosen}/{funding}/edit-funding', [FundingController::class, 'edit'])->name('funding.edit');

                    Route::get('{dosen}/about', [DosenController::class, 'about'])->name('about.index');
                    Route::patch('{dosen}/about', [DosenController::class, 'edit_about'])->name('about.update');

                    Route::get('{dosen}/personal', [DosenController::class, 'personal'])->name('personal.index');
                    Route::patch('{dosen}/personal', [DosenController::class, 'edit_personal'])->name('personal.update');

                    Route::resource('education', EducationController::class);
                    Route::get('{dosen}/education', [EducationController::class, 'index'])->name('education.index');
                    Route::get('{dosen}/education/create', [EducationController::class, 'create'])->name('education.create');
                    Route::get('{dosen}/education/{education}/edit', [EducationController::class, 'edit'])->name('education.edit');
                });
            });
            Route::prefix('account')->name('account.')->middleware('frole:1')->group(function() {
                Route::resource('dekan', DekanController::class);
                Route::resource('ka-prodi', KAProdiController::class);
                Route::resource('himpunan', HimpunanController::class);
                Route::resource('category-ka-prodi', KAProdiCategoryController::class);
                Route::resource('category-himpunan', HimpunanCategoryController::class);
            });
            Route::prefix('timeline')->name('timeline.')->middleware('frole:1')->group(function () {
                Route::resource('activity', ActivityController::class);
                Route::resource('news', NewsController::class);
            });
            Route::prefix('appearance')->name('appearance.')->middleware('frole:1')->group(function () {
                Route::resource('carousel', CarouselController::class);
                Route::get('breaking-news-section', [HomeMenuController::class, 'breaking_news_sections'])->name('breaking-news-section.index');
                Route::patch('breaking-news-section/update', [HomeMenuController::class, 'breaking_news_sections_update'])->name('breaking-news-section.update');
                Route::get('civitas-section', [HomeMenuController::class, 'civitas_section'])->name('civitas-section.index');
                Route::patch('civitas-section/update', [HomeMenuController::class, 'civitas_section_update'])->name('civitas-section.update');
                Route::get('faculty-explore-section', [HomeMenuController::class, 'faculty_explore_section'])->name('faculty-explore-section.index');
                Route::patch('faculty-explore-section/update', [HomeMenuController::class, 'faculty_explore_section_update'])->name('faculty-explore-section.update');
                Route::get('faculty-items-section', [HomeMenuController::class, 'faculty_items_section'])->name('faculty-items-section.index');
                Route::get('faculty-items-section/create', [HomeMenuController::class, 'faculty_items_section_create'])->name('faculty-items-section.create');
                Route::post('faculty-items-section/store', [HomeMenuController::class, 'faculty_items_section_store'])->name('faculty-items-section.store');
                Route::get('faculty-items-section/{fis}/edit', [HomeMenuController::class, 'faculty_items_section_edit'])->name('faculty-items-section.edit');
                Route::patch('faculty-items-section/{fis}/update', [HomeMenuController::class, 'faculty_items_section_update'])->name('faculty-items-section.update');
                Route::get('study-program-section', [HomeMenuController::class, 'study_program_section'])->name('study-program-section.index');
                Route::patch('study-program-section/update', [HomeMenuController::class, 'study_program_section_update'])->name('study-program-section.update');
                Route::get('meet-our-students-section', [HomeMenuController::class, 'meet_our_students_section'])->name('meet-our-students-section.index');
                Route::patch('meet-our-students-section/update', [HomeMenuController::class, 'meet_our_students_section_update'])->name('meet-our-students-section.update');
                Route::resource('web-footer', FooterController::class);
            });
            Route::prefix('setting')->name('setting.')->middleware('frole:1')->group(function () {
                // Route::resource('config', ConfigController::class);
                // Route::resource('permission', PermissionController::class);
                Route::resource('role', RoleController::class);
                Route::get('logo', [LogoController::class, 'index'])->name('logo.index');
                Route::patch('logo/update', [LogoController::class, 'update'])->name('logo.update');
            });
            Route::get('pak-simulation', [PAKSimulationController::class, 'index'])->name('pak-simulation.index');
            Route::patch('pak-simulation/update', [PAKSimulationController::class, 'update'])->name('pak-simulation.update');
            Route::resource('category-prodi', CategoryProdiController::class)->middleware('frole:1');
            Route::resource('comment', CommentController::class)->middleware('frole:1');
            Route::resource('program-studi', ProgramStudiController::class)->middleware('frole:1');
            Route::get('logout', [AuthController::class, 'do_logout'])->name('auth.logout');
        });
    });
});

<?php

namespace Database\Seeders;

use App\Models\Appearance\Home\BreakingNewsSection;
use App\Models\Appearance\Home\CivitasSection;
use App\Models\Appearance\Home\FacultyExploreSection;
use App\Models\Appearance\Home\FacultyItemsSections;
use App\Models\Appearance\Home\MeetOurStudentsSection;
use App\Models\Appearance\Home\StudyProgramSection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class HomeMenuSeeder extends Seeder
{
    public function run()
    {
        $breaking_news = new BreakingNewsSection();
        $breaking_news->title = 'Berita Terkini';
        $breaking_news->limit = 12;
        $breaking_news->is_active = true;
        $breaking_news->save();

        $civitas_section = new CivitasSection();
        $civitas_section->title = 'Civitas Fakultas Vokasi';
        $thumbnail = public_path('web/images/civitas.png');
        $civitas_section->thumbnail = Storage::putFile('public/home', $thumbnail);
        $civitas_section->desc = 'Fakultas Vokasi memiliki Civitas yang beragam dan berkompeten di bidangnya masing-masing.';
        $civitas_section->url = '/civitas/dosen';
        $civitas_section->is_active = true;
        $civitas_section->save();

        $faculty_explore_section = new FacultyExploreSection();
        $faculty_explore_section->title = 'Eksplor Fakultas';
        $faculty_explore_section->text_under_title = '';
        $faculty_explore_section->is_active = true;
        $faculty_explore_section->save();

        $fis_thumbnail_1 = public_path('web/images/sejarah-card.png');
        $fis_thumbnail_2 = public_path('web/images/prodi-card.png');
        $fis_thumbnail_3 = public_path('web/images/civitas-card.png');
        $fis_thumbnail_4 = public_path('web/images/kegiatan-card.png');
        $faculty_items_section = [
            [
                'title' => 'Sejarah',
                'url' => '/tentang-kami#sejarah',
                'thumbnail' => Storage::putFile('public/home/fakultas', $fis_thumbnail_1),
                'is_active' => true,
            ],
            [
                'title' => 'Program Studi',
                'url' => '/program/d-iii-teknologi-informasi',
                'thumbnail' => Storage::putFile('public/home/fakultas', $fis_thumbnail_2),
                'is_active' => true,
            ],
            [
                'title' => 'Civitas',
                'url' => '/civitas/dosen',
                'thumbnail' => Storage::putFile('public/home/fakultas', $fis_thumbnail_3),
                'is_active' => true,
            ],
            [
                'title' => 'Kegiatan',
                'url' => 'route("web.activity", "himatek")',
                'thumbnail' => Storage::putFile('public/home/fakultas', $fis_thumbnail_4),
                'is_active' => true,
            ],
        ];
        foreach ($faculty_items_section as $item) {
            $faculty_items_sections = new FacultyItemsSections();
            $faculty_items_sections->title = $item['title'];
            $faculty_items_sections->url = $item['url'];
            $faculty_items_sections->thumbnail = $item['thumbnail'];
            $faculty_items_sections->is_active = $item['is_active'];
            $faculty_items_sections->save();
        }

        $study_program_section = new StudyProgramSection();
        $study_program_section->title = 'Temukan Program Studi Anda';
        $thumbnail = public_path('web/images/prodi.png');
        $study_program_section->thumbnail = Storage::putFile('public/home', $thumbnail);
        $study_program_section->desc = 'Fakultas Vokasi memiliki sejumlah Program Studi yang beragam dan berkompeten di bidangnya masing-masing.';
        $study_program_section->url = '/program/d-iii-teknologi-informasi';
        $study_program_section->is_active = true;
        $study_program_section->save();

        $meet_our_student_section = new MeetOurStudentsSection();
        $meet_our_student_section->title = 'Temui Mahasiswa Kami';
        $thumbnail = public_path('web/images/bottom-bg.png');
        $meet_our_student_section->thumbnail = Storage::putFile('public/home', $thumbnail);
        $meet_our_student_section->desc = 'Ayo berkenalan bersama siswa kami dengan melihat kegiatan-kegiatan menarik lainnya yang nspiratif dan beragam yang dilakukan oleh para siswa kami.';
        $meet_our_student_section->url = '/aktivitas/himatek';
        $meet_our_student_section->is_active = true;
        $meet_our_student_section->save();
    }
}

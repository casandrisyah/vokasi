<?php

namespace Database\Seeders;

use App\Models\Appearance\Carousel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class CarouselSeeder extends Seeder
{
    public function run()
    {
        $carousel1 = new Carousel();
        $carousel1->title = 'Fakultas Vokasi <br>Institut Teknologi Del';
        $carousel1->desc = '';
        $carousel1->url = 'home';
        $thumbnail = public_path('web/images/home-page.png');
        $carousel1->thumbnail = Storage::putFile('public/carousel', $thumbnail);
        $carousel1->is_active = true;
        $carousel1->save();

        $carousel2 = new Carousel();
        $carousel2->title = 'Ketahui Tentang Kami';
        $carousel2->desc = 'Sistem Fakultas Vokasi memiliki Sejarah dan Visi-Misi sebagai informasi yang perlu untuk Anda ketahui.';
        $carousel2->url = 'tentang';
        $thumbnail = public_path('web/images/tentang1.png');
        $carousel2->thumbnail = Storage::putFile('public/carousel', $thumbnail);
        $carousel2->is_active = true;
        $carousel2->save();

        $carousel3 = new Carousel();
        $carousel3->title = 'Berita Del';
        $carousel3->desc = '';
        $carousel3->url = 'berita';
        $thumbnail = public_path('web/images/berita.png');
        $carousel3->thumbnail = Storage::putFile('public/carousel', $thumbnail);
        $carousel3->is_active = true;
        $carousel3->save();

        $carousel4 = new Carousel();
        $carousel4->title = 'Program Studi';
        $carousel4->desc = '';
        $carousel4->url = 'program';
        $thumbnail = public_path('web/images/tentang1.png');
        $carousel4->thumbnail = Storage::putFile('public/carousel', $thumbnail);
        $carousel4->is_active = true;
        $carousel4->save();

        $carousel5 = new Carousel();
        $carousel5->title = 'Civitas';
        $carousel5->desc = '';
        $carousel5->url = 'civitas';
        $thumbnail = public_path('web/images/civitas-page.png');
        $carousel5->thumbnail = Storage::putFile('public/carousel', $thumbnail);
        $carousel5->is_active = true;
        $carousel5->save();

        $carousel6 = new Carousel();
        $carousel6->title = 'Himpunan Mahasiswa';
        $carousel6->desc = '';
        $carousel6->url = 'aktivitas';
        $thumbnail = public_path('web/images/himatera2.jpeg');
        $carousel6->thumbnail = Storage::putFile('public/carousel', $thumbnail);
        $carousel6->is_active = true;
        $carousel6->save();

    }
}

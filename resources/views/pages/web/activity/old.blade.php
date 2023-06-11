<x-web-layout title="Aktivitas {{$name}}">
    @php
    $user = \App\Models\Civitas\User::where('name',$name)->first();
    if($name == "Himatek"){
        $fname = "HIMPUNAN MAHASISWA TEKNOLOGI KOMPUTER";
    }
    elseif($name == "Himatif"){
        $fname = "HIMPUNAN MAHASISWA TEKNOLOGI INFORMASI";
    }else{
        $fname = "HIMPUNAN MAHASISWA TEKNOLOGI REKAYASA PERANGKAT LUNAK";
    }
    @endphp
    <div class="col-12">
        <img src="{{ 'web/images/himatera3.jpeg' }}" alt="himatera3" style="top: 15%; width: 100%; height: 600px">
    </div>
    <br>
    <div class="container" style="text-align: center">
        <h2><b>{{Str::upper($name)}}</b></h2>
        <h4 style="padding: 1px; color:#053084">{{$fname}}</h4>
    </div>
    <br>
    <div class="container">
        <div class="row">
            @foreach(\App\Models\Timeline\Activity::where('user_id',$user->id)->where('st',true)->get() as $item)
            <div class="col">
                <img src="{{ $item->image }}" alt="{{$item->title}}"> <br>
                {{$item->title}}<br>
                <span>{{$item->date->format('D, d M Y')}} WIB</span><br>
                <span>{{$item->location}}</span><br>
            </div>
            @endforeach
        </div>
        <br><br><br><br><br><br><br><br>
        <div>
            <h5><b>Memiliki aktivitas atau event himpunan yang lain?</b></h5>
            <p>Bagikan acara Anda dengan himpunan dengan menggunakan formulir pengiriman acara sederhana ini.</p>
            <a class="btn btn-outline-secondary" href="#" role="button">Kirim Aktivitas <i
                    class="bi bi-arrow-right"></i></a>
        </div>
        <br><br><br><br><br><br><br><br>
    </div>
</x-web-layout>

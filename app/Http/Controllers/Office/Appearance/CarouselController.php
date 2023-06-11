<?php

namespace App\Http\Controllers\Office\Appearance;

use Illuminate\Http\Request;
use App\Models\Appearance\Carousel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CarouselController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $collection = Carousel::paginate(10);
            return view('pages.app.appearance.carousel.list', compact('collection'));
        }
        return view('pages.app.appearance.carousel.main');
    }

    public function create()
    {
        return view('pages.app.appearance.carousel.input', ['data' => new Carousel]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'gambar' => 'required|image|mimes:jpeg,png,jpg',
            'url' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }
        $carousel = new Carousel;
        $carousel->title = $request->title;
        $carousel->desc = $request->deskripsi;
        $all = Carousel::where('url', $request->url)->get();
        foreach ($all as $key => $value) {
            if ($value->is_active == 1) {
                $value->is_active = 0;
                $value->update();
            }
        }
        $carousel->url = $request->url;
        if(request()->file('gambar')){
            // Storage::delete($carousel->thumbnail);
            $file = request()->file('gambar')->store("public/carousel");
            $carousel->thumbnail = $file;
        }
        $carousel->save();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil ditambahkan',
        ]);
    }

    public function show(Carousel $carousel)
    {
        //
    }

    public function edit(Carousel $carousel)
    {
        return view('pages.app.appearance.carousel.input', ['data' => $carousel]);
    }

    public function update(Request $request, Carousel $carousel)
    {
        if ($request->is_active !== null) {
            $all = Carousel::where('url', $carousel->url)->where('id', '!=', $carousel->id)->get();
            foreach ($all as $key => $value) {
                if ($value->is_active == 1) {
                    $value->is_active = 0;
                    $value->update();
                }
            }
            $carousel->is_active = $request->is_active;
            $message = 'Data berhasil diaktifkan';
            if ($request->is_active == 0) {
                $message = 'Data berhasil dinonaktifkan';
            }
            $carousel->update();
            return response()->json([
                'alert' => 'success',
                'message' => $message,
            ]);
        }
        $validator = Validator::make($request->all(), [
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg',
            'url' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }
        $carousel->title = $request->title;
        $carousel->desc = $request->deskripsi;
        $all = Carousel::where('url', $request->url)->where('id', '!=', $carousel->id)->get();
        foreach ($all as $key => $value) {
            if ($value->is_active == 1) {
                $value->is_active = 0;
                $value->update();
            }
        }
        $carousel->url = $request->url;
        if(request()->file('gambar')){
            Storage::delete($carousel->thumbnail);
            $file = request()->file('gambar')->store("public/carousel");
            $carousel->thumbnail = $file;
        }
        $carousel->update();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil diperbaharui',
        ]);
    }

    public function destroy(Carousel $carousel)
    {
        Storage::delete($carousel->thumbnail);
        $carousel->delete();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil dihapus',
        ]);
    }
}

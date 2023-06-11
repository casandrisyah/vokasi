<?php

namespace App\Http\Controllers\Office\Timeline;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Timeline\News;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $collection = News::paginate(10);
            return view('pages.app.timeline.news.list',compact('collection'));
        }
        return view('pages.app.timeline.news.main');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.app.timeline.news.input', ['data' => new News]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'oleh' => 'required',
            'description' => 'required',
            'gambar' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }
        $news = new News;
        $news->title = $request->judul;
        $news->created_by = $request->oleh;
        $news->slug = Str::slug($request->judul);
        $news->desc = $request->description;
        if(request()->file('gambar')){
            // Storage::delete($organization->thumbnail);
            $file = request()->file('gambar')->store("public/news");
            $news->thumbnail = $file;
        }
        if ($request->utama) {
            $news->is_primary = 1;
            News::where('is_primary', 1)->update(['is_primary' => 0]);
        } else {
            $news->is_primary = 0;
        }
        $news->save();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil ditambahkan',
        ], 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Timeline\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show(News $news)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Timeline\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        return view('pages.app.timeline.news.input', ['data' => $news]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Timeline\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        // dd($request->all());
        if ($request->is_active !== null) {
            $news->is_active = $request->is_active;
            $message = 'Data berhasil diaktifkan';
            if ($request->is_active == 0) {
                $news->is_primary = 0;
                $message = 'Data berhasil dinonaktifkan';
            }
            $news->update();
            return response()->json([
                'alert' => 'success',
                'message' => $message,
            ]);
        }
        $validator = Validator::make($request->all(), [
            'judul' => 'required',
            'oleh' => 'required',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }
        $news->title = $request->judul;
        $news->created_by = $request->oleh;
        $news->slug = Str::slug($request->judul);
        $news->desc = $request->description;
        if(request()->file('gambar')){
            Storage::delete($news->thumbnail);
            $file = request()->file('gambar')->store("public/news");
            $news->thumbnail = $file;
        }
        // dd($request->all());
        if ($request->utama) {
            $news->is_primary = $request->utama;
            News::where('id', '!=', $news->id)->update(['is_primary' => 0]);
        } else {
            $news->is_primary = 0;
        }
        $news->update();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil diperbaharui',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Timeline\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        Storage::delete($news->thumbnail);
        $news->delete();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil dihapus',
        ]);
    }
}

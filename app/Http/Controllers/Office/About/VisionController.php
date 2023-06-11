<?php

namespace App\Http\Controllers\Office\About;

use App\Models\About\Vision;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class VisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->ajax()){
            $collection = Vision::paginate(10);
            return view('pages.app.about.vision.list', compact('collection'));
        }
        return view('pages.app.about.vision.main');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.app.about.vision.input', ['data' => new Vision]);
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
            'visi' => 'required',
            'misi' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }
        $vision = new Vision;
        $vision->visi = $request->visi;
        $vision->misi = $request->misi;
        $vision->save();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil ditambahkan',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\About\Vision  $vision
     * @return \Illuminate\Http\Response
     */
    public function show(Vision $vision)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\About\Vision  $vision
     * @return \Illuminate\Http\Response
     */
    public function edit(Vision $vision)
    {
        return view('pages.app.about.vision.input', ['data' => $vision]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\About\Vision  $vision
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vision $vision)
    {
        if ($request->is_active !== null) {
            $vision->is_active = $request->is_active;
            $message = 'Data berhasil diaktifkan';
            if ($request->is_active == 0) {
                $message = 'Data berhasil dinonaktifkan';
            }
            $vision->update();
            return response()->json([
                'alert' => 'success',
                'message' => $message,
            ]);
        }
        $validator = Validator::make($request->all(), [
            'visi' => 'required',
            'misi' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }
        $vision->visi = $request->visi;
        $vision->misi = $request->misi;
        $vision->update();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil diperbaharui',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\About\Vision  $vision
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vision $vision)
    {
        $vision->delete();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil dihapus',
        ]);
    }
}

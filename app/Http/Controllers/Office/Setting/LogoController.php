<?php

namespace App\Http\Controllers\Office\Setting;

use App\Http\Controllers\Controller;
use App\Models\Setting\Logo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LogoController extends Controller
{
    public function index()
    {
        $logo = Logo::first();
        $compact = $logo ? ['data' => $logo] : ['data' => new Logo()];
        return view('pages.app.setting.logo.input', $compact);
    }

    public function update(Request $request) {
        $logo = Logo::first();
        if ($logo) {
            $validator = Validator::make($request->all(), [
                'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
                'faculty' => 'required',
                'university' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $validator->errors()->first()
                ], 200);
            }
            if ($request->file('thumbnail')) {
                $file = request()->file('thumbnail')->store("public/setting");
                $logo->thumbnail = $file;
            }
            $logo->faculty = $request->faculty;
            $logo->university = $request->university;
            $logo->facebook_url = $request->facebook_url;
            $logo->instagram_url = $request->instagram_url;
            $logo->youtube_url = $request->youtube_url;
            $logo->linkedin_url = $request->linkedin_url;
            $logo->is_active = $request->is_active ? true : false;
            $logo->save();

            return response()->json([
                'alert' => 'success',
                'message' => 'Data berhasil diubah'
            ], 200);
        } else {
            $validator = Validator::make($request->all(), [
                'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
                'faculty' => 'required',
                'university' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $validator->errors()->first()
                ], 200);
            }
            $logo = new Logo();
            if ($request->file('thumbnail')) {
                $file = request()->file('thumbnail')->store("public/setting");
                $logo->thumbnail = $file;
            }
            $logo->faculty = $request->faculty;
            $logo->university = $request->university;
            $logo->facebook_url = $request->facebook_url;
            $logo->instagram_url = $request->instagram_url;
            $logo->youtube_url = $request->youtube_url;
            $logo->linkedin_url = $request->linkedin_url;
            $logo->is_active = $request->is_active ? true : false;
            $logo->save();

            return response()->json([
                'alert' => 'success',
                'message' => 'Data berhasil Disimpan'
            ], 200);
        }
    }
}

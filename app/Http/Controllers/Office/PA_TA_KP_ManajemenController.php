<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Models\PA_TA_KP_Manajemen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PA_TA_KP_ManajemenController extends Controller
{
    public function index()
    {
        $pa_ta_kp_manajemen = PA_TA_KP_Manajemen::first();
        $compact = $pa_ta_kp_manajemen ? ['data' => $pa_ta_kp_manajemen] : ['data' => new PA_TA_KP_Manajemen()];
        return view('pages.app.pa_ta_kp_manajemen.input', $compact);
    }

    public function update(Request $request) {
        $pa_ta_kp_manajemen = PA_TA_KP_Manajemen::first();
        if ($pa_ta_kp_manajemen) {
            $validator = Validator::make($request->all(), [
                'url' => 'required',
            ], [
                'url.required' => 'URL tidak boleh kosong',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $validator->errors()->first()
                ], 200);
            }
            if ($request->file('thumbnail')) {
                $file = request()->file('thumbnail')->store("public/setting");
                $pa_ta_kp_manajemen->thumbnail = $file;
            }
            $pa_ta_kp_manajemen->url = $request->url;
            $pa_ta_kp_manajemen->is_active = $request->is_active ? true : false;
            $pa_ta_kp_manajemen->save();

            return response()->json([
                'alert' => 'success',
                'message' => 'Data berhasil diubah'
            ], 200);
        } else {
            $validator = Validator::make($request->all(), [
                'url' => 'required',
            ], [
                'url.required' => 'URL tidak boleh kosong',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'alert' => 'error',
                    'message' => $validator->errors()->first()
                ], 200);
            }
            $pa_ta_kp_manajemen = new PA_TA_KP_Manajemen();
            if ($request->file('thumbnail')) {
                $file = request()->file('thumbnail')->store("public/setting");
                $pa_ta_kp_manajemen->thumbnail = $file;
            }
            $pa_ta_kp_manajemen->url = $request->url;
            $pa_ta_kp_manajemen->is_active = $request->is_active ? true : false;
            $pa_ta_kp_manajemen->save();

            return response()->json([
                'alert' => 'success',
                'message' => 'Data berhasil Disimpan'
            ], 200);
        }
    }
}

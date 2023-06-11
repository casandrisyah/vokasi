<?php

namespace App\Http\Controllers\Office;

use App\Http\Controllers\Controller;
use App\Models\PAKSimulation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PAKSimulationController extends Controller
{
    public function index()
    {
        $pak_simulation = PAKSimulation::first();
        $compact = $pak_simulation ? ['data' => $pak_simulation] : ['data' => new PAKSimulation()];
        return view('pages.app.pak_simulation.input', $compact);
    }

    public function update(Request $request) {
        $pak_simulation = PAKSimulation::first();
        if ($pak_simulation) {
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
                $pak_simulation->thumbnail = $file;
            }
            $pak_simulation->url = $request->url;
            $pak_simulation->is_active = $request->is_active ? true : false;
            $pak_simulation->save();

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
            $pak_simulation = new PAKSimulation();
            if ($request->file('thumbnail')) {
                $file = request()->file('thumbnail')->store("public/setting");
                $pak_simulation->thumbnail = $file;
            }
            $pak_simulation->url = $request->url;
            $pak_simulation->is_active = $request->is_active ? true : false;
            $pak_simulation->save();

            return response()->json([
                'alert' => 'success',
                'message' => 'Data berhasil Disimpan'
            ], 200);
        }
    }
}

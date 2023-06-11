<?php

namespace App\Http\Controllers\Office\Appearance;

use App\Http\Controllers\Controller;
use App\Models\Appearance\Footer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FooterController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $collection = Footer::paginate(10);
            return view('pages.app.appearance.web_footer.list', compact('collection'));
        }
        return view('pages.app.appearance.web_footer.main');
    }

    public function create()
    {
        return view('pages.app.appearance.web_footer.input', ['data' => new Footer]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'section' => 'required',
            'text' => 'required',
            'url' => 'required',
        ],[
            'section.required' => 'Section tidak boleh kosong',
            'text.required' => 'Teks tidak boleh kosong',
            'url.required' => 'Url tidak boleh kosong',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }
        $web_footer = new Footer;
        $web_footer->section = $request->section;
        $web_footer->text = $request->text;
        $web_footer->url = $request->url;
        $web_footer->save();

        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil disimpan',
        ]);
    }

    public function edit(Footer $web_footer)
    {
        return view('pages.app.appearance.web_footer.input', ['data' => $web_footer]);
    }

    public function update(Request $request, Footer $web_footer)
    {
        if ($request->is_active !== null) {
            $web_footer->is_active = $request->is_active;
            $message = 'Data berhasil diaktifkan';
            if ($request->is_active == 0) {
                $message = 'Data berhasil dinonaktifkan';
            }
            $web_footer->update();
            return response()->json([
                'alert' => 'success',
                'message' => $message,
            ]);
        }
        $validator = Validator::make($request->all(), [
            'section' => 'required',
            'text' => 'required',
            'url' => 'required',
        ],[
            'section.required' => 'Section tidak boleh kosong',
            'text.required' => 'Teks tidak boleh kosong',
            'url.required' => 'Url tidak boleh kosong',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'alert' => 'error',
                'message' => $validator->errors()->first(),
            ], 200);
        }
        $web_footer->section = $request->section;
        $web_footer->text = $request->text;
        $web_footer->url = $request->url;
        $web_footer->update();

        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil disimpan',
        ]);
    }

    public function show(Footer $web_footer)
    {
        //
    }

    public function destroy(Footer $web_footer)
    {
        $web_footer->delete();
        return response()->json([
            'alert' => 'success',
            'message' => 'Data berhasil dihapus',
        ]);
    }
}

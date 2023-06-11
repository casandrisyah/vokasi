<?php

namespace App\Http\Controllers\Office\Setting;

use Illuminate\Http\Request;
use App\Helpers\ConfigHelper;
use App\Models\Setting\Config;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Config $config)
    {
        return view('pages.app.setting.config.main', ['data' => $config]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function edit(Config $config)
    {
        return view('pages.app.setting.config.input', ['data' => $config]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting\Config  $config
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        foreach(Config::where('type',$request->type)->get() as $config){
            $key = $config->key;
            if($key == "APP_LOGO"){
                if(request()->file($key)){
                    Storage::delete($config->value);
                    $file = request()->file($key)->store("logo");
                    $config->value = $file;
                    $config->update();
                }
            }elseif($key == "WA_WIDGET_ACTIVE"){
                $config->value = request()->$key ?? 0;
                $config->update();
            }else{
                $config->value = request()->$key;
                $config->update();
            }
        }
        $config = new ConfigHelper;
        $config->overwriteEnvFromDatabase();
        return response()->json([
            'alert' => 'success',
            'message' => 'Pengaturan berhasil diperbaharui',
        ]);
    }
}

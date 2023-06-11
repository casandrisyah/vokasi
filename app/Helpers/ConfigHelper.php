<?php

namespace App\Helpers;
use Illuminate\Support\Facades\DB;

class ConfigHelper{
    function overwriteEnvFromDatabase()
    {
        $env = file_get_contents(base_path('.env'));
    
        $settings = DB::table('configs')->pluck('value', 'key')->toArray();
    
        foreach ($settings as $key => $value) {
            $env = preg_replace('/^' . $key . '=(.*)$/m', $key . '="' . $value.'"', $env);
        }
    
        file_put_contents(base_path('.env'), $env);
    }
}
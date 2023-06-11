<?php

namespace Database\Seeders;

use App\Models\Config\Day;
use App\Models\Master\Bank;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ConfigSeeder extends Seeder
{
    public function run()
    {
        $day = array(
            [
                'd' => '1'
            ],
            [
                'd' => '2'
            ],
            [
                'd' => '3'
            ],
            [
                'd' => '4'
            ],
            [
                'd' => '5'
            ],
            [
                'd' => '6'
            ],
            [
                'd' => '7'
            ],
            [
                'd' => '8'
            ],
            [
                'd' => '9'
            ],
            [
                'd' => '10'
            ],
            [
                'd' => '11'
            ],
            [
                'd' => '12'
            ],
            [
                'd' => '13'
            ],
            [
                'd' => '14'
            ],
            [
                'd' => '15'
            ],
            [
                'd' => '16'
            ],
            [
                'd' => '17'
            ],
            [
                'd' => '18'
            ],
            [
                'd' => '19'
            ],
            [
                'd' => '20'
            ],
            [
                'd' => '21'
            ],
            [
                'd' => '22'
            ],
            [
                'd' => '23'
            ],
            [
                'd' => '24'
            ],
            [
                'd' => '25'
            ],
            [
                'd' => '26'
            ],
            [
                'd' => '27'
            ],
            [
                'd' => '28'
            ],
            [
                'd' => '29'
            ],
            [
                'd' => '30'
            ],
            [
                'd' => '31'
            ],
        );
        foreach($day AS $d){
            Day::create([
                'id' => $d['d']
            ]);
        }
        DB::table('configs')->insert([
            ['type'=> 'app', 'key' => 'APP_NAME', 'value' => 'DEL'],
            ['type'=> 'app', 'key' => 'APP_ENV', 'value' => 'local'],
            ['type'=> 'app', 'key' => 'APP_DEBUG', 'value' => 'true'],
            ['type'=> 'app', 'key' => 'APP_URL', 'value' => 'https://host/del'],
            ['type'=> 'app', 'key' => 'ASSET_URL', 'value' => 'https://cdn.yadaekidanta.com/'],
            ['type'=> 'app', 'key' => 'APP_TIMEZONE', 'value' => 'Asia/Jakarta'],
            ['type'=> 'app', 'key' => 'APP_LOCALE', 'value' => 'en'],
            ['type'=> 'app', 'key' => 'APP_FALLBACK_LOCALE', 'value' => 'en'],
            ['type'=> 'app', 'key' => 'APP_FAKER_LOCALE', 'value' => 'en_US'],
            ['type'=> 'app', 'key' => 'APP_LOGO', 'value' => 'logo/icon.png'],
            ['type'=> 'log', 'key' => 'LOG_CHANNEL', 'value' => 'stack'],
            ['type'=> 'log', 'key' => 'LOG_DEPRECATIONS_CHANNEL', 'value' => 'null'],
            ['type'=> 'log', 'key' => 'LOG_LEVEL', 'value' => 'debug'],
            ['type'=> 'database', 'key' => 'DB_CONNECTION', 'value' => 'mysql'],
            ['type'=> 'database', 'key' => 'DB_HOST', 'value' => 'localhost'],
            ['type'=> 'database', 'key' => 'DB_PORT', 'value' => '3306'],
            ['type'=> 'database', 'key' => 'DB_DATABASE', 'value' => 'del'],
            ['type'=> 'database', 'key' => 'DB_USERNAME', 'value' => 'root'],
            ['type'=> 'database', 'key' => 'DB_PASSWORD', 'value' => 'root'],
            ['type'=> 'broadcast', 'key' => 'BROADCAST_DRIVER', 'value' => 'log'],
            ['type'=> 'cache', 'key' => 'CACHE_DRIVER', 'value' => 'file'],
            ['type'=> 'storage', 'key' => 'FILESYSTEM_DISK', 'value' => 'public'],
            ['type'=> 'queue', 'key' => 'QUEUE_CONNECTION', 'value' => 'sync'],
            ['type'=> 'session', 'key' => 'SESSION_DRIVER', 'value' => 'file'],
            ['type'=> 'session', 'key' => 'SESSION_LIFETIME', 'value' => '525600'],
            ['type'=> 'cache', 'key' => 'MEMCACHED_HOST', 'value' => '127.0.0.1'],
            ['type'=> 'redis', 'key' => 'REDIS_HOST', 'value' => '127.0.0.1'],
            ['type'=> 'redis', 'key' => 'REDIS_PASSWORD', 'value' => 'null'],
            ['type'=> 'redis', 'key' => 'REDIS_PORT', 'value' => '6379'],
            ['type'=> 'storage', 'key' => 'AWS_ACCESS_KEY_ID', 'value' => ''],
            ['type'=> 'storage', 'key' => 'AWS_SECRET_ACCESS_KEY', 'value' => ''],
            ['type'=> 'storage', 'key' => 'AWS_DEFAULT_REGION', 'value' => 'us-east-1'],
            ['type'=> 'storage', 'key' => 'AWS_BUCKET', 'value' => ''],
            ['type'=> 'storage', 'key' => 'AWS_USE_PATH_STYLE_ENDPOINT', 'value' => 'false'],
            ['type'=> 'broadcast', 'key' => 'PUSHER_APP_ID', 'value' => ''],
            ['type'=> 'broadcast', 'key' => 'PUSHER_APP_KEY', 'value' => ''],
            ['type'=> 'broadcast', 'key' => 'PUSHER_APP_SECRET', 'value' => ''],
            ['type'=> 'broadcast', 'key' => 'PUSHER_HOST', 'value' => ''],
            ['type'=> 'broadcast', 'key' => 'PUSHER_PORT', 'value' => '443'],
            ['type'=> 'broadcast', 'key' => 'PUSHER_SCHEME', 'value' => 'https'],
            ['type'=> 'broadcast', 'key' => 'PUSHER_APP_CLUSTER', 'value' => 'mt1'],
            ['type'=> 'mail', 'key' => 'MAIL_MAILER', 'value' => 'smtp'],
            ['type'=> 'mail', 'key' => 'MAIL_HOST', 'value' => 'mailpit'],
            ['type'=> 'mail', 'key' => 'MAIL_PORT', 'value' => '1025'],
            ['type'=> 'mail', 'key' => 'MAIL_USERNAME', 'value' => 'null'],
            ['type'=> 'mail', 'key' => 'MAIL_PASSWORD', 'value' => 'null'],
            ['type'=> 'mail', 'key' => 'MAIL_ENCRYPTION', 'value' => 'null'],
            ['type'=> 'mail', 'key' => 'MAIL_FROM_ADDRESS', 'value' => 'hello@example.com'],
            ['type'=> 'mail', 'key' => 'MAIL_FROM_NAME', 'value' => '${APP_NAME}'],
            ['type'=> 'vite', 'key' => 'VITE_PUSHER_APP_KEY', 'value' => '${PUSHER_APP_KEY}'],
            ['type'=> 'vite', 'key' => 'VITE_PUSHER_HOST', 'value' => '${PUSHER_HOST}'],
            ['type'=> 'vite', 'key' => 'VITE_PUSHER_PORT', 'value' => '${PUSHER_PORT}'],
            ['type'=> 'vite', 'key' => 'VITE_PUSHER_SCHEME', 'value' => '${PUSHER_SCHEME}'],
            ['type'=> 'vite', 'key' => 'VITE_PUSHER_APP_CLUSTER', 'value' => '${PUSHER_APP_CLUSTER}'],
        ]);
    }
}

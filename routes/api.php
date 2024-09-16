<?php

use App\Models\IotData;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/arduino-post-data', function (Request $request) {

    $user = User::whereNotNull('start_monitor')->first();

    if ($user) {
        $monitor = $user
            ->sleepMonitoring()->create([
                'snoring_level' => $request->mic_audio ? (($request->mic_audio + 83.2073) / 11.003) :  null,
                'heart_rate' => $request->hr ?? null,
                'sp02' => $request->oxygen ?? null,
                'serial_key' => '1',
            ]);

        $isNormalSnoringLevel = ($monitor->snoring_level >= 0 && $monitor->snoring_level <= 50);
        $isNormalHeartRate = ($monitor->heart_rate >= 60 && $monitor->heart_rate <= 100);
        $isNormalSp02 = ($monitor->sp02 >= 95 && $monitor->sp02 <= 100);

        if (!$isNormalSnoringLevel || !$isNormalHeartRate || !$isNormalSp02) {
            $params = [
                '_token' => csrf_token()
            ];
            if (!$isNormalSnoringLevel) {
                $params['snoring_level'] = $monitor->snoring_level;
            }

            if (!$isNormalHeartRate) {
                $params['heart_rate'] = $monitor->heart_rate;
            }

            if (!$isNormalSp02) {
                $params['sp02'] = $monitor->sp02;
            }


            $notification = $user->storeNotification([
                'snoring_level' => isset($params['snoring_level']) ? $params['snoring_level']  : null,
                'heart_rate' => isset($params['heart_rate']) ? $params['heart_rate']  : null,
                'sp02' => isset($params['sp02']) ? $params['sp02']  : null,
            ]);
        }

        return response()->json($monitor);
    }

    return response()->json(false);
});


Route::post('/post-data', function (Request $request) {

    $temperature = $request->temperature;
    $distance = $request->distance;
    $humidity = $request->humidity;
    $gas = $request->gas;
    $name = $request->name;

    $data = IotData::create([
        'name' => $name,
        'temperature' =>  $temperature,
        'distance' =>  $distance,
        'humidity' =>  $humidity,
        'gas' =>   $gas,
    ]);

    return response()->json($data);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

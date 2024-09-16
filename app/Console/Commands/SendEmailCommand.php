<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;

class SendEmailCommand extends Command
{
    protected $signature = 'email:send';
    protected $description = 'Send email every 15 minutes';
    
    public function handle()
    {
        $currentTime = Carbon::now();

        $startTime = Carbon::now()->subMinutes(15);
        $users = User::with(['sleepMonitoring' => function($q) use($currentTime, $startTime) {
                $q->whereBetween('created_at', [$startTime, $currentTime]);
            }])->has('sleepMonitoring')->get();

        foreach ($users as $user) {
            $notifications = [];

            foreach ($user->sleepMonitoring as $sleepMonitoring) {
                $isNormalSnoringLevel = ($sleepMonitoring->snoring_level >= 0 && $sleepMonitoring->snoring_level <= 50);
                $isNormalHeartRate = ($sleepMonitoring->heart_rate >= 60 && $sleepMonitoring->heart_rate <= 100);
                $isNormalSp02 = ($sleepMonitoring->sp02 >= 95 && $sleepMonitoring->sp02 <= 100);

                if (!$isNormalSnoringLevel || !$isNormalHeartRate || !$isNormalSp02) {
                    $params = [];
                    if (!$isNormalSnoringLevel) {
                        $params['snoring_level'] = $sleepMonitoring->snoring_level;
                    }
                
                    if (!$isNormalHeartRate) {
                        $params['heart_rate'] = $sleepMonitoring->heart_rate;
                    }
                
                    if (!$isNormalSp02) {
                        $params['sp02'] = $sleepMonitoring->sp02;
                    }

                    array_push($notifications,[
                        'snoring_level' => isset($params['snoring_level']) ? $params['snoring_level']  : null,
                        'heart_rate' => isset($params['heart_rate']) ? $params['heart_rate']  : null,
                        'sp02' => isset($params['sp02']) ? $params['sp02']  : null,
                        'created_at' => $sleepMonitoring->created_at,
                    ]);
                }
            }

            if (count($notifications) !== 0) {
                $user->sendAbnormalityDetectedNotification($notifications);
            }
           
        }
    }
}

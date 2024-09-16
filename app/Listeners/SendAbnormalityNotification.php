<?php

namespace App\Listeners;

use App\Events\AbnormalityDetected;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AbnormalityDetectedNotification;

class SendAbnormalityNotification
{
    public function handle($event)
    {
        Notification::send($event->user, new AbnormalityDetectedNotification($event->abnormality));
    }
}

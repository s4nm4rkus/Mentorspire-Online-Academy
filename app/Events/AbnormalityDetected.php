<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class AbnormalityDetected
{
    use SerializesModels;
    
    public $user;
    public $abnormality;

    public function __construct($user, $abnormality)
    {
        $this->abnormality = $abnormality;
        $this->user = $user;
    }
}

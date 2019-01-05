<?php

namespace WakeupLight\Steps;

use Yeelight\Bulb\Bulb;

class SleepStep
{
    private $duration;

    public function __construct(int $duration)
    {
        $this->duration = $duration;
    }

    public function applyTo(Bulb $bulb)
    {
        sleep($this->duration);
    }
}

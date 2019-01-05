<?php

namespace WakeupLight\Steps;

use Yeelight\Bulb\Bulb;

class PowerStep
{
    private $power;

    public function __construct(bool $power)
    {
        $this->power = $power;
    }

    public function applyTo(Bulb $bulb)
    {
        $on = $this->power ? Bulb::ON : Bulb::OFF;
        $bulb->setPower($on, Bulb::EFFECT_SMOOTH, 1000);
        fwrite(STDERR, "Lamp {$on}\n");
    }
}

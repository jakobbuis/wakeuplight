<?php

namespace WakeupLight\Steps;

use Yeelight\Bulb\Bulb;

interface Step
{
    public function applyTo(Bulb $bulb);
}

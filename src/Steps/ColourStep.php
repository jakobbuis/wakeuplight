<?php

namespace WakeupLight\Steps;

use Yeelight\Bulb\Bulb;

class ColourStep
{
    private $saturation;
    private $brightness;

    public function __construct(int $saturation, int $brightness)
    {
        $this->saturation = $saturation;
        $this->brightness = $brightness;

        if ($this->saturation < 0 || $this->saturation > 100) {
            throw new DomainException('Saturation must be between 0 and 100 inclusive');
        }

        if ($this->brightness < 0 || $this->brightness > 100) {
            throw new DomainException('Brightness must be between 0 and 100 inclusive');
        }
    }

    public function applyTo(Bulb $bulb) : void
    {
        $saturation = $this->saturation;
        $brightness = $this->brightness;

        $bulb->setHsv(26, $saturation, Bulb::EFFECT_SMOOTH, 1000);
        $bulb->setBright($brightness, Bulb::EFFECT_SMOOTH, 1000);

        fwrite(STDERR, "Lamp tuned to hue 26\n");
        fwrite(STDERR, "Lamp tuned to saturation {$saturation}\n");
        fwrite(STDERR, "Lamp tuned to brightness {$brightness}\n");
    }
}

<?php

namespace WakeupLight;

use DomainException;

class State
{
    private $power;
    private $saturation;
    private $brightness;

    public function __construct(bool $power, int $saturation, int $brightness)
    {
        $this->power = $power;
        $this->saturation = $saturation;
        $this->brightness = $brightness;

        if ($this->saturation < 0 || $this->saturation > 100) {
            throw new DomainException('Saturation must be between 0 and 100 inclusive');
        }

        if ($this->brightness < 0 || $this->brightness > 100) {
            throw new DomainException('Brightness must be between 0 and 100 inclusive');
        }
    }

    public function __get(string $key)
    {
        return $this->$key;
    }
}

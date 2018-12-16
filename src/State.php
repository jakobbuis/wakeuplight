<?php

namespace WakeupLight;

class State
{
    private $power;

    public function __construct(bool $power)
    {
        $this->power = $power;
    }

    public function __get(string $key)
    {
        return $this->$key;
    }
}

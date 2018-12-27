<?php

namespace WakeupLight;

use WakeupLight\Steps\{ColourStep, PowerStep, SleepStep};
use Yeelight\Bulb\Bulb;

class WakeupProgramme
{
    private $steps;

    public function __construct()
    {
        $this->steps = [
            new PowerStep(true),
            new ColourStep(100, 10),
            new SleepStep(5),
            new ColourStep(90, 20),
            new SleepStep(5),
            new ColourStep(80, 30),
            new SleepStep(5),
            new ColourStep(70, 40),
            new SleepStep(5),
            new ColourStep(60, 50),
            new SleepStep(5),
            new ColourStep(50, 60),
            new SleepStep(5),
            new ColourStep(40, 70),
            new SleepStep(5),
            new ColourStep(30, 80),
            new SleepStep(5),
            new ColourStep(20, 90),
            new SleepStep(5),
            new ColourStep(10, 100),
            new SleepStep(10),
            new PowerStep(false),
        ];
    }

    /**
     * Run the program on a bulb
     */
    public function runOn(Bulb $bulb) : void
    {
        fwrite(STDERR, "Running WakeupProgramme on bulb {$bulb->getId()}\n");

        foreach ($this->steps as $step) {
            $step->applyTo($bulb);
        }

        fwrite(STDERR, "Finished WakeupProgramme on bulb {$bulb->getId()}\n");
    }
}
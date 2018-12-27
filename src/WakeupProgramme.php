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
            new ColourStep(100, 10),    // gradually from soft orange
            new SleepStep(60),
            new ColourStep(90, 20),
            new SleepStep(60),
            new ColourStep(80, 30),
            new SleepStep(60),
            new ColourStep(70, 40),
            new SleepStep(60),
            new ColourStep(60, 50),
            new SleepStep(60),
            new ColourStep(50, 60),
            new SleepStep(60),
            new ColourStep(40, 70),
            new SleepStep(60),
            new ColourStep(30, 80),
            new SleepStep(60),
            new ColourStep(20, 90),
            new SleepStep(60),
            new ColourStep(10, 100),    // to hard white
            new SleepStep(300),         // on for half an hour
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

<?php

namespace WakeupLight;

use Carbon\Carbon;
use WakeupLight\State;
use Yeelight\Bulb\Bulb;
use Yeelight\YeelightClient;

class Manager
{
    private $ipaddress;

    public function __construct(string $ipaddress)
    {
        $this->ipaddress = $ipaddress;
    }

    public function manage()
    {
        // Determine if we have a state defined for this minute
        $now = Carbon::now();
        $state = $this->stateFor($now);
        if (!$state) {
            fwrite(STDERR, "No state defined for {$now}\n");
            return;
        }

        $bulb = $this->connect();
        $this->applyState($bulb, $state);
    }

    public function stateFor(Carbon $time) : ?State
    {
        $states = [
            '19:23' => new State(true, 100, 10),
            '19:24' => new State(true, 90, 20),
            '19:25' => new State(true, 80, 30),
            '19:26' => new State(true, 70, 40),
            '19:27' => new State(true, 60, 50),
            '19:28' => new State(true, 50, 60),
            '19:29' => new State(true, 40, 70),
            '19:30' => new State(true, 30, 80),
            '19:31' => new State(true, 20, 90),
            '19:32' => new State(true, 10, 100),
            '19:35' => new State(false, 0, 0),
        ];

        return $states[$time->format('H:i')] ?? null;
    }

    private function connect()
    {
        $client = new YeelightClient();
        $bulbs = $client->search();
        $bulb = $bulbs[$this->ipaddress] ?? null;
        if (!$bulb) {
            fwrite(STDERR, "Cannot connect to bulb\n");
            exit(1);
        }
        return $bulb;
    }

    private function applyState(Bulb $bulb, State $state) : void
    {
        $effect = Bulb::EFFECT_SMOOTH;
        $duration = 1000;

        $on = $state->power ? Bulb::ON : Bulb::OFF;
        $bulb->setPower($on, $effect, $duration);
        fwrite(STDERR, "Lamp {$on}\n");

        // If we turned the lamp off, the colour settings don't matter
        if ($on === Bulb::OFF) {
            return;
        }

        $saturation = $state->saturation;
        $bulb->setHsv(26, $saturation, $effect, $duration);
        fwrite(STDERR, "Lamp tuned to hue 26\n");
        fwrite(STDERR, "Lamp tuned to saturation {$saturation}\n");

        $brightness = $state->brightness;
        $bulb->setBright($brightness, $effect, $duration);
        fwrite(STDERR, "Lamp tuned to brightness {$brightness}\n");
    }
}

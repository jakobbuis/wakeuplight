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
            '12:49' => new State(true),
            '12:50' => new State(false),
            '12:51' => new State(true),
            '12:52' => new State(false),
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
        $on = $state->power ? Bulb::ON : Bulb::OFF;
        $bulb->setPower($on, BULB::EFFECT_SMOOTH, 500);
        fwrite(STDERR, "Lamp {$on}\n");
    }
}

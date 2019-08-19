<?php

namespace App\Extensions\ServerMonitor;

use Spatie\ServerMonitor\CheckDefinitions\CheckDefinition;
use Symfony\Component\Process\Process;

class Nginx extends CheckDefinition
{
    public $command = 'ps -e | grep nginx$';

    public function resolve(Process $process)
    {
        if (str_contains($process->getOutput(), 'nginx')) {
            $this->check->succeed('is running');

            return;
        }

        $this->check->fail('is not running');
    }
}

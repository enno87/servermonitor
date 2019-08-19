<?php

namespace App\Models;

use App\Traits\Models\EncryptIdTrait;
use Spatie\ServerMonitor\Models\Host as BaseHost;

class Host extends BaseHost
{
    use EncryptIdTrait;
}

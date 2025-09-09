<?php

namespace Saad\AiBridge\Facades;

use Illuminate\Support\Facades\Facade;

class Ai extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Saad\AiBridge\AiService::class;
    }
}

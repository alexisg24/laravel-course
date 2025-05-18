<?php

namespace App\ExternalService\Listeners;

use App\ExternalService\Events\DataGet;
use Illuminate\Support\Facades\Log;

class LogDataGet
{
    /**
     * Create the event listener.
     */
    public function __construct() {}

    /**
     * Handle the event.
     */
    public function handle(DataGet $event): void
    {
        Log::info('DataGet event triggered from external: ', $event->data);
    }
}

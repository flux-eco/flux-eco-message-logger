<?php

namespace FluxEco\MessageLoggerOrbital\Core\Ports\MessageStream;
use FluxEco\MessageLoggerOrbital\Core\Ports;

interface MessageStreamRepository {
    public function handle(Ports\IncomingMessages\LogMessage $logMessage);
}

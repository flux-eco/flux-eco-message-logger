<?php

namespace FluxEco\MessageLoggerOrbital\Core\Ports;
use FluxEco\MessageLoggerOrbital\Core\Ports\IncomingMessages\LogMessage;

final readonly class Service
{

    private function __construct(
        private Outbounds $outbounds
    ) {

    }

    public static function new(Outbounds $outbounds)
    {
        return new self($outbounds);
    }

    public function logMessage(LogMessage $logMessage): void
    {
        $this->outbounds->messageStreamRepository->handle($logMessage);
    }
}
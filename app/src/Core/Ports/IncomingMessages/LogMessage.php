<?php

namespace FluxEco\MessageLoggerOrbital\Core\Ports\IncomingMessages;

use DateTimeImmutable;

final readonly class LogMessage
{
    private function __construct(
        public DateTimeImmutable $dateTimeImmutable,
        public string $from,
        public string $address,
        public string $jsonMessage
    ) {

    }

    public static function new(
        DateTimeImmutable $dateTimeImmutable,
        string $from,
        string $address,
        string $jsonMessage
    ) : self {
        return new self(
            ...get_defined_vars()
        );
    }
}
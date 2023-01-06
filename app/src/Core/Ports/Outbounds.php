<?php

namespace FluxEco\MessageLoggerOrbital\Core\Ports;

final readonly class Outbounds {

    private function __construct(
        public MessageStream\MessageStreamRepository $messageStreamRepository
    )
    {

    }

    public static function new(
        MessageStream\MessageStreamRepository $messageStreamRepository
    ) {
        return new self(...get_defined_vars());
    }
}
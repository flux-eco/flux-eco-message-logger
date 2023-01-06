<?php

namespace FluxEco\MessageLoggerOrbital\Adapters\Config;

final readonly class Config
{

    private function __construct(
        public string $logFilesDirectoryPath
    ) {

    }

    public static function new() : self
    {
        return new self(
            EnvName::FLUX_ECO_LOGGER_ORBITAL_LOG_FILES_DIRECTORY_PATH->toConfigValue(),
        );
    }
}
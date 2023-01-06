<?php

namespace FluxEco\MessageLoggerOrbital\Adapters\Config;

enum EnvName: string
{
    case FLUX_ECO_LOGGER_ORBITAL_LOG_FILES_DIRECTORY_PATH = 'FLUX_ECO_LOGGER_ORBITAL_LOG_FILES_DIRECTORY_PATH';

    public function toConfigValue() : string|int
    {
        return getenv($this->value);
    }
}
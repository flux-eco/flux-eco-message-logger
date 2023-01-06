<?php

namespace FluxEco\MessageLoggerOrbital\Adapters\Repositories;

use FluxEco\MessageLoggerOrbital\Core\Ports\MessageStream\MessageStreamRepository;
use FluxEco\MessageLoggerOrbital\Core\Ports\IncomingMessages\LogMessage;
use DateTimeImmutable;

final readonly class FileBasedMessageStream implements MessageStreamRepository
{
    private function __construct(
        public string $logFileDirectoryPath
    ) {
    }

    public static function new(
        string $logFileDirectoryPath
    ) {
        return new self($logFileDirectoryPath);
    }

    public function handle(LogMessage $logMessage)
    {
        $this->append($logMessage->dateTimeImmutable, $logMessage->from, $logMessage->address,
            $logMessage->jsonMessage);
    }

    public function append(DateTimeImmutable $dateTimeImmutable, string $from, string $address, string $jsonMessage)
    {
        //Something to write to txt log
        $log = "From: " . $from . ' - ' . $dateTimeImmutable->format(DATE_ATOM) . PHP_EOL .
            "Address: " . $address . PHP_EOL .
            "Message: " . $jsonMessage . PHP_EOL .
            "-------------------------" . PHP_EOL;
//Save string to log, use FILE_APPEND to append.
        file_put_contents($this->logFileDirectoryPath . '/log_' . date("Y-m-d") . '.log', $log, FILE_APPEND);
    }

}
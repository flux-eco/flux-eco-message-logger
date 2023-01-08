<?php

namespace FluxEco\MessageLoggerOrbital\Adapters\Api;

use Swoole\Http;
use FluxEco\MessageLoggerOrbital\Adapters\Config\Config;
use FluxEco\MessageLoggerOrbital\Adapters;
use FluxEco\MessageLoggerOrbital\Core\Ports;
use DateTimeImmutable;

final readonly class HttpApi
{
    private function __construct(
        private Ports\Service $service
    ) {

    }

    public static function new() : self
    {
        $config = Config::new();
        return new self(
            Ports\Service::new(
                Ports\Outbounds::new(
                    Adapters\Repositories\FileBasedMessageStream::new(
                        $config->logFilesDirectoryPath
                    )
                )
            )
        );
    }

    /**
     * @throws \Exception
     */
    final public function handleHttpRequest(Http\Request $request, Http\Response $response) : void
    {
        $from = $request->server['remote_addr'];
        if (array_key_exists('x-flux-eco-orbital', $request->header)) {
            $from = $request->header['x-flux-eco-orbital'];
        }

        $requestUri = $request->server['request_uri'];
        $message = $request->rawContent();

        $this->service->logMessage(
            Ports\IncomingMessages\LogMessage::new(
                new DateTimeImmutable(), $from, $requestUri, $message
            )
        );

        $this->publish($response)("Ok");
    }

    private function publish(Http\Response $response)
    {
        return function (object|string $responseObject) use ($response) {

            if (is_object($responseObject) && property_exists($responseObject,
                    'cookies') && count($responseObject->cookies) > 0) {
                foreach ($responseObject->cookies as $name => $value) {
                    $response->setCookie($name, $value, time() + 3600);
                }
            }

            $response->header('Content-Type', 'application/json');
            $response->header('Cache-Control', 'no-cache');

            match (true) {
                is_string($responseObject) => $response->end($responseObject),
                default => $response->end(json_encode($responseObject))
            };
        };
    }
}
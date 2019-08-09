<?php

namespace BufferSDK\Http;

interface ClientInterface
{
    public function createHttpRequest(string $method, string $endpoint, array $options = []): array;
}

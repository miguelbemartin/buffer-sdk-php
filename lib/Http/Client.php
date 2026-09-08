<?php

namespace BufferSDK\Http;

use BufferSDK\Auth\AuthorizationTokenInterface;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Handler\CurlHandler;
use GuzzleHttp\RequestOptions;

class Client implements ClientInterface
{
    protected string $baseURL = 'https://api.bufferapp.com/1/';

    private GuzzleClient $httpClient;

    /**
     * Client constructor.
     */
    public function __construct(AuthorizationTokenInterface $auth)
    {
        $this->httpClient = new GuzzleClient([
            'base_uri' => $this->baseURL,
            'handler' => new CurlHandler(),
            RequestOptions::HEADERS => [
                'Authorization' => 'Bearer ' . $auth->getAccessToken(),
            ],
        ]);
    }

    /**
     * Create Http Request and send the request.
     *
     * @param string $method
     * @param string $endpoint
     * @param array  $options
     *
     * @return array
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \JsonException
     */
    public function createHttpRequest(string $method, string $endpoint, array $options = []): array
    {
        if (isset($options['body']) && is_array($options['body'])) {
            $options[RequestOptions::FORM_PARAMS] = $options['body'];
            unset($options['body']);
        }

        $response = $this->httpClient->request($method, $endpoint, $options);

        $decoded = json_decode(
            $response->getBody()->getContents(),
            true,
            512,
            JSON_THROW_ON_ERROR | JSON_BIGINT_AS_STRING
        );

        if (!is_array($decoded)) {
            throw new \UnexpectedValueException('Expected the decoded response body to be an array.');
        }

        return $decoded;
    }
}

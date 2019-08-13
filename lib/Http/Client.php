<?php

namespace BufferSDK\Http;

use BufferSDK\Auth\AuthorizationTokenInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class Client implements ClientInterface
{
    /** @var string */
    protected $baseURL = 'https://api.bufferapp.com/1/';

    /** @var HttpClientInterface */
    private $httpClient;

    /**
     * Client constructor.
     */
    public function __construct(AuthorizationTokenInterface $auth)
    {
        $this->httpClient = HttpClient::create(['headers' => [
            'Authorization' => 'Bearer '.$auth->getAccessToken(),
        ]]);
    }

    /**
     * Create Http Request and send the request.
     *
     * @param string $method
     * @param string $url
     * @param array $options
     *
     * @return array
     *
     * @throws TransportExceptionInterface
     * @throws DecodingExceptionInterface    When the body cannot be decoded to an array
     * @throws TransportExceptionInterface   When a network error occurs
     * @throws RedirectionExceptionInterface On a 3xx when $throw is true and the "max_redirects" option has been reached
     * @throws ClientExceptionInterface      On a 4xx when $throw is true
     * @throws ServerExceptionInterface      On a 5xx when $throw is true
     */
    public function createHttpRequest(string $method, string $endpoint, array $options = []): array
    {
        $response = $this->httpClient->request($method, $this->baseURL.$endpoint, $options);
        $responseArray = $response->toArray();

        return $responseArray;
    }
}

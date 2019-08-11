<?php

namespace BufferSDK\Http;

use BufferSDK\Auth\AuthorizationTokenInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class Client implements ClientInterface
{
    /** @var string */
    protected $baseURL = 'https://api.bufferapp.com/1/';

    /** @var HttpClientInterface  */
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
     */
    public function createHttpRequest(string $method, string $endpoint, array $options = []): array
    {
        try {
            $response = $this->httpClient->request($method, $this->baseURL.$endpoint, $options);
            $responseArray = $response->toArray();
        } catch (TransportExceptionInterface $e) {
            //TODO: Handle errors
        }

        return $responseArray;
    }
}

<?php

namespace BufferSDK\Service;

use BufferSDK\Http\ClientInterface;

class UserService
{
    /** @var ClientInterface */
    private $client;

    /**
     * UserService constructor.
     *
     * @param $client
     */
    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * Returns a single user.
     *
     * @return array
     */
    public function getUser(): array
    {
        return $this->client->createHttpRequest('GET', 'user.json');
    }
}

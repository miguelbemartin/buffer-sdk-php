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
     * @return array
     */
    public function getUser()
    {
        return $this->client->createHttpRequest('GET', 'user.json');
    }
}

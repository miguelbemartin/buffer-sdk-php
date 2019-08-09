<?php

namespace BufferSDK\Auth;

class AuthorizationToken implements AuthorizationTokenInterface
{
    /** @var string */
    private $accessToken;

    /**
     * AuthorizationToken constructor.
     *
     * @param $accesToken
     */
    public function __construct(string $accessToken)
    {
        $this->accessToken = $accessToken;
    }

    public function getAccessToken(): string
    {
        return $this->accessToken;
    }
}

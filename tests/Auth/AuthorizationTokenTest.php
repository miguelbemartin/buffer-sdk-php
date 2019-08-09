<?php

namespace BufferSDK\Tests\Auth;

use BufferSDK\Auth\AuthorizationToken;
use PHPUnit\Framework\TestCase;

class AuthorizationTokenTest extends TestCase
{
    public function testAuthorizationToken()
    {
        $token = 'test';

        $auth = new AuthorizationToken($token);

        $this->assertEquals($auth->getAccessToken(), $token);
    }
}

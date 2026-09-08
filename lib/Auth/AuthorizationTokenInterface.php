<?php

namespace BufferSDK\Auth;

interface AuthorizationTokenInterface
{
    public function getAccessToken() : string;
}

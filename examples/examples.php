<?php

use BufferSDK\Auth\AuthorizationToken;
use BufferSDK\Buffer;

require __DIR__.'/../vendor/autoload.php';

// Create a new AuthorizationToken
$auth = new AuthorizationToken('XXX');

// Create a new Buffer Wrapper Client
$buffer = new Buffer($auth);

// Get User
$user = $buffer->userService->getUser();

// Get the profiles
$profiles = $buffer->profileService->getProfiles();
